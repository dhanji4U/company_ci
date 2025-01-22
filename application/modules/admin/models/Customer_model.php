<?php

class Customer_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public $column_search = array();
    public $order = array();

    /*
    ** Function to Get Listing with Active/Inactive Status and Action for Buttons
    */
    function _get_datatables_query()
    {
        $this->column_search = array('id', 'id', 'name', 'email', 'country_code', 'phone', 'login_status');
        $this->order = array('id' => 'desc'); // default order 

        $this->db->select("*, CONCAT(country_code, '  ', phone) AS contact_number");
        $this->db->from('tbl_user');
        $this->db->where('user_type', 'Customer');
        $this->db->where("is_deleted = '0'");

        if (!empty($this->session->userdata('customerloginstatus'))) {
            $this->db->where('login_status', $this->session->userdata('customerloginstatus'));
        }

        if ($this->session->has_userdata('customeractivestatus')) {
            $this->db->where('is_active', $this->session->userdata('customeractivestatus'));
        }

        if (!empty($this->session->userdata('customerregisterstart_date'))) {
            $this->db->where('DATE(insert_datetime) >= ', $this->session->userdata('customerregisterstart_date'));
        }

        if (!empty($this->session->userdata('customerregisterend_date'))) {
            $this->db->where('DATE(insert_datetime) <= ', $this->session->userdata('customerregisterend_date'));
        }

        if (isset($_REQUEST['data']['search']['value']) && $_REQUEST['data']['search']['value'] != '') // if datatable send POST for search
        {
            $i = 0;
            foreach ($this->column_search as $item) // loop column 
            {
                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, trim($_REQUEST['data']['search']['value']));
                } else {
                    $this->db->or_like($item, trim($_REQUEST['data']['search']['value']));
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket

                $i++;
            }
        }

        if (isset($_REQUEST['data']['order'][0]) && $_REQUEST['data']['order'][0]['column'] != '') // here order processing
        {
            $this->db->order_by($this->column_search[$_REQUEST['data']['order'][0]['column']], $_REQUEST['data']['order'][0]['dir']);
        } else if (isset($this->order)) {
            $this->db->order_by(key($this->order), $this->order[key($this->order)]);
        }
    }

    /*
    ** Function for Get Data table
    */
    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_REQUEST['data']['length'] != -1)
            $this->db->limit($_REQUEST['data']['length'], $_REQUEST['data']['start']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    /*
    ** Function for Count Total Record
    */
    function total_record()
    {
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('user_type', 'Customer');
        $this->db->where("is_deleted = '0'");
        return $this->db->count_all_results();
    }

    /*
    ** Function for Count Filtered Record
    */
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    /*
    ** Function for get all user details
    */
    public function viewDetails($user_id)
    {
        $data['result']                     =     $this->common_model->common_singleSelect('tbl_user', array('id' => $user_id));

        $data['device']                     =     $this->common_model->common_singleSelect('tbl_user_device', array('user_id' => $user_id, 'user_type' => 'Customer'));

        $data['address']                    =     $this->common_model->common_multipleSelect('tbl_user_address', array('user_id' => $user_id));

        $data['booking']                    =     $this->getCustomerBooking($user_id);

        return $data;
    }

    /*
    ** Function for Get User Device Details
    */
    function getCustomerBooking($user_id)
    {
        $this->db->select("pab.*, pa.name AS parking_area_name, pa.address, pa.post_code, la.name AS local_authority_name");
        $this->db->from('tbl_parking_area_booking AS pab');
        $this->db->join('tbl_parking_area AS pa', 'pa.id = pab.parking_area_id', 'left');
        $this->db->join('tbl_local_authority AS la', 'la.id = pa.local_authority_id', 'left');
        $this->db->where('pab.user_id', $user_id);
        $this->db->where("pab.is_deleted = '0'");
        $this->db->where("pa.is_deleted = '0'");
        $this->db->where("pa.is_active = '1'");
        $this->db->where("la.is_deleted = '0'");
        $this->db->where("la.is_active = '1'");
        $this->db->order_by("pab.insert_datetime", 'DESC');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }


    /*
    ** Function for export the data
    */
    function export()
    {
        $this->db->select("*, CONCAT(country_code, ' ', phone) AS phone");
        $this->db->from('tbl_user');
        $this->db->where('user_type', 'Customer');
        $this->db->where("is_deleted = '0'");
        $this->db->order_by('id', 'DESC');

        if (!empty($this->session->userdata('customerloginstatus'))) {
            $this->db->where('login_status', $this->session->userdata('customerloginstatus'));
        }

        if ($this->session->has_userdata('customeractivestatus')) {
            $this->db->where('is_active', $this->session->userdata('customeractivestatus'));
        }

        if (!empty($this->session->userdata('customerregisterstart_date'))) {
            $this->db->where('DATE(insert_datetime) >= ', $this->session->userdata('customerregisterstart_date'));
        }

        if (!empty($this->session->userdata('customerregisterend_date'))) {
            $this->db->where('DATE(insert_datetime) <= ', $this->session->userdata('customerregisterend_date'));
        }

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
}
