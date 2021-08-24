
<?php echo flash_message_success('status_msg'); ?>
<?php echo flash_message_danger('status_msg_error'); ?>

<?php //require("application/views/admin/gallery/modals/upload_photo.php");  ?>

<div class="new-item">
	<button class="btn btn-default btn-sm button-adjust" data-toggle="collapse" data-target="#upload_photo" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-upload"></i> Upload Photo</button>
	<a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('home/gallery'); ?>" target="_blank"><i class="fa fa-eye"></i> View in Site</a>
</div>	


<div class="collapse m-b-50" id="upload_photo">
  	<div class="card card-body">
			
		<?php
		$form_attributes = array(
			"class" => "dropzone dropzone_form", 
			"id" 	=> "upload_photo_form"
		);
		echo form_open('gallery/upload_photo_ajax', $form_attributes); ?>

			<div class="dz-message" data-dz-message>
				<p>Click or drop files here to upload</p>
				<p><small>(Only image files allowed. Max size allowed is 2MB for each file)</small></p>
			</div>

		<?php echo form_close(); ?>

		<div class="text-center m-t-20">
			<a class="btn btn-primary" href="<?php echo base_url('gallery/update_photo_gallery'); ?>" title="Update photo gallery">Update Gallery</a>
		</div>

  	</div>
</div>



<div class="m-b-30">
	<p><i class="fa fa-eye text-success"></i> Published: <?php echo number_format($total_published); ?></p>
	<p><i class="fa fa-eye-slash text-primary"></i> Unpublished (Drafts): <?php echo number_format($total_unpublished); ?></p>
	<p><i class="fa fa-th-large"></i> All: <?php echo number_format($total_records); ?></p>

	<p>Note: Only published gallery photos will be shown on the website.</p>

</div>

			

<?php
if ( $total_records > 0 ) { ?>

	<?php 
	//select options bulk actions 
	$options_array = array(
		//'value' => 'Caption'
		'publish' => 'Publish',
		'unpublish' => 'Unpublish',
		'delete' => 'Delete'
	); 
	echo modal_bulk_actions_alt('gallery/bulk_actions_photos', $options_array); ?>

		<div class="row">

			<?php
			foreach ($photos as $p) { ?>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				    <div class="thumbnail">
				      	<div class="image view view-first">
				        	<img style="width: 100%; display: block;" src="<?php echo base_url('assets/uploads/gallery/'.$p->photo); ?>" alt="<?php echo $p->caption; ?>" />
					        <div class="mask">
					        	<p>Gallery</p>
					          	<div class="tools tools-bottom">
						            <a type="button" href="<?php echo base_url('assets/uploads/gallery/'.$p->photo); ?>" title="View full image" target="_blank"><i class="fa fa-search-plus"></i></a>
						            <a type="button" href="<?php echo base_url('gallery/delete_photo/'.$p->id); ?>" title="Delete photo"><i class="fa fa-trash"></i></a>
					          	</div>
					        </div>
					    </div>
				      	<div class="text-center p-t-10">
							<div><?php echo checkbox_bulk_action($p->id); ?></div>
							<div>

								<a class="btn btn-primary btn-xs" type="button" href="<?php echo base_url('assets/uploads/gallery/'.$p->photo); ?>" title="View full image" target="_blank">View</a>

								<button class="btn btn-primary btn-xs clipboard_copy" type="button" data-clipboard-text="<?php echo base_url('assets/uploads/gallery/'.$p->photo); ?>" title="Copy image URL to clipboard">Copy URL</button>

								<?php if ($p->published == 'true') { ?>

									<a class="btn btn-warning btn-xs" type="button" href="<?php echo base_url('gallery/unpublish_photo/'.$p->id); ?>" title="Unpublish photo">Unpublish</a>

								<?php } else { ?>

									<a class="btn btn-success btn-xs" type="button" href="<?php echo base_url('gallery/publish_photo/'.$p->id); ?>" title="Publish photo">Publish</a>

								<?php } ?>

								<a class="btn btn-danger btn-xs" type="button" href="<?php echo base_url('gallery/delete_photo/'.$p->id); ?>" title="Delete photo">Delete</a>

							</div>
				      	</div>
				    </div>
				</div>

			<?php } //endforeach ?>

		</div>

	<?php echo form_close(); ?>


<?php } else { ?>

	<h3 class="text-danger">No gallery photo to show.</h3>

<?php } //endif ?>


<!--Pagination Links-->
<?php echo pagination_links($links, 'pagination'); ?>
