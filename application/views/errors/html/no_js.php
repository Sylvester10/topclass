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
                            <a class="accordion-head" data-toggle="collapse" data-parent="#checkout-accordion" href="#!">JavaScript Detection Failed </a>
                            
                            <div id="checkout-method" class="collapse show">
                                <div class="checkout-method accordion-body fix">
                                    
                                   <div class="checkout-login-form text-center">

                                        <h1 class="text-danger">JavaScript Disabled</h1>
                                        <h3>It appears that JavaScript is disabled on this device. We use JavaScript to enhance overall user experience. Please enable JavaScript to continue using this site.</h3>

                                        <h4 class="m-t-30">If you do not know what this is or how to go about enabling it, <a href="https://enablejavascript.co/" target="_blank" class="underline-link">see this post</a></h4>

                                        <div class="m-t-20">Enabled it?</div>
                                        <h3><a href="<?php echo base_url(); ?>">Return Home</a></h3>

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