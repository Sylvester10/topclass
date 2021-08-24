<?php
defined('BASEPATH') or exit('Direct access to script not allowed');


class School_stats_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}



	public function get_school_stats() { 
		$this->db->where('id', 1);
		return $this->db->get_where('school_stats')->row();
	}


	public function update_school_stats() {
		$students = $this->input->post('students', TRUE);
		$teachers = $this->input->post('teachers', TRUE);
		$staff = $this->input->post('staff', TRUE);
		$classes = $this->input->post('classes', TRUE);
		$school_buses = $this->input->post('school_buses', TRUE);
		$data = array (
			'students' => $students,
			'teachers' => $teachers,
			'staff' => $staff,
			'classes' => $classes,
			'school_buses' => $school_buses,
		);		 
		$this->db->where('id', 1);
		return $this->db->update('school_stats', $data);
    } 


}