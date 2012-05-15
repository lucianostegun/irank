$(function() {
	
	$('.maskPhone').mask('(99) 9999-9999');
});

function handleSuccessPeople(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
	
	mainRecordName = $('#peoplePeopleName').val();
	
	updateMainRecordName(mainRecordName, true);
}

function handleFailurePeople(content){
	
	handleFormFieldError(content, 'people');
}