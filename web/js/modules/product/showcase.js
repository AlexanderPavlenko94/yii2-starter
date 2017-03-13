(function ($) {

    $('.buy').bind('click', function () {
        var button = $(this);
        $.ajax({
            type: 'POST',
            url: 'add',
            data:  {'id':$(this).attr("data-id")},
            success: function (result) {
                if (result['data'] == 1) {
                    button.attr('disabled', true);
                    $('.message-box').replaceWith('<div class="alert alert-success">Product added in your cart.</div>');
                    $(".alert-success").show('slow');
                    setTimeout(function() { $(".alert-success").hide('slow'); }, 2000);
                }
            },
            error: function() {
                alert('Something went wrong. Sorry :\'(');
            }
        });

        return false;
    });

    $('.delete').bind('click', function () {
        $.ajax({
            type: 'POST',
            url: 'delete',
            data:  {'id':$(this).attr("data-id")},
            success: function () {
                    location.reload();
            },
            error: function() {
                alert('Something went wrong. Sorry :\'(');
            }
        });

        return false;
    });
})(jQuery);