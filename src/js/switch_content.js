/**
 * Created by Kevin on 10/01/2016.
 */

$(function () {

    var contentFlux = true;
    var contentBlog = false

    $(".switch_content").click(function() {
        $("#content_blog").removeClass("hide");
        $("#content_flux").addClass("hide");

        contentFlux = false;
        contentBlog = true;
    })


})