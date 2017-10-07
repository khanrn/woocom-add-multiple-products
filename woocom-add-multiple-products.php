<?php # -*- coding: utf-8 -*-

/**
 * Plugin Name: WooCom Add Multiple Products
 * Description: A plugin for adding bulk product by SKU or product name to cart when you're in cart.
 * Plugin URI:  https://github.com/rnaby
 * Author:      TheDramatist
 * Author URI:  http://rnaby.github.com/
 * Version:     3.0.0
 * License:     GPL-2.0
 * Text Domain: woocom-add-multiple-products
 */

namespace TheDramatist\WooComAddMultipleProducts;

/**
 * Initialize a hook on plugin activation.
 *
 * @return void
 */
function activate() {
     do_action( 'woocom-add-multiple-products_plugin_activate' );
}
register_activation_hook( __FILE__, __NAMESPACE__ . '\\activate' );

/**
 * Initialize a hook on plugin deactivation.
 *
 * @return void
 */
function deactivate() {
     do_action( 'woocom-add-multiple-products_plugin_deactivate' );
}
register_activation_hook( __FILE__, __NAMESPACE__ . '\\deactivate' );

/**
 * Initialize all the plugin things.
 *
 * @return void
 * @throws \Throwable
 */
function initialize() {

	try {
		
		/**
		 * Check if WooCommerce is active
		 **/
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			deactivate_plugins( plugin_basename( __FILE__ ) );
			add_action(
				'admin_notices', function () {
				
				$class   = 'notice notice-error is-dismissible';
				$message = __(
					'You don\'t have <b>WooCommerce</b> activated. Please Activate <b>WooCommerce</b> and then try to activate again <b>WooCom Add Multiple Products</b>.',
					'woocom-add-multiple-products'
				);
				
				printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );
			}
			);
			
			return;
		}
		/**
		 * Checking if vendor/autoload.php exists or not.
		 */
		if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
			/** @noinspection PhpIncludeInspection */
			require_once __DIR__ . '/vendor/autoload.php';
		}
		
		// Translation directory updated !
		load_plugin_textdomain(
			'woocom-add-multiple-products',
			true,
			basename( dirname( __FILE__ ) ) . '/languages'
		);
		
		
		/**
		 * Calling modules.
		 */
		( new Assets\AssetsEnqueue() )->init();
		( new Settings\Settings() )->init();
		( new Frontend\Frontend() )->init();
		( new Widget\Widget() )->init();

	} catch ( \Throwable $throwable ) {
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			throw $throwable;
		}
		do_action( 'woocom-add-multiple-products_error', $throwable );
	}
}

add_action( 'plugins_loaded', __NAMESPACE__ . '\\initialize' );
