<?php 
/**
 *vide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://rashedun.me
 * @since      2.0.0
 *
 * @package    Woocom_Add_Multiple_Products
 * @subpackage Woocom_Add_Multiple_Products/public/partials
 */
?>
<div id="wamp_form">
    <h4>
	    <?php
	    _e( 'Add Product(s)', 'woocom-add-multiple-products' )
	    ?>...
    </h4>
    <!-- multiple dropdown -->
    <select
	    id="wamp_select_box"
	    data-placeholder="<?php esc_attr_e( 'Choose a product...', 'woocom-add-multiple-products' )?>"
	    multiple class="wamp_products_select_box"
    >
      <optgroup label="<?php esc_attr_e( 'Choose products by SKU or Name....', 'woocom-add-multiple-products' )?>">
        <?php $this->get_products();?>
      </optgroup>
    </select>
    <button
	    id="wamp_add_items_button"
	    type="button"
	    class="button add_order_item wamp_add_order_item"
    >
	    <?php esc_html_e( 'Add Item(s)', 'woocom-add-multiple-products' )?>
    </button>
</div>