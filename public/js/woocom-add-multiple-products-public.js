(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

})( jQuery );

jQuery("select.chzn-select").chosen({
    disable_search_threshold: 10
}).change(function(event){
    if(event.target == this){
        ids = jQuery(this).val();
    }
});
jQuery("#wamp_add_items_button").css({"margin": "10px 0px 10px 0px"});

jQuery(".wamp_add_order_item").click(function(){
    jQuery.ajax({
        url: WPURLS.ajaxurl,
        type:'POST',
        data:'action=woocom_amp_add_to_cart&ids='+ids,
        beforeSend: function() {
            jQuery('#wamp_add_items_button').attr('disabled', true);
            jQuery('#wamp_add_items_button').after('<img class="wamp_loading_img" style="padding-left: 10px;" src="'+WPURLS.siteurl+'img/loading.gif"><b class="wamp_loading_text">Please Wait...</b>');
        },
        success:function(results){
            location.reload();
        }
    });
});
