function handleSuccessPoll(content){

	clearFormFieldErrors();
	showFormStatusSuccess();
	
	mainRecordName = $('#pollQuestion').val();
	
	updateMainRecordName(mainRecordName, true);
}

function handleFailurePoll(content){
	
	handleFormFieldError(content, 'poll');
}

function addPollAnswer(){
	
	var index = $('#pollAnswers').val();
	index++;
	
	var htmlRow = '<div class="formRight mt5" id="pollPollAnswerRow-'+index+'">'+
				  '	<input name="answer[]" id="answer" value="" size="20" maxlength="20" autocomplete="off" type="text">'+					
				  '	<a href="javascript:void(0)" onclick="removePollAnswer('+index+')" ><img src="'+_imageRoot+'/backend/icons/color/cross.png" title="Excluir" class="formIcon"/></a>'+					
				  '</div>'+
				  '<div class="clear"></div>';
	
	$('#pollPollAnswerListDiv').html( $('#pollPollAnswerListDiv').html()+htmlRow );
	$('#pollAnswers').val(index);
}

function removePollAnswer(index){
	
	$('#pollPollAnswerRow-'+index).remove();

	var index = $('#pollAnswers').val()*1;
	index--;
	$('#pollAnswers').val(index);
}

function updateFileUploadStatus(status, fileName){
	
	switch(status){
		case 'success':
			var pollId = $('#pollId').val();
			
			fileName = fileName.replace(/(\.[a-zA-Z]*)$/, '-'+pollId+'$1');
			
			var link = '<a href="javascript:void(0)" onclick="goToPage(\'poll\', \'downloadImage\', \'pollId\', '+pollId+')"><img src="'+_imageRoot+'/poll/'+fileName+'?time='+time()+'" /></a>'

			$('#pollPollImageDiv').html(link);
			break;
		case 'loading':
			$('#pollPollImageDiv').html('Carregando arquivo...');
			break;
		case 'error':
			$('#pollPollImageDiv').html('Não informado');
			alert('Erro ao carregar o arquivo!\nVerifique se o arquivo é uma imagem JPG ou PNG de 90x100 pixels');
			break;
	}
}
