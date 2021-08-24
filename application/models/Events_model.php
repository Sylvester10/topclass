<?php
defined('BASEPATH') or exit('Direct access to script not allowed');


class Events_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}




	public function get_event_details($id) {
		return $this->db->get_where('events', array('id' => $id))->row();
	}



	/* =========== Upcoming Events ============== */
	public function get_upcoming_events($limit, $offset) {		
		$this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
		$this->db->order_by("date_unix", "ASC"); //order by date_unix ASC so that the dates appear chronologically
		$date_unix_today = date('Ymd');
		$where = array(
			'date_unix >=' => $date_unix_today, //ensure event date is not in the past
		);
		$this->db->where($where); 
		$query = $this->db->get('events');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
       	return false;
    }


    public function get_published_upcoming_events($limit, $offset) {		
		$this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
		$this->db->order_by("date_unix", "ASC"); //order by date_unix ASC so that the dates appear chronologically
		$date_unix_today = date('Ymd');
		$where = array(
			'published' => 'true',
			'date_unix >=' => $date_unix_today, //ensure event date is not in the past
		);
		$this->db->where($where); 
		$query = $this->db->get('events');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }


    public function get_near_upcoming_events($limit) { //for homepage
		$date_unix_today = date('Ymd');
		$this->db->order_by('date_unix', 'ASC');
		$this->db->limit($limit);  
		$where = array(
			'published' => 'true',
			'date_unix >=' => $date_unix_today, //ensure event date is not in the past
		);
		$this->db->where($where);  
		return $this->db->get('events')->result();
	}


	public function count_upcoming_events() { 
		$date_unix_today = date('Ymd');
		$where = array(
			'date_unix >=' => $date_unix_today, //ensure event date is not in the past
		);
		$this->db->where($where);  
		return $this->db->get('events')->num_rows();
	}


    public function count_published_upcoming_events() { 
    	$date_unix_today = date('Ymd');
		$where = array(
			'published' => 'true',
			'date_unix >=' => $date_unix_today, //ensure event date is not in the past
		);
		$this->db->where($where);  
		return $this->db->get('events')->num_rows();
	}


	public function count_unpublished_upcoming_events() { 
		$date_unix_today = date('Ymd');
		$where = array(
			'published' => 'false',
			'date_unix >=' => $date_unix_today, //ensure event date is not in the past
		);
		$this->db->where($where);  
		return $this->db->get('events')->num_rows();
	}



	/* =========== All Events ============== */
	public function get_events_list($limit, $offset) {		
		$this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
		$this->db->order_by("date_unix", "ASC"); //order by date_unix ASC so that the dates appear chronologically
		$query = $this->db->get_where('events');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
            return false;
    }


    public function get_published_events_list($limit, $offset) {		
		$this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
		$this->db->order_by("date_unix", "ASC"); //order by date_unix ASC so that the dates appear chronologically
		$query = $this->db->get_where('events');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
            return false;
    }


    public function count_events() { 
		return $this->db->get_where('events')->num_rows();
	}


    public function count_published_events() { 
		return $this->db->get_where('events', array('published' => 'true'))->num_rows();
	}


	public function count_unpublished_events() { 
		return $this->db->get_where('events', array('published' => 'false'))->num_rows();
	}





	/* ========== Admin Actions: Events ============= */
	
	public function create_event() { 
		$event_date = $this->input->post('event_date', TRUE); 	
		$time = $this->input->post('time', TRUE); 	
		$caption = ucwords($this->input->post('caption', TRUE)); 	
		$description = nl2br(ucfirst($this->input->post('description', TRUE))); 
		$venue = ucwords($this->input->post('venue', TRUE)); 
		
		$x_date = explode('/', $event_date);
		$year = $x_date[0]; //year is array index 0 
		$month = $x_date[1]; //month is array index 1
		$day = $x_date[2]; //day is array index 2
		$date_unix = $this->generate_date_unix($event_date);
		
		$data = array (
			'year' => $year, 
			'month' => $month, 
			'day' => $day, 
			'date_unix' => $date_unix, 
			'event_date' => $event_date, 
			'time' => $time,
			'caption' => $caption,
			'description' => $description,
			'venue' => $venue,
		);
		return $this->db->insert('events', $data);
	}
	
	
	public function edit_event($id) { 
		$event_date = $this->input->post('event_date', TRUE); 	
		$time = $this->input->post('time', TRUE); 	
		$caption = ucwords($this->input->post('caption', TRUE)); 	
		$description = nl2br(ucfirst($this->input->post('description', TRUE))); 
		$venue = ucwords($this->input->post('venue', TRUE)); 
		
		$x_date = explode('/', $event_date);
		$year = $x_date[0]; //year is array index 0 
		$month = $x_date[1]; //month is array index 1
		$day = $x_date[2]; //day is array index 2
		$date_unix = $this->generate_date_unix($event_date);
		
		$data = array (
			'year' => $year, 
			'month' => $month, 
			'day' => $day, 
			'date_unix' => $date_unix, 
			'event_date' => $event_date, 
			'time' => $time, 
			'caption' => $caption,
			'description' => $description,
			'venue' => $venue,
		);
		$this->db->where('id', $id);
		return $this->db->update('events', $data);
	}


	public function get_date_unix($date_unix) {
		return $this->db->get_where('events', array('date_unix' => $date_unix))->num_rows();
	}
	
	
	public function generate_date_unix($date) {
		//break date into arrays of day, month and year. Note that "/" must be specified as separator in datepicker initialization and date format must be set as yyyy/mm/dd
		$x_date = explode('/', $date);
		$year = $x_date[0]; //year is array index 0 
		$month = $x_date[1]; //month is array index 1
		$day = $x_date[2]; //day is array index 2
		
		//date unix: required to order the events chronologically when viewed as a list (in the order yyyymmdd)
		$date_unix = $year.$month.$day;
		return $date_unix;
	}


	public function publish_event($id) { 
		$data = array (
			'published' => 'true',
		);
		$this->db->where('id', $id);
		return $this->db->update('events', $data);
	}
	
	
	public function unpublish_event($id) { 
		$data = array (
			'published' => 'false',
		);
		$this->db->where('id', $id);
		return $this->db->update('events', $data);
	}
	
	
	public function delete_event($id) {
		return $this->db->delete('events', array('id' => $id));
    } 
	
	
	public function clear_events() {
		return $this->db->truncate('events');
    } 


	public function bulk_actions_events() {
		$selected_rows = count($this->input->post('check_bulk_action', TRUE)); 
		$bulk_action_type = $this->input->post('bulk_action_type', TRUE);		
		$row_id = $this->input->post('check_bulk_action', TRUE);
		$events = ($selected_rows == 1) ? 'event' : 'events';
		foreach ($row_id as $id) {
			switch ($bulk_action_type) {
				case 'publish':
					$this->publish_event($id);
					$this->session->set_flashdata('status_msg', "{$selected_rows} {$events} published successfully.");
				break;
				case 'unpublish':
					$this->unpublish_event($id);
					$this->session->set_flashdata('status_msg', "{$selected_rows} {$events} unpublished successfully.");
				break;
				case 'delete':
					$this->delete_event($id);
					$this->session->set_flashdata('status_msg', "{$selected_rows} {$events} deleted successfully.");
				break;
			}
		} 
	}



}