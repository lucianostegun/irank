function handleSuccessMyAccount(content, isNew){
	
	if( isNew )
		goModule('myAccount', null, null, null);

	setButtonBarStatus('myAccountMain', 'success');
	clearFormFieldErrors('myAccountForm');
	showFormStatusSuccess();
	hideIndicator('myAccount');
	enableButton('mainSubmit');
	
	var userSiteObj   = parseInfo(content);
	var startBankroll = userSiteObj.startBankroll+1;
	
	if( startBankroll!=0 )
		hideMessage('startBankroll')
}

function handleFailureMyAccount(content){
	
	enableButton('mainSubmit');
	setButtonBarStatus('myAccountMain', 'error');
	handleFormFieldError(content, 'myAccountForm', 'myAccount', false, 'myAccount');
}

function doSubmitMyAccount(){
	
	showIndicator('myAccount');
	disableButton('mainSubmit');
	$('myAccountForm').onsubmit();
}

function togglePasswordField(){
	
	hideDiv('passwordChangeRowDiv');
	
	$('myAccountPassword').value = '';
	$('myAccountPassword').name  = 'passwordOld';
	$('myAccountPassword').id    = 'myAccountPasswordOld';
	
	$('myAccountPasswordConfirm').value = '';
	$('myAccountPasswordConfirm').name  = 'passwordConfirmOld';
	$('myAccountPasswordConfirm').id    = 'myAccountPasswordConfirmOld';
	
	var htmlContent = '';
	
	htmlContent += '<div class="row">';
	htmlContent += '		<div class="label" id="myAccountPasswordLabel">'+passwordLabel+'</div>';
	htmlContent += '		<div class="field"><input type="password" name="password" size="15" maxlength="15" class="required" id="myAccountPassword"></div>';
	htmlContent += '		<div class="error" id="myAccountPasswordError" onclick="showFormErrorDetails(\'myAccount\', \'password\')"></div>';
	htmlContent += '	</div>';
	htmlContent += '	<div class="row">';
	htmlContent += '		<div class="label" id="myAccountPasswordConfirmLabel">'+passwordConfirmLabel+'</div>';
	htmlContent += '		<div class="field"><input type="password" name="passwordConfirm" size="15" maxlength="15" class="required" id="myAccountPasswordConfirm"></div>';
	htmlContent += '		<div class="error" id="myAccountPasswordConfirmError" onclick="showFormErrorDetails(\'myAccount\', \'passwordConfirm\')"></div>';
	htmlContent += '	</div>';

	$('passwordAreaDiv').innerHTML = htmlContent;
	$('myAccountPasswordConfirm').focus();
}

function updateProfilePictureUploadStatus(status){
	
	switch(status){
		case 'error':
			alert('Erro ao carregar a imagem!\nSelecione um arquivo nos formatos JPG ou PNG de até 2Mb com dimensões mínimas de 200x260');
			hideIndicator();
			break;
	}
}

function doSavePhotoCutter(){
	
	showIndicator();
	
	var successFunc = function(t){

		closePhotoCutter(true);
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		hideIndicator();
		
		alert('error');
		
		if( isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/myAccount/cutProfilePicture';
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc, parameters:Form.serialize($('photoCutterForm'))});
}

function onEndCrop( coords, dimensions ) {
	
	$('photoCropX1').value = coords.x1;
	$('photoCropY1').value = coords.y1;
	$('photoCropX2').value = coords.x2;
	$('photoCropY2').value = coords.y2;
	$('photoCropWidth').value = dimensions.width;
	$('photoCropHeight').value = dimensions.height;
}

var cropperObj = null

function loadCropper(){
	
	if( cropperObj!=null ){
		
		cropperObj.reset();
		return false;
	}

	cropperObj = new Cropper.Img( 
			'imageCrop', 
			{ 
				minWidth: 200, 
				minHeight: 260, 
				ratioDim: { x: 200, y: 260 }, 
				displayOnInit: true, 
				onEndCrop: onEndCrop 
			} 
		);

	cropperObj.onLoad();
}

