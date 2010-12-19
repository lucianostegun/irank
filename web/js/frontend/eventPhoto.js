function updatePhotoUploadStatus(status){
	
	switch(status){
		case 'error':
			alert('Não foi possível carregar a imagem selecionada!\nVerifique o formato e o tamanho do arquivo enviado.\n\nFormato: JPG ou PNG, até 2Mb');
			break;
		case 'loading':
			showIndicator();
			break;
		default:
			break;
	}
}

function updateEventPhotoList(){
	
	var eventId = $('eventId').value;
	
	var successFunc = function(t){

		hideIndicator();
	};
		
	var failureFunc = function(t){

		hideIndicator();
	};
	
	var urlAjax = _webRoot+'/event/getPhotoList/eventId/'+eventId;
	new Ajax.Updater('eventPhotoListDiv', urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function viewEventPhoto(eventPhotoId, direction){
	
	var eventId = $('eventId').value;
	
	var successFunc = function(t){

		var content = t.responseText;
		var fileObj = parseInfo(content);
		
		eventPhotoId = fileObj.id;

		var width  = fileObj.width*1;
		var height = fileObj.height*1;
		
		$('eventPhotoDiv').innerHTML = '<img src="/'+fileObj.filePath+'"/>';

		windowEventPhotoViewShow();
		windowEventPhotoViewObj.setDimension(width+15, height+15);
		windowEventPhotoViewObj.center();
		windowEventPhotoViewShow();
		
		var onclick = function(){ windowEventPhotoViewHide() }
		var onkeyup = function(event){
			
			if(event.keyCode==37)
				viewEventPhoto(eventPhotoId, 'previous');
			if(event.keyCode==39)
				viewEventPhoto(eventPhotoId, 'next');
			if(event.keyCode==27)
				windowEventPhotoViewHide();
		}
		
		window.onclick = onclick;
		window.onkeyup = onkeyup;
		
		hideIndicator();
	};
	
	var failureFunc = function(t){

		hideIndicator();
	};

	showIndicator();
	
	var urlAjax = _webRoot+'/event/getPhoto/eventId/'+eventId+'/eventPhotoId/'+eventPhotoId+'/direction/'+direction;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});	
}

function deleteEventPhoto(eventPhotoId){
	
	var eventId = $('eventId').value;
	
	var successFunc = function(t){

		var content = t.responseText;
		
		$('eventPhotoListDiv').innerHTML = content;
		
		hideIndicator();
	};
	
	var failureFunc = function(t){

		alert('Não foi possível excluir a imagem selecionada!');
		hideIndicator();
	};

	var urlAjax = _webRoot+'/event/deletePhoto/eventId/'+eventId+'/eventPhotoId/'+eventPhotoId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});	
}