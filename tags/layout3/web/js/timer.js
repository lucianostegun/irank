var isRunning      = false;
var secondsLeft    = 0;
var elapsedSeconds = 0;
var elapsedTime    = 0;
var levelSeconds   = 0;
var timerInterval  = 1000;
var currentLevel   = 0;

const CELL_BLIND_ID = 0;
const CELL_BLIND_MARK = 1;
const CELL_BLIND_LEVEL = 2;
const CELL_BLIND_SMALL = 3;
const CELL_BLIND_BIG = 4;
const CELL_BLIND_ANTE = 5;
const CELL_BLIND_DURATION = 6;
const CELL_BLIND_PAUSE = 8;

function nextLevel(pause){
	
	var rowsNum = gridboxBlindObj.getRowsNum();
	
	elapsedTime += secondsLeft+elapsedSeconds;
	
	if( rowsNum <= currentLevel ){
		
		disableButton('levelNext');
		stopTimer();
		return false;
	}
	
	if( rowsNum==(currentLevel+1) )
		disableButton('levelNext');
	else
		enableButton('levelNext');
	
	currentLevel++;
	
	if( currentLevel > 1 )
		enableButton('levelPrevious');

	setBlindLevel();
	
	if( pause )
		stopTimer();
	
	return true;
}

function previousLevel(pause){
	
	var rowsNum = gridboxBlindObj.getRowsNum();
	
	if( currentLevel==1 ){
		
		disableButton('levelPrevious');
		stopTimer();
		return false;
	}
	
	// Tempo já corrido do level atual
//	elapsedTime -= elapsedSeconds+secon;
	
	enableButton('levelNext');
	currentLevel--;
	
	if( currentLevel==1 )
		disableButton('levelPrevious');

	setBlindLevel(true);
	
	if( pause )
		stopTimer();
}

function setBlindLevel(decraseElapsedTime){
	
	var rowId    = gridboxBlindObj.getRowId(currentLevel-1);
	var duration = gridboxBlindObj.cells(rowId, CELL_BLIND_DURATION).getValue();
	
	secondsLeft    = duration*60;
	levelSeconds   = secondsLeft;
	elapsedSeconds = 0;
	
	// Tempo já corrido do level que voltou (já que voltou pro começo)
	if( decraseElapsedTime )
		elapsedTime -= secondsLeft;
	
	var values = [];
	for(var i=0; i <= secondsLeft; i++)
		values.push(i);
	
	timerSliderObj.allowedValues = values;
	
	timerSliderObj.range = $R(0,secondsLeft);
	timerSliderObj.setValue(secondsLeft);
	timerSliderObj.setEnabled();
	
	$('currentLevel').innerHTML = 'Nível '+currentLevel;
	
	updateTimerLabels();
	
	for(var rowIndex=0; rowIndex < gridboxBlindObj.getRowsNum(); rowIndex++){
		
		var rowIdTmp = gridboxBlindObj.getRowId(rowIndex);
		gridboxBlindObj.cells(rowIdTmp, CELL_BLIND_MARK).setValue('/images/blank.gif');
	}
	
	gridboxBlindObj.cells(rowId, CELL_BLIND_MARK).setValue('/images/icon/markRight24.png');
	
	var smallBlind = gridboxBlindObj.cells(rowId, CELL_BLIND_SMALL).getValue()*1;
	var bigBlind   = gridboxBlindObj.cells(rowId, CELL_BLIND_BIG).getValue()*1;
	var ante       = gridboxBlindObj.cells(rowId, CELL_BLIND_ANTE).getValue()*1;
	var ante       = gridboxBlindObj.cells(rowId, CELL_BLIND_ANTE).getValue()*1;
	
	if( smallBlind >= 100000 )
		smallBlind = (smallBlind/1000)+'k';
	
	if( bigBlind >= 100000 )
		bigBlind = (bigBlind/1000)+'k';
	
	$('smallBlindValue').innerHTML = smallBlind;
	$('bigBlindValue').innerHTML   = bigBlind;
	$('anteValue').innerHTML       = ante;
}

