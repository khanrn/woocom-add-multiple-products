<div id="wamp_form">
    <h4><?php _e( 'Add Product(s)...', 'sodathemes' )?></h4>
    <!-- multiple dropdown -->
    <select id="wamp_select_box" data-placeholder="<?php _e( 'Choose a product...', 'sodathemes' )?>" multiple class="wamp_products_select_box">
		<optgroup label="<?php _e( 'Choose products by SKU or Name....', 'sodathemes' )?>">
			<?php 
				if (!empty($prod_cat_atts['prod_cat']))
					$this->get_shortcode_products( $prod_cat_atts );
				else
					$this->get_products();
			?>
		</optgroup>
    </select>
    <button id="wamp_add_items_button" type="button" class="button add_order_item wamp_add_order_item"><?php _e( 'Add Item(s)', 'sodathemes' )?></button>
</div>