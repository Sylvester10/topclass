
<?php echo flash_message_success('status_msg'); ?>
<?php echo flash_message_danger('status_msg_error'); ?>
<?php echo custom_validation_errors(); ?>

	<?php require("application/views/admin/publications/newsletter/modals/add_subscriber.php");  ?>

	<div class="new-item">
		<button class="btn btn-default btn-sm button-adjust" data-toggle="modal" data-target="#add_subscriber"><i class="fa fa-plus"></i> Add Subscriber</button>
		<a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('newsletter/newsletters'); ?>"><i class="fa fa-envelope-o"></i> Newsletters</a>
	</div>


	<table id="newsletter_subscribers_table" class="table table-bordered table-hover cell-text-middle" style="text-align: left">
		
		<input type="hidden" id="csrf_hash" value="<?php echo $this->security->get_csrf_hash(); ?>" />
		
		<thead>
			<tr>
				<th> Actions </th>
				<th class="min-w-200"> Name </th>
				<th class="min-w-200"> Email Address </th>
				<th class="min-w-150"> Date Subscribed </th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
