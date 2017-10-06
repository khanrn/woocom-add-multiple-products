jQuery(".wamp_add_order_item").click(function(){
    jQuery.ajax({
        url: WpAjax.ajaxurl,
        type:'POST',
        data:'action=wamp_add_to_cart&ids='+ids,
        beforeSend: function() {
            jQuery('#wamp_add_items_button').attr('disabled', true);
            jQuery('#wamp_add_items_button').after('<img class="wamp_loading_img" style="padding-left: 10px;" src="'+WPURLS.siteurl+'/img/loading.gif"><b class="wamp_loading_text">Please Wait...</b>');
        },
        success:function(results){
            location.reload();
        }
    });
});