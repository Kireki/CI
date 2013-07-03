<?php

class Staff extends CI_Controller 
{

    function __construct() {
        parent::__construct();
        $CI =& get_instance();
        $is_logged_in = $CI->session->userdata('is_logged_in');
        $role = $CI->session->userdata('role');
        if(!isset($is_logged_in) || $is_logged_in != true || $role === "R")
        {
            redirect('');    
        }        
    }

    function manage($str)
    {
        if (isset($str) && $str !== '')
        {
            $this->load->model('Gallery_model');
            $this->load->model('Membership_model');
            $this->load->library('pagination');
            $config['base_url'] = "http://localhost:8080/ci/staff/manage/" . $str;
            $config['total_rows'] = $this->Gallery_model->user_pic_count($str);
            $config['per_page'] = 15;
            $config['num_links'] = 2;
            $config['uri_segment'] = 4;
            $this->pagination->initialize($config);
            $profile['userPics'] = $this->Gallery_model->get_user_images($str, $config['per_page'], $this->uri->segment(4));
            $profile['user'] = $this->Membership_model->getInfo($str);
            if (!empty($profile['userPics']) && !empty($profile['user'])) {
                $this->load->view('moderation', $profile);
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

    function ban($str)
    {
        $this->load->model('Membership_model');
        $this->Membership_model->ban_user($str);
        redirect('staff/manage/' . $str);
    }

    function unban($str)
    {
        $this->load->model('Membership_model');
        $this->Membership_model->unban_user($str);
        redirect('staff/manage/' . $str);
    }

    function delete_user($str)
    {
        $this->load->model('Membership_model');
        $this->Membership_model->clean($str);
        redirect('');
    }
}