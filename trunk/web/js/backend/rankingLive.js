function handleSuccessRankingLiveIndex(content){
	
	if( content ){
		
		var rankingLiveIdList = content.split(',');
		
		removeTableRows('rankingLive', rankingLiveIdList);
	}
	
	hideIndicator();
}

function handleFailureRankingLiveIndex(content){
	
	hideIndicator();
	var errorMessage = parseMessage(content);
	
	alert('Não foi possível excluir um ou mais registros selecionados!'+errorMessage);
}

function handleSuccessRankingLive(content){

	showFormStatusSuccess();
	clearFormFieldErrors();
	
	mainRecordName = $('#rankingLiveRankingName').val();
	updateMainRecordName(mainRecordName, true);
}

function handleFailureRankingLive(content){
	
	handleFormFieldError(content, 'rankingLive');
}

function updateFileUploadStatus(status, fileName){
	
	switch(status){
		case 'success':
			var rankingLiveId = $('#rankingLiveId').val();
			
			fileName = fileName.replace(/(\.[a-zA-Z]*)$/, '-'+rankingLiveId+'$1');
			
			var link = '<a href="javascript:void(0)" onclick="goToPage(\'rankingLive\', \'downloadLogo\', \'rankingLiveId\', '+rankingLiveId+')"><img src="'+_imageRoot+'/ranking/'+fileName+'?time='+time()+'" /></a>'
			$('#rankingLiveFileNameLogoDiv').html(link);
			break;
		case 'loading':
			$('#rankingLiveFileNameLogoDiv').html('Carregando arquivo...');
			break;
		case 'error':
			$('#rankingLiveFileNameLogoDiv').html('Não informado');
			alert('Erro ao carregar o arquivo!\nVerifique se o arquivo é uma imagem JPG ou PNG de 90x90 pixels');
			break;
	}
}

function handleIsFreeroll(checked){
	
	$('#rankingLiveDefaultBuyin').attr('disabled', checked);
}