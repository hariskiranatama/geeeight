jQuery(function($){
    $(".livechat").live("click", function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        var link_text = $(this).text();
        window.open(url,
            'LiveChat '+link_text,
            'width=250,height=490,resizable=0,scrollbars=0,toolbar=0,location=0,directories=0,status=0,menubar=0,copyhistory=0,screenX=300,screenY=100');
    });
    //handle language
    $('#lang').bind('change', function(){
        $('#lang_form').submit();
    });
    //beautify form
    try {
        $("#lang").msDropDown();
    }
    catch(e) {}
    $(".tip").labelify({labelledClass: "labelinside"});
});