function loadPictureCutter(){
	
	var successFunc = function(t){

		var content = t.responseText;
		
		var infoObj = parseInfo(content);
		
		hideDiv('uploadProfilePhotoDiv');
		windowPhotoCutterShow();
		
		var height = infoObj.heightTmp*1;
		var width  = infoObj.widthTmp*1;
		
		var tmpId = 'imageCrop'+time();

		$('photoCutterDiv').style.height = height+'px';
		$('imageCrop').src    = infoObj.srcTmp+'?time='+time();
		$('imageCrop').width  = width;
		$('imageCrop').height = height;
		
		loadCropper();
		
		windowPhotoCutterObj.setDimension(width, height+64);
		windowPhotoCutterObj.center();
		
		hideIndicator();
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		hideIndicator();
		
		alert('error');
		
		if( isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/myAccount/getProfilePictureInfo';
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function closePhotoCutter(reloadPicture){

	windowPhotoCutterHide();
	
	showDiv('uploadProfilePhotoDiv');
	
	hideIndicator();
	
	if( reloadPicture ){
		
		$('profilePicture').src = $('profilePicture').src.replace(/\?time=[0-9]*$/gi, '')+'?time='+time();
		$('uploadProfilePhoto').reloadPicture();
	}
}

function loadCityField(stateId){
	
	$('myAccountScheduleStateIdDiv').innerHTML = getWaitSelect('scheduleCityId', 'myAccountScheduleStateId');
	
	var failureFunc = function(t){
		
		getEmptySelect('scheduleCityId', 'myAccountScheduleStateId');
	}
	
	var urlAjax = _webRoot+'/myAccount/getCityField/stateId/'+stateId;
	new Ajax.Updater('myAccountScheduleStateIdDiv', urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc});
}

function sortDataTable(tableId, sortField, sortDesc){

	showIndicator();
	
	var successFunc = function(t){
		
		hideIndicator();
		$(tableId+'TableContent').innerHTML = t.responseText;
	}

	var failureFunc = function(t){
		
		hideIndicator();
		
		alert('Não foi possível carregar as informações!\nPor favor, tente novamente.');
		if( isDebug() )
			debugAdd(t.responseText);
	}
	
	var urlAjax = _webRoot+'/myAccount/getTabContent/tabId/'+tableId+'/sortField/'+sortField+'/sortDesc/'+(sortDesc?'1':'0');
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}

function showQuickConfirmButton(eventLiveId){
	
	showDiv('quickConfirmButton-'+eventLiveId);
}

function hideQuickConfirmButton(eventLiveId){
	
	hideDiv('quickConfirmButton-'+eventLiveId);
}

function removePendingInvite(eventType, id){

	$('pendingInvite'+ucfirst(eventType)+'Row-'+id).removeClassName('pendingInviteRow');
	$('pendingInvite'+ucfirst(eventType)+'Row-'+id).addClassName('hidden');
	
	var visibleRows = document.getElementsByClassName('pendingInviteRow');
	
	if( visibleRows.length==0 )
		$('pendingInvite'+ucfirst(eventType)+'RowEmpty').removeClassName('hidden');
	
	var pendingInvites = $('pendingInvitesCount').innerHTML*1;
	pendingInvites -= 1;
	pendingInvites  = (pendingInvites>0?pendingInvites:0);
	
	$('pendingInvitesCount').innerHTML = pendingInvites;
	
	var urlAjax = _webRoot+'/myAccount/deletePendingInvite/id/'+id+'/eventType/'+eventType;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false});
}

function toggleBankroll(year){
	
	var rowList = document.getElementsByClassName('year-'+year);
	var action  = $('togglerLink-'+year).className;
	
	for(var i=0; i < rowList.length; i++)
		rowList[i].toggleClassName('hidden', 'visible');
	
	$('togglerLink-'+year).className = (action=='expand'?'collapse':'expand');
	$('togglerLink-'+year).innerHTML = (action=='expand'?'ocultar':'detalhes');
	
	location.hash = year;
}

function exportBankroll(exportType){
	
	window.location = _webRoot+'/myAccount/exportBankroll/exportType/'+exportType;
}

function updateBankroll(){
	
	var year = $('bankrollYear').value;
	
	updateTopResume(year);
	updateChartResume(year);
}

function updateTopResume(year){
	
	var urlAjax = _webRoot+'/myAccount/getTopResume?year='+year;
	new Ajax.Updater('bankrollTopResume', urlAjax, {asynchronous:true, evalScripts:false});
}

