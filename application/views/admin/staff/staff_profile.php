
<?php echo flash_message_success('status_msg'); ?>
<?php echo flash_message_danger('status_msg_error'); ?>
<?php echo custom_validation_errors(); ?>

<div class="new-item">
	<a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('school_staff/edit_staff/'.$y->id); ?>"><i class="fa fa-pencil"></i> Edit Staff</a>
</div>


<div class="row">

	<div class="col-md-4 col-sm-12 col-xs-12 profile_details">
	    <div class="well profile_view">
	      	<div class="col-sm-12">
	        	<div class="left col-xs-7">
	          		<h2 class="text-bold"><?php echo $y->name; ?></h2>
	          		<h4 class="text-silver"><i><?php echo $y->designation; ?></i></h4>
	          		<h4 class="text-silver m-t-10"><?php echo $y->quote; ?></h4>
	        	</div>
	        	<div class="right col-xs-5 text-center">
		        	<?php
					if ($y->photo != NULL) { ?>
						<img class="img-circle img-responsive" src="<?php echo base_url('assets/uploads/photos/staff/' .$y->photo); ?>" />
					<?php } else { ?>
						<img class="img-circle img-responsive" src="<?php echo user_avatar; ?>" />
					<?php } ?>
	        	</div>
	        	<div class="col-xs-12">
	        		<ul class="list-unstyled">
		            	<li><i class="fa fa-building"></i> <?php echo $y->residential_address; ?> </li>
		            	<li><i class="fa fa-phone"></i> <?php echo $y->phone; ?></li>
		          	</ul>
		        </div>
	      	</div>
	      	<hr />
	      	<div class="col-xs-12 bottom text-center">
	        	<div class="emphasis">
	        		<div class="social_icon_round35 bg-facebook inline-block">
		          		<a href="<?php echo $y->facebook_handle; ?>" class="text-white">
		          			<i class="fa fa-facebook"></i>
		          		</a>
		          	</div>
		          	<div class="social_icon_round35 bg-twitter inline-block">
		          		<a href="<?php echo $y->twitter_handle; ?>" class="text-white">
		          			<i class="fa fa-twitter"></i>
		          		</a>
		          	</div>
		          	<div class="social_icon_round35 bg-instagram inline-block">
		          		<a href="<?php echo $y->instagram_handle; ?>" class="text-white">
		          			<i class="fa fa-instagram"></i>
		          		</a>
		          	</div>
		          	<div class="social_icon_round35 bg-linkedin inline-block">
		          		<a href="<?php echo $y->linkedin_handle; ?>" class="text-white">
		          			<i class="fa fa-linkedin"></i>
		          		</a>
		          	</div>
	        	</div>
	      	</div>
	    </div>
	</div>

</div>


<div class="row">

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<h3 class="text-bold"><i class="fa fa-user f-s-30"></i> Bio Information</h3>
		<p><b>Name:</b> <?php echo $y->name; ?></p>
		<p><b>Sex:</b> <?php echo $y->sex; ?></p>
		<p><b>Date of Birth:</b> <?php echo x_date_full($y->date_of_birth); ?></p>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<h3 class="text-bold"><i class="fa fa-phone f-s-30"></i> Contact Information</h3>
		<p><b>Phone Number:</b> <?php echo $y->phone; ?></p>
		<p><b>Email Address:</b> <?php echo $y->email; ?></p>
		<p><b>Residential Address:</b> <?php echo $y->residential_address; ?></p>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<h3 class="text-bold"><i class="fa fa-briefcase f-s-30"></i> Employment Information</h3>
		<p><b>Designation:</b> <?php echo $y->designation; ?></p>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<h3 class="text-bold"><i class="fa fa-quote-left f-s-30"></i> Favourite Quote</h3>
		<?php echo $y->quote; ?>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<h3 class="text-bold"><i class="fa fa-lightbulb-o f-s-30"></i> Additional Information</h3>
		<?php echo $y->additional_info; ?>
	</div>

</div>