
<?php echo flash_message_success('status_msg'); ?>
<?php echo flash_message_danger('status_msg_error'); ?>
<?php echo custom_validation_errors(); ?>

<?php require("application/views/admin/publications/events/modals/clear_events.php");  ?>


<div class="new-item">
	
	<a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('events/create_event'); ?>"><i class="fa fa-plus"></i> New Event</a>

	<a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('events/events_list'); ?>"><i class="fa fa-calendar"></i> All Events</a>

	<?php if ($total_records > 0) { ?>
		<button class="btn btn-default btn-sm button-adjust" data-toggle="modal" data-target="#clear_events"><i class="fa fa-trash"></i> Clear All</button>
	<?php } ?>

	<a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('home/events'); ?>" target="_blank"><i class="fa fa-eye"></i> View in Site</a>

</div>


<div class="m-b-30">
	<p><i class="fa fa-eye text-success"></i> Published: <?php echo number_format($total_published); ?></p>
	<p><i class="fa fa-eye-slash text-primary"></i> Unpublished (Drafts): <?php echo number_format($total_unpublished); ?></p>
	<p><i class="fa fa-th-large"></i> All: <?php echo number_format($total_records); ?></p>

	<p>Note: Upcoming Events will be shown in homepage if at least 1 future events is published.</p>
	
</div>


<div class="row">

	<div class="col-md-8 col-sm-12 col-xs-12">

		<?php
		//select options bulk actions 
		$options_array = array(
			//'value' => 'Caption'
			'publish' => 'Publish',
			'unpublish' => 'Unpublish',
			'delete' => 'Delete',
		); 
		echo modal_bulk_actions_alt('events/bulk_actions_events', $options_array); ?>

			<?php
			if ($total_records > 0) { 

				foreach ($events as $y) { 

					if ($y->published == 'true') {
						$status = '<i class="fa fa-eye text-success"></i> Published';
					} else {
						$status = '<i class="fa fa-eye-slash"></i> Unpublished';
					} 

					require("application/views/admin/publications/events/modals/event_actions.php");
					//delete confirm modal
					echo modal_delete_confirm($y->id, $y->caption, 'event', 'events/delete_event'); ?>

					<div class="row">
						<div class="col-md-1 m-t-10">
							<?php echo checkbox_bulk_action(1); ?>
						</div>

						<div class="col-md-11">
							<article class="media event m-b-30">
								<a class="pull-left date m-t-15">
		                        	<p class="month"><?php echo get_month_value_short($y->month); ?></p>
		                        	<p class="day"><?php echo $y->day; ?></p>
		                      	</a>
		                  		<div class="media-body">
		                      		<div class="pull-right">
		                      			<button type="button" class="btn btn-primary btn-sm button-adjust" data-toggle="modal" data-target="#options<?php echo $y->id; ?>"><i class="fa fa-navicon"></i> </button>
		                      		</div>
		                        	<h3><a class="title" href="#!"><?php echo $y->caption; ?></a></h3>
		                        	<p><i class="fa fa-clock-o"></i> <?php echo $y->time; ?></p>
		                        	<p><i class="fa fa-map-marker"></i> <?php echo $y->venue; ?></p>
		                        	<p><?php echo $status; ?></p>
		                        	<p class="m-t-8"><?php echo $y->description; ?></p>
		                      	</div>
		                    </article>
		                </div>

		            </div>

		            <hr />

				<?php } 

				
			} else { ?>

				<h3 class="text-danger">No event to show.</h3>

			<?php } ?>


		<?php echo form_close(); ?>


		</div>
	</div>
	
		
	<!--Pagination Links-->
	<?php echo pagination_links($links, 'pagination'); ?>


