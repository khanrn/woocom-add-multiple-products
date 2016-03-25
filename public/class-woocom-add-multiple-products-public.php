<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://sodathemes.com
 * @since      2.0.0
 *
 * @package    Woocom_Add_Multiple_Products
 * @subpackage Woocom_Add_Multiple_Products/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woocom_Add_Multiple_Products
 * @subpackage Woocom_Add_Multiple_Products/public
 * @author     SodaThemes <sodathemes.ltd@gmail.com>
 */
class Woocom_Add_Multiple_Products_Public {

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
	 * @param      string    $sodathemes_wamp       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $sodathemes_wamp, $version ) {

		$this->sodathemes_wamp = $sodathemes_wamp;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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
		
		// WooCommerce credentials.
        global $woocommerce;
        wp_enqueue_style( 'woocommerce-chosen',  $woocommerce->plugin_url() . '/assets/css/chosen.css', array(), $this->version, 'all', true );

		wp_enqueue_style( $this->sodathemes_wamp, plugin_dir_url( __FILE__ ) . 'css/woocom-add-multiple-products-public.css', array( 'woocommerce-chosen' ), $this->version, 'all', true );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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
		// WooCommerce credentials.
        global $woocommerce;
        $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
        
        // Loading Chosen Chosen jQuery from WooCommerce.
        wp_enqueue_script( 'woocommerce-chosen-js', $woocommerce->plugin_url() . '/assets/js/chosen/chosen.jquery'.$suffix.'.js', array('jquery'), null, true );
		wp_enqueue_script( $this->sodathemes_wamp, plugin_dir_url( __FILE__ ) . 'js/woocom-add-multiple-products-public.js', array( 'woocommerce-chosen-js' ), $this->version, true );
        
        // Localization for Ajax. 
        wp_localize_script( 
        	$this->sodathemes_wamp, 
        	'WPURLS', 
        	array( 
        		'ajaxurl' => admin_url( 'admin-ajax.php' ),
        		'siteurl' => plugin_dir_url(__FILE__) 
        	) 
        );	
    }
    // Ajax function
    public function woocom_amp_add_to_cart(){
        global $woocommerce;
        // Getting and sanitizing $_POST data.
        $product_ids = filter_input(INPUT_POST, 'ids', FILTER_SANITIZE_SPECIAL_CHARS);
        $prod_ids = preg_split( '/,/', $product_ids );
        foreach( $prod_ids as $product_id ){
            $woocommerce->cart->add_to_cart($product_id);
        }
        die();
    }
    // Product input form
    public function woocom_amp_product_input_from(){
        if(is_user_logged_in()){
        	include 'partials/woocom-add-multiple-products-public-display.php';
        }
    }
	 // Get products on list.
    public function woocom_amp_get_products() {
        // WP_Query arg for "Product" post type. 
        $args = array( 
            'post_type' => 'product',
            'fields' => 'ids', 
            'posts_per_page' => '-1' 
        );
        // New Query
        $loop = new WP_Query( $args );
        if ( $loop->have_posts() ) {
            $r_prods = $loop->get_posts();  
            // Loop Start.
            foreach($r_prods as $r_prod) {
                $product = new WC_Product( $r_prod );
                $sku = $product->get_sku();
                $stock = $product->is_in_stock()?__( ' -- In stock', 'sodathemes' ):__( ' -- Out of stock', 'sodathemes' );
                $disablity = $product->is_in_stock()?'':'disabled';
                echo '<option data-prod="' . $sku .'" value="' . $r_prod .'"'. $disablity . '>' . $sku . " -- " . get_the_title( $r_prod ) . $stock . '</option>';
            } // Loop End .
        }
        wp_reset_postdata();
    }
}
