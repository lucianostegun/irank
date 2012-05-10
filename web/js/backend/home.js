$(function() {
	
	//===== Calendar =====//
	var urlAjax = _webRoot+'/club/getCalendar';
	
	$('.calendar').fullCalendar({
		header: {
			left: 'prev,next,today',
			center: 'title',
			right: 'month,basicWeek,basicDay'
		},
		editable: true,
		eventSources: [{url: urlAjax}],
		eventRender: function(event, element) {
	        
			if(!event.draggable)
	        	element.draggable = function(){};
		},
		droppable: true,
	    eventDrop: function(eventLive, allDay){
			
			updateEventDate(eventLive, allDay)
		},
	});
});

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