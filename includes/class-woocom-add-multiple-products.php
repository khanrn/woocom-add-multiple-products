<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://sodathemes.com
 * @since      2.0.0
 *
 * @package    Woocom_Add_Multiple_Products
 * @subpackage Woocom_Add_Multiple_Products/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      2.0.0
 * @package    Woocom_Add_Multiple_Products
 * @subpackage Woocom_Add_Multiple_Products/includes
 * @author     SodaThemes <sodathemes.ltd@gmail.com>
 */
class Woocom_Add_Multiple_Products {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    2.0.0
	 * @access   protected
	 * @var      Woocom_Add_Multiple_Products_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    2.0.0
	 * @access   protected
	 * @var      string    $sodathemes_wamp    The string used to uniquely identify this plugin.
	 */
	protected $sodathemes_wamp;

	/**
	 * The current version of the plugin.
	 *
	 * @since    2.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    2.0.0
	 */
	public function __construct() {

		$this->sodathemes_wamp = 'woocom-add-multiple-products';
		$this->version = '2.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Woocom_Add_Multiple_Products_Loader. Orchestrates the hooks of the plugin.
	 * - Woocom_Add_Multiple_Products_i18n. Defines internationalization functionality.
	 * - Woocom_Add_Multiple_Products_Admin. Defines all hooks for the admin area.
	 * - Woocom_Add_Multiple_Products_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-woocom-add-multiple-products-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-woocom-add-multiple-products-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-woocom-add-multiple-products-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-woocom-add-multiple-products-public.php';

		$this->loader = new Woocom_Add_Multiple_Products_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Woocom_Add_Multiple_Products_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Woocom_Add_Multiple_Products_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$sodathemes_wamp_admin = new Woocom_Add_Multiple_Products_Admin( $this->get_sodathemes_wamp(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $sodathemes_wamp_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $sodathemes_wamp_admin, 'enqueue_scripts' );
		
		$this->loader->add_action( 'admin_menu', $sodathemes_wamp_admin, 'woocom_amp_admin_menu_page' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$sodathemes_wamp_public = new Woocom_Add_Multiple_Products_Public( $this->get_sodathemes_wamp(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $sodathemes_wamp_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $sodathemes_wamp_public, 'enqueue_scripts' );

        // Action Hooks.
        $this->loader->add_action( 'woocommerce_after_cart', $sodathemes_wamp_public, 'woocom_amp_product_input_from' );
        $this->loader->add_action( 'woocommerce_cart_is_empty', $sodathemes_wamp_public, 'woocom_amp_product_input_from' );
        
        // Ajax product adding action hooks.
        $this->loader->add_action( 'wp_ajax_woocom_amp_add_to_cart', $sodathemes_wamp_public, 'woocom_amp_add_to_cart' );
		$this->loader->add_action( 'wp_ajax_nopriv_woocom_amp_add_to_cart', $sodathemes_wamp_public, 'woocom_amp_add_to_cart' );
		
		// Shortcode for adding products input to different places
        add_shortcode( 'wamp_product_input', array( $sodathemes_wamp_public, 'woocom_amp_product_input_from' ) );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    2.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     2.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_sodathemes_wamp() {
		return $this->sodathemes_wamp;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     2.0.0
	 * @return    Woocom_Add_Multiple_Products_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     2.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
