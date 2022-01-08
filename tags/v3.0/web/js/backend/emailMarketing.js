$(function() {
	
});

function doDeleteEmailMarketing(){
	
	doDeleteMain();
}

function handleSuccessEmailMarketing(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
	
	$('#mainPreviewTab').show();
	$('#emailMarketingFileControls').show();
	
	mainRecordName = ($('#emailMarketingMarketingName').val()?$('#emailMarketingMarketingName').val():$('#emailMarketingMarketingName').val());
	updateMainRecordName(mainRecordName, true);
}

function handleFailureEmailMarketing(content){
	
	handleFormFieldError(content, 'emailMarketing');
}

function updateFileUploadStatus(status, fileName){
	
	switch(status){
		case 'success':
			
			var emailMarketingId = $('#emailMarketingId').val();
			var link = '<a href="javascript:void(0)" onclick="goToPage(\'emailMarketing\', \'downloadFile\', \'emailMarketingId\', '+emailMarketingId+')">'+fileName+'</a>';

			$('#emailMarketingFileName').val(fileName);
			$('#emailMarketingFileNameDiv').html(link);
			break;
		case 'loading':
			$('#emailMarketingFileNameDiv').html('Carregando arquivo...');
			break;
		case 'error':
			$('#emailMarketingFileNameDiv').html('Não informado');
			alert('Erro ao carregar o arquivo!\nVerifique se o arquivo está no formato HTML');
			break;
	}
}

function previewMarketingContent(){
	
	var emailMarketingId = $('#emailMarketingId').val();
	
	loadTabContent('tab2', '/emailMarketing/getTabContent/tabName/preview/emailMarketingId/'+emailMarketingId, true);
	$('#mainPreviewTab').show();
	$('#mainPreviewTab').mousedown();
}

function editMarketingContent(){
	
	var emailMarketingId = $('#emailMarketingId').val();
	
	loadTabContent('tab3', '/emailMarketing/getTabContent/tabName/edit/emailMarketingId/'+emailMarketingId, false, handleTextareaField);
	$('#mainEditTab').show();
	$('#mainEditTab').mousedown();
}

function handleTextareaField(){
	
	$('#emailMarketingContent').tabby();
}

function sendEmailPreview(){
	
	if( !_emailDebug ){
	
		if( confirm('Nenhum e-mail de teste está configurado!\nDeseja configurar um e-mail de testes agora?') )
			return goToPage('settings', 'index', '', '', true);
		
		return;
	}
	
	if( !confirm('O conteúdo do deste e-mail será enviado para o endereço "'+_emailDebug+'".\nDeseja prosseguir?') )
		return false;
	
	showIndicator();
	var emailMarketingId = $('#emailMarketingId').val();
	
	var successFunc = function(content){

		hideIndicator();
		alert('Mensagem de teste enviada com sucesso!');
	};
		
	var failureFunc = function(t){

		var content = t.responseText;
		hideIndicator();
		
		alert('Não foi possível enviar a mensagem de teste!\nPor favor, tente novamente.');
		
		if( isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/emailMarketing/sendEmailPreview?emailMarketingId='+emailMarketingId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function loadPeopleList(){
	
	var emailMarketingId = $('#emailMarketingId').val();
	
	showIndicator();
	
	var successFunc = function(content){

		$('#emailMarketingPeopleListDiv').html(content);
		$("#emailMarketingPeopleListDiv input:checkbox").uniform();
		
		buildCheckboxTable();
		
		hideIndicator();
	};
		
	var failureFunc = function(t){

		var content = t.responseText;
		hideIndicator();
		
		alert('Não foi possível carregar a lista de pessoas!\nPor favor, tente novamente.');
		
		if( isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/emailMarketing/getPeopleList?emailMarketingId='+emailMarketingId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc, parameters:$('#emailMarketingPeopleForm').serialize()});
}