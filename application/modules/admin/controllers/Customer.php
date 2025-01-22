<?php defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(E_ERROR);

class Customer extends MY_Controller
{
	private $view_folder = 'admin/customer/';

	public function __construct()
	{
		parent::__construct();

		$this->load->model('customer_model');
	}

	/*
    ** Function for View List
    */
	public function index()
	{
		$data = array();
		$this->load->view($this->view_folder . 'listing', $data);
	}

	/*
    ** Function for Listing / Active-Inactive and Action Buttons
    */
	public function ajax_list()
	{
		$list = $this->customer_model->get_datatables();

		$data = array();

		foreach ($list as $row_data) {

			$action = "";

			if ($row_data['is_active'] == '0') {
				$status = '<a href="javascript:;" onclick="change_state(`' . $row_data['id'] . '`,1);" class="btn waves-effect waves-float waves-light-blue m-l-5 bg-red"><i class="zmdi zmdi-lock-open" title="Unblock"></i></a>';
			} else {
				$status = '<a href="javascript:;" onclick="change_state(`' . $row_data['id'] . '`,0);" class="btn waves-effect waves-float waves-light-blue m-l-5 bg-green"><i class="zmdi zmdi-lock-outline" title="Block"></i></a>';
			}

			$action = '<div><a style="margin-bottom:5px; width: 17px" href="' . site_url() . 'admin/customer/view/' . base64_encode($row_data['id']) . '" class="btn btn-custom waves-effect"><i class="zmdi zmdi-eye"></i></a></div>';

			$action .= '<div><a style="margin-bottom:5px; width: 17px" href="' . site_url() . 'admin/customer/edit/' . base64_encode($row_data['id']) . '" class="btn btn-custom waves-effect"><i class="zmdi zmdi-edit"></i></a></div>';

			$action .= '<div><a style="margin-bottom:5px; width: 17px" href="javascript:;" onclick="remove(`' . $row_data['id'] . '`,1);" class="btn btn-custom waves-effect"><i class="zmdi zmdi-delete"></i></a></div>';

			if ($row_data['login_status'] == "Online") {
				$login_status = '<span class="col-green" style = "font-size: 19px;"> <b> Online </b> </span>';
			} else {
				$login_status = '<span class="col-red" style = "font-size: 19px;"> <b> Offline </b> </span>';
			}

			$row_data['insert_datetime'] = $this->common_model->dateConvertToTimezone($row_data['insert_datetime'], ADMIN_LONGDATE, $this->session->userdata(ADMIN_TIMEZONE));

			$check_box = '
			<div class="checkbox-wrapper">
				<input type="checkbox" onclick="checkbox()" id="select_' . $row_data['id'] . '" class="city_checkbox" name="select_all[]" value="' . $row_data['id'] . '" id="example-select-all">
				<svg viewBox="0 0 35.6 35.6">
					<circle r="17.8" cy="17.8" cx="17.8" class="background"></circle>
					<circle r="14.37" cy="17.8" cx="17.8" class="stroke"></circle>
					<polyline points="11.78 18.12 15.55 22.23 25.17 12.87" class="check"></polyline>
				</svg>
			</div>';
			$row_data['check_box'] = $check_box;

			if ($row_data['local_resident_status'] == 'Pending') {

				$change_order_status = '<div><button style="margin-bottom:5px; cursor: pointer;" class="btn btn-custom changeRequestStatus" data-id="' . $row_data['id'] . '" data-status="Approve"><span>Approve</span></button> 

				<button style="margin-bottom:5px; cursor: pointer;" class="btn btn-reject changeRequestStatus" data-id="' . $row_data['id'] . '"  data-status="Reject"><span>Reject</span></button></div>';
			} else if ($row_data['local_resident_status'] == 'Approve') {

				$change_order_status = '<div><button style="margin-bottom:5px; cursor: pointer;" class="btn btn-approve changeRequestStatus" data-id="' . $row_data['id'] . '" data-status="Revoke"><span>Revoke</span></button></div>';
			} else if ($row_data['local_resident_status'] == 'Revoke') {

				$change_order_status = '<div><button class="btn btn-revoked"><span>Revoked</span></button></div>';
			} else if ($row_data['local_resident_status'] == 'Reject') {

				$change_order_status = '<div><button class="btn btn-rejected"><span>Rejected</span></button></div>';
			} else {

				$change_order_status = '<div><button class="btn btn-none"><span>None</span></button></div>';
			}

			$row_data['change_order_status'] = $change_order_status;

			$row_data['login_status'] = $login_status;
			$row_data['status'] = $status;
			$row_data['action'] = $action;
			$data[] = $row_data;
		}

		$output = array(
			"draw" => isset($_REQUEST['draw']) ? $_REQUEST['draw'] : 0,
			"recordsTotal" => $this->customer_model->total_record(),
			"recordsFiltered" => $this->customer_model->count_filtered(),
			"data" => $data,
			"token" => $this->security->get_csrf_hash() // New token hash
		);
		//output to json format
		echo json_encode($output);
	}

