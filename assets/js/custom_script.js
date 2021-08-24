jQuery(document).ready(function ($) {
 "use strict";


	//jQuery Marquee
	$('.j_marquee').marquee({
	    //speed in milliseconds of the marquee
	    duration: 15000, //15secs
	    //gap in pixels between the tickers
	    gap: 50,
	    //time in milliseconds before the marquee will start animating
	    delayBeforeStart: 0,
	    //'left' or 'right'
	    direction: 'left',
	    //true or false - should the marquee be duplicated to show an effect of continuous flow
	    duplicated: false,
	    //pause the animation on hover
	    pauseOnHover: true,
	});


	//Contact Us
	$('#contact_us_form').submit(function(e) {
		e.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url + 'home/contact_us_ajax', 
			type: 'POST',
			data: form_data, 
			success: function(msg) {
				if (msg == 1) {
					$('#status_msg').html('<div class="alert alert-success text-center"> Thank you! Your message was sent successfully.</div>').fadeIn( 'fast' );
					$('#contact_us_form')[0].reset(); //reset form fields
					$('#captcha_code').val('');	//clear captcha field
				} else {
					$('#status_msg').html('<div class="alert alert-danger text-center">' + msg + '</div>').fadeIn( 'fast' ).delay( 30000 ).fadeOut( 'slow' );
				}
			}
		});
	});



	//Comment
	$('#create_comment_form').submit(function(e) {
		e.preventDefault();
		var form_data = $(this).serialize();
		var post_id = $('#post_id').val();
		$.ajax({
			url: base_url + 'home/create_comment_ajax/' + post_id, 
			type: 'POST',
			data: form_data, 
			success: function(msg) {
				if (msg == 1) {
					$('#status_msg').html('<div class="alert alert-success text-center"> Thank you! Your comment was submitted successfully.</div>').fadeIn( 'fast' );
					$('#create_comment_form')[0].reset(); //reset form fields
					$('#captcha_code').val('');	//clear captcha field
					setTimeout(function() { 
						location.reload();
					}, 5000); 	
				} else {
					$('#status_msg').html('<div class="alert alert-danger text-center">' + msg + '</div>').fadeIn( 'fast' ).delay( 10000 ).fadeOut( 'slow' );
				}
			}
		});
	});




	//Subscribe Newsletter
	$('#subscribe_newsletter_form').submit(function(e) {
		e.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url + 'home/subscribe_newsletter_ajax', 
			type: 'POST',
			data: form_data, 
			success: function(msg) {
				if (msg == 1) {
					$('#subscribe_status_msg').html('<div class="alert alert-success text-center"> Thank you! Your subscription was successful.</div>').fadeIn( 'fast' );
					$('#subscribe_newsletter_form')[0].reset(); //reset form fields
					$('#sn_captcha_code').val('');	//clear captcha field
					//close modal after 5 secs
					setTimeout(function() { 
						var container = $('.login-wrapper');
						container.removeClass('is-visible'); //close modal
						$('#subscribe_status_msg').css('display', 'none'); //hide status div
					}, 5000); 	
				} else {
					$('#subscribe_status_msg').html('<div class="alert alert-danger text-center">' + msg + '</div>').fadeIn( 'fast' ).delay( 10000 ).fadeOut( 'slow' );
				}
			}
		});
	});


	//Unsubscribe Newsletter
	$('#unsubscribe_newsletter_form').submit(function(e) {
		e.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url + 'home/unsubscribe_newsletter_ajax', 
			type: 'POST',
			data: form_data, 
			success: function(msg) {
				if (msg == 1) {
					$('#status_msg').html('<div class="alert alert-success text-center">You have been successfully unsubscribed. </div>').fadeIn( 'fast' ).delay( 30000 ).fadeOut( 'slow' );
				} else {
					$('#status_msg').html('<div class="alert alert-danger text-center">' + msg + '</div>').fadeIn( 'fast' ).delay( 30000 ).fadeOut( 'slow' );
				}
			}
		});
	});


});