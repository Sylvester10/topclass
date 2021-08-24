        
        <?php
        //newsletter subscription form
        require 'application/views/publications/newsletter/includes/subscribe_newsletter.php'; ?>
        

        <!-- Footer Area -->
        <footer id="footer" class="footer-area">
            <div class="footer__wrapper poss-relative ftr__btm__image section-padding--lg bg--white"></div>
            <div class="copyright">
                 
                <?php 
                //check if announcement is published
                if ($announcement_is_published == 'true') { ?>

                    <div class="j_marquee" style="background: #fe5629; padding: 10px;">
                        <!-- Announcement Scroll -->
                        <h3 class="text-white"><?php echo $announcement; ?></h3>
                    </div>

                <?php } ?>

            </div>
            <!-- //Footer Area -->

            
            <!-- .End Footer Contact Area -->
            <div class="copyright  bg--theme">
                <div class="container">
                    <div class="row align-items-center copyright__wrapper">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="coppy__right__inner copy__right">
                                <p><i class="fa fa-copyright text-white"></i>Copyright, <?php echo date('Y'); ?>. <a href="<?php echo base_url(); ?>"> <?php echo school_name ?></a></p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="coppy__right__inner copy_right ">
                                <p class="text-white">Powered by<a href="<?php echo software_vendor_site; ?>" target="_blank"> <?php echo software_vendor ?></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>