<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(E_ERROR);

class Home extends MY_Controller
{

    /* ===========================================================================================================================================================  */
    /* **************************************************************         Customer CMS Page          *********************************************************  */
    /* ===========================================================================================================================================================  */

    /*
    ** Function for get Customer Terms & Conditions
    */
    public function customer_terms_conditions($language = 'en')
    {
        $data['language'] = $language;
        $data['result'] = $this->db->get_where('tbl_app_content', array("page_name" => "customer_terms_conditions", "user_type" => "Customer"))->row_array();
        // print_r($data);die;
        $this->load->view('pages/terms_and_condition', $data);
    }

    /*
    ** Function for get Customer About Us
    */
    public function customer_about_us($language = 'en')
    {
        $data['language'] = $language;
        $data['result'] = $this->db->get_where('tbl_app_content', array("page_name" => "customer_about_us", "user_type" => "Customer"))->row_array();
        // print_r($data);die;
        $this->load->view('pages/about_us', $data);
    }

    /*
    ** Function for get Customer Privacy Policy
    */
    public function customer_privacy_policy($language = 'en')
    {
        $data['language'] = $language;
        $data['result'] = $this->db->get_where('tbl_app_content', array("page_name" => "customer_privacy_policy", "user_type" => "Customer"))->row_array();
        // print_r($data);die;
        $this->load->view('pages/privacy_policy', $data);
    }

    /*
    ** Function to load forgot password page for User
    */
    function forgotpassword()
    {
        if (!empty($this->uri->segment(3)) && !empty($this->uri->segment(4))) {

            $user_type          = base64_decode($this->uri->segment(3));
            $user_token         = base64_decode($this->uri->segment(4));

            $result = $this->common_model->common_singleSelect("tbl_user", array("forgot_password_token" => $user_token, 'is_deleted' => '0'));

            // if user details not found based on ID
            if (!empty($result)) {
                if ($result['forgot_password_datetime'] >= date("Y-m-d H:i:s", strtotime('-1 days')) && $result['forgot_password_token'] != "") {
                    $data = array(
                        'user_id'       => $result['id'],
                        'user_type'     => $user_type,
                        'user_token'    => $user_token
                    );
                    $this->load->view('template/forgot_password', $data);
                } else {
                    $this->session->set_flashdata('error_msg', $this->lang->line('rest_keywords_passwordreset_linkexpired'));
                    redirect('home/failure');
                }
            } else {
                $this->session->set_flashdata('error_msg', $this->lang->line('rest_keywords_user_detailsnotfound'));
                redirect('home/failure');
            }
        } else {
            $this->session->set_flashdata('error_msg', $this->lang->line('rest_keywords_somethingwent_wrong'));
            redirect('home/failure');
        }
    }

    /*
    ** Function to check validations and update password
    */
    function changepassword()
    {
        //echo "changepassword";die;
        $data = array();
        if (!empty($this->input->post())) {

            $this->form_validation->set_rules('user_id', 'User ID', 'required|trim');
            $this->form_validation->set_rules('user_type', 'User Type', 'required|trim');
            $this->form_validation->set_rules('password', "Password", 'required|trim');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|matches[password]');
            if ($this->form_validation->run()) {

                $result = $this->common_model->common_singleSelect('tbl_user', array("id" => $this->input->post('user_id'), 'is_deleted' => '0'));

                // if user details not found based on ID
                if (!empty($result)) {
                    if ($result['forgot_password_datetime'] >= date("Y-m-d H:i:s", strtotime('-1 days')) && $result['forgot_password_token'] != "") {
                        if ($this->common_model->decrypt_password($result['password']) != $this->input->post('password')) {

                            // Encrypt the new password for updation
                            $password_upd = $this->common_model->encrypt_password($this->input->post('password'));

                            // update data
                            $this->common_model->common_singleUpdate('tbl_user', array('password' => $password_upd, 'forgot_password_token' => ''), array("id" => $result['id']));

                            $this->session->set_flashdata('success_msg', $this->lang->line('rest_keywords_password_change_success'));
                            redirect('home/success');
                        } else {
                            $this->session->set_flashdata('error_msg', $this->lang->line('rest_keywords_cannot_reuse_oldpassword'));
                            $data['user_id']        = $this->input->post('user_id');
                            $data['user_type']      = $this->input->post('user_type');
                            $this->load->view('template/forgot_password', $data);
                        }
                    } else {
                        $this->session->set_flashdata('error_msg', $this->lang->line('rest_keywords_passwordreset_linkexpired'));
                        redirect('home/failure');
                    }
                } else {
                    $this->session->set_flashdata('error_msg', $this->lang->line('rest_keywords_detailsnotfound'));
                    redirect('home/failure');
                }
            } else {
                $data['user_id']        = $this->input->post('user_id');
                $data['user_type']      = $this->input->post('user_type');
                $this->load->view('template/forgot_password', $data);
            }
        } else {
            $this->session->set_flashdata('error_msg', $this->lang->line('rest_keywords_passwordreset_linkexpired'));
            redirect('home/failure');
        }
    }

    /*
    ** Error page for whole project
    */
    function failure()
    {
        $this->load->view('template/successfailure');
    }

    /*
    ** Success page for whole project
    */
    function success()
    {
        $this->load->view('template/successfailure');
    }
}
