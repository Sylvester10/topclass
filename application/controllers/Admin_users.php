<?php
defined('BASEPATH') or die('Direct access not allowed');



class Admin_users extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->admin_restricted(); //allow only logged in users to access this class
		$this->admin_role_restricted('User Manager'); //only admin with this role can access this module
		$this->load->model('admin_users_model');
		$this->admin_details = $this->common_model->get_admin_details($this->session->admin_email);
	}



	
	public function index() {
		$inner_page_title = 'Admins (' .count($this->common_model->get_admins()). ')'; 
		$this->admin_header('Admins', $inner_page_title);
		$this->load->view('admin/admin_users/admins');
        $this->admin_footer();
	}
	
	
	public function admins_ajax() {
		$this->load->model('admin/admins/admin_users_model_ajax', 'current_model');
		$list = $this->current_model->get_records();
		$data = array();
		foreach ($list as $y) {
			$row = array();	
			$row[] = checkbox_bulk_action($y->id);
			$row[] = $this->current_model->options($y->id) . $this->current_model->modals($y->id);
			$row[] = $y->name; 
			$row[] = $y->email; 
			$row[] = $y->phone; 
			$row[] = $y->roles; 
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




	/* ========== New Admin ========== */
	public function new_admin() {
		$this->admin_header('New Admin', 'New Admin');
		$this->load->view('admin/admin_users/new_admin');
        $this->admin_footer();
	}
	
	
	public function add_new_admin_ajax() {	
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[admins.email]', 
			array('is_unique' => 'This email address is already registered as an admin.')
		);
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required|is_natural');
		$this->form_validation->set_rules('roles[]', 'Roles', 'trim|required');
		if ($this->form_validation->run())  {		
			$this->admin_users_model->add_new_admin();
			echo 1;	
		} else { 
			echo validation_errors();
		}
    }
	
	
	public function edit_admin($id) {
		//check admin exists
		$this->check_data_exists($id, 'id', 'admins', 'admin');
		$admin_details = $this->common_model->get_admin_details_by_id($id);
		$page_title = 'Edit Admin: ' . $admin_details->name; 
		$this->admin_header($page_title, $page_title);
		$data['y'] = $admin_details;
		$this->load->view('admin/admin_users/edit_admin', $data);
        $this->admin_footer();
	}
	
	
	public function edit_admin_ajax($id) {	
		//check admin exists
		$this->check_data_exists($id, 'id', 'admins', 'admin');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required|is_natural');
		$this->form_validation->set_rules('roles[]', 'Roles', 'trim|required');
        if ($this->form_validation->run())  {		
			$this->admin_users_model->edit_admin($id);
			echo 1;	
		} else { 
			echo validation_errors();
		}
    }
	
	
	public function message_admin($id) { 
		//check admin exists
		$this->check_data_exists($id, 'id', 'admins', 'admin');
		$this->form_validation->set_rules('message', 'Message', 'trim|required');
		$y = $this->common_model->get_admin_details_by_id($id);
		if ($this->form_validation->run())  {		
			$this->admin_users_model->message_admin($id);
			$this->session->set_flashdata('status_msg', "Message successfully sent to {$y->name}.");
		} else {
			$this->session->set_flashdata('status_msg_error', 'Error sending message to admin.');
		}
		redirect($this->agent->referrer());
	}
	
	
	public function delete_admin($id) { 
		//check admin exists
		$this->check_data_exists($id, 'id', 'admins', 'admin');
		$this->admin_users_model->check_admin_level($id);
		$this->admin_users_model->delete_admin($id);
		$this->session->set_flashdata('status_msg', 'Admin deleted successfully.');
		redirect($this->agent->referrer());
	}
	
	
	public function delete_bulk_admins() { 
		$this->form_validation->set_rules('check_bulk_action', 'Bulk Select', 'trim');
		$selected_rows = count($this->input->post('check_bulk_action', TRUE)); 
		if ($this->form_validation->run()) {
			if ($selected_rows > 0) {
				$this->admin_users_model->delete_bulk_admins();
			} else {
				$this->session->set_flashdata('status_msg_error', 'No item selected.');
			}
		} else {
			$this->session->set_flashdata('status_msg_error', 'Bulk action failed!');
		}
		redirect($this->agent->referrer());
	}

	

	
	
}