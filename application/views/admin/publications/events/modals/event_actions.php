	
<!--Events Options-->
<div class="modal fade" id="options<?php echo $y->id; ?>" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content modal-width">
			<div class="modal-header">
				<div class="pull-right">
					<button class="btn btn-danger btn-sm modal_close_btn" data-dismiss="modal" class="close" title="Close"> &times;</button>
				</div>
				<h4 class="modal-title">Actions: <?php echo $y->caption; ?></h4>
			</div><!--/.modal-header-->
			<div class="modal-body">

				<?php 
				if ($y->published == 'true') { ?>
					
					<p><a type="button" class="btn btn-default btn-sm btn-block action-btn" href="<?php echo base_url('events/unpublish_event/'.$y->id); ?>"> <i class="fa fa-eye-slash" style="color: red"></i> &nbsp; Unpublish Event </a></p>

				<?php } else { ?>

					<p><a type="button" class="btn btn-default btn-sm btn-block action-btn" href="<?php echo base_url('events/publish_event/'.$y->id); ?>"> <i class="fa fa-eye" style="color: green"></i> &nbsp; Publish Event </a></p>

				<?php } ?>

				<p><a type="button" class="btn btn-default btn-sm btn-block action-btn" href="<?php echo base_url('events/edit_event/'.$y->id); ?>"> <i class="fa fa-edit" style="color: green"></i> &nbsp; Edit Event </a></p>

				<p><a type="button" href="#" class="btn btn-default btn-sm btn-block action-btn" data-toggle="modal" data-target="#delete<?php echo $y->id; ?>"> <i class="fa fa-trash" style="color: red"></i> &nbsp; Delete Event </a></p>
				
			</div>
		</div>
	</div>
</div>
	
	