$(function () {
	var openP = false;
	var openU = false;

	$(".preference_btn").click(function(e) {
		if(!openP) { 
			$("#userPreference").removeClass("hide");
			$("#btnPref").addClass("btnClic");
			openP = !openP; 
		}
		else if(openP) {
			$("#userPreference").addClass("hide");
			$("#btnPref").removeClass("btnClic");
			openP = !openP;
		}
		e.stopPropagation(); // This is the preferred method.
   		return false; 
	});

	$("#btnUser").click(function(e) {
		if(!openU) { 
			$("#userInformation").removeClass("hide");
			$("#btnUser").addClass("btnClic");
			openU = !openU; 
		}
		else if(openU) {
			$("#userInformation").addClass("hide");
			$("#btnUser").removeClass("btnClic");
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