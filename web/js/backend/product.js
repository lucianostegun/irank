function handleSuccessProduct(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
	
	mainRecordName = $('#productProductName').val();
	
	updateMainRecordName(mainRecordName, true);
}

function handleFailureProduct(content){
	alert(content);
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
	$('#product'+(isItem?'Item':'')+'ImageArea-'+imageIndex).removeClass('empty');
	
	if( imageIndex==1 )
		$('#product'+(isItem?'Item':'')+'Image1').val(fileName);
}

function deleteProductImage(imageIndex, isItem){

	if( !confirm('Deseja realmente excluir a imagem '+imageIndex+'?') )
		return;
	
	showIndicator();
	
	var objectId = $('#product'+(isItem?'Item':'')+'Id').val();

	var successFunc = function(content){
		
		hideIndicator();
		$('#product'+(isItem?'Item':'')+'Image-'+imageIndex).attr('src', '');
		$('#product'+(isItem?'Item':'')+'ImageArea-'+imageIndex).addClass('empty');
	}

	var failureFunc = function(t){
		
		hideIndicator();
		
		var errorMessage = parseMessage(t.responseText);
		errorMessage = (errorMessage?errorMessage:'\nPor favor, tente novamente.');
		
		alert('Não foi possível excluir a imagem selecionada!\n'+errorMessage);
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/product/deleteImage/product'+(isItem?'Item':'')+'Id/'+objectId+'/imageIndex/'+imageIndex;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}