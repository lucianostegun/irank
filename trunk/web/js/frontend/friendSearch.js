function doSubmitFriendInvite(){

	showIndicator('friendInvite');
	disableButton('mainSubmit');
	$('friendInviteForm').onsubmit();
}

function doSearchFriends(){
	
	var form = $('friendSearchForm');
	if( isIE() ){
		
		$('isIE').value = true;
		form.submit()
		return false;
	}

	var successFunc = function(t){

		var content = t.responseText;
		$('friendSearchContent').innerHTML = content;
		setButtonLabel('friendFilterSubmit', 'Procurar amigos');
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		setButtonLabel('friendFilterSubmit', 'Procurar amigos');
		
		var errorMessage = parseMessage(content);
		alert('Ocorreu um erro ao realizar a pesquisa.'+(errorMessage?'\n'+errorMessage:''));
		
		if( !errorMessage && isDebug() )
			debug(content);
	};
	
	setButtonLabel('friendFilterSubmit', 'Procurando amigos', 'ajaxLoader.gif');

	var urlAjax = _webRoot+'/friendSearch/search';
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc, parameters:Form.serialize(form)});
}

function showInviteForm(){
	
	hideDiv('searchDiv');
	showDiv('inviteFormDiv');
	hideDiv('friendSearchButtonBar');
}