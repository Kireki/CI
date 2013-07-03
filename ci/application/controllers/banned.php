<?php

class Banned extends CI_Controller {
    
    function index() {
    $this->load->view('banned');
    }

    function logout()  
    {  
        $this->session->sess_destroy();  
        redirect('');
    }

}