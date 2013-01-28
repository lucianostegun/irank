var wizardSteps     = 3;
var currentStep     = null;
var direction       = null;
var defaultDuration = 0;
var currentLevels   = 0;
var totalLevels     = 0;

var WIZARD_STEP_MAIN    = 1;
var WIZARD_STEP_OPTIONS = 2;
var WIZARD_STEP_LEVELS  = 3;
var WIZARD_STEP_EXTRA   = 4;
var WIZARD_STEP_SUCCESS = 5;

function startTimerWizard(){
	
	currentStep = 1;
	
	hideButton('newBlindset', true)
	hideDiv('timerList');
	
	var div = document.createElement('div');
	div.id  = 'wizardCurrentStep';
	
	putLoading('timerWizard', false, false, 'timerWizarIndicator');
	$('timerWizard').appendChild(div);
	
	var successFunc = function(t){
		
		hideDiv('timerWizarIndicator');
		showDiv('timerWizard');
		
		div.hide();
		div.innerHTML = t.responseText;
		
		div.style.visibility = 'visible';
		div.setStyle({opacity: 0.0});
		div.show();
		div.fade({ duration: 0.3, from: 0, to: 1 });
		
		enableButton('navigatorNext');
		showButton('navigatorNext', true);
		showButton('navigatorPrevious', true);
		
		$('timerWizardTimerName').focus()
	}
	
	location.hash = 'timerWizardHash';
	
	var urlAjax = _webRoot+'/timer/getWizardStep/step/'+currentStep;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess: successFunc});
}

function showNext(){
	
	direction = 'next';
	
	switch(currentStep){
	case WIZARD_STEP_MAIN:
		break;
	case WIZARD_STEP_OPTIONS:
		defaultDuration = $('timerWizardDuration').value
		currentLevels   = $('timerWizardLevels').value*1;
		totalLevels     = currentLevels;
		break;
	case WIZARD_STEP_LEVELS:
		redips_init();
		break;
}
	
	$('timerWizardStep').value = currentStep+1;
	$('timerWizardForm').onsubmit();
}

function showPrevious(){
	
	direction = 'previous';
	
	$('timerWizardStep').value = currentStep-1;
	$('timerWizardForm').onsubmit();
}

function handleSuccessWizard(content){
	
	$('wizardCurrentStep').remove();
	
	currentStep += (direction=='next'?1:-1);
	
	var div = document.createElement('div');
	div.id        = 'wizardCurrentStep';
	div.innerHTML = content;
	div.hide();

	$('timerWizard').appendChild(div);
	
	div.style.visibility = 'visible';
	div.show();
	div.fade({ duration: 0.3, from: 0, to: 1 });
	
	if( currentStep==1 )
		disableButton('navigatorPrevious');
	else
		enableButton('navigatorPrevious');
	
	if( currentStep!=WIZARD_STEP_LEVELS )
		hideButton('addBlindLevel', true);
	
	if( currentStep!=WIZARD_STEP_EXTRA ){
		
		showButton('navigatorNext');
		hideButton('navigatorConclude');
	}
	
	switch(currentStep){
		case WIZARD_STEP_MAIN:
			$('timerWizardTimerName').focus();
			break;
		case WIZARD_STEP_OPTIONS:
			$('timerWizardLevels').focus();
			break;
		case WIZARD_STEP_LEVELS:
			showButton('addBlindLevel', true);
			redips_init();
			updateCurrentLevels();
			break;
		case WIZARD_STEP_EXTRA:
			hideButton('navigatorNext');
			showButton('navigatorConclude');
			break;
		case WIZARD_STEP_SUCCESS:
			hideButton('navigatorPrevious', true);
			hideButton('navigatorNext', true);
			showButton('newBlindset', true)
			break;
	}
	
	clearCommonBarMessage();
	location.hash = 'timerWizardHash';
}

function handleFailureWizard(content){
	
	switch(currentStep){
	default:
		handleFormFieldError(content, 'timerWizardForm', 'timerWizard', false, 'timerWizard')
		break;
	case WIZARD_STEP_LEVELS:
		setCommonBarMessage('Os níveis de blinds não estão configurados corretamente! Verifique antes de continuar.', 'error', true);
		break;
	case WIZARD_STEP_EXTRA:
		setCommonBarMessage('Ocorreu um erro ao salvar as informações do timer! Por favor tente novamente.', 'error', true);
		break;
	}
	
	if( isDebug() )
		console.log(content)
}

