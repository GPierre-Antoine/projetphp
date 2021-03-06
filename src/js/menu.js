$(document).ready(function() 
{
	$(".open_btn").css("display", "none");
	$(".all_btn").css("background-color", "#2980b9");
	$("#leftSmallMenu .actu_btn").css("background-color", "#2980b9");

	var isMenuOpen = true;
	var deletingSelected = false;

	$(".backflux_btn").click(function(e) {
		var targetPanel = $(this).parent();
		$(targetPanel).addClass("hide");
		$("#categorie_panel").removeClass("hide");
	});

	$(".categorie").click(function(e) {
		var targetPanel = "#"+$(this).attr("value")+"_panel";
		$(targetPanel).removeClass("hide");
		$("#categorie_panel").addClass("hide");
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
		$(".display").clearQueue().animate({
			left : '-25%'
		})
		$(".twitter-tweet").clearQueue().animate({
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
		$(".display").clearQueue().animate({
			left : '0'
		})
		$(".twitter-tweet").clearQueue().animate({
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

	$('.perso_btn').click(function()
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

		$(".perso_btn").css("background-color", "#2980b9");
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
		$("#menu div.flux_Panel").each(function () {
			$(this).addClass("hide");
		});
		$("#favorite_panel").removeClass("hide");
		$("#friend_panel").addClass("hide");

		$(".friend_btn").css("background-color", "#f39c12");
		$(".all_btn").css("background-color", "#f39c12");
		$(".favorite_btn").css("background-color", "#2980b9");
	});


	$('.actu_btn').click(function () {
		$("#leftSmallMenu .actu_btn").css("background-color", "#2980b9");
		$("#leftSmallMenu .blog_btn").css("background-color", "#f39c12");
		$("#leftSmallMenu .mail_btn").css("background-color", "#f39c12");
        $("#leftSmallMenu .blog_friend_btn").css("background-color", "#f39c12");
        $("#leftSmallMenu .twitter_btn").css("background-color", "#f39c12");
		$("#leftSmallMenu .perso_btn").css("background-color", "#f39c12");
	})

	$('.blog_btn').click(function () {
		$("#leftSmallMenu .blog_btn").css("background-color", "#2980b9");
		$("#leftSmallMenu .mail_btn").css("background-color", "#f39c12");
		$("#leftSmallMenu .actu_btn").css("background-color", "#f39c12");
		$("#leftSmallMenu .blog_friend_btn").css("background-color", "#f39c12");
        $("#leftSmallMenu .twitter_btn").css("background-color", "#f39c12");
		$("#leftSmallMenu .perso_btn").css("background-color", "#f39c12");
	})

	$('.mail_btn').click(function () {
		$("#leftSmallMenu .mail_btn").css("background-color", "#2980b9");
		$("#leftSmallMenu .blog_btn").css("background-color", "#f39c12");
		$("#leftSmallMenu .actu_btn").css("background-color", "#f39c12");
		$("#leftSmallMenu .blog_friend_btn").css("background-color", "#f39c12");
        $("#leftSmallMenu .twitter_btn").css("background-color", "#f39c12");
		$("#leftSmallMenu .perso_btn").css("background-color", "#f39c12");
	})

	$('.blog_friend_btn').click(function () {
		$("#leftSmallMenu .blog_friend_btn").css("background-color", "#2980b9");
		$("#leftSmallMenu .mail_btn").css("background-color", "#f39c12");
		$("#leftSmallMenu .blog_btn").css("background-color", "#f39c12");
		$("#leftSmallMenu .actu_btn").css("background-color", "#f39c12");
        $("#leftSmallMenu .twitter_btn").css("background-color", "#f39c12");
		$("#leftSmallMenu .perso_btn").css("background-color", "#f39c12");
	})

    $('.twitter_btn').click(function () {
        $("#leftSmallMenu .twitter_btn").css("background-color", "#2980b9");
        $("#leftSmallMenu .mail_btn").css("background-color", "#f39c12");
        $("#leftSmallMenu .blog_btn").css("background-color", "#f39c12");
        $("#leftSmallMenu .actu_btn").css("background-color", "#f39c12");
        $("#leftSmallMenu .blog_friend_btn").css("background-color", "#f39c12");
		$("#leftSmallMenu .perso_btn").css("background-color", "#f39c12");
    })

	$('.perso_btn').click(function () {
		$("#leftSmallMenu .perso_btn").css("background-color", "#2980b9");
		$("#leftSmallMenu .mail_btn").css("background-color", "#f39c12");
		$("#leftSmallMenu .blog_btn").css("background-color", "#f39c12");
		$("#leftSmallMenu .actu_btn").css("background-color", "#f39c12");
		$("#leftSmallMenu .blog_friend_btn").css("background-color", "#f39c12");
		$("#leftSmallMenu .twitter_btn").css("background-color", "#f39c12");
	})
});

