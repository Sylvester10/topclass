<?php
defined('BASEPATH') or die('Direct access not allowed');


class Newsletter extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->admin_restricted(); //allow only logged in users to access this class
		$this->admin_role_restricted('Newsletter Manager'); //only admin with this role can access this module
		$this->load->model('newsletter_model');
		$this->admin_details = $this->common_model->get_admin_details($this->session->admin_email);
	}





	/* ====== Newsletters ====== */
	public function newsletters() {
		$inner_page_title = 'News (' . $this->newsletter_model->count_newsletters() . ')';
		$this->admin_header('Newsletters', $inner_page_title);	
		//config for pagination
        $config = array();
		$per_page = 2;  //number of items to be displayed per page
        $uri_segment = 3;  //pagination segment id
		$config["base_url"] = base_url('newsletter/newsletters');
        $config["total_rows"] = $this->newsletter_model->count_newsletters();
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
		$data["newsletters"] = $this->newsletter_model->get_newsletters($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links); //explode the links 1 2 3 4 into distinct items for styling.
		$data['total_records'] = $this->newsletter_model->count_newsletters();
		$data['total_published'] = $this->newsletter_model->count_published_newsletters();
		$data['total_unpublished'] = $this->newsletter_model->count_unpublished_newsletters();
		$this->load->view('admin/publications/newsletter/newsletters', $data);
		$this->admin_footer();
	}
	
	
	public function create_newsletter($error = array('error' => '')) { 
		$this->admin_header('Create Newsletter', 'Create Newsletter');
		$this->load->view('admin/publications/newsletter/create_newsletter', $error);
		$this->admin_footer();
	}
	
	
	public function create_newsletter_action() {	
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
        
		//config for file uploads
        $config['upload_path']          = './assets/uploads/newsletters'; //path to save the files
        $config['allowed_types']        = 'pdf|PDF';  //extensions which are allowed
        $config['max_size']             = 1024 * 5; //filesize cannot exceed 5MB
        $config['file_ext_tolower']     = TRUE; //force file extension to lower case
	    $config['remove_spaces']        = TRUE; //replace space in file names with underscores to avoid break
	    $config['detect_mime']          = TRUE; //detect type of file to avoid code injection
		
		$this->load->library('upload', $config);
		
		if ($this->form_validation->run())  {	
			
			if ( $_FILES['the_file']['name'] == "" ) { //file is not selected
				$this->session->set_flashdata('status_msg_error', 'No file selected.');
				redirect(site_url('newsletter/create_newsletter'));
				
			} elseif ( ( ! $this->upload->do_upload('the_file')) && ($_FILES['the_file']['name'] != "") ) { 	
				//upload does not happen when file is selected
				$error = array('error' => $this->upload->display_errors());
				$this->create_newsletter($error); //reload page with upload errors
				
			} else { //file is selected, upload happens, everyone is happy
				$the_file_name = $this->upload->data('file_name');
				$this->newsletter_model->create_newsletter($the_file_name);
				//check which button was clicked
				$submit_type = $this->input->post('submit_type', TRUE);
				$published = ($submit_type == 'create_publish') ? 'created and published' : 'created'; 	
				$this->session->set_flashdata('status_msg', "Newsletter {$published} successfully.");
				redirect(site_url('newsletter/newsletters')); 
			}
			
		} else { 
			$this->create_newsletter(); //validation fails, reload page with validation errors
		}
    }
	
	
	public function publish_newsletter($id) { 
		//check newsletter exists
		$this->check_data_exists($id, 'id', 'newsletters', 'newsletter/newsletters');
		$this->newsletter_model->publish_newsletter($id);
		$this->session->set_flashdata('status_msg', 'Newsletter published successfully.');
		redirect(site_url('newsletter/newsletters'));
	}
	
	
	public function unpublish_newsletter($id) { 
		//check newsletter exists
		$this->check_data_exists($id, 'id', 'newsletters', 'newsletter/newsletters');
		$this->newsletter_model->unpublish_newsletter($id);
		$this->session->set_flashdata('status_msg', 'Newsletter unpublished successfully.');
		redirect(site_url('newsletter/newsletters'));
	}
	
	
	public function delete_newsletter($id) { 
		//check newsletter exists
		$this->check_data_exists($id, 'id', 'newsletters', 'newsletter/newsletters');
		$this->newsletter_model->delete_newsletter($id);
		$this->session->set_flashdata('status_msg', 'Newsletter deleted successfully.');
		redirect(site_url('newsletter/newsletters'));
	}
	
	
	public function bulk_actions_newsletters() { 
		$this->form_validation->set_rules('check_bulk_action', 'Bulk Select', 'trim');
		$selected_rows = count($this->input->post('check_bulk_action', TRUE)); 
		if ($this->form_validation->run()) {
			if ($selected_rows > 0) {
				$this->newsletter_model->bulk_actions_newsletters();
			} else {
				$this->session->set_flashdata('status_msg_error', 'No item selected.');
			}
		} else {
			$this->session->set_flashdata('status_msg_error', 'Bulk action failed!');
		}
		redirect(site_url('newsletter/newsletters'));
	}




	/* ============ Subscribers =============== */
	public function subscribers() {
		$total_subscribers = count($this->newsletter_model->get_newsletter_subscribers());
		$inner_page_title = 'Subscribers (' . $total_subscribers . ')'; 
		$this->admin_header('Subscribers', $inner_page_title);	
		$data['total_subscribers'] = $total_subscribers;
		$this->load->view('admin/publications/newsletter/subscribers', $data);
        $this->admin_footer();
	}


	public function subscribers_ajax() {
		$this->load->model('admin/newsletter/subscribers_model_ajax', 'current_model');
		$list = $this->current_model->get_records();
		$data = array();
		foreach ($list as $y) {
			$row = array();	
			$row[] = $this->current_model->options($y->id) . $this->current_model->modals($y->id);
			$row[] = $y->name;
			$row[] = $y->email;
			$row[] = x_date($y->date);
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


	public function add_subscriber_ajax() {
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[newsletter_subscribers.email]',
			array(
				'is_unique' => 'This email address is already subscribed'
			)
		);
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		if ($this->form_validation->run()) {
			$this->newsletter_model->subscribe_newsletter();
			echo 1;
	    } else {	
			echo validation_errors();
		}
	}


	public function delete_subscriber($id) { 
		//check subscriber exists
		$this->check_data_exists($id, 'id', 'newsletter_subscribers', 'newsletter/subscribers');
		$y = $this->newsletter_model->get_subscriber_details($id);
		$email = $y->email;
		$this->newsletter_model->unsubscribe_newsletter($email);
		$this->session->set_flashdata('status_msg', 'Subscriber deleted successfully.');
		redirect(site_url('newsletter/subscribers'));
	}


	public function delete_all_subscribers() { 
		$this->newsletter_model->delete_all_subscribers();
		$this->session->set_flashdata('status_msg', 'Subscribers deleted successfully.');
		redirect(site_url('newsletter/subscribers'));
	}
	
	


}