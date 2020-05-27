<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {

	public function __construct()
 	{
		parent::__construct();
		$this->load->helper('url','form');
		$this->load->library('session');
		$this->load->helper('security');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="errormsg notification"><i class="fa fa-times"></i> ', '</div>');
		$this->load->database();
		$this->load->model('Common_model');
		if($this->session->userdata('userid') == "")
		{
			redirect(base_url().'admin/logout','refresh');
		}
		/*$allusermodules = $this->session->userdata('allpermittedmodules');
		if(!(in_array(2, $allusermodules))) 
		{
			redirect(base_url().'admin/dashboard','refresh');
		}*/
 	}
	
	public function index()
	{
		$data['message'] = $this->session->flashdata('message');
		$data['row'] = $this->Common_model->get_records("*","tbl_service","","created_date DESC");
		$this->load->view('admin/manage_services',$data);
	}
	
	public function add()
	{
		$data['message'] = $this->session->flashdata('message');
		if (isset($_POST['service_name']) && !empty($_POST))
		{
			$this->form_validation->set_rules('service_name', 'Service Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('page_url', 'Page Url', 'trim|required|xss_clean|is_unique[tbl_service.page_url]');
			
			$sess_userid = $this->session->userdata('userid');
			$date = date("Y-m-d H:i:s");
			if ($this->form_validation->run() == true)
			{
				$service_name	= $this->input->post('service_name');
				$page_url		= $this->input->post('page_url');
				$editor		    = $this->input->post('editor');

				$insert_data = array(
					'service_name' 		=> $service_name,
					'page_url' 			=> $page_url,
					'description'		=> $editor,
					'status'			=> 1,
					'created_date'		=> $date,
					'created_by'		=> $sess_userid
				);
				
				$insertdb = $this->Common_model->insert_records('tbl_service', $insert_data);
				if($insertdb)	
					$this->session->set_flashdata('message','<div class="successmsg notification"><i class="fa fa-check"></i> Service added successfully.</div>');
				else
					$this->session->set_flashdata('message','<div class="errormsg notification"><i class="fa fa-times"></i> Service could not added. Please try again.</div>');
				
				redirect(base_url().'admin/services/add','refresh');
			}
			else
			{
				//set the flash data error message if there is one
				$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
			}
		}
		$this->load->view('admin/add_services',$data);
	}
	
	public function changestatus()
	{
		$stsid = $this->uri->segment(4);
		$noof_rec = $this->Common_model->noof_records("service_id","tbl_service","service_id='$stsid'");
		if($noof_rec>0)
		{
			$status = $this->Common_model->showname_fromid("status","tbl_service","service_id=$stsid");
			if($status==1)
				$updatedata = array('status' => 0);
			else
				$updatedata = array('status' => 1);
			$updatestatus = $this->Common_model->update_records("tbl_service",$updatedata,"service_id=$stsid");
			if($updatestatus)
				echo $status;
			else
				echo "error";
		}
		exit();
	}
	
	public function delete()
	{
		$delid = $this->uri->segment(4);
		$noof_rec = $this->Common_model->noof_records("service_id","tbl_service","service_id='$delid'");
		if($noof_rec>0)
		{
            $del = $this->Common_model->delete_records("tbl_service","service_id=$delid");
            if($del)
            {
                $this->session->set_flashdata('message','<div class="successmsg notification"><i class="fa fa-check"></i> Service has been deleted successfully.</div>');
            }
            else
                $this->session->set_flashdata('message','<div class="errormsg notification"><i class="fa fa-times"></i> Service could not deleted. Please try again.</div>');
		}
		redirect(base_url().'admin/services','refresh');
	}
	
	public function view()
	{
		$viewid	= $this->uri->segment(4);
		$noof_rec = $this->Common_model->noof_records("service_id","tbl_service","service_id='$viewid'");
		if($noof_rec>0)
		{
			$data['message'] = $this->session->flashdata('message');
			$data['row'] = $this->Common_model->get_records("*","tbl_service","service_id=$viewid","");
			
			$this->load->view('admin/view_services', $data);
		}
		else
			redirect(base_url().'admin/services','refresh');
	}
	
	public function edit()
	{
		$editid	= $this->uri->segment(4);
		$noof_rec = $this->Common_model->noof_records("service_id","tbl_service","service_id='$editid'");
		if($noof_rec>0)
		{
			$data['message'] = $this->session->flashdata('message');
			$data['row'] = $this->Common_model->get_records("*","tbl_service","service_id=$editid","");
			if (isset($_POST['service_name']) && !empty($_POST))
			{
				$custpage_url = $this->Common_model->showname_fromid("page_url","tbl_service","service_id=$editid");
				if($this->input->post('page_url') != $custpage_url) {
				   $is_unique =  '|is_unique[tbl_service.page_url]';
				} else {
				   $is_unique =  '';
				}
				$this->form_validation->set_rules('service_name', 'Service Name', 'trim|required|xss_clean');
				$this->form_validation->set_rules('page_url', 'Page Url', 'trim|required|xss_clean'.$is_unique);

				$sess_userid = $this->session->userdata('userid');
				$date = date("Y-m-d H:i:s");
				if ($this->form_validation->run() == true)
				{
					$service_name	= $this->input->post('service_name');
					$page_url		= $this->input->post('page_url');
					$editor		    = $this->input->post('editor');
					
					$query_data = array(
						'service_name' 		=> $service_name,
						'page_url' 			=> $page_url,
						'description'		=> $editor,
						'updated_date'		=> $date,
						'updated_by'		=> $sess_userid
					);
					
					$querydb = $this->Common_model->update_records('tbl_service', $query_data, "service_id=$editid");
					if($querydb)
					{
						$this->session->set_flashdata('message','<div class="successmsg notification"><i class="fa fa-check"></i> Service edited successfully.</div>');
					}
					else
					{
						$this->session->set_flashdata('message','<div class="errormsg notification"><i class="fa fa-times"></i> Service could not edited. Please try again.</div>');
					}
					redirect(base_url().'admin/services/edit/'.$editid,'refresh');
				}
				else
				{
					//set the flash data error message if there is one
					$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
				}
			}
			$this->load->view('admin/edit_services', $data);
		}
		else
			redirect(base_url().'admin/services','refresh');
	}
	
	// Remote check quote ref
	public function check_pageurl()
	{
		$chkpage_url = $_REQUEST["chkpage_url"];
		$where_page = "";
		if(isset($_REQUEST["id"])) {
			$service_id = $_REQUEST["id"];
			$where_page = " and service_id!='$service_id'";
		}
		$noof_rec = $this->Common_model->noof_records("service_id","tbl_service","page_url='$chkpage_url' $where_page");
		if($noof_rec > 0)
			echo(json_encode(false));
		else
			echo(json_encode(true)); // if there's nothing matching
		exit();
	}
	
	public function select($str)
	{
		if($str=='0' || $str=='')
		{
			$this->form_validation->set_message('select',  'The %s field is required.');
			return false;
		}
		else
			return true;
	}
}