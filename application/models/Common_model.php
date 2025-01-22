<?php

class Common_model extends CI_Model
{
    public $s3 = array();

    function __construct()
    {
        parent::__construct();
    }

    /*
    ** Password encryption 
    ** 30-10-2018
    */
    public function encrypt_password($password)
    {
        $encrypt_value = openssl_encrypt($password, ENC_METHOD, KEY_256, 0, IV);
        return $encrypt_value;
    }

    /*
    ** Password decryption 
    ** 30-10-2018
    */
    public function decrypt_password($password)
    {
        $decrypt_value = openssl_decrypt($password, ENC_METHOD, KEY_256, 0, IV);
        return $decrypt_value;
    }

    /*
    ** Request encryption 
    ** 30-10-2018
    */
    public function aes_encrypt($request)
    {
        $encrypt_value = openssl_encrypt($request, ENC_METHOD, KEY_256, 0, IV);
        return $encrypt_value;
    }

    /*
    ** Request decryption 
    ** 30-10-2018
    */
    public function aes_decrypt($request)
    {
        $decrypt_value = openssl_decrypt($request, ENC_METHOD, KEY_256, 0, IV);
        return $decrypt_value;
    }


    /*
    ** Generate random integer OTP code of any length
    ** 16-10-2019
    */
    function RandomInteger($length)
    {
        $keys = array_merge(range(0, 9));
        $key = '';
        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
        return $key;
        // return '1234';
    }

    /*
    ** Generate random integer for user unique number
    ** 06-01-2023
    */
    function getTransactionID()
    {
        return uniqid() . rand(100000, 999999);
    }

    /*
    ** Generate random integer for user unique number
    ** 06-01-2023
    */
    function getUniqueAccountID()
    {
        return 'GARELA' . '' . rand(1000000000, 9000000000);
    }

    /*
    * Function to send mail
    */
    function send_mail($to, $subject, $message)
    {
        $this->load->library('email');

        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 587,
            'smtp_user' => SMTP_EMAIL,
            'smtp_pass' => SMTP_PASSWORD,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            "newline"   => "\r\n",
            'starttls'  => true,
            'smtp_crypto' => 'tls'
        );