function updateChartResume(year){
	
	var urlAjax = _webRoot+'/myAccount/getChartResume?year='+year;
	new Ajax.Updater('bankrollChartResume', urlAjax, {asynchronous:true, evalScripts:false});
}

function onSelectTabMyAccount(tabId){
	
	switch(tabId){
		case 'main':
			showDiv('noRankingTutorial');
			break;
		default:
			hideDiv('noRankingTutorial');
			break;
	}

	return true;
}

function sendSmsValidationCode(){
	
	var phoneDdd    = $('myAccountPhoneDdd').value;
	var phoneNumber = $('myAccountPhoneNumber').value;
	var hasError    = false;
	
	removeFormStatusError('myAccountPhoneDdd');
	removeFormStatusError('myAccountPhoneNumber');
	
	if( !phoneDdd || !phoneDdd.match(/^[0-9]{2}$/) ){
		
		addFormStatusError('myAccountPhoneDdd', 'Informe corretamente o código de área de seu telefone');
		hasError = true;
	}

	if( !phoneNumber || !phoneNumber.match(/^[0-9]{4,5}-?[0-9]{4}$/) ){
		
		addFormStatusError('myAccountPhoneNumber', 'Informe corretamente o número de seu telefone');
		hasError = true;
	}
	
	if( hasError )
		return setCommonBarMessage('Corrija os campos em destaque para prosseguir com a validação', 'error');
	
	clearCommonBarMessage();	
	showIndicator();
	
	var successFunc = function(t){
		
		hideIndicator();
		$('rankingSmsValidationCodeLink').innerHTML = 'Código de validação enviado com sucesso!';
		showDiv('myAccountSmsValidationCodeRow');
		showDiv('myAccountAgreeSmsTermsRow');
		$('myAccountSmsValidationCode').focus();
		
		adjustContentTab();
	}

	var failureFunc = function(t){
		
		hideIndicator();
		alert('Não foi possível enviar o código de validação para o número de telefone informado!\nPor favor, tente novamente.');
	}
	
	var urlAjax = _webRoot+'/myAccount/sendSmsValidationCode/phoneDdd/'+phoneDdd+'/phoneNumber/'+phoneNumber;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}

function validateSmsCode(){
	
	var agreeSmsTerms     = $('myAccountAgreeSmsTerms').checked;
	var smsValidationCode = $('myAccountSmsValidationCode').value;
	var hasError          = false;
	
	removeFormStatusError('myAccountSmsValidationCode');
	
	if( !smsValidationCode ){
		
		addFormStatusError('myAccountSmsValidationCode', 'Informe o código de validação enviado ao telefone informado');
		hasError = false;
	}
	
	if( !agreeSmsTerms ){
		
		showDiv('myAccountAgreeSmsTermsError');
		hasError = true;
	}
	
	adjustContentTab();
	
	if( hasError )
		return false;
	
	clearCommonBarMessage();
	hideDiv('myAccountAgreeSmsTermsError');
	showIndicator();
	
	var successFunc = function(t){
		
		var content = t.responseText;
		hideIndicator();
		
		if( content=='success' ){
			
			hideDiv('myAccountAgreeSmsTermsRow');
			hideDiv('myAccountSmsValidationCodeRow');
			showDiv('myAccountSmsTemplateOptions');
			$('rankingSmsValidationCodeLink').innerHTML = 'Número validado';
			
			adjustContentTab();
		}else{
			
			addFormStatusError('myAccountSmsValidationCode', 'Código de validação inválido');
		}
	}
	
	var failureFunc = function(t){
		
		hideIndicator();
		var content = t.responseText;

		if( content=='exceededAttemptsLimit' ){
			
			alert('O limite de tentativas de ativar o código de validação doi excedido!\nPara continuar, solicite o envio de um novo código de validação.');
			$('rankingSmsValidationCodeLink').innerHTML = '<a href="javascript:void(0)" onclick="sendSmsValidationCode()">Validar telefone</a>'
			hideDiv('myAccountSmsValidationCodeRow');
			hideDiv('myAccountAgreeSmsTermsRow');
		}else{
			
			alert('Não foi possível confirmar o código de validação informado!\nPor favor, tente novamente.');
		}
	}
	
	var urlAjax = _webRoot+'/myAccount/validateSmsCode/smsValidationCode/'+smsValidationCode;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}