<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My404error extends CI_Controller {
	
	public function __construct()
 	{
		parent::__construct();
		$this->load->helper('url','form');
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Common_model');
 	}
	
	public function index()
	{
		$this->output->set_status_header('404');
		$data['pagetitle'] = "404 Page Not Found";
		$this->load->view('404error',$data);
	}
}
