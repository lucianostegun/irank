function handleSuccessDiscountCoupon(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
	
	mainRecordName = $('#discountCouponCouponCode').val();
	
	updateMainRecordName(mainRecordName, true);
}

function handleFailureDiscountCoupon(content){
	
	handleFormFieldError(content, 'discountCoupon');
}

function buildRandomCouponCode(){
	
	var rangeAlpha  = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
	var rangeNumber = '23456789';
	
	var couponCode = getRandomString(1, rangeAlpha);
	couponCode += getRandomString(8, rangeAlpha+rangeNumber);
	couponCode += getRandomString(1, rangeAlpha);
	couponCode = couponCode.toUpperCase();
	
	$('#discountCouponCouponCode').val(couponCode);
}

function openDiscountField(discountType){
	
	$('#'+discountType+'FieldDiv').show();
	$('#'+discountType+'Label').hide();
	$('#discountCoupon'+ucfirst(discountType)).focus();
	$('#discountCoupon'+ucfirst(discountType)).select();
}