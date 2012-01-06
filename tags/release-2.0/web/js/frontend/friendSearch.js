function doSubmitFriendInvite(){

	showIndicator('friendInvite');
	disableButton('mainSubmit');
	$('friendInviteForm').onsubmit();
}

function doSearchFriends(){
	
	var form = $('friendSearchForm');
	form.submit()
}