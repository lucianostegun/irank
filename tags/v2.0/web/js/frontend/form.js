function showFormErrorDetails(form, field){
	
//	var errorMessage = $(form+ucfirst(field)+'Label').innerHTML+':</b><br/><br/>'+$(form+ucfirst(field)).title;
	var errorMessage = $(form+ucfirst(field)+'Label').innerHTML+':\n'+$(form+ucfirst(field)).title;
//	errorMessage = errorMessage.replace(/\n/g, '<br/><br/>');

	alert(errorMessage);
//	$('formErrorDetails'+ucfirst(form)).innerHTML = '<h1 class="formDetailsTitle">Detalhes do erro</h1><b>'+errorMessage;
}

function handleFormFieldError( content, formId, prefix, alertMessage, indicatorId, handleFunc ){

	clearFormFieldErrors( formId );

	hideIndicator( indicatorId );
	hideIndicator( formId );

	var info = content.split(';');

	if( info[0]=='formError' ){
	
		for( var fieldErrorIndex=1; fieldErrorIndex < info.length; fieldErrorIndex++ ){

			var ignoreHidden     = false;
			var fieldInfo        = info[fieldErrorIndex].split('|');
			var formFieldId      = fieldInfo[0];
			var formFieldMessage = fieldInfo[1];
			
			var formFieldMessageSplit = formFieldMessage.split('] ');

			if( formFieldMessageSplit.length > 1 ){

				formFieldId      = formFieldMessageSplit[0];
				formFieldId      = formFieldId.substring(1, formFieldId.length);
				
				formFieldMessage = formFieldMessageSplit[1];
				ignoreHidden     = true;
				
				if( (/^[a-zA-Z]+[a-zA-Z0-9_]*\([a-zA-Z0-9_\'\"]*\)/).exec(formFieldId) )
					eval(formFieldId+';');
			}
			
			formFieldId = prefix+ucfirst(formFieldId);

			objectForm  = $(formFieldId);
			
			var isDiv = false;
			
			if( objectForm==null || objectForm!=null && (objectForm.type=='hidden' || objectForm.type=='file') && ignoreHidden==false ){

				if(matches=formFieldMessage.match(/^\[[a-zA-Z]+\]/)){

					divName     = matches[0];
					formFieldId = divName.replace(/[\[\]]/g, '');
					formFieldId = prefix+ucfirst(formFieldId);
				}
				
				isDiv = true;
				objectForm = $(formFieldId+'Div');
			}
			
			if( objectForm!=null ){
			
				var className = (isDiv?objectForm.className:'formField');
				className     = className.replace(/Error/g, '');
				className    += 'Error';

				formFieldMessage = formFieldMessage.replace(/\\n/g, ' '+chr(10));
				
				if( formFieldMessage=='nullError' )
					continue;

				objectForm.className = className;
				objectForm.title     = formFieldMessage;
				
				showDiv(formFieldId+'Error');
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
	
	var form = $( formId );
	
	for(i=0; i < form.length; i++){
		
		if( form[i].className=='formFieldError' ){
			
			form[i].className = '';
			form[i].title = '';
			
			hideDiv(form[i].id+'Error');
		}
	}
	
	var classNameList = ['fieldErrorDiv', 'textError', 'textFlexError', 'tableListError'];
	
	for(var i=0; i < classNameList.length; i++){
		
		var divList = document.getElementsByClassName(classNameList[i]);
	
		for(var i2=0; i2 < divList.length; i2++){
		
			var objectId  = divList[i2].id;
			$(objectId).className = $(objectId).className.replace(/Error/g, '');
			$(objectId).title     = '';
		}
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

function showFormHelp( fieldName ){

	helpMessage = $(fieldName+'Help').title;

	alert(helpMessage);
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

function parseError( message ){
	
	if( /^!/.test(message) )
		return '\n'+message.replace('!', '');
	
	return '';
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