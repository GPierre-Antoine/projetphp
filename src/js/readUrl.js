/**
 * Created by Kevin on 11/01/2016.
 */

$(function () {
    $("#imgSelection").on('input', function() {
        console.log($(this).val());
        $('#preview_img_blog').attr('src', $(this).val());
    });

    $("#F_cancel_btn").click(function() {
        $('#preview_img_blog').attr('src', '#');
    })

    $("#F_cancelSA_btn").click(function() {
        $('#preview_img_blog').attr('src', '#');
    })
})