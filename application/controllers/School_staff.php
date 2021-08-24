<?php
defined('BASEPATH') or die('Direct access not allowed');



class School_staff extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->admin_restricted(); //allow only logged in users to access this class
		$this->admin_role_restricted('User Manager'); //only admin with this role can access this module
		$this->load->model('school_staff_model');
		$this->admin_details = $this->common_model->get_admin_details($this->session->admin_email);
	}



	/* ========== All Staff ========== */
	public function index() {
		$inner_page_title = 'Staff (' . count($this->common_model->get_staff()) . ')'; 
		$this->admin_header('Staff', $inner_page_title);
		$this->load->view('admin/staff/all_staff');
        $this->admin_footer();
	}
	
	
	public function staff_ajax() {
		$this->load->model('admin/staff/staff_model_ajax', 'current_model');
		$list = $this->current_model->get_records();
		$data = array();
		foreach ($list as $y) {
			$image_src = base_url('assets/uploads/photos/staff/'.$y->photo);
			$avatar = user_avatar_table($y->photo, $image_src, user_avatar);
			$active = ($y->active == 'true') ? '<span class="text-success">Yes</span>' : '<span class="text-danger">No</span>';
			$row = array();	
			$row[] = checkbox_bulk_action($y->id);
			$row[] = $this->current_model->options($y->id) . $this->current_model->modals($y->id);
			$row[] = $avatar; 
			$row[] = $y->name; 
			$row[] = $y->sex; 
			$row[] = $y->email; 
			$row[] = $y->phone; 
			$row[] = $y->designation; 
			$row[] = $active; 
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->current_model->count_all_records(),
			"recordsFiltered" => $this->current_model->count_filtered_records(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}



	/* ========== Class Teachers ========== */
	public function class_teachers() {
		$this->load->model('admin/staff/class_teachers_model_ajax', 'current_model');
		$total_teachers = $this->current_model->count_all_records();
		$inner_page_title = 'Class Teachers (' . $total_teachers . ')'; 
		$this->admin_header('Class Teachers', $inner_page_title);
		$this->load->view('admin/staff/class_teachers');
        $this->admin_footer();
	}
	
	
	public function class_teachers_ajax() {
		$this->load->model('admin/staff/class_teachers_model_ajax', 'current_model');
		$list = $this->current_model->get_records();
		$data = array();
		foreach ($list as $y) {
			$image_src = base_url('assets/uploads/photos/staff/'.$y->photo);
			$avatar = user_avatar_table($y->photo, $image_src, user_avatar);
			$active = ($y->active == 'true') ? '<span class="text-success">Yes</span>' : '<span class="text-danger">No</span>';
			$row = array();	
			$row[] = checkbox_bulk_action($y->id);
			$row[] = $this->current_model->options($y->id) . $this->current_model->modals($y->id);
			$row[] = $avatar; 
			$row[] = $y->name; 
			$row[] = $y->sex; 
			$row[] = $y->designation; 
			$row[] = $y->classes_assigned; 
			$row[] = $y->subjects_assigned; 
			$row[] = $active; 
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->current_model->count_all_records(),
			"recordsFiltered" => $this->current_model->count_filtered_records(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}




	/* ========== New Staff ========== */
	public function new_staff($error = array('error' => '')) {
		$this->admin_header('New Staff', 'New Staff');
		$this->load->view('admin/staff/new_staff', $error);
        $this->admin_footer();
	}
	
	
	public function new_staff_action($error = array('error' => '')) { 
		// validation rules
		$this->form_validation->set_rules('name', 'Name', 'trim|min_length[2]|max_length[500]|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[staff.email]', 
			array('is_unique' => 'This email address is already registered as a staff.')
		);
		$this->form_validation->set_rules('phone', 'Mobile', 'trim|required|is_natural');
		$this->form_validation->set_rules('designation', 'Designation', 'trim|required');
		$this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'trim|required');
		$this->form_validation->set_rules('sex', 'Sex', 'required');
		$this->form_validation->set_rules('residential_address', 'Residential Address', 'trim|min_length[2]|max_length[500]');
		$this->form_validation->set_rules('quote', 'Favourite Quote', 'trim');
		$this->form_validation->set_rules('facebook_handle', 'Facebook Handle', 'trim');
		$this->form_validation->set_rules('twitter_handle', 'Twitter Handle', 'trim');
		$this->form_validation->set_rules('instagram_handle', 'Instagram Handle', 'trim');
		$this->form_validation->set_rules('linkedin_handle', 'LinkedIn Handle', 'trim');
		$this->form_validation->set_rules('additional_info', 'Additional Info', 'trim');
		
		//config for file uploads
        $config['upload_path']          = './assets/uploads/photos/staff'; //path to save the files
        $config['allowed_types']        = 'jpg|JPG|jpeg|JPEG|png|PNG';  //extensions which are allowed
        $config['max_size']             = 1024; //filesize cannot exceed 1MB
        $config['file_ext_tolower']     = TRUE; //force file extension to lower case
	    $config['remove_spaces']        = TRUE; //replace space in file names with underscores to avoid break
	    $config['detect_mime']          = TRUE; //detect type of file to avoid code injection
		
		$this->load->library('upload', $config);
		
		if ($this->form_validation->run())  {	
			
			if ( $_FILES['photo']['name'] == "" ) { //file is not selected
				$this->session->set_flashdata('status_msg_error', 'Staff photo not selected!');
				redirect('school_staff/new_staff');
				
			} elseif ( ( ! $this->upload->do_upload('photo')) && ($_FILES['photo']['name'] != "") ) { 	
				//upload does not happen when file is selected
				$error = array('error' => $this->upload->display_errors());
				$this->new_staff($error); //reload page with upload errors
				
			} else { //file is selected, upload happens, everyone is happy
				//generate a square-sized 100x100 photo_thumb
				$photo = $this->upload->data('file_name');
				$photo_thumb = generate_image_thumb($photo, '100', '100');
				$this->school_staff_model->add_new_staff($photo, $photo_thumb); //insert the data into db
				$this->session->set_flashdata('status_msg', 'New staff added successfully!');
				redirect('school_staff/new_staff');
			}
			
		} else { 
			$this->new_staff($error); //validation fails, reload page with validation errors
		}
	}
	
	


	/* ========== Staff Edit ========== */
	public function edit_staff($staff_id, $error = array('error' => '')) {
		//check staff exists
		$this->check_data_exists($staff_id, 'id', 'staff', 'admin');
		$staff_details = $this->common_model->get_staff_details_by_id($staff_id);
		$page_title = 'Edit Staff: '  . $staff_details->name;
		$this->admin_header($page_title, $page_title);
		$data['y'] = $staff_details;
		$data['upload_error'] = $error;
		$this->load->view('admin/staff/edit_staff', $data);
        $this->admin_footer();
	}


	public function edit_staff_action($staff_id, $error = array('error' => '')) { 
		//check staff exists
		$this->check_data_exists($staff_id, 'id', 'staff', 'admin');
		// validation rules
		$this->form_validation->set_rules('name', 'Name', 'trim|min_length[2]|max_length[500]|required');
		$this->form_validation->set_rules('phone', 'Mobile', 'trim|required|is_natural');
		$this->form_validation->set_rules('designation', 'Designation', 'trim|required');
		$this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'trim|required');
		$this->form_validation->set_rules('sex', 'Sex', 'required');
		$this->form_validation->set_rules('residential_address', 'Residential Address', 'trim|min_length[2]|max_length[500]');
		$this->form_validation->set_rules('quote', 'Favourite Quote', 'trim');
		$this->form_validation->set_rules('facebook_handle', 'Facebook Handle', 'trim');
		$this->form_validation->set_rules('twitter_handle', 'Twitter Handle', 'trim');
		$this->form_validation->set_rules('instagram_handle', 'Instagram Handle', 'trim');
		$this->form_validation->set_rules('linkedin_handle', 'LinkedIn Handle', 'trim');
		$this->form_validation->set_rules('additional_info', 'Additional Info', 'trim');
		
		//config for file uploads
        $config['upload_path']          = './assets/uploads/photos/staff'; //path to save the files
        $config['allowed_types']        = 'jpg|JPG|jpeg|JPEG|png|PNG';  //extensions which are allowed
        $config['max_size']             = 1024; //filesize cannot exceed 1MB
        $config['file_ext_tolower']     = TRUE; //force file extension to lower case
	    $config['remove_spaces']        = TRUE; //replace space in file names with underscores to avoid break
	    $config['detect_mime']          = TRUE; //detect type of file to avoid code injection
		
		$this->load->library('upload', $config);
		
		$y = $this->common_model->get_staff_details_by_id($staff_id);
		
		if ($this->form_validation->run())  {	
			
			if ( $_FILES['photo']['name'] == "" ) { //file is not selected, update with old photo_thumb
				$photo = $y->photo; //old photo_thumb photo
				$photo_thumb = $y->photo_thumb; //old photo_thumb
				$this->school_staff_model->edit_staff($staff_id, $photo, $photo_thumb); //update student info
				$this->session->set_flashdata('status_msg', "{$y->name} updated successfully.");
				redirect('school_staff/edit_staff/'.$staff_id);
				
			} elseif ( ( ! $this->upload->do_upload('photo')) && ($_FILES['photo']['name'] != "") ) { 	
				//upload does not happen when file is selected
				$error = array('error' => $this->upload->display_errors());
				$this->edit_staff($staff_id, $error); //reload page with upload errors
				
			} else { //file is selected, upload happens, everyone is happy
			
				//delete old photo and photo_thumb from server
				$this->school_staff_model->delete_staff_photo($staff_id);
				$photo = $this->upload->data('file_name');
				$photo_thumb = generate_image_thumb($photo, '100', '100');	
				$this->school_staff_model->edit_staff($staff_id, $photo, $photo_thumb);
				$this->session->set_flashdata('status_msg', "{$y->name} updated successfully.");
				redirect('school_staff/edit_staff/'.$staff_id);
			}
			
		} else { 
			$this->edit_staff($staff_id); //validation fails, reload page with validation errors
		}
	}



	/* ========== Class Teacher Assignment ========== */
	public function class_teacher_assignment($staff_id) {
		//check staff exists
		$this->check_data_exists($staff_id, 'id', 'staff', 'admin');
		$staff_details = $this->common_model->get_staff_details_by_id($staff_id);
		$page_title = 'Teacher Assignment: '  . $staff_details->name;
		$this->admin_header($page_title, $page_title);
		$data['y'] = $staff_details;
		$this->load->view('admin/staff/class_teacher_assignment', $data);
        $this->admin_footer();
	}


	public function class_teacher_assignment_ajax($staff_id) {
		//check staff exists
		$this->check_data_exists($staff_id, 'id', 'staff', 'admin');
		$this->form_validation->set_rules('classes_assigned', 'Class(es) Assigned', 'trim|required');
		$this->form_validation->set_rules('subjects_assigned', 'Subject(s) Assigned', 'trim|required');
		if ($this->form_validation->run())  {		
			$this->school_staff_model->class_teacher_assignment($staff_id);
			echo 1;	
		} else { 
			echo validation_errors();
		}
    }
	
	
	
	
	/* ========== Staff Profile ========== */
	public function staff_profile($staff_id) {
		//check staff exists
		$this->check_data_exists($staff_id, 'id', 'staff', 'admin');
		$staff_details = $this->common_model->get_staff_details_by_id($staff_id);
		$page_title = 'Staff Profile: '  . $staff_details->name;
		$this->admin_header($page_title, $page_title);
		$data['y'] = $staff_details;
		$this->load->view('admin/staff/staff_profile', $data);
        $this->admin_footer();
	}
	
	
	
	public function message_staff($staff_id) { 
		//check admin exists
		$this->check_data_exists($staff_id, 'id', 'staff', 'admin');
		$this->form_validation->set_rules('message', 'Message', 'trim|required');
		$y = $this->common_model->get_staff_details_by_id($staff_id);
		if ($this->form_validation->run())  {		
			$this->school_staff_model->message_staff($staff_id);
			$this->session->set_flashdata('status_msg', "Message successfully sent to {$y->name}.");
		} else {
			$this->session->set_flashdata('status_msg_error', 'Error sending message to staff.');
		}
		redirect($this->agent->referrer());
	}


	public function activate_staff($staff_id) { 
		$this->school_staff_model->activate_staff($staff_id);
		$this->session->set_flashdata('status_msg', 'Staff activated successfully.');
		redirect($this->agent->referrer());
	}


	public function deactivate_staff($staff_id) { 
		$this->school_staff_model->deactivate_staff($staff_id);
		$this->session->set_flashdata('status_msg', 'Staff de-activated successfully.');
		redirect($this->agent->referrer());
	}
	
	
	public function delete_staff($staff_id) {   
		//check admin exists
		$this->check_data_exists($staff_id, 'id', 'staff', 'admin');
		$this->school_staff_model->delete_staff($staff_id);
		$this->session->set_flashdata('status_msg', 'Staff deleted successfully.');
		redirect($this->agent->referrer());
	}
	
	
	public function bulk_actions_staff() { 
		$this->form_validation->set_rules('check_bulk_action', 'Bulk Select', 'trim');
		$selected_rows = count($this->input->post('check_bulk_action', TRUE)); 
		if ($this->form_validation->run()) {
			if ($selected_rows > 0) {
				$this->school_staff_model->bulk_actions_staff();
			} else {
				$this->session->set_flashdata('status_msg_error', 'No item selected.');
			}
		} else {
			$this->session->set_flashdata('status_msg_error', 'Bulk action failed!');
		}
		redirect($this->agent->referrer());
	}

	

	
	
}