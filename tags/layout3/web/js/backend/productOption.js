$(function() {
	
});

function handleSuccessProductOption(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
	
	mainRecordName = $('#productOptionOptionName').val();
	
	updateMainRecordName(mainRecordName, true);
}

function handleFailureProductOption(content){
	
	handleFormFieldError(content, 'productOption');
}

function handleIsDefaultProductOption(checked){
	
	if( checked )
		$('#productFormIsNewWarning').show();
	else
		$('#productFormIsNewWarning').hide();
}