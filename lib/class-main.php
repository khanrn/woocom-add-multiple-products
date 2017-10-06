<?php

/**
 *  Main Class for WooCom Add Multiple Products Main plugin
 */
class WooCom_Add_Multiple_Products_Main {
    
    function __construct() {
        
        // Action Hooks.
        add_action( 'woocommerce_after_cart', array( $this, 'wamp_product_input_from' ) );
        add_action( 'woocommerce_cart_is_empty', array( $this, 'wamp_product_input_from' ) );
        
        // Ajax product adding action hooks.
        add_action( 'wp_ajax_wamp_add_to_cart', array( $this, 'wamp_add_to_cart' ) );
		add_action( 'wp_ajax_nopriv_wamp_add_to_cart', array( $this, 'wamp_add_to_cart' ) );
        
        // Shortcode for adding products to different places
         add_shortcode( 'wamp_product_input', array( $this, 'wamp_product_input_from' ) );
    }
    
    // Scripts for this page.
    function wamp_register_scripts(){
        
        // WooCommerce credentials.
        global $woocommerce;
        $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
        
        // Loading Chosen jQuery from WooCommerce.
        wp_enqueue_script( 'chosen_wamp', $woocommerce->plugin_url() . '/assets/js/chosen/chosen.jquery'.$suffix.'.js', array('jquery'), null, false );
       
        // Loading jQuery from local directory.
        wp_enqueue_script( 'main-js', plugin_dir_url(__FILE__) . 'js/main.js', array('chosen_wamp'), '1.0.0', true );
        wp_enqueue_script( 'ajax-js', plugin_dir_url(__FILE__) . 'js/ajax.js', array('main-js'), '1.0.0', true );
        
        // Localization for Ajax. 
        wp_localize_script( 'ajax-js', 'WpAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
        wp_localize_script( 'ajax-js', 'WPURLS', array( 'siteurl' => plugin_dir_url(__FILE__) ));
    }
    
    // Styles for this page.
    function wamp_register_styles() {
        wp_enqueue_style( 'chosen-wamp', plugin_dir_url(__FILE__).'css/chosen.css' );
        wp_enqueue_style( 'main', plugin_dir_url(__FILE__).'css/main.css', array('chosen-wamp'), '1.0.0', true );
	}
    
    function wamp_product_input_from(){ 
        if(is_user_logged_in()){
            
            // Registering CSS and JS files for this page only
            $this->wamp_register_scripts();
            $this->wamp_register_styles();
            
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
            ?>
            <div id="wamp_form">
                <h4><?php _e( 'Add Product(s)...', 'sodathemes' )?></h4>
                <!-- multiple dropdown -->
                <select id="wamp_select_box" data-placeholder="<?php _e( 'Choose a product...', 'sodathemes' )?>" multiple class="chzn-select">
                    <optgroup label="<?php _e( 'Choose Products by SKU or Name....', 'sodathemes' )?>">
            <?php
               
                // Loop start.
                foreach($r_prods as $r_prod) {
                    $product = new WC_Product( $r_prod );
                    $sku = $product->get_sku();
                    if ( ! $product->is_in_stock() ) { 
                        $stock = __( ' -- Out of stock', 'sodathemes' ); 
                    } else { 
                        $stock = __( ' -- In stock', 'sodathemes' );
                    }
            ?>
                        <option data-prod="<?php echo $sku; ?>" value="<?php echo $r_prod; ?>" <?php if ( ! $product->is_in_stock() ) { echo 'disabled'; }?>><?php echo $sku . " -- " . get_the_title( $r_prod ) . $stock; ?></option>
            <?php
                } // End loop.
            }
            wp_reset_postdata();
            ?>
                    </optgroup>
                </select>
                <button id="wamp_add_items_button" type="button" class="button add_order_item wamp_add_order_item"><?php _e( 'Add Item(s)', 'sodathemes' )?></button>
            </div>
            <?php
        }
    }
    
    // Ajax function
    function wamp_add_to_cart(){
        global $woocommerce;
        
        // Getting and sanitizing $_POST data.
        $product_ids = filter_input(INPUT_POST, 'ids', FILTER_SANITIZE_SPECIAL_CHARS);
        $prod_ids = preg_split( '/,/', $product_ids );
        foreach( $prod_ids as $product_id ){
            $woocommerce->cart->add_to_cart($product_id);
        }
        die();
    }
}
?>
