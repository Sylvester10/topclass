
<div class="event-content-wrapper">
	<div class="event-section">

		<div class="enent__thumb">
			<img src="<?php echo base_url('assets/images/icons/calendar-icon-lg.png'); ?>" alt="calendar image">
			<div class="box-timer">
                <div class="countbox timer-grid">
                    <div data-countdown="<?php echo $y->event_date; ?>"></div>
                    <div class="m-t-20"><h3><i class="fa fa-calendar m-t-5"></i> <?php echo x_date($y->event_date); ?></h3></div>
                </div>
             </div>
		</div>

		<div class="event__inner">
			<h4><?php echo $y->caption; ?></h4>
			<p><?php echo $y->description; ?></p>
		</div>


		<div class="event-section">
			<h2 class="event__information text-bold">EVENT DETAILS</h2>
			<div class="jumbotron">
				<ul class="event_info">
					<li><span class="ti-user"></span> Organiser: <?php echo school_name; ?></li>
					<li><span class="ti-location-pin"></span> Venue: <?php echo $y->venue; ?></li>
					<li><span class="ti-calendar"></span> Date: <?php echo x_date_full($y->event_date); ?></li>
					<li><span class="ti-time"></span> Time: <?php echo x_time_24hour($y->time); ?></li>
					<li><span class="ti-mobile"></span> Phone: <?php echo school_phone_number; ?></li>
					<li><span class="ti-email"></span> Email : <?php echo school_contact_email; ?></li>
				</ul>

			</div>
		</div>

	</div>
</div>


<div class="blog__btn">
    <a class="dcare__btn btn__f6f6f6" href="<?php echo base_url('home/events'); ?>">&laquo; All Events</a>
</div>
