<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- No Javascript -->
	<?php echo check_javascript_enabled(); ?>
	
	<link rel="icon" href="<?php echo school_favicon; ?>" type="image/png" />

    <title><?php echo $title; ?> | <?php echo school_name; ?> </title>

    <?php 
	//require header files
	require "application/views/admin/layout/includes/header_assets.php";
	?>
	
</head>

<body class="nav-md">
  
    <div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a href="<?php echo base_url(); ?>" class="site_title" target="_blank"><i class="fa fa-graduation-cap"></i> <span><?php echo school_initials; ?></span></a>
					</div>

					<div class="clearfix"></div>

					<!-- menu profile quick info -->
					<div class="profile clearfix">
						<div class="profile_pic">
							<?php 
							if ($admin_details->photo != NULL) { ?>
								<img src="<?php echo base_url('assets/uploads/photos/admins/'.$admin_details->photo_thumb); ?>" alt="..." class="img-circle profile_img">
							<?php } else { ?>
								<img src="<?php echo user_avatar; ?>" alt="..." class="img-circle profile_img">
							<?php } ?>
						</div>
						<div class="profile_info">
							<span>Welcome,</span>
							<h2><?php echo $admin_details->name; ?></h2>
						</div>
					</div><!-- /menu profile quick info -->

					<br />


					<!-- sidebar menu -->
					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
						<div class="menu_section">
							<ul class="nav side-menu">
							
								<li><a href="<?php echo base_url(); ?>" target="_blank"><i class="fa fa-home"></i> Visit Site</a></li>
								
								<li><a href="<?php echo base_url('admin'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>

								<li><a><i class="fa fa-bar-chart"></i> School Statistics <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="<?php echo base_url('school_stats'); ?>">Manage Statistics</a></li>
									</ul>
								</li> 

								<li><a><i class="fa fa-bullhorn"></i> Announcement <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="<?php echo base_url('announcement'); ?>">Manage Announcement</a></li>
									</ul>
								</li> 
		
								<li><a><i class="fa fa-book"></i> News <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="<?php echo base_url('news/create_news'); ?>">Create News</a></li>
										<li><a href="<?php echo base_url('news/news_articles'); ?>">Manage News</a></li>
									</ul>
								</li> 
			
								<li><a>
									<i class="fa fa-envelope-o"></i> 
									Newsletters <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="<?php echo base_url('newsletter/create_newsletter'); ?>">Create Newsletters</a></li>
										<li><a href="<?php echo base_url('newsletter/newsletters'); ?>">Manage Newsletters</a></li>
										<li><a href="<?php echo base_url('newsletter/subscribers'); ?>">Subscribers</a></li>
									</ul>
								</li>
	
								<li><a><i class="fa fa-calendar"></i> Events <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="<?php echo base_url('events/create_event'); ?>">Create Event</a></li>
										<li><a href="<?php echo base_url('events/upcoming_events'); ?>">Upcoming Events</a></li>
										<li><a href="<?php echo base_url('events/events_list'); ?>">All Events</a></li>
									</ul>
								</li>

								<li><a><i class="fa fa-image"></i> Gallery <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="<?php echo base_url('gallery/photos'); ?>">Manage Gallery</a></li>
									</ul>
								</li>

								<li><a><i class="fa fa-envelope-o"></i> Contact Messages <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="<?php echo base_url('message/contact_messages'); ?>">Messages</a></li>
									</ul>
								</li>

								<li><a><i class="fa fa-users"></i> Staff <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="<?php echo base_url('school_staff/new_staff'); ?>">New Staff</a></li>
										<li><a href="<?php echo base_url('school_staff/class_teachers'); ?>">Class Teachers</a></li>
										<li><a href="<?php echo base_url('school_staff'); ?>">Manage Staff</a></li>
									</ul>
								</li>

								<li><a><i class="fa fa-users"></i> Admin Users <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="<?php echo base_url('admin_users'); ?>">Manage Users</a></li>
									</ul>
								</li>

								<li><a><i class="fa fa-user"></i> Profile <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="<?php echo base_url('admin/profile'); ?>">My Profile</a></li>
									</ul>
								</li>
								
								<li><a href="<?php echo base_url('admin_logout'); ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
								
							</ul>
						</div>
					</div><!-- /sidebar menu -->
				</div>
			</div>

			<!-- top navigation -->
			<div class="top_nav">
				<div class="nav_menu">
					<nav>
						<div class="nav toggle">
							<a id="menu_toggle" title="Toggle Sidebar Menu"><i class="fa fa-bars"></i><span class="text-bold f-s-22"> MENU</span></a>
						</div>

						<ul class="nav navbar-nav navbar-right">
						
							<li class="">
								<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<?php 
									if ($admin_details->photo != NULL) { ?>
										<img src="<?php echo base_url('assets/uploads/photos/admins/'.$admin_details->photo_thumb); ?>" alt="...">
									<?php } else { ?>
										<img src="<?php echo user_avatar; ?>">
									<?php } ?>
									<?php echo $admin_details->name; ?>
									<span class=" fa fa-angle-down"></span>
								</a>
								<ul class="dropdown-menu dropdown-usermenu pull-right">
									<li><a href="<?php echo base_url('admin/profile'); ?>"><i class="fa fa-user pull-right"></i> Profile</a></li>
									<li><a href="<?php echo base_url('admin_logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
								</ul>
							</li>
	
						</ul>
					</nav>
				</div>
			</div><!-- /top navigation -->

			
        <div class="right_col" role="main">
		
			<div class="row m-b-15">
				<div class="col-md-12" style="border-bottom: 1px solid #f2f2f2;">
					<div class="row">
						<div class="col-md-8">
							<h3 class="text-bold"><a href="<?php echo base_url('admin'); ?>" title="Dashboard"><?php echo school_initials; ?></a> &raquo; <a href="<?php echo base_url(); ?>" target="_blank" title="Visit school website"><?php echo school_name; ?></a> <small><i class="fa fa-user"></i> Admin</small></h3>
						</div>
					</div>
				</div>
			</div>


			<div class="row">
				<div class="col-xs-6">
					<p>Today's Date: <?php echo date('l, d M, Y'); ?></p>
				</div>
				<div class="col-xs-6">
					<div class="pull-right">
						<p>Current Time: <span id="current_ime"></span></p>
					</div>
				</div>
			</div>



			<?php 
			//check if admin has changed their default password
			if ( $admin_details->password == hash('ripemd128', default_admin_password) ) { ?>

				<div class="alert alert-warning text-center text-bold f-s-17" style="color: #fff;">
					<a href="#" class="close" data-dismiss="alert" aria-label="Close" title="Close"> &times; </a>
					Notice: You are using the default password. <a class="underline-link" href="<?php echo base_url('admin/profile'); ?>">Change your password now</a> to make your account more secure.
				</div>

			<?php } ?>



			<div class="x_panel">
				<div class="x_title">
					<h2 class="page_title"><?php echo $inner_page_title; ?></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<!-- page content -->
					
		