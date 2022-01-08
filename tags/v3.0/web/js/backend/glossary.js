$(function() {
	
	$('.tags').tagsInput({
		width: '100%', 
		delimiter: ',',
		defaultText: 'Tags'});

	$('#glossaryDescription').cleditor({
		width:'100%', 
		height:'500px',
		bodyStyle: 'margin: 10px; font: 12px Arial, Verdana; cursor: text'
	});
});

function handleSuccessGlossary(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
	
	mainRecordName = $('#glossaryTerm').val();
	
	updateMainRecordName(mainRecordName, true);
}

function handleFailureGlossary(content){
	
	handleFormFieldError(content, 'glossary');
}