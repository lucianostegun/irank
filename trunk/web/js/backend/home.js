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