$(document).ready(function() 
{
	$(".open_btn").css("display", "none");
	$(".all_btn").css("background-color", "#2980b9"); // FIRST BUTTON IS ALL_BTN

	var isMenuOpen = true;
	var deletingSelected = false

	// FUNCTION ABOUT DELETING CATEGORIE INTO MENU

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

	// FUNCTION ABOUT SWITCH INTO MENU

	function openMenu() {
		$("#menu").clearQueue().animate({
			left : '0'
		})
		$("#leftSmallMenu").clearQueue().animate({
			left : '25%'
		})
		$("#content").clearQueue().animate({
			left : '25%'
		})
		$(".article").clearQueue().animate({
			left : '-25%'
		})
	}

	function closeMenu() {
		$("#menu").clearQueue().animate({
			left : '-25%'
		})
		$("#leftSmallMenu").clearQueue().animate({
			left : '0'
		})
		$("#content").clearQueue().animate({
			left : '0'
		})
		$(".article").clearQueue().animate({
			left : '0'
		})
		cancel_deleting();
	}

	$('.open_btn').click(function()
	{
		if (isMenuOpen == false)
		{
			openMenu();
			$(this).fadeOut(1);
			$(".close_btn").fadeIn(1);
			isMenuOpen = true;
		} 
	});
	
	$('.close_btn').click(function()
	{
		if (isMenuOpen == true)
		{
			closeMenu();
			$(this).fadeOut(1);
			$(".open_btn").fadeIn(1);
			isMenuOpen = false;
		}
	});

	$('.all_btn').click(function()
	{
		if (isMenuOpen == false)
		{
			openMenu();
			$(".open_btn").fadeOut(1);
			$(".close_btn").fadeIn(1);
			isMenuOpen = true;
		}

		$("#removeCategorie").removeClass("hide");

		$("#friend_panel").addClass("hide");
		$("#favorite_panel").addClass("hide");
		$("#categorie_panel").removeClass("hide");

		$(".friend_btn").css("background-color", "#f39c12");
		$(".all_btn").css("background-color", "#2980b9");
		$(".favorite_btn").css("background-color", "#f39c12");
	});

	$('.friend_btn').click(function()
	{
		if (isMenuOpen == false)
		{
			openMenu();
			$(".open_btn").fadeOut(1);
			$(".close_btn").fadeIn(1);

			isMenuOpen = true;
		}

		$("#categorie_panel").addClass("hide");
		$("#favorite_panel").addClass("hide");
		$("#friend_panel").removeClass("hide");

		$(".friend_btn").css("background-color", "#2980b9");
		$(".all_btn").css("background-color", "#f39c12");
		$(".favorite_btn").css("background-color", "#f39c12");

		cancel_deleting();
		$("#removeCategorie").addClass("hide");
	});

	$('.favorite_btn').click(function()
	{
		if (isMenuOpen == false)
		{
			openMenu();
			$(".open_btn").fadeOut(1);
			$(".close_btn").fadeIn(1);
			isMenuOpen = true;
		}

		$("#categorie_panel").addClass("hide");
		$("#menu div.flux_Panel").each(function () {
			$(this).addClass("hide");
		});
		$("#favorite_panel").removeClass("hide");
		$("#friend_panel").addClass("hide");

		$(".friend_btn").css("background-color", "#f39c12");
		$(".all_btn").css("background-color", "#f39c12");
		$(".favorite_btn").css("background-color", "#2980b9");

		cancel_deleting();
		$("#removeCategorie").addClass("hide");
	});
});

