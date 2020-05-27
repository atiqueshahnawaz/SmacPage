<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Country extends CI_Controller {
	
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
		$this->load->library('pagination');
		if($this->session->userdata('userid') == "")
		{
			redirect(base_url().'admin/logout','refresh');
		}
		$allusermodules=$this->session->userdata('allpermittedmodules');
		if(!in_array(2,$allusermodules)) 
		{
			// redirect(base_url().'admin/dashboard','refresh');
		}
 	}
 	
	public function index()
	{
		$data['message'] = $this->session->flashdata('message');
		$data['m_message'] = $this->session->flashdata('m_message');
		//Add Master Module
		if (isset($_POST['btnSubmit']) && !empty($_POST))
		{
			$this->form_validation->set_rules('field_val', 'Country', 'trim|required|xss_clean|is_unique[tbl_country.country_name]');
			
			$sess_userid = $this->session->userdata('userid');
			$date = date("Y-m-d H:i:s");
			if ($this->form_validation->run() == true)
			{
				$field_val = $this->input->post('field_val');
				
				$insert_data = array(
					'country_name'	=> $field_val,
					'status'		=> 1,
					'created_by'	=> $sess_userid,
					'created_date'	=> $date
				);
				
				$insertdb = $this->Common_model->insert_records('tbl_country', $insert_data);
				if($insertdb)
					$this->session->set_flashdata('message','<div class="successmsg notification"><i class="fa fa-check"></i> Country added successfully.</div>');
				else
					$this->session->set_flashdata('message','<div class="errormsg notification"><i class="fa fa-times"></i> Country could not added. Please try again.</div>');
				redirect(base_url().'admin/country','refresh');
			}
			else
			{
				//set the flash data error message if there is one
				$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
			}
		}
		
		//Edit Master Module
		if (isset($_POST['btnUpdate']) && !empty($_POST))
		{
			$editid = $this->input->post('editid');
			$cntry_name = $this->Common_model->showname_fromid("country_name","tbl_country","countryid=$editid");
			if($this->input->post('field_val') != $cntry_name) {
			   $is_unique = '|is_unique[tbl_country.country_name]';
			} else {
			   $is_unique = '';
			}
			$this->form_validation->set_rules('field_val', 'Country', 'trim|required|xss_clean'.$is_unique);
			
			$sess_userid = $this->session->userdata('userid');
			$date = date("Y-m-d H:i:s");
			if ($this->form_validation->run() == true)
			{
				$field_val = $this->input->post('field_val');
				
				$query_data = array(
					'country_name'	=> $field_val,
					'updated_by'	=> $sess_userid,
					'updated_date'	=> $date
				);
				
				$querydb = $this->Common_model->update_records('tbl_country', $query_data, "countryid='$editid'");
				if($querydb)
					$this->session->set_flashdata('m_message','<div class="successmsg notification"><i class="fa fa-check"></i> Country edited successfully.</div>');
				else
					$this->session->set_flashdata('m_message','<div class="errormsg notification"><i class="fa fa-times"></i> Country could not edited. Please try again.</div>');
				redirect(base_url().'admin/country','refresh');
			}
			else
			{
				//set the flash data error message if there is one
				$data['m_message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
			}
		}
		
		

		$data['row'] = $this->Common_model->get_records("*","tbl_country","","country_name ASC");
		$this->load->view('admin/country',$data);
	}
	
	public function changestatus()
	{
		$stsid = $this->uri->segment(4);
		$noof_rec = $this->Common_model->noof_records("countryid","tbl_country","countryid='$stsid'");
		if($noof_rec>0)
		{
			$status = $this->Common_model->showname_fromid("status","tbl_country","countryid=$stsid");
			if($status==1)
				$updatedata = array('status' => 0);
			else
				$updatedata = array('status' => 1);
			$updatestatus = $this->Common_model->update_records("tbl_country",$updatedata,"countryid=$stsid");
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
        /*$noof_jobrec = $this->Common_model->noof_records("jobid","tbl_jobs","countryid='$delid'");
        $noof_emprec = $this->Common_model->noof_records("employerid","tbl_employer","countryid='$delid'");
        if($noof_jobrec>0 || $noof_emprec>0)
        {
            $this->session->set_flashdata('m_message','<div class="errormsg notification"><i class="fa fa-times"></i> Country could not deleted. Some Jobs or employer exist in same country.</div>');
        }
        else
        {*/
            $noof_rec = $this->Common_model->noof_records("countryid","tbl_country","countryid='$delid'");
            if($noof_rec>0)
            {
                $del = $this->Common_model->delete_records("tbl_country","countryid=$delid");
                if($del)
                    $this->session->set_flashdata('m_message','<div class="successmsg notification"><i class="fa fa-check"></i> Country has been deleted successfully.</div>');
                else
                    $this->session->set_flashdata('m_message','<div class="errormsg notification"><i class="fa fa-times"></i> Country could not deleted. Please try again.</div>');
            }
        //}
		redirect(base_url().'admin/country','refresh');
	}
	
	public function edit_pop()
	{
		$editid = $this->uri->segment(4);
		$noof_rec = $this->Common_model->noof_records("countryid","tbl_country","countryid='$editid'");
		if($noof_rec > 0)
		{
			$data = $this->Common_model->get_records("*","tbl_country","countryid='$editid'");
			foreach ($data as $rows)
			{
				$country_name = $rows['country_name'];
				
			}
	?>
		<div class="box box-primary">
			<button type="button" class="close-btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
            <div class="box-header with-border col-md-12">
              <h3 class="box-title col-md-12">Edit Country</h3>
            </div>
			
            <form class="col-md-12 modalform" method="post" name="form_master_edit" id="form_master_edit">
				
              <div class="form-group">
                <label class="col-md-3">Country</label>
                <div class="col-md-9"><input type="text" class="form-control" placeholder="Enter country" name="field_val" id="field_val" value="<?php echo $country_name; ?>"></div>
                <div class="clearfix"></div>
              </div>
              
              <div class="form-group">
              <label class="col-md-3"></label>
              <div class="reset-button col-md-9">
				  <input type="hidden" name="editid" id="editid" value="<?php echo $editid; ?>" />
                  <button type="submit" class="btn redbtn btnUpdate" name="btnUpdate" id="btnUpdate">Save</button>
                 </div></div>
            </form>
			<div class="clearfix"></div>
            
          </div>
	<?php
		}
		exit();
	}
	
}