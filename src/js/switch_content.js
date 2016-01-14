/**
 * Created by Kevin on 10/01/2016.
 */

$(function () {

    var contentFlux = true;
    var contentBlog = false

    $(".blog_btn").click(function() {
        if (!contentBlog) {
            $("#content_blog").removeClass("hide");
            $("#content_flux").addClass("hide");

            contentFlux = false;
            contentBlog = true;
        }
    })

    $(".actu_btn").click(function() {
        if (!contentFlux) {
            $("#content_blog").addClass("hide");
            $("#content_flux").removeClass("hide");

            contentFlux = true;
            contentBlog = false;
        }
    })

    $("#add_article").click(function () {
        if (!contentBlog) {
            $("#content_flux").addClass("hide");
            $("#content_blog").removeClass("hide");

            contentFlux = false;
            contentBlog = true;
        }
    });

})