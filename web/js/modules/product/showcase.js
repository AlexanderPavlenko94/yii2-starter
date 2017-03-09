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
                    location.reload();
                    console.log(result['products']);
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