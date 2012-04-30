function showRankingLiveTab(element){

	var divId = element.id;
	
	var currentContentDiv = document.getElementsByClassName('rankingLiveTabContent active')[0];
	var currentActiveTab  = document.getElementsByClassName('rankingLiveTab active')[0];

	if( currentContentDiv.id==divId )
		return false;

	currentContentDiv.removeClassName('active');
	currentActiveTab.removeClassName('active');

	element.addClassName('active');
	$(divId+'Content').addClassName('active');
}

function loadRankingLiveTab(element, rankingLiveId, parameters, force){
	
	if((/ loaded/).test(element.className) && !force )
		return;
	
	var tabId = element.id.replace('rankingLive', '');
	
	element.addClassName('loaded');
	
	var completeFunc = function(t){
		
		Lightbox = new Lightbox();
	}
	
	var urlAjax = _webRoot+'/rankingLive/getTabContent/tabId/'+tabId+'?rankingLiveId='+rankingLiveId
	
	if( parameters ){
		
		for(parameter in parameters)
			urlAjax += '&'+parameter+'='+parameters[parameter];
	}
	
	new Ajax.Updater('rankingLive'+tabId+'Content', urlAjax, {asynchronous:true, evalScripts:false, onComplete:completeFunc});
}

function loadRankingHistory(rankingLiveId, rankingDate){

	$('rankingLiveClassifyContent').innerHTML = getTabLoader();
	loadRankingLiveTab($('rankingLiveClassify'), rankingLiveId, {rankingDate: rankingDate}, true);
}