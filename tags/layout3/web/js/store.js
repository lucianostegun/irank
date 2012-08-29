var _FileNameSiteLimit = 30;

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
	$('storeCartDiscountValue').innerHTML = 'R$ '+toCurrency(cartSessionObj.discountValue*-1);
	$('storeCartTotalValue').innerHTML    = 'R$ '+toCurrency(cartSessionObj.totalValue);

	updateCartSideBar(cartSessionObj);
	hideIndicator();
}

function updateCartSideBar(cartSessionObj){
	
	$('storeCartSideBarOrderValue').innerHTML    = toCurrency(cartSessionObj.orderValue);
	$('storeCartSideBarShippingValue').innerHTML = toCurrency(cartSessionObj.shippingValue);
	$('storeCartSideBarDiscountValue').innerHTML = toCurrency(cartSessionObj.discountValue*-1);
	$('storeCartSideBarTotalValue').innerHTML    = toCurrency(cartSessionObj.totalValue);
	
	$('storeCartSideBarProducts').innerHTML     = cartSessionObj.products;
	$('storeCartSideBarProductLabel').innerHTML = 'ite'+(cartSessionObj.products==1?'m':'ns');
}

function removeProductFromCart(productItemId){
	
	showIndicator();
	
	var successFunc = function(t){

		var content        = t.responseText;
		var cartSessionObj = parseInfo(content);
		
		$('storeCartShippingValue').innerHTML = 'R$ '+toCurrency(cartSessionObj.shippingValue);
		$('storeCartDiscountValue').innerHTML = 'R$ '+toCurrency(cartSessionObj.discountValue*-1);
		$('storeCartTotalValue').innerHTML    = 'R$ '+toCurrency(cartSessionObj.totalValue);
		
		row = $('cartProductItem-'+productItemId);
		row.parentNode.removeChild(row);
		
		var rows = document.getElementsByClassName('productItemRow');
		if( rows.length==0 ){
			
			showDiv('cartEmptyRow', 'table-row');
			$('storeCartQuantityUpdateRow').remove();
			$('storeCartShippingRow').remove();
			$('storeCartDiscountRow').remove();
		}
		
		updateCartSideBar(cartSessionObj);
		
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
	
	if(optionType=='color')
		reloadSizeOptions(productOptionId);
	
	var element = $('productOption'+ucfirst(optionType)+'-'+productOptionId);
	
	if( optionType=='size' && element.hasClassName('disabled') ){
		
		if(document.getElementsByClassName('productOptionOption color selected').length > 0){
			
			var size = $('productOptionSize-'+productOptionId).innerHTML;
			return alert('Desculpe, este produto não está disponível no tamanho "'+size+'" para a cor selecionada');
		}
		
		return alert('Por favor, selecione a cor do produto desejado');
	}
	
	var elementList = document.getElementsByClassName('productOptionOption '+optionType+' selected');
	
	if( elementList.length > 0 )
		elementList[0].removeClassName('selected');

	$('productOption'+ucfirst(optionType)+'-'+productOptionId).addClassName('selected');
	$('productOptionId'+ucfirst(optionType)+'').value = productOptionId;
}

function reloadSizeOptions(colorId){
	
	var productCode = $('productCode').value;
	
	var elementList = document.getElementsByClassName('productOptionOption size');
	for(var i=0; i<elementList.length; i++)
		elementList[i].addClassName('disabled');
		
	var successFunc = function(t){

		var productOptionIdSizeList = t.responseText;
		productOptionIdSizeList     = productOptionIdSizeList?productOptionIdSizeList.split(','):[];
		
		for(var i=0; i<productOptionIdSizeList.length; i++)
			$('productOptionSize-'+productOptionIdSizeList[i]).removeClassName('disabled');
	};
		
	var failureFunc = function(t){
		
	};
	
	var urlAjax = _webRoot+'/store/getSizeOptions?colorId='+colorId+'&productCode='+productCode;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});	
}

function validateCartItem(){
	
	if( !$('productOptionIdColor').value ){
		
		alert('Por favor, selecione a cor do produto desejado');
		return false;
	}
	
	if( !$('productOptionIdSize').value ){
		
		alert('Por favor, selecione o tamanho do produto desejado');
		return false;
	}
	
	return true;
}

function addProductToCart(){
	
	if( validateCartItem() )
		$('storeProductForm').submit();
}

