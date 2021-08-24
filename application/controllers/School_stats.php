<?php
defined('BASEPATH') or die('Direct access not allowed');

class School_stats extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->admin_restricted(); //allow only logged in users to access this class
		$this->admin_role_restricted('All Roles'); //only admin with this role can access this module
		$this->load->model('school_stats_model');
		$this->admin_details = $this->common_model->get_admin_details($this->session->admin_email); 
	}



	public function index() {
		$this->admin_header('School Statistics', 'School Statistics');	
		$data['s'] = $this->school_stats_model->get_school_stats();
		$this->load->view('admin/school_stats/update_stats', $data);
        $this->admin_footer();
	}

	
	public function update_school_stats_ajax() {	
		$this->form_validation->set_rules('students', 'Students', 'trim|required|is_natural');
		$this->form_validation->set_rules('teachers', 'Teachers', 'trim|required|is_natural');
		$this->form_validation->set_rules('staff', 'Staff', 'trim|required|is_natural');
		$this->form_validation->set_rules('classes', 'Classes', 'trim|required|is_natural');
		$this->form_validation->set_rules('school_buses', 'School Buses', 'trim|required|is_natural');
		if ($this->form_validation->run())  {		
			$this->school_stats_model->update_school_stats();
			echo 1;	
		} else { 
			echo validation_errors();
		}
    }


}