(function( $ ) {

	'use strict';

	$(function(){
		$('select#woocom_amp_product_cat, select#woocom_amp_user_role').select2({
			width: '300px',
			dropdownCssClass: 'bigdrop',
			minimumResultsForSearch: 7
		});

		// Enable and disable user checkbox.
		$('input[name=woocom_amp_user_check]').on('click', function(){
			var $this = $(this);
			var value = $this.val();
			if ( value != 1 ) {
				$('select#woocom_amp_user_role').attr('disabled', true);
			} else {
				$('select#woocom_amp_user_role').attr('disabled', false);
			}
		});
	});

})(jQuery);