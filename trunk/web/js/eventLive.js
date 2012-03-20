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