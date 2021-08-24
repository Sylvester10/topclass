
<?php echo flash_message_success('status_msg'); ?>
<?php echo flash_message_danger('status_msg_error'); ?>

<div class="new-item">
	<a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('events/events_list'); ?>"><i class="fa fa-calendar"></i> All Events</a>
</div>	
			
<div class="row">

	<div class="col-md-6 col-sm-12 col-xs-12">
	
		<?php 
		$form_attributes = array("id" => "create_event_form");
		echo form_open('events/create_event_ajax', $form_attributes); ?>
		
			<div class="form-group">
				<label class="form-control-label">Event Date</label>
				<div class="input-group date calendar_date_datepicker" data-date-format="yyyy-mm-dd">
					<input type="text" class="form-control" name="event_date" value="<?php echo set_value('event_date', default_calendar_date()); ?>" required readonly />
					<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="form-control-label">Event Time</label>
				<div class="input-group bootstrap-timepicker timepicker">
					<input name="time" id="timepicker" type="text" class="form-control input-small" required readonly />
					<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
				</div>
			</div>

			<div class="form-group">
				<label class="form-control-label">Event Venue</label>
				<input type="text" name="venue" class="form-control" value="<?php echo set_value('venue', 'School Premises'); ?>" required />
			</div>

			<div class="form-group">
				<label class="form-control-label">Event Caption</label>
				<input type="text" name="caption" class="form-control" value="<?php echo set_value('caption'); ?>" required />
			</div>
			
			<div class="form-group">
				<label class="form-control-label">Event Description</label>
				<textarea name="description" class="form-control t200" required><?php echo set_value('description'); ?></textarea>
			</div>

			<div id="status_msg"></div>
			
			<div>
				<button class="btn btn-primary">Submit </button>
			</div>

		<?php echo form_close(); ?>
		
	</div><!--/.col-md-6-->
</div><!--/.row-->