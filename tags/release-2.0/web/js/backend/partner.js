function handleSuccessPartner(content){

	clearFormFieldErrors('mainForm');
	showFormStatusSuccess()
	defaultSuccessToolbar();

	var recordName = $('partnerPartnerName').value;
	setActionDescription('Editando', recordName);
}

function getNewPartner(){

	disableToolbar('new');

	var successFunc = function(t) {

		var content = t.responseText;
		
		openToEditPartner();
		setActionDescription('new');
	
		clearFormFieldErrors('mainForm');
		hideFormStatusError();
		hideFormStatusSuccess();

		defaultGetNewRecordToolbar();

		$('partnerId').value          = content;
		$('partnerPartnerName').value = '';
		$('partnerExternalUrl').value = '';
		
		openRecord();

		tabBarMainObj.setTabActive('main');
		onTabContentLoaded('main', tabBarMainObj);
		
		$('partnerPartnerName').focus();
		
		hideIndicator();
	};
		
	var failureFunc = function(t) {

		var content = t.responseText;
		
		hideIndicator();
		
		alert('Não foi possível iniciar um novo registro!');
		
		enableToolbar('new');
		
		if( isDebug() )
			debug( content );
	};

	showIndicator();	

	var urlAjax = _webRoot+'/home/getNewId/className/partner';
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function openToEditPartner(){

	showIndicator();
	setReadOnly( false );
	setActionDescription('edit');

	defaultOpenToEditToolbar();
	
	showDiv('partnerPartnerNameFieldDiv');
	showDiv('partnerExternalUrlFieldDiv');

	hideDiv('partnerPartnerNameRoDiv');   
	hideDiv('partnerExternalUrlRoDiv');   
	
	hideIndicator();
}

function closeToEditPartner(){

	showIndicator();
	setReadOnly( true );

	defaultCloseToEditToolbar();

	hideDiv('partnerPartnerNameFieldDiv');    
	hideDiv('partnerExternalUrlFieldDiv');    

    showDiv('partnerPartnerNameRoDiv');    
    showDiv('partnerExternalUrlRoDiv');    
    
    onTabContentLoaded('main', tabBarMainObj);
	
	hideIndicator();
	setActionDescription('view');
}

function loadPartner( partnerId, readOnly ){

	if( partnerId==null )
		partnerId = gridboxObj.cells( gridboxObj.getSelectedId(), 0 ).getValue();

	setReadOnly(readOnly);

	if( readOnly )
		closeToEditPartner();
	else
		openToEditPartner();

	$('partnerId').value = partnerId;
	
	var successFunc = function(t) {
		
		var content = t.responseText;

		populatePartnerFields(content);
		
		tabBarMainObj.setTabActive('main');

		openRecord();
		
		onTabContentLoaded('main', tabBarMainObj);		
		
		if( isReadOnly() )			
			defaultCloseToEditToolbar();
		else
			defaultOpenToEditToolbar();
		
		hideIndicator();
		showDiv('toolbarActionDiv');
	};
		
	var failureFunc = function(t) {

		var content = t.responseText;
		
		alert('Não foi possível carregar as informações do registro selecionado!');
		if( isDebug() )
			debug( content );
		
		hideIndicator();
	};

	showIndicator();

	var urlAjax = _webRoot+'/partner/getInfo/partnerId/'+partnerId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function populatePartnerFields( content ){

	var partnerObj = parseInfo(content);

	$('partnerPartnerNameRoDiv').innerHTML = partnerObj.partnerName;
	$('partnerExternalUrlRoDiv').innerHTML = partnerObj.externalUrl;
	
	$('partnerPartnerName').value = partnerObj.question;
	$('partnerExternalUrl').value = partnerObj.externalUrl;
	
	setActionDescription( (isReadOnly()?'Visualizando':'Editando'), partnerObj.partnerName );
}