<?php
defined('BASEPATH') or die('Direct access not allowed');


class Events extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->admin_restricted(); //allow only logged in users to access this class
		$this->admin_role_restricted('Events Manager'); //only admin with this role can access this module
		$this->load->model('events_model');
		$this->admin_details = $this->common_model->get_admin_details($this->session->admin_email);
	}



	public function upcoming_events() {
		$total_events = $this->events_model->count_upcoming_events();
		$inner_page_title = 'Upcoming Events (' . $total_events . ')'; 
		$this->admin_header('Upcoming Events', $inner_page_title);
		//config for pagination
        $config = array();
		$per_page = 5;  //number of items to be displayed per page
        $uri_segment = 3;  //pagination segment id: events/events_list/pagination_id
		$config["base_url"] = base_url('events/upcoming_events');
        $config["total_rows"] = $total_events;
        $config["per_page"] = $per_page;
		$config["uri_segment"] = $uri_segment;
		$config['cur_tag_open'] = '<a class="pagination-active-page" href="#!">';	//disable click event of current link
        $config['cur_tag_close'] = '</a>';
        $config['first_link'] = 'First';
        $config['next_link'] = '&raquo;';	// >>
        $config['prev_link'] = '&laquo;';	// <<
		$config['last_link'] = 'Last';
		$config['display_pages'] = TRUE; //show pagination link digits
		$config['num_links'] = 3; //number of digit links
        $this->pagination->initialize($config);
		$page = $this->uri->segment($uri_segment) ? $this->uri->segment($uri_segment) : 0;
		$data["events"] = $this->events_model->get_upcoming_events($config["per_page"], $page);
		$data["total_records"] = $config["total_rows"];
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links); //explode the links 1 2 3 4 into distinct items for styling.
        $data['total_records'] = $this->events_model->count_upcoming_events();
		$data['total_published'] = $this->events_model->count_published_upcoming_events();
		$data['total_unpublished'] = $this->events_model->count_unpublished_upcoming_events();
		$this->load->view('admin/publications/events/upcoming_events', $data);
		$this->admin_footer();
	}



	public function events_list() {
		$total_events = $this->events_model->count_events();
		$inner_page_title = 'All Events (' . $total_events . ')'; 
		$this->admin_header('All Events', $inner_page_title);
		//config for pagination
        $config = array();
		$per_page = 5;  //number of items to be displayed per page
        $uri_segment = 3;  //pagination segment id: events/events_list/pagination_id
		$config["base_url"] = base_url('events/events_list');
        $config["total_rows"] = $total_events;
        $config["per_page"] = $per_page;
		$config["uri_segment"] = $uri_segment;
		$config['cur_tag_open'] = '<a class="pagination-active-page" href="#!">';	//disable click event of current link
        $config['cur_tag_close'] = '</a>';
        $config['first_link'] = 'First';
        $config['next_link'] = '&raquo;';	// >>
        $config['prev_link'] = '&laquo;';	// <<
		$config['last_link'] = 'Last';
		$config['display_pages'] = TRUE; //show pagination link digits
		$config['num_links'] = 3; //number of digit links
        $this->pagination->initialize($config);
		$page = $this->uri->segment($uri_segment) ? $this->uri->segment($uri_segment) : 0;
		$data["events"] = $this->events_model->get_events_list($config["per_page"], $page);
		$data["total_records"] = $config["total_rows"];
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links); //explode the links 1 2 3 4 into distinct items for styling.
        $data['total_records'] = $this->events_model->count_events();
		$data['total_published'] = $this->events_model->count_published_events();
		$data['total_unpublished'] = $this->events_model->count_unpublished_events();
		$this->load->view('admin/publications/events/events_list', $data);
		$this->admin_footer();
	}


	public function create_event() { 
		$this->admin_header('Create Event', 'Create Event');
		$this->load->view('admin/publications/events/create_event');
		$this->admin_footer();
	}
	
	
	public function create_event_ajax() { 
		$this->form_validation->set_rules('event_date', 'Date', 'required');
		$this->form_validation->set_rules('time', 'Time', 'trim|required');
		$this->form_validation->set_rules('caption', 'Event Caption', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim|required');
		$this->form_validation->set_rules('venue', 'Venue', 'trim|required');
		if ($this->form_validation->run())  {		
			$this->events_model->create_event();
			echo 1;
		} else {
			echo validation_errors();
		}
	}


	public function edit_event($id) { 
		//check event exists
		$this->check_data_exists($id, 'id', 'events', 'admin');
		$y = $this->events_model->get_event_details($id);
		$inner_page_title = 'Edit Event: ' . $y->caption;
		$this->admin_header('Create Event', $inner_page_title);
		$data['y'] = $y;
		$this->load->view('admin/publications/events/edit_event', $data);
		$this->admin_footer();
	}
	
	
	public function edit_event_ajax($id) { 
		//check event exists
		$this->check_data_exists($id, 'id', 'events', 'admin');
		$this->form_validation->set_rules('event_date', 'Date', 'required');
		$this->form_validation->set_rules('time', 'Time', 'trim|required');
		$this->form_validation->set_rules('caption', 'Event Caption', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim|required');
		$this->form_validation->set_rules('venue', 'Venue', 'trim|required');
		if ($this->form_validation->run())  {		
			$this->events_model->edit_event($id);
			echo 1;
		} else {
			echo validation_errors();
		}
	}


	public function publish_event($id) { 
		//check event exists
		$this->check_data_exists($id, 'id', 'events', 'admin');
		$this->events_model->publish_event($id);
		$this->session->set_flashdata('status_msg', 'Event published successfully.');
		redirect($this->agent->referrer());
	}
	
	
	public function unpublish_event($id) { 
		//check event exists
		$this->check_data_exists($id, 'id', 'events', 'admin');
		$this->events_model->unpublish_event($id);
		$this->session->set_flashdata('status_msg', 'Event unpublished successfully.');
		redirect($this->agent->referrer());
	}
	
	
	public function delete_event($id) { 
		//check event exists
		$this->check_data_exists($id, 'id', 'events', 'admin');
		$this->events_model->delete_event($id);
		$this->session->set_flashdata('status_msg', 'Event deleted successfully.');
		redirect($this->agent->referrer());
	}


	public function clear_events() { 
		$this->events_model->clear_events();
		$this->session->set_flashdata('status_msg', 'Events cleared successfully.');
		redirect($this->agent->referrer());
	}


	public function bulk_actions_events() { 
		$this->form_validation->set_rules('check_bulk_action', 'Bulk Select', 'trim');
		$selected_rows = count($this->input->post('check_bulk_action', TRUE)); 
		if ($this->form_validation->run()) {
			if ($selected_rows > 0) {
				$this->events_model->bulk_actions_events();
			} else {
				$this->session->set_flashdata('status_msg_error', 'No item selected.');
			}
		} else {
			$this->session->set_flashdata('status_msg_error', 'Bulk action failed!');
		}
		redirect($this->agent->referrer());
	}




}