function handleSuccessProductItem(content){

	var productItemObj = parseInfo(content);
	
	$('#productStock').html(productItemObj.productStock);
	clearFormFieldErrors('productItem');
	showFormStatusSuccess();
	
	if( productItemObj.reloadTable )
		updateProductItemTable();
	
	$('#deleteProductItemLink').removeClass('hidden');
}

function handleFailureProductItem(content){
	
	handleFormFieldError(content, 'productItem');
}

function addProductItem(){
	
	showIndicator();
	
	var productId = $('#productId').val();

	var successFunc = function(content){
		
		var productItemObj = parseInfo(content);
		
		$('#productItemImage-1').attr('src', _imageRoot+'/blank.png');
		$('#productItemImage-2').attr('src', _imageRoot+'/blank.png');
		$('#productItemImage-3').attr('src', _imageRoot+'/blank.png');
		$('#productItemImage-4').attr('src', _imageRoot+'/blank.png');
		$('#productItemImage-5').attr('src', _imageRoot+'/blank.png');
		
		resetForm($('#productItemForm'));
		
		$('#productItemId').val(productItemObj.id);
		$('#productItemImageProductItemId').val(productItemObj.id);
		
		$('#productItemPrice').val($('#productDefaultPrice').val());
		$('#productItemWeight').val($('#productDefaultWeight').val());
		
		
		showProductItemForm(true);
		
		$.uniform.update();
		
		hideIndicator();
	}

	var failureFunc = function(t){
		
		hideIndicator();
		
		var errorMessage = parseMessage(t.responseText);
		errorMessage = (errorMessage?errorMessage:'\nPor favor, tente novamente.');
		
		alert('Não foi possível iniciar o cadastro de um novo item!\n'+errorMessage);
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/product/getNewProductItem/productId/'+productId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}

function loadProductItem(productItemId){
	
	showIndicator();
	
	
	var successFunc = function(content){
		
		var productItemObj = parseInfo(content);
		
		$('#productItemImage-1').attr('src', _imageRoot+'/store/product/preview/'+productItemObj.image1+'?time='+time());
		$('#productItemImage-2').attr('src', _imageRoot+'/store/product/preview/'+productItemObj.image2+'?time='+time());
		$('#productItemImage-3').attr('src', _imageRoot+'/store/product/preview/'+productItemObj.image3+'?time='+time());
		$('#productItemImage-4').attr('src', _imageRoot+'/store/product/preview/'+productItemObj.image4+'?time='+time());
		$('#productItemImage-5').attr('src', _imageRoot+'/store/product/preview/'+productItemObj.image5+'?time='+time());
		
		$('#productItemId').val(productItemObj.id);
		$('#productItemImageProductItemId').val(productItemObj.id);
		
		$('#productItemProductOptionIdColor').val(productItemObj.productOptionIdColor);
		$('#productItemProductOptionIdSize').val(productItemObj.productOptionIdSize);
		$('#productItemPrice').val(toCurrency(productItemObj.price));
		$('#productItemWeight').val(toCurrency(productItemObj.weight));
		$('#productItemStock').val(productItemObj.stock);
		
		$('#productItemImage1').val(productItemObj.image1);
		
		showProductItemForm(false);
		
		$.uniform.update();
		
		hideIndicator();
	}
	
	var failureFunc = function(t){
		
		hideIndicator();
		
		var errorMessage = parseMessage(t.responseText);
		errorMessage = (errorMessage?errorMessage:'\nPor favor, tente novamente.');
		
		alert('Não foi possível carregar as informações do item selecionado!\n'+errorMessage);
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/product/getProductItem/productItemId/'+productItemId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}

function deleteProductItem(){
	
	if( !confirm('ATENÇÃO!\nTem certeza que deseja excluir este item?') )
		return;

	if( $('#productItemStock').val()*1 > 0 && !confirm('ATENÇÃO!\nAo excluir este item o estoque do produto será reduzido!\nDeseja realmente excluir este item?') )
		return;
	
	showIndicator();
	
	var productItemId = $('#productItemId').val();
	
	var successFunc = function(content){
		
		$('#productStock').html(content);
		
		$('#productItemIdRow-'+productItemId).remove();
		hideProductItemForm();
		
		hideIndicator();
	}

	var failureFunc = function(t){
		
		hideIndicator();
		
		var errorMessage = parseMessage(t.responseText);
		errorMessage = (errorMessage?errorMessage:'\nPor favor, tente novamente.');
		
		alert('Não foi possível excluir este item!\n'+errorMessage);
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	var urlAjax = _webRoot+'/product/deleteProductItem/productItemId/'+productItemId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}

function updateProductItemTable(){
	
	var productId = $('#productId').val();
	
	var successFunc = function(content){
		
		$('#productItemListDiv').html(content);
	}
	
	var failureFunc = function(t){
		
	}
	
	var urlAjax = _webRoot+'/product/getProductItemList/productId/'+productId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}

function showProductItemForm(isNew){
	
	$('#productItemListDiv').hide();
	$('#productItemFormDiv').show();
	$('#addProductItemLink').addClass('hidden');
	$('#saveProductItemLink').removeClass('hidden');
	$('#cancelAddProductItemLink').removeClass('hidden');
	
	if( !isNew )
		$('#deleteProductItemLink').removeClass('hidden');
}

function hideProductItemForm(){
	
	$('#productItemListDiv').show();
	$('#productItemFormDiv').hide();
	$('#addProductItemLink').removeClass('hidden');
	$('#saveProductItemLink').addClass('hidden');
	$('#cancelAddProductItemLink').addClass('hidden');
	$('#deleteProductItemLink').addClass('hidden');
}

function submitProductItemImage(imageIndex){
	
	for(var i=1; i <= 5; i++){
		
		if( i!=imageIndex )
			$('#productItemFilePathImage-'+i).val('');
	}
	
	var productItemCode = $('#productProductCode').val();
	
	if( !productCode )
		return alert('O código do produto ainda não foi definido!');
	
	$('#productItemImageProductCode').val(productCode);
	$('#productItemImageIndex').val(imageIndex);
	$('#productItemImageForm').submit();
}