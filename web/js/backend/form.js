$(function() {
	
	clearFormFieldErrors();
});



function updateMainRecordName(){
	
}

function handleFormFieldError( content, instanceName ){

	if( (/^formError:/).test(content) ){

       clearFormFieldErrors(instanceName);

       content = content.replace(/^formError:/, '');

       var formErrorObj    = parseInfo(content);
       var fieldNameList   = formErrorObj._fieldNameList
       var fieldErrorCount = formErrorObj._fieldErrorCount

       for(var i=0; i < fieldErrorCount; i++){

           var fieldName    = fieldNameList[i];
           var errorMessage = formErrorObj[fieldName];
           
           if( (/^\[([a-zA-Z0-9]*)\]/).test(errorMessage) ){
        	   
        	   var matches = errorMessage.match(/^\[([a-zA-Z0-9]*)\]/)
        	   fieldName   = matches[1];
        	   
        	   errorMessage = errorMessage.replace(matches[0], '');
        	   errorMessage = errorMessage.replace('form.error.requiredField', 'Este campo é obrigatório e não foi preenchido');
        	   errorMessage = Trim(errorMessage);
           }
           
//           if( $('#'+instanceName+ucfirst(fieldName))!=null ){
//        	  
//               $('#'+instanceName+ucfirst(fieldName)).attr('title', errorMessage);
//               $('#'+instanceName+ucfirst(fieldName)).attr('class', 'fieldError');
//           }
           if( $('#'+instanceName+'FormError'+ucfirst(fieldName))!=null ){
        	   
        	   $('#'+instanceName+'FormError'+ucfirst(fieldName)).html(errorMessage);
        	   $('#'+instanceName+'FormError'+ucfirst(fieldName)).show();
           }
       }
	}else{
		
       alert('Não foi possível concluir seu cadastro!\nPor favor, tente novamente.');
       
       if( isDebug() )
    	   debug(content)
	}
}

function clearFormFieldErrors(formId){

	if( !formId )
		formId = getModuleName();
	
//	var formObj = document.getElementById(formId+'Form');
//	
//	if( formObj==null )
//		return;
	
	var errorList = $('#'+formId+'Form .formNote.error');
	
	errorList.each(function(index, Element){
		$(Element).hide();
	});
//	for(var index2=0; index2 < errorList.length; index2++){
//		errorList[index2].className = 'formNote error';
//		alert(errorList[index2].className);
//	}
}

function hideFormStatusSuccess(){

	debugAdd('hideFormStatusSuccess')
}

function showFormStatusSuccess(){

	debugAdd('showFormStatusSuccess')
}

function hideFormStatusError(){
	
	debugAdd('hideFormStatusError')
}

function showFormStatusError(){
	
	debugAdd('showFormStatusError')
}