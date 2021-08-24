jQuery(document).ready(function ($) {
 "use strict";
	

	//Admin login
	$('#login_form').submit(function(e) {
		e.preventDefault();
		var form_data = $(this).serialize();
		var redirect_url = base_url + 'admin';				
		$.ajax({
			url: base_url + 'login/login_ajax', 
			type: 'POST',
			data: form_data, 
			success: function(msg) {
				if (msg == 1) {
					$( '#status_msg' ).html('<div class="alert alert-success text-center"> Login successful. Redirecting to your dashboard... <p>If you are not automatically redirected, <a href="' + redirect_url + '">click here</a></p> </div>').fadeIn('fast');
					setTimeout(function() { 
						$(location).attr('href', redirect_url);
					}, 3000);					
				} else {
					$( '#status_msg' ).html('<div class="alert alert-danger text-center">' + msg + '</div>').fadeIn('fast').delay( 30000 ).fadeOut( 'slow' );	
				}
			}
		});
	});
	

	
	//Password Recovery: Admin
	$('#password_recovery_form').submit(function(e) {
		e.preventDefault();
		var form_data = $(this).serialize();
		var email = $('#email').val();
		$.ajax({
			url: base_url + 'login/password_recovery_ajax', 
			type: 'POST',
			data: form_data, 
			success: function(msg) {
				if (msg == 1) {
					$('#status_msg').html('<div class="alert alert-success text-center"> Your request for password retrieval was successful. We have sent an email to [' + email + '] with further instructions to reset your password. </div>').fadeIn( 'fast' ).delay( 30000 ).fadeOut( 'slow' );
				} else {
					$('#status_msg').html('<div class="alert alert-danger text-center">' + msg + '</div>').fadeIn( 'fast' ).delay( 30000 ).fadeOut( 'slow' );
				}
			}
		});
	});
	
	
	//Password Reset: Admin
	$('#change_password_form').submit(function(e) {
		e.preventDefault();
		var form_data = $(this).serialize();
		var id = $('#admin_id').val();
		var redirect_url = base_url + 'login';		
		$.ajax({
			url: base_url + 'login/change_password_ajax/'+id, 
			type: 'POST',
			data: form_data, 
			success: function(msg) {
				if (msg == 1) {
					$('#status_msg').html('<div class="alert alert-success text-center">Password reset successfully. Redirecting to login page... <p>If you are not automatically redirected, <a href="' + redirect_url + '">click here</a></p> </div>').fadeIn( 'fast' );
					setTimeout(function() { 
						$(location).attr('href', redirect_url);
					}, 3000);	
				} else {
					$('#status_msg').html('<div class="alert alert-danger text-center">' + msg + '</div>').fadeIn( 'fast' ).delay( 30000 ).fadeOut( 'slow' );
				}
			}
		});
	});



});
