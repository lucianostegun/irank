function showEventLiveTab(element){

	var divId = element.id;
	
	var currentContentDiv = document.getElementsByClassName('eventLiveTabContent active')[0];
	var currentActiveTab  = document.getElementsByClassName('eventLiveTab active')[0];

	if( currentContentDiv.id==divId )
		return false;

	currentContentDiv.removeClassName('active');
	currentActiveTab.removeClassName('active');

	element.addClassName('active');
	$(divId+'Content').addClassName('active');
}

function loadEventLiveTab(element, eventLiveId){
	
	if((/ loaded/).test(element.className) )
		return;
	
	var tabId = element.id.replace('eventLive', '');
	
	element.addClassName('loaded');
	
	var completeFunc = function(t){
		
		Lightbox = new Lightbox();
	}
	
	var urlAjax = _webRoot+'/eventLive/getTabContent/tabId/'+tabId+'/eventLiveId/'+eventLiveId
	new Ajax.Updater('eventLive'+tabId+'Content', urlAjax, {asynchronous:true, evalScripts:false, onComplete:completeFunc});
}