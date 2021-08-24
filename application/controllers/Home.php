<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('message_model');
		$this->load->model('news_model');
		$this->load->model('newsletter_model');
		$this->load->model('events_model');
		$this->load->model('gallery_model');
		$this->load->model('school_stats_model');
		$this->load->model('school_staff_model');
	}


	public function index()
	{	
		$this->home_header('Home');
		$data['recent_photos'] = $this->gallery_model->get_recent_published_photos(6);
		$data['recent_news'] = $this->news_model->get_recent_published_news(2);
		$data['near_upcoming_events'] = $this->events_model->get_near_upcoming_events(2);
		$data['stats'] = $this->school_stats_model->get_school_stats();
		$this->load->view('home', $data);
		$this->footer();
	}


	public function classes()
	{	
		$this->header('Classes');
		$this->load->view('about/classes');
		$this->footer();
	}


	public function about()
	{	
		$this->header_with_sidebar('About Us');
		$this->load->view('about/about_us');
		$this->footer_with_sidebar();
	}


	public function staff2()
	{	
		$this->header('Our Staff');
		$data['class_teachers'] = class_teachers();
		$this->load->view('about/staff2', $data);
		$this->footer();
	}


	public function staff() {
		$this->header('Our Staff');
		//config for pagination
        $config = array();
		$per_page = 12;  //number of items to be displayed per page
        $uri_segment = 3;  //pagination segment id
		$config["base_url"] = base_url('home/staff');
        $config["total_rows"] = $this->school_staff_model->count_active_staff();
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
		$data["staff"] = $this->school_staff_model->get_active_staff($per_page, $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links); //explode the links 1 2 3 4 into distinct items for styling.
		$data['total_records'] = $this->school_staff_model->count_active_staff();
		$this->load->view('about/staff', $data);
		$this->footer();
	}


	public function anthem()
	{	
		$this->header('Anthem');
		$this->load->view('about/anthem');
		$this->footer();
	}


	public function contact()
	{	
		$this->header_with_sidebar('Contact Us');
		$data['captcha_code'] = mt_rand(111111, 999999);
		$this->load->view('contact', $data);
		$this->footer_with_sidebar();
	}


	public function contact_us_ajax() { 
		//form validation rules and file upload config
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
		$this->form_validation->set_rules('message', 'Message', 'trim|required');
		$this->form_validation->set_rules('captcha_code', 'Captcha Code', 'trim');
		$this->form_validation->set_rules('c_captcha_code', 'Captcha Code', 'trim|required|matches[captcha_code]',
			array(
				'required' => 'Captcha is required. Reload the page if you cannot see any code.',
				'matches' => 'Invalid captcha code'
			)
		);
		if ($this->form_validation->run())  {	
			$this->message_model->contact_us(); //insert the data into db
			echo 1;
		} else { 
			echo validation_errors();
		}
	}



	/* ====== Gallery ====== */
	public function gallery() {
		$this->header('Our Gallery');
		//config for pagination
        $config = array();
		$per_page = 12;  //number of items to be displayed per page
        $uri_segment = 3;  //pagination segment id
		$config["base_url"] = base_url('home/gallery');
        $config["total_rows"] = $this->gallery_model->count_published_photos();
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
		$data["photos"] = $this->gallery_model->get_published_photos($per_page, $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links); //explode the links 1 2 3 4 into distinct items for styling.
		$data['total_records'] = $this->gallery_model->count_published_photos();
		$this->load->view('gallery/photos', $data);
		$this->footer();
	}


	public function admission_nursery()
	{	
		$this->header_with_sidebar('Nursery Admissions');
		$this->load->view('admissions/nursery');
		$this->footer_with_sidebar();
	}


	public function admission_primary()
	{	
		$this->header_with_sidebar('Primary Admissions');
		$this->load->view('admissions/primary');
		$this->footer_with_sidebar();
	}


	public function curriculum()
	{	
		$this->header_with_sidebar('Our Curriculum');
		$this->load->view('about/curriculum');
		$this->footer_with_sidebar();
	}


	public function announcements()
	{	
		$this->header('Announcements');
		$this->load->view('news_events/announcements');
		$this->footer();
	}



	/* ====== News ====== */
	public function news() {
		$this->header_with_sidebar('News');	
		//config for pagination
        $config = array();
		$per_page = 2;  //number of items to be displayed per page
        $uri_segment = 3;  //pagination segment id
		$config["base_url"] = base_url('home/news');
        $config["total_rows"] = $this->news_model->count_published_news();
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
		$data["news"] = $this->news_model->get_published_news($per_page, $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links); //explode the links 1 2 3 4 into distinct items for styling.
		$data['total_records'] = $this->news_model->count_published_news();
		$this->load->view('publications/news/news', $data);
		$this->footer_with_sidebar();
	}


	public function single_news($post_id, $slug) {
		//check news exists
		$this->check_data_exists($post_id, 'id', 'news', 'home/news');
		$this->check_data_exists($slug, 'slug', 'news', 'home/news');
		$this->news_model->check_news_is_published($post_id);
		$this->header_with_sidebar('News Details');	
		$news_details = $this->news_model->get_news_details($post_id);
		$total_comments = $this->news_model->count_post_comments($post_id);
		
		//config for pagination
        $config = array();
		$per_page = 2;  //number of items to be displayed per page
        $uri_segment = 5;  //pagination segment id
		$config["base_url"] = base_url('home/single_news/'.$post_id.'/'.$slug);
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
		$this->load->view('publications/news/single_news', $data);
		$this->footer_with_sidebar();
	}


	public function create_comment_ajax($post_id) {
		//check news exists
		$this->check_data_exists($post_id, 'id', 'news', 'home/news');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('comment', 'Comment', 'trim|required');
		$this->form_validation->set_rules('captcha_code', 'Captcha Code', 'trim');
		$this->form_validation->set_rules('c_captcha_code', 'Captcha Code', 'trim|required|matches[captcha_code]',
			array(
				'required' => 'Captcha is required. Reload the page if you cannot see any code.',
				'matches' => 'Invalid captcha code'
			)
		);
		if ($this->form_validation->run()) {
			$this->news_model->create_comment($post_id);
			echo 1;
	    } else {	
			echo validation_errors();
		}
	}




	/* ====== Newsletters ====== */
	public function newsletters() {
		$this->header_with_sidebar('Newsletters');	
		//config for pagination
        $config = array();
		$per_page = 2;  //number of items to be displayed per page
        $uri_segment = 3;  //pagination segment id
		$config["base_url"] = base_url('home/newsletters');
        $config["total_rows"] = $this->newsletter_model->count_published_newsletters();
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
		$data["newsletters"] = $this->newsletter_model->get_published_newsletters($per_page, $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links); //explode the links 1 2 3 4 into distinct items for styling.
		$data['total_records'] = $this->newsletter_model->count_published_newsletters();
		$this->load->view('publications/newsletter/newsletters', $data);
		$this->footer_with_sidebar();
	}


	public function subscribe_newsletter_ajax() {
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[newsletter_subscribers.email]',
			array(
				'is_unique' => 'This email address is already subscribed to our newsletter'
			)
		);
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('captcha_code', 'Captcha Code', 'trim');
		$this->form_validation->set_rules('c_captcha_code', 'Captcha Code', 'trim|required|matches[captcha_code]',
			array(
				'required' => 'Captcha is required. Reload the page if you cannot see any code.',
				'matches' => 'Invalid captcha code'
			)
		);
		if ($this->form_validation->run()) {
			$this->newsletter_model->subscribe_newsletter();
			echo 1;
	    } else {	
			echo validation_errors();
		}
	}


	public function unsubscribe_newsletter()
	{	
		$this->header('Unsubscribe Newsletter');
		$this->load->view('publications/newsletter/unsubscribe_newsletter');
		$this->footer();
	}


	public function unsubscribe_newsletter_ajax() {
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$email = $this->input->post('email', TRUE);		
		$email_exists = $this->newsletter_model->check_subscriber_email_exists($email);
		if ($this->form_validation->run()) {
			if ( ! $email_exists ) {
				echo "This email address [{$email}] is not currently subscribed to our newsletter.";	
			} else { 
				$this->newsletter_model->unsubscribe_newsletter($email);
				echo 1;
			}
	    } else {	
			echo validation_errors();
		}
	}




	/* ====== Upcoming Events ====== */
	public function upcoming_events() {
		$this->header_with_sidebar('Upcoming Events');
		//config for pagination
        $config = array();
		$per_page = 2;  //number of items to be displayed per page
        $uri_segment = 3;  //pagination segment id
		$config["base_url"] = base_url('home/upcoming_events');
        $config["total_rows"] = $this->events_model->count_published_upcoming_events();
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
		$data["events"] = $this->events_model->get_published_upcoming_events($per_page, $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links); //explode the links 1 2 3 4 into distinct items for styling.
		$data['total_records'] = $this->events_model->count_published_upcoming_events();
		$this->load->view('publications/events/upcoming_events', $data);
		$this->footer_with_sidebar();
	}



	/* ====== All Events ====== */
	public function events() {
		$this->header_with_sidebar('All Events');	
		//config for pagination
        $config = array();
		$per_page = 2;  //number of items to be displayed per page
        $uri_segment = 3;  //pagination segment id
		$config["base_url"] = base_url('home/events');
        $config["total_rows"] = $this->events_model->count_published_events();
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
		$data["events"] = $this->events_model->get_published_events_list($per_page, $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links); //explode the links 1 2 3 4 into distinct items for styling.
		$data['total_records'] = $this->events_model->count_published_events();
		$this->load->view('publications/events/all_events', $data);
		$this->footer_with_sidebar();
	}


	public function single_event($event_id)
	{	
		//check news exists
		$this->check_data_exists($event_id, 'id', 'events', 'home/events');
		$this->header_with_sidebar('Event Details');
		$event_details = $this->events_model->get_event_details($event_id);
		$data['y'] = $event_details;
		$this->load->view('publications/events/single_event', $data);
		$this->footer_with_sidebar();
	}

	


}