	/*
    ** Function for Change State
    */
	public function change_state($user_id, $state)
	{
		if (!$this->uri->segment(4) && !$this->uri->segment(5)) {
			echo json_encode(array('code' => '0', 'message' => $this->lang->line('rest_keywords_somethingwent_wrong')));
			die;
		}

		$this->common_model->common_singleUpdate("tbl_user", array('is_active' => $state), strpos($user_id, ",") !== false ? "id IN (" . $user_id . ")" : "id = '" . $user_id . "'");

		$lang_message = $this->lang->line('rest_keywords_customer_' . ($state == '1' ? 'unblock' : 'block') . '_success');

		echo json_encode(array('code' => '1', 'message' => $lang_message));
		die;
	}

	/*
    ** Function for Remove (Soft Delete)
    */
	public function delete($user_id)
	{
		$this->common_model->common_singleUpdate("tbl_user", array('is_deleted' => '1'), strpos($user_id, ",") !== false ? "id IN (" . $user_id . ")" : "id = '" . $user_id . "'");

		$this->common_model->common_singleUpdate("tbl_user_device", array('token' => '', 'device_token' => ''), strpos($user_id, ",") !== false ? "id IN (" . $user_id . ") AND user_type = 'Customer'" : "id = '" . $user_id . "' AND user_type = 'Customer'");

		echo json_encode(array('code' => '1', 'message' => $this->lang->line('rest_keywords_customer_delete_success')));
		die;
	}

	/*
    ** Function for mark completed
    */
	public function request_status($user_id, $status)
	{
		if (!$this->uri->segment(4) && !$this->uri->segment(5)) {
			echo json_encode(array('code' => '0', 'message' => $this->lang->line('rest_keywords_somethingwent_wrong')));
			die;
		}

		$i_value = $this->input->get('input_val');

		$user = $this->common_model->common_singleSelect('tbl_user', array('id' => $user_id));

		$local_resident_requests = $this->common_model->common_singleSelect('tbl_local_resident_requests', array('user_id' => $user_id));

		$reason = '';

		switch ($status) {
			case 'Revoke':
				$type = 'revoked_requested';
				$title = 'Local resident request was revoked';
				$content = 'Your local resident request has been revoked';
				$lang_message = $this->lang->line('rest_keywords_customer_localauthority_revoked_success');
				$reason = $i_value;
				break;
			case 'Reject':
				$type = 'reject_requested';
				$title = 'Local resident request was reject';
				$content = 'Your local resident request has been rejected';
				$reason = $i_value;
				$lang_message = $this->lang->line('rest_keywords_customer_localauthority_rejected_success');

				break;
			case 'Approve':
				$type = 'approve_requested';
				$title = 'Local resident request was approve';
				$content = 'Your local resident request has been approved';
				$reason = 'Request approved';
				$lang_message = $this->lang->line('rest_keywords_customer_localauthority_approved_success');

				break;
			default:
				// Handle the default case if needed
				break;
		}

		if (isset($type)) {
			$notification_object = array(
				'receiver_type' => 'Customer',
				'user_id' => $user['id'],
				'type' => $type,
				'title' => $title,
				'content' => $content,
				'primary_id' => $local_resident_requests['id']
			);
			$this->common_model->send_push($notification_object);
		}

		$this->common_model->common_singleUpdate('tbl_user', array('local_resident_status' => $status), array('id' => $user_id));

		$this->common_model->common_singleUpdate('tbl_local_resident_requests', array('status' => $status, 'reason' => $reason), array('id' => $local_resident_requests['id']));

		echo json_encode(array('code' => '1', 'message' => $lang_message));
		die;
	}

