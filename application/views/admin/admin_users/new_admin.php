	<div class="row">
		<div class="col-md-7">
	
			<div class="new-item">
				<a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('admin_users'); ?>"><i class="fa fa-users"></i> All Admins</a>
			</div>
			
			<p class="text-bold">Quick Note</p>

			<p>New admins will be created with the default password <span class="text-success text-bold"><?php echo default_admin_password; ?></span>. They can change their password later.</p>

			<p>Admin Role determines which section of the application an admin can access. You can assign multiple roles to an admin.</p>
				
			<?php 
			$form_attributes = array("id" => "new_admin_form");
			echo form_open('admin_users/add_new_admin_ajax', $form_attributes); ?>
			
				<div class="form-group">
					<label>Name</label>
					<input type="text" class="form-control" name="name" required />
				</div>

				<div class="form-group m-t-20">
					<label>Email Address</label>
					<input type="email" class="form-control" name="email" required />
				</div>

				<div class="form-group m-t-20">
					<label>Phone</label>
					<input type="text" class="form-control numbers-only" name="phone" maxlength="15" required />
				</div>
					
				<div class="form-group">
					<label>Roles</label>
					<select class="form-control selectpicker" name="roles[]" multiple>
						<?php
						$admin_roles = admin_roles();
						foreach ($admin_roles as $role) { ?>
							<option value="<?php echo $role; ?>"><?php echo $role; ?></option>
						<?php } ?>
					</select>
					<div class="form-error"><?php echo form_error('roles'); ?></div>
				</div>

				<div id="status_msg"></div>
				
				<div class="m-t-20">
					<button class="btn btn-primary btn-lg">Submit</button>
				</div>

			<?php echo form_close(); ?>		

		</div>
	</div>
			
	