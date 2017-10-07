<div id="wamp_form">
	<?php if ( empty( $title ) ): ?>
		<h4><?php _e( 'Add Product(s)', 'woocom-add-multiple-products' ); ?>...</h4>
	<?php else: ?>
		<?php echo $args['before_title'] . esc_html( $title ) . $args['after_title']; ?>
	<?php endif; ?>
    <!-- multiple dropdown -->
    <select
	    id="wamp_select_box"
	    data-placeholder="<?php esc_html_e(
	    	'Choose a product...',
		    'woocom-add-multiple-products' )?>"
	    multiple class="wamp_products_select_box">
		<optgroup label="<?php esc_html_e(
			'Choose products by SKU or Name....',
			'woocom-add-multiple-products' )?>">
			<?php $this->get_products(); ?>
		</optgroup>
    </select>
    <button
		id="wamp_add_items_button"
		type="button"
		class="button add_order_item wamp_add_order_item">
		<?php esc_html_e(
			'Add Item(s)',
			'woocom-add-multiple-products'
	    )?>
    </button>
</div>