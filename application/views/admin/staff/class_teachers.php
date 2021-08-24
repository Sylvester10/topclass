
<?php echo flash_message_success('status_msg'); ?>
<?php echo flash_message_danger('status_msg_error'); ?>
<?php echo custom_validation_errors(); ?>

	<div class="new-item">
		<a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('school_staff/new_staff'); ?>"><i class="fa fa-plus"></i> New Staff</a>
		<a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('school_staff'); ?>"><i class="fa fa-users"></i> All Staff</a>
	</div>
	
	
	<div class="table-scroll">
		<table id="class_teachers_table" class="table table-bordered table-hover cell-text-middle" style="text-align: left">
			
			<input type="hidden" id="csrf_hash" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			
			<thead>
				<tr>
					<th class="w-15-p"> <input type="checkbox" class="radio-box select_all" /> </th>
					<th> Actions </th>
					<th class=""> Photo </th>
					<th class="min-w-200"> Name </th>
					<th class=""> Sex </th>
					<th class=""> Designation </th>
					<th class="min-w-200"> Class(es) Assigned </th>
					<th class="min-w-200"> Subject(s) Assigned </th>
					<th class=""> Active </th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
	
<?php echo form_close(); ?>