function loadEventLiveCalendar(month, year, clubId, rankingLiveId){

	showIndicator();
	var successFunc = function(t){

		var content    = t.responseText;
		var moduleName = getModuleName();
		
		$(moduleName+'CalendarContent').innerHTML = content;
		
		hideIndicator();
	};
		
	var failureFunc = function(t){

		hideIndicator();
		
		var content = t.responseText;

		if( isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/eventLive/getCalendar/month/'+month+'/year/'+year+'?clubId='+clubId+'&rankingLiveId='+rankingLiveId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}