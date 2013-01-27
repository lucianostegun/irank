function showFormErrorDetails(form, field){
	
//	var errorMessage = $(form+ucfirst(field)+'Label').innerHTML+':</b><br/><br/>'+$(form+ucfirst(field)).title;
	var errorMessage = $(form+ucfirst(field)+'Label').innerHTML+':\n'+$(form+ucfirst(field)).title;
//	errorMessage = errorMessage.replace(/\n/g, '<br/><br/>');

	alert(errorMessage);
//	$('formErrorDetails'+ucfirst(form)).innerHTML = '<h1 class="formDetailsTitle">Detalhes do erro</h1><b>'+errorMessage;
}

function handleFormFieldError( content, formId, prefix, alertMessage, indicatorId, handleFunc, showErrors ){

	clearFormFieldErrors( formId );

	hideIndicator( indicatorId );
	hideIndicator( formId );

	var info = content.split(';');

	if( (/^formError:/).test(content) ){
		
		content = content.replace(/^formError:/, '');
	
		var formErrorObj    = parseInfo(content);
		var fieldNameList   = formErrorObj._fieldNameList
		var fieldErrorCount = formErrorObj._fieldErrorCount
		
		for(var i=0; i < fieldErrorCount; i++){

			var ignoreHidden = false;
			var fieldName    = fieldNameList[i];
		    var errorMessage = formErrorObj[fieldName];
			
			var errorMessageSplit = errorMessage.split('] ');

			if( errorMessageSplit.length > 1 ){

				fieldName      = errorMessageSplit[0];
				fieldName      = fieldName.substring(1, fieldName.length);
				
				errorMessage = formFieldMessageSplit[1];
				ignoreHidden = true;
				
				if( (/^[a-zA-Z]+[a-zA-Z0-9_]*\([a-zA-Z0-9_\'\"]*\)/).exec(fieldName) )
					eval(fieldName+';');
			}
			
			var formFieldId = prefix+ucfirst(fieldName);
			
			objectForm  = $(formFieldId);
			
			var isDiv = false;
			
			if( objectForm==null || objectForm!=null && (objectForm.type=='hidden' || objectForm.type=='file') && ignoreHidden==false ){

				if(matches=errorMessage.match(/^\[[a-zA-Z]+\]/)){

					divName     = matches[0];
					formFieldId = divName.replace(/[\[\]]/g, '');
					formFieldId = prefix+ucfirst(formFieldId);
				}
				
				isDiv = true;
				objectForm = $(formFieldId+'Div');
				
				if( showErrors && $(formFieldId+'Error')!=null )
					$(formFieldId+'Error').innerHTML = errorMessage
			}
			
			if( objectForm!=null ){
			
				var className = (isDiv?objectForm.className:'formField');
				className     = className.replace(/Error/g, '');
				className    += 'Error';

				errorMessage = errorMessage.replace(/\\n/g, ' '+chr(10));
				
				if( errorMessage=='nullError' )
					continue;

				objectForm.addClassName(className);
				objectForm.title = errorMessage;
				
				showDiv(formFieldId+'Error');
				
				if( showErrors )
					$(formFieldId+'Error').innerHTML = errorMessage
			}
		}

		if(alertMessage)
			alert('Ocorreu um erro ao salvar as informações!\nVerifique e corrija os campos em destaque e tente novamente');
		else
			showFormStatusError(prefix);
	}else{
		
		if( handleFunc )
			return handleFunc(content);
		
		if( errorMessage=parseMessage(content) )
			alert(errorMessage);
		else
			if( isDebug() )
				debug( content );
	}	
}

function addFormStatusError(fieldId, formFieldMessage){
	
	var objectForm = $(fieldId);
	
	var className = 'formField';
	className     = className.replace(/Error/g, '');
	className    += 'Error';

	formFieldMessage = formFieldMessage.replace(/\\n/g, ' '+chr(10));
	
	objectForm.className = className;
	objectForm.title     = formFieldMessage;
}

function removeFormStatusError(fieldId){
	
	var objectForm = $(fieldId);
	objectForm.removeClassName('formFieldError');
	objectForm.title = '';
}

function showFormStatusError(formId){
	
	var divError = $('formStatusError'+ucfirst(formId)+'Div')

	if( divError==null )
		formId = false;
	
	formId = (formId?formId:'');
	
	if( !formId ){
		
		hideDiv('formStatusSuccessDiv');
		showDiv('formStatusErrorDiv');
		hideDiv('actionDescriptionDiv');
	}else{
	
		hideDiv('formStatusSuccess'+ucfirst(formId)+'Div');
		showDiv('formStatusError'+ucfirst(formId)+'Div');
	}
}

function hideFormStatusError(formId){
	
	if( !formId ){

		hideDiv('formStatusErrorDiv');
		showDiv('actionDescriptionDiv');
	}else{
		
		hideDiv('formStatusError'+ucfirst(formId)+'Div');
	}
}

function clearFormFieldErrors( formId ){

	hideIndicator();
	
	if( !formId || $(formId)==null )
		return;
	
	var formObj = $( formId );
	
	var classNameList = ['formFieldError', 'fieldErrorDiv', 'textError', 'text flex error', 'tableListError'];
	
	for(var i=0; i < classNameList.length; i++){
		
		var className   = classNameList[i];
		var elementList = formObj.getElementsByClassName(className);
	
		for(var i2=(elementList.length-1); i2 >= 0; i2--)
			elementList[i2].removeClassName(className);
	}
	
	hideFormStatusError(formId)
}

var _hideFormStatusSuccessDelay = 0;

function showFormStatusSuccess(formId){

	formId = (formId?formId:'');
	
	if( !formId ){

		hideIndicator();
		hideDiv('formStatusErrorDiv');
		showDiv('formStatusSuccessDiv');
		hideDiv('actionDescriptionDiv');
	}else{
	
		clearFormFieldErrors( formId );
		
		hideIndicator(formId);
		hideDiv('formStatusError'+ucfirst(formId)+'Div');
		showDiv('formStatusSuccess'+ucfirst(formId)+'Div');
	}
	
	if( _hideFormStatusSuccessDelay==0 )
		startHideFormStatusSuccess(9, formId);
	else
		_hideFormStatusSuccessDelay = 10;
}

function startHideFormStatusSuccess(delay, formId){

	if( delay )
		_hideFormStatusSuccessDelay += delay;
	else
		_hideFormStatusSuccessDelay--;

	if( _hideFormStatusSuccessDelay==0 )
		hideFormStatusSuccess(formId);
	else
		window.setTimeout( 'startHideFormStatusSuccess(false, "'+formId+'")', 1000 );
}

function hideFormStatusSuccess(formId){

	formId = (formId?formId:'');
	
	if( !formId ){
		
		hideDiv('formStatusSuccessDiv');
		if( isVisible('formStatusErrorDiv') )
			return;
		showDiv('actionDescriptionDiv');
	}else{
		
		hideDiv('formStatusSuccess'+ucfirst(formId)+'Div');
	}
	_hideFormStatusSuccessDelay = 0;
}

function getEmptySelectField( defaultLabel ){

	if( !defaultLabel )
		defaultLabel= 'Selecione';
		
	return '<select><option>'+defaultLabel+'</option></select>';
}

function checkButton( buttonId ){

	buttonId = ucfirst(buttonId);
	
	if( $('button'+buttonId)==null )
		return false;
	
	var disabled = $('button'+buttonId).className == 'buttonDisabled';

	return !disabled;
}

function checkboxReadOnly( checkboxObj ){

	if( isReadOnly() )
		checkboxObj.checked = !checkboxObj.checked;
	else
		return true;
}

function hideHelpDescriptions(){

	var helpList = document.getElementsByClassName('formHelpDescription');

	for(i=0; i < helpList.length; i++)
		hideDiv(helpList[i].id);
}

function showFormHelp(Element){
	
	form        = Element.id.replace(ucfirst(Element.name), '');
	var fieldId = Element.id.replace(form, '');
	
	if( $(form+ucfirst(fieldId)+'Help')==null )
		return hideFormHelp(Element);
		
	var fieldName    = $(form+ucfirst(fieldId)+'Label').innerHTML;
	var errorMessage = $(form+ucfirst(fieldId)+'Help').title;
	
	errorMessage = errorMessage.replace(/\\n/g, '<br/><br/>');
	
	$('formHelperFieldName'+ucfirst(form)).innerHTML   = fieldName;
	$('formHelperDescription'+ucfirst(form)).innerHTML = errorMessage;
	
	var formHeight = $(form).offsetHeight;
	var top        = (Element.offsetTop-8);
	var height     = $('formHelp'+ucfirst(form)).getHeight();
	
	if( top+height > formHeight ){
		
		top -= height-60;
		$('helpDisclosure'+ucfirst(form)).style.top = (height-48)+'px';
	}else{
		
		$('helpDisclosure'+ucfirst(form)).style.top = '';
	}
		
	$('formHelp'+ucfirst(form)).style.top = top+'px';
	showDiv('formHelp'+ucfirst(form))
}

function hideFormHelp(Element){
	
	form = Element.id.replace(ucfirst(Element.name), '');
	hideDiv('formHelp'+ucfirst(form))
}

function goToField( value, length, fieldId, event ){

	var keyCode = event.keyCode;
	
	if( keyCode==9 || keyCode==16 || keyCode==17 || keyCode==37 ||
		keyCode==38 || keyCode==39 || keyCode==40 )
		return true;
	
	if( value.length==length ){
		
		$(fieldId).focus();
		if( $(fieldId).type=='text' || $(fieldId).type=='textarea')
			$(fieldId).select();
	}
}

function toggleLabels(){

	var labelDivList = document.getElementsByClassName('labelRoEdit');

	for(var i=0; i < labelDivList.length; i++)
		labelDivList[i].className = 'label';
}

function openToEditCheckbox(){
	
	var checkboxImageList = document.getElementsByClassName('checkboxImage');
    for(var i=0; i < checkboxImageList.length; i++)
    	checkboxImageList[i].style.display = 'none';
    
    var checkboxFieldList = document.getElementsByClassName('checkboxField');
    for(var i=0; i < checkboxFieldList.length; i++)
    	checkboxFieldList[i].style.display = 'block';
}

function closeToEditCheckbox(){
	
	var checkboxImageList = document.getElementsByClassName('checkboxImage');
    for(var i=0; i < checkboxImageList.length; i++)
    	checkboxImageList[i].style.display = 'block';
    
    var checkboxFieldList = document.getElementsByClassName('checkboxField');
    for(var i=0; i < checkboxFieldList.length; i++)
    	checkboxFieldList[i].style.display = 'none';
}

function handleSubmitEnter(evt, executeFunction){
	
	var obj;
    
    if( navigator.appName.indexOf('Netscape') != -1 )
    	obj = evt.target;
    else
    	obj = evt.srcElement;
    
	if( evt.keyCode==13 )
		executeFunction();
}