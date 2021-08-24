
<?php echo flash_message_success('status_msg'); ?>
<?php echo flash_message_danger('status_msg_error'); ?>

	<div class="new-item">
		<a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('school_staff/staff_profile/'.$y->id); ?>"><i class="fa fa-user"></i> View Profile</a>
	</div>

	<?php 
	echo form_open_multipart('school_staff/edit_staff_action/'.$y->id); ?>
	
		All fields marked * are required.
	
		<div class="row">
		
			<div class="col-md-6 col-sm-12 col-xs-12">

				<div class="form-group">
					<label class="form-control-label">Name* <small>(Surname first)</small></label>
					<br/>
					<input type="text" name="name" value="<?php echo set_value('name', $y->name); ?>" class="form-control" required />
					<div class="form-error"><?php echo form_error('name'); ?></div>
				</div>

				<div class="form-group">
					<label class="form-control-label">Email*</label>
					<br/>
					<input type="email" class="form-control" value="<?php echo set_value('email', $y->email); ?>" readonly />
				</div>

				<div class="form-group">
					<label class="form-control-label">Mobile No*</label>
					<br/>
					<input type="text" name="phone" value="<?php echo set_value('phone', $y->phone); ?>" class="form-control" required />
					<div class="form-error"><?php echo form_error('phone'); ?></div>
				</div>
				
				<div class="form-group">
					<label class="form-control-label">Date of Birth*</label>
					<div class="input-group date date_datepicker_no_future" data-date-format="yyyy-mm-dd">
						<input type="text" class="form-control" name="date_of_birth" value="<?php echo set_value('date_of_birth', $y->date_of_birth); ?>" readonly required />
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<div class="form-error"><?php echo form_error('date_of_birth'); ?></div>
					</div>
				</div>
				
				<div class="form-group" >
					<label class="form-control-label m-r-20 ">Sex*</label>
					<label class="m-r-10"><input type="radio" name="sex" value="Male" <?php echo set_radio( 'sex', 'Male', radio_value($y->sex, 'Male') ); ?> > Male</label>
					<label><input type="radio" name="sex" value="Female" <?php echo set_radio( 'sex', 'Female', radio_value($y->sex, 'Female') ); ?> > Female</label>
					<div class="form-error"><?php echo form_error('sex'); ?></div>
				</div>
				
				<div class="form-group">
					<label class="form-control-label">Residential Address</label>
					<textarea class="form-control" name="residential_address"><?php echo set_value('residential_address', strip_tags($y->residential_address)); ?></textarea>
					<div class="form-error"><?php echo form_error('residential_address'); ?></div>
				</div>	

				<div class="form-group">
					<label class="form-control-label">Designation*</label>
					<select class="form-control" name="designation" required >
						<option selected value="<?php echo $y->designation; ?>"><?php echo $y->designation; ?></option>

							<?php
							$staff_designations = staff_designations(); 
							foreach ($staff_designations as $designation) { 
								$selected = ($y->designation == $designation) ? 'selected' : NULL; ?>
								<option <?php echo $selected; ?> value="<?php echo $designation; ?>" <?php echo set_select('designation', $designation); ?> ><?php echo $designation; ?></option>
							<?php } ?>

					</select>
					<div class="form-error"><?php echo form_error('designation'); ?></div>
				</div>

				<div class="form-group">
					<label class="form-control-label">Favorite Quote</label>
					<textarea class="form-control t100" name="quote"><?php echo set_value('quote', $y->quote); ?></textarea>
					<div class="form-error"><?php echo form_error('quote'); ?></div>
				</div>
			
			</div><!--/.col-->


			<div class="col-md-6 col-sm-12 col-xs-12">

				<div class="form-group">
					<label class="form-control-label">Facebook Handle</label>
					<div class="input-group">
						<div class="input-group-addon bg-facebook">
							<i class="fa fa-facebook"></i>
						</div>
						<input type="text" class="form-control" name="facebook_handle" value="<?php echo set_value('facebook_handle', $y->facebook_handle); ?>" />
						<div class="form-error"><?php echo form_error('facebook_handle'); ?></div>
					</div>
				</div>

				<div class="form-group">
					<label class="form-control-label">Twitter Handle</label>
					<div class="input-group">
						<div class="input-group-addon bg-twitter">
							<i class="fa fa-twitter"></i>
						</div>
						<input type="text" class="form-control" name="twitter_handle" value="<?php echo set_value('twitter_handle', $y->twitter_handle); ?>" />
						<div class="form-error"><?php echo form_error('twitter_handle'); ?></div>
					</div>
				</div>

				<div class="form-group">
					<label class="form-control-label">Instagram Handle</label>
					<div class="input-group">
						<div class="input-group-addon bg-instagram">
							<i class="fa fa-instagram"></i>
						</div>
						<input type="text" class="form-control" name="instagram_handle" value="<?php echo set_value('instagram_handle', $y->instagram_handle); ?>" />
						<div class="form-error"><?php echo form_error('instagram_handle'); ?></div>
					</div>
				</div>

				<div class="form-group">
					<label class="form-control-label">LinkedIn Handle</label>
					<div class="input-group">
						<div class="input-group-addon bg-linkedin">
							<i class="fa fa-linkedin"></i>
						</div>
						<input type="text" class="form-control" name="linkedin_handle" value="<?php echo set_value('linkedin_handle', $y->linkedin_handle); ?>" />
						<div class="form-error"><?php echo form_error('linkedin_handle'); ?></div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="form-control-label">Additional Information</label>
					<textarea class="form-control t100" name="additional_info"><?php echo set_value('additional_info', strip_tags($y->additional_info)); ?></textarea>
					<div class="form-error"><?php echo form_error('additional_info'); ?></div>
				</div>
				
				<div class="form-group">

					<label class="form-control-label">Staff Photo
						<small>(Optional. Only jpg and png files allowed. Max 1MB)</small>
					</label>
				
					<?php 
					if ($y->photo != NULL) { ?>

						<div id="current_image_area" class="m-b-10">
							<img id="current_image" src="<?php echo base_url('assets/uploads/photos/staff/' .$y->photo); ?>" />
						</div>
						<label class="form-control-label" id="change_image_text">Change Photo?</label> <br />

						<div class="file_area">
							<input type="file" name="photo" id="the_image_on_update" class="form-control" accept=".jpeg,.jpg,.png" value="<?php echo set_value('photo'); ?>" />
							<div class="form-error"><?php echo $upload_error['error']; ?></div>
						</div>	
						
					<?php } else { ?>
					
						<div id="current_image_area" class="m-b-10">
							<img id="current_image" src="<?php echo user_avatar; ?>" />
						</div>
						<label class="form-control-label" id="change_image_text">Upload Staff Photo?</label> <br />
						
						<div class="file_area">
							<input type="file" name="photo" id="the_image_on_update" class="form-control" accept=".jpeg,.jpg,.png" value="<?php echo set_value('photo'); ?>" />
							<div class="form-error"><?php echo $upload_error['error']; ?></div>
						</div>
						
					<?php } ?>
					
				</div>
							
				<!-- Image preview-->
				<?php echo generate_image_preview(); ?>
				
				<div class="m-t-20">
					<button class="btn btn-primary btn-lg">Update</button>
				</div>
			
			</div><!--/.col-->
			
		</div><!--/.row-->

	
	<?php echo form_close(); ?>