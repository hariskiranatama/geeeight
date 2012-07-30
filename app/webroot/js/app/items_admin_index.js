/*
 *
 */
jQuery(function($){
    $("#ItemLimit").bind('change', function(){
        //$("#ItemAdminIndexForm").submit();
    });
});

$(document).ready(function(){
	var url = window.location.href;
	var arr = url.split('?');
	if(arr.length>1){
		isSearch = arr[1].split("=")
		if(jQuery.inArray("search",isSearch)=="0"){
			$(".page-number").each(function(){
				var href2 = $(this).attr("href")+"?"+arr[1];
				$(this).attr("href",href2);
			});
		}
	}
});