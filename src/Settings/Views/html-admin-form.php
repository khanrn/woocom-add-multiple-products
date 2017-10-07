<div class="wrap about-wrap">
	<h1><?php printf( __( 'WooCom Add Multiple Products %s' ), $this->version ); ?></h1>
	
	<div class="about-text">
		<?php printf( __( 'Thank you for downloading this product. For any kind of support please post in forum or mail me at <a href="mailto:naby88@gmail.com">naby88@gmail.com</a><br>' ), $this->version ); ?>
	</div>
	<form method="post" action="options.php">
		<?php settings_fields( 'woocom-amp-settings-group' ); ?>
		<?php do_settings_sections( 'woocom-amp-settings-group' ); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Product Category(s)</th>
				<td>
					<select id="woocom_amp_product_cat" name="woocom_amp_product_cat[]" multiple="multiple" required>
						<optgroup label="<?php _e( 'Please select a product category....', 'sodathemes' )?>">
							
							<?php $this->get_product_cats();?>
						
						</optgroup>
					</select>
					<br>
					<span class="description">If you want to define the product category please use this option. <code>All Products</code> means it will show all the products in the input field.</span>
				</td>
			</tr>
			
			<tr valign="top">
				<th scope="row">Auth Restriction</th>
				<td>
					<fieldset>
						<label><input type="radio" value="" name="woocom_amp_user_check" <?php checked( '', get_option( 'woocom_amp_user_check' ) ); ?>/>All Users</label>
						<label><input type="radio" value="1" name="woocom_amp_user_check" <?php checked( '1', get_option( 'woocom_amp_user_check' ) ); ?>/>Only Logged In Users</label>
					</fieldset>
					<br>
					<span class="description">This option helps you with which kind of users you want to give the access to the product input field.</span>
				</td>
			</tr>
			
			<tr class="top">
				<th scope="row">User Role Can See The Form</th>
				<td>
					<select id="woocom_amp_user_role" name="woocom_amp_user_role[]" multiple="multiple" <?php echo get_option( 'woocom_amp_user_check' ) == 1 ? '' : 'disabled'; ?>>
						<option value="">All</option>
						<?php $this->roles_dropdown( get_option( 'woocom_amp_user_role' ) ); print_r(get_option( 'woocom_amp_user_role' )); ?>
					</select>
					<br>
					<span class="description" style="margin-top: 10px">It is not gonna work if you select the <code>Auth Restriction</code> option to <code>All Users</code>. So you must select the <code>Only Logged In Users</code> option to make this work.</span>
				</td>
			</tr>
		</table>
		
		<?php submit_button(); ?>
	
	</form>
</div>