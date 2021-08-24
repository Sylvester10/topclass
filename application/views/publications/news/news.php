
<?php
if ($total_records > 0) { ?>

    <div class="row">

        <?php
        foreach ($news as $y) { 

            $total_comments = $this->news_model->count_post_comments($y->id); ?>

            <!-- Start Single BLog -->
            <div class="col-12 m-b-50">
                <article class="blog__single blog__item">
                    <div class="blog__thumb sticky">
                        <a href="<?php echo base_url('assets/uploads/news/'.$y->featured_image); ?>" target="_blank">
                            <img src="<?php echo base_url('assets/uploads/news/'.$y->featured_image); ?>" alt="blog image">
                        </a>
                    </div>
                    <div class="blog__content">
                        <h2><a href="<?php echo base_url('home/single_news/'.$y->id.'/'.$y->slug); ?>"><?php echo $y->title; ?></a></h2>
                        <ul class="bl__post">
                            <li><i class="fa fa-user"></i> Posted by <a href="#!">Admin</a></li>
                            <li><i class="fa fa-calendar"></i> <?php echo x_date_full($y->date); ?></li>
                            <li><i class="fa fa-comments"></i> <a href="<?php echo base_url('home/single_news/'.$y->id.'/'.$y->slug); ?>#comments_section">Comments: <?php echo $total_comments; ?></a></li>
                        </ul>
                        <p><?php echo $y->snippet; ?></p>
                        <div class="blog__btn">
                            <a class="dcare__btn btn__f6f6f6" href="<?php echo base_url('home/single_news/'.$y->id.'/'.$y->slug); ?>">Read More &raquo;</a>
                        </div>
                    </div>
                </article>
            </div>
            <!-- End Single BLog -->

        <?php } ?>

    </div>


<?php } else { ?>

    <h3 class="text-danger">No news to show.</h3>

<?php } ?>


<div class="row m-t-30">
    <div class="col-lg-12">
        <div class="dcare__pagination">
            <?php echo pagination_links($links, 'dcare__page__list d-flex'); ?>
        </div>
    </div>
</div>