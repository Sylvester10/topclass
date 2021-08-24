<!doctype html>
<html class="no-js" lang="zxx">
<head>
	
	<?php require 'application/views/layout/includes/header_assets.php'; ?>

</head>
<body>
	<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->

	
	<!-- <div class="fakeloader"></div> -->

	<!-- Main wrapper -->
	<div class="wrapper" id="wrapper">
		<!-- Header -->
		<header id="header" class="jnr__header header--one clearfix">

			<!-- Start Mainmenu Area -->
			<div class="mainmenu__wrapper bg__cat--1 poss-relative header_top_line sticky__header">
				<div class="container">
					<div class="row d-none d-lg-flex">
						<div class="col-sm-4 col-md-6 col-lg-2 order-1 order-lg-1">
							<div class="logo">
								<a href="<?php echo base_url(); ?>">
									<img src="<?php echo base_url(); ?>assets/images/logo/10.png" alt="logo images">
								</a>
							</div>
						</div>
						<div class="col-sm-4 col-md-2 col-lg-9 order-3 order-lg-2">
							<div class="mainmenu__wrap">

								<?php require 'application/views/layout/includes/nav_links.php'; ?>		

							</div>
						</div>
					</div>
					<!-- Mobile Menu -->
                    <div class="mobile-menu d-block d-lg-none">
                    	<div class="logo">
                    		<a href="index.html"><img src="<?php echo base_url(); ?>assets/images/logo/12.png" alt="logo"></a>
                    	</div>
                    </div>
                    <!-- Mobile Menu -->
				</div>
			</div>
			<!-- End Mainmenu Area -->
		</header>
		<!-- //Header -->
		
		