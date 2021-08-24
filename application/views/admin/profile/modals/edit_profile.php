	
	<div class="modal fade" id="edit_profile" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content modal-form-sm">
				<div class="modal-header">
					<div class="pull-right">
						<button class="btn btn-danger btn-sm modal_close_btn" data-dismiss="modal" class="close" title="Close"> &times;</button>
					</div>
					<h4 class="modal-title">Edit Profile</h4>
				</div><!--/.modal-header-->
				<div class="modal-body">

					<?php 
					$form_attributes = array("id" => "edit_profile_form");
					echo form_open('admin/edit_profile_ajax', $form_attributes); ?>
					
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" name="name" value="<?php echo $y->name; ?>" required />
						</div>

						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control numbers-only" value="<?php echo $y->email; ?>" readonly />
						</div>

						<div class="form-group">
							<label>Phone Number</label>
							<input type="text" class="form-control numbers-only" name="phone" value="<?php echo $y->phone; ?>" required />
						</div>

						
						<div class="form-group m-t-20">
							<input type="checkbox" name="change_password" id="change_password" /> Change Password?
						</div>
						
						<div id="password_area" style="display: none" class="m-b-20">

							<div class="form-group">
								<label> New Password </label>
								<input type="password" class="form-control" name="password" id="password" value="" />	
							</div>

							<div class="form group">
								<label> Confirm New Password </label>
								<input type="password" class="form-control" name="c_password" id="c_password" placeholder="Re-enter Password" value="" />		
							</div>

						</div>
						
						<div id="status_msg"></div>
						
						<div>
							<button class="btn btn-primary"> <i class="fa fa-arrow-circle-up"></i> Update </button>
						</div>

					<?php echo form_close(); ?>

				</div>
			</div>
		</div>
	</div>