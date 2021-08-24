<section class="htc__checkout bg--white m-t-50">
    <!-- Checkout Section Start-->
    <div class="checkout-section">
        <div class="container">
            <div class="row">


                <div class="col-md-6 offset-md-3 mb-30">
                    

                    <?php echo flash_message_success('status_msg'); ?>
                    <?php echo flash_message_danger('status_msg_error'); ?>

                       
                    <!-- Checkout Accordion Start -->
                    <div id="checkout-accordion">
                       
                        <!-- Checkout Method -->
                        <div class="single-accordion">
                            <a class="accordion-head" data-toggle="collapse" data-parent="#checkout-accordion" href="#login"><?php echo $title; ?></a>
                            
                            <div id="checkout-method" class="collapse show">
                                <div class="checkout-method accordion-body fix">
                                    
                                   <?php
                                    //process form asynchronously using AJAX
                                    $form_attributes = array("id" => "unsubscribe_newsletter_form", "class" => "checkout-login-form");
                                    echo form_open('home/unsubscribe_newsletter_ajax', $form_attributes); ?>

                                        <div class="row">

                                            <div class="input-box col-md-12 col-12 mb--20">
                                                Enter the email address that you currently receive our newsletter at.
                                            </div>

                                            <div class="input-box col-md-12 col-12 mb--20">
                                                <label>Email</label>
                                                <input type="email" name="email" required />
                                            </div>

                                            <div class="input-box col-12">
                                                <div id="status_msg"></div>
                                            </div>

                                            <div class="input-box col-12">
                                                <input style="width: 200px" type="submit" value="Unsubscribe">
                                            </div>

                                        </div>

                                    <?php echo form_close(); ?>
                                    
                                </div>

                            </div>
                            
                        </div>
                         
                    </div>
                </div> 
            </div>
        </div>
    </div><!-- Checkout Section End-->             
 </section>  