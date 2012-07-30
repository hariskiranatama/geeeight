/*
 *
 */
jQuery(function($){
    // initialize scrollable together with the navigator plugin
    $("#browsable").scrollable().navigator();
    //Larger thumbnail preview
    $("ul.thumb li").live('mouseover mouseout', function(event) {
        var li = $(event.target).closest('li');
        if (event.type == 'mouseover') {
            li.css({'z-index' : '10'});
            li.find('.gallery').addClass("hover").stop();
        }
        else {
            li.css({'z-index' : '0'});
            li.find('.gallery').removeClass("hover").stop();
        }
    });
    $("ul.thumb li .gallery").live('mouseover mouseout', function(event) {
        var li = $(event.target).closest('.gallery');
        if (event.type == 'mouseover') {
            li.css({'z-index' : '10'});
            li.find('img').addClass("hover").stop();
        }
        else {
            li.css({'z-index' : '0'});
            li.find('img').removeClass("hover").stop();
        }
    });
    //set initial data
    $("#browsable").data("more_page", true);
    //handle loading next page
    var api = $("#browsable").data("scrollable");
    var stillSeeking = false;
    api.onSeek(function() {
        // inside callbacks the "this" variable is a reference to the API
        var total_page = parseInt(this.getSize(), 10);
        var current_page = parseInt(this.getIndex()+1, 10);
        var next_page = parseInt(current_page+1, 10);
        //check if in last page, more page is still true, and lock is false
        if ( current_page === total_page && $("#browsable").data("more_page") && ! stillSeeking ) {
            //put loading indicator
            $(".nav-button .loading").removeClass("disabled");
            //simple lock
            stillSeeking = true;
            //do ajax request
            $.get(this_page_url, {
                'page': next_page
            }, function(resp){
                //remove indicator
                $(".nav-button .loading").addClass("disabled");
                //remove lock
                stillSeeking = false;
                try {
                    var r = $.parseJSON(resp);
                    if (r.noMorePage) {
                        //prevent load next page when reach end of page
                        $("#browsable").data("more_page", false);
                    }
                }
                catch(e) {
                    if ( resp ) {
                        api.addItem(resp);
                        $(".nav-button .next").removeClass("disabled");
                    }
                }
            });
        }
    });
    //if url contain page, go to the page
    if ( 1 < page_from_url && page_from_url <= parseInt(api.getSize(), 10) ) {
        api.seekTo((page_from_url - 1));
    }
});