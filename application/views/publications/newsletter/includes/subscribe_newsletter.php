        
        <!-- Subscribe Form -->
        <div class="login-wrapper">
            <div class="accountbox">
                <div class="accountbox__inner">
                	<h4 class="text-center">Subscribe to our Newsletter</h4>
                    <div class="accountbox__login">

                       <?php
                        //process form asynchronously using AJAX
                        $captcha_code = mt_rand(111111, 999999);
                        $form_attributes = array("id" => "subscribe_newsletter_form");
                        echo form_open('home/subscribe_newsletter_ajax', $form_attributes); ?>

                            <div class="single-input">
                                <input type="email" name="email" placeholder="E-mail" required />
                            </div>

                            <div class="single-input">
                                <input type="text" name="name" placeholder="Name" required />
                            </div>
 
                            <div class="single-input">
                            	<input class="text-center" style="background: #f2f2f2" type="text" name="captcha_code" id="sn_captcha_code" value="<?php echo $captcha_code; ?>" readonly />
                            </div>

                            <div class="single-input">
                            	<input type="text" name="c_captcha_code" placeholder="Enter above code to prove you're human" required />
                            </div>

                            <div id="subscribe_status_msg" class="m-t-20"></div>

                            <div class="single-input text-center">
                                <button type="submit" class="sign__btn">Subscribe</button>
                            </div>

                        <?php echo form_close(); ?>

                    </div>
                    <span class="accountbox-close-button"><i class="zmdi zmdi-close"></i></span>
                </div>
            </div>
        </div><!-- //Subscribe Form -->
