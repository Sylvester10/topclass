<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('login_model');
	}




	/* ========= Admin Login ============ */
	public function index()
	{	
		//return admin to dashboard if still loggedin
		$this->return_to_dashboard();
		$this->header('Admin Login');
		$this->load->view('login/login');
		$this->footer();
	}


	public function login_ajax() {
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
        
		$email = $this->input->post('email', TRUE);	
		$password = hash('ripemd128', $this->input->post('password', TRUE));
        $email_exists = $this->login_model->check_admin_email_exists($email);
		
		if ($this->form_validation->run())  {	
						
			if ($email_exists) {

				$y = $this->common_model->get_admin_details($email);
				$f_name = get_firstname($y->name);

				if ($y->password == $password) {
					//email and password correct and admin is active, create session with email and create login session
					$login_data = array('admin_email' => $email, 'admin_loggedin' => TRUE);
					$this->session->set_userdata($login_data);
					//success message
					echo 1;
					
		        } elseif  ($y->password != $password ) {
					 //admin supplied wrong password
					echo "Hi {$f_name}, the password you supplied is incorrect.";

				}
				
			} else {
				//email not found
				echo 'Login failed! Email not found.';
			}
			
		} else { //form validation is not successful
			echo validation_errors();
		}
    }




    /* ========= Password Recovery ============ */
    public function password_recovery() {
		$this->header('Password Recovery');
		$this->load->view('login/password_recovery');
		$this->footer();
	}
   
	
	public function password_recovery_ajax() {
		$this->form_validation->set_rules('email', ' Email', 'trim|required|valid_email');
		$email = $this->input->post('email', TRUE);
		$email_exists = $this->login_model->check_admin_email_exists($email);
		
		if ($this->form_validation->run()) {
			if ( ! $email_exists ) {
				echo "This email address [{$email}] does not exist in our database. Please enter the email address that is associated with your admin account";			
			} else { 
				$y = $this->common_model->get_admin_details($email);
				$f_name = get_firstname($y->name);
				$subject = 'Admin Password Reset';
				$pass_reset_code = hash('ripemd128', mt_rand(100000000000, 999999999999));
				$pword_reset_url = base_url('login/password_reset/'.$y->id.'/'.$pass_reset_code);
				$anchor_link = email_call2action_blue($pword_reset_url, 'Reset Password');
				$message = "Hi <b>{$f_name}!</b> <br />
				You requested for password reset for your admin account. <br />
				Click on the link below to reset your password. <br /> 
				{$anchor_link} <br /> <br /> 
				If you did not make this request, ignore this message. <br /> 
				Please do not reply this message.";
				
				//send email
				if ( email_user($email, $subject, $message) ) {
					//update the password reset code
					$this->login_model->update_pass_reset_code($y->id, $pass_reset_code);
					echo 1;
				} else {
					echo "Error sending mail! Please contact site administrator.";
				}
			}
   
		} else {
			echo validation_errors();
		}                                 
	}
	
	
	public function change_password($id, $pass_reset_code) {
		//check admin exists
		$this->check_data_exists($id, 'id', 'admins', 'login');
		$this->header('Change Password');
		$data['y'] = $this->common_model->get_admin_details_by_id($id);
		$data['valid_code'] = $this->login_model->validate_pass_reset_code($id, $pass_reset_code);
		$this->load->view('login/change_password', $data);
		$this->footer();
	}
	
   
	public function change_password_ajax($id) {
		//check admin exists
		$this->check_data_exists($id, 'id', 'admins', 'login');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('c_password', 'Password', 'trim|required|matches[password]', 
			array('matches' => 'Passwords do not match')
		);			
		if ($this->form_validation->run()) {		
			$this->login_model->change_password($id);
			echo 1;
	    } else {	
			echo validation_errors();
		}
	}
	
	
	public function logout() {
		$data = array('admin_email', 'admin_loggedin');
		$this->session->unset_userdata($data);
		redirect(site_url('login'));
	}
	


}