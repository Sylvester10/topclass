<?php
defined('BASEPATH') or die('Direct access not allowed');

class Gallery extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->admin_restricted(); //allow only logged in users to access this class
		$this->admin_role_restricted('Gallery Manager'); //only admin with this role can access this module
		$this->load->model('gallery_model');
		$this->admin_details = $this->common_model->get_admin_details($this->session->admin_email); 
	}


	public function photos() {
		$total_photos = $this->gallery_model->count_photos();
		$inner_page_title = 'Gallery Photos (' . $total_photos . ')'; 
		$this->admin_header('Gallery Photos', $inner_page_title);
		//config for pagination
        $config = array();
		$per_page = 12;  //number of items to be displayed per page
        $uri_segment = 3;  //pagination segment id: gallery/photos/pagination_id
		$config["base_url"] = base_url('gallery/photos');
        $config["total_rows"] = $total_photos;
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
		$data["photos"] = $this->gallery_model->get_photos($config["per_page"], $page);
		$data["total_records"] = $config["total_rows"];
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links); //explode the links 1 2 3 4 into distinct items for styling.
        $data['total_records'] = $this->gallery_model->count_photos();
        $data['total_published'] = $this->gallery_model->count_published_photos();
		$data['total_unpublished'] = $this->gallery_model->count_unpublished_photos();
		$this->load->view('admin/gallery/photos', $data);
		$this->admin_footer();
	}




	/* ========== Admin Actions: Photos ============= */
	public function upload_photo_ajax() {
   		if ( ! empty($_FILES) ) {

			//config for file uploads
	        $config['upload_path']          = './assets/uploads/gallery'; //path to save the files
	        $config['allowed_types']        = 'jpg|JPG|jpeg|JPEG|png|PNG';  //extensions which are allowed
	        $config['max_size']             = 1024 * 2; //filesize cannot exceed 2MB
	        $config['file_ext_tolower']     = TRUE; //force file extension to lower case
		    $config['remove_spaces']        = TRUE; //replace space in file names with underscores to avoid break
		    $config['detect_mime']          = TRUE; //detect type of file to avoid code injection
			
			$this->load->library('upload', $config);

			// File upload
			if ($this->upload->do_upload('file')) {
				// Get data about the file
				$photo = $this->upload->data('file_name');
				$this->gallery_model->upload_photo($photo);
			}
     	}
   	}


	public function update_photo_gallery() {
		$this->session->set_flashdata('status_msg', 'Gallery updated successfully.');
		redirect($this->agent->referrer());
	}


	public function publish_photo($photo_id) { 
		$this->gallery_model->publish_photo($photo_id);
		$this->session->set_flashdata('status_msg', 'Photo published successfully.');
		redirect($this->agent->referrer());
	}
	

	public function unpublish_photo($photo_id) { 
		//check photo exists
		$this->check_data_exists($photo_id, 'id', 'galleries', 'gallery/photos');
		$this->gallery_model->unpublish_photo($photo_id);
		$this->session->set_flashdata('status_msg', 'Photo unpublished successfully.');
		redirect($this->agent->referrer());
	}


	public function delete_photo($photo_id) {
		//check photo exists
		$this->check_data_exists($photo_id, 'id', 'galleries', 'gallery/photos');
		$this->gallery_model->delete_photo($photo_id);
		$this->session->set_flashdata('status_msg', 'Photo deleted successfully.');
		redirect($this->agent->referrer());
	}


	public function bulk_actions_photos() { 
		$this->form_validation->set_rules('check_bulk_action', 'Bulk Select', 'trim');
		$selected_rows = count($this->input->post('check_bulk_action', TRUE)); 
		if ($this->form_validation->run()) {
			if ($selected_rows > 0) {
				$this->gallery_model->bulk_actions_photos();
			} else {
				$this->session->set_flashdata('status_msg_error', 'No item selected.');
			}
		} else {
			$this->session->set_flashdata('status_msg_error', 'Bulk action failed!');
		}
		redirect($this->agent->referrer());
	}
	





}