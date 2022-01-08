$(function() {
	
	$('#fm').elfinder({
		url : _webRoot+'/fileManager/connector',
		lang: 'pt_BR', // language (OPTIONAL)
		toolbar : [
		           ['back', 'reload'],
		           ['select', 'open'],
		           ['mkdir', 'mkfile', 'upload']
		          ],
	});
});