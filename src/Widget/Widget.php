<?php # -*- coding: utf-8 -*-

namespace TheDramatist\WooComAddMultipleProducts\Widget;

class Widget {
	
	public function __construct() {
		
		parent::__construct(
			'woocom_add_multiple_products_widget',
			// name of the widget
			__( 'WooCom Add Multiple Products', 'woocom-add-multiple-products' ),
			// widget options
			[
				'classname'   => 'woocom-amp-widget',
				'description' => __( 'WooCom Add Multiple Products Widget.', 'woocom-add-multiple-products' ),
			]
		);
	}
	
	public function init() {
		add_action( 'widgets_init', function () {
			register_widget( $this );
		} );
	}
	
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, [
			'woocom-amp-title' => '',
		] );
		include( plugin_dir_path( __FILE__ ) . 'Views/html-admin-view.php' );
	}
	
	public function update( $new_instance, $old_instance ) {
		$old_instance['woocom-amp-title'] = strip_tags( stripslashes( $new_instance['woocom-amp-title'] ) );
		return $old_instance;
	}
	
	public function widget( $args, $instance ) {
		$title = $instance['woocom-amp-title'];
		if (
			'1' === get_option( 'woocom_amp_user_check' )
			&& is_user_logged_in()
		) {
			$user_role  = get_option( 'woocom_amp_user_role' );
			$cu_roles   = $this->get_user_role( get_current_user_id() );
			$is_auth    = array_intersect( $user_role, $cu_roles ) ? 'true' : 'false';
			if ( ! empty( $user_role ) ) {
				if ( $is_auth ) {
					if ( ! is_cart() ) {
						echo $args['before_widget'];
						include 'Views/html-public-view.php';
						echo $args['after_widget'];
					}
				}
			} else {
				if ( ! is_cart() ) {
					echo $args['before_widget'];
					include 'Views/html-public-view.php';
					echo $args['after_widget'];
				}
			}
		} else {
			if ( ! is_cart() ) {
				echo $args['before_widget'];
				include 'Views/html-public-view.php';
				echo $args['after_widget'];
			}
		}
	}
	
	public function get_user_role( $user_ID ) {
		if ( is_user_logged_in() ) {
			$user = new WP_User( $user_ID );
			if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
				return $user->roles;
			}
		}
	}
	
	public function get_products() {
		// Get category settings
		$product_cat_setting = (array)get_option('woocom_amp_product_cat');
		if ( in_array( '-1', $product_cat_setting ) ) {
			// WP_Query arg for "Product" post type.
			$args = array(
				'post_type' => 'product',
				'fields' => 'ids',
				'posts_per_page' => '-1'
			);
		} else {
			// WP_Query arg for "Product" post type.
			$args = array(
				'post_type' => 'product',
				'tax_query' => array(
					array(
						'taxonomy' => 'product_cat',
						'field' => 'id', //can be set to ID
						'terms' =>  $product_cat_setting //if field is ID you can reference by cat/term number
					)
				),
				'fields' => 'ids',
				'posts_per_page' => '-1'
			);
		}
		// New Query
		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) {
			$rds = $loop->get_posts();
			// Loop Start.
			foreach($rds as $rd) {
				$product = new WC_Product( $rd );
				$sku = $product->get_sku();
				$stock = $product->is_in_stock()?__( ' -- In stock', 'sodathemes' ):__( ' -- Out of stock', 'sodathemes' );
				$disablity = $product->is_in_stock()?'':'disabled';
				echo '<option datad="' . $sku .'" value="' . $rd .'"'. $disablity . '>' . $sku . " -- " . get_the_title( $rd ) . $stock . '</option>';
			} // Loop End .
		}
		wp_reset_postdata();
	}
}
