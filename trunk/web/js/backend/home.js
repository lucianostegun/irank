function getCalendarData2(){
	
	var successFunc = function(content){

		var eventList = parseInfo(content);
//		$('.calendar').fullCalendar({events: eventList});
	};
		
	var failureFunc = function(t){

	};
	
	var urlAjax = _webRoot+'/club/getCalendar';
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function getCalendarData(){
	
	return eventList;
}

$(function() {
	
	//===== Calendar =====//
	
	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	
	var urlAjax = _webRoot+'/club/getCalendar';
	alert(urlAjax)
	$('.calendar').fullCalendar({
		header: {
			left: 'prev,next,today',
			center: 'title',
			right: 'month,basicWeek,basicDay'
		},
		editable: false,
		eventSources: [urlAjax]
	});
});