$(function() {
	
	var productCategoryId  = $('#productCategoryId').val();
	var urlAjax = _webRoot+'/productCategory/uploadPhotos?productCategoryId='+productCategoryId;
});

function handleSuccessProductCategory(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
	
	mainRecordName = $('#productCategoryCategoryName').val();
	
	updateMainRecordName(mainRecordName, true);
}

function handleFailureProductCategory(content){
	
	handleFormFieldError(content, 'productCategory');
}