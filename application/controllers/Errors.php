<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends MY_Controller {
	public function __construct() {
		parent::__construct();
	}



	//404: Page not found!
	public function error404() //routed as error404. Set as 404_override method in routes 
	{	
		$this->header('Error 404');
		$this->load->view('errors/html/error404');
		$this->footer();
	}


	/*
	Note: This method is loaded when the <noscript></noscript> tag is detected (as set in the <head></head> tag) 
	Action: checks if javascript is enabled and redirects user to this page, requesting JS to be enabled before continuing
	*/
	public function no_js() //routed as no_js
	{	
		$this->header('No JavaScript');
		$this->load->view('errors/html/no_js');
		$this->footer();
	}



}