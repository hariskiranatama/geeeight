/*
 *
 */
jQuery(function($){
    $("#InfoPageId").bind('change', function(){
        window.location = '/admin/info_pages/edit/' + $("#InfoPageId").val();
    });
});