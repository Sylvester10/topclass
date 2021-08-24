<?php
defined('BASEPATH') or exit('Direct access to script not allowed');


class Message_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	

	public function contact_us() { 
		$name = ucwords($this->input->post('name', TRUE)); 
		$email = $this->input->post('email', TRUE);
		$subject = ucwords($this->input->post('subject', TRUE)); 
		$message = ucfirst($this->input->post('message', TRUE)); 
		$message = nl2br($message); 
        $data = array (
			'name' => $name,
			'email' => $email,
			'subject' => $subject,
			'message' => $message,
		);
		$this->db->insert('contact_messages', $data);

		//email admins
		$this->notify_admins($name, $email, $subject, $message);
	}


	private function notify_admins($name, $email, $subject, $message) {
		$school_name = school_name;
		$level = 1;
		$admins = $this->common_model->get_admins();
		$message = 	"Hi admin, <br />
					You have a new contact message from {$school_name}. <br />
					<b>Contact Details:</b><br /> 
					Name: {$name} <br />
					Email: {$email} <br /><br /> 
					{$message}";
		email_multiple($admins, $subject, $message); //email admins 
	}



	/* ===================== Admin ================= */
	public function get_message_details($msg_id)	{ 
		return $this->db->get_where('contact_messages', array('id' => $msg_id))->row();
	}


	public function get_messages($limit, $offset) {		
		$this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
		$this->db->order_by("date_sent", "DESC"); 
		$query = $this->db->get('contact_messages');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }


    public function count_messages() { 
		return $this->db->get_where('contact_messages')->num_rows();
	}


	public function get_latest_message() { 
		$this->db->order_by("date_sent", "DESC"); 
		$this->db->limit(1); //just one
		return $this->db->get_where('contact_messages')->row();
	}


	public function reply_message($msg_id) {
		$message = nl2br(ucfirst($this->input->post('message', TRUE))); 
		$y = $this->get_message_details($msg_id);
		$subject = 'RE: ' . $y->subject;
		$email = $y->email;
		return email_user($email, $subject, $message);
    } 


	public function delete_message($msg_id) {
		return $this->db->delete('contact_messages', array('id' => $msg_id));
    } 
	
	
	public function bulk_actions_messages() {
		$selected_rows = count($this->input->post('check_bulk_action', TRUE)); 
		$bulk_action_type = $this->input->post('bulk_action_type', TRUE);
		$row_id = $this->input->post('check_bulk_action', TRUE);		
		foreach ($row_id as $msg_id) {
			$this->delete_message($msg_id);
			$this->session->set_flashdata('status_msg', "{$selected_rows} messages deleted successfully.");
		} 
	}




	
}