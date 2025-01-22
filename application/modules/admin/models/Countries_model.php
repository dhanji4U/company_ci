<?php

class Countries_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public $column_search = array();
    public $order = array();

    /*
    ** Function to Get Listing with Active/Inactive Status and Action Buttons
    */
    function _get_datatables_query()
    {
        $this->column_search = array('id', 'id', 'flag', 'name', 'nationality', 'sortname', 'calling_code', 'currency_code', 'currency_name', 'currency_symbol');

        $this->db->select("*, CONCAT('" . COUNTRIES_IMAGE . "', flag) as flag");
        $this->db->from('tbl_country');
        $this->db->where("is_deleted = '0'");

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
        $this->db->from('tbl_country');
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

}
