var _currentStep = 1;
var _totalSteps  = 1;

function setupSteps(amount){

	for(var currentStep=2; currentStep <= amount; currentStep++){
		
		var stepId = sprintf('step-%03d', currentStep);

		$(stepId).hide();
		$(stepId).setStyle({opacity: 0.0});
		
		$(stepId).removeClassName('hidden');
	}
	
	_totalSteps = amount;
}

function showNext(){

	if( !validateStep() )
		return false;
	
	var stepIdCurrent = sprintf('step-%03d', _currentStep++);
	var stepIdNext    = sprintf('step-%03d', _currentStep);
	
	
	$(stepIdCurrent).hide();

	$(stepIdNext).style.visibility = 'visible';
	$(stepIdNext).style.position   = '';
	$(stepIdNext).show();
	$(stepIdNext).fade({ duration: 0.3, from: 0, to: 1 });
	
	$(stepIdCurrent).style.position   = 'absolute';
	$(stepIdCurrent).style.visibility = 'hidden';
	$(stepIdCurrent).show();
	$(stepIdCurrent).setStyle({opacity: 0.0});
	
	if( _currentStep==_totalSteps ){
		
		getChipSet();
		showDiv('stepResetPaginator');
//		hideDiv('stepPaginator');
		disableButton('navigatorNext');
	}
	
	if( _currentStep==2 )
		$('chipCalculatorStartStack').focus();
	
	enableButton('navigatorPrevious');
}

function showPrevious(){
	
	var stepIdCurrent  = sprintf('step-%03d', _currentStep--);
	var stepIdPrevious = sprintf('step-%03d', _currentStep);
	
	$(stepIdCurrent).hide();
	
	$(stepIdPrevious).style.visibility = 'visible';
	$(stepIdPrevious).show();
	$(stepIdPrevious).style.position   = '';
	$(stepIdPrevious).fade({ duration: 0.3, from: 0, to: 1 });
	
	$(stepIdCurrent).style.position   = 'absolute';
	$(stepIdCurrent).style.visibility = 'hidden';
	$(stepIdCurrent).show();
	$(stepIdCurrent).setStyle({opacity: 0.0});
	
	if( _currentStep==1 )
		disableButton('navigatorPrevious');

	showDiv('loadingResult');
	$('chipSetResult').innerHTML = '';
	showDiv('chipSetResultFooter');
	
	enableButton('navigatorNext');
}

function validateStep(){

	switch(_currentStep){
		case 1:
			var chipDivList = document.getElementsByClassName('chip active');
			if( chipDivList.length < 3 ){
				
				alert('Por favor, selecione pelo menos três fichas de valores diferentes!');
				return false;
			}
			break;
		case 2:
			var startStack = $('chipCalculatorStartStack').value;
			if( !startStack || !startStack.match(/^[0-9]* ?k?$/i) ){
				
				alert('Por favor, informe um valor válido para o stack inicial!');
				$('chipCalculatorStartStack').addClassName('formFieldError');
				$('chipCalculatorStartStack').focus();
				return false;
			}
			break;
	}
	
	$('chipCalculatorStartStack').removeClassName('formFieldError');
	return true;
}

function resetSteps(){
	
	disableButton('navigatorPrevious');
	showDiv('stepPaginator');
	hideDiv('stepResetPaginator');
	
	for(var currentStep=_totalSteps; currentStep > 1; currentStep--)
		showPrevious()
}

function selectChip(Element){
	
	var background = Element.style.backgroundImage;
	
	if( Element.hasClassName('active') ){
		
		Element.removeClassName('active')
		Element.style.backgroundImage = background.replace('/chips', '/chips/dimmed');
	}else{
		
		Element.addClassName('active');
		Element.style.backgroundImage = background.replace('/chips/dimmed', '/chips');
	}
}

function getChipSet(forceRandom){
	
	var startStack   = $('chipCalculatorStartStack').value;
	var players      = $('chipCalculatorPlayers').value;
	var gameDuration = $('chipCalculatorGameDuration').value;
	
	var chipDivList = document.getElementsByClassName('chip active');
	var chipList = [];
	
	for(var i=0; i < chipDivList.length; i++)
		chipList.push(chipDivList[i].id.replace('chip-', ''));
	
	showDiv('loadingResult');
	hideDiv('chipSetResult');
	hideDiv('chipSetResultFooter');
	showIndicator();
	
	var successFunc = function(t){

		var content    = t.responseText;
		var chipSetObj = parseInfo(content);

		hideDiv('loadingResult');
		showDiv('chipSetResult');
		showDiv('chipSetResultFooter');
		
		html = '';
		
		for(chip in chipSetObj){
			
			var chips = chipSetObj[chip];
			if( typeof(chips)=='object' ){
				
				chipOriginal = chips.original;
				chips        = chips.totalValue/chip;
			}else{
				
				chipOriginal = chip;
				chips        = chipSetObj[chip]/chip;
			}
			
			html += '<div class="chip result" style="background-image: url(\'/images/chips/chip'+chipOriginal+'.png\')">';
			html += '<span>';
			html += '<b>'+sprintf('%02d', chips)+'</b> ficha'+(chips==1?'':'s')+' de <b>'+chipOriginal+'</b>';
			if( chipOriginal != chip )
				html += ' <label>(utilizadas com o valor de <b>'+chip+'</b>)</label>';
			html += '</span>';
			html += '</div>';
//			html += '<div class="clear"></div>';
		}
		
		$('chipSetResult').innerHTML = html;

		hideIndicator();
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		hideIndicator();
		
		alert('Não foi possível obter a configuração ideal de fichas para os valores/stack selecionado!\nPor favor, tente selecionar uma configuação diferente ou altere o stack inicial.');
		resetSteps();
		
		if( isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/chipCalculator/getChipSet?startStack='+startStack+'&players='+players+'&gameDuration='+gameDuration+'&chips='+chipList+'&forceRandom='+(forceRandom?'1':'0');
	
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}