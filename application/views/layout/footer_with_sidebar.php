
					</div><!--/.col-lg-9 blog-list-rightsidebar-->
							

					<!-- Start Sidebar -->
        			<div class="col-lg-3">
        				<div class="sidebar__widgets sidebar--right">


        					<div class="footer__widget">
			                    <div class="ft__logo">
			                        <a href="index.html">
			                            <img src="<?php echo base_url(); ?>assets/images/logo/11.jpg" alt="logo images">
			                        </a>
			                    </div>
			                    <div class="ftr__details">
			                        <p>Education is not preparation for life, Education is life.</p>
			                    </div>
			                    <div class="ftr__address__inner">
			                        <div class="ftr__address">
			                            <div class="ftr_icon">
			                                <i class="fa fa-home"></i>
			                            </div>
			                            <div class="ftr__contact">
			                                <p><?php echo school_address; ?></p>
			                            </div>
			                        </div>
			                        <div class="ftr__address">
			                            <div class="ftr_icon">
			                                <i class="fa fa-phone"></i>
			                            </div>
			                            <div class="ftr__contact">
			                                <p><a href="#"><?php echo school_phone_number; ?></a></p>
			                            </div>
			                        </div>
			                        <div class="ftr__address">
			                            <div class="ftr_icon">
			                                <i class="fa fa-envelope"></i>
			                            </div>
			                            <div class="ftr__contact">
			                                <p><a href="#">contact@topclass.com</a></p>
			                            </div>
			                        </div>
			                    </div>
			                </div>



			                <!-- Single Widget -->
        					<div class="single__widget search m-t-30">
        						<h4>Newsletter Subscription</h4>
        						<p>Subscribe to receive our monthly newsletter in your mailbox.</p>
        						<div class="callto__action__btn">
									<a class="dcare__btn btn__org hover--theme login-trigger" href="#!">Subscribe</a>
								</div>
        					</div>
        					<!-- End Widget -->


        					
        					<!-- Single Widget -->
        					<div class="single__widget about m-t-30">
								<div class="about__content">
									<img class="social_icons_bg_image" src="<?php echo base_url('assets/images/random/2.jpg'); ?>" alt="about images">
									<div class="about__info">
										<div class="about__inner">
											<h6><?php echo school_name; ?></h6>
											<ul class="dacre__social__link d-flex justify-content-center">
												<li class="facebook"><a target="_blank" href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
												<li class="twitter"><a target="_blank" href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
												<li class="pinterest"><a target="_blank" href="https://pinterest.com"><i class="fa fa-pinterest"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
        					</div>
        					<!-- End Widget -->



							<?php 
							//check if news articles exist, then display at most 3 of the most recent here
							if (count($recent_news) > 0) { ?>
        					
	        					<!-- Single Widget -->
	        					<div class="single__widget recent__post m-t-30">
	        						<h4>Recent Posts</h4>
									<ul>

										<?php
										foreach ($recent_news as $y) { 

											$total_comments = $this->news_model->count_post_comments($y->id); ?>

											<li>
												<a href="<?php echo base_url('assets/uploads/news/'.$y->featured_image); ?>" target="_blank">
													<img class="" src="<?php echo base_url('assets/uploads/news/'.$y->featured_image); ?>" alt="blog image">
												</a>
												<div class="post__content">
													<h6><a href="<?php echo base_url('home/single_news/'.$y->id.'/'.$y->slug); ?>"><?php echo $y->title; ?></a></h6>
													<span class="date"><i class="fa fa-calendar"></i><?php echo x_date($y->date); ?></span>
												</div>
											</li>

										<?php } //endforeach ?>

									
									</ul>
	        					</div>
	        					<!-- End Widget -->

	        				<?php } //endif ?>


        				</div><!--/.sidebar__widgets sidebar--right -->
        			</div><!--/.col-lg-3 -->
        			<!-- End Sidebar -->

        		</div><!--/.row-->
			</div><!--/.container-->
		</div><!--/.dcare__blog__list bg--white section-padding--lg-->

	
    <?php require 'application/views/layout/includes/main_footer.php'; ?>

    <?php require 'application/views/layout/includes/footer_assets.php'; ?>

</body>
</html>