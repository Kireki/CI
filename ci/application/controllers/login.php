<?php

class Login extends CI_Controller {

    function __construct() 
    {
        parent::__construct();
        $CI =& get_instance();
        $status = $CI->session->userdata('status');
        if ($status === "banned") {
            redirect('banned');
        }      
    }

    function index() 
    {
        $this->load->model('Gallery_model');
        $CI =& get_instance();
        $is_logged_in = $CI->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in != true)
           {
                $this->load->library('pagination');
                $config['base_url'] = "http://localhost:8080/ci/login/index";
                $config['total_rows'] = $this->Gallery_model->pic_count();
                $config['per_page'] = 12;
                $config['num_links'] = 2;
                $this->pagination->initialize($config);
                $data['images'] = $this->Gallery_model->get_images($config['per_page'], $this->uri->segment(3));
                $this->load->view('homepage_unlogged', $data);
           }
        else
        {
                $this->load->library('pagination');
                $config['base_url'] = "http://localhost:8080/ci/login/index";
                $config['total_rows'] = $this->Gallery_model->pic_count();
                $config['per_page'] = 12;
                $config['num_links'] = 2;
                $this->pagination->initialize($config);
                $data['images'] = $this->Gallery_model->get_images($config['per_page'], $this->uri->segment(3));
                $this->load->view('homepage_logged', $data);
        }       
    }

    function signin()
    {
        $CI =& get_instance();
        $is_logged_in = $CI->session->userdata('is_logged_in');
        if(isset($is_logged_in) && $is_logged_in === true)
        {
            redirect('');
        }
        $this->load->model('Membership_model');
        $userInfo = $this->Membership_model->getInfo($this->input->post('username'));

        $this->load->model('Membership_model');
        $userInfo = $this->Membership_model->getInfo($this->input->post('username'));        

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required|callback_cred_check');

        if($this->form_validation->run() === FALSE)
        {
            $this->load->view('signIn.php');
        }
        else
        {
            $data = array(
                'username' => $userInfo->username,
                'is_logged_in' => true,
                'role' => $userInfo->role,
                'status' => $userInfo->status
            );
            $this->session->set_userdata($data);
            redirect('cabinet');
        }
    }

    function cred_check()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $this->load->model('Membership_model');
        $userInfo = $this->Membership_model->getInfo($this->input->post('username'));

        if(is_object($userInfo))
        {
            if (($password !== $userInfo->password) || ($username !== $userInfo->username))
            {
                $this->form_validation->set_message('cred_check', 'Incorrect username or password.');
                return false;
            }
            else
            {
                return true;
            }
        }
        else
        {
            $this->form_validation->set_message('cred_check', 'Incorrect username or password.');
            return false;
        }
    }

    function signup() 
    {
        $CI =& get_instance();
        $is_logged_in = $CI->session->userdata('is_logged_in');
        if (isset($is_logged_in) && $is_logged_in === true) {
            redirect('');
        }
        else
        {
            $this->load->view('register.php');
        }
    }

    function create_member() 
    {
    	$this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'username', 'trim|required|min_length[4]|is_unique[membership.username]');
    	$this->form_validation->set_rules('email_address', 'e-mail', 'trim|required|valid_email|is_unique[membership.email_address]');
        $this->form_validation->set_rules('email_address2', 'e-mail confirmation', 'trim|required|matches[email_address]');    	
    	$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]|max_length[32]|md5');
    	$this->form_validation->set_rules('password2', 'password confirmation', 'trim|required|matches[password]|md5');
        $this->form_validation->set_rules('agreement', 'agreement to terms', 'callback_agreement_check');

        $this->form_validation->set_message('is_unique', 'Sorry, this %s is already taken.');
        $this->form_validation->set_message('required', 'This field is required.');
        $this->form_validation->set_message('matches', '%s doesn\'t match.');



    	if($this->form_validation->run() === FALSE)
    	{
    		$this->signup();
    	}
    	else
    	{
    		$this->load->model('membership_model');
    		if ($query = $this->membership_model->create_member()) 
    		{
    			redirect('login');
    		}
    		else
    		{
    			$this->signup();
    		}
    	}
    }

    public function agreement_check()
    {
        if (isset($_POST['agreement']))
        {
            return true;
        }
        else
        {
            $this->form_validation->set_message('agreement_check', 'You must agree to the terms of use.');
            return false;
        }
        
    }

    function logout()  
    {  
        $this->session->sess_destroy();  
        redirect('');
    }

    function anonymousUpload() {

        $this->load->model('Gallery_model');
        if($this->input->post('upload'))
        {
            $this->Gallery_model->do_upload();
        }
    }

    function userUpload() {

        $this->load->model('Gallery_model');
        if($this->input->post('upload'))
        {
            $this->Gallery_model->do_user_upload();
        }
        redirect('');                
    }
}