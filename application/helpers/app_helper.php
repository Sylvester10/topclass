<?php
defined('BASEPATH') OR exit('No direct script access allowed');


	function check_javascript_enabled() { 
		$CI = & get_instance(); //get instance of code igniter super object so helpers can be accessed outside of object context
		?>
			<!-- No JavaScript -->
			<noscript>
				<?php
				//check current page to ensure redirect doesn't apply to the no_js page
				$current_method = $CI->router->fetch_method();
				if ($current_method != 'no_js') { ?>
					<meta http-equiv="refresh" content="0; url=<?php echo base_url('no_js'); ?>" />
				<?php } ?>
			</noscript>
		<?php
	}


	function admin_roles() {
		$roles = array(
			'All Roles',
			'Announcement Manager',
			'News Manager',
			'Newsletter Manager',
			'Events Manager',
			'Gallery Manager',
			'Message Manager',
			'User Manager',
		);
		return $roles;
	}


	function staff_designations() {
		$staff_designations = array(
			'Class Teacher',
			'Class Assistant',
			'ICT Personnel',
			'Librarian',
			'Bursar',
			'Accountant',
			'Guidance Counsellor',
			'Sports Cordinator',
			'Cook',
			'Janitor',
			'Security Personnel',
		);
		return $staff_designations;
	}


	function get_firstname($full_name) { //get firstname from a string of names
		$full_name = trim($full_name);
		$names = explode(" ", $full_name); //break name string into an array of individual words
		if ( count($names) > 1 ) { //name contains at least 2 words
			$first_name = $names[1]; //array index 1, likely firstname
		} else {
			$first_name = $names[0]; //array index 0
		}
		return $first_name;
	}
	
	
	function custom_validation_errors() {
		if ( validation_errors() ) { 
			return '<div class="alert alert-danger alert-dismissable text-center">
				<a href="#" class="close" data-dismiss="alert" aria-label="Close" title="Close"> &times; </a>'
				.validation_errors().
			'</div>';
		}
	} 
	

	function flash_message_success($message) {
		$CI = & get_instance(); //get instance of code igniter super object
		//success flash messages
		if ( $CI->session->flashdata($message) ) { 						
			return '<div class="alert alert-success alert-dismissable text-center">
						<a href="#" class="close" data-dismiss="alert" aria-label="Close" title="Close"> &times; </a>' 
						.$CI->session->flashdata($message).
					'</div>';
		}
	}
	
	
	function flash_message_danger($message) {
		$CI = & get_instance(); //get instance of code igniter super object
		//danger flash messages
		if ( $CI->session->flashdata($message) ) { 						
			return '<div class="alert alert-danger alert-dismissable text-center">
						<a href="#" class="close" data-dismiss="alert" aria-label="Close" title="Close"> &times; </a>' 
						.$CI->session->flashdata($message). 
					'</div>';
		}
	}

	
	function flash_message_warning($message) {
		$CI =& get_instance(); //get instance of code igniter super object
		//warning flash messages
		if ( $CI->session->flashdata($message) ) { 						
			return '<div class="alert alert-warning alert-dismissable text-center">
						<a href="#" class="close" data-dismiss="alert" aria-label="Close" title="Close"> &times; </a>' 
						.$CI->session->flashdata($message). 
					'</div>';
		}
	}
	
	
	function flash_message_info($message) {
		$CI =& get_instance(); //get instance of code igniter super object
		//info flash messages
		if ( $CI->session->flashdata($message) ) { 						
			return '<div class="alert alert-info alert-dismissable text-center">
						<a href="#" class="close" data-dismiss="alert" aria-label="Close" title="Close"> &times; </a>' 
						.$CI->session->flashdata($message). 
					'</div>';
		}
	}


	function generate_snippet($string, $max_characters) {
		$snippet = mb_strimwidth(strip_tags($string), 0, $max_characters, "...");
		return $snippet;
	}


	function x_day_number($date) { //eg 23
		return date("d", strtotime($date));
	}


	function x_day_ordinal($date) { //eg 23rd
		return date("jS", strtotime($date));
	}


	function x_month_short($date) { //eg Aug
		return date("M", strtotime($date));
	}


	function x_month_long($date) { //eg August
		return date("F", strtotime($date));
	}


	function x_year_short($date) { //eg 18
		return date("y", strtotime($date));
	}


	function x_year_long($date) { //eg 2018
		return date("Y", strtotime($date));
	}


	function x_date($date) { //format date in the form eg 23rd Aug, 2018 from timestamp in db
		return date("jS M, Y", strtotime($date));
	}


	function x_date_full($date) { //format date in the form eg 23rd August, 2018 from timestamp in db
		return date("jS F, Y", strtotime($date));
	}


	function check_date($date) {
		return ($date != NULL) ? x_date($date) : '';
	}


	function x_time_12hour($date) { //eg 05:20 PM
		return date("h:i A", strtotime($date));
	}


	function x_time_24hour($date) { //eg 17:20
		return date("h:i A", strtotime($date));
	}


	function default_calendar_date() { //default date for bootstrap calendar box
		$current_day = date('Y/m/d'); //in the format yyyy/mm/dd
		return $current_day;
	}


	function default_html_date() { //default date for html calendar box
		$current_day = date('m/d/Y'); //in the format mm/dd/yyyy
		return $current_day;
	}


	function get_month_value_short($value) { 
		switch ($value) {
			case '01':
				return 'Jan';
				break;
			case '02':
				return 'Feb';
				break;
			case '03':
				return 'Mar';
				break;
			case '04':
				return 'Apr';
				break;
			case '05':
				return 'May';
				break;
			case '06':
				return 'Jun';
				break;
			case '07':
				return 'Jul';
				break;
			case '08':
				return 'Aug';
				break;
			case '09':
				return 'Sep';
				break;
			case '10':
				return 'Oct';
				break;
			case '11':
				return 'Nov';
				break;
			case '12':
				return 'Dec';
				break;
		}
	}
	
	
	function get_month_value_long($value) { 
		switch ($value) {
			case '01':
				return 'January';
				break;
			case '02':
				return 'February';
				break;
			case '03':
				return 'March';
				break;
			case '04':
				return 'April';
				break;
			case '05':
				return 'May';
				break;
			case '06':
				return 'June';
				break;
			case '07':
				return 'July';
				break;
			case '08':
				return 'August';
				break;
			case '09':
				return 'September';
				break;
			case '10':
				return 'October';
				break;
			case '11':
				return 'November';
				break;
			case '12':
				return 'December';
				break;
		}
	}
	
	
	function get_month_value_short_array()	{ 
		$data = array(
			'01' => 'Jan',
			'02' => 'Feb',
			'03' => 'Mar',
			'04' => 'Apr',
			'05' => 'May',
			'06' => 'Jun',
			'07' => 'Jul',
			'08' => 'Aug',
			'09' => 'Sep',
			'10' => 'Oct',
			'11' => 'Nov',
			'12' => 'Dec'
		);
		return $data;
	}
	
	
	function get_month_value_long_array()	{ 
		$data = array(
			'01' => 'January',
			'02' => 'February',
			'03' => 'March',
			'04' => 'April',
			'05' => 'May',
			'06' => 'June',
			'07' => 'July',
			'08' => 'August',
			'09' => 'September',
			'10' => 'October',
			'11' => 'November',
			'12' => 'December'
		);
		return $data;
	}


	function time_ago($time) { //return time in ago
		//add mysql-server time difference to time;
		$time_diff = mysql_time_difference;
		$time = strtotime("+$time_diff hours", strtotime($time));
		$now = time(); //current time
		$units = 1; //units to show... eg. 9 hours ago, 3 weeks ago. 
		return strtolower(timespan($time, $now, $units)). ' ago';
    }


    function get_ordinal_number($number) {
		//NOTE: There is a CI4 helper function for this purpose using the inflector helper  
    	$ends = array('th','st','nd','rd','th','th','th','th','th','th');
    	if ((($number % 100) >= 11) && (($number%100) <= 13)) {
        	$ordninal = $number . 'th';
    	} else {
        	$ordninal = $number . $ends[$number % 10];
		}
		return $ordninal;
	}


	function get_ordinal_string($number) {
		//NOTE: There is a CI4 helper function for this purpose using the inflector helper  
    	$ends = array('th','st','nd','rd','th','th','th','th','th','th');
    	if ((($number % 100) >= 11) && (($number%100) <= 13)) {
        	$ordninal = 'th';
    	} else {
        	$ordninal = $ends[$number % 10];
		}
		return $ordninal;
	}


	function get_slug($title) { //get slug from titles and captions for use in URL
		$title = str_replace(' ', '-', $title);	//replace space in title with hyphen
		$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $title);	//allowed xters. Otherwise, remove
		return strtolower($slug);
	}


	function radio_value($current_value, $option_value) { 
		//check the selected radio value and set it as default (helpful when editing an entity that has a radio field)
		//this makes use of CI's set_radio() 3rd argument, which sets a radio field as default by setting its value to TRUE
		return ($current_value == $option_value) ? TRUE : NULL; 
    }
	
	
	function generate_image_thumb($file_name, $width, $height) { //function to resize image while maintaining aspect ratio
		$CI =& get_instance(); //get instance of code igniter super object
		//config for image library
		$config['image_library'] = 'gd2';
		$config['source_image'] = $CI->upload->upload_path.$file_name;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = $width;
		$config['height'] = $height;

		//load image library
		$CI->load->library('image_lib', $config);

		//resize image
		$CI->image_lib->resize();
		
		// handle if there is any problem
		if ( ! $CI->image_lib->resize()) {
			return $file_name; //if resize fails, return original image
		} else {
			$suffix = '_thumb.'; //eg cat.jpg becomes cat_thumb.jpg
			$image_thumb = str_ireplace('.', $suffix, $file_name); //add suffix
			return $image_thumb;
		}
	}


	function generate_image_preview() { //generate image preview
		require "application/helpers/templates/image_preview.php";
	}


	function pagination_links($links, $ul_class) {
		$link_list = "";
		foreach ($links as $link) {
			$link_list .= '<li>' . $link . '</li>';
		} 
		$pagination_links 	= 	'<ul class="' . $ul_class . '">'
				        			. $link_list .
				    			'</ul>';
		return $pagination_links;
	}


	function user_avatar_table($user_photo, $image_src, $default_avatar) {
		if ($user_photo != NULL) {
			$avatar = '<a target="_blank" href="'.$image_src.'"><img class="avatar" src="'.$image_src.'" /></a>';
		} else {
			$avatar = '<img class="avatar" src="'.$default_avatar.'" />';
		}
		return $avatar;
	}


    function checkbox_bulk_action($id)	{ 
		return '<input type="checkbox" class="flat bulk_select_box" name="check_bulk_action[]" value="' .$id. '" />';
	}


    function bulk_select_options($options) {
		$select_options = "";
		foreach ($options as $value => $caption) {
			$select_options .= '<option value="'.$value.'" >'.$caption.'</option>';
		} 
		return $select_options;
	}


    function modal_bulk_actions($form_url, $options) {
    	require "application/helpers/templates/modals/modal_bulk_actions.php";
	}


	function modal_bulk_actions_alt($form_url, $options) {
    	require "application/helpers/templates/modals/modal_bulk_actions_alt.php";
	}
	
	
	function delete_bulk_items($column, $table) { //remind to remove
		$CI =& get_instance();
		$row_id = $CI->input->post('check_bulk_action', TRUE);		
		foreach ($row_id as $id) {
			$CI->db->delete($table, array($column => $id));
		} 
	}


	function modal_delete_confirm($id, $title, $item, $url, $custom_msg = NULL) { 
    	return '<div class="modal fade" id="delete'.$id.'" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<div class="pull-right">
							<button class="btn btn-danger btn-sm modal_close_btn" data-dismiss="modal" class="close" title="Close"> &times;</button>
						</div>
						<h4 class="modal-title">Delete: ' . $title . '</h4>
					</div><!--/.modal-header-->
					<div class="modal-body">
						Are you sure you want to permanently delete this <?php echo $item; ?>
						<p class="m-t-10">' . $custom_msg . '</p>
					</div>
					<div class="modal-footer">
						<a class="btn btn-sm btn-danger" role="button" href="' . base_url($url.'/'.$id) . '"> Yes, Delete </a>
						<button data-dismiss="modal" class="btn btn-sm"> No, Cancel </button>
					</div>
				</div>
			</div>
		</div>';
	}
	
	

	