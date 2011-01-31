function preSaveFaq(){
	
	$('gridboxI18nData').value = gridboxI18nObj.serialize();
}

function handleSuccessFaq(content){

	clearFormFieldErrors( 'mainForm' );
	showFormStatusSuccess()
	defaultSuccessToolbar();

	var recordName = $('faqQuestion').value;
	setActionDescription('Editando', recordName);
}

function getNewFaq(){

	disableToolbar('new');

	var successFunc = function(t) {

		var content = t.responseText;
		
		openToEditFaq();
		setActionDescription('new');
	
		clearFormFieldErrors('mainForm');
		hideFormStatusError();
		hideFormStatusSuccess();

		defaultGetNewRecordToolbar();

		$('faqId').value       = content;
		$('faqQuestion').value = '';
		
		openRecord();

		tabBarMainObj.setTabActive('main');
		onTabContentLoaded('main', tabBarMainObj);
		
		$('faqQuestion').focus();
		
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

	var urlAjax = _webRoot+'/home/getNewId/className/faq';
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function openToEditFaq(){

	showIndicator();
	setReadOnly( false );
	setActionDescription('edit');

	defaultOpenToEditToolbar();
	
	showDiv('faqQuestionFieldDiv');

	hideDiv('faqQuestionRoDiv');   
	
	hideIndicator();
}

function closeToEditFaq(){

	showIndicator();
	setReadOnly( true );

	defaultCloseToEditToolbar();

	hideDiv('faqQuestionFieldDiv');    

    showDiv('faqQuestionRoDiv');    
    
    onTabContentLoaded('main', tabBarMainObj);
	
	hideIndicator();
	setActionDescription('view');
}

function loadFaq( faqId, readOnly ){

	if( faqId==null )
		faqId = gridboxObj.cells( gridboxObj.getSelectedId(), 0 ).getValue();

	setReadOnly(readOnly);

	if( readOnly )
		closeToEditFaq();
	else
		openToEditFaq();

	$('faqId').value = faqId;
	
	var successFunc = function(t) {
		
		var content = t.responseText;

		reloadI18nGridbox(faqId);
		
		populateFaqFields(content);
		
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
		
		alert( 'Não foi possível carregar as informações do registro selecionado!' );
		if( isDebug() )
			debug( content );
		
		hideIndicator();
	};

	showIndicator();

	var urlAjax = _webRoot+'/faq/getInfo/faqId/'+faqId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function populateFaqFields( content ){

	var faqObj = parseInfo(content);

	$('faqQuestionRoDiv').innerHTML = faqObj.question;
	
	$('faqQuestion').value = faqObj.question;
	
	setActionDescription( (isReadOnly()?'Visualizando':'Editando'), faqObj.question );
}

function reloadI18nGridbox(faqId){
	
	var xmlUrl = getXmlUrlI18n();
	xmlUrl = xmlUrl.replace(/\/?[0-9]*$/g, '');
	xmlUrl = xmlUrl+'/'+faqId;

	loadGridboxI18n(xmlUrl);
}

function handleFaqAnswer(stage, rowId){
	
//	var answer = gridboxI18nObj.cells(rowId, 2).getValue();
//	answer     = answer.replace(/&lt;/g, '<');
//	answer     = answer.replace(/&gt;/g, '>');
//	
//	gridboxI18nObj.cells(rowId, 2).setValue(answer);
	
	return true;
}