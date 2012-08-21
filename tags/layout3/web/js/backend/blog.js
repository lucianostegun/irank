$(function() {
	
	$('.tags').tagsInput({
		width: '100%', 
		delimiter: ',',
		defaultText: 'Tags'});

	$('#blogGlossary').tagsInput({
		width: '100%', 
		delimiter: ',',
		defaultText: 'Glossário'});

	$('#blogContent').cleditor({
		width:'100%', 
		height:'500px',
		bodyStyle: 'margin: 10px; font: 12px Arial, Verdana; cursor: text'
	});
	
	$('#fm').elfinder({
		url : _webRoot+'/blog/connector',
		lang: 'pt_BR', // language (OPTIONAL)
		toolbar : [
		           ['back', 'reload'],
		           ['select', 'open'],
		           ['mkdir', 'mkfile', 'upload']
		          ],
	});
});

function handleSuccessBlog(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
	
	mainRecordName = $('#blogCategoryName').val();
	
	updateMainRecordName(mainRecordName, true);
}

function handleFailureBlog(content){
	
	handleFormFieldError(content, 'blog');
}

function buildPermalink(permalink){
	
	permalink = permalink.toLowerCase().removeAccents();
	permalink = permalink.replace(/[^a-z0-9\-]/gi, '-');
	permalink = permalink.replace(/-{2,}/gi, '-');
	
	$('#blogPermalink').val(permalink);
}