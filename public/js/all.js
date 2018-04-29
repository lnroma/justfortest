$(function () {
    $('#upload_file').on('submit', function (e) {
        e.preventDefault();
        var $that = $(this),
            formData = new FormData($that.get(0));
        $.ajax({
            url: $that.attr('action'),
            type: $that.attr('method'),
            contentType: false,
            processData: false,
            data: formData,
            dataType: 'json',
            success: function(json){
                if(json){
                    $that.replaceWith(json);
                }
            }
        });
    });
});
