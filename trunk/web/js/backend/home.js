$(function() {
	
	//===== Calendar =====//
	var urlAjax = _webRoot+'/club/getCalendar';
	
	$('.calendar').fullCalendar({
		header: {
			left: 'prev,next,today',
			center: 'title',
			right: 'month,basicWeek,basicDay'
		},
		editable: false,
		eventSources: [{url: urlAjax}]
	});
});