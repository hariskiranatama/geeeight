/*
 *
 */
jQuery(function($){
    $("#ItemId").bind('change', function(){
        window.location = '/items/view/' + $("#ItemId").val();
    });
    //Larger thumbnail preview
    $("ul.bahan li").hover(function() {
        $(this).css({'z-index' : '10'});
        $(this).find('img').addClass("hover").stop();
    } , function() {
        $(this).css({'z-index' : '0'});
        $(this).find('img').removeClass("hover").stop();
    });
    //Swap Image on Click
    $(".gambar ul li a").click(function() {
        var mainImage = $(this).attr("href"); //Find Image Name
        $(".main-image img").attr({ src: mainImage });
        return false;
    });
});