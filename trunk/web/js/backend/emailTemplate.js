$(function() {
	
});

function doDeleteEmailTemplate(){
	
	doDeleteMain();
}

function handleSuccessEmailTemplate(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
	
	$('#mainPreviewTab').show();
	$('#emailTemplateFileControls').show();
	
	mainRecordName = ($('#emailTemplateTemplateName').val()?$('#emailTemplateTemplateName').val():$('#emailTemplateTemplateName').val());
	updateMainRecordName(mainRecordName, true);
}

function handleFailureEmailTemplate(content){
	
	handleFormFieldError(content, 'emailTemplate');
}

function updateFileUploadStatus(status, fileName){
	
	switch(status){
		case 'success':
			
			var emailTemplateId = $('#emailTemplateId').val();
			var link = '<a href="javascript:void(0)" onclick="goToPage(\'emailTemplate\', \'downloadFile\', \'emailTemplateId\', '+emailTemplateId+')">'+fileName+'</a>';

			$('#emailTemplateFileName').val(fileName);
			$('#emailTemplateFileNameDiv').html(link);
			break;
		case 'loading':
			$('#emailTemplateFileNameDiv').html('Carregando arquivo...');
			break;
		case 'error':
			$('#emailTemplateFileNameDiv').html('Não informado');
			alert('Erro ao carregar o arquivo!\nVerifique se o arquivo está no formato HTML');
			break;
	}
}

function previewTemplateContent(){
	
	var emailTemplateId = $('#emailTemplateId').val();
	
	loadTabContent('tab2', '/emailTemplate/getTabContent/tabName/preview/emailTemplateId/'+emailTemplateId, true);
	$('#mainPreviewTab').show();
	$('#mainPreviewTab').mousedown();
}

function editTemplateContent(){
	
	var emailTemplateId = $('#emailTemplateId').val();
	
	loadTabContent('tab3', '/emailTemplate/getTabContent/tabName/edit/emailTemplateId/'+emailTemplateId, false, handleTextareaField);
	$('#mainEditTab').show();
	$('#mainEditTab').mousedown();
}

function handleTextareaField(){
	
	$('#emailTemplateContent').tabby();
}

function sendEmailPreview(){
	
	if( !_emailDebug ){
	
		if( confirm('Nenhum e-mail de teste está configurado!\nDeseja configurar um e-mail de testes agora?') )
			return goToPage('settings', 'index', '', '', true);
		
		return;
	}
	
	if( !confirm('O conteúdo do template será enviado para o e-mail "'+_emailDebug+'".\nDeseja prosseguir?') )
		return false;
	
	showIndicator();
	var emailTemplateId = $('#emailTemplateId').val();
	
	var successFunc = function(content){

		hideIndicator();
		alert('Mensagem de teste do template enviada com sucesso!');
	};
		
	var failureFunc = function(t){

		var content = t.responseText;
		hideIndicator();
		
		alert('Não foi possível enviar a mensagem de teste do template!\nPor favor, tente novamente.');
		
		if( isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/emailTemplate/sendEmailPreview?emailTemplateId='+emailTemplateId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}