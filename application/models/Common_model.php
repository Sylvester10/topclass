<?php
defined('BASEPATH') or exit('Direct access to script not allowed');


class Common_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}



	/* ===== Last Login ===== */
	public function update_last_login($user_id, $table) {
		$data = array (
			'last_login' => date('Y-m-d H:i:s'), //curent timestamp	 
		);		 
        $this->db->where('id', $user_id);			
		return $this->db->update($table, $data);
	}


	public function get_last_login_stats($period, $period_type, $table) {
		$period_type = strtoupper($period_type);
		$where = 	"last_login IS NOT NULL AND 
					last_login > DATE_SUB(CURRENT_TIMESTAMP, INTERVAL {$period} {$period_type})";
	    $this->db->where($where);
		$query = $this->db->get($table)->num_rows();
		return $query;	
	}
	



	
	/* =================== Admins ====================== */
	public function get_admin_details($email) { //get admin info by email
		return $this->db->get_where('admins', array('email' => $email))->row();
	}
	
	
	public function get_admin_details_by_id($id) { //get admin info	id
		return $this->db->get_where('admins', array('id' => $id))->row();
	}
	
	
	public function get_admins() { //get all admins
		return $this->db->get_where('admins')->result();
	}




	/* =================== Staff ====================== */
	public function get_staff_details($email) { //get staff info by email
		return $this->db->get_where('staff', array('email' => $email))->row();
	}
	
	
	public function get_staff_details_by_id($id) { //get staff info by id
		return $this->db->get_where('staff', array('id' => $id))->row();
	}
	
	
	public function get_staff() { //get all staff
		return $this->db->get_where('staff')->result();
	}
	
	
}