function handleSuccessRanking(content){

	setRecordSaved(true);
	clearFormFieldErrors('rankingForm');
	showFormStatusSuccess();
	hideIndicator('ranking');
	enableButton('mainSubmit');
}

function doSubmitRanking(content){

	showIndicator('ranking');
	disableButton('mainSubmit');
	$('rankingForm').onsubmit();
}

function handleSuccessRankingMember(content){

	clearFormFieldErrors('rankingMemberForm');
	showFormStatusSuccess('rankingMember');
	hideIndicator('rankingMember');
	enableButton('rankingMemberSubmit');
}

function doSubmitRankingMember(content){

	showIndicator('rankingMember');
	disableButton('rankingMemberSubmit');
	$('rankingMemberForm').onsubmit();
}

function addRankingMember(){
	
	clearFormFieldErrors('rankingMemberForm');
	hideFormStatusError('rankingMember');
	hideFormStatusSuccess('rankingMember');
	hideIndicator('rankingMember');
	enableButton('rankingMemberSubmit');
	windowRankingMemberAddShow();
	
	$('rankingMemberFirstName').focus();
}

function handleSuccessRankingMember(content){
	
	$('rankingMemberForm').reset();
	$('rankingMemberDiv').innerHTML = content;
	
	adjustContentTab();
	windowRankingMemberAddHide();
}

function deleteRankingMember(peopleId){
	
	showIndicator('rankingMemberList');
	
	var rankingId = $('rankingId').value;
	
	var successFunc = function(t){

		var content = t.responseText;
		
		$('rankingMemberDiv').innerHTML = content;
		
		hideIndicator('rankingMemberList');
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		alert('Não foi possível excluir o membro do grupo!\nTente novamente mais tarde.')
		hideIndicator('rankingMemberList');
	};
	
	var urlAjax = _webRoot+'/ranking/deleteMember/rankingId/'+rankingId+'/peopleId/'+peopleId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function onSelectTabTask(tabId){

	hideDiv('rankingMainButtonBar');
	hideDiv('rankingMemberButtonBar');
	
	switch( tabId ){
		case 'main':
			showDiv('rankingMainButtonBar');
			break;
		case 'member':
			showDiv('rankingMemberButtonBar');
			break;
	}
	
	return true;
}