function handleSuccessProductCategory(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
	
	mainRecordName = $('#productCategoryCategoryName').val();
	
	updateMainRecordName(mainRecordName, true);
}

function handleFailureProductCategory(content){
	
	handleFormFieldError(content, 'productCategory');
}