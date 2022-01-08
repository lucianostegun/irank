function handleSuccessBlogCategory(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
	
	mainRecordName = $('#blogDescription').val();
	
	updateMainRecordName(mainRecordName, true);
}

function handleFailureBlogCategory(content){
	
	handleFormFieldError(content, 'blogCategory');
}