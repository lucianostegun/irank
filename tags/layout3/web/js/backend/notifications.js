$(function() {
	
	//===== Notification boxes =====//
	
	$(".hideit").click(function() {
		$(this).fadeTo(200, 0.00, function(){ //fade
			$(this).slideUp(300, function() { //slide up
				$(this).hide(); //then remove from the DOM
			});
		});
	});
	
});