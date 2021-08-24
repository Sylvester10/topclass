
<?php 
if ( $total_records > 0) { ?>

    <!-- Start Our Event Area -->
    <div class="dcare__event__area bg--white">
        <div class="container">
            <div class="row event-grid-page">

                <?php
                $count = 1;
                foreach ($events as $y) { ?>

                    <!-- Start Single Event -->
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="dcare__event">
                            <div class="event__thumb">
                                <a href="event-details.html">
                                    <img class="" src="<?php echo base_url('assets/images/icons/calendar-icon.jpg'); ?>" alt="calendar icon">
                                </a>
                            </div>
                            <div class="event__content">
                                <div class="event__pub">
                                    <div class="event__date">
                                        <span class="date"><?php echo $y->day; ?></span><span><?php echo get_ordinal_string($y->day); ?></span>
                                    </div>
                                    <ul class="event__time">
                                        <li>
                                            <?php echo get_month_value_long($y->month); ?>, 
                                            <?php echo $y->year; ?>. 
                                            <i class="fa fa-clock-o"></i><?php echo x_time_24hour($y->time); ?>
                                        </li>
                                        <li><i class="fa fa-home"></i><?php echo $y->venue; ?></li>
                                    </ul>
                                </div>
                                <div class="event__inner">
                                    <p><a href="<?php echo base_url('home/single_event/'.$y->id); ?>"><?php echo $y->caption; ?></a></p>
                                </div>
                                <div class="blog__btn m-l-20">
                                    <a class="dcare__btn btn__f6f6f6" href="<?php echo base_url('home/single_event/'.$y->id); ?>">Learn More &raquo;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Event -->

                <?php } //endforeach } ?>

            </div>
        </div>
    </div>

<?php } else { ?>

    <h3 class="text-danger">No event to show.</h3>

<?php } ?>


<div class="row m-t-30">
    <div class="col-lg-12">
        <div class="dcare__pagination">
            <?php echo pagination_links($links, 'dcare__page__list d-flex'); ?>
        </div>
    </div>
</div>