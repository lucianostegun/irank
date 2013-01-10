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

	afterChangeStep();
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
	
	afterChangeStep();
}

function afterChangeStep(){
	
	if( _currentStep==3 )
		showButton('ignore');
	else
		hideButton('ignore');
}

function validateStep(){

	switch(_currentStep){
		case 1:
			var startStack = $('chipCalculatorStartStack').value;
			if( !startStack || !startStack.match(/^[0-9]* ?k?$/i) ){
				
				alert('Selecione uma das opções para o stack inicial!');
				$('chipCalculatorStartStack').addClassName('formFieldError');
				$('chipCalculatorStartStack').focus();
				return false;
			}
			break;
		case 2:
			var chipDivList = document.getElementsByClassName('chip active');
			if( chipDivList.length < 3 ){
				
				alert('Por favor, selecione pelo menos 3 fichas de valores diferentes!');
				return false;
			}
			if( chipDivList.length > 6 ){
				
				alert('Por favor, selecione no máximo 6 fichas de valores diferentes!');
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
	}else{
		
		var chipDivList = document.getElementsByClassName('chip active');
		if( chipDivList.length == 6 )
			return;
		
		Element.addClassName('active');
	}
}

function getChipSet(forceRandom){
	
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
			html += '<b>'+sprintf('%02d', chips)+'</b> ficha'+(chips==1?'':'s')+' de <b>'+(chipOriginal>=1000?(chipOriginal/1000)+'K':chipOriginal)+'</b>';
			if( chipOriginal != chip )
				html += ' <label>(utilizadas com o valor de <b>'+(chip>=1000?(chip/1000)+'K':chip)+'</b>)</label>';
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
		
		setCommonBarMessage('Nenhuma distriuição adequada foi encontrada!\nSelecione fichas diferentes ou altere o stack inicial.', 'error', true);
		resetSteps();
		
		if( isDebug() )
			debug(content);
	};
	
	$('chipCalculatorChips').value       = chipList;
	$('chipCalculatorForceRandom').value = (forceRandom?'1':'0');
	
	var urlAjax = _webRoot+'/chipCalculator/getChipSet';
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc, parameters:Form.serialize($('chipCalculatorForm'))});
}

function selectStartStack(Element, chipList){
	
	var stackOptionList = document.getElementsByClassName('stackOption selected');
	if( stackOptionList.length > 0 )
		stackOptionList[0].removeClassName('selected');

	var startStack = Element.title*1;
	
	Element.addClassName('selected');
	$('chipCalculatorStartStack').value = startStack;
	$('startStackLabel').innerHTML      = Element.innerHTML;
	$('suggestChipLabel').innerHTML     = chipList;
	
	location.hash = '#start';
}

function ignoreStep(){
	
	$('chipCalculatorPlayers').value = '';
	$('chipCalculatorGameDuration').value = '';
	$('chipCalculatorBlindDuration').value = '';
	$('chipCalculatorAllowRebuy').checked = false;
	$('chipCalculatorAllowAddon').checked = false;
	$('chipCalculatorAllowAnte').checked = false;
	
	showNext();
}