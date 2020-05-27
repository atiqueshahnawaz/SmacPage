<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
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
		$error404 = 0;
		if (!$this->uri->segment(2)) { //category name is empty
			$this->load->view('services');
		}
		else {
			$get_service = $this->uri->segment(2);
			$noof_category = $this->Common_model->noof_records("service_id","tbl_service","page_url='$get_service' and status=1");
			if($noof_category < 1) {
				$error404 = 1; //error
			}
			
			if($error404 == 1)
			{
				$this->output->set_status_header('404');
				$data['pagetitle'] = "404 Page Not Found";
				$this->load->view('404error',$data);
			}
			else
			{
				$data['row'] = $this->Common_model->get_records("*","tbl_service","page_url='$get_service'","");
				$this->load->view('service_details',$data);
			}
		}
	}
}
