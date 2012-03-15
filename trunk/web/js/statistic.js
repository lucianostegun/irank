function handleSuccessStats(content){

	var format = $('statisticFormat').value;
	
	$('export').value     = '1';
	$('statisticForm').submit();
	$('export').value     = '0';

	setButtonBarStatus('statisticMain', 'success');
	enableButton('mainSubmit');
	hideIndicator('statistic');
}

function handleFailureStats(content){
	
	enableButton('mainSubmit');
	setButtonBarStatus('statisticMain', 'error');
	
	handleFormFieldError(content, 'statisticForm', 'statistic', false, 'statistic');
}

function doSubmitStats(content){

	if( !checkRankingType() )
		return false;

	clearFormFieldErrors('statisticForm');

	setButtonBarStatus('statisticMain', '');
	
	showIndicator('statistic');
	disableButton('mainSubmit');
	$('statisticForm').onsubmit();
}

function checkReportType(){
	
	var reportType  = $('statisticReportType').value;
	var rankingType = $('statisticFormat').value;
	
	if( reportType=='rankHistory' )
		$('statisticFormat').value = 'report';
}

function checkRankingType(){
	
	return true;
}