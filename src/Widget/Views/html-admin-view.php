<div class="woocom-amp-widget">
	<label><?php _e( 'Title', 'woocom-add-multiple-products' ); ?>:</label>
	<input
		type="text"
		id="<?php esc_attr_e( $this->get_field_id( 'woocom-amp-title' ) ); ?>"
		class="widefat"
		name="<?php esc_attr_e( $this->get_field_name( 'woocom-amp-title' ) ); ?>"
		value="<?php esc_attr_e( $instance['woocom-amp-title'] ); ?>"
	>
</div>