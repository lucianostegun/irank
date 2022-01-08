function handleSuccessFriendInvite(content){

	clearFormFieldErrors('friendInviteForm');
	enableButton('mainSubmit');
	
	var info = content.split('<info>');
	
	var hasErrors = false;
	for(var i=1; i <= 10; i++){
		
		var result = info[i-1];
		
		if( result=='' ){
		
			hideDiv('friendInviteImage'+i+'Div');
			hideDiv('friendInviteStatus'+i+'Div');
		}else{
			
			showDiv('friendInviteImage'+i+'Div');
			showDiv('friendInviteStatus'+i+'Div');
		
			switch( result ){
				case 'ok':
					$('friendInviteImage'+i+'Div').innerHTML = '<img src="/images/icon/ok.png"/>';
					$('friendInviteStatus'+i+'Div').innerHTML = i18n_friendInvite_status_inviteSent;
					break;
				case 'error':
					hasErrors = true;
					$('friendInviteImage'+i+'Div').innerHTML = '<img src="/images/icon/nok.png"/>';
					$('friendInviteStatus'+i+'Div').innerHTML = i18n_friendInvite_status_inviteError;
					break;
				default:
					$('friendInviteImage'+i+'Div').innerHTML = '<img src="/images/icon/info.png"/>';
					$('friendInviteStatus'+i+'Div').innerHTML = i18n_friendInvite_status_alreadyUser+' ('+result+')';
			}
		}
	}
	
	if( hasErrors )
		alert(i18n_friendInvite_warningMessage);
	else
		alert(i18n_friendInvite_successMessage);
	
	hideIndicator('friendInvite');
}

function doSubmitFriendInvite(){

	showIndicator('friendInvite');
	disableButton('mainSubmit');
	$('friendInviteForm').onsubmit();
}

function resetFriendInviteForm(){
	
	for(var i=1; i <= 10; i++){
		
		hideDiv('friendInviteImage'+i+'Div');
		hideDiv('friendInviteStatus'+i+'Div');
		
		$('friendInviteFriendName'+i).value   = '';
		$('friendInviteEmailAddress'+i).value = '';
	}
}