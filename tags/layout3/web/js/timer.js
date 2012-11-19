var isRunning     = false;
var secondsLeft   = 60*60*2;
var timerInterval = 1000;
var currentLevel  = 0;

const CELL_BLIND_ID = 0;
const CELL_BLIND_MARK = 1;
const CELL_BLIND_NUMBER = 2;
const CELL_BLIND_SMALL = 3;
const CELL_BLIND_BIG = 4;
const CELL_BLIND_ANTE = 5;
const CELL_BLIND_DURATION = 6;
const CELL_BLIND_PAUSE = 8;

function nextLevel(){
	
	var rowsNum = gridboxBlindObj.getRowsNum();
	
	if( rowsNum <= currentLevel ){
		
		disableButton('levelNext');
		stopTimer();
		return false;
	}
	
	if( rowsNum==(currentLevel+1) )
		disableButton('levelNext');
	
	if( currentLevel > 1 )
		enableButton('levelPrevious');
	
	currentLevel++;

	setBlindLevel();
}

function previousLevel(){
	
	var rowsNum = gridboxBlindObj.getRowsNum();
	
	if( currentLevel==1 ){
		
		disableButton('levelPrevious');
		stopTimer();
		return false;
	}
	
	enableButton('levelNext');
	currentLevel--;
	
	if( currentLevel==1 )
		disableButton('levelPrevious');

	setBlindLevel();
}

function setBlindLevel(){
	
	var rowId    = gridboxBlindObj.getRowId(currentLevel-1);
	var duration = gridboxBlindObj.cells(rowId, CELL_BLIND_DURATION).getValue();
	
	secondsLeft = duration*60;
	
	updateTimerLabels();
	
	for(var rowIndex=0; rowIndex < gridboxBlindObj.getRowsNum(); rowIndex++){
		
		var rowIdTmp = gridboxBlindObj.getRowId(rowIndex);
		gridboxBlindObj.cells(rowIdTmp, CELL_BLIND_MARK).setValue('');
	}
	
	gridboxBlindObj.cells(rowId, CELL_BLIND_MARK).setValue('/images/icon/markRight24.png');
	
	var smallBlind = gridboxBlindObj.cells(rowId, CELL_BLIND_SMALL).getValue()*1;
	var bigBlind   = gridboxBlindObj.cells(rowId, CELL_BLIND_BIG).getValue()*1;
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
	
	secondsLeft--;
	
	if( secondsLeft < 0 )
		secondsLeft = 0;
	
	if( secondsLeft==0 )
		nextLevel();
	
	updateTimerLabels();
}

function incraseTimer(){
	
	secondsLeft--;
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
}

function addBlind(){
	
	var rowId;
	var rowsNum  = gridboxBlindObj.getRowsNum();
	var duration = '10';
	
	if( rowsNum > 0 ){
		
		rowId    = gridboxBlindObj.getRowId(rowsNum-1);
		duration = gridboxBlindObj.cells(rowId, CELL_BLIND_DURATION).getValue();
	}
	
	rowId = gridboxBlindObj.getUID();
	gridboxBlindObj.addRow(rowId, ',,,0,0,0,0,0');
	
	gridboxBlindObj.cells(rowId, CELL_BLIND_NUMBER).setValue(rowsNum+1);
	gridboxBlindObj.cells(rowId, CELL_BLIND_DURATION).setValue(duration);
	
	gridboxBlindObj.setSelectedRow(rowId);
	
	if( rowsNum > 0 )
		enableButton('levelNext');
}

function onCellEditBlind(state, rowId, colId){
	
	if( state==2 ){
		
		var smallBlind = gridboxBlindObj.cells(rowId, CELL_BLIND_SMALL).getValue();
		
		switch( colId ){
			case CELL_BLIND_SMALL:
				// Se o big estiver vazio, define o big como o dobro do small
				if( gridboxBlindObj.cells(rowId, CELL_BLIND_BIG).getValue()=='0' )
					gridboxBlindObj.cells(rowId, CELL_BLIND_BIG).setValue( smallBlind*2 );
		}
	}
	
	return true;
}

function onCheckBlind(rowId, colId, checked){
	
	if( checked ){
		
		if( colId==CELL_BLIND_PAUSE ){
			
			gridboxBlindObj.cells(rowId, CELL_BLIND_NUMBER).setValue('');
			updateLevelNumbers();
		}
	}else{
		
		if( colId==CELL_BLIND_PAUSE )
			updateLevelNumbers();
	}
}

function onKeyPressBlind(keyCode, ctrlKey, shiftKey){
	
	if( keyCode==Event.KEY_DELETE ){
		
		gridboxBlindObj.deleteSelectedItem();
		updateLevelNumbers();
		stopTimer();
	}
}

function updateLevelNumbers(){
	
	for(var rowIndex=0, level=0; rowIndex < gridboxBlindObj.getRowsNum(); rowIndex++){
		
		var rowId   = gridboxBlindObj.getRowId(rowIndex);
		var isPause = gridboxBlindObj.cells(rowId, CELL_BLIND_PAUSE).getValue()=='1';
		
		if( isPause )
			continue;
		
		gridboxBlindObj.cells(rowId, CELL_BLIND_NUMBER).setValue(++level);
	}
}

function openTimer(timerId){

	var urlTimer = _webRoot+'/timer/timer/id/'+base64_encode(timerId);
	window.open(urlTimer, 'irankTimer', 'width=650, height= 350, scrollbars=yes, location=no, locationbar=no, resizable=yes, toolbar=no');
}