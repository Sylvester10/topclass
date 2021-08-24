<?php
defined('BASEPATH') or exit('Direct access to script not allowed');


class Gallery_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}




	public function get_photo_details($id) {
		return $this->db->get_where('galleries', array('id' => $id))->row();
	}


	public function get_photos($limit, $offset) {		
		$this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
		$this->db->order_by("date", "DESC"); //order by date_unix ASC so that the dates appear chronologically
		$query = $this->db->get_where('galleries');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }


    public function get_published_photos($limit, $offset) {		
		$this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
		$this->db->order_by("date", "DESC"); //order by date_unix ASC so that the dates appear chronologically
		$query = $this->db->get_where('galleries', array('published' => 'true'));
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }



	public function get_recent_published_photos($limit) { //recent news for homepage and sidebar
		$this->db->order_by('date', 'DESC');
		$this->db->limit($limit); 
		return $this->db->get_where('galleries', array('published' => 'true'))->result();
	}


    public function count_photos() { 
		return $this->db->get_where('galleries')->num_rows();
	}


	public function count_published_photos() { 
		return $this->db->get_where('galleries', array('published' => 'true'))->num_rows();
	}


	public function count_unpublished_photos() { 
		return $this->db->get_where('galleries', array('published' => 'false'))->num_rows();
	}


    
	/* ========== Admin Actions: Galleries ============= */
	public function upload_photo($photo) { 
		$data = array (
			'photo' => $photo, 
		);
		return $this->db->insert('galleries', $data);
	}


	public function publish_photo($photo_id) { 
		$data = array (
			'published' => 'true',
		);
		$this->db->where('id', $photo_id);
		return $this->db->update('galleries', $data);
	}


	public function unpublish_photo($photo_id) { 
		$data = array (
			'published' => 'false',
		);
		$this->db->where('id', $photo_id);
		return $this->db->update('galleries', $data);
	}


	public function delete_photo($photo_id)	{
		$p = $this->get_photo_details($photo_id);
		//delete photo from folder
		unlink('./assets/uploads/gallery/'.$p->photo);
		//delete record from database
		$this->db->delete('galleries', array('id' => $photo_id));
	}

	
	public function bulk_actions_photos() {
		$selected_rows = count($this->input->post('check_bulk_action', TRUE)); 
		$bulk_action_type = $this->input->post('bulk_action_type', TRUE);		
		$row_id = $this->input->post('check_bulk_action', TRUE);
		$photos = ($selected_rows == 1) ? 'photo' : 'photos';
		foreach ($row_id as $photo_id) {
			switch ($bulk_action_type) {
				case 'publish':
					$this->publish_photo($photo_id);
					$this->session->set_flashdata('status_msg', "{$selected_rows} {$photos} published successfully.");
				break;
				case 'unpublish':
					$this->unpublish_photo($photo_id);
					$this->session->set_flashdata('status_msg', "{$selected_rows} {$photos} unpublished successfully.");
				break;
				case 'delete':
					$this->delete_photo($photo_id);
					$this->session->set_flashdata('status_msg', "{$selected_rows} {$photos} deleted successfully.");
				break;
			}
		} 
	}



}