<?php
defined('BASEPATH') or exit('Direct access to script not allowed');


class Admin_users_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->admin_details = $this->common_model->get_admin_details($this->session->admin_email);
	}
	


	public function add_new_admin() { 
		$name = ucwords($this->input->post('name', TRUE)); 
		$email = strtolower($this->input->post('email', TRUE)); 
		$phone = $this->input->post('phone', TRUE); 
		$roles = implode(", ", $this->input->post('roles', TRUE));
		$password = hash('ripemd128', default_admin_password);
		$data = array (
			'name' => $name,
			'email' => $email,
			'phone' => $phone,
			'roles' => $roles,
			'level' => 2,
			'password' => $password,
		);
		$this->db->insert('admins', $data);
	}
	
	
	public function edit_admin($id) { 
		$y = $this->common_model->get_admin_details_by_id($id);
		$name = ucwords($this->input->post('name', TRUE)); 
		$phone = $this->input->post('phone', TRUE); 
		if ($this->input->post('roles', TRUE) != NULL) { 
			$roles = implode(", ", $this->input->post('roles', TRUE));
		} else {
			$roles = $y->roles;
		}
		$data = array (
			'name' => $name,
			'phone' => $phone,
			'roles' => $roles,
		);
		$this->db->where('id', $id);
		return $this->db->update('admins', $data);
	}
	
		
	public function message_admin($id) {
		$message = nl2br(ucfirst($this->input->post('message', TRUE))); 
		$subject = 'Message from Admin';
		$y = $this->common_model->get_admin_details_by_id($id);
		return email_user($y->email, $subject, $message); //email admin
    } 
	
	
	public function delete_admin_photo($id) {
		$y = $this->common_model->get_admin_details_by_id($id);
		if ($y->photo != NULL && $y->photo_thumb != NULL) {
			unlink('./assets/uploads/photos/admins/'.$y->photo); //delete the photo
			unlink('./assets/uploads/photos/admins/'.$y->photo_thumb); //delete the thumbnail
		}
    } 
	
	
	public function delete_admin($id) {
		$y = $this->common_model->get_admin_details_by_id($id);
		$this->delete_admin_photo($id); //remove image files from server
		return $this->db->delete('admins', array('id' => $id));
    }


    public function delete_bulk_admins() {
		$selected_rows = count($this->input->post('check_bulk_action', TRUE)); 
		$bulk_action_type = $this->input->post('bulk_action_type', TRUE);		
		$row_id = $this->input->post('check_bulk_action', TRUE);
		$admins = ($selected_rows == 1) ? 'Admin' : 'Admins';
		foreach ($row_id as $id) {
			$y = $this->common_model->get_admin_details_by_id($id);
    		$admin_level = $y->level;
			if ($admin_level != 1) { //we good
				$this->delete_admin($id);
				$this->session->set_flashdata('status_msg', "{$admins} deleted successfully."); 
			} else {
				$this->session->set_flashdata('status_msg_error', 'You cannot delete a chief admin.');
			}
		} 
	}


	public function check_admin_level($id) {
    	$y = $this->common_model->get_admin_details_by_id($id);
    	$admin_level = $y->level;
    	if ($admin_level != 1) { //fire on
			return TRUE;
		} else { //ooops! that's probably a bad idea...
			$this->session->set_flashdata('status_msg_error', 'You cannot delete a chief admin.');
			redirect($this->agent->referrer());
		}
    }  




}