	/*
    ** Function for update the details
    */
	public function edit()
	{
		$user_id = base64_decode($this->uri->segment(4));
		$data['result'] = $this->common_model->common_singleSelect('tbl_user', array('id' => $user_id));

		if ($this->input->post()) {

			$this->form_validation->set_rules('name', 'Name', 'required|trim');
			$this->form_validation->set_rules('language', 'Language', 'required|trim');
			$this->form_validation->set_rules('country_code', 'Country Code', 'required');
			$this->form_validation->set_rules('phone', 'Phone Number', 'required|trim|is_unique[tbl_user.id != ' . $user_id . ' AND is_deleted="0" AND phone=]');
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tbl_user.id != ' . $user_id . ' AND is_deleted="0" AND email=]');
			$this->form_validation->set_rules('password', 'Password', 'min_length[5]');

			$this->form_validation->set_error_delimiters('<div class="error" style="color:#F44336;">', '</div>');

			if ($this->form_validation->run()) {

				$params = array(
					'name' 								=> 		$this->input->post('name'),
					'country_code' 						=> 		$this->input->post('country_code'),
					'phone' 							=> 		$this->input->post('phone'),
					'email' 							=> 		$this->input->post('email'),
					'language' 							=> 		$this->input->post('language')
				);

				// If password changed
				if (!empty($this->input->post('password'))) {
					$params['password'] = openssl_encrypt($this->input->post('password'), ENC_METHOD, KEY_256, 0, IV);
				}	

				$this->common_model->update_data('tbl_user', array('id' => $this->input->post('user_id')), $params);

				$this->session->set_flashdata('success_msg', $this->lang->line('rest_keywords_customer_update_success'));

				redirect('admin/customer');
			} else {
				$this->load->view($this->view_folder . 'edit', $data);
			}
		} else {
			$this->load->view($this->view_folder . 'edit', $data);
		}
	}

	/*
    ** Particular View Details
    */
	public function view()
	{
		if (!$this->uri->segment(4)) {
			redirect('admin/customer');
		}

		$user_id = base64_decode($this->uri->segment(4));

		$data 					= 	$this->customer_model->viewDetails($user_id);

		$this->load->view($this->view_folder . 'view', $data);
	}

	/*
    ** Filter listing via Session
    */
	public function filter()
	{
		$filter_type = $this->input->get('type');
		$value = $this->input->get('value');

		if ($filter_type == 'login_status') {
			if ($value != "") {
				$this->session->set_userdata('customerloginstatus', $value);
			} else {
				$this->session->unset_userdata('customerloginstatus');
			}
		}

		if ($filter_type == 'customer_status') {
			if ($value != "") {
				$this->session->set_userdata('customeractivestatus', $value);
			} else {
				$this->session->unset_userdata('customeractivestatus');
			}
		}

		if ($filter_type == 'start_date') {
			if ($value != "") {
				$this->session->set_userdata('customerregisterstart_date', $value);
			} else {
				$this->session->unset_userdata('customerregisterstart_date');
			}
		}

		if ($filter_type == 'end_date') {
			if ($value != "") {
				$this->session->set_userdata('customerregisterend_date', $value);
			} else {
				$this->session->unset_userdata('customerregisterend_date');
			}
		}
	}

	/*
    ** Reset filter listing via Session
    */
	public function reset()
	{
		$this->session->unset_userdata('customercity');
		$this->session->unset_userdata('customerloginstatus');
		$this->session->unset_userdata('customeractivestatus');
		$this->session->unset_userdata('customerregisterstart_date');
		$this->session->unset_userdata('customerregisterend_date');

		redirect('admin/customer');
	}

	/*
    ** Function for export the data
    */
	public function export()
	{
		$data['data_list'] = $this->customer_model->export();

		if (!empty($data['data_list'])) {
			$this->load->view($this->view_folder . 'report', $data);
		} else {
			$this->session->set_flashdata('error_msg', 'There is no data for export.');
			redirect('admin/customer');
		}
	}
}
