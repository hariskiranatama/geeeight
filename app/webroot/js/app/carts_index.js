/* 
 * Javascript enhancement in shopping cart page
 */

//Execute code after DOM loaded
jQuery(function($){
    //DOM loaded
    var form = $("#cartForm");
    $('.remove-cart-item').live('click', function(e){
        e.preventDefault();
        var data = $(this).metadata();
        if (confirm('Are you sure to remove these item from shopping cart?')) {
            $('#cartItemId').val(data.cartItemId);
            form.submit();
        }
    });
    $('#checkout').live('click', function(e){
        e.preventDefault();
        $("#isCheckout").val(1);
        form.submit();
    });
});
