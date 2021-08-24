<?php
defined('BASEPATH') or exit('Direct access to script not allowed');


class School_staff_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->staff_details = $this->common_model->get_staff_details($this->session->staff_email);
	}



	public function get_staff($limit, $offset) {		
		$this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
		$this->db->order_by("date_added", "DESC"); //order by date_unix ASC so that the dates appear chronologically
		$query = $this->db->get_where('staff');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }


	public function count_staff() { //get all staff
		return $this->db->get_where('staff')->num_rows();
	}
	
	
	public function get_active_staff($limit, $offset) {		
		$this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
		$this->db->order_by("date_added", "DESC"); //order by date_unix ASC so that the dates appear chronologically
		$this->db->where('active', 'true');
		$query = $this->db->get('staff');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }


	public function count_active_staff() { 
		$this->db->where('active', 'true');
		return $this->db->get('staff')->num_rows();
	}
	

	public function add_new_staff($photo, $photo_thumb) { 
		$name = ucwords($this->input->post('name', TRUE)); 
		$email = strtolower($this->input->post('email', TRUE)); 
		$phone = $this->input->post('phone', TRUE); 
		$sex = $this->input->post('sex', TRUE); 
		$date_of_birth = $this->input->post('date_of_birth', TRUE);
		$designation = ucwords($this->input->post('designation', TRUE));
		$residential_address = ucwords($this->input->post('residential_address', TRUE));
		$quote = ucfirst($this->input->post('quote', TRUE));
		$facebook_handle = $this->input->post('facebook_handle', TRUE);
		$twitter_handle = $this->input->post('twitter_handle', TRUE);
		$instagram_handle = $this->input->post('instagram_handle', TRUE);
		$linkedin_handle = $this->input->post('linkedin_handle', TRUE);
		$additional_info = ucwords($this->input->post('additional_info', TRUE));
		$data = array (
			'name' => $name,
			'email' => $email,
			'phone' => $phone,
			'sex' => $sex,
			'date_of_birth' => $date_of_birth,
			'designation' => $designation,
			'residential_address' => $residential_address,
			'quote' => $quote,
			'facebook_handle' => $facebook_handle,
			'twitter_handle' => $twitter_handle,
			'instagram_handle' => $instagram_handle,
			'linkedin_handle' => $linkedin_handle,
			'additional_info' => $additional_info,
			'photo' => $photo,
			'photo_thumb' => $photo_thumb,
			'active' => 'true',
		);
		$this->db->insert('staff', $data);
	}
	
	
	public function edit_staff($staff_id, $photo, $photo_thumb) { 
		$name = ucwords($this->input->post('name', TRUE)); 
		$phone = $this->input->post('phone', TRUE); 
		$sex = $this->input->post('sex', TRUE); 
		$date_of_birth = $this->input->post('date_of_birth', TRUE);
		$designation = ucwords($this->input->post('designation', TRUE));
		$residential_address = ucwords($this->input->post('residential_address', TRUE));
		$quote = ucfirst($this->input->post('quote', TRUE));
		$facebook_handle = $this->input->post('facebook_handle', TRUE);
		$twitter_handle = $this->input->post('twitter_handle', TRUE);
		$instagram_handle = $this->input->post('instagram_handle', TRUE);
		$linkedin_handle = $this->input->post('linkedin_handle', TRUE);
		$additional_info = ucwords($this->input->post('additional_info', TRUE));
		$data = array (
			'name' => $name,
			'phone' => $phone,
			'sex' => $sex,
			'date_of_birth' => $date_of_birth,
			'designation' => $designation,
			'residential_address' => $residential_address,
			'quote' => $quote,
			'facebook_handle' => $facebook_handle,
			'twitter_handle' => $twitter_handle,
			'instagram_handle' => $instagram_handle,
			'linkedin_handle' => $linkedin_handle,
			'additional_info' => $additional_info,
			'photo' => $photo,
			'photo_thumb' => $photo_thumb,
		);
		$this->db->where('id', $staff_id);
		return $this->db->update('staff', $data);
	}


	public function class_teacher_assignment($staff_id) { 
		$classes_assigned = ucwords($this->input->post('classes_assigned', TRUE));
		$subjects_assigned = ucwords($this->input->post('subjects_assigned', TRUE));
		$data = array(
			'classes_assigned' => $classes_assigned,
			'subjects_assigned' => $subjects_assigned,
		);
		$this->db->where('id', $staff_id);	
		$this->db->update('staff', $data);
	}
	
		
	public function message_staff($staff_id) {
		$message = nl2br(ucfirst($this->input->post('message', TRUE))); 
		$subject = 'Message from Admin';
		$y = $this->common_model->get_staff_details_by_id($staff_id);
		return email_user($y->email, $subject, $message); //email staff
    } 


    public function activate_staff($staff_id) { 
		$data = array (
			'active' => 'true',
		);
		$this->db->where('id', $staff_id);
		return $this->db->update('staff', $data);
	}


	public function deactivate_staff($staff_id) { 
		$data = array (
			'active' => 'false',
		);
		$this->db->where('id', $staff_id);
		return $this->db->update('staff', $data);
	}
	
	
	public function delete_staff_photo($staff_id) {
		$y = $this->common_model->get_staff_details_by_id($staff_id);
		if ($y->photo != NULL && $y->photo_thumb != NULL) {
			unlink('./assets/uploads/photos/staff/'.$y->photo); //delete the photo
			unlink('./assets/uploads/photos/staff/'.$y->photo_thumb); //delete the thumbnail
		}
    } 
	
	
	public function delete_staff($staff_id) {
		$y = $this->common_model->get_staff_details_by_id($staff_id);
		$this->delete_staff_photo($staff_id); //remove image files from server
		return $this->db->delete('staff', array('id' => $staff_id));
    }


    public function bulk_actions_staff() {
		$selected_rows = count($this->input->post('check_bulk_action', TRUE)); 
		$bulk_action_type = $this->input->post('bulk_action_type', TRUE);		
		$row_id = $this->input->post('check_bulk_action', TRUE);
		foreach ($row_id as $staff_id) {
			switch ($bulk_action_type) {
				case 'activate':
					$this->activate_staff($staff_id);
					$this->session->set_flashdata('status_msg', "{$selected_rows} staff activated successfully.");
				break;
				case 'deactivate':
					$this->deactivate_staff($staff_id);
					$this->session->set_flashdata('status_msg', "{$selected_rows} staff deactivated successfully.");
				break;
				case 'delete':
					$this->delete_staff($staff_id);
					$this->session->set_flashdata('status_msg', "{$selected_rows} staff deleted successfully.");
				break;
			}
		} 
	}



}