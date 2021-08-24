jQuery(document).ready(function ($) {
 "use strict";



 	Dropzone.options.upload_photo_form = {
 		maxFilesize: 3,
 		acceptedFiles: '.jpg, .jpeg, .png, .gif',
		init: function() {
			this.on('success', function() {
				if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
					location.reload(); //reload page after upload success
				}
			});
		}
	};



 	//Quick Mail
	$('#quick_mail_form').submit(function(e) {
		e.preventDefault();
		var form_data = $('#quick_mail_form').serialize();
		$.ajax({
			url: base_url + 'admin/send_quick_mail_ajax', 
			type: 'POST',
			data: form_data, 
			success: function(msg) {
				if (msg == 1) {
					$( '#q_status_msg' ).html('<div class="alert alert-success text-center">Mail successfully sent.</div>').fadeIn( 'fast' ).delay( 30000 ).fadeOut( 'slow' );
				} else {
					$('#q_status_msg').html('<div class="alert alert-danger text-center">' + msg + '</div>').fadeIn( 'fast' ).delay( 30000 ).fadeOut( 'slow' );
				}
			}
		});
	});



	//Update School Stats
	$('#update_school_stats_form').submit(function(e) {
		e.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url + 'school_stats/update_school_stats_ajax', 
			type: 'POST',
			data: form_data, 
			success: function(msg) {
				if (msg == 1) {
					$( '#status_msg' ).html('<div class="alert alert-success text-center">School Stats updated successfully.</div>').fadeIn( 'fast' ).delay( 30000 ).fadeOut( 'slow' );
				} else {
					$('#status_msg').html('<div class="alert alert-danger text-center">' + msg + '</div>').fadeIn( 'fast' ).delay( 30000 ).fadeOut( 'slow' );
				}
			}
		});
	});



	//Edit Profile
	$('#edit_profile_form').submit(function(e) {
		e.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url + 'admin/edit_profile_ajax', 
			type: 'POST',
			data: form_data, 
			success: function(msg) {
				if (msg == 1) {
					$( '#status_msg' ).html('<div class="alert alert-success text-center">Profile updated successfully.</div>').fadeIn( 'fast' ).delay( 30000 ).fadeOut( 'slow' );
					setTimeout(function() { 
						location.reload(); //reload page
					}, 3000);
				} else {
					$('#status_msg').html('<div class="alert alert-danger text-center">' + msg + '</div>').fadeIn( 'fast' ).delay( 30000 ).fadeOut( 'slow' );
				}
			}
		});
	});



 	
	//Update General Announcement
	$('#update_announcement_form').submit(function(e) {
		e.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url + 'announcement/update_announcement_ajax', 
			type: 'POST',
			data: form_data, 
			success: function(msg) {
				if (msg == 1) {
					$( '#status_msg' ).html('<div class="alert alert-success text-center">Announcement updated successfully.</div>').fadeIn( 'fast' );
					setTimeout(function() { 
						location.reload(); //reload page
					}, 3000);
				} else {
					$('#status_msg').html('<div class="alert alert-danger text-center">' + msg + '</div>').fadeIn( 'fast' ).delay( 30000 ).fadeOut( 'slow' );
				}
			}
		});
	});




	//Add Newsletter Subscriber
	$('#add_subscriber_form').submit(function(e) {
		e.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url + 'newsletter/add_subscriber_ajax', 
			type: 'POST',
			data: form_data, 
			success: function(msg) {
				if (msg == 1) {
					$( '#status_msg' ).html('<div class="alert alert-success text-center">New subscriber added successfully.</div>').fadeIn( 'fast' );
					setTimeout(function() { 
						location.reload(); //reload page
					}, 3000);
				} else {
					$('#status_msg').html('<div class="alert alert-danger text-center">' + msg + '</div>').fadeIn( 'fast' ).delay( 30000 ).fadeOut( 'slow' );
				}
			}
		});
	});


	
	//Create Event
	$('#create_event_form').submit(function(e) {
		e.preventDefault();
		var form_data = $(this).serialize();
		var redirect_url = base_url + 'events/events_list';				
		$.ajax({
			url: base_url + 'events/create_event_ajax', 
			type: 'POST',
			data: form_data, 
			success: function(msg) {
				if (msg == 1) {
					$( '#status_msg' ).html('<div class="alert alert-success text-center">New event added successfully.</div>').fadeIn( 'fast' );
					setTimeout(function() { 
						$(location).attr('href', redirect_url);
					}, 3000);
				} else {
					$('#status_msg').html('<div class="alert alert-danger text-center">' + msg + '</div>').fadeIn( 'fast' ).delay( 30000 ).fadeOut( 'slow' );
				}
			}
		});
	});



	//Edit Event
	$('#edit_event_form').submit(function(e) {
		e.preventDefault();
		var form_data = $(this).serialize();
		var event_id = $('#event_id').val();			
		$.ajax({
			url: base_url + 'events/edit_event_ajax/' + event_id, 
			type: 'POST',
			data: form_data, 
			success: function(msg) {
				if (msg == 1) {
					$( '#status_msg' ).html('<div class="alert alert-success text-center">Event updated successfully.</div>').fadeIn( 'fast' ).delay( 30000 ).fadeOut( 'slow' );
				} else {
					$('#status_msg').html('<div class="alert alert-danger text-center">' + msg + '</div>').fadeIn( 'fast' ).delay( 30000 ).fadeOut( 'slow' );
				}
			}
		});
	});



	//Class Teacher Assignment
	$('#class_teacher_assignment_form').submit(function(e) {
		e.preventDefault();
		var form_data = $(this).serialize();
		var class_teacher_id = $('#class_teacher_id').val();
		$.ajax({
			url: base_url + 'school_staff/class_teacher_assignment_ajax/' + class_teacher_id, 
			type: 'POST',
			data: form_data, 
			success: function(msg) {
				if (msg == 1) {
					$( '#status_msg' ).html('<div class="alert alert-success text-center"> Class teacher assignment updated successfully.</div>').fadeIn( 'fast' ).delay( 30000 ).fadeOut( 'slow' );
				} else {
					$('#status_msg').html('<div class="alert alert-danger text-center">' + msg + '</div>').fadeIn( 'fast' ).delay( 30000 ).fadeOut( 'slow' );
				}
			}
		});
	});




	//Add New Admin
	$('#new_admin_form').submit(function(e) {
		e.preventDefault();
		var form_data = $('#new_admin_form').serialize();
		$.ajax({
			url: base_url + 'admin_users/add_new_admin_ajax', 
			type: 'POST',
			data: form_data, 
			success: function(msg) {
				if (msg == 1) {
					$('#new_admin_form')[0].reset(); //reset form fields
					$( '#status_msg' ).html('<div class="alert alert-success text-center">New admin added successfully.</div>').fadeIn( 'fast' ).delay( 30000 ).fadeOut( 'slow' );
				} else {
					$('#status_msg').html('<div class="alert alert-danger text-center">' + msg + '</div>').fadeIn( 'fast' ).delay( 30000 ).fadeOut( 'slow' );
				}
			}
		});
	});
	
	
	
	//Edit Admin
	$('#edit_admin_form').submit(function(e) {
		e.preventDefault();
		var form_data = $('#edit_admin_form').serialize();
		var id = $('#admin_id').val();
		var name = $('#admin_name').val();
		var redirect_url = base_url + 'admin_users';
		$.ajax({
			url: base_url + 'admin_users/edit_admin_ajax/' + id, 
			type: 'POST',
			data: form_data, 
			success: function(msg) {
				if (msg == 1) {
					$( '#status_msg' ).html('<div class="alert alert-success text-center">' + name + ' updated successfully.</div>').fadeIn( 'fast' );
					setTimeout(function() { 
						$(location).attr('href', redirect_url);
					}, 3000);
				} else {
					$('#status_msg').html('<div class="alert alert-danger text-center">' + msg + '</div>').fadeIn( 'fast' ).delay( 30000 ).fadeOut( 'slow' );
				}
			}
		});
	});
	
	
	
	
	
	//print and export buttons for DataTables
	var ExportButtons = [
		{
			extend: 'colvis', //column visibility
			className: 'data_export_buttons'
		},
		{
			extend: 'print',
			className: 'data_export_buttons',
			exportOptions: {
				columns: ':visible'
			}
		},
		{
			extend: 'excel',
			className: 'data_export_buttons',
			exportOptions: {
				columns: ':visible'
			}
		},
		{
			extend: 'csv',
			className: 'data_export_buttons',
			exportOptions: {
				columns: ':visible'
			}
		},
		{
			extend: 'pdf',
			className: 'data_export_buttons',
			exportOptions: {
				columns: ':visible'
			}
		}
	];



	//Newsletter Subscribers
	var csrf_hash = $('#csrf_hash').val();
	var newsletter_subscribers_table = $('#newsletter_subscribers_table').DataTable({ 
		paging: true,
		pageLength :30,
		lengthChange: true, 
		searching: true,
		info: true,
		scrollX: true,
		autoWidth: false,
		ordering: true,
		stateSave: true,
		processing: false, 
		serverSide: true, 
		pagingType: "simple_numbers", 
		dom: "<'dt_len_change'l>f<'dt_buttons'B>trip", 
		order: [], //Initial no order.
		language: {
			search: "Search/filter subscribers: ",
			processing: "Please wait a sec...",
			info: "Showing _START_ to _END_ of _TOTAL_ subscribers",
			infoFiltered: "(filtered from _MAX_ total subscribers)",
			emptyTable: "No subscriber to show.",
			lengthMenu: "Show _MENU_ subscribers",
		},
		ajax: {
			url: base_url + 'newsletter/subscribers_ajax',
			dataType: "json",
			type: "POST",
			data: { 'q2r_secure' : csrf_hash } //cross site request forgery protection
		},
		columnDefs: [
			{targets: [0, 1], orderable: false}
		],
		buttons: ExportButtons
	});




	//Staff
	var csrf_hash = $('#csrf_hash').val();
	var all_staff_table = $('#all_staff_table').DataTable({ 
		paging: true,
		pageLength : 10,
		lengthChange: true, 
		searching: true,
		info: true,
		scrollX: true,
		autoWidth: false,
		ordering: true,
		stateSave: true,
		processing: false, 
		serverSide: true, 
		pagingType: "simple_numbers", 
		dom: "<'dt_len_change'l>f<'dt_buttons'B>trip", 
		order: [], //Initial no order.
		language: {
			search: "Search/filter staff: ",
			processing: "Please wait a sec...",
			info: "Showing _START_ to _END_ of _TOTAL_ staff",
			infoFiltered: "(filtered from _MAX_ total staff)",
			emptyTable: "No staff to show.",
			lengthMenu: "Show _MENU_ staff",
		},
		ajax: {
			url: base_url + 'school_staff/staff_ajax',
			dataType: "json",
			type: "POST",
			data: { 'q2r_secure' : csrf_hash } //cross site request forgery protection
		},
		columnDefs: [
			{targets: [0, 1], orderable: false}
		],
		buttons: ExportButtons
	});



	//Staff: Class Teachers
	var csrf_hash = $('#csrf_hash').val();
	var class_teachers_table = $('#class_teachers_table').DataTable({ 
		paging: true,
		pageLength : 10,
		lengthChange: true, 
		searching: true,
		info: true,
		scrollX: true,
		autoWidth: false,
		ordering: true,
		stateSave: true,
		processing: false, 
		serverSide: true, 
		pagingType: "simple_numbers", 
		dom: "<'dt_len_change'l>f<'dt_buttons'B>trip", 
		order: [], //Initial no order.
		language: {
			search: "Search/filter teachers: ",
			processing: "Please wait a sec...",
			info: "Showing _START_ to _END_ of _TOTAL_ teachers",
			infoFiltered: "(filtered from _MAX_ total teachers)",
			emptyTable: "No teacher to show.",
			lengthMenu: "Show _MENU_ teachers",
		},
		ajax: {
			url: base_url + 'school_staff/class_teachers_ajax',
			dataType: "json",
			type: "POST",
			data: { 'q2r_secure' : csrf_hash } //cross site request forgery protection
		},
		columnDefs: [
			{targets: [0, 1], orderable: false}
		],
		buttons: ExportButtons
	});





	//Admins
	var csrf_hash = $('#csrf_hash').val();
	var admins_table = $('#admins_table').DataTable({ 
		paging: true,
		pageLength : 10,
		lengthChange: true, 
		searching: true,
		info: true,
		scrollX: true,
		autoWidth: false,
		ordering: true,
		stateSave: true,
		processing: false, 
		serverSide: true, 
		pagingType: "simple_numbers", 
		dom: "<'dt_len_change'l>f<'dt_buttons'B>trip", 
		order: [], //Initial no order.
		language: {
			search: "Search/filter admins: ",
			processing: "Please wait a sec...",
			info: "Showing _START_ to _END_ of _TOTAL_ admins",
			infoFiltered: "(filtered from _MAX_ total admins)",
			emptyTable: "No admin to show.",
			lengthMenu: "Show _MENU_ admins",
		},
		ajax: {
			url: base_url + 'admin_users/admins_ajax',
			dataType: "json",
			type: "POST",
			data: { 'q2r_secure' : csrf_hash } //cross site request forgery protection
		},
		columnDefs: [
			{targets: [0, 1], orderable: false}
		],
		buttons: ExportButtons
	});
	
	
	
	
	

	
	
}); //jQuery(document).ready(function)