function doCalculateShipping(){
	
	showIndicator();
	
	var successFunc = function(t){

		var content        = t.responseText;
		var cartSessionObj = parseInfo(content);
		
		$('storeCartShippingValue').innerHTML = 'R$ '+toCurrency(cartSessionObj.shippingValue);
		$('storeCartDiscountValue').innerHTML = 'R$ '+toCurrency(cartSessionObj.discountValue*-1);
		$('storeCartTotalValue').innerHTML    = 'R$ '+toCurrency(cartSessionObj.totalValue);
		
		hideIndicator();
		
		updateCartSideBar(cartSessionObj);
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

function doCalculateDiscount(){
	
	showIndicator();
	
	var successFunc = function(t){
		
		var content        = t.responseText;
		var cartSessionObj = parseInfo(content);
		
		var discountValue = cartSessionObj.discountValue*-1;
		var totalValue    = cartSessionObj.totalValue*1;
		
		$('storeCartDiscountValue').innerHTML = 'R$ '+toCurrency(discountValue);
		$('storeCartTotalValue').innerHTML    = 'R$ '+toCurrency(totalValue);
		
		updateCartSideBar(cartSessionObj);
		clearCommonBarMessage();
		hideIndicator();
	};
	
	var failureFunc = function(t){
		
		var content = t.responseText;
		hideIndicator();
		
		var errorMessage = parseMessage(content, 'Ocorreu um erro ao calcular o valor do desconto');
		setCommonBarMessage('<b>ATENÇÃO!</b> '+errorMessage, 'error', true);
	};
	
	var discountCoupon = $('storeCartDiscountCoupon').value;
	
	var urlAjax = _webRoot+'/store/calculateDiscount/discountCoupon/'+discountCoupon;
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

function checkoutPurchase(){
	
	$('storeCartForm').submit();
}

function finishOrder(){
	
	$('storePaymentForm').onsubmit();
}

function confirmOrder(){
	
	showIndicator();
	
	var successFunc = function(t){

		var orderNumber = t.responseText;
		
		hideIndicator();
		
		if( (/^[0-9]*$/).test(orderNumber) )
			window.location = _webRoot+'/store/orderConfirm/'+orderNumber;
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

function getAddressByZipcode(){
	
	showIndicator();
	
	var lockAddressFields = function(){
		
		$('storeAddressName').disabled       = true;
		$('storeAddressNumber').disabled     = true;
		$('storeAddressQuarter').disabled    = true;
		$('storeAddressComplement').disabled = true;
		$('storeAddressCity').disabled       = true;
		$('storeAddressState').disabled      = true;
	}

	var unlockAddressFields = function(){
		
		$('storeAddressName').disabled       = false;
		$('storeAddressNumber').disabled     = false;
		$('storeAddressQuarter').disabled    = false;
		$('storeAddressComplement').disabled = false;
		$('storeAddressCity').disabled       = false;
		$('storeAddressState').disabled      = false;
	}
	
	var successFunc = function(t){

		var content     = t.responseText;
		var addressObj  = parseInfo(content);
		var addressType = addressObj.tipo_logradouro;
		
		$('storeAddressName').value        = (addressType?addressType+' ':'')+addressObj.logradouro;
		$('storeAddressNumber').value      = '';
		$('storeAddressQuarter').value     = addressObj.bairro;
		$('storeAddressComplement').value  = '';
		$('storeAddressCity').value        = addressObj.cidade;
		$('storeAddressState').value       = addressObj.uf;
		unlockAddressFields();
		
		hideIndicator();
	};
		
	var failureFunc = function(t){

		var content = t.responseText;
		unlockAddressFields();
		hideIndicator();
		
		alert('Ocorreu um erro ao pesquisar as informação do CEP!\nPor favor, verifique o CEP informado e tente novamente.');
	};
	
	var zipcode = $('storeAddressZipcode').value;
	lockAddressFields();
	
	var urlAjax = _webRoot+'/util/getAddressByZipcode/zipcode/'+zipcode;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function updateFileNameLabel(fileName){

	if( fileName.length > _FileNameSiteLimit ){
		
		var extension = fileName.match(/\.([a-zA-Z0-9]*)$/);
		extension = extension[1];
		fileName = fileName.substring(0, _FileNameSiteLimit-3-(extension.length))+'...'+extension;
	}
	
	$('fileNameLabel').innerHTML = fileName;
}

function handleUploadFileSuccess(fileId, fileName){
	
	var fileNameOriginal = fileName;
	
	if( fileName.length > _FileNameSiteLimit ){
		
		var extension = fileName.match(/\.([a-zA-Z0-9]*)$/);
		extension = extension[1];
		fileName = fileName.substring(0, _FileNameSiteLimit-3-(extension.length))+'...'+extension;
	}
	
	$('payTicketDownloadLink').style.display = 'inline';
	$('payTicketDownloadLink').innerHTML     = fileName;
	$('payTicketDownloadLink').title         = fileNameOriginal;
	$('payTicketUploadLink').innerHTML       = 'Reenviar';
	hideDiv('storePurchaseFileUploadDiv');
}

function uploadPayTicket(){
	
	showDiv('storePurchaseFileUploadDiv');
}

function downloadPayTicket(orderNumber){
	
	window.location = _webRoot+'/store/downloadFile/orderNumber/'+orderNumber;
}

function addProductToBookmarks(){
	
	if( window.sidebar ) // Mozilla Firefox Bookmark
		window.sidebar.addPanel(document.title, location.href, '');
	
	else if( window.external ) // IE Favorite
		window.external.AddFavorite(location.href,document.title);
	
	else if( window.opera && window.print ) { // Opera Hotlist
		
		this.title=document.title;
		return true;
	}
}

function showTshirtSizeHelp(){

	window.open(_webRoot+'/store/tshirtSizes');
}