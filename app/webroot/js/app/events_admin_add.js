/*
 *
 */
jQuery(function($){
    var toggleDate = function(){
        if ( $("#EventType").val() === "event" ) {
            $("#EventDateMonth").parents(".date").show();
        }
        else {
            $("#EventDateMonth").parents(".date").hide();
        }
    };
    toggleDate();
    $("#EventType").bind('change', function(){
        toggleDate();
    });
});