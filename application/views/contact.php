    
   
        <section class="page__contact bg--white pb--150">
            <div class="container">
                <div class="row">
                    <!-- Start Single Address -->
                    <div class=" col-lg-4 col-md-4 col-sm-12 m-b-50">
                        <div class="address location">
                            <div class="ct__icon">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div class="address__inner">
                                <h2>Our Location</h2>
                                <ul>
                                    <li><?php echo school_address ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Address -->
                    <!-- Start Single Address -->
                    <div class=" col-lg-4 col-md-4 col-sm-12 m-b-50">
                        <div class="address phone">
                            <div class="ct__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="address__inner">
                                <h2>Phone Numbers</h2>
                                <ul>
                                    <li><a href="tell:+08097-654321"><?php echo school_phone_number ?></a></li>
                                    <li><a href="tell:+08097-654321"><?php echo school_phone_number2 ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Address -->
                    <!-- Start Single Address -->
                    <div class=" col-lg-4 col-md-4 col-sm-12 m-b-50">
                        <div class="address email">
                            <div class="ct__icon">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <div class="address__inner" style="overflow-x: auto;">
                                <h2>E-mail Address</h2>
                                <ul>
                                    <li><a href="mailto: <?php echo school_contact_email; ?>"><?php echo school_contact_email; ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Address -->
                </div>
            </div>
        </section>



        <div class="contact__map">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="google__map">
                            <div id="googleMap"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Start Contact Form -->
        <section class="contact__box section-padding--lg bg-image--27">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <div class="section__title text-center">
                            <h2 class="text-white">Drop a Message</h2>
                        </div>
                    </div>
                </div>

                <?php 
                $form_attributes = array("id" => "contact_us_form");
                echo form_open('home/contact_us_ajax', $form_attributes); ?>

                    <div class="row mt--80">
                        <div class="col-lg-12">
                            <div class="contact-form-wrap">

                                    <div class="single-contact-form name">
                                        <input type="text" name="name" value="<?php echo set_value('name'); ?>" class="form-control" placeholder="Your Name*" required />
                                        <input type="email" name="email" value="<?php echo set_value('email'); ?>" class="form-control" placeholder="Email*" required />
                                    </div>

                                    <div class="single-contact-form subject">
                                        <input type="text" name="subject" value="<?php echo set_value('subject'); ?>" class="form-control" placeholder="Subject*" required />
                                    </div>

                                    <div class="single-contact-form message">
                                        <textarea name="message" class="form-control" placeholder="Type your message here.." required></textarea>
                                    </div>

                                    <div class="single-contact-form name">
                                        <input type="text" name="captcha_code" id="captcha_code" value="<?php echo $captcha_code; ?>" class="form-control" readonly />
                                        <input type="text" name="c_captcha_code" value="<?php echo set_value('c_captcha_code'); ?>" class="form-control" placeholder="Enter code to prove you're human*" required />
                                    </div>

                                    <div class="m-t-20">  
                                        <div id="status_msg"></div>
                                    </div>

                                    <div class="contact-btn" id="contact_us_btn">
                                        <button type="submit" class="dcare__btn">Submit</button>
                                    </div>

                            </div> 

                        </div>
                    </div>

                <?php echo form_close(); ?>

            </div>
        </section>
        <!-- End Contact Form -->
        

       		
    <!-- Google Map js -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCncs1vkfH4ebnwehKxJMB2mhdMon3FOdQ"></script>
    <script src="<?php echo base_url(); ?>assets/js/google_map.js"></script>



	


