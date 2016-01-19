$(function () {
	var openU = false;

	$(".top_user_btn").click(function(e) {
		if(!openU) {
			$("#user_information").removeClass("hide");
			openU = !openU;
		} else {
			$("#user_information").addClass("hide");
			openU = !openU;
		}
		e.stopPropagation(); // This is the preferred method.
    	return false;
	});

	$(document).click(function() {
        $('#user_information').click(function(event){
            event.stopPropagation();
        });

        if (openU) {
            $("#user_information").addClass("hide");
            openU = !openU;
        }
    });

	$("#close_user_information").click(function() {
		if(openU) {
			$("#user_information").addClass("hide");
			openU = !openU;
		}
	})
});