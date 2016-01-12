/**
 * Created by Kevin on 12/01/2016.
 */

$(function() {
    var deletingSelected = false

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
        if (deletingSelected) {
            $("#categorie_panel input").each(function () {
                $(this).addClass("hide");
            });

            $("#cancel_deleting_cat").addClass("hide");
            $("#validate_deleting_cat").addClass("hide");
            $("#removeCategorie").removeClass("hide");

            deletingSelected = false;
        }
    });
});