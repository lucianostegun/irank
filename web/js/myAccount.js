function handleSuccessMyAccount(content, isNew){
	
	if( isNew )
		goModule('myAccount', null, null, null);

	setButtonBarStatus('myAccountMain', 'success');
	clearFormFieldErrors('myAccountForm');
	showFormStatusSuccess();
	hideIndicator('myAccount');
	enableButton('mainSubmit');
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
			alert('Erro ao carregar a imagem!\nSelecione um arquivo nos formatos JPG ou PNG de at?? 2Mb com dimens??es m??nimas de 200x260');
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

function sortDataTable(sortField, sortDesc){

	showIndicator();
	
	var successFunc = function(t){
		
		hideIndicator();
		$('eventLiveTableContent').innerHTML = t.responseText;
	}

	var failureFunc = function(t){
		
		hideIndicator();
		
		alert('N??o foi poss??vel carregar as informa????es!\nPor favor, tente novamente.');
		if( isDebug() )
			debugAdd(t.responseText);
	}
	
	var urlAjax = _webRoot+'/myAccount/getTabContent/tabId/table/sortField/'+sortField+'/sortDesc/'+(sortDesc?'1':'0');
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}

function showQuickConfirmButton(eventLiveId){
	
	showDiv('quickConfirmButton-'+eventLiveId);
}

function hideQuickConfirmButton(eventLiveId){
	
	hideDiv('quickConfirmButton-'+eventLiveId);
}

function removePendingInvite(eventLiveId){
	
	$('pendingInviteRow-'+eventLiveId).removeClassName('pendingInviteRow');
	$('pendingInviteRow-'+eventLiveId).addClassName('hidden');
	
	var visibleRows = document.getElementsByClassName('pendingInviteRow');
	
	if( visibleRows.length==0 )
		$('pendingInviteRowEmpty').removeClassName('hidden');
	
	var pendingInvites = $('pendingInvitesCount').innerHTML*1;
	pendingInvites -= 1;
	pendingInvites  = (pendingInvites>0?pendingInvites:0);
	
	$('pendingInvitesCount').innerHTML = pendingInvites;
	
	var urlAjax = _webRoot+'/myAccount/deletePendingInvite/eventLiveId/'+eventLiveId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false});
}