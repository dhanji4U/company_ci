<?php defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(E_ERROR);
class Countries extends MY_Controller
{
	private $view_folder = 'admin/countries/';

	public function __construct()
	{
		parent::__construct();

		$this->load->model('countries_model');
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
		$list = $this->countries_model->get_datatables();

		$data = array();

		foreach ($list as $row_data) {

			$row_data['flag'] = '<a href="' . $row_data['flag'] . '" class="d-flex image-popup justify-content-center"><img class="img-responsive img-thumbnail rounded-circle" src=' . $row_data['flag'] . '  alt="No-image" style="height: 60px ! important; width: 60px ! important;"></a>';
			
			if ($row_data['is_active'] == '0') {
				$status = '<a href="javascript:;" onclick="change_state(`' . $row_data['id'] . '`,1);"  class="badge badge-red bg-red">Inactive</a >';
			} else {
				$status = '<a href="javascript:;" onclick="change_state(`' . $row_data['id'] . '`,0);" class="badge badge-green bg-green">Active</a >';
			}

			$action = "";

			$action = '<div><a style="margin-bottom:5px; width: 17px" href="' . site_url() . 'admin/countries/view/' . base64_encode($row_data['id']) . '" class="btn btn-custom waves-effect" title="View"><i class="zmdi zmdi-eye"></i></a></div>';

			$action .= '<div><a style="margin-bottom:5px; width: 17px" href="' . site_url() . 'admin/countries/edit/' . base64_encode($row_data['id']) . '" class="btn btn-custom waves-effect" title="Edit"><i class="zmdi zmdi-edit"></i></a></div>';

			$action .= '<div><a style="margin-bottom:5px; width: 17px" href="javascript:;" onclick="remove(`' . $row_data['id'] . '`,1);" class="btn btn-custom waves-effect"  title="Delete"><i class="zmdi zmdi-delete"></i></a></div>';

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

			$row_data['status'] = $status;
			$row_data['action'] = $action;
			$data[] = $row_data;
		}

		$output = array(

			"draw" => isset($_REQUEST['draw']) ? $_REQUEST['draw'] : 0,
			"recordsTotal" => $this->countries_model->total_record(),
			"recordsFiltered" => $this->countries_model->count_filtered(),
			"data" => $data,
			"token" => $this->security->get_csrf_hash() // New token hash
		);
		//output to json format
		echo json_encode($output);
	}

	/*
    ** Function for Change State
    */
	public function change_state($country_id, $state)
	{
		if (!$this->uri->segment(4) && !$this->uri->segment(5)) {
			echo json_encode(array('code' => '0', 'message' => $this->lang->line('rest_keywords_somethingwent_wrong')));
			die;
		}

		$this->common_model->common_singleUpdate("tbl_country", array('is_active' => $state), strpos($country_id, ",") !== false ? "id IN (" . $country_id . ")" : "id = '" . $country_id . "'");

		$lang_message = $this->lang->line('rest_keywords_country_' . ($state == '1' ? 'active' : 'inactive') . '_success');

		echo json_encode(array('code' => '1', 'message' => $lang_message));
		die;
	}

	/*
    ** Function for Remove (Soft Delete)
    */
	public function delete($country_id)
	{
		$this->common_model->common_singleUpdate("tbl_country", array('is_deleted' => '1'), strpos($country_id, ",") !== false ? "id IN (" . $country_id . ")" : "id = '" . $country_id . "'");

		echo json_encode(array('code' => '1', 'message' => $this->lang->line('rest_keywords_country_delete_success')));
		die;
	}


