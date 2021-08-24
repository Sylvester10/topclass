<?php
defined('BASEPATH') or die('Direct access not allowed');


class News extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->admin_restricted(); //allow only logged in users to access this class
		$this->admin_role_restricted('News Manager'); //only admin with this role can access this module
		$this->load->model('news_model');
		$this->admin_details = $this->common_model->get_admin_details($this->session->admin_email);
	}



	/* ====== News ====== */
	public function news_articles() {
		$inner_page_title = 'News (' . $this->news_model->count_news() . ')';
		$this->admin_header('News', $inner_page_title);
		//config for pagination
        $config = array();
		$per_page = 5;  //number of items to be displayed per page
        $uri_segment = 3;  //pagination segment id
		$config["base_url"] = base_url('news/news_articles');
        $config["total_rows"] = $this->news_model->count_news();
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
		$data["news"] = $this->news_model->get_news($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links); //explode the links 1 2 3 4 into distinct items for styling.
		$data['total_records'] = $this->news_model->count_news();
		$data['total_published'] = $this->news_model->count_published_news();
		$data['total_unpublished'] = $this->news_model->count_unpublished_news();
		$this->load->view('admin/publications/news/news_articles', $data);
		$this->admin_footer();
	}
	
	
	public function single_news($post_id, $slug) {
		//check news exists
		$this->check_data_exists($post_id, 'id', 'news', 'news/news_articles');
		$this->check_data_exists($slug, 'slug', 'news', 'news/news_articles');
		$news_details = $this->news_model->get_news_details($post_id);
		$total_comments = $this->news_model->count_post_comments($post_id);
		$title = $news_details->title;
		$this->admin_header($title, $title);

		//config for comment pagination
        $config = array();
		$per_page = 2;  //number of items to be displayed per page
        $uri_segment = 5;  //pagination segment id
		$config["base_url"] = base_url('news/single_news/'.$post_id.'/'.$slug);
        $config["total_rows"] = $total_comments;
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

		//initize config using the pagination library
        $this->pagination->initialize($config);

		$page = $this->uri->segment($uri_segment) ? $this->uri->segment($uri_segment) : 0;
		$data["comments"] = $this->news_model->get_comments_by_post_id($post_id, $per_page, $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links); //explode the links 1 2 3 4 into distinct items for styling.
		$data['total_comments'] = $total_comments;
		$data['y'] = $news_details;
		$data['post_id'] = $post_id;
		$this->load->view('admin/publications/news/single_news', $data);
		$this->admin_footer();
	}
	
	
	public function create_news($error = array('error' => '')) { 
		$this->admin_header('Create News', 'Create News');
		$this->load->view('admin/publications/news/create_news', $error);
		$this->admin_footer();
	}
	
	
	public function create_news_action() {	
		$this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[120]');
		$this->form_validation->set_rules('body', 'Body', 'trim|required');
        
		//config for file uploads
        $config['upload_path']          = './assets/uploads/news'; //path to save the files
        $config['allowed_types']        = 'jpg|JPG|jpeg|JPEG|png|PNG';  //extensions which are allowed
        $config['max_size']             = 1024 * 2; //filesize cannot exceed 2MB
        $config['file_ext_tolower']     = TRUE; //force file extension to lower case
	    $config['remove_spaces']        = TRUE; //replace space in file names with underscores to avoid break
	    $config['detect_mime']          = TRUE; //detect type of file to avoid code injection
		
		$this->load->library('upload', $config);
		
		if ($this->form_validation->run())  {	
			
			if ( $_FILES['featured_image']['name'] == "" ) { //file is not selected
				$this->session->set_flashdata('status_msg_error', 'No file selected.');
				redirect(site_url('news/create_news'));
				
			} elseif ( ( ! $this->upload->do_upload('featured_image')) && ($_FILES['featured_image']['name'] != "") ) { 	
				//upload does not happen when file is selected
				$error = array('error' => $this->upload->display_errors());
				$this->create_news($error); //reload page with upload errors
				
			} else { //file is selected, upload happens, everyone is happy
				$featured_image = $this->upload->data('file_name');
				//generate thumbnail of the image with dimension 85x75
				$thumbnail = generate_image_thumb($featured_image, '85', '75');		
				$this->news_model->create_news($featured_image, $thumbnail);
				$this->session->set_flashdata('status_msg', 'News article created and published successfully.');
				redirect(site_url('news/news_articles')); 
			}
			
		} else { 
			$this->create_news(); //validation fails, reload page with validation errors
		}
    }
	
	
	public function edit_news($post_id, $error = array('error' => '')) { 
		//check news exists
		$this->check_data_exists($post_id, 'id', 'news', 'news/news_articles');
		$this->admin_header('Edit News', 'Edit News');
		$data['y'] = $this->news_model->get_news_details($post_id);	
		$data['upload_error'] = $error;
		$this->load->view('admin/publications/news/edit_news', $data);
		$this->admin_footer();
	}
	
	
	public function edit_news_action($post_id, $error = array('error' => '')) {	
		//check news exists
		$this->check_data_exists($post_id, 'id', 'news', 'news/news_articles');
		$this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[120]');
		$this->form_validation->set_rules('body', 'Body', 'trim|required');
        
		//config for file uploads
        $config['upload_path']          = './assets/uploads/news'; //path to save the files
        $config['allowed_types']        = 'jpg|JPG|jpeg|JPEG|png|PNG';  //extensions which are allowed
        $config['max_size']             = 1024 * 2; //filesize cannot exceed 2MB
        $config['file_ext_tolower']     = TRUE; //force file extension to lower case
	    $config['remove_spaces']        = TRUE; //replace space in file names with underscores to avoid break
	    $config['detect_mime']          = TRUE; //detect type of file to avoid code injection
		
		$this->load->library('upload', $config);
		
		$y = $this->news_model->get_news_details($post_id);	
		if ($this->form_validation->run())  {	
			
			if ( $_FILES['featured_image']['name'] == "" ) { //file is not selected
			
				$featured_image = $y->featured_image; //old featured image
				$thumbnail = $y->featured_image_thumb; //old thumbnail
				$this->news_model->edit_news($post_id, $featured_image, $thumbnail);
				$this->session->set_flashdata('status_msg', 'News article updated successfully.');
				redirect(site_url('news/edit_news/'.$post_id)); 
				
			} elseif ( ( ! $this->upload->do_upload('featured_image')) && ($_FILES['featured_image']['name'] != "") ) { 	
				//upload does not happen when file is selected
				$error = array('error' => $this->upload->display_errors());
				$this->edit_news($post_id, $error); //reload page with upload errors
				
			} else { //file is selected, upload happens, everyone is happy
				
				//delete old featured image and thumbnail from server
				$this->news_model->delete_news_featured_image($post_id);
				
				$featured_image = $this->upload->data('file_name');
				//generate thumbnail of the image with dimension 85x75
				$thumbnail = generate_image_thumb($featured_image, '85', '75');		
				$this->news_model->edit_news($post_id, $featured_image, $thumbnail);
				$this->session->set_flashdata('status_msg', 'News article updated successfully.');
				redirect(site_url('news/edit_news/'.$post_id)); 
			}
			
		} else { 
			$this->edit_news($post_id, $error); //validation fails, reload page with validation errors
		}
    }
	
	
	public function publish_news($post_id) { 
		$this->news_model->publish_news($post_id);
		$this->session->set_flashdata('status_msg', 'News article published successfully.');
		redirect($this->agent->referrer());
	}
	
	
	public function unpublish_news($post_id) { 
		$this->news_model->unpublish_news($post_id);
		$this->session->set_flashdata('status_msg', 'News article unpublished successfully.');
		redirect($this->agent->referrer());
	}
	
	
	public function delete_news($post_id) { 
		$this->news_model->delete_news($post_id);
		$this->session->set_flashdata('status_msg', 'News article deleted successfully.');
		redirect($this->agent->referrer());
	}
	
	
	public function bulk_actions_news() { 
		$this->form_validation->set_rules('check_bulk_action', 'Bulk Select', 'trim');
		$selected_rows = count($this->input->post('check_bulk_action', TRUE)); 
		if ($this->form_validation->run()) {
			if ($selected_rows > 0) {
				$this->news_model->bulk_actions_news();
			} else {
				$this->session->set_flashdata('status_msg_error', 'No item selected.');
			}
		} else {
			$this->session->set_flashdata('status_msg_error', 'Bulk action failed!');
		}
		redirect($this->agent->referrer());
	}



	/* ========== Comments ============= */
	public function delete_comment($comment_id) { 
		$post_id = $this->get_comment_details($comment_id)->post_id;
		$slug = $this->get_news_details($post_id)->slug;
		$this->news_model->delete_comment($comment_id);
		$this->session->set_flashdata('status_msg', 'Comment deleted successfully.');
		redirect('news/single_news/'.$post_id.'/'.$slug);
	}
	
	


}