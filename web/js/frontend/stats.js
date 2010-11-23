function handleSuccessStats(content){

	var format = $('statsFormat').value;
	
	$('export').value     = '1';
	$('statsForm').submit();
	$('export').value     = '0';
	
	enableButton('mainSubmit');
	hideIndicator('stats');
}

function doSubmitStats(content){

	if( !checkRankingType() )
		return false;
	
	showIndicator('stats');
	disableButton('mainSubmit');
	$('statsForm').onsubmit();
}

function checkReportType(){
	
	var reportType  = $('statsReportType').value;
	var rankingType = $('statsFormat').value;
	
	if( reportType=='rankHistory' )
		$('statsFormat').value = 'report';
}

function checkRankingType(){
	
	return true;
}