<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

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
		$this->load->view('contact');
	}
	
    public function send_enquiry()
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$subject = $this->input->post('subject');
		$message = $this->input->post('message');
		$date = date("Y-m-d H:i:s");
		
		if( $name != '' && $email != '')
		{
			$query_data = array(
				'name'			    => $name,
				'email'		        => $email,
				'subject'	        => $subject,
                'message'	        => $message,
                'created_date'	    => $date
			);
			
			$insert_rec = $this->Common_model->insert_records("tbl_enquiry", $query_data);
			if($insert_rec)
			{
				/** Start - Sending Mail **/
				$mailconfig = Array(
					'mailtype' => 'html',
					'charset' => 'iso-8859-1',
					'wordwrap' => TRUE,
					'newline'=>'\n',
					'crlf'=>'\n'
				);
				$mailcontent = "<!doctype html>
				<html>
				<head>
				<meta charset='utf-8'>
				</head>
				<body style='font-family:sans-serif;border: 4px solid #069; border-top: none;'>
				<div style='width: 100%;background: #069;color: #fff;'>
				<div style='float: left;background: #fff;margin-left: 30px;padding: 10px 15px;'><img src='".base_url()."assets/img/smacpage logo.png'></div>
				<div style='float:left; text-transform:uppercase; font-weight:700; font-size:28px; padding:25px 30px;'>Smacpage</div>
				<div style='clear:both'></div>
				</div>
				
				<div style='padding:10px 30px;'>				  	
				  	<p style='margin-top:30px;'>There is a contact enquiry from website. Please have a look below details : </p>
					<div style='line-height:25px;font-size:14px'>
						<div><strong>NAME : </strong>$name</div>
						<div><strong>EMAIL : </strong>$email</div>
                        <div><strong>SUBJECT: </strong>$subject</div>
						<div><strong>MESSAGE : </strong>$message</div>
					</div>
				  	<div style='line-height:25px; font-size:14px; margin-top:20px'>
						<div>Sincerely,</div>
						<div>Smacpage</div>
				 	</div>
				</div>				
				
				<div style='background:#069; padding:10px 30px 5px; color:#fff;'>
				<div style='color:#fff; font-size:13px; text-align:center; margin-bottom:10px;'>
					&copy; ".date("Y")." Smacpage
				</div>
							
				</div>
				</body>
				</html>";
				
				$subject = "New contact from Smacpage website.";
				$from_mail = $this->Common_model->from_mail_id;
				$to_mail = $this->Common_model->company_mail_id;
				
				$this->load->library('email', $mailconfig);
				$this->email->from($from_mail, "Smacpage");
				$this->email->to($to_mail);
				$this->email->subject($subject);
				$this->email->message($mailcontent);
				$this->email->send();
				/** End - Send Mail **/				
				
				echo "success";
			}
			else
				echo "error";
		}
		else
			echo "error";
		
		exit();
	}
	public function send_subscription(){
		$email = $this->input->post('email');
		$date = date("Y-m-d H:i:s");
		if($email != '')
		{
				/** Start - Sending Mail **/
				$mailconfig = Array(
					'mailtype' => 'html',
					'charset' => 'iso-8859-1',
					'wordwrap' => TRUE,
					'newline'=>'\n',
					'crlf'=>'\n'
				);
				$mailcontent = "<!doctype html>
				<html>
				<head>
				<meta charset='utf-8'>
				</head>
				<body style='font-family:sans-serif;border: 4px solid #069; border-top: none;'>
				<div style='width: 100%;background: #069;color: #fff;'>
				<div style='float: left;background: #fff;margin-left: 30px;padding: 10px 15px;'><img src='".base_url()."assets/img/smacpage logo.png'></div>
				<div style='float:left; text-transform:uppercase; font-weight:700; font-size:28px; padding:25px 30px;'>Smacpage</div>
				<div style='clear:both'></div>
				</div>
				
				<div style='padding:10px 30px;'>				  	
				  	<p style='margin-top:30px;'>There is a subscription from website. Please have a look below details : </p>
					<div style='line-height:25px;font-size:14px'>
						<div>Email : ".$email."</div>
					</div>
				  	<div style='line-height:25px; font-size:14px; margin-top:20px'>
						<div>Sincerely,</div>
						<div>Smacpage</div>
				 	</div>
				</div>				
				
				<div style='background:#069; padding:10px 30px 5px; color:#fff;'>
				<div style='color:#fff; font-size:13px; text-align:center; margin-bottom:10px;'>
					&copy; ".date("Y")." Smacpage
				</div>
							
				</div>
				</body>
				</html>";
				
				$subject = "New subscription from Smacpage website.";
				$from_mail = $this->Common_model->from_mail_id;
				$to_mail = $this->Common_model->company_mail_id;
				
				$this->load->library('email', $mailconfig);
				$this->email->from($from_mail, "Smacpage");
				$this->email->to($to_mail);
				$this->email->subject($subject);
				$this->email->message($mailcontent);
				$this->email->send();
				/** End - Send Mail **/				
				
				echo "success";
			}
			else
				echo "error";
		
		exit();

	}
}
