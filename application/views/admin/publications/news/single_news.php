
<?php echo flash_message_success('status_msg'); ?>
<?php echo flash_message_danger('status_msg_error'); ?>

<div class="new-item">
	<a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('news/news_articles'); ?>"><i class="fa fa-book"></i> News List</a>
	<a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('news/edit_news/'.$y->id); ?>"><i class="fa fa-pencil"></i> Edit News</a>

	<?php if ($y->published == 'true') { ?>
		<a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('news/unpublish_news/'.$y->id); ?>"><i class="fa fa-eye-slash"></i> Unpublish</a>
		<a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('home/single_news/'.$y->id.'/'.$y->slug); ?>" target="_blank"><i class="fa fa-eye"></i> View in Site</a>
	<?php } else { ?>
		<a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('news/publish_news/'.$y->id); ?>"><i class="fa fa-eye"></i> Publish</a>
	<?php } ?>

</div>

	<div class="row">

		<div class="col-md-7 p-b-30">

			<?php $featured_image_path = base_url('assets/uploads/news/'.$y->featured_image); ?>

			<a href="<?php echo $featured_image_path; ?>" target="_blank">
				<img class="latest_news_featured_image img-responsive" src="<?php echo $featured_image_path; ?>" alt="<?php echo $y->title; ?>" title="<?php echo $y->title; ?>" />
			</a>
			
			<h3 class="text-bold m-t-20"><?php echo $y->title; ?></h3>
			
			<small>Posted on: <?php echo x_date($y->date); ?></small> <br />
			<small>Status: <?php echo ($y->published == 'true') ? '<span class="text-success">Published</span>' : '<span class="text-danger">Unpublished</span>'; ?></small> <br />

			<p class="m-t-30"><?php echo $y->body; ?></p>

		</div>


		<div class="col-md-4 col-md-offset-1">
			<h3 class="text-bold m-t-10-n">Comments (<?php echo $total_comments; ?>)</h3>
			
			<?php
			if ($total_comments > 0) { ?>

				<ul class="list-unstyled msg_list m-l-5-n">
				
					<?php
					foreach ($comments as $c) { 

						//delete confirm modal
						$delete_confirm = modal_delete_confirm($c->id, "Comment by {$c->name}", 'comment', 'news/delete_comment');
						echo $delete_confirm; ?>

	                    <li class="m-b-20">
	                    	<a>
		                        <span class="image">
		                          	<img src="<?php echo user_avatar; ?>" alt="avatar" />
		                        </span>
		                        <span>
		                          	<span class="text-bold"><?php echo $c->name; ?></span>
		                          	<span class="time"><?php echo time_ago($c->date); ?></span>
		                        </span>
		                        <div class="message">
		                          	<?php echo $c->email; ?>
		                          	<p class="m-t-10"><?php echo $c->comment; ?></p>
		                        </div>

	                    		<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete<?php echo $c->id; ?>"><i class="fa fa-trash"></i> Delete</button>

	                    	</a>
	                	</li>

	            	<?php } //endforeach ?>

	            </ul>

	        <?php } //endif ?>

	        <?php echo pagination_links($links, 'pagination'); ?>

		</div>

	</div>
	