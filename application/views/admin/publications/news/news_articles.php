
<?php echo flash_message_success('status_msg'); ?>
<?php echo flash_message_danger('status_msg_error'); ?>
<?php echo custom_validation_errors(); ?>


<div class="row">
	<div class="col-md-12">

		<div class="new-item">
			<a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('news/create_news'); ?>"><i class="fa fa-plus"></i> Create News</a>
			<a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('home/news'); ?>" target="_blank"><i class="fa fa-eye"></i> View in Site</a>
		</div>


		<div class="m-b-30">
			<p><i class="fa fa-eye text-success"></i> Published: <?php echo number_format($total_published); ?></p>
			<p><i class="fa fa-eye-slash text-primary"></i> Unpublished (Drafts): <?php echo number_format($total_unpublished); ?></p>
			<p><i class="fa fa-th-large"></i> All: <?php echo number_format($total_records); ?></p>

			<p>Note: Recent News will be shown in homepage if at least 1 news article is published.</p>

		</div>

		
		<?php
		if ($total_records > 0) { ?>

			<?php 
			//select options bulk actions 
			$options_array = array(
				//'value' => 'Caption'
				'publish' => 'Publish',
				'unpublish' => 'Unpublish',
				'delete' => 'Delete'
			); 
			echo modal_bulk_actions_alt('news/bulk_actions_news', $options_array); ?>
		

				<ul class="messages">
					
					<?php 
					foreach ($news as $y) { 

						$total_comments = $this->news_model->count_post_comments($y->id); ?>

						<?php
						$featured_image_path = base_url('assets/uploads/news/'.$y->featured_image);
						$more_link = base_url('news/single_news/' . $y->id .'/'. $y->slug);

						$delete_confirm = modal_delete_confirm($y->id, $y->title, 'news article', 'news/delete_news');
						echo $delete_confirm;

						if ($y->published == 'true') {
							$status = '<b class="text-success">Published</b>';
							$action = 'unpublish_news/'.$y->id;
							$button_text = 'Unpublish';
							$button_color = 'btn-warning';
							$icon = 'fa fa-eye-slash';
						} else {
							$status = '<b class="text-danger">Unpublished</b>';
							$action = 'publish_news/'.$y->id;
							$button_text = 'Publish';
							$button_color = 'btn-success';
							$icon = 'fa fa-eye';
						} ?>

						<div class="row m-b-40">

							<div class="col-md-1">
								<?php echo checkbox_bulk_action($y->id); ?>
							</div>

							<div class="col-md-8">

		                      	<li>
		                      		<a href="<?php echo $featured_image_path; ?>">
		                        		<img src="<?php echo $featured_image_path; ?>" class="avatar" alt="<?php echo $y->title; ?>">
		                        	</a>
		                        	<div class="message_date">
		                          		<h3 class="date text-info"><?php echo x_day_number($y->date); ?></h3>
		                          		<p class="month"><?php echo x_month_short($y->date); ?></p>
		                        	</div>
		                        	<div class="message_wrapper">
		                          		<h4 class="heading"><?php echo $y->title; ?></h4>
		                          		<blockquote class="message">
		                          			<span style="cursor: pointer" title="<?php echo $total_comments; ?> comments"><i class="fa fa-comments"></i> <?php echo $total_comments; ?></span>
		                          			<p><?php echo $y->snippet; ?></p>	
		                          		</blockquote>
		                          		<br />
		                          		<p class="url">
		                            		<span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
		                            		<a href="<?php echo $more_link; ?>" data-original-title="" class="text-bold">Read More &raquo;</a>
		                          		</p>
		                        	
			                        	<div class="m-t-15">
											<a type="button" class="btn btn-primary btn-xs" href="<?php echo base_url('news/edit_news/'.$y->id); ?>"><i class="fa fa-pencil"></i> Edit</a>
											<a type="button" class="btn <?php echo $button_color; ?> btn-xs" href="<?php echo base_url('news/'.$action); ?>"><i class="<?php echo $icon; ?>"></i> <?php echo $button_text; ?></a>
											<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete<?php echo $y->id; ?>"><i class="fa fa-trash"></i> Delete</button>
										</div>

									</div>
		                      	</li> 

		                      	
							</div>

						</div>


					<?php } ?>

				</ul>
				
			<?php } else { ?>

				<h3 class="text-danger">No news article to show.</h3>

			<?php } ?>
			
				
			<!--Pagination Links-->
			<?php echo pagination_links($links, 'pagination'); ?>
			
		<?php echo form_close(); ?>

	</div>
</div>
	