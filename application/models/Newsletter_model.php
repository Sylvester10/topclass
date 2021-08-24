<?php
defined('BASEPATH') or exit('Direct access to script not allowed');


class Newsletter_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
		
	
	/* ===== Newsletters ===== */
	public function get_newsletter_details($id)	{ 
		return $this->db->get_where('newsletters', array('id' => $id))->row();
	}
	
	
	public function get_newsletters($limit, $offset) {		
		$this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
		$this->db->order_by("date", "DESC"); //order by date DESC i.e. latest newsletters first
		$query = $this->db->get_where('newsletters');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
            return false;
    }


    public function get_published_newsletters($limit, $offset) {		
		$this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
		$this->db->order_by("date", "DESC"); //order by date DESC i.e. latest newsletters first
		$query = $this->db->get_where('newsletters', array('published' => 'true'));
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
            return false;
    }


    public function count_newsletters() { 
		return $this->db->get('newsletters')->num_rows();
	}
	
	
	public function count_published_newsletters() { 
		return $this->db->get_where('newsletters', array('published' => 'true'))->num_rows();
	}
	
	
	public function count_unpublished_newsletters() { 
		return $this->db->get_where('newsletters', array('published' => 'false'))->num_rows();
	}




	/* ========= Newsletter Subscription ========= */
	public function get_newsletter_subscribers() { 
		return $this->db->get('newsletter_subscribers')->result();
	}


	public function get_subscriber_details($id)	{ 
		return $this->db->get_where('newsletter_subscribers', array('id' => $id))->row();
	}


	public function check_subscriber_email_exists($email) { 
		$this->db->where('email', $email);
		$query = $this->db->get('newsletter_subscribers')->num_rows();
		return ($query > 0) ? TRUE : FALSE;
	}


	public function subscribe_newsletter() { 
		$email = $this->input->post('email', TRUE);	
		$name = ucwords($this->input->post('name', TRUE));	
		$data = array (
			'email' => $email,
			'name' => $name,
		);
		return $this->db->insert('newsletter_subscribers', $data);
	}


	public function unsubscribe_newsletter($email) { 
		$this->db->where('email', $email);
		return $this->db->delete('newsletter_subscribers');
	}
	
	


	/* ========== Admin Actions ============= */
	public function create_newsletter($the_file) { 
		$title = ucwords($this->input->post('title', TRUE)); 	
		//check which button was clicked
		$submit_type = $this->input->post('submit_type', TRUE);
		$published = ($submit_type == 'create_publish') ? 'true' : 'false'; 	
		$data = array (
			'title' => $title,
			'the_file' => $the_file,
			'published' => $published,
		);
		$insert = $this->db->insert('newsletters', $data);
		$id = $this->db->insert_id($insert);
		
		//notify subscribers of newly created newsletter if submit type is create and publish
		if ($submit_type == 'create_publish') {
			$this->notify_subscribers_new_newsletter($id);
		}
	}
	
	
	private function notify_subscribers_new_newsletter($id) { 
		//notify parents by mail
		$y = $this->get_newsletter_details($id);
		$parents = $this->get_newsletter_subscribers();
		$subject = $y->title; 
		$download_link = $this->get_newsletter_file($id);
		$anchor_link = email_call2action_blue($download_link, 'Download Newsletter');
		$newsletter_url = base_url('home/newsletters');
		$unsubscribe_url = base_url('home/unsubscribe_newsletter');
		$message = 'Hi Sir/Ma, <br />
					We have published a new episode of our monthly newsletter.
					<br />'
					. $anchor_link . 
					'<p>You can also download any episode our newsletter from <a href="' . $newsletter_url . '">our website</a>. </p>
					<p>You received this mail because you subscribed or were subscribed to our monthly newsletter. If you\'d like to stop receiving this message in the future, please <a href="' . $unsubscribe_url . '">unsubscribe</a></p>';
		$attachment = $this->get_newsletter_file($id);
		email_multiple($parents, $subject, $message, $attachment); 
	}
	
	
	public function publish_newsletter($id) { 
		$data = array (
			'published' => 'true',
		);
		$this->db->where('id', $id);
		$this->db->update('newsletters', $data);

		//notify parents
		$this->notify_subscribers_new_newsletter($id);
	}
	
	
	public function unpublish_newsletter($id) { 
		$data = array (
			'published' => 'false',
		);
		$this->db->where('id', $id);
		return $this->db->update('newsletters', $data);
	}


	private function get_newsletter_file($id) {
		$y = $this->get_newsletter_details($id);
		return 'assets/uploads/newsletters/'.$y->the_file;
    } 
	
	
	public function delete_newsletter($id) {
		$y = $this->get_newsletter_details($id);
		unlink('./assets/uploads/newsletters/'.$y->the_file); //remove file from server
		return $this->db->delete('newsletters', array('id' => $id));
    } 
	
	
	public function bulk_actions_newsletters() {
		$selected_rows = count($this->input->post('check_bulk_action', TRUE)); 
		$bulk_action_type = $this->input->post('bulk_action_type', TRUE);		
		$row_id = $this->input->post('check_bulk_action', TRUE);
		$newsletters = ($selected_rows == 1) ? 'newsletter' : 'newsletters';
		foreach ($row_id as $id) {
			switch ($bulk_action_type) {
				case 'publish':
					$this->publish_newsletter($id);
					$this->session->set_flashdata('status_msg', "{$selected_rows} {$newsletters} published successfully.");
				break;
				case 'unpublish':
					$this->unpublish_newsletter($id);
					$this->session->set_flashdata('status_msg', "{$selected_rows} {$newsletters} unpublished successfully.");
				break;
				case 'delete':
					$this->delete_newsletter($id);
					$this->session->set_flashdata('status_msg', "{$selected_rows} {$newsletters} deleted successfully.");
				break;
			}
		} 
	}




	//Subscribers Actions
	public function delete_all_subscribers() { 
		return $this->db->delete('newsletter_subscribers');
	}
	
	



}