
<?php echo flash_message_success('status_msg'); ?>
<?php echo flash_message_danger('status_msg_error'); ?>
<?php echo custom_validation_errors(); ?>


		<?php require("application/views/admin/publications/announcement/modals/update_announcement.php");  
		$published = $announcement->published;
		if ($published == 'true') {
			$status = '<b class="text-success">Published</b>';
			$action = 'unpublish_announcement';
			$button_text = 'Unpublish';
			$icon = 'fa fa-eye-slash';
		} else {
			$status = '<b class="text-danger">Unpublished</b>';
			$action = 'publish_announcement';
			$button_text = 'Publish';
			$icon = 'fa fa-eye';
		} ?>

		<div class="new-item">

			<button class="btn btn-default btn-sm button-adjust" data-toggle="modal" data-target="#update_announcement"><i class="fa fa-pencil"></i> Update</button>

			<a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('announcement/'.$action); ?>"><i class="<?php echo $icon; ?>"></i> <?php echo $button_text; ?></a>

		</div>

		<p><h4 class="f-s-22"><?php echo $announcement->announcement; ?></h4></p>
		<p><small>Last updated: <?php echo time_ago($announcement->date); ?></small></p>
		<p><small>Status: <?php echo $status; ?></small></p>
