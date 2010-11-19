function handleSuccessStats(content){

	var format = $('statsFormat').value;
	
	$('export').value     = '1';
	$('statsForm').target = (format=='report'?'_blank':'_top');
	$('statsForm').submit();
	$('export').value     = '0';
	
	enableButton('mainSubmit');
	hideIndicator('stats');
}

function doSubmitStats(content){

	showIndicator('stats');
	disableButton('mainSubmit');
	$('statsForm').onsubmit();
}