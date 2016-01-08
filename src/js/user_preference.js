$(function () {
	var openP = false;
	var openU = false;

	$(".preference_btn").click(function(e) {
		if(!openP) {
            if(openU) {
                $("#userInformation").addClass("hide");
                openU = !openU;
            }
			$("#userPreference").removeClass("hide");
			openP = !openP;
		}
		else if(openP) {
			$("#userPreference").addClass("hide");
			openP = !openP;
		}

		e.stopPropagation(); // This is the preferred method.
   		return false;
	});

	$("#btnUser").click(function(e) {
		if(!openU) {
            if(openP) {
                $("#userPreference").addClass("hide");
                openP = !openP;
            }
			$("#userInformation").removeClass("hide");
			openU = !openU;
		}
		else if(openU) {
			$("#userInformation").addClass("hide");
			openU = !openU;
		}
		e.stopPropagation(); // This is the preferred method.
    	return false;
	});

	$(document).click(function() {
        if (openU) {
            $("#userInformation").addClass("hide");
            openU = !openU;
        }
        if (openP) {
            $("#userPreference").addClass("hide");
            openP = !openP;
        }
    });
});