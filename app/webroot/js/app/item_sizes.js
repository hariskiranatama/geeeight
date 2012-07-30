/*
 *
 */
jQuery(function($){
    $("#ItemId").bind('change', function(){
        window.location = '/items/view/' + $("#ItemId").val();
    });
});