(function ($) {
    $('#productForm').on('beforeSubmit', function (e) {
        $('#picture-field').val($('#product-picture').attr('src'));
        return true;
    });
    $('#deletePicture').on('click', function(){
        $('#product-picture').attr('src', '/img/no_image.png');
    });
})(jQuery);