$(document).ready(function() 
{
	$(".open_btn").css("display", "none");
	$(".all_btn").css("background-color", "#2980b9"); // FIRST BUTTON IS ALL_BTN

	var isMenuOpen = true;
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
		$("#favorite_panel").removeClass("hide");
		$("#friend_panel").addClass("hide");

		$(".friend_btn").css("background-color", "#f39c12");
		$(".all_btn").css("background-color", "#f39c12");
		$(".favorite_btn").css("background-color", "#2980b9");
	});
});