function toggleTimer(){
	
	if( isRunning )
		stopTimer();
	else
		startTimer();
}

function startTimer(){

	if( !currentLevel )
		if( !nextLevel() )
			return false;
	
	isRunning = true;
	setButtonLabel('timerToggler', 'Pausar');
	
	window.setTimeout(runTimer, timerInterval);
}

function stopTimer(){
	
	isRunning = false;
	setButtonLabel('timerToggler', 'Iniciar')
}

function runTimer(){
	
	if( !isRunning )
		return false;
	
	decraseTimer();
	
	window.setTimeout(runTimer, timerInterval);
}

function decraseTimer(){

	if( secondsLeft < 0 )
		secondsLeft = 0;
	
	if( secondsLeft==0 )
		nextLevel();
	
	secondsLeft--;
//	elapsedTime++;
	elapsedSeconds++;
	
	timerSliderObj.setValue(secondsLeft);
	
	updateTimerLabels();
}

function incraseTimer(){
	
	secondsLeft++;
//	elapsedTime--;
	elapsedSeconds--;
	
	timerSliderObj.setValue(secondsLeft);
	
	updateTimerLabels();
}

function updateTimerLabels(){
	
	var seconds  = secondsLeft;
	
	var hours  = Math.floor(seconds/60/60);
	seconds   -= (hours*60*60)
	
	var minutes = Math.floor(seconds/60);
	seconds    -= (minutes*60)
	
	$('timerHours').innerHTML   = sprintf('%02d', hours);
	$('timerMinutes').innerHTML = sprintf('%02d', minutes);
	$('timerSeconds').innerHTML = sprintf('%02d', seconds);
	
	$('elapsedTimeValue').innerHTML = formatTimeString(elapsedTime+elapsedSeconds);
}

function addBlind(){
	
	var rowId;
	var rowsNum    = gridboxBlindObj.getRowsNum();
	var duration   = '10';
	var blindLevel = 0;
	
	if( rowsNum > 0 ){
		
		rowId      = gridboxBlindObj.getRowId(rowsNum-1);
		duration   = gridboxBlindObj.cells(rowId, CELL_BLIND_DURATION).getValue();
		
		for(var rowIndex=gridboxBlindObj.getRowsNum()-1; rowIndex >=0 ; rowIndex--){
			
			var rowIdTmp = gridboxBlindObj.getRowId(rowIndex);
			var isPause  = gridboxBlindObj.cells(rowIdTmp, CELL_BLIND_PAUSE).getValue()=='1';
			
			if( isPause )
				continue;
			
			blindLevel = gridboxBlindObj.cells(rowIdTmp, CELL_BLIND_LEVEL).getValue();
			blindLevel = blindLevel.replace(/[^0-9]/g, '')*1;
			break;
		}
	}
	
	rowId = gridboxBlindObj.getUID();
	gridboxBlindObj.addRow(rowId, ',,,0,0,0,0,min,0');
	
	gridboxBlindObj.cells(rowId, CELL_BLIND_LEVEL).setValue((blindLevel+1));
	gridboxBlindObj.cells(rowId, CELL_BLIND_DURATION).setValue(duration);
	
	gridboxBlindObj.setSelectedRow(rowId);
	
	if( rowsNum > 0 )
		enableButton('levelNext');
}

function onCellEditBlind(state, rowId, colId){
	
	if( state==0 ){
		
		if( isRunning )
			return false;
	}
	
	if( state==2 ){
		
		var smallBlind = gridboxBlindObj.cells(rowId, CELL_BLIND_SMALL).getValue();
		
		switch( colId ){
			case CELL_BLIND_SMALL:
				// Se o big estiver vazio, define o big como o dobro do small
				if( gridboxBlindObj.cells(rowId, CELL_BLIND_BIG).getValue()=='0' )
					gridboxBlindObj.cells(rowId, CELL_BLIND_BIG).setValue( smallBlind*2 );
		}
		
		saveBlindLevel(rowId)
	}
	
	return true;
}

