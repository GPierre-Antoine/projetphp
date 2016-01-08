$(function () {
	var register = true; 
	
	$("#signIndex .buttonIndex").click(function() {
		$("#signIndex .buttonIndex").removeClass('selected');
		$(this).addClass('selected');
	});

	$("#login").click(function() {
		if(register) { $("#formLogin").removeClass("hide"); 
		$("#formRegister").addClass("hide");
		register = !register; }  
	}); 

	$("#register").click(function() {
		if(!register) { $("#formLogin").addClass("hide");
		$("#formRegister").removeClass("hide");
		register = !register; } 
	}); 
});