function handleSuccessProduct(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
	
	mainRecordName = $('#productProductName').val();
	
	updateMainRecordName(mainRecordName, true);
}

function handleFailureProduct(content){
	
	handleFormFieldError(content, 'product');
}

function submitProductImage(imageIndex, isItem){
	
	for(var i=1; i <= 5; i++){
		
		if( i!=imageIndex )
			$('#product'+(isItem?'Item':'')+'FilePathImage-'+i).val('');
	}
	
	var productCode = $('#productProductCode').val();
	
	if( !productCode )
		return alert('O código do produto ainda não foi definido!');
	
	$('#product'+(isItem?'Item':'')+'ImageProductCode').val(productCode);
	$('#product'+(isItem?'Item':'')+'ImageIndex').val(imageIndex);
	$('#product'+(isItem?'Item':'')+'ImageForm').submit();
}

function handleUploadFileSuccessProductImage(fileName, imageIndex, isItem){
	
	$('#product'+(isItem?'Item':'')+'Image-'+imageIndex).attr('src', _imageRoot+'/store/product/preview/'+fileName+'?time='+time());
	
	if( imageIndex==1 )
		$('#product'+(isItem?'Item':'')+'Image1').val(fileName);
}