function removeLevel(evt){
	
	var obj;
    
    if( navigator.appName.indexOf("Netscape") != -1 )
    	obj = evt.target;
    else
    	obj = evt.srcElement;
    
    rowNode = obj.parentNode.parentNode.parentNode;
    

	// Caso o usuário fique clicando no botão excluir
	if( rowNode.hasClassName('removed') )
		return false;
	
	if( currentLevels==1 )
		return alert('É necessário que o timer tenha pelo menos um nível');
	
	currentLevels--;
    
    rowNode.addClassName('removed');
    
    rowNode.fade({ duration: 0.3, from: 1, to: 0 });
	window.setTimeout(function(){
		
		rowNode.remove();
		reorderLevels();
	}, 300);
}

function reorderLevels(){
	
	var cellList = document.getElementsByClassName('blindLevel');
	var fieldList = document.getElementsByClassName('timerWizardIsPause');
	
	var levelLabel = 0;
	for(var i=0; i < cellList.length; i++){
		
//		var isPause = $('timerWizardIsPause-'+(i+1)).value=='1';
		var isPause = fieldList[i].value=='1';
		levelLabel += (isPause?0:1);

		cellList[i].innerHTML = (isPause?'':'#'+levelLabel);
	}
}

function addBlindLevel(){
	
	var table = document.getElementById('timerWizardLevelTable');
	 
	var rowCount = table.rows.length;
	var row = table.insertRow(rowCount);
	 
	var cellDrag     = row.insertCell(0);
	var cellLevel    = row.insertCell(1);
	var cellSmall    = row.insertCell(2);
	var cellBig      = row.insertCell(3);
	var cellAnte     = row.insertCell(4);
	var cellDuration = row.insertCell(5);
	var cellIsPause  = row.insertCell(6);
	var cellDelete   = row.insertCell(7);
	
	cellDrag.className = 'rowhandler textC';
	cellDrag.innerHTML = '<div class="drag row"></div>';
	
	cellLevel.className = 'blindLevel textR';
	
	currentLevels++;
	totalLevels++;
	
	cellSmall.innerHTML    = '<input type="text" name="smallBlind[]" value="0" size="4" maxlength="5" class="textR" onblur="handleBlurSmallBlind(this.id)" id="timerWizardSmallBlind-'+totalLevels+'">';
	cellBig.innerHTML      = '<input type="text" name="bigBlind[]" value="0" size="4" maxlength="5" class="textR" id="timerWizardBigBlind-'+totalLevels+'">';
	cellAnte.innerHTML     = '<input type="text" name="ante[]" value="0" size="4" maxlength="5" class="textR" id="timerWizardAnte-'+totalLevels+'">';
	cellDuration.innerHTML = '<input type="text" name="duration[]" value="'+defaultDuration+'" size="2" maxlength="3" id="timerWizardDuration-'+totalLevels+'"><span class="minuteLabel">min</span>';
	cellIsPause.className  = 'textC';
	cellIsPause.innerHTML  = '<input type="checkbox" name="pause" value="1" class="checkbox" onclick="handleIsPause(this.checked, '+totalLevels+')" id="timerWizardPause-'+totalLevels+'">';
	cellIsPause.innerHTML += '<input type="hidden" name="isPause[]" value="0" class="timerWizardIsPause" id="timerWizardIsPause-'+totalLevels+'">';
	cellDelete.innerHTML   = '<a href="javascript:void(0)" onclick="removeLevel(event)"><img src="/images/icon/delete.png" /></a>';
	
	redips_init();
	reorderLevels()
}

function handleIsPause(checked, level){
	
	$('timerWizardIsPause-'+level).value = checked?'1':'';
	
	if( checked ){
		
		$('timerWizardSmallBlind-'+level).addClassName('hidden');
		$('timerWizardBigBlind-'+level).addClassName('hidden');
		$('timerWizardAnte-'+level).addClassName('hidden');
		
//		$('timerWizardSmallBlind-'+level).value = '0';
//		$('timerWizardBigBlind-'+level).value   = '0';
//		$('timerWizardAnte-'+level).value       = '0';
	}else{
		
		$('timerWizardSmallBlind-'+level).removeClassName('hidden');
		$('timerWizardBigBlind-'+level).removeClassName('hidden');
		$('timerWizardAnte-'+level).removeClassName('hidden');
	}
	
	reorderLevels();
}

function updateCurrentLevels(){
	
	var cellList = document.getElementsByClassName('blindLevel');
	
	currentLevels = cellList.length;
	totalLevels   = cellList.length;
}

function handlePlaySound(checked){
	
	if( checked )
		showDiv('timerWizardMinuteAlertRow');
	else
		hideDiv('timerWizardMinuteAlertRow');
}

function handleBlurSmallBlind(fieldId){
	
	var smallBlind = $(fieldId).value*1;
	var bigBlind   = $(fieldId.replace('Small', 'Big')).value*1;
	
	if( bigBlind==0 )
		$(fieldId.replace('Small', 'Big')).value = smallBlind*2;
}