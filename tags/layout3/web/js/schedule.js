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
	
	var stepIdCurrent = sprintf('step-%03d', _currentStep++);
	var stepIdNext    = sprintf('step-%03d', _currentStep);
	
	$(stepIdCurrent).hide();

	$(stepIdNext).style.visibility = 'visible';
	$(stepIdNext).show();
	$(stepIdNext).fade({ duration: 0.3, from: 0, to: 1 });
	
	$(stepIdCurrent).style.position   = 'absolute';
	$(stepIdCurrent).style.visibility = 'hidden';
	$(stepIdCurrent).show();
	$(stepIdCurrent).setStyle({opacity: 0.0});
	
	if( _currentStep==_totalSteps ){
		
		showDiv('stepResetPaginator');
		hideDiv('stepPaginator');
	}
	
	enableButton('navigatorPrevious');
}

function showPrevious(){
	
	var stepIdCurrent  = sprintf('step-%03d', _currentStep--);
	var stepIdPrevious = sprintf('step-%03d', _currentStep);
	
	$(stepIdCurrent).hide();
	
	$(stepIdPrevious).style.visibility = 'visible';
	$(stepIdPrevious).show();
	$(stepIdPrevious).fade({ duration: 0.3, from: 0, to: 1 });
	
	$(stepIdCurrent).style.position   = 'absolute';
	$(stepIdCurrent).style.visibility = 'hidden';
	$(stepIdCurrent).show();
	$(stepIdCurrent).setStyle({opacity: 0.0});
	
	if( _currentStep==1 )
		disableButton('navigatorPrevious');
	
}

function resetSteps(){
	
	disableButton('navigatorPrevious');
	showDiv('stepPaginator');
	hideDiv('stepResetPaginator');
	
	for(var currentStep=_totalSteps; currentStep > 1; currentStep--)
		showPrevious()
}