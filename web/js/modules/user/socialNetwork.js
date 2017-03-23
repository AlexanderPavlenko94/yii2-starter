(function ($) {

    $('.buy').bind('click', function () {
        var button = $(this);
        $.ajax({
            type: 'GET',
            url: 'facebook',
            success: function (result) {
            },
            error: function() {
                alert('Something went wrong. Sorry :\'(');
            }
        });

        return false;
    });
})(jQuery);