var pollAnswered = false;

function selectPollResponse(pollId, pollAnswerId){

	if( pollAnswered )
		return;
		
	showIndicator();
		
	var successFunc = function(t){

		var content = parseInfo(t.responseText);
		$('pollAnswer-'+pollAnswerId).addClassName('strong');
		pollAnswered = true;
		hideIndicator();
	};
		
	var failureFunc = function(t){

		var content = t.responseText;
		hideIndicator();
	};
	
	var urlAjax = _webRoot+'/home/savePollAnswer/pollId/'+pollId+'/pollAnswerId/'+pollAnswerId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}