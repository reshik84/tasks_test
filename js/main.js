$(function(){
    $('.preview').on('click', function(){
        $('.username_preview').text($('.username_input').val());
        $('.email_preview').text($('.email_input').val());
        $('.task_preview').text($('.task_input').val());
        readURL(document.getElementsByClassName('image_input')[0]);
        $('.modal').modal('show');
    });

});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('.image_preview').css('background-image', 'url('+e.target.result+')');
            //$('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}