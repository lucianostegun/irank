$(function() {
	
	var productId = $('#productId').val();
	var urlAjax   = _webRoot+'/product/uploadPhotos?productId='+productId;
});

function handleSuccessProduct(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
	
	mainRecordName = $('#productProductName').val();
	
	updateMainRecordName(mainRecordName, true);
}

function handleFailureProduct(content){
	
	handleFormFieldError(content, 'product');
}

function submitProductImage(imageIndex){
	
	for(var i=1; i <= 5; i++){
		
		if( i!=imageIndex )
			$('#productFilePathImage-'+i).val('');
	}
	
	var productCode = $('#productProductCode').val();
	
	if( !productCode )
		return alert('O código do produto ainda não foi definido!');
	
	$('#productImageProductCode').val(productCode);
	$('#productImageIndex').val(imageIndex);
	$('#productImageForm').submit();
}

function handleUploadFileSuccessProductImage(fileName, imageIndex){
	
	$('#productImage-'+imageIndex).attr('src', _imageRoot+'/store/product/preview/'+fileName+'?time='+time());
	
	if( imageIndex==1 )
		$('#productImage1').val(fileName);
}