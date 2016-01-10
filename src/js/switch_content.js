/**
 * Created by Kevin on 10/01/2016.
 */

$(function () {

    var contentFlux = true;
    var contentBlog = false

    $(".switch_content").click(function() {
        if (contentFlux) {
            $("#content_blog").removeClass("hide");
            $("#content_flux").addClass("hide");

            contentFlux = false;
            contentBlog = true;
        } else {
            $("#content_blog").addClass("hide");
            $("#content_flux").removeClass("hide");

            contentFlux = true;
            contentBlog = false;
        }
    })


})