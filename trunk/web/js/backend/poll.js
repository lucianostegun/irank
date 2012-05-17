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
	
	var index = $('#pollPollAnswerCurrentIndex').val();
	++index;
	
	var htmlRow = '<div class="formRow" id="pollPollAnswerRow-'+index+'">'+
					'	<label></label>'+
					'	<div class="formRight">'+
					'		<input name="answer[]" id="answer" value="" size="20" maxlength="20" autocomplete="off" type="text"><a href="javascript:void(0)" onclick="removePollAnswer('+index+')" ><img src="/images/backend/icons/color/cross.png" title="Excluir" style="margin-left: 5px"/></a>'+					
					'	</div>'+
					'	<div class="clear"></div>'+
				   '</div>';
	
	$('#pollPollAnswerListDiv').html( $('#pollPollAnswerListDiv').html()+htmlRow );
	$('#pollPollAnswerCurrentIndex').val(index);
}

function removePollAnswer(index){
	
	$('#pollPollAnswerRow-'+index).remove();
}