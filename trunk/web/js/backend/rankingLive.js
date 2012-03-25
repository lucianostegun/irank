function handleSuccessRankingLiveIndex(content){
	
	if( content ){
		
		var rankingLiveIdList = content.split(',');
		
		removeTableRows('rankingLive', rankingLiveIdList);
	}
	
	hideIndicator('rankingLive');
}

function handleFailureRankingLiveIndex(content){
	
	hideIndicator('rankingLive');
	var errorMessage = parseMessage(content);
	
	alert('Não foi possível excluir um ou mais registros selecionados!'+errorMessage);
}

function handleSuccessRankingLive(content){

	showFormStatusSuccess('rankingLive');
	clearFormFieldErrors('rankingLive');
	
	mainRecordName = $('rankingLiveRankingName').value;
	updateMainRecordName(mainRecordName, true);
}

function handleFailureRankingLive(content){
	
	handleFormFieldError(content, 'rankingLive');
}

function updateFileUploadStatus(status, fileName){
	
	switch(status){
		case 'success':
			var rankingLiveId = $('rankingLiveId').value;
			
			var link = '<a href="javascript:void(0)" onclick="goToPage(\'rankingLive\', \'downloadLogo\', \'rankingLiveId\', '+rankingLiveId+')">'+fileName+'</a>'
			$('rankingLiveFileNameLogoDiv').innerHTML = link;
			break;
		case 'loading':
			$('rankingLiveFileNameLogoDiv').innerHTML = 'Carregando arquivo...';
			break;
		case 'error':
			$('rankingLiveFileNameLogoDiv').innerHTML = 'Não informado';
			alert('Erro ao carregar o arquivo!\nVerifique se o arquivo é uma imagem JPG ou PNG de 90x90 pixels');
			break;
	}
}