$(function() {
	
	$('.maskPhone').mask('(99) 9999-9999');
});

function handleSuccessPeople(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
	
	mainRecordName = $('#peoplePeopleName').val();
	
	updateMainRecordName(mainRecordName, true);
}

function handleFailurePeople(content){
	
	handleFormFieldError(content, 'people');
}

function addQuickNewPlayer(peopleName, successHandlerFunc){
	
	var successFunc = function(content){

		var peopleId = content;
		successHandlerFunc(peopleId);
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		var errorMessage = parseMessage(content);

		alert('Não foi possível adicionar o novo jogador!\nPor favor, tente novamente.');
		
		if( isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/people/addQuickPlayer?peopleName='+peopleName;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}