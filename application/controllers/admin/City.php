<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City extends CI_Controller {
	
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
			$this->form_validation->set_rules('country', 'Country', 'trim|required|callback_select');
			$this->form_validation->set_rules('city_name', 'City', 'trim|required|xss_clean');
			
			$sess_userid = $this->session->userdata('userid');
			$date = date("Y-m-d H:i:s");
			if ($this->form_validation->run() == true)
			{
				$country = $this->input->post('country');
				$city_name = $this->input->post('city_name');
				
				$insert_data = array(
					'countryid'		=> $country,
					'city_name'		=> $city_name,
					'status'		=> 1,
					'created_by'	=> $sess_userid,
					'created_date'	=> $date
				);
				
				$insertdb = $this->Common_model->insert_records('tbl_city', $insert_data);
				if($insertdb)
					$this->session->set_flashdata('message','<div class="successmsg notification"><i class="fa fa-check"></i> City added successfully.</div>');
				else
					$this->session->set_flashdata('message','<div class="errormsg notification"><i class="fa fa-times"></i> City could not added. Please try again.</div>');
				redirect(base_url().'admin/city','refresh');
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
			$this->form_validation->set_rules('country', 'Country', 'trim|required|callback_select');
			$this->form_validation->set_rules('city_name', 'City', 'trim|required|xss_clean');
			
			$sess_userid = $this->session->userdata('userid');
			$date = date("Y-m-d H:i:s");
			if ($this->form_validation->run() == true)
			{
				$country = $this->input->post('country');
				$city_name = $this->input->post('city_name');
				$editid = $this->input->post('editid');
				
				$query_data = array(
					'countryid'		=> $country,
					'city_name'		=> $city_name,
					'updated_by'	=> $sess_userid,
					'updated_date'	=> $date
				);
				
				$querydb = $this->Common_model->update_records('tbl_city', $query_data, "cityid='$editid'");
				if($querydb)
					$this->session->set_flashdata('m_message','<div class="successmsg notification"><i class="fa fa-check"></i> City edited successfully.</div>');
				else
					$this->session->set_flashdata('m_message','<div class="errormsg notification"><i class="fa fa-times"></i> City could not edited. Please try again.</div>');
				redirect(base_url().'admin/city','refresh');
			}
			else
			{
				//set the flash data error message if there is one
				$data['m_message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
			}
		}
		
		

		$data['row'] = $this->Common_model->get_records("*","tbl_city","","countryid ASC, city_name ASC");
		$this->load->view('admin/city',$data);
	}
	
	public function changestatus()
	{
		$stsid = $this->uri->segment(4);
		$noof_rec = $this->Common_model->noof_records("cityid","tbl_city","cityid='$stsid'");
		if($noof_rec>0)
		{
			$status = $this->Common_model->showname_fromid("status","tbl_city","cityid=$stsid");
			if($status==1)
				$updatedata = array('status' => 0);
			else
				$updatedata = array('status' => 1);
			$updatestatus = $this->Common_model->update_records("tbl_city",$updatedata,"cityid=$stsid");
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
        /*$noof_jobrec = $this->Common_model->noof_records("jobid","tbl_jobs","cityid='$delid'");
        $noof_emprec = $this->Common_model->noof_records("employerid","tbl_employer","cityid='$delid'");
        if($noof_jobrec>0 || $noof_emprec>0)
        {
            $this->session->set_flashdata('m_message','<div class="errormsg notification"><i class="fa fa-times"></i> City could not deleted. Some Jobs or employer exist in same City.</div>');
        }
        else
        {*/
            $noof_rec = $this->Common_model->noof_records("cityid","tbl_city","cityid='$delid'");
            if($noof_rec>0)
            {
                $del = $this->Common_model->delete_records("tbl_city","cityid=$delid");
                if($del)
                    $this->session->set_flashdata('m_message','<div class="successmsg notification"><i class="fa fa-check"></i> City has been deleted successfully.</div>');
                else
                    $this->session->set_flashdata('m_message','<div class="errormsg notification"><i class="fa fa-times"></i> City could not deleted. Please try again.</div>');
            }
        //}
		redirect(base_url().'admin/city','refresh');
	}
	
	public function edit_pop()
	{
		$editid = $this->uri->segment(4);
		$noof_rec = $this->Common_model->noof_records("cityid","tbl_city","cityid='$editid'");
		if($noof_rec > 0)
		{
			$data = $this->Common_model->get_records("*","tbl_city","cityid='$editid'");
			foreach ($data as $rows)
			{
				$countryid = $rows['countryid'];
				$city_name = $rows['city_name'];
			}
	?>
		<div class="box box-primary">
			<button type="button" class="close-btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
            <div class="box-header with-border col-md-12">
              <h3 class="box-title col-md-12">Edit City</h3>
            </div>
            
            <form name="form_city_edit" id="form_city_edit" method="post" class="col-md-12 modalform">
               <div class="form-group">
                	<label class="col-md-3">Country</label>
					<div class="col-md-9">
						<select class="form-control" name="country" id="country">
							<option value="0">-Select Country-</option>
							<?php echo $this->Common_model->populate_select($countryid,"countryid","country_name","tbl_country","","country_name ASC"); ?>
						</select>
				  </div>
				   <div class="clearfix"></div>
				</div>
              
              <div class="form-group">
                <label class="col-md-3">City</label>
                <div class="col-md-9"><input type="text" class="form-control" placeholder="Enter city name" name="city_name" id="city_name" value="<?php echo $city_name; ?>"></div>
                <div class="clearfix"></div>
              </div>
              
              <div class="form-group">
              <label class="col-md-3"></label>
              <div class="reset-button col-md-9">
				  <input type="hidden" name="editid" id="editid" value="<?php echo $editid; ?>" />
                  <button type="submit" class="btn redbtn btnUpdate" name="btnUpdate" id="btnUpdate">Save</button>
                 </div></div>
            </form><div class="clearfix"></div>
            
          </div>
	<?php
		}
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