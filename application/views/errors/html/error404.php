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
                            <a class="accordion-head" data-toggle="collapse" data-parent="#checkout-accordion" href="#login">Page Not Found </a>
                            
                            <div id="checkout-method" class="collapse show">
                                <div class="checkout-method accordion-body fix">
                                    
                                   <div class="checkout-login-form text-center">

                                        <h1 class="text-danger">404</h1>
                                        <h3>Sorry, we could not find the page you were looking for. It may have been moved, or may not exist.</h3>

                                        <div class="input-box m-t-30">
                                            <a class="btn btn-success" href="<?php echo base_url(); ?>" style="background: #89d700;"><i class="fa fa-home"></i> Return Home</a>
                                        </div>

                                    </div>

                                </div>
                                
                            </div>
                            
                        </div>
                         
                    </div>
                </div> 
            </div>
        </div>
    </div><!-- Checkout Section End-->             
 </section>  