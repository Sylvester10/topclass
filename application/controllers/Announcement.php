<?php
defined('BASEPATH') or die('Direct access not allowed');


class Announcement extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->admin_restricted();
		$this->admin_role_restricted('Announcement Manager'); //only admin with this role can access this module
		$this->load->model('announcement_model');
		$this->admin_details = $this->common_model->get_admin_details($this->session->admin_email);
	}

	
	

	public function index() {
		$this->admin_header('Announcement', 'Announcement');	
		$data['announcement'] = $this->announcement_model->get_announcement();
		$this->load->view('admin/publications/announcement/announcement', $data);
        $this->admin_footer();
	}

	
	public function update_announcement_ajax() {	
		$this->form_validation->set_rules('announcement', 'Announcement', 'trim|required');
		if ($this->form_validation->run())  {		
			$this->announcement_model->update_announcement();
			echo 1;	
		} else { 
			echo validation_errors();
		}
    }


    public function publish_announcement() { 
		$this->announcement_model->publish_announcement();
		$this->session->set_flashdata('status_msg', 'Announcement published successfully.');
		redirect($this->agent->referrer());
	}


	public function unpublish_announcement() { 
		$this->announcement_model->unpublish_announcement();
		$this->session->set_flashdata('status_msg', 'Announcement unpublished successfully.');
		redirect($this->agent->referrer());
	}



}
