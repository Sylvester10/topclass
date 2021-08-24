
<?php echo flash_message_success('status_msg'); ?>
<?php echo flash_message_danger('status_msg_error'); ?>
<?php echo custom_validation_errors(); ?>

	<div class="new-item">
		<a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('admin_users/new_admin'); ?>"><i class="fa fa-plus"></i> New Admin</a>
	</div>
	
	
	<?php 
	//select options bulk actions 
	$options_array = array(
		//'value' => 'Caption'
		'delete' => 'Delete'
	); 
	echo modal_bulk_actions('admin_users/delete_bulk_admins', $options_array); ?>
	
	<div class="table-scroll">
		<table id="admins_table" class="table table-bordered table-hover cell-text-middle" style="text-align: left">
			
			<input type="hidden" id="csrf_hash" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			
			<thead>
				<tr>
					<th class="w-15-p"> <input type="checkbox" class="radio-box select_all" /> </th>
					<th> Actions </th>
					<th class="min-w-200"> Name </th>
					<th class="min-w-200"> Email Address </th>
					<th class="min-w-150"> Phone </th>					
					<th class="min-w-200"> Roles </th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
	
<?php echo form_close(); ?>