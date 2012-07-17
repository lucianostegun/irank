function loadProductPreview(fileName){
	
	$('productImagePreview').src = _imageRoot+'/store/product/'+fileName;
	$('productImageZoom').href   = _imageRoot+'/store/product/full/'+fileName;
}

function updateItemQuantity(productItemId, quantity){
	
	showIndicator();
	
	var successFunc = function(t){
		
		var content        = t.responseText;
		var cartSessionObj = parseInfo(content);
		
		updateCartItem(cartSessionObj, productItemId);
		hideIndicator();
	};
	
	var failureFunc = function(t){
		
		var content = t.responseText;
		hideIndicator();
	};
	
	var urlAjax = _webRoot+'/store/updateItemQuantity/productItemId/'+productItemId+'/quantity/'+quantity;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function updateCartQuantity(){
	
	showIndicator();
	
	var successFunc = function(t){

		var content        = t.responseText;
		var cartSessionObj = parseInfo(content);
		
		for(productItemId in cartSessionObj.productItemList)
			updateCartItem(cartSessionObj, productItemId);
		
		hideIndicator();
	};
		
	var failureFunc = function(t){

		var content = t.responseText;
		window.location = _webRoot+'/store/cart';
	};
	
	var urlAjax = _webRoot+'/store/updateCartQuantity';
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc, parameters:Form.serialize($('storeCartForm'))});
}

function updateCartItem(cartSessionObj, productItemId){
	
	if( typeof(cartSessionObj)!='object' )
		return;
	
	$('storeCartProductItemQuantity-'+productItemId).value       = cartSessionObj.productItemList[productItemId].quantity;
	$('storeCartProductItemTotalValue-'+productItemId).innerHTML = 'R$ '+toCurrency(cartSessionObj.productItemList[productItemId].totalValue);
	
	$('storeCartShippingValue').innerHTML = 'R$ '+toCurrency(cartSessionObj.shippingValue);
	$('storeCartTotalValue').innerHTML    = 'R$ '+toCurrency(cartSessionObj.totalValue);
}

function removeProductFromCart(productItemId){
	
	showIndicator();
	
	var successFunc = function(t){

		var content        = t.responseText;
		var cartSessionObj = parseInfo(content);
		
		$('storeCartShippingValue').innerHTML = 'R$ '+toCurrency(cartSessionObj.shippingValue);
		$('storeCartTotalValue').innerHTML    = 'R$ '+toCurrency(cartSessionObj.totalValue);
		
		row = $('cartProductItem-'+productItemId);
		row.parentNode.removeChild(row);
		
		var rows = document.getElementsByClassName('productItemRow');
		if( rows.length==0 )
			showDiv('cartEmptyRow', 'table-row');
		
		hideIndicator();
	};
		
	var failureFunc = function(t){

		var content = t.responseText;
		
		hideIndicator();
		alert('ATENÇÃO!\n\nOcorreu um erro ao remover o item do carrinho!\nPor favor, tente novamente.');
	};
	
	var urlAjax = _webRoot+'/store/removeItem/productItemId/'+productItemId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function selectProductOption(optionType, productOptionId){
	
	var elementList = document.getElementsByClassName('productOptionOption '+optionType+' selected');
	
	if( elementList.length > 0 )
		elementList[0].removeClassName('selected')

	$('productOption'+ucfirst(optionType)+'-'+productOptionId).addClassName('selected');
	$('productOptionId'+ucfirst(optionType)+'').value = productOptionId;
}

function addProductToCart(){
	
	$('storeProductForm').submit();
}

function doCalculateShipping(){
	
	showIndicator();
	
	var successFunc = function(t){

		var content        = t.responseText;
		var cartSessionObj = parseInfo(content);
		
		var totalValue    = cartSessionObj.totalValue*1;
		var shippingValue = cartSessionObj.shippingValue*1;
		
		$('storeCartShippingValue').innerHTML = 'R$ '+toCurrency(shippingValue);
		$('storeCartTotalValue').innerHTML    = 'R$ '+toCurrency(totalValue);
		
		hideIndicator();
	};
		
	var failureFunc = function(t){

		var content = t.responseText;
		hideIndicator();
		
		alert('ATENÇÃO!\n\nOcorreu um erro ao calcular o valor do frete!\nVerifique o CEP informado e tente novamente.');
	};
	
	var zipcode = $('storeCartZipcode').value;
	
	var urlAjax = _webRoot+'/store/calculateShipping/zipcode/'+zipcode;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});	
}

function handleSuccessQuickLogin(content){
	
	$('loginResumeDiv').innerHTML = content;
	handleSuccessLoginStore(content, false)
}

function handleSuccessLoginStore(content, loadMenu){
	
	hideIndicator();
	loadUserCredit();
	
	if( loadMenu )
		loadUserMenu();
	
	$('signLoginTable').remove();
	showDiv('storeAddressResume');
}

function handleFailureLoginStore(content){
	
	showDiv('storeLoginErrorMessage');
	hideIndicator();
}

function handleSuccessSignStore(content){
	
	loadUserMenu();
	loadUserCredit();
	
	$('storeSignDiv').remove();
	showDiv('storeAddressResume');
	hideIndicator();
}

function handleFailureSignStore(content){
	
	enableButton('mainSubmit');
	setButtonBarStatus('signMain', 'error');
	
	handleFormFieldError(content, 'signForm', 'sign', false, 'sign', false, true)
}

function loadSignForm(){
	
	showIndicator();
	
	var successFunc = function(t){

		var content = t.responseText;
		$('storeSignDiv').innerHTML = content;
		
		showDiv('storeSignDiv');
		$('signLoginTable').remove();
		
		hideIndicator();
	};
		
	var failureFunc = function(t){

		var content = t.responseText;
		hideIndicator();
		
		alert('ATENÇÃO!\n\nOcorreu um erro ao carregar o formulário de cadastro!\nPor favor, tente novamente.');
	};
	
	var urlAjax = _webRoot+'/store/getSignForm';
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function finishOrder(){
	
	$('storePaymentForm').onsubmit();
}

function confirmOrder(){
	
	showIndicator();
	
	var successFunc = function(t){

		var orderNumber = t.responseText;
		hideIndicator();
		
		if( orderNumber.test(/^[0-9]*$/) )
			window.location = _webRoot+'/store/order/'+orderNumber;
	};
		
	var failureFunc = function(t){

		var content = t.responseText;
		hideIndicator();
		
		alert('ATENÇÃO!\n\nOcorreu um erro ao finalizar sua compra!\nPor favor, tente novamente.');
	};
	
	var urlAjax = _webRoot+'/store/saveOrder';
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function handleSuccessStorePayment(content){
	
	if( content=='success' )
		window.location = _webRoot+'/store/confirmOrder';
	else
		handleFailureStorePayment(content);
}

function handleFailureStorePayment(content){
	
	showDiv('storeFormErrorDiv');
	handleFormFieldError(content, 'storePaymentForm', 'store', false, 'store', false, true);
	
	$('topSystemMessage').innerHTML = '<div class="message error">Por favor, corrija os campos em destaque para concluir sua compra.</div>';
	scroll(0, 0);
}