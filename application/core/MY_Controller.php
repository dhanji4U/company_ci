<?php defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends MX_Controller
{
    public $CI;

    protected $data = array();

    /**
     * [__construct description]
     *
     * @method __construct
     */
    public function __construct()
    {
        // To inherit directly the attributes of the parent class.
        parent::__construct();

        // This function returns the main CodeIgniter object.
        // Normally, to call any of the available CodeIgniter object or pre defined library classes then you need to declare.
        $CI = &get_instance();

        // Copyright year calculation for the footer
        $begin = 2023;
        $end =  date("Y");
        $date = "$begin - $end";

        // Copyright
        $this->data['copyright'] = $date;

        // if ($this->uri->segment(1) == 'admin') {

        //     if (!$this->session->has_userdata(ADMIN_SESSION_NAME) || $this->session->userdata(ADMIN_SESSION_NAME) == '') {

        //         $allowed_method = $this->uri->segment(2);

        //         if (!empty($allowed_method) && !in_array($allowed_method, array('login'))) {

        //             redirect('admin/login', 'refresh');
        //         }
        //     }
        // }

    }

}
