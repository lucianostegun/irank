var _RankingPlaceSuccessFunc = null;

function addRankingPlace(rankingId){

	clearFormFieldErrors('rankingPlaceForm');
	hideFormStatusError('rankingPlace');
	hideFormStatusSuccess('rankingPlace');
	hideIndicator('rankingPlace');
	enableButton('rankingPlaceSubmit');
	hideDiv('rankingPlaceMapsLinkLoader');
	
	$('rankingPlaceRankingPlaceId').value = '';
	$('rankingPlaceRankingId').value      = rankingId;
	
	windowRankingPlaceAddShow();
	
	$('rankingPlacePlaceName').focus();
}

function editRankingPlace(rankingPlaceId, rankingId){
	
	if( !rankingPlaceId || !rankingId )
		return;
	
	showIndicator();
	
	var successFunc = function(t){
		
		var content = t.responseText;
		
		var rankingPlaceObj = parseInfo(content);

		clearFormFieldErrors('rankingPlaceForm');
		hideFormStatusError('rankingPlace');
		hideFormStatusSuccess('rankingPlace');
		hideIndicator('rankingPlace');
		enableButton('rankingPlaceSubmit');
		hideDiv('rankingPlaceMapsLinkLoader');
		
		var mapsLink = rankingPlaceObj.mapsLink;
		var stateId  = rankingPlaceObj.stateId;
		var cityName = rankingPlaceObj.cityName;
		var quarter  = rankingPlaceObj.quarter
		
		$('rankingPlaceRankingPlaceId').value = rankingPlaceId;
		$('rankingPlaceRankingId').value      = rankingId;
		$('rankingPlacePlaceName').value      = rankingPlaceObj.placeName;
		$('rankingPlaceMapsLink').value       = mapsLink;
		$('rankingPlaceStateId').value        = stateId;
		$('rankingPlaceCityName').value       = cityName;
		$('rankingPlaceQuarter').value        = quarter;
		
		if( mapsLink && (!stateId || !cityName || !quarter))
			parseMapsLinkInfo(mapsLink);
		
		windowRankingPlaceAddShow();
		
		$('rankingPlacePlaceName').focus();
		
		hideIndicator();
	};
	
	var failureFunc = function(t){
		
		hideIndicator();
		alert('Não foi possível carregar as informações do local seleciondo!\nPor favor, selecione o local novamente.');
	};
	
	var urlAjax = _webRoot+'/ranking/getRankingPlace/rankingPlaceId/'+rankingPlaceId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function doSubmitRankingPlace(content){

	showIndicator('rankingPlace');
	disableButton('rankingPlaceSubmit');
	$('rankingPlaceForm').onsubmit();
}

function handleSuccessRankingPlace(rankingPlaceId){

	$('rankingPlaceForm').reset();
	
	if( typeof(_RankingPlaceSuccessFunc)=='function' )
		_RankingPlaceSuccessFunc(rankingPlaceId);
	
	hideIndicator('rankingPlace');
	
	adjustContentTab();
	windowRankingPlaceAddHide();
}

function handleFailureRankingPlace(content){
	
	enableButton('rankingPlaceSubmit');
	handleFormFieldError(content, 'rankingPlaceForm', 'rankingPlace', false, 'rankingPlace');
}

function rankingPlaceOnClose(){
	
	if( $('eventRankingPlaceId').value=='new' )
		$('eventRankingPlaceId').value = '';
}

function parseMapsLinkInfo(mapsLink){
	
	var stateId  = $('rankingPlaceStateId').value;
	var cityName = $('rankingPlaceCityName').value;
	var quarter  = $('rankingPlaceQuarter').value;
	
	if( !mapsLink || (stateId && cityName && quarter))
		return;
	
	showDiv('rankingPlaceMapsLinkLoader');
	
	var successFunc = function(t){
		
		var content = t.responseText;
		var addressInfoObj = parseInfo(content);
		
		$('rankingPlaceStateId').value  = addressInfoObj.stateId;
		$('rankingPlaceCityName').value = addressInfoObj.cityName;
		$('rankingPlaceQuarter').value  = addressInfoObj.quarter;

		hideDiv('rankingPlaceMapsLinkLoader');
	};
	
	var failureFunc = function(t){
		
		hideDiv('rankingPlaceMapsLinkLoader');
	};
	
	var form = document.createElement('form');
	form.action = _webRoot+'/ranking/parseMapsInfo';

	var field   = document.createElement('input');
	field.type  = 'hidden';
	field.name  = 'mapsLink';
	field.value = urlencode(mapsLink);
	
	form.appendChild(field);
	
	var urlAjax = _webRoot+'/ranking/ParseMapsInfo';
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc, parameters:Form.serialize($('rankingPlaceForm'))});
}