$(function() {
	
	$('#purchaseShippingDate').datepicker({ 
		defaultDate: +3,
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