$(function() {
	
	var clubId  = $('#clubId').val();
	var urlAjax = _webRoot+'/club/uploadPhotos?clubId='+clubId;
	
	$("#clubPhotosUploader").pluploadQueue({
		runtimes : 'html5,html4',
		url : urlAjax,
		max_file_size : '4mb',
		unique_names : true,
		filters : [
			{title : "Arquivos de imagem", extensions : "jpg,png"}
			//{title : "Zip files", extensions : "zip"}
		],
		init : {
		Refresh: function(up) {
			// Called when upload shim is moved
		},
		
		StateChanged: function(up) {
			// Called when the state of the queue is changed
			if(up.state == plupload.STOPPED)
				updateClubPhotoList();
		},
	},
	});
	
	if( getActionName()!='index' )
		buildClubLightbox();
});

function handleSuccessClub(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
	
	mainRecordName = $('#clubClubName').val();
	
	updateMainRecordName(mainRecordName, true);
}

function handleFailureClub(content){
	
	handleFormFieldError(content, 'club');
}

function buildTagName(clubName){
	
	if( $('#clubTagName').val()!='' )
		return;
	
	tagName = clubName.replace(/^ */gi, '');
	tagName = tagName.replace(/ .*/gi, '');
	tagName = tagName.toLowerCase();
	
	$('#clubTagName').val(tagName);
}

function updateFileUploadStatus(status, fileName){
	
	switch(status){
		case 'success':
			var clubId = $('#clubId').val();
			
			fileName = fileName.replace(/(\.[a-zA-Z]*)$/, '-'+clubId+'$1');
			
			var link = '<a href="javascript:void(0)" onclick="goToPage(\'club\', \'downloadLogo\', \'clubId\', '+clubId+')"><img src="'+_imageRoot+'/club/'+fileName+'?time='+time()+'" /></a>'

			$('#clubFileNameLogoDiv').html(link);
			break;
		case 'loading':
			$('#clubFileNameLogoDiv').html('Carregando arquivo...');
			break;
		case 'error':
			$('#clubFileNameLogoDiv').html('Não informado');
			alert('Erro ao carregar o arquivo!\nVerifique se o arquivo é uma imagem JPG ou PNG de 122x122 pixels');
			break;
	}
}

function removeClubPhoto(clubPhotoId){

	var successFunc = function(t){

		$('#clubPhoto-'+clubPhotoId).remove();
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		alert('Não foi possível remover a foto selecionada!\nPor favor, tente novamente.');
		
		if( !errorMessage && isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/club/deletePhoto?clubPhotoId='+clubPhotoId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function doSelectClubCity(id, value){
	
	if( id=='quickNew' ){
		
		var successFunc = function(content){

			$('#clubCityId').val(content)
		};
			
		var failureFunc = function(t){

			var content = t.responseText;

			alert('Não foi possível criar a cidade informada!\nPor favor, tente novamente.');
			
			if( !errorMessage && isDebug() )
				debug(content);
		};
		
		var urlAjax = _webRoot+'/city/addQuick?quickName='+value;
		AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
	}else{
		
		$('#clubCityId').val(id)
	}
}

function updateClubPhotoList(){
	
	var clubId = $('#clubId').val();
	
	var successFunc = function(content){
		
		$('#clubPhotoListDiv').html(content);
		
		buildClubLightbox();
		
		hideIndicator();
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		hideIndicator();
		alert('Não foi possível recarregar a listagem de fotos!\nPor favor, recarregue a página para visualizar as fotos carregadas.');
		
		if( isDebug() )
			debug(content);
	};

	showIndicator();

	var urlAjax = _webRoot+'/club/getPhotoList?clubId='+clubId;

	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function buildClubLightbox(){
	
	$('.photoList a.lightbox').lightBox();
}