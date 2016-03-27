<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://sodathemes.com
 * @since      2.0.0
 *
 * @package    Woocom_Add_Multiple_Products
 * @subpackage Woocom_Add_Multiple_Products/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woocom_Add_Multiple_Products
 * @subpackage Woocom_Add_Multiple_Products/admin
 * @author     SodaThemes <sodathemes.ltd@gmail.com>
 */
class Woocom_Add_Multiple_Products_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $sodathemes_wamp    The ID of this plugin.
	 */
	private $sodathemes_wamp;

	/**
	 * The version of this plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    2.0.0
	 * @param      string    $sodathemes_wamp       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $sodathemes_wamp, $version ) {

		$this->sodathemes_wamp = $sodathemes_wamp;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woocom_Add_Multiple_Products_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocom_Add_Multiple_Products_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->sodathemes_wamp, plugin_dir_url( __FILE__ ) . 'css/woocom-add-multiple-products-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woocom_Add_Multiple_Products_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocom_Add_Multiple_Products_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->sodathemes_wamp, plugin_dir_url( __FILE__ ) . 'js/woocom-add-multiple-products-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	public function register_extensions() {
		$extension = array(
			'dwqa-markdown' => array(
				'name' => __( 'DWQA Markdown', 'dwqa' ),
				'url' => 'http://bit.ly/dwqa-markdown',
				'img_url' => plugin_dir_url( __FILE__ ) . 'img/dw-markdown.png'
			),

			'dwqa-leaderboard' => array(
				'name' => __( 'DWQA Leaderboard', 'dwqa' ),
				'url' => 'http://bit.ly/dwqa-leaderboard',
				'img_url' => plugin_dir_url( __FILE__ ) . 'img/dw-leaderboard.png'
			),

			'dwqa-captcha' => array(
				'name' => __( 'DWQA Captcha', 'dwqa' ),
				'url' => 'http://bit.ly/dwqa-captcha',
				'img_url' => plugin_dir_url( __FILE__ ) . 'img/dw-captcha.png',
			),

			'dwqa-embed-question' => array(
				'name' => __( 'DWQA Embed Question', 'dwqa' ),
				'url' => 'http://bit.ly/dwqa-embed-questions',
				'img_url' => plugin_dir_url( __FILE__ ) . 'img/dw-embedquestion.png'
			),

			'dwqa-widgets' => array(
				'name' => __( 'DWQA Widgets', 'dwqa' ),
				'url'	=> 'http://bit.ly/dwqa-widgets',
				'img_url'	=> plugin_dir_url( __FILE__ ) . 'img/dw-widgets.png'
			),
		);

		return $extension;
	}
	// Admin Menu Page Calling function.
	public function woocom_amp_admin_menu_page() {

		add_menu_page(
			'WooCom Add Multiple Products', 
			'WooCom AMP', 
			'manage_options', 
			'woocom-add-multiple-products', 
			array( $this, 'woocom_amp_admin_settings_page' ) , 
			'dashicons-layout'
		);
		//create new top-level menu
		add_submenu_page(
			'woocom-add-multiple-products',
			'Other Premium Products', 
			'Go Premium', 
			'read', 
			'sodathemes-other-products', 
			array( $this, 'sodathemes_other_products' )
		);
	}
	// Admin Settings Page Function
	public function woocom_amp_admin_settings_page() {
		include 'partials/html-sodathemes-current-product.php';
	}
	// Other Products Function
	public function sodathemes_other_products() {
		include 'partials/html-sodathemes-other-products.php';
	}

}
