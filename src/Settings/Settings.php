<?php

namespace TheDramatist\Settings;

class Settings {
	
	public function __construct() {
	
	}
	
	public function init() {
		add_action( 'admin_menu', [ $this, 'menu_page' ] );
		add_action( 'admin_init', [ $this, 'plugin_redirect' ] );
	}
	
	// Admin Menu Page Calling function.
	public function menu_page() {
		
		//create new top-level menu
		add_menu_page(
			__( 'WooCom Add Multiple Products Settings', 'woocom-add-multiple-products' ),
			__( 'WooCom AMP', 'woocom-add-multiple-products' ),
			'administrator',
			'woocom-add-multiple-products',
			[ $this, 'settings_form' ],
			'dashicons-layout',
			30
		);
		//call register settings public function
		add_action( 'admin_init', [ $this, 'register_settings' ] );
	}
	
	// Admin Setting Registration
	public function register_settings() {
		//register our settings
		register_setting( 'woocom-amp-settings-group', 'woocom_amp_product_cat' );
		register_setting( 'woocom-amp-settings-group', 'woocom_amp_user_check' );
		register_setting( 'woocom-amp-settings-group', 'woocom_amp_user_role' );
	}
	
	// Admin Settings Page Function
	public function settings_form() {
		include 'Views/html-admin-form.php';
	}
	
	public function get_product_cats() {
		$product_cat        = get_terms( 'product_cat', 'hide_empty=0' );
		$product_cat_option = (array) get_option( 'woocom_amp_product_cat' );
		if (
			in_array( - 1, $product_cat_option, true )
			|| empty( $product_cat_option )
		) :
			echo '<option value="-1" selected>All Products</option>';
			foreach ( $product_cat as $product_cat_key => $product_cat_value ) {
				echo '<option value='
					. esc_attr( $product_cat_value->term_id ) . '>'
					. esc_html( $product_cat_value->name ) . '</option>';
			}
		else :
			echo '<option value="-1">All Products</option>';
			foreach ( $product_cat as $product_cat_key => $product_cat_value ) {
				if (
					in_array( $product_cat_value->term_id, $product_cat_option, true )
				) {
					echo '<option value='
						. esc_attr( $product_cat_value->term_id ) . ' selected>'
						. esc_html( $product_cat_value->name ) . '</option>';
				} else {
					echo '<option value='
						. esc_attr( $product_cat_value->term_id ) . '>'
						. esc_html( $product_cat_value->name ) . '</option>';
				}
			}
		endif;
	}
	
	public function roles_dropdown( $selected ) {
		
		$selected = (array) $selected;
		
		$editable_roles = array_reverse( get_editable_roles() );
		
		foreach ( $editable_roles as $role => $details ) {
			$name = translate_user_role( $details['name'] );
			if (
				in_array( $role, $selected, true ) // preselect specified role
			) {
				echo "<option selected='selected' value='"
					. esc_attr( $role ) . "'>"
					. esc_html( $name ) . "</option>";
			} else {
				echo "<option value='"
					. esc_attr( $role ) . "'>"
					. esc_html( $name ) . "</option>";
			}
		}
	}
	
	public function plugin_redirect() {
		if ( get_option( 'woocom_amp_do_activation_redirect', false ) ) {
			delete_option( 'woocom_amp_do_activation_redirect' );
			wp_redirect( admin_url( 'admin.php?page=woocom-add-multiple-products' ) );
		}
	}
}