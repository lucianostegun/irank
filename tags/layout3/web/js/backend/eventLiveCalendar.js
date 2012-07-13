function updateEventDate(eventLive, allDay){
	
	var eventLiveId = eventLive.id;
	var eventDate   = dateFormat(eventLive.start, 'isoDate');
	
	var successFunc = function(content){

	};
		
	var failureFunc = function(t){

		var errorMessage = parseMessage(t.responseText);
		alert('Não foi possível atualizar a data do evento!'+errorMessage);
	};
	
	var urlAjax = _webRoot+'/eventLive/updateEventDate/eventLiveId/'+eventLiveId+'/eventDate/'+eventDate;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}