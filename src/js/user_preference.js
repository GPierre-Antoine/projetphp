$(function () {
	var openP = false;
	var openU = false;

	$(".top_preference_btn").click(function(e) {
		if(!openP) {
            if(openU) {
                $("#user_information").addClass("hide");
                openU = !openU;
            }
			$("#user_preference").removeClass("hide");
			openP = !openP;
		}
		else if(openP) {
			$("#user_preference").addClass("hide");
			openP = !openP;
		}

		e.stopPropagation(); // This is the preferred method.
   		return false;
	});

	$(".top_user_btn").click(function(e) {
		if(!openU) {
            if(openP) {
                $("#user_preference").addClass("hide");
                openP = !openP;
            }
			$("#user_information").removeClass("hide");
			openU = !openU;
		}
		else if(openU) {
			$("#user_information").addClass("hide");
			openU = !openU;
		}
		e.stopPropagation(); // This is the preferred method.
    	return false;
	});

	$(document).click(function() {
        $('#user_preference').click(function(event){
            event.stopPropagation();
        });

        $('#user_information').click(function(event){
            event.stopPropagation();
        });

        if (openU) {
            $("#user_information").addClass("hide");
            openU = !openU;
        }
        if (openP) {
            $("#user_preference").addClass("hide");
            openP = !openP;
        }
    });

	$("#close_user_information").click(function() {
		if(openU) {
			$("#user_information").addClass("hide");
			openU = !openU;
		}
	})

	$("#close_user_preference").click(function() {
		if(openP) {
			$("#user_preference").addClass("hide");
			openP = !openP;
		}
	})
});