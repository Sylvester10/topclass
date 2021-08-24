<?php
defined('BASEPATH') or exit('Direct access to script not allowed');


class Announcement_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
		
	
	public function get_announcement() { 
		$this->db->where('id', 1);
		return $this->db->get_where('announcement')->row();
	}


	public function update_announcement() {
		$announcement = ucfirst($this->input->post('announcement', TRUE));
		$data = array (
			'announcement' => $announcement,
			'date' => date('Y-m-d H:i:s'), //current timestamp
		);		 
		$this->db->where('id', 1);
		return $this->db->update('announcement', $data);
    } 


    public function publish_announcement() {
		$data = array (
			'published' => 'true',
		);		 
		$this->db->where('id', 1);
		return $this->db->update('announcement', $data);
    } 


    public function unpublish_announcement() {
		$data = array (
			'published' => 'false',
		);		 
		$this->db->where('id', 1);
		return $this->db->update('announcement', $data);
    } 


 }