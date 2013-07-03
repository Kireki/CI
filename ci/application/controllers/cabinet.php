<?php

class Cabinet extends CI_Controller {

    function __construct() {
        parent::__construct();
        $CI =& get_instance();
        $is_logged_in = $CI->session->userdata('is_logged_in');
        $status = $CI->session->userdata('status');
        if ($status === "banned") {
            redirect('login/banned');
        }
        if(!isset($is_logged_in) || $is_logged_in != true)
        {
            redirect('login/signup');    
        }        
    }

    function index() 
    {
        $this->load->model('Gallery_model');
        $this->load->library('pagination');
        $config['base_url'] = "http://localhost:8080/ci/cabinet/index";
        $config['total_rows'] = $this->Gallery_model->user_pic_count($this->session->userdata('username'));
        $config['per_page'] = 15;
        $config['num_links'] = 2;
        $this->pagination->initialize($config);
        $data['images'] = $this->Gallery_model->get_user_images($this->session->userdata('username'), $config['per_page'], $this->uri->segment(3));
        $this->load->view('cabinet', $data);
    }

    function regularUpload() {

        $this->load->model('Gallery_model');
        if($this->input->post('upload'))
        {
            $this->Gallery_model->do_user_upload();
        }
        redirect('cabinet');
    }

    function editProfile() {

        $this->load->view('editProfile');

    }

    function changePass() 
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('oldPass', 'old password', 'required|callback_old_pass_check');
        $this->form_validation->set_rules('newPass', 'new password', 'trim|required|min_length[6]|max_length[32]|md5|callback_dont_match');
        $this->form_validation->set_rules('newPass2', 'new password confirmation', 'trim|required|matches[newPass]|md5');

        if($this->form_validation->run() === FALSE)
        {
            $this->editProfile();
        }
        else
        {
            $this->load->model('membership_model');
            if ($query = $this->membership_model->changePass()) 
            {
                $this->session->sess_destroy();
                redirect('login');
            }
            else
            {
                $this->editProfile();
            }
        }
    }

    public function old_pass_check()
    {
        $oldPass = md5($_POST['oldPass']);
        $this->load->model('Membership_model');
        $userInfo = $this->Membership_model->getInfo($this->session->userdata('username'));
        if ($oldPass !== $userInfo->password)
        {
            $this->form_validation->set_message('old_pass_check', 'The old password is incorrect.');
            return false;
        }
        else
        {
            return true;
        }        
    }

    function dont_match()
    {
        $oldPass = $_POST['oldPass'];
        $newPass = $_POST['newPass'];
        if ($oldPass === $newPass)
        {
            $this->form_validation->set_message('dont_match', 'The new password must be different.');
            return false;
        }
        else
        {
            return true;
        }
    }

    function delete()
    {
        $this->load->model('Gallery_model');
        $this->load->library('pagination');
        $config['base_url'] = "http://localhost:8080/ci/cabinet/delete";
        $config['total_rows'] = $this->Gallery_model->user_pic_count($this->session->userdata('username'));
        $config['per_page'] = 12;
        $config['num_links'] = 2;
        $this->pagination->initialize($config);
        $data['images'] = $this->Gallery_model->get_user_images($this->session->userdata('username'), $config['per_page'], $this->uri->segment(3));
        $this->load->view('delete', $data);
    }

    function delete_pic($str)
    {
        $this->load->model('Gallery_model');
        $pic = $this->Gallery_model->get_pic($str);
        if (is_object($pic) && ($pic->uploader === $this->session->userdata('username') || $this->session->userdata('role') !== "R")) {
            $this->Gallery_model->delete($str);
            if ($this->session->userdata('role') !== "R") {
                redirect('staff/manage/' . $pic->uploader);
            }
            else
            {
                redirect('cabinet/delete');
            }
            
        }
        else
        {
            redirect('cabinet/delete');
        }
    }

    function search()
    {
        $this->load->view('user_search');
    }

    function find_user()
    {
        $user = $this->input->post('username');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'username', 'required|callback_user_check');

        if($this->form_validation->run() === FALSE)
        {
            $this->search();
        }
        else
        {
            if (isset($user))
            {
                redirect('gallery/user/' . $this->input->post('username'));
            }
            else
            {
                $this->search();
            }
        }

    }

    function user_check()
    {
        $user = $_POST['username'];
        $this->load->model('Membership_model');
        $userInfo = $this->Membership_model->getInfo($user);
        if (!isset($userInfo))
        {
            $this->form_validation->set_message('user_check', 'Sorry, the user was not found.');
            return false;
        }
        else
        {
            return true;
        } 
    }


}