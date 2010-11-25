function handleSuccessStats(content){

	var format = $('statisticFormat').value;
	
	$('export').value     = '1';
	$('statisticForm').submit();
	$('export').value     = '0';
	
	enableButton('mainSubmit');
	hideIndicator('statistic');
}

function doSubmitStats(content){

	if( !checkRankingType() )
		return false;
	
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