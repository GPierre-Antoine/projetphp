/**
 * Created by Kevin on 10/01/2016.
 */

$(function () {

    var contentFlux = true;
    var contentBlog = false;
    var contentMail = false;
    var contentFriendBlog = false;

    $(".blog_btn").click(function() {
        if (!contentBlog) {
            $("#content_mail").addClass("hide");
            $("#content_friend_blog").addClass("hide");
            $("#content_flux").addClass("hide");
            $("#content_blog").removeClass("hide");

            contentBlog = true;
            contentFlux = false;
            contentMail = false;
            contentFriendBlog = false;
        }
    })

    $(".blog_friend_btn").click(function() {
        if (!contentFriendBlog) {
            $("#content_mail").addClass("hide");
            $("#content_flux").addClass("hide");
            $("#content_blog").addClass("hide");
            $("#content_friend_blog").removeClass("hide");

            contentFriendBlog = true;
            contentBlog = false;
            contentFlux = false;
            contentMail = false;
        }
    })

    $(".actu_btn").click(function() {
        if (!contentFlux) {
            $("#content_blog").addClass("hide");
            $("#content_friend_blog").addClass("hide");
            $("#content_mail").addClass("hide");
            $("#content_flux").removeClass("hide");

            contentFlux = true;
            contentBlog = false;
            contentMail = false;
            contentFriendBlog = false;
        }
    })

    $(".mail_btn").click(function() {
        if (!contentMail) {
            $("#content_blog").addClass("hide");
            $("#content_friend_blog").addClass("hide");
            $("#content_flux").addClass("hide");
            $("#content_mail").removeClass("hide");

            contentMail = true;
            contentFlux = false;
            contentBlog = false;
            contentFriendBlog = false;
        }
    })

    $("#add_article").click(function () {
        if (!contentBlog) {
            $("#content_flux").addClass("hide");
            $("#content_friend_blog").addClass("hide");
            $("#content_mail").addClass("hide");
            $("#content_blog").removeClass("hide");

            contentBlog = true;
            contentFlux = false;
            contentMail = false;
            contentFriendBlog = false;
        }
    });

})