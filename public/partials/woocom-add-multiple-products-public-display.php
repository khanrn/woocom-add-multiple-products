<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://sodathemes.com
 * @since      1.0.0
 *
 * @package    Woocom_Add_Multiple_Products
 * @subpackage Woocom_Add_Multiple_Products/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div id="wamp_form">
    <h4><?php _e( 'Add Product(s)...', 'sodathemes' )?></h4>
    <!-- multiple dropdown -->
    <select id="wamp_select_box" data-placeholder="<?php _e( 'Choose a product...', 'sodathemes' )?>" multiple class="chzn-select">
		<optgroup label="<?php _e( 'Choose Products by SKU or Name....', 'sodathemes' )?>">
			<?php $this->woocom_amp_get_products();?>
		</optgroup>
    </select>
    <button id="wamp_add_items_button" type="button" class="button add_order_item wamp_add_order_item"><?php _e( 'Add Item(s)', 'sodathemes' )?></button>
</div>