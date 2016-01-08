$(function () {
	$(".backflux_btn").click(function(e) {
		var targetPanel = $(this).parent();
		$(targetPanel).addClass("hide");
		$("#categorie_panel").removeClass("hide");
		;
	});

	$(".categorie").click(function(e) {
		var targetPanel = "#"+$(this).attr("value")+"_panel";
		$(targetPanel).removeClass("hide");
		$("#categorie_panel").addClass("hide");
		;
	});
});