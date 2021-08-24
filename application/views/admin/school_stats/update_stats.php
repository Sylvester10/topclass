
<?php echo flash_message_success('status_msg'); ?>
<?php echo flash_message_danger('status_msg_error'); ?>
			
<div class="row">

	<div class="col-md-6 col-sm-12 col-xs-12">
	
		<?php 
		$form_attributes = array("id" => "update_school_stats_form");
		echo form_open('events/update_school_stats_ajax', $form_attributes); ?>
		
			<div class="form-group">
				<label class="form-control-label">Number of Students</label>
				<input type="text" name="students" class="form-control numbers-only" value="<?php echo set_value('students', $s->students); ?>" required />
			</div>

			<div class="form-group">
				<label class="form-control-label">Number of Teachers</label>
				<input type="text" name="teachers" class="form-control numbers-only" value="<?php echo set_value('teachers', $s->teachers); ?>" required />
			</div>

			<div class="form-group">
				<label class="form-control-label">Number of Staff</label>
				<input type="text" name="staff" class="form-control numbers-only" value="<?php echo set_value('staff', $s->staff); ?>" required />
			</div>

			<div class="form-group">
				<label class="form-control-label">Number of Classes</label>
				<input type="text" name="classes" class="form-control numbers-only" value="<?php echo set_value('classes', $s->classes); ?>" required />
			</div>

			<div class="form-group">
				<label class="form-control-label">Number of School Buses</label>
				<input type="text" name="school_buses" class="form-control numbers-only" value="<?php echo set_value('school_buses', $s->school_buses); ?>" required />
			</div>

			<div id="status_msg"></div>
			
			<div>
				<button class="btn btn-primary">Update</button>
			</div>

		<?php echo form_close(); ?>
		
	</div><!--/.col-md-6-->
</div><!--/.row-->