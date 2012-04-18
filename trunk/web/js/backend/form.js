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
           
           if( $('#'+instanceName+ucfirst(fieldName))!=null ){
        	  
               $('#'+instanceName+ucfirst(fieldName)).attr('title', errorMessage);
               $('#'+instanceName+ucfirst(fieldName)).attr('class', 'fieldError');
           }
       }
	}else{
		
       alert('Não foi possível concluir seu cadastro!\nPor favor, tente novamente.');
	}
}

function clearFormFieldErrors(formId){

   var formObj = document.getElementById(formId+'Form');
   
   var errorList = formObj.getElementsByClassName('fieldError');

   for(var i=0; i < errorList.length; i++)
	   errorList[i].innerHTML = '';
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