        $this->email->set_crlf("\r\n");
        $this->email->initialize($config);
        $this->email->from(SMTP_EMAIL, PROJECT_NAME);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->set_header('X-Priority', '1');
        if ($this->email->send()) {
            return true;
        } else {
            echo "<pre>";
            print_r("<b>Sorry for this, we are testing mail service now..</b><br>");
            echo $this->email->print_debugger();
            die;
            return false;
        }
    }

    function getAppContent($type, $user_type)
    {
        return $this->db->get_where('tbl_app_content', array("page_name" => $type, "user_type" => $user_type))->row_array();
    }

    function updateAppContent($id, $params)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_app_content', $params);
    }


    function get_category($id)
    {
        return $this->db->get_where('tbl_master_category', array("id" => $id))->row_array();
    }

    /*
    * Get Menu set
    */
    function get_menu($menu)
    {
        if ($menu == $this->uri->segment(2)) {
            return "active " . $this->uri->segment(2);
        } else {
            return "has-submenu";
        }
    }

    /*
    * Get Menu set
    */
    function get_submenu($menu)
    {
        $menuname = "";
        $filename = $this->uri->segment(3);
        $tmp = stripos($filename, $menu);
        if ($tmp === 0) {
            $menuname = "active";
        } else {
            $menuname = "has-submenu";
        }
        return  $menuname;
    }

    /*
    * Get Menu set
    */
    function get_submenu_list($menu)
    {
        $menuname = "";
        $filename = $this->uri->segment(3);
        // $tmp = stripos($filename, $menu);
        if (in_array($filename, $menu)) {
            $menuname = "active";
        } else {
            $menuname = "has-submenu";
        }
        return  $menuname;
    }

    /*
    * Date convert on specific timezone. 
    */
    function dateConvertToTimezone($date, $dateformat, $timezone = NULL)
    {
        // echo $timezone;die;
        $timezone = !empty($timezone) ? $timezone : 'UTC';
        if ($date == '0000-00-00 00:00:00')
            return $date;

        $date = new DateTime($date);
        $date->setTimezone(new DateTimeZone($timezone));
        return $date->format($dateformat);
    }

    /*
    ** Function to get any time in UTC format
    */
    function convertTimetoUTC($datetime, $dateformat, $defaulttimezone)
    {
        if ($datetime == '0000-00-00 00:00:00') {
            return $datetime;
        } else {
            date_default_timezone_set($defaulttimezone);
            $conversiondate = strtotime($datetime);
            date_default_timezone_set("UTC");
            $finaldate = date($dateformat, $conversiondate);
            return $finaldate;
        }
    }


    /*
    ** Date convert on specific UTC.
    */
    function dateconverttoUTC($date, $dateformat, $fromtimezone)
    {
        if ($date == '0000-00-00 00:00:00')
            return $date;

        $date = new DateTime($date, new DateTimeZone($fromtimezone));
        $date->setTimezone(new DateTimeZone('UTC'));
        return $date->format($dateformat);
    }

    /*
    ** Common function to get country list
    ** 23-08-2022
    */
    function getCountriesList()
    {
        $this->db->select("*, id as country_id")->from('tbl_country');
        $this->db->where('calling_code !=', '');
        $this->db->where('is_active', '1');
        $this->db->where('is_deleted', '0');
        $this->db->order_by('sortname', 'asc');
        return $this->db->get()->result_array();
    }

    /*
    ** Common function to get country list
    ** 23-08-2022
    */
    function getList($table)
    {
        $this->db->select("*")->from($table);
        $this->db->where('is_active', '1');
        $this->db->where('is_deleted', '0');

        $this->db->order_by('name', 'asc');
        return $this->db->get()->result_array();
    }

    /*
    ** Common function to get country list
    ** 23-08-2022
    */
    function getPostCode()
    {
        $this->db->select("DISTINCT(post_code)")->from('tbl_parking_area');
        $this->db->where('is_active', '1');
        $this->db->where('is_deleted', '0');
        $this->db->order_by('post_code', 'asc');
        return $this->db->get()->result_array();
    }

    /*
    ** Common function to select raw array
    ** 23-08-2022
    */
    function common_singleSelect($tablename, $where)
    {
        $query =  $this->db->get_where($tablename, $where)->row_array();
        //echo "<pre>";print_r($query);die;
        return $query;
    }

    /*
    ** Common function to select result array
    ** 23-08-2022
    */
    public function common_multipleSelect($tablename, $where)
    {
        $query =  $this->db->get_where($tablename, $where)->result_array();
        //echo "<pre>";print_r($query);die;
        return $query;
    }

    /*
    ** Common function to update
    ** 23-08-2022
    */
    function common_singleUpdate($tablename, $params, $where)
    {
        $this->db->update($tablename, $params, $where);
        //$jw = $this->db->affected_rows();
        return $this->db->affected_rows();
    }

    /*
    ** Function to insert batch into specific table 
    */
    function common_singleInsert($table, $params)
    {
        $this->db->insert($table, $params);
        return $this->db->insert_id();
    }

    /*
    ** Function for common delete
    ** 23-01-2019
    */
    function common_singleDelete($tablename, $where)
    {
        $this->db->where($where);
        $this->db->delete($tablename);
        // echo "<pre>";print_r($this->db->last_query()); 
    }

    /*
    ** Function to get data from specific table
    */
    function get_tbl_rowdata_by_params($table, $select)
    {
        $this->db->select($select);
        $this->db->from($table);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return array();
        }
    }

    /*
    ** Function to get data from specific table with condition
    */
    function get_singleData($table, $where)
    {
        $this->db->from($table);
        $this->db->where($where);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    /*
    ** Function to get data from specific table with condition
    */
    function get_multipleData($table, $where)
    {
        $this->db->from($table);
        $this->db->where($where);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    /*
    ** Function to add data into specific table
    */
    function add_data($table, $params)
    {
        $this->db->insert($table, $params);
        // echo "<pre>"; print_r($this->db->last_query()); die;
        $insertId = $this->db->insert_id();

        return $insertId;
    }

    /*
    ** Function to update data into specific table
    */
    function update_data($table, $where, $params)
    {
        $this->db->where($where);
        $this->db->update($table, $params);
        // echo "<pre>"; print_r($this->db->last_query()); die;
        return $this->db->affected_rows();
    }

    /*
    ** Function to insert batch into specific table 
    */
    function common_insertbatch($table, $params)
    {
        $this->db->insert_batch($table, $params);
        return $this->db->insert_id();
    }


    /*
    ** Function for generate random password
    */
    public function randomPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890@#';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 15; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        // return uniqid() . implode($pass); //turn the array into a string
        return  implode($pass); //turn the array into a string
    }

    /*
    ** function to get count
    */
    public function count($table, $where)
    {
        $this->db->select('count(id) as count');
        $this->db->from($table);
        $this->db->where($where);

        $query = $this->db->get();
        // echo "<pre>"; print_r($this->db->last_query());die;

        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            return $result['count'];
        } else {
            return 0;
        }
    }

    /*
    ** Common function to get admin earning
    ** 23-08-2022
    */
    public function admin_earning($start_date, $end_date)
    {
        $this->db->select("IFNULL(SUM(pab.admin_earning), 0) AS admin_earning");
        $this->db->from('tbl_parking_area_booking AS pab');
        $this->db->join('tbl_local_authority AS la', 'la.id = pab.local_authority_id', 'left');
        $this->db->join('tbl_parking_area_booking_extend AS pabe', 'pabe.parking_area_booking_id = pab.id', 'left');
        $this->db->join('tbl_user AS u', 'u.id = pab.user_id', 'left');
        $this->db->join('tbl_parking_area AS pa', 'pa.id = pab.parking_area_id', 'left');
        $this->db->where("pab.status = 'Complete'");
        $this->db->where("pab.is_deleted = '0'");
        $this->db->where("pa.is_active = '1'");
        $this->db->where("pa.is_deleted = '0'");

        if ($start_date != "") {
            $this->db->where('DATE(pab.insert_datetime) >= ', $start_date);
        }

        if ($end_date != "") {
            $this->db->where('DATE(pab.insert_datetime) <= ', $end_date);
        }

        $paymentdata = $this->db->get()->row_array();

        return $paymentdata;
    }

    /*
    ** Common function to get admin earning
    ** 23-08-2022
    */
    public function localauthority_earning($start_date, $end_date, $localauthority_id)
    {
        $this->db->select("IFNULL(SUM(pab.admin_earning), 0) AS admin_earning");
        $this->db->from('tbl_parking_area_booking AS pab');
        $this->db->join('tbl_local_authority AS la', 'la.id = pab.local_authority_id', 'left');
        $this->db->join('tbl_parking_area_booking_extend AS pabe', 'pabe.parking_area_booking_id = pab.id', 'left');
        $this->db->join('tbl_user AS u', 'u.id = pab.user_id', 'left');
        $this->db->join('tbl_parking_area AS pa', 'pa.id = pab.parking_area_id', 'left');
        $this->db->where("pab.local_authority_id", $localauthority_id);
        $this->db->where("pab.status = 'Complete'");
        $this->db->where("pab.is_deleted = '0'");
        $this->db->where("pa.is_active = '1'");
        $this->db->where("pa.is_deleted = '0'");

        if ($start_date != "") {
            $this->db->where('DATE(pab.insert_datetime) >= ', $start_date);
        }

        if ($end_date != "") {
            $this->db->where('DATE(pab.insert_datetime) <= ', $end_date);
        }

        $paymentdata = $this->db->get()->row_array();

        return $paymentdata;
    }


    /*
    ** Function for Count Total Record
    */
    public function parking_total_record()
    {
        $this->db->select("pa.*");
        $this->db->from('tbl_parking_area AS pa');
        $this->db->join('tbl_local_authority AS la', 'la.id = pa.local_authority_id', 'left');
        $this->db->where("pa.is_deleted = '0'");
        $this->db->where("la.is_deleted = '0'");
        $this->db->where("la.is_active = '1'");
        return $this->db->count_all_results();
    }

    /*
    ** Function for Count Total Record
    */
    public function attendant_total_record()
    {
        $this->db->select('at.*');
        $this->db->from('tbl_attendant AS at');
        $this->db->join('tbl_local_authority AS la', 'la.id = at.local_authority_id', 'left');
        $this->db->where("at.is_deleted = '0'");
        $this->db->where("la.is_deleted = '0'");
        return $this->db->count_all_results();
    }

    /*
    ** Function for Check Login for Admin
    */
    public function login($email)
    {
        return $this->db->get_where('tbl_admin', array('email' => $email))->row_array();
        // echo $this->db->last_query();die;
    }

    /*
    ** Function for Get User Details
    */
    public function getUserDetails($user_id)
    {
        $this->db->select("*, CONCAT(country_code, '  ', phone) AS contact_number");
        $this->db->from('tbl_user');
        $this->db->where('id', $user_id);
        // $this->db->where('user_type', 'User');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return  $query->row_array();
            // print_r($this->db->last_query());die;
        } else {
            return false;
        }
    }

    /*
    ** Function for get setting details
    */
    public function settingDetails()
    {
        $query = $this->db->get('tbl_setting');

        if ($query->num_rows() > 0) {
            $result = $query->result();
            $setting = array();

            foreach ($result as $item) {
                $setting[$item->title] = $item->value;
            }

            return $setting;
        } else {
            return false;
        }
    }

    public function api_call($url_slug, $data, $method, $temp_token = "")
    {
        if ($temp_token != "") {
            $token = "token:" . $this->aes_encrypt($temp_token);
        } else {
            $token = "token:" . $this->aes_encrypt($this->session->userdata("LOCALAUTHORITY_USER_TOKEN"));
        }

        // print_r($token);die;

        $user_lang = $this->session->userdata("LOCALAUTHORITY_USER_LANG");

        if (!empty($user_lang)) {
            $accept_language = ($user_lang == 'english') ? 'en' : 'fr';
        } else {
            $accept_language = 'en'; // Default to English if language is not set in the session.
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => API_URL . $url_slug,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $this->aes_encrypt(json_encode($data)),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: text/plain",
                "accept-language: " . $accept_language,
                "API-KEY: " . $this->aes_encrypt(API_KEY),
                $token
            ),
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo $err;
            print_r($err);
            // die;
            return array();
        } else {
            $output = $this->aes_decrypt($response);
            $output = json_decode($output, true);
            // echo "<pre>";
            // print_r($output);
            // die();
            if ($output['code'] == "-1") {

                $this->session->unset_userdata(LOCALAUTHORITY_SESSION);
                $this->session->unset_userdata('LOCALAUTHORITY_USER_TOKEN');
                $this->session->unset_userdata(LOCALAUTHORITY_TIMEZONE);
                $this->session->unset_userdata('LOCALAUTHORITY_USER_LANG');
                $this->session->set_flashdata('error_msg', $this->lang->line('rest_keywords_logged_in_on_another_device'), 3);

                redirect('local_authority/auth');
                return;
            } else {
            }
            return $output;
        }
    }

    public function admin_api_call($url_slug, $data, $method)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => API_URL . $url_slug,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $this->aes_encrypt(json_encode($data)),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: text/plain",
                "accept-language: en",
                "API-KEY: " . $this->aes_encrypt(API_KEY)
            ),
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);

        // echo "<pre>";
        // print_r($response);
        // die();

        if ($err) {
            echo $err;
            print_r($err);
            // die;
            return array();
        } else {
            $output = $this->aes_decrypt($response);
            $output = json_decode($output, true);
            // echo "<pre>";
            // print_r($output);die();
            if ($output['code'] == "-1") {
                redirect('admin/login');
                return;
            } else {
            }
            return $output;
        }
    }

    //get all controller name and path of admin panel
    public function get_all_Menu()
    {
        $this->db->select('*');
        $this->db->from('tbl_admin_menu');
        $this->db->where('is_active', 1);
        $this->db->where('menu_parent_id', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result;
        } else {
            return false;
        }
    }

    public function common_selectMultipleQuery($query)
    {
        return $this->db->query($query)->result_array();
    }

    //common Single select tabel details
    public function common_selectSingleQuery($query)
    {

        // print_r($query);die;
        return $this->db->query($query)->row_array();
    }

    // public function timeSince($date)
    // {
    //     if (!empty($date)) {

    //         //    $currdate = $this->date_convert(date('Y-m-d h:i:s'),ADMIN_LONGDATE,$this->session->userdata(WEBSITE_TIMEZONE));
    //         //    $currdate = date('Y-m-d h:i:s');
    //         $currdate = gmdate("Y-m-d H:i:s");  // for Utc use only date
    //         $timeFirst  = strtotime($date);
    //         $timeSecond = strtotime($currdate);
    //         //print_r($timeSecond);die;

    //         $seconds = $timeSecond - $timeFirst;
    //         // print_r($differenceInSeconds);die;
    //         // $seconds = floor((strtotime(date('Y-m-d h:i:s')) - strtotime($date)) / 1000);

    //         $interval = $seconds / 31536000;
    //         if ($interval > 1) {
    //             return "Updated " . (string) floor($interval) . " Years ago";
    //         }
    //         $interval = $seconds / 2592000;
    //         if ($interval > 1) {
    //             return "Updated " . (string) floor($interval)  . " Months ago";
    //         }
    //         $interval = $seconds / 86400;
    //         if ($interval > 1) {
    //             return "Updated " . (string) floor($interval) . " Days ago";
    //         }
    //         $interval = $seconds / 3600;
    //         if ($interval > 1) {
    //             return "Updated " . (string) floor($interval) . " Hours ago";
    //         }

    //         $interval = $seconds / 60;

    //         if ($interval > 1) {
    //             return "Updated " . (string) floor($interval) . " Minutes ago";
    //         }

    //         return "Updated " . (string) floor($seconds) . " Second ago";
    //     }
    // }

    public function get_time_since($date)
    {
        $utc_datetime = new DateTime($date);

        $now = new DateTime();

        $interval = $now->diff($utc_datetime);

        if ($interval->y > 0) {
            return $interval->format('%y Years ago'); // 2 years ago
        } elseif ($interval->m > 0) {
            return $interval->format('%m Months ago'); // 2 months ago
        } elseif ($interval->d > 0) {
            return $interval->format('%d Days ago'); // 2 days ago
        } elseif ($interval->h > 0) {
            return $interval->format('%h Hours ago'); // 2 hours ago
        } elseif ($interval->i > 0) {
            return $interval->format('%i Minutes ago'); // 22 mins ago
        } else {
            return $interval->format('%s Seconds ago'); // 30 seconds ago
        }
    }

    public function get_time_difference($park_out_time, $extended_park_out_time)
    {
        // Convert the strings to DateTime objects
        $park_outtime = new DateTime($park_out_time);
        $extended_park_outtime = new DateTime($extended_park_out_time);

        $interval = $park_outtime->diff($extended_park_outtime);
        $days = $interval->format('%a');
        $hours = $interval->format('%h');
        $minutes = $interval->format('%i');

        $output = '';

        if ($days > 0) {
            $output .= "{$days} day";
            if ($days > 1) {
                $output .= 's';
            }
            $output .= ' ';
        }

        if ($hours > 0) {
            $output .= "{$hours} hour";
            if ($hours > 1) {
                $output .= 's';
            }
            $output .= ' ';
        }

        if ($minutes > 0) {
            $output .= "{$minutes} minute";
            if ($minutes > 1) {
                $output .= 's';
            }
        }

        // if days or hour or minute is 0 then avoid  

        // return 20 min or 1 hour 20 min or 2 day 3 hour 20 min 

        // $interval = $now->diff($utc_datetime);

        // if ($interval->y > 0) {
        //     return $interval->format('%y Years ago'); // 2 years ago
        // } elseif ($interval->m > 0) {
        //     return $interval->format('%m Months ago'); // 2 months ago
        // } elseif ($interval->d > 0) {
        //     return $interval->format('%d Days ago'); // 2 days ago
        // } elseif ($interval->h > 0) {
        //     return $interval->format('%h Hours ago'); // 2 hours ago
        // } elseif ($interval->i > 0) {
        //     return $interval->format('%i Minutes ago'); // 22 mins ago
        // } else {
        //     return $interval->format('%s Seconds ago'); // 30 seconds ago
        // }
    }

    public function time_since($date)
    {
        $currdate = $this->dateConvertToTimezone(date('Y-m-d h:i:s'), DATABASE_DATETIME, $this->session->userdata(LOCALAUTHORITY_TIMEZONE));
        $timeFirst  = strtotime($date);
        $timeSecond = strtotime($currdate);


        $seconds = $timeSecond - $timeFirst;

        $interval = $seconds / 31536000;
        if ($interval > 1) {
            return (string) floor($interval) . " Years ago";
        }
        $interval = $seconds / 2592000;
        if ($interval > 1) {
            return (string) floor($interval)  . " Months ago";
        }
        $interval = $seconds / 86400;
        if ($interval > 1) {
            return (string) floor($interval) . " Days ago";
        }
        $interval = $seconds / 3600;
        if ($interval > 1) {
            return (string) floor($interval) . " Hours ago";
        }

        $interval = $seconds / 60;
        if ($interval > 1) {
            return (string) floor($interval) . " Minutes ago";
        }
        return (string) floor($seconds) . " Seconds ago";
    }

    public function difference_in_time($start_date, $end_date)
    {
        // Convert the strings to DateTime objects
        $date1 = new DateTime($start_date);
        $date2 = new DateTime($end_date);

        $difference = $date2->getTimestamp() - $date1->getTimestamp();

        $result = '';

        if ($difference >= 3600) {
            $hours = floor($difference / 3600);
            $difference %= 3600;
            $result .= $hours . ' hour' . ($hours > 1 ? 's ' : ' ');
        }

        if ($difference >= 60) {
            $minutes = floor($difference / 60);
            $difference %= 60;
            $result .= $minutes . ' minute' . ($minutes > 1 ? 's ' : ' ');
        }

        return $result;
    }

    //get all controller name with permisson and path of admin panel
    public function get_admin_menus($id)
    {
        $this->db->select('am.id,menu_page_title,controller_name,controller_path,menu_parent_id,menu_listed_in_menu');
        $this->db->from('tbl_admin_menu as am');
        $this->db->join('tbl_admin_user_permissions aup', 'aup.admin_menu_id = am.id');
        $this->db->where('aup.admin_id', $id);
        $this->db->where('aup.is_active', 1);
        $this->db->where('am.is_active', 1);
        $query = $this->db->get();
        // print_r($this->db->last_query());die;
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result;
        } else {
            return false;
        }
    }

    public function getchildmenu1($menu_id)
    {
        $this->db->select('id,menu_parent_id,menu_page_title');
        $this->db->from('tbl_admin_menu');
        $this->db->where("menu_parent_id", $menu_id);
        $this->db->where('is_active', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result;
        } else {
            return false;
        }
    }

    // get child ment of main menu
    public function getChildMenu($menu_id, $groupMenus, $num, $html)
    {
        $num++;
        $this->db->select('id,menu_parent_id,menu_page_title');
        $this->db->from('tbl_admin_menu');
        $this->db->where("menu_parent_id", $menu_id);
        $this->db->where('is_active', 1);
        $query = $this->db->get();
        $data_count = $query->num_rows();
        if ($data_count > 0) {
            $html = '';
            $res = $query->result_array();
            $html .= '<ul>';
            foreach ($res as $menu) {
                $checked = '';
                if (!empty($groupMenus)) {
                    if (in_array($menu['id'], $groupMenus)) {
                        $checked = "checked";
                    }
                }
                $style = '';
                if ($num == 2) {
                    $style = "margin-right:-10px";
                }
                if ($num == 3) {
                    $style = "margin-right:-10px";
                }
                if ($num == 4) {
                    $style = "margin-right: -10px";
                }

                $html .= '  <li class="page-row checkbox text-pink tier<?php echo $num; ?>">
                 <input type="checkbox" name="menu_id[]" id="' . $menu["id"] . '" value="' . $menu["id"] . '" ' . $checked . ' class="adm_menu dsbl_cl " style="float:right;margin-bottom:-22px;margin-top:8px;' . $style . '">
                 <label class="width100 adm_menu" for="' . $menu["id"] . '">
                     <span>' . $menu["menu_page_title"] . '</span>
                 </label>';
                $html .= $this->getChildMenu($menu['id'], $groupMenus, $num + 1, $html);
            }
            $html .= ' </li> </ul>';
        } else {
            return false;
        }
        return $html;
    }

    public function getChildMenuview($menu_id, $groupMenus, $num, $html)
    {
        $num++;
        $this->db->select('id,menu_parent_id,menu_page_title');
        $this->db->from('tbl_admin_menu');
        $this->db->where("menu_parent_id", $menu_id);
        $this->db->where('is_active', 1);
        $query = $this->db->get();
        $data_count = $query->num_rows();
        if ($data_count > 0) {
            $html = '';
            $res = $query->result_array();
            $html .= '<ul>';
            foreach ($res as $menu) {
                $checked = '';
                if (!empty($groupMenus)) {
                    if (in_array($menu['id'], $groupMenus)) {
                        $checked = "checked";
                    }
                }
                $style = '';
                if ($num == 2) {
                    $style = "margin-right:-10px";
                }
                if ($num == 3) {
                    $style = "margin-right:-18px";
                }
                if ($num == 4) {
                    $style = "margin-right: -26px";
                }

                $html .= '  <li class="page-row checkbox text-pink tier<?php echo $num; ?>">
                 <input type="checkbox" disabled="true" name="menu_id[]" id="' . $menu["id"] . '" value="' . $menu["id"] . '" ' . $checked . ' class="adm_menu dsbl_cl " style="float:right;margin-bottom:-22px;margin-top:8px;' . $style . '">
                 <label class="width100 adm_menu" for="' . $menu["id"] . '">
                     <span>' . $menu["menu_page_title"] . '</span>
                 </label>';
                $html .= $this->getChildMenu($menu['id'], $groupMenus, $num + 1, $html);
            }
            $html .= ' </li> </ul>';
        } else {
            return false;
        }
        return $html;
    }

    /*
      * Check menu exists or not
      */
    public function checkMenuexits($controller_path)
    {
        $this->db->select('id');
        $this->db->from('tbl_admin_menu');
        $this->db->where("controller_path", $controller_path);
        $this->db->where('is_active', 1);
        $query = $this->db->get();

        if ($query->num_rows() != 0) {
            return $query->row()->id;
        } else {
            return false;
        }
    }

    public function staff_sidemenu_permission($admin_id)
    {
        $this->db->select('class_name')->from('tbl_admin_permission');
        $this->db->where("admin_id", $admin_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $section_id = array();
            foreach ($query->result_array() as $key => $value) {
                $section_id[] = $value['class_name'];
            }
            return $section_id;
        } else {
            return array();
        }
    }

    /*
      *get Staff Permission
      */
    public function getStaffPermission($admin_id, $class_name)
    {
        $this->db->select('*')->from('tbl_admin_permission');
        $this->db->where('class_name', $class_name);
        $this->db->where("admin_id", $admin_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $section_data = $query->row_array();
            return $section_data;
        } else {
            return array();
        }
    }

    public function getAdminMenu($role, $admin_id, $menu_listed_in_menu)
    {

        if ($role == "S") {
            $this->db->select('id,menu_page_title,controller_name,controller_path,menu_listed_in_menu');
            $this->db->from('tbl_admin_menu');
            $this->db->where('is_active', 1);
            $this->db->where('menu_parent_id', 0);
            $this->db->where('menu_listed_in_menu', $menu_listed_in_menu);
            $query = $this->db->get();
            // print_r($this->db->last_query());die;
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
                $i = 0;
                foreach ($result as $menu) {
                    $menu_id = $menu['id'];
                    $this->db->select('id,menu_page_title,controller_name,controller_path,menu_listed_in_menu');
                    $this->db->from('tbl_admin_menu');
                    $this->db->where('is_active', '1');
                    $this->db->where('menu_parent_id', $menu_id);
                    $this->db->where('menu_listed_in_menu', $menu_listed_in_menu);
                    $subquery = $this->db->get();
                    if ($subquery->num_rows() > 0) {
                        $result[$i]["sub_menu"] = $subquery->result_array();
                    } else {
                        $result[$i]["sub_menu"] = array();
                    }
                    $i++;
                }
                return $result;
            } else {
                return false;
            }
        } else {
            $this->db->select('am.id,menu_page_title,controller_name,controller_path,menu_listed_in_menu');
            $this->db->from('tbl_admin_menu as am');
            $this->db->join('tbl_admin_user_permissions aup', 'aup.admin_menu_id = am.id');
            $this->db->where('aup.admin_id', $admin_id);
            $this->db->where('aup.is_active', 1);
            $this->db->where('am.is_active', 1);
            $this->db->where('am.menu_parent_id', 0);
            $this->db->where('am.menu_listed_in_menu', $menu_listed_in_menu);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
                $i = 0;
                foreach ($result as $menu) {
                    $menu_id = $menu['id'];
                    $this->db->select('am.id,am.menu_page_title,am.controller_name,am.controller_path,am.menu_listed_in_menu');
                    $this->db->from('tbl_admin_menu as am');
                    $this->db->join('tbl_admin_user_permissions aup', 'aup.admin_menu_id = am.id');
                    $this->db->where('aup.admin_id', $admin_id);
                    $this->db->where('aup.is_active', 1);
                    $this->db->where('am.is_active', 1);
                    $this->db->where('am.menu_parent_id', $menu_id);
                    $this->db->where('am.menu_listed_in_menu', $menu_listed_in_menu);
                    $subquery = $this->db->get();
                    if ($subquery->num_rows() > 0) {
                        $result[$i]["sub_menu"] = $subquery->result_array();
                    } else {
                        $result[$i]["sub_menu"] = array();
                    }
                    $i++;
                }
                return $result;
            } else {
                return false;
            }
        }
    }

    public function checkURLPermission($menu_id, $adm_user_id)
    {
        if ($adm_user_id != 0) {
            $this->db->select('id');
            $this->db->from('tbl_admin_user_permissions');
            $this->db->where('admin_id', $adm_user_id);
            $this->db->where('admin_menu_id', $menu_id);
            $this->db->where('is_active', 1);
            $this->db->where('is_deleted', 0);
            $query = $this->db->get();
            if ($query->num_rows() != 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    public function send_push($notifydata)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => API_BASE_URL . 'service/send_notification',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $this->common_model->aes_encrypt(json_encode($notifydata)),
            CURLOPT_HTTPHEADER => array(
                'api-key: ' . $this->common_model->aes_encrypt(API_KEY),
                'accept-language: en',
                'Content-Type: text/plain'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        if (!empty($response)) {
            return json_decode($this->common_model->aes_decrypt($response));
        } else {
            return array();
        }
    }

    function send_gcm_notification_customer($registatoin_ids, $message)
    {
        // Set POST variables
        //$url = 'https://android.googleapis.com/gcm/send';
        $url = 'https://fcm.googleapis.com/fcm/send';

        //https://fcm.googleapis.com/fcm/send

        $fields = array(
            'registration_ids' => array($registatoin_ids),
            'data' => $message
        );

        $headers = array(
            'Authorization: key=',
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);

        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
        //echo "+++++++++++++++||||";
        //var_dump($result);
        return;
    }

    function send_customer_notification_ios($payload, $device_tokens)
    {
        $development = true;
        $Production = true;
        $payload = json_encode($payload);

        $apns_url = NULL;
        $apns_cert = NULL;

        $apns_url1 = NULL;
        $apns_cert1 = NULL;

        $apns_port = 2195;

        if ($development) {
            $apns_url = 'gateway.sandbox.push.apple.com';

            $apns_cert = './assets/pem/Customer/development.pem';

            //print_r($apns_cert);

            $stream_context = stream_context_create();
            stream_context_set_option($stream_context, 'ssl', 'local_cert', $apns_cert);
            stream_context_set_option($stream_context, 'ssl', 'passphrase', "hyperlink");

            $apns = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context);

            if (!$apns) {
                //print "Failed to connect \n";
                //exit;
                $success_connection = 0;
            } else {
                //echo "ok";
                $success_connection = 1;
            }

            if ($device_tokens) {
                $apns_message = chr(0) . chr(0) . chr(32) . pack('H*', str_replace(' ', '', $device_tokens)) . chr(0) . chr(strlen($payload)) . $payload;
                fwrite($apns, $apns_message);
                // var_dump($apns_message);die();
            }
        }
        /*----------Production--------------*/
        if ($Production) {
            $apns_url1 = 'gateway.push.apple.com';

            $apns_cert1 = './assets/pem/Production_apns.pem';


            //print_r($apns_cert1);
            $stream_context1 = stream_context_create();
            stream_context_set_option($stream_context1, 'ssl', 'local_cert', $apns_cert1);
            stream_context_set_option($stream_context1, 'ssl', 'passphrase', "hyperlink");

            $apns1 = stream_socket_client('ssl://' . $apns_url1 . ':' . $apns_port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context1);

            if (!$apns1) {
                //print "Failed to connect \n";
                //exit;
                $success_connection = 0;
            } else {
                //echo "ok";
                $success_connection = 1;
            }


            if ($device_tokens) {
                $apns_message = chr(0) . chr(0) . chr(32) . pack('H*', str_replace(' ', '', $device_tokens)) . chr(0) . chr(strlen($payload)) . $payload;
                fwrite($apns1, $apns_message);
                //var_dump($apns_message);die();
            }
        }
        @socket_close($apns);
        @fclose($apns);
        return;
        // END CODE FOR PUSH NOTIFICATIONS TO ALL USERS
    }
}
