<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Class_teachers_model_ajax extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->model('school_staff_model');
	}

	var $table = 'staff';
	var $column_order = array(null, 'id', 'name', 'sex', 'email', 'phone', 'designation'); //set column field database for datatable orderable
	var $column_search = array('id', 'name', 'sex', 'email', 'phone', 'designation'); //set column field database for datatable searchable 
	var $order = array('date_added' => 'desc');

	
	private function the_query() {		
		$this->db->from($this->table);
		$i = 0;	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}		
		if(isset($_POST['order'])) { // here order processing 
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if(isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	

	function get_records() {
		$this->the_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$this->db->where('designation', 'Class Teacher');
		$this->db->or_where('designation', 'Class Assistant');
	    $query = $this->db->get();
		return $query->result();
	}
	

	function count_filtered_records() {
		$this->the_query();
		$this->db->where('designation', 'Class Teacher');
		$this->db->or_where('designation', 'Class Assistant');
	    $query = $this->db->get();
		return $query->num_rows();
	}
	
	
	public function count_all_records() {
	    $this->db->where('designation', 'Class Teacher');
	    $this->db->or_where('designation', 'Class Assistant');
		$this->db->from($this->table);
	    return $this->db->count_all_results();
	}
	
	
	public function actions($staff_id) {
		$y = $this->common_model->get_staff_details_by_id($staff_id);
		
		return '<p><a type="button" href="' . base_url('school_staff/class_teacher_assignment/'.$staff_id) .'" class="btn btn-default btn-sm btn-block action-btn clickable"> <i class="fa fa-plug" style="color: green"></i> &nbsp; Assign Class(es) & Subject(s) </a></p>

		<p><a type="button" href="' . base_url('school_staff/staff_profile/'.$staff_id) .'" class="btn btn-default btn-sm btn-block action-btn clickable"> <i class="fa fa-user" style="color: green"></i> &nbsp; View Profile </a></p>

		<p><a type="button" href="' . base_url('school_staff/edit_staff/'.$staff_id) .'" class="btn btn-default btn-sm btn-block action-btn clickable"> <i class="fa fa-pencil" style="color: green"></i> &nbsp; Edit Teacher </a></p>

		<p><a type="button" href="#" class="btn btn-default btn-sm btn-block action-btn clickable" data-toggle="modal" data-target="#message'.$staff_id.'"> <i class="fa fa-envelope" style="color: green"></i> &nbsp; Message Teacher </a></p>';
	}
	
	
	public function options($staff_id) {
		return '<div class="text-center"><a type="button" href="#" class="btn btn-primary btn-sm modal-toggle-btn clickable" data-toggle="modal" data-target="#options'.$staff_id.'" title="Options"> <i class="fa fa-navicon"></i> </a></div>';
	}
	
	
	public function modal_options($staff_id) {
		$y = $this->common_model->get_staff_details_by_id($staff_id);
		return '<div class="modal fade" id="options'.$staff_id.'" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content modal-width">
					<div class="modal-header">
						<div class="pull-right">
							<button class="btn btn-danger btn-sm modal_close_btn" data-dismiss="modal" class="close" title="Close"> &times;</button>
						</div>
						<h4 class="modal-title">Actions: ' .$y->name. '</h4>
					</div><!--/.modal-header-->
					<div class="modal-body">'
						. $this->actions($staff_id) .
					'</div>
				</div>
			</div>
		</div>';
	} 
	
	
	public function modals($staff_id) {
		$y = $this->common_model->get_staff_details_by_id($staff_id);
		$modal_message_user = modal_message_user($staff_id, $y->name, 'school_staff/message_staff');
		$modal_delete_confirm = modal_delete_confirm($staff_id, $y->name, 'staff', 'school_staff/delete_staff');
		return 	$this->modal_options($staff_id) . 
				$modal_message_user . 
				$modal_delete_confirm;
	}
	
	
	
	
}