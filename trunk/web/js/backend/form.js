function handleFormFieldError( content, prefix, alertMessage, indicatorId, handleFunc ){

	clearFormFieldErrors( prefix );
	
	hideIndicator( prefix );

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

			fieldObj  = $(formFieldId);
			
			var isDiv = false;
			
			if( fieldObj==null || fieldObj!=null && (fieldObj.type=='hidden' || fieldObj.type=='file') && ignoreHidden==false ){

				if(matches=formFieldMessage.match(/^\[[a-zA-Z]+\]/)){

					divName     = matches[0];
					formFieldId = divName.replace(/[\[\]]/g, '');
					formFieldId = prefix+ucfirst(formFieldId);
				}
				
				isDiv = true;
				fieldObj = $(formFieldId+'Div');
			}
			
			if( fieldObj!=null ){
			
				var className = (isDiv?fieldObj.className:'formField');
				className     = className.replace(/Error/g, '');
				className    += 'Error';

				formFieldMessage = formFieldMessage.replace(/\\n/g, ' '+chr(10));
				
				if( formFieldMessage=='nullError' )
					continue;

				fieldObj.className = className;
				fieldObj.title     = formFieldMessage;
				
				showDiv(formFieldId+'Error');
			}
		}

		if(alertMessage)
			alert('Ocorreu um erro ao salvar as informações!\nVerifique e corrija os campos em destaque e tente novamente');
		else
			showFormStatusError(prefix);
	}else{
		
		if( prefix )
			showFormStatusError(prefix);
		
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
	
	var fieldObj = $(fieldId);
	
	var className = 'formField';
	className     = className.replace(/Error/g, '');
	className    += 'Error';

	formFieldMessage = formFieldMessage.replace(/\\n/g, ' '+chr(10));
	
	fieldObj.className = className;
	fieldObj.title     = formFieldMessage;
}

function showFormStatusError(prefix){
	
	showDiv(prefix+'HeaderError');
	showDiv(prefix+'FooterError');
	hideFormStatusSuccess(prefix);

	if( $(prefix+'Header')!=null )
		$(prefix+'Header').addClassName('error');
	
	$(prefix+'Footer').addClassName('error');
}

function hideFormStatusError(prefix){
	
	hideDiv(prefix+'HeaderError');
	hideDiv(prefix+'FooterError');

	if( $(prefix+'Header')!=null )
		$(prefix+'Header').removeClassName('error');
	
	$(prefix+'Footer').removeClassName('error');
}

function clearFormFieldErrors( prefix ){

	hideIndicator(prefix);
	
	if( !prefix || $(prefix+'Form')==null )
		return;
	
	var form = $( prefix+'Form' );
	
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
		}
	}
	
	hideFormStatusError(prefix)
}

var _hideFormStatusSuccessDelay = 0;

function showFormStatusSuccess(prefix){

	hideIndicator(prefix+'HeaderIndicator');
	hideIndicator(prefix+'FooterIndicator');
	showDiv(prefix+'HeaderSuccess');
	showDiv(prefix+'FooterSuccess');
	hideFormStatusError(prefix);
	
	if( $(prefix+'Header')!=null )
		$(prefix+'Header').addClassName('success');
	
	$(prefix+'Footer').addClassName('success');
	
	if( _hideFormStatusSuccessDelay==0 )
		startHideFormStatusSuccess(9, prefix);
	else
		_hideFormStatusSuccessDelay = 10;
}

function startHideFormStatusSuccess(delay, prefix){

	if( delay )
		_hideFormStatusSuccessDelay += delay;
	else
		_hideFormStatusSuccessDelay--;

	if( _hideFormStatusSuccessDelay==0 )
		hideFormStatusSuccess(prefix);
	else
		window.setTimeout( 'startHideFormStatusSuccess(false, "'+prefix+'")', 1000 );
}

function hideFormStatusSuccess(prefix){

	hideDiv(prefix+'HeaderSuccess');
	hideDiv(prefix+'FooterSuccess');
	
	if( $(prefix+'Header')!=null )
		$(prefix+'Header').removeClassName('success');
	
	$(prefix+'Footer').removeClassName('success');

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