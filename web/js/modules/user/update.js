(function ($) {
    $('#userForm').on('beforeSubmit', function (e) {
        $('#avatar-field').val($('#user-picture').attr('src'));
        return true;
    });
    $('#deleteAvatar').on('click', function(){
        $('#user-picture').attr('src', '/img/no_image.png');
    });
})(jQuery);