<?php # -*- coding: utf-8 -*-

namespace TheDramatist\WooComAddMultipleProducts\Widget;

/**
 * Class Widget
 *
 * @author     Khan M Rashedun-Naby <naby88@gmail.com>
 * @link       http://rnaby.github.io/
 *
 * @since      3.0.0
 *
 * @package    woocom-add-multiple-products
 * @subpackage woocom-add-multiple-products/Widget
 * @license    https://www.gnu.org/licenses/gpl.txt GPL
 */
class Widget extends \WP_Widget {
	
	/**
	 * Widget constructor.
	 *
	 * @since 3.0.0
	 */
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
	
	/**
	 * Widget initialization.
	 *
	 * @since 3.0.0
	 * @return void
	 */
	public function init() {
		
		add_action( 'widgets_init', function () {
			
			register_widget( $this );
		} );
	}
	
	/**
	 * Admin form.
	 *
	 * @since 3.0.0
	 *
	 * @param $instance
	 */
	public function form( $instance ) {
		
		$instance = wp_parse_args( (array) $instance, [
			'woocom-amp-title' => '',
		] );
		include( plugin_dir_path( __FILE__ ) . 'Views/html-admin-view.php' );
	}
	
	/**
	 * Widget update method.
	 *
	 * @since 3.0.0
	 *
	 * @param $new_instance
	 * @param $old_instance
	 *
	 * @return mixed
	 */
	public function update( $new_instance, $old_instance ) {
		
		$old_instance[ 'woocom-amp-title' ] = strip_tags( stripslashes( $new_instance[ 'woocom-amp-title' ] ) );
		
		return $old_instance;
	}
	
	/**
	 * Widget forntend.
	 *
	 * @since 3.0.0
	 *
	 * @param $args
	 * @param $instance
	 *
	 * @return void
	 */
	public function widget( $args, $instance ) {
		
		$title = $instance[ 'woocom-amp-title' ];
		if (
			'1' === get_option( 'woocom_amp_user_check' )
			&& is_user_logged_in()
		) {
			$user_role = get_option( 'woocom_amp_user_role' );
			$cu_roles  = $this->get_user_role( get_current_user_id() );
			$is_auth   = array_intersect( $user_role, $cu_roles ) ? 'true' : 'false';
			if ( ! empty( $user_role ) ) {
				if ( $is_auth ) {
					if ( ! is_cart() ) {
						echo $args[ 'before_widget' ];
						include 'Views/html-public-view.php';
						echo $args[ 'after_widget' ];
					}
				}
			} else {
				if ( ! is_cart() ) {
					echo $args[ 'before_widget' ];
					include 'Views/html-public-view.php';
					echo $args[ 'after_widget' ];
				}
			}
		} else {
			if ( ! is_cart() ) {
				echo $args[ 'before_widget' ];
				include 'Views/html-public-view.php';
				echo $args[ 'after_widget' ];
			}
		}
	}
	
	/**
	 * Get user roles
	 *
	 * @since 3.0.0
	 *
	 * @param $user_ID
	 *
	 * @return mixed
	 */
	public function get_user_role( $user_id ) {
		
		if ( is_user_logged_in() ) {
			$user = new WP_User( $user_id );
			if ( ! empty( $user->roles ) && is_array( $user->roles ) ) {
				return $user->roles;
			}
		}
	}
	
	/**
	 * Get all products.
	 *
	 * @since 3.0.0
	 *
	 * @return void
	 */
	public function get_products() {
		
		// Get category settings
		$product_cat_setting = (array) get_option( 'woocom_amp_product_cat' );
		if ( in_array( '-1', $product_cat_setting ) ) {
			// WP_Query arg for "Product" post type.
			$args = [
				'post_type'      => 'product',
				'fields'         => 'ids',
				'posts_per_page' => '-1',
			];
		} else {
			// WP_Query arg for "Product" post type.
			$args = [
				'post_type'      => 'product',
				'tax_query'      => [
					[
						'taxonomy' => 'product_cat',
						'field'    => 'id', //can be set to ID
						'terms'    => $product_cat_setting,
					],
				],
				'fields'         => 'ids',
				'posts_per_page' => '-1',
			];
		}
		// New Query
		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) {
			$rds = $loop->get_posts();
			// Loop Start.
			foreach ( $rds as $rd ) {
				$product   = new WC_Product( $rd );
				$sku       = $product->get_sku();
				$stock     = $product->is_in_stock()
					? __( ' -- In stock', 'woocom-add-multiple-products' )
					: __( ' -- Out of stock', 'woocom-add-multiple-products' );
				$disablity = $product->is_in_stock() ? '' : 'disabled';
				echo '<option datad="'
				     . esc_attr( $sku ) . '" value="'
				     . esc_attr( $rd ) . '"'
				     . esc_attr( $disablity ) . '>'
				     . esc_html( $sku ) . ' -- '
				     . esc_html( get_the_title( $rd ) )
				     . esc_attr( $stock )
				     . '</option>';
			} // Loop End .
		}
		wp_reset_postdata();
	}
}
