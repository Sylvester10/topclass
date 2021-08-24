		
<!-- Start Our Gallery Area -->
<section class="junior__gallery__area gallery--2 bg--white section-padding--lg p-t-50 p-b-5">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12">
				<div class="section__title text-center">
					<h2 class="title__line">Photo Speak</h2>
				</div>
			</div>
		</div>
		
		<?php
		if ( $total_records > 0 ) { ?>

			<div class="row galler__wrap mt--40">

				<?php
				foreach ($photos as $p) { ?>

					<!-- Start Single Gallery -->
					<div class="col-lg-3 col-md-4 col-sm-12 col-12">
						<div class="gallery">
							<div class="gallery__thumb">
								<a href="#">
									<img src="<?php echo base_url('assets/uploads/gallery/'.$p->photo); ?>" alt="Gallery photo">
								</a>
							</div>
							<div class="gallery__hover__inner">
								<div class="gallery__hover__action">
									<ul class="gallery__zoom">
										<li><a href="<?php echo base_url('assets/uploads/gallery/'.$p->photo); ?>" data-lightbox="grportimg" data-title="<?php echo $p->caption; ?>"><i class="fa fa-search-plus"></i></a></li>
									</ul>
								</div>
							</div>
						</div>	
					</div>	
					<!-- End Single Gallery -->

				<?php } //endforeach ?>

			</div>

		<?php } else { ?>

			<h3 class="text-danger text-center">No gallery photo to show.</h3>

		<?php } //endif ?>


		<div class="row m-t-30">
		    <div class="col-lg-12">
		        <div class="dcare__pagination">
		            <?php echo pagination_links($links, 'dcare__page__list d-flex'); ?>
		        </div>
		    </div>
		</div>

	
	</div>
</section>
<!-- End Our Gallery Area -->

