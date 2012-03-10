var _RankingPlaceSuccessFunc = null;

function addRankingPlace(rankingId){

	clearFormFieldErrors('rankingPlaceForm');
	hideFormStatusError('rankingPlace');
	hideFormStatusSuccess('rankingPlace');
	hideIndicator('rankingPlace');
	enableButton('rankingPlaceSubmit');
	
	$('rankingPlaceRankingPlaceId').value = '';
	$('rankingPlaceRankingId').value      = rankingId;
	
	windowRankingPlaceAddShow();
	
	$('rankingPlacePlaceName').focus();
}

function doSubmitRankingPlace(content){

	showIndicator('rankingPlace');
	disableButton('rankingPlaceSubmit');
	$('rankingPlaceForm').onsubmit();
}

function handleSuccessRankingPlace(rankingPlaceId){

	$('rankingPlaceForm').reset();
	
	_RankingPlaceSuccessFunc(rankingPlaceId);
	
	hideIndicator('rankingPlace');
	
	adjustContentTab();
	windowRankingPlaceAddHide();
}

function rankingPlaceOnClose(){
	
	if( $('eventRankingPlaceId').value=='new' )
		$('eventRankingPlaceId').value = '';
}