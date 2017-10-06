<?php

/*
  Plugin Name: WooCom Add Multiple Products
  Plugin URI: https://rnaby.com
  Description: A plugin for adding multiple product to cart.
  Version: 1.0.0
  Author: Khan Mohammad Rashedun-Naby
  Author URI: http://bd.linkedin.com/in/rnaby
  License: GPL V3
 */

if ( ! defined( 'ABSPATH' ) ) { 
    exit; // Exit if accessed directly
}

class WooCom_Add_Multiple_Products {
	private static $instance = null;
	private $plugin_path;
	private $plugin_url;
    private $text_domain = '';

	/**
	 * Creates or returns an instance of this class.
	 */
	public static function get_instance() {
		// If an instance hasn't been created and set to $instance create an instance and set it to $instance.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Initializes the plugin by setting localization, hooks, filters, and administrative functions.
	 */
	private function __construct() {
		$this->plugin_path = plugin_dir_path( __FILE__ );
		$this->plugin_url  = plugin_dir_url( __FILE__ );

		load_plugin_textdomain( $this->text_domain, false, $this->plugin_path . '\lang' );

		add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_styles' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_styles' ) );

		register_activation_hook( __FILE__, array( $this, 'activation' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivation' ) );

		$this->run_plugin();
	}

	public function get_plugin_url() {
		return $this->plugin_url;
	}

	public function get_plugin_path() {
		return $this->plugin_path;
	}

    /**
     * Plugin activation code.
     */
    public function activation() {

	}

    /**
     * Plugin deactivation code.
     */
    public function deactivation() {

	}

    /**
     * Enqueue and register JavaScript files.
     */
    public function register_scripts() {

    }
    /**
     * Enqueue and register CSS files.
     */
    public function register_styles() {
        
	}

    /**
     * Functionality.
     */
    private function run_plugin() {
        require 'lib/class-main.php';
        new WooCom_Add_Multiple_Products_Main;
	}
}

/**
 * If WooCommerce is active.
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    WooCom_Add_Multiple_Products::get_instance();
}
