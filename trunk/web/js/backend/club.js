function handleSuccessClubIndex(content){
	
	if( content ){
		
		var clubIdList = content.split(',');
		
		removeTableRows('club', clubIdList);
	}
	
	hideIndicator('club');
}

function handleFailureClubIndex(content){
	
	hideIndicator('club');
	var errorMessage = parseMessage(content);
	
	alert('Não foi possível excluir um ou mais registros selecionados!'+errorMessage);
}

function handleSuccessClub(content){

	showFormStatusSuccess('club');
	clearFormFieldErrors('club');
	
	mainRecordName = $('clubClubName').value;
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
			$('clubFileNameLogoDiv').innerHTML = link;
			break;
		case 'loading':
			$('clubFileNameLogoDiv').innerHTML = 'Carregando arquivo...';
			break;
		case 'error':
			$('clubFileNameLogoDiv').innerHTML = 'Não informado';
			alert('Erro ao carregar o arquivo!\nVerifique se o arquivo é uma imagem JPG ou PNG de 122x122 pixels');
			break;
	}
}