function viewEventPhoto(eventPhotoId, direction){
	
	var successFunc = function(t){

		var content = t.responseText;
		var fileObj = parseInfo(content);
		
		eventPhotoId = fileObj.id;

		var width  = fileObj.width*1;
		var height = fileObj.height*1;
		
		var content = '<img src="/'+fileObj.filePath+'"/>';
		content += '<a href="javascript:void(0)" onclick="loadEventPhotoComments('+eventPhotoId+')" style="cursor: pointer; position: absolute; right: 0; bottom: 0; z-index: 150"><img src="'+_imageRoot+'/misc/comments32.png" title="Ver comentários desta foto" />';

		$('photoWallDiv').innerHTML = content;

		windowPhotoWallViewShow();
		windowPhotoWallViewObj.setDimension(width+15, height+15);
		windowPhotoWallViewObj.center();
		windowPhotoWallViewShow();
		
		var hidePhotoView = function(){
		
			windowPhotoWallViewHide();
			window.onclick = null;
			window.onkeyup = null;
		}
		
		var onkeyup = function(event){
			
			if(event.keyCode==27)
				hidePhotoView();
		}
		
		window.onclick = hidePhotoView;
		window.onkeyup = onkeyup;
		
		hideIndicator();
	};
	
	var failureFunc = function(t){

		hideIndicator();
	};

	showIndicator();
	
	var urlAjax = _webRoot+'/photoWall/getPhotoInfo/eventPhotoId/'+eventPhotoId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});	
}