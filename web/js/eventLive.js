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

function confirmEventLivePresence(eventLiveId){
	
	showIndicator();
	
	var successFunc = function(t){
		
		var infoObj = parseInfo(t.responseText);
		
		if( infoObj.result=='success' ){
			
			var players = infoObj.players;
			var label   = 'CONFIRMAR PRESENÇA';
			var icon    = '<img id="ConfirmButton'+eventLiveId+'Image" align="absmiddle" src="/images/button/ok.png" />';
			var color   = '#000000';
			
			switch(infoObj.currentStatus){
				case 'yes':
					label = 'PRESENÇA CONFIRMADA';
					icon  = '<img id="ConfirmButton'+eventLiveId+'Image" align="absmiddle" src="/images/button/reload.png" />';
					color = '#909090';
					break;
				case 'no':
					label = 'CONFIRMAR PRESENÇA';
					icon  = '<img id="ConfirmButton'+eventLiveId+'Image" align="absmiddle" src="/images/button/ok.png" />';
					color = '#000000';
					break;
			}
			
			$('eventLive'+eventLiveId+'ResumePlayers').innerHTML = players;
			
			$('buttonConfirmButton'+eventLiveId+'Label').innerHTML   = icon+label;
			$('buttonConfirmButton'+eventLiveId+'Label').style.color = color;
		}else{
			
			alert('FALHA NA CONFIRMAÇÃO!\n'+infoObj.errorMessage);
		}
		
		hideIndicator();
	}

	var failureFunc = function(t){
		
		hideIndicator();
		
		var errorMessage = parseError(t.responseText);
		errorMessage = (errorMessage?errorMessage:'\nPor favor, tente novamente.');
		
		if( errorMessage )
			alert(errorMessage);
	}
	
	var urlAjax = _webRoot+'/eventLive/togglePresence/eventLiveId/'+eventLiveId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});	
}