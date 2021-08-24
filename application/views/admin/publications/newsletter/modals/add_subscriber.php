	
	<div class="modal fade" id="add_subscriber" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content modal-form-sm">
				<div class="modal-header">
					<div class="pull-right">
						<button class="btn btn-danger btn-sm modal_close_btn" data-dismiss="modal" class="close" title="Close"> &times;</button>
					</div>
					<h4 class="modal-title">Add Subscriber</h4>
				</div><!--/.modal-header-->
				<div class="modal-body">
					
					<?php 
					$form_attributes = array("id" => "add_subscriber_form");
					echo form_open('newsletter/add_subscriber_ajax', $form_attributes); ?>
					
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" name="name" required /> 
						</div>

						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email" required /> 
						</div>
						
						<div id="status_msg"></div>
						
						<div>
							<button class="btn btn-primary">Subscribe User</button>
						</div>

					<?php echo form_close(); ?>

				</div>
			</div>
		</div>
	</div>