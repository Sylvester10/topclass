
<div class="page__blog__details">


	<article class="dacre__blog__details">
		<div class="blog__thumb">
        	<img src="<?php echo base_url('assets/uploads/news/'.$y->featured_image); ?>" target="_blank" alt="news image">
        </div>
        <div class="blog__inner">
            <h2><?php echo $y->title; ?></h2>
            <ul>
            	<li><i class="fa fa-user"></i> Posted by <a href="#!">Admin</a></li>
            	<li><i class="fa fa-calendar"></i> <?php echo x_date_full($y->date); ?></li>
            	<li><i class="fa fa-comments"></i> <a href="#comments_section">Comments: <?php echo $total_comments; ?></a></li>
            </ul>
            <p><?php echo $y->body; ?></p>
    	</div>
    </article>


    <div class="blog__btn m-t-30">
	    <a class="dcare__btn btn__f6f6f6" href="<?php echo base_url('home/news'); ?>">&laquo; All News</a>
	</div>


    


	<!-- Start Blog Comment -->
	<section id="comments_section">
		<div class="blog__comment">
			<h4 class="title__line--3">Comments (<?php echo $total_comments; ?>)</h4>
			<div class="comment__wrapper">

				<?php
				if ($total_comments > 0) { 

					foreach ($comments as $c) { ?>

						<div class="comment d-flex m-b-30">
							<div class="comment__thumb">
								<img src="<?php echo user_avatar; ?>" alt="commentor avatar">
							</div>
							<div class="comment__content">
								<div class="author__content">
									<div class="author__info">
										<h4><a href="#!"><?php echo $c->name; ?></a></h4>
										<ul>
											<li><?php echo x_date($c->date); ?></li>
											<li><?php echo x_time_12hour($c->date); ?></li>
										</ul>
									</div>
								</div>
								<p><?php echo $c->comment; ?></p>
							</div>
						</div>

					<?php }

				} ?>

			</div>
		</div>

		<div class="row m-t-30">
		    <div class="col-lg-12">
		        <div class="dcare__pagination">
		            <?php echo pagination_links($links, 'dcare__page__list d-flex'); ?>
		        </div>
		    </div>
		</div>

	</section>
			


	<!-- Start Comment Form -->
	<div class="commentfield">
		<h4 class="title__line--3">Leave A Comment</h4>

		<?php 
		$form_attributes = array("id" => "create_comment_form");
		echo form_open('home/create_comment_ajax/'.$post_id, $form_attributes); ?>

			<div class="row">

				<input type="hidden" id="post_id" value="<?php echo $post_id; ?>" />

				<div class="col-md-6 col-lg-6 col-sm-6 col-12">
					<div class="single__input__box">											
						<input type="text" name="name" placeholder="Name" required />
					</div>
				</div>

				<div class="col-md-6 col-lg-6 col-sm-6 col-12 xs-mt-30">
					<div class="single__input__box">												
						<input type="email" name="email" placeholder="E-mail" required />
					</div>
				</div>

				<div class="col-md-12 col-lg-12 col-sm-12 col-12 m-b-30">
					<div class="single__input__box">											
						<textarea name="comment" placeholder="Type your comment here" required></textarea>
					</div>
				</div>

				<div class="col-md-6 col-lg-6 col-sm-6 col-12">
					<div class="single__input__box">											
						<input class="text-center bg-grey" type="text" name="captcha_code" id="captcha_code" value="<?php echo mt_rand(111111, 999999); ?>" readonly />
					</div>
				</div>

				<div class="col-md-6 col-lg-6 col-sm-6 col-12 m-b-30">
					<div class="single__input__box">											
						<input type="text" name="c_captcha_code" placeholder="Enter Captcha here to prove you're human" required />
					</div>
				</div>

				<div class="col-md-12 col-lg-12 col-sm-12 col-12">
					<div id="status_msg"></div>
				</div>

				<div class="col-md-12 col-lg-12 col-sm-12 col-12">
					<div class="callto__action__btn">
						<button class="dcare__btn btn__org hover--theme">Submit</button>
					</div>
				</div>

			</div>

		<?php echo form_close(); ?>

	</div>
	<!-- End Comment Form -->

</div>


