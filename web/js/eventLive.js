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
	
	if( element.hasClassName('loaded') )
		return;
	
	eventLiveId = (eventLiveId?eventLiveId:'');
	
	var tabId = element.id.replace('eventLive', '');
	
	element.addClassName('loaded');
	
	var completeFunc = function(t){
		
		Lightbox = new Lightbox();
	}

	var urlAjax = _webRoot+'/eventLive/getTabContent/tabId/'+tabId+'/eventLiveId/'+eventLiveId;
	new Ajax.Updater('eventLive'+tabId+'Content', urlAjax, {asynchronous:true, evalScripts:false, onComplete:completeFunc});
}

function confirmEventLivePresence(eventLiveId){
	
	if( $('buttonPresenceConfirm'+eventLiveId).hasClassName('buttonPresenceYes') )
		if( !confirm('Atenção!\n\nTem certeza que deseja cancelar sua confirmação de presença para este evento?') )
			return false;

	showIndicator();
	
	var successFunc = function(t){
		
		var infoObj = parseInfo(t.responseText);
		
		if( infoObj.result=='success' ){
			
			var players = infoObj.players;
			var label   = 'CONFIRMAR PRESENÇA';
			var icon    = '<img id="ConfirmButton'+eventLiveId+'Image" align="absmiddle" src="/images/button/ok.png" />';
			var color   = '#000000';
			var title   = '';
			
			switch(infoObj.currentStatus){
				case 'yes':
					label = 'PRESENÇA CONFIRMADA';
					icon  = '<img id="ConfirmButton'+eventLiveId+'Image" align="absmiddle" src="/images/button/reload.png" />';
					color = '#909090';
					title = 'Clique para cancelar sua confirmação de presença para o evento';
					break;
				case 'no':
					label = 'CONFIRMAR PRESENÇA';
					icon  = '<img id="ConfirmButton'+eventLiveId+'Image" align="absmiddle" src="/images/button/ok.png" />';
					color = '#000000';
					title = 'Clique para confirmar sua presença no evento';
					break;
			}
			
			$('eventLive'+eventLiveId+'ResumePlayers').innerHTML = players;
			
			$('buttonPresenceConfirm'+eventLiveId+'Label').innerHTML   = icon+label;
			$('buttonPresenceConfirm'+eventLiveId+'Label').style.color = color;
			$('buttonPresenceConfirm'+eventLiveId).title               = title;
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

function sortDataTable(sortField, sortDesc){

	showIndicator();
	
	var successFunc = function(t){
		
		hideIndicator();
		$('eventLiveTableContent').innerHTML = t.responseText;
	}

	var failureFunc = function(t){
		
		hideIndicator();
		
		alert('Não foi possível carregar as informações!\nPor favor, tente novamente.');
		if( isDebug() )
			debugAdd(t.responseText);
	}
	
	var urlAjax = _webRoot+'/eventLive/getTabContent/tabId/table/sortField/'+sortField+'/sortDesc/'+(sortDesc?'1':'0');
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}