function saveBlindLevel(rowId){
	
	var timerId      = $('timerId').value;
	var timerLevelId = gridboxBlindObj.cells(rowId, CELL_BLIND_ID).getValue();
	var smallBlind   = gridboxBlindObj.cells(rowId, CELL_BLIND_SMALL).getValue();
	var bigBlind     = gridboxBlindObj.cells(rowId, CELL_BLIND_BIG).getValue();
	var ante         = gridboxBlindObj.cells(rowId, CELL_BLIND_ANTE).getValue();
	var duration     = gridboxBlindObj.cells(rowId, CELL_BLIND_DURATION).getValue();
	var isPause      = gridboxBlindObj.cells(rowId, CELL_BLIND_PAUSE).getValue();
	
	if( !smallBlind || !bigBlind || !ante || !duration )
		return false;
	
	var successFunc = function(t){
		
		var timerLevelId = t.responseText;
		
		gridboxBlindObj.cells(rowId, CELL_BLIND_ID).setValue(timerLevelId);
	}
	
	var urlAjax = _webRoot+'/timer/saveLevel?timerId='+timerId;
	urlAjax    += '&timerLevelId='+timerLevelId;
	urlAjax    += '&smallBlind='+smallBlind;
	urlAjax    += '&bigBlind='+bigBlind;
	urlAjax    += '&ante='+ante;
	urlAjax    += '&duration='+duration;
	urlAjax    += '&isPause='+isPause;
	
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc});
}

function onCheckBlind(rowId, colId, checked){
	
	if( isRunning )
		return false;
	
	if( checked ){
		
		if( colId==CELL_BLIND_PAUSE ){
			
			gridboxBlindObj.cells(rowId, CELL_BLIND_LEVEL).setValue('');
			updateLevelNumbers();
		}
	}else{
		
		if( colId==CELL_BLIND_PAUSE )
			updateLevelNumbers();
	}
}

function onKeyPressBlind(keyCode, ctrlKey, shiftKey){
	
	var rowsNum = gridboxBlindObj.getRowsNum();
	
	if( keyCode==Event.KEY_DELETE ){
		
		var rowId = gridboxBlindObj.getSelectedId();
		
		if( !rowId || rowsNum==1 )
			return false;
		
		var timerLevelId = gridboxBlindObj.cells(rowId, CELL_BLIND_ID).getValue();
		
		var successFunc = function(t){
			
			var rowIndex = gridboxBlindObj.getRowIndex(rowId);
			
			gridboxBlindObj.deleteSelectedItem();
			updateLevelNumbers();
			stopTimer();

			if( rowIndex > 0 )
				rowIndex -= 1;
			else if( rowsNum-1 > 0 )
				rowIndex = 0
			else
				rowIndex = null;
			
			if( rowIndex!=null ){
				rowId = gridboxBlindObj.getRowId(rowIndex);
				gridboxBlindObj.setSelectedRow(rowId);
			}
		}
		
		if( timerLevelId ){
			
			var urlAjax = _webRoot+'/timer/deleteLevel?timerLevelId='+timerLevelId;
			new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc});
		}else
			successFunc()
		
	}
	
	return true;
}

function updateLevelNumbers(){
	
	for(var rowIndex=0, level=0; rowIndex < gridboxBlindObj.getRowsNum(); rowIndex++){
		
		var rowId   = gridboxBlindObj.getRowId(rowIndex);
		var isPause = gridboxBlindObj.cells(rowId, CELL_BLIND_PAUSE).getValue()=='1';
		
		if( isPause )
			continue;
		
		gridboxBlindObj.cells(rowId, CELL_BLIND_LEVEL).setValue(++level);
	}
}

function openTimer(timerId){

	var urlTimer = _webRoot+'/timer/timer/id/'+base64_encode(timerId);
	window.open(urlTimer, 'irankTimer', 'width=650, height= 350, scrollbars=yes, location=no, locationbar=no, resizable=yes, toolbar=no, fullscreen=yes');
}


window.addEventListener('load',function() {
	
	$('blindTimer').style.height = window.innerHeight+'px';
});