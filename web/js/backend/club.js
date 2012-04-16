function handleSuccessClubIndex(content){
	
	if( content ){
		
		var clubIdList = content.split(',');
		
		removeTableRows('club', clubIdList);
	}
	
	hideIndicator();
}

function handleFailureClubIndex(content){
	
	hideIndicator();
	var errorMessage = parseMessage(content);
	
	alert('Não foi possível excluir um ou mais registros selecionados!'+errorMessage);
}

function handleSuccessClub(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
	
	mainRecordName = $('#clubClubName').val();
	updateMainRecordName(mainRecordName, true);
}

function handleFailureClub(content){
	
	handleFormFieldError(content, 'club');
}

function updateFileUploadStatus(status, fileName){
	
	switch(status){
		case 'success':
			var clubId = $('clubId').value;
			
			var link = '<a href="javascript:void(0)" onclick="goToPage(\'club\', \'downloadLogo\', \'clubId\', '+clubId+')">'+fileName+'</a>'
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
		]
	});
});