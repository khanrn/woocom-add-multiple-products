<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://sodathemes.com
 * @since      2.0.0
 *
 * @package    Woocom_Add_Multiple_Products
 * @subpackage Woocom_Add_Multiple_Products/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap about-wrap">
	<h1><?php printf( __( 'Woocom Add Multiple Products %s' ), $this->version ); ?></h1>

	<div class="about-text" style="min-height: 0">
		<?php printf( __( 'Settings page is only available for pro version.' ), $this->version ); ?>
	</div>
	<a class="button button-primary" target="_blank" href="http://bit.ly/dwqa-markdown">Go Premium!</a>
	<div class="wp-badge" style="
	background-image: url(<?php echo plugin_dir_url('') . $this->sodathemes_wamp . '/admin/img/logo.png'?>);
    background-color: #284142;
    color: #fff;">SODATHEMES</div>
	
	<div class="headline-feature feature-section one-col" style="max-width: 100%">
		<h2 style="text-align: left"><?php _e( 'Woocom Add Multiple Products Pro Features !' ); ?></h2>
		<div class="two-col">
			<h3><i class="fa fa-check-square-o"></i><?php _e( 'Select "Product Category" Option' ); ?></h3>
			<p><?php _e( 'With pro version now you can select single or multiple product categories from which the products should be appeared in the dropdown list.' ); ?></p>
			<h3><i class="fa fa-check-square-o"></i><?php _e( 'Auth Restriction Option' ); ?></h3>
			<p><?php _e( 'With pro version\'s "Auth Restrict" option you can define if only logged in user can use the form or all user can use the form.' ); ?></p>
			<h3><i class="fa fa-check-square-o"></i><?php _e( 'Use Role Select Option.' ); ?></h3>
			<p><?php _e( 'If you want to give access to the product dropdown list to the user has a certain role, you can do that with this option. This option is only available for pro version.' ); ?></p>
			<h3><i class="fa fa-check-square-o"></i><?php _e( 'Shrotcode Functionality' ); ?></h3>
			<p><?php _e( 'This product has a shortcode. And with this shortcode you can render the product dropdown list any where you want.' ); ?></p>
			<h3><i class="fa fa-check-square-o"></i><?php _e( 'Dynamic Category ID Option For Shortcode' ); ?></h3>
			<p><?php _e( 'For pro version, we provide a "prod_cat" field with shortcode. If you want to display the products from certain category ( or categories ) in dropdown list, it should do it.' ); ?></p>
			<h3><i class="fa fa-check-square-o"></i><?php _e( 'Dynamic Widget' ); ?></h3>
			<p><?php _e( 'A dynamic widget is included with the pro version. With this you can show the product dropdown list with widget.' ); ?></p>
			<h3><i class="fa fa-check-square-o"></i><?php _e( 'Very Easy To Use' ); ?></h3>
			<p><?php _e( 'it\'s very easy to use. Just install like any other plugin and you\'ll understand how to use it.' ); ?></p>
		</div>
	</div>
</div>