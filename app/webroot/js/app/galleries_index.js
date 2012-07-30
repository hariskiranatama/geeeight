/* 
 * Handle page reload on album change
 */

//Execute code after DOM loaded
jQuery(function($){
    $("#album_id").live('change', function(){
        window.top.location.assign(page_url+parseInt($("#album_id").val(), 10));
    });
});
