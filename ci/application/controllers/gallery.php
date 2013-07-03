<?php
class Gallery extends CI_Controller {

    function __construct() 
    {
        parent::__construct();
        $CI =& get_instance();
        $status = $CI->session->userdata('status');
        if ($status === "banned") {
            redirect('login/banned');
        }      
    }

    function pic($str = NULL) 
    {
        if (isset($str))
        {
            $CI =& get_instance();
            $is_logged_in = $CI->session->userdata('is_logged_in');
            $this->load->model('Gallery_model');
            $pic['picture'] = $this->Gallery_model->get_pic($str);
            if (isset($pic['picture'])) {
                if (isset($is_logged_in) && $is_logged_in === true)
                {
                    $this->load->view('picture_logged', $pic);   
                }
                else
                {
                    $this->load->view('picture', $pic);
                }
            }
            else
            {
                redirect('');
            }            
        }
        else
        {
            redirect(''); 
        }
	}

    function user($str = NULL)
    {
        if (isset($str))
        {
            $CI =& get_instance();
            $is_logged_in = $CI->session->userdata('is_logged_in');
            $this->load->model('Gallery_model');
            $this->load->library('pagination');
            $config['base_url'] = "http://localhost:8080/ci/user/" . $str;
            $config['total_rows'] = $this->Gallery_model->user_pic_count($str);
            $config['per_page'] = 15;
            $config['num_links'] = 2;
            $this->pagination->initialize($config);
            $profile['userPics'] = $this->Gallery_model->get_user_images($str, $config['per_page'], $this->uri->segment(3));
            $profile['username'] = $this->Gallery_model->get_user_name($str);
            if (empty($profile['username']))
            {
                redirect('');
            }
            if (isset($is_logged_in) && $is_logged_in === true)
            {
                $this->load->view('user', $profile);   
            }
            else
            {
                $this->load->view('user_unlogged', $profile);
            }
            // $this->load->view('user', $profile);
        }
        else
        {
            redirect('');
        }
    }

}