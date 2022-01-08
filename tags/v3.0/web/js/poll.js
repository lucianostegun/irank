var pollAnswered = false;

function selectPollResponse(pollId, pollAnswerId){

	if( pollAnswered )
		return;
	
	pollAnswered = true;
	
	showIndicator();

	var successFunc = function(t){

		var content = t.responseText;
		
		$('pollAnswerOptionsDiv').innerHTML = content;
		
		hideIndicator();
	};

	var failureFunc = function(t){

		var content = t.responseText;
		hideIndicator();
	};

	var urlAjax = _webRoot+'/home/savePollAnswer/pollId/'+pollId+'/pollAnswerId/'+pollAnswerId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}