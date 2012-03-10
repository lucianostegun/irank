var _currentResumeEventsOffset = 0;
var _isLoadingEventResume      = false;
var _eventResumeCalendarDate   = null;

function showOptionBar(side){

	showDiv('optionBar'+ucfirst(side));
}

function hideOptionBar(side){

	hideDiv('optionBar'+ucfirst(side));
}

function loadEvent(eventId){
	
	window.location = _webRoot+'/event/edit/eventId/'+eventId;
}

function loadMoreEvents(loadByDate){
	
	var incraseAmount = 4;

	if( _isLoadingEventResume )
		return;
	
	_isLoadingEventResume = true;
	
	if( !loadByDate )
		_currentResumeEventsOffset += incraseAmount;

	var successFunc = function(t){

		var content = t.responseText;
		
		var previousContainerDiv = 'eventListOffset'+(_currentResumeEventsOffset-incraseAmount);
		var currentContainerDiv  = 'eventListOffset'+_currentResumeEventsOffset;
		
		hideDiv('eventResumeLoader');
			
		if( loadByDate ){
			
			$(currentContainerDiv).innerHTML = content;
			_isLoadingEventResume = false
		}else{

			var divObj = document.createElement('div');
			divObj.id        = currentContainerDiv;
			divObj.innerHTML = content;
			
			$('eventResumeList').appendChild(divObj);
			
			var afterFinishFunc = function(){
				
				$('eventResumeList').removeChild($(previousContainerDiv));
				$(currentContainerDiv).style.top = '0px';
				_isLoadingEventResume = false;
			}
			
			new Effect.Move(previousContainerDiv, { x: 0, y: -260, mode: 'absolute' });
			new Effect.Move(currentContainerDiv, { x: 0, y: -260, mode: 'absolute', afterFinish:afterFinishFunc });
		}
	};
		
	var failureFunc = function(t){

		hideDiv('eventResumeLoader');
		
		alert('Não foi possível carregar a lista de eventos!\nPor favor, tente novamente.');
		
		_isLoadingEventResume = false;
		
		if( isDebug() )
			debugAdd(t.responseText);
	};
	
	var urlAjax = _webRoot+'/home/getEventResume?offset='+_currentResumeEventsOffset;
	urlAjax    += (_eventResumeCalendarDate?'&eventDate='+_eventResumeCalendarDate:'');

	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function getCalendarDetails(dayId, eventDate){
	
	resetEventResume();
	_currentResumeEventsOffset = 0;	
	_eventResumeCalendarDate   = eventDate;
	
	showDiv('eventResumeLoader');
	
	loadMoreEvents(true);
}

function resetEventResume(){
	
	var currentContainerDiv = 'eventListOffset'+_currentResumeEventsOffset;
	
	$(currentContainerDiv).id = 'eventListOffset0';
}

function toggleMyPresence(eventId, choice){
	
	var successFunc = function(t){

		$('presenceToggler'+eventId).className = 'presence '+choice;
		
		var link = '';
		
		if( choice=='yes' )
			link = '<a class="yes" href="javascript:void(0)" onclick="toggleMyPresence('+eventId+', \'no\'); return false">presença confirmada</a>';
		else
			link = '<a class="no" href="javascript:void(0)" onclick="toggleMyPresence('+eventId+', \'yes\'); return false">confirmar presença</a>';
		
		$('presenceToggler'+eventId).innerHTML = link;
	};
		
	var failureFunc = function(t){

		alert('Não foi possível confirmar sua presença no evento!\nPor favor, tente novamente.');
		
		if( isDebug() )
			debugAdd(t.responseText);
	};
	
	var urlAjax = _webRoot+'/event/choosePresence/eventId/'+eventId+'/choice/'+choice+'/qc/1';
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}