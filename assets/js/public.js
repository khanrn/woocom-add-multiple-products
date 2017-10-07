(function( $ ){

	'use strict';

	$(function(){

		$('select.wamp_products_select_box').select2({
			dropdownCssClass: 'bigdrop',
			minimumResultsForSearch: 7
		});

	});

	$('.wamp_add_order_item').on('click', function(){

		var ids = $(this).parent().find('#wamp_select_box').val();

		$.ajax({
			url: WPURLS.ajaxurl,
			type:'POST',
			data:{ action: 'woocom_amp_add_to_cart', ids: ids },
			dataType: 'json',
			beforeSend: function() {
				$('#wamp_add_items_button').attr('disabled', true);
				$('#wamp_add_items_button').after('<img class="wamp_loading_img" style="padding-left: 10px;" src="' + WPURLS.siteurl + 'img/loading.gif"><b class="wamp_loading_text">Please Wait...</b>');
			},
			success:function(results){
				location.reload();
			}
		});
	});

})(jQuery)