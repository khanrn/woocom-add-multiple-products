
jQuery("select.chzn-select").chosen({

     disable_search_threshold: 10

}).change(function(event){

     if(event.target == this){
        ids = jQuery(this).val();
     }

});
jQuery("#wamp_add_items_button").css({"margin": "10px 0px 10px 0px"});