<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url', 'form');
        $this->load->library('session');
        $this->load->helper('security');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="errormsg notification"><i class="fa fa-times"></i> ', '</div>');
        $this->load->database();
        $this->load->model('Common_model');
    }

    public function index() {
        $data['message'] = $this->session->flashdata('message');

        if (isset($_POST['btnSignin']) && !empty($_POST)) {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            if ($this->form_validation->run() == true) {
                //Check Login
                $recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
                $google_url = "https://www.google.com/recaptcha/api/siteverify";
                $secret = '6LdgMB4UAAAAAKGBKuILD4X0Tms3rMZvhldrteXv';
                $ip = $_SERVER['REMOTE_ADDR'];
                $url = $google_url . "?secret=" . $secret . "&response=" . $recaptchaResponse . "&remoteip=" . $ip;
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_TIMEOUT, 10);
                curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
                // $res = curl_exec($curl);
                // curl_close($curl);
                // $res = json_decode($res, true);
                //reCaptcha success check
                //if($res['success']) //Captcha Successfull
                //{
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                //$pwd = sha1($password);

                $hasingpwd = $this->Common_model->showname_fromid("password", "tbl_admin", "email_id='$email' and status=1");
                if (password_verify("$password", $hasingpwd)) {
                    $checkdb = $this->Common_model->get_records("adminid, admin_name, email_id, admin_type", "tbl_admin", "email_id='$email' and status=1", "", "1");
                    $sess_array = array();
                    foreach ($checkdb as $row) {
                        $adminid = $row['adminid'];
                        $admin_name = $row['admin_name'];
                        $email_id = $row['email_id'];
                        $admin_type = $row['admin_type'];
                        // if ($admin_type == 1) {
                        //     $getallmodules = $this->Common_model->get_records("moduleid", "tbl_modules", "", "", "");
                        // } else if ($admin_type == 2) {
                        //     $getallmodules = $this->Common_model->get_records("moduleid", "tbl_admin_modules", "adminid='$adminid'", "", "");
                        // }

                        // $allmodules = array();
                        // if ($getallmodules) {
                        //     foreach ($getallmodules as $getallmoduless) {
                        //         $allmodules[] = $getallmoduless['moduleid'];
                        //     }
                        // }
                        $allmodules[] = array();
                    }

                    $sess_array = array(
                        'userid' => $adminid,
                        'username' => $admin_name,
                        'useremail' => $email_id,
                        'sess_id' => session_id(),
                        'allpermittedmodules' => $allmodules
                    );
                    $this->session->set_userdata($sess_array);
                    $locatn = base_url() . 'admin/dashboard';
                    echo "<script>window.location.href='".$locatn."';</script>";
                    // redirect(base_url() . 'admin/dashboard', 'refresh');
                } else {
                    $data['message'] = '<div class="errormsg notification"><i class="fa fa-times"></i> Invalid Login. Please try again.</div>';
                }
                /* }
                  else
                  {
                  $data['message'] = '<div class="errormsg notification"><i class="fa fa-times"></i> Please select captcha & try again.</div>';
                  } */
            } else {
                //set the flash data error message if there is one
                $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
            }
        }

        $this->load->view('admin/home', $data);
    }

    public function forgot_email() {
        $email = $this->input->get('forgotemail');
        $numuserqryinactive = $this->Common_model->noof_records("adminid", "tbl_admin", "email_id='$email' and status=0");
        $numuseractive = $this->Common_model->noof_records("adminid", "tbl_admin", "email_id='$email' and status=1");
        if ($numuseractive > 0) {
            $row = $this->Common_model->get_records("*", "tbl_admin", "email_id='$email' and status=1", "");
            foreach ($row as $rows) {
                $getadminid = $rows['adminid'];
                $getadmin_name = $rows['admin_name'];
            }

            $getlink_id = $this->getGUID();
            $getenclink_id = hash('sha1', $getlink_id);
            $curdatetime = strtotime("now");
            $expdatetime = strtotime('+1 day');

            $updatedata = array(
                'temp_password' => $getenclink_id,
                'pwd_created' => $curdatetime
            );
            $updaterecord = $this->Common_model->update_records("tbl_admin", $updatedata, "adminid=$getadminid");

            $linktomail = base_url() . 'admin/changepassword?id=' . $getlink_id;
            //echo $linktomail;
            if ($updaterecord) {
                $company_mail = $this->Common_model->company_mail_id;
                /** Start - Sending Mail * */
                $mailconfig = Array(
                    'mailtype' => 'html',
                    'charset' => 'iso-8859-1',
                    'wordwrap' => TRUE,
                    'newline' => '\n',
                    'crlf' => '\n'
                );
                $mailcontent = "<!doctype html>
				<html>
				<head>
					<meta charset='utf-8'>
				</head>
				<body style='font-family:sans-serif;font-size:13px; line-height:22px;'>
				<div style='width: 100%;background:#F5F5F5;color: #000;'> 
				<div style='padding:30px 30px 60px 30px;'>       
				  <div style='text-align:center'><a href='" . base_url() . "'><img src='" . base_url() . "assets/admin/img/logo.jpg' style='margin:auto; margin-top:12px; margin-bottom:12px'></a>
				  </div>

				 <div style='background-color:#FFF;border:#EAEAEA 1px solid; padding:15px;'>
					<p style='margin-top:30px;'>
						Dear $getadmin_name, <br><br>
						Recently a request was submitted to reset your password. If you did not request this, please ignore this email. It will expire and become useless in 24 hours time.<br><br>
						
						To reset your password, please visit the url below:<br>
						<a href='$linktomail'>$linktomail</a><br>
						When you visit the link above, you will have the opportunity to choose a new password.
					</p>
					
				  	<div style='line-height:25px; margin-top:20px'>
						<div>Sincerely,</div>
						<div>Smacpage</div>
				 	</div>
				 </div>

					  <div style='font-size:12px; color:#616161; text-align:center; margin-top:12px;border-top:#E9E9E9 1px solid; padding-top:30px; padding-bottom:10px'>
					  <a href='" . base_url() . "' style='color:#616161; text-decoration:underline'>Home</a> | 
					  <a href='" . base_url() . "about' style='color:#616161; text-decoration:underline'>About</a> | 
					  <a href='" . base_url() . "contact' style='color:#616161; text-decoration:underline'>Contact</a>
					  <span style='display:block;'>You're receiving this email as a registered user of <a href='" . base_url() . "' style='color:#616161; text-decoration:underline'>Smacpage</a></span>
					  <span style='display:block;'>If you have any query, please get in touch with us at <a mailto='$company_mail' style='color:#616161; text-decoration:underline'>$company_mail</a></span>
					  </div>
				  </div>        
				</div>

				</body>";

                $subject = "Password Reset E-mail";
                $from_mail = $this->Common_model->from_mail_id;

                $this->load->library('email', $mailconfig);
                $this->email->from($from_mail, "Smacpage");
                $this->email->to($email);
                $this->email->subject($subject);
                $this->email->message($mailcontent);
                $this->email->send();
                /** End - Send Mail * */
                echo "<div class='successmsg notification'><i class='fa fa-check'></i> A link has been sent to your Email ID to change your password. </div>";
            } else {
                echo "<div class='errormsg notification'><i class='fa fa-times'></i> Unable to process your request.</div>";
            }
        } else if ($numuserqryinactive > 0) {
            echo "<div class='errormsg notification'><i class='fa fa-times'></i> This email id is inactive.</div>";
        } else {
            echo "<div class='errormsg notification'><i class='fa fa-times'></i> Invalid email id.</div>";
        }
        exit();
    }

    public function getGUID() { //Generate GUID - Global unique Identifier
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

}
