<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url', 'form');
        $this->load->library('session');
        $this->load->database();
        $this->load->model('Common_model');
        if ($this->session->userdata('userid') == "") {
            redirect(base_url('admin/logout'), 'refresh');
        }
    }

    public function index() {
        $this->load->view('admin/dashboard');
    }

}
