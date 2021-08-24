<!-- Start Team Area -->
		<section class="dcare__team__area pb--150 bg--white m-t-50">
			<div class="container">

				<div class="row mt--40">

					<?php 
					foreach ($staff as $t) { ?>

						<!-- Start Single Team -->
						<div class="col-lg-4 col-md-6 col-sm-6 col-12">
							<div class="team__style--3 team--4 hover-color-2">
								<div class="team__thumb">
									
									<?php
									if ($t->photo != NULL) { ?>
										<img src="<?php echo base_url('assets/uploads/photos/staff/'.$t->photo); ?>" alt="<?php echo ucwords($t->name); ?>">
									<?php } else { ?>
										<img src="<?php echo user_avatar; ?>" alt="<?php echo ucwords($t->name); ?>">
									<?php } ?>

								</div>
								<div class="team__hover__action">
									<div class="team__details">
										<div class="team__info">
											<h6><a><?php echo ucwords($t->name); ?></a></h6>
											<span>
												<?php echo ucwords($t->subjects_assigned); ?> 
												<br />
												<?php echo ucwords($t->classes_assigned); ?>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- End Single Team -->

					<?php } ?>

				</div>


				<div class="row m-t-30">
				    <div class="col-lg-12">
				        <div class="dcare__pagination">
				            <?php echo pagination_links($links, 'dcare__page__list d-flex'); ?>
				        </div>
				    </div>
				</div>


			</div>
		</section>
		<!-- End Team Area -->