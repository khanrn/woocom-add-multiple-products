<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://sodathemes.com
 * @since      2.0.0
 *
 * @package    Woocom_Add_Multiple_Products
 * @subpackage Woocom_Add_Multiple_Products/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      2.0.0
 * @package    Woocom_Add_Multiple_Products
 * @subpackage Woocom_Add_Multiple_Products/includes
 * @author     SodaThemes <sodathemes.ltd@gmail.com>
 */
class Woocom_Add_Multiple_Products_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    2.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'woocom-add-multiple-products',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
