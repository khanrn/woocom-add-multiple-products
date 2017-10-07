<?php # -*- coding: utf-8 -*-

namespace TheDramatist\WooComAddMultipleProducts\Assets;

/**
 * Class AssetsEnqueue
 *
 * @author  Khan M Rashedun-Naby <naby88@gmail.com>
 * @link    http://rnaby.github.io/
 *
 * @since   3.0.0
 *
 * @package woocom-add-multiple-products
 * @subpackage woocom-add-multiple-products/Assets
 * @license https://www.gnu.org/licenses/gpl.txt GPL
 */
class AssetsEnqueue {
	
	/**
	 * AssetsEnqueue constructor.
	 */
	public function __construct() {
	
	}
	
	/**
	 * Enqueueing scripts and styles.
	 *
	 * @since 3.0.0
	 *
	 * @return void
	 */
	public function init() {
		// Public scripts.
		add_action( 'wp_enqueue_scripts', [ $this, 'public_styles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'public_scripts' ] );
		// Admin scripts.
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_styles' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );
	}
	
	/**
	 * Enqueueing public_styles.
	 *
	 * @since 3.0.0
	 *
	 * @return void
	 */
	public function public_styles() {
		wp_enqueue_style(
			'woocom-add-multiple-products-public-css',
			plugin_dir_url( __FILE__ ) . '../../assets/css/public.css',
			null,
			'1.0.0',
			'all'
		);
	}
	
	/**
	 * Enqueueing public_scripts.
	 *
	 * @since 3.0.0
	 *
	 * @return void
	 */
	public function public_scripts() {
		// Registering the script.
		wp_register_script(
			'woocom-add-multiple-products-public-js',
			plugin_dir_url( __FILE__ ) . '../../assets/js/public.js',
			[ 'jquery' ],
			'1.0.0',
			true
		);
		// Local JS data
		$local_js_data = [
			'ajax_url' => admin_url( 'admin-ajax.php' ),
		];
		// Pass data to myscript.js on page load
		wp_localize_script(
			'woocom-add-multiple-products-public-js',
			'WPAjaxObj',
			$local_js_data
		);
		// Enqueueing JS file.
		wp_enqueue_script( 'woocom-add-multiple-products-public-js' );
	}
	
	/**
	 * Enqueueing admin styles.
	 *
	 * @since 3.0.0
	 *
	 * @return void
	 */
	public function admin_styles() {
		
		// WooCommerce credentials.
		global $woocommerce;
		wp_enqueue_style(
			'woocommerce-chosen',
			$woocommerce->plugin_url() . '/assets/css/select2.css', null, $this->version,
			'all',
			true
		);
		
		wp_enqueue_style(
			'woocom-add-multiple-products-admin-admin-css',
			plugin_dir_url( __FILE__ ) . '../../assets/css/admin.css',
			null,
			'1.0.0',
			'all'
		);
	}
	
	/**
	 * Enqueueing admin scripts.
	 *
	 * @since 3.0.0
	 *
	 * @return void
	 */
	public function admin_scripts() {
		// WooCommerce credentials.
		global $woocommerce;
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		// Loading Chosen Chosen jQuery from WooCommerce.
		wp_enqueue_script(
			'woocommerce-chosen-js',
			$woocommerce->plugin_url() . '/assets/js/select2/select2' . $suffix . '.js', [ 'jquery' ],
			null,
			true
		);
		// Registering the script.
		wp_register_script(
			'woocom-add-multiple-products-admin-js',
			plugin_dir_url( __FILE__ ) . '../../assets/js/admin.js',
			[ 'jquery' ],
			'1.0.0',
			true
		);
		// Local JS data
		$local_js_data = [
			'ajax_url' => admin_url( 'admin-ajax.php' ),
		];
		// Pass data to myscript.js on page load
		wp_localize_script(
			'woocom-add-multiple-products-admin-js',
			'WPAjaxObj',
			$local_js_data
		);
		// Enqueueing JS file.
		wp_enqueue_script( 'woocom-add-multiple-products-admin-js' );
	}
}