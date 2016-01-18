$(function() {

	function closePopUp($overlay,$popup) {
		$($overlay).fadeOut(200);
		$($popup).css("display", "none");
	}

	$(".addF_btn").click(function () {
		$("#overlay_flux").css({"display":"block", opacity:0});
		$("#overlay_flux").fadeTo(200,0.5);
		$("#popup_flux").fadeTo(200,1);
	});

	$(".write_btn").click(function () {
		$("#overlay_blog").css({"display":"block", opacity:0});
		$("#overlay_blog").fadeTo(200,0.5);
		$("#popup_blog").fadeTo(200,1);
	});

	$("#add_categorie").click(function () {
		closePopUp("#overlay_flux",".popup_flux");
	})

	$("#add_article").click(function () {
		closePopUp("#overlay_blog",".popup_blog");
	});

	$("#end").click(function() {
		closePopUp("#overlay_flux",".popup_flux");
		$(".pop_add_flux").addClass("hide");
		$(".pop_add_categorie").addClass("hide");
	});

	$("#begin").click(function() {
		var impSelect = $("#selector :selected").val();
		console.log(impSelect);
		if (impSelect == "pop_add_categorie") {
			$(".pop_add_flux").addClass("hide");
			$(".pop_add_friend").addClass("hide");
			$(".pop_add_mail").addClass("hide");
			$(".pop_add_categorie").removeClass("hide");
		} else if (impSelect == "pop_add_flux") {
			$(".pop_add_categorie").addClass("hide");
			$(".pop_add_friend").addClass("hide");
			$(".pop_add_mail").addClass("hide");
			$(".pop_add_flux").removeClass("hide");
		} else if (impSelect == "pop_add_friend") {
			$(".pop_add_categorie").addClass("hide");
			$(".pop_add_flux").addClass("hide");
			$(".pop_add_mail").addClass("hide");
			$(".pop_add_friend").removeClass("hide");
		} else if (impSelect == "pop_add_mail") {
			$(".pop_add_categorie").addClass("hide");
			$(".pop_add_flux").addClass("hide");
			$(".pop_add_friend").addClass("hide");
			$(".pop_add_mail").removeClass("hide");
		}
	});

});