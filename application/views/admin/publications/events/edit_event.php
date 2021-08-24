
<?php echo flash_message_success('status_msg'); ?>
<?php echo flash_message_danger('status_msg_error'); ?>

<div class="new-item">
	<a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('events/events_list'); ?>"><i class="fa fa-calendar"></i> All Events</a>
</div>	
			
<div class="row">

	<div class="col-md-6 col-sm-12 col-xs-12">
	
		<?php 
		$form_attributes = array("id" => "edit_event_form");
		echo form_open('events/edit_event_ajax/'.$y->id, $form_attributes);
		
			$event_date = $y->year .'/'. $y->month .'/'. $y->day; ?>

			<input type="hidden" id="event_id" value="<?php echo $y->id; ?>" />
					
			<div class="form-group">
				<label class="form-control-label">Event Date</label>
				<div class="input-group date calendar_date_datepicker" data-date-format="yyyy-mm-dd">
					<input type="text" class="form-control" name="event_date" value="<?php echo set_value('event_date', $event_date); ?>" readonly required />
					<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="form-control-label">Event Time</label>
				<div class="input-group bootstrap-timepicker timepicker">
					<input name="time" id="timepicker" type="text" class="form-control input-small" value="<?php echo set_value('time', $y->time); ?>" required readonly />
					<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
				</div>
			</div>

            <div class="form-group">
				<label class="form-control-label">Event Venue</label>
				<input type="text" name="venue" class="form-control" value="<?php echo set_value('venue', $y->venue); ?>" required />
			</div>
					
			<div class="form-group">
				<label class="form-control-label">Event Caption</label>
				<input type="text" name="caption" class="form-control" value="<?php echo set_value('caption', $y->caption); ?>" required />
			</div>
			
			<div class="form-group">
				<label class="form-control-label">Event Description</label>
				<textarea name="description" class="form-control t200" required><?php echo set_value('description', strip_tags($y->description)); ?></textarea>
			</div>

			<div id="status_msg"></div>
			
			<div>
				<button class="btn btn-primary">Update</button>
			</div>

		<?php echo form_close(); ?>
		
	</div><!--/.col-md-6-->
</div><!--/.row-->