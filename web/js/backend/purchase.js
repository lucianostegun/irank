$(function() {
	
	$('#purchaseShippingDate').datepicker({ 
		defaultDate: +0,
		autoSize: true,
		dateFormat: 'dd/mm/yy',
		onSelect: function(dateText){
			
		}
	});
});

function handleSuccessPurchase(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
}

function handleFailurePurchase(content){
	
	handleFormFieldError(content, 'purchase');
}

function sendPurchaseNotify(){

	if( !confirm('Confirma envio de e-mail de notificação da compra para o status atual do pedido ao cliente?') )
		return;
	
	showIndicator();
	
	var successFunc = function(content){
		
		hideIndicator();
		alert('E-mail de notificação enviado com sucesso!');
	};
		
	var failureFunc = function(t){
	
		var content = t.responseText;
	
		hideIndicator();
		alert('Não foi possível enviar o e-mail de notificação!\nPor favor, tente novamente.');
		
		if( !errorMessage && isDebug() )
			debug(content);
	};
	
	var purchaseId = $('#purchaseId').val();
	
	var urlAjax = _webRoot+'/purchase/sendNotify/purchaseId/'+purchaseId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc, parameters:$('#eventLiveDisclosureSmsForm').serialize()});
}