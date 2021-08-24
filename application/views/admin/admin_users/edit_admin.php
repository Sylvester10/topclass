	<div class="row">
		<div class="col-md-7">
	
			<div class="new-item">
				<a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('admin_users'); ?>"><i class="fa fa-users"></i> All Admins</a>
			</div>

			<p class="text-bold">Quick Note</p>

			<p>Admin Role determines which section of the application an admin can access. You can assign multiple roles to an admin.</p>

			
			<?php 
			$form_attributes = array("id" => "edit_admin_form");
			echo form_open('admin_users/edit_admin_ajax/'.$y->id, $form_attributes); ?>
			
				<input type="hidden" id="admin_id" value="<?php echo $y->id; ?>" />
				<input type="hidden" id="admin_name" value="<?php echo $y->name; ?>" />
			
				<div class="form-group">
					<label>Name</label>
					<input type="text" class="form-control" name="name" value="<?php echo $y->name; ?>" required />
				</div>

				<div class="form-group m-t-20">
					<label>Email Address</label>
					<input type="email" class="form-control" value="<?php echo $y->email; ?>" readonly />
				</div>

				<div class="form-group m-t-20">
					<label>Phone</label>
					<input type="text" class="form-control numbers-only" name="phone" value="<?php echo $y->phone; ?>" maxlength="15" required />
				</div>

				<div class="form-group">
					<label>Roles: <?php echo $y->roles; ?></label>
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
					<button class="btn btn-primary btn-lg">Update</button>
				</div>

			<?php echo form_close(); ?>
			
		</div>
	</div>
			
	