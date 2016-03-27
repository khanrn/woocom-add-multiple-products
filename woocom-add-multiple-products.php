<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://sodathemes.com
 * @since             2.0.0
 * @package           Woocom_Add_Multiple_Products
 *
 * @wordpress-plugin
 * Plugin Name:       WooCom Add Multiple Products
 * Plugin URI:        http://sodathemes.com/product/woocom-add-multiple-products/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           2.0.0
 * Author:            SodaThemes
 * Author URI:        http://sodathemes.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woocom-add-multiple-products
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woocom-add-multiple-products-activator.php
 */
function activate_woocom_add_multiple_products() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocom-add-multiple-products-activator.php';
	Woocom_Add_Multiple_Products_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woocom-add-multiple-products-deactivator.php
 */
function deactivate_woocom_add_multiple_products() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocom-add-multiple-products-deactivator.php';
	Woocom_Add_Multiple_Products_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woocom_add_multiple_products' );
register_deactivation_hook( __FILE__, 'deactivate_woocom_add_multiple_products' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woocom-add-multiple-products.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    2.0.0
 */
function run_woocom_add_multiple_products() {

	$plugin = new Woocom_Add_Multiple_Products();
	$plugin->run();

}
/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	run_woocom_add_multiple_products();
} else {
	add_action( 'admin_notices', 'sodathemes_wamp_admin_notice__error' );
}

function sodathemes_wamp_admin_notice__error() {
	$class = 'notice notice-error';
	$message = __( 'You don\'t have WooCommerce activated. Please Activate WooCommerce and then try to activate again WooCom Add Multiple Products.', 'sodathemes' );

	printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message ); 
}
