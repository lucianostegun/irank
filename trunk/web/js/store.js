function loadProductPreview(fileName){
	
	$('productImagePreview').src = _imageRoot+'/store/product/'+fileName;
	$('productImageZoom').href   = _imageRoot+'/store/product/full/'+fileName;
}

function removeProductFromCart(productItemId){
	
	var successFunc = function(t){

		var content = t.responseText;
		var cartSessionObj = parseInfo(content);
		
		$('shippingValue').innerHTML   = 'R$ '+toCurrency(cartSessionObj.shippingValue);
		$('orderTotalValue').innerHTML = 'R$ '+toCurrency(cartSessionObj.totalValue);
		
		row = $('cartProductItem-'+productItemId);
		row.parentNode.removeChild(row);
		
		var rows = document.getElementsByClassName('productItemRow');
		if( rows.length==0 )
			showDiv('cartEmptyRow', 'table-row');
	};
		
	var failureFunc = function(t){

		var content = t.responseText;
		alert('ATENÇÃO!\n\nOcorreu um erro ao remover o item do carrinho!\nPor favor, tente novamente.');
	};
	
	var urlAjax = _webRoot+'/store/removeItem/productItemId/'+productItemId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}