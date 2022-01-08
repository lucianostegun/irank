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
					$('friendInviteStatus'+i+'Div').innerHTML = 'Convite enviado!';
					break;
				case 'error':
					hasErrors = true;
					$('friendInviteImage'+i+'Div').innerHTML = '<img src="/images/icon/nok.png"/>';
					$('friendInviteStatus'+i+'Div').innerHTML = 'Erro ao enviar convite!';
					break;
				default:
					$('friendInviteImage'+i+'Div').innerHTML = '<img src="/images/icon/info.png"/>';
					$('friendInviteStatus'+i+'Div').innerHTML = 'Já é usuário! ('+result+')';
			}
		}
	}
	
	if( hasErrors )
		alert('Alguns convites não puderam ser enviados!\nVerifique os e-mails com erro e tente novamente.');
	else
		alert('Todos os convites foram enviados com sucesso!\nClique em "Limpar formulário" para enviar o convite a outros amigos.');
	
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