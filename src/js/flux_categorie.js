/**
 * Created by Kevin on 12/01/2016.
 */

$(function() {
    var deletingSelected = false;

    function cancel_deleting() {
        if (deletingSelected) {
            $("#categorie_panel input").each(function () {
                $(this).addClass("hide");
            });

            $("#cancel_deleting_cat").addClass("hide");
            $("#validate_deleting_cat").addClass("hide");
            $("#removeCategorie").removeClass("hide");

            deletingSelected = false;
        }
    }

    $("#removeCategorie").click(function() {
        if (!deletingSelected) {
            $("#categorie_panel input").each(function () {
                $(this).removeClass("hide");
            });

            $("#cancel_deleting_cat").removeClass("hide");
            $("#validate_deleting_cat").removeClass("hide");
            $("#removeCategorie").addClass("hide");

            deletingSelected = true;
        }
    });

    $("#cancel_deleting_cat").click(function() {
        cancel_deleting();
    });

    $(".backflux_btn").click(function(e) {
        var targetPanel = $(this).parent();
        $(targetPanel).addClass("hide");
        $("#categorie_panel").removeClass("hide");
        $("#removeCategorie").removeClass("hide");
    });

    $(".categorie").click(function(e) {
        cancel_deleting();

        var targetPanel = "#"+$(this).attr("value")+"_panel";
        $(targetPanel).removeClass("hide");
        $("#categorie_panel").addClass("hide");
        $("#removeCategorie").addClass("hide");
    });
});