	/*
    ** Function for Add
    */
	public function add()
	{
		if ($this->input->post()) {

			$this->form_validation->set_rules('name', 'Country Name', 'required');
			$this->form_validation->set_rules('nationality', 'Nationality', 'required');
			$this->form_validation->set_rules('sortname', 'Sortname', 'required');
			$this->form_validation->set_rules('calling_code', 'Country Code', 'required');
			$this->form_validation->set_rules('currency_code', 'Currency Code', 'required');
			$this->form_validation->set_rules('currency_name', 'Currency Name', 'required');
			$this->form_validation->set_rules('currency_symbol', 'Currency Symbol', 'required');
			$this->form_validation->set_rules('language', 'Language', 'required');
			$this->form_validation->set_error_delimiters('<div class="error" style="color:#F44336;">', '</div>');

			if ($this->form_validation->run()) {

				$response = $this->common_model->s3BucketSingleImage($_FILES['flag'], COUNTRIES_IMAGE);

				if (isset($response['error'])) {
					$this->load->view($this->view_folder . 'add', array('error' => $response['error']));
				} else {
					$params = array(
						'name' 					=> $this->input->post('name'),
						'nationality' 			=> $this->input->post('nationality'),
						'sortname' 				=> $this->input->post('sortname'),
						'calling_code' 			=> $this->input->post('calling_code'),
						'currency_code' 		=> $this->input->post('currency_code'),
						'currency_name' 		=> $this->input->post('currency_name'),
						'currency_symbol' 		=> $this->input->post('currency_symbol'),
						'language'		 		=> $this->input->post('language'),
						'flag' 					=> $response
					);

					$country_id = $this->common_model->add_data('tbl_soap', $params);

					$this->session->set_flashdata('success_msg', $this->lang->line('rest_keywords_country_add_success'));

					redirect('admin/countries');
				}
			} else {
				$this->load->view($this->view_folder . 'add');
			}
		} else {
			$this->load->view($this->view_folder . 'add');
		}
	}

	/*
    ** Function for update the details
    */
	public function edit()
	{
		$country_id = base64_decode($this->uri->segment(4));
		$data['result'] = $this->common_model->common_singleSelect('tbl_country', array('id' => $country_id));

		if ($this->input->post()) {

			$this->form_validation->set_rules('name', 'Country Name', 'required');
			$this->form_validation->set_rules('nationality', 'Nationality', 'required');
			$this->form_validation->set_rules('sortname', 'Sortname', 'required');
			$this->form_validation->set_rules('calling_code', 'Country Code', 'required');
			$this->form_validation->set_rules('currency_code', 'Currency Code', 'required');
			$this->form_validation->set_rules('currency_name', 'Currency Name', 'required');
			$this->form_validation->set_rules('currency_symbol', 'Currency Symbol', 'required');
			$this->form_validation->set_rules('language', 'Language', 'required');
			$this->form_validation->set_error_delimiters('<div class="error" style="color:#F44336;">', '</div>');

			if ($this->form_validation->run()) {
				$params = array(
					'name' 					=> $this->input->post('name'),
					'nationality' 			=> $this->input->post('nationality'),
					'sortname' 				=> $this->input->post('sortname'),
					'calling_code' 			=> $this->input->post('calling_code'),
					'currency_code' 		=> $this->input->post('currency_code'),
					'currency_name' 		=> $this->input->post('currency_name'),
					'currency_symbol' 		=> $this->input->post('currency_symbol'),
					'language'		 		=> $this->input->post('language')
				);

				$response = @$data['result']['flag'];
				if (!empty($_FILES['flag']) && $_FILES['flag']['size'] > 0) {
					$response = $this->common_model->s3BucketSingleImage($_FILES['flag'], COUNTRIES_IMAGE);
					if (!$response) {
						$data['error_msg'] = $this->lang->line('adminpanel_message_image_upload_failed');
						$this->load->view($this->view_folder . 'edit', $data);
						return false;
					} else {
						$params['flag'] = $response;
					}
				}

				$this->common_model->update_data('tbl_country', array('id' => $this->input->post('country_id')), $params);

				$this->session->set_flashdata('success_msg', $this->lang->line('rest_keywords_country_update_success'));

				redirect('admin/countries');
			} else {
				$this->load->view($this->view_folder . 'edit', $data);
			}
		} else {
			// echo "<pre>";print_r($data);die;
			$this->load->view($this->view_folder . 'edit', $data);
		}
	}


	/*
    ** Particular View Details
    */
	public function view()
	{
		if (!$this->uri->segment(4)) {
			redirect('admin/countries ');
		}

		$country_id = base64_decode($this->uri->segment(4));

		$data['result'] = $this->common_model->common_singleSelect('tbl_country', array('id' => $country_id));

		$this->load->view($this->view_folder . 'view', $data);
	}
}
