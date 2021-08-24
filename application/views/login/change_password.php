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
                            <a class="accordion-head" data-toggle="collapse" data-parent="#checkout-accordion" href="#login"><i class="fa fa-lock"></i> Change Password</a>
                            
                            <div id="checkout-method" class="collapse show">
                                <div class="checkout-method accordion-body fix">


                                    <?php if ( ! $valid_code ) { //invalid or expired code ?>
                                        <h4 class="text-danger">The password reset key is invalid or expired. If you submitted the password recovery request more than once, ensure you clicked on the reset link of the most recent mail sent to you.</h4> 
                                        
                                    <?php } else { //code is valid and not expired, show form ?>
                                    
                                       <?php
                                        //process form asynchronously using AJAX
                                        $form_attributes = array("id" => "change_password_form", "class" => "checkout-login-form");
                                        echo form_open('login/change_password_ajax', $form_attributes); ?>

                                            <div class="row">

                                                <input type="hidden" id="admin_id" value="<?php echo $y->id; ?>" />

                                                <div class="input-box col-md-12 col-12 mb--20">
                                                    <label>Email</label>
                                                    <input type="email" value="<?php echo $y->email; ?>" readonly />
                                                </div>

                                                <div class="input-box col-md-12 col-12 mb--20">
                                                     <label>Password</label>
                                                    <input type="password" name="password" placeholder="Password" required />
                                                </div>

                                                <div class="input-box col-md-12 col-12 mb--20">
                                                     <label>Confirm Password</label>
                                                    <input type="password" name="c_password" placeholder="Re-enter Password" required />
                                                </div>

                                                <div class="input-box col-12">
                                                    <div id="status_msg"></div>
                                                </div>

                                                <div class="input-box col-12">
                                                    <input type="submit" value="Change">
                                                </div>

                                            </div>

                                        <?php echo form_close(); ?>

                                    <?php } ?>

                                 </div>

                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <h5 class="text-bold"><a href="<?php echo base_url('login'); ?>">Login</a></h5>
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