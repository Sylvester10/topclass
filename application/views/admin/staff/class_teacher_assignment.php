
<?php echo flash_message_success('status_msg'); ?>
<?php echo flash_message_danger('status_msg_error'); ?>

	<div class="new-item">
		<a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('school_staff/edit_staff/'.$y->id); ?>"><i class="fa fa-pencil"></i> Edit Teacher</a>
		<a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('school_staff/class_teachers'); ?>"><i class="fa fa-users"></i> All Class Teachers</a>
	</div>

	<div class="row">
	
		<div class="col-md-6">

			<h3><?php echo $y->name; ?></h3>

			<?php 
			$form_attributes = array("id" => "class_teacher_assignment_form");
			echo form_open('school_staff/class_teacher_assignment_ajax/'.$y->id, $form_attributes); ?>

				<input type="hidden" id="class_teacher_id" value="<?php echo $y->id; ?>" />
					
				<div class="form-group">
					<label>Class(es) Assigned <small>(if multiple, separate with comma)</small></label>
					<input type="text" name="classes_assigned" class="form-control" value="<?php echo set_value('classes_assigned', $y->classes_assigned); ?>" required />
					<div class="form-error"><?php echo form_error('classes_assigned'); ?></div>
				</div>

				<div class="form-group">
					<label>Subject(s) Assigned <small>(if multiple, separate with comma)</small></label>
					<input type="text" name="subjects_assigned" class="form-control" value="<?php echo set_value('subjects_assigned', $y->subjects_assigned); ?>" required />
					<div class="form-error"><?php echo form_error('subjects_assigned'); ?></div>
				</div>

				<div id="status_msg"></div>
				
				<div class="m-t-20">
					<button class="btn btn-primary btn-lg">Update</button>
				</div>

			<?php echo form_close(); ?>
			
		</div><!--/.col-->
		
	</div><!--/.row-->
	