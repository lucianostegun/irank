<?php
	echo form_remote_tag(array(
		'url'=>'poll/save',
		'success'=>'handleSuccessPoll(response)',
		'failure'=>'handleFailurePoll(response.responseText)',
		'loading'=>'showIndicator()',
		),
		array('class'=>'form', 'id'=>'pollForm'));

	$pollId            = $pollObj->getId();
	$pollAnswerObjList = $pollObj->getPollAnswerList();
	$pollAnswerObjList = empty($pollAnswerObjList)?array(new PollAnswer()):$pollAnswerObjList;
	
	echo input_hidden_tag('pollId', $pollId);
	echo input_hidden_tag('pollPollAnswerCurrentIndex', (count($pollAnswerObjList)-1));
?>
	<div class="formRow">
		<label>Pergunta</label>
		<div class="formRight">
			<?php echo input_tag('question', $pollObj->getQuestion(), array('size'=>80, 'maxlength'=>200, 'id'=>'pollQuestion')) ?>
			<div class="formNote error" id="pollFormErrorQuestion"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div id="pollPollAnswerListDiv">
		<?php foreach($pollAnswerObjList as $key=>$pollAnswerObj): ?>
			<div class="formRow" id="pollPollAnswerRow-<?php echo $key ?>">
				<label><?php echo $key==0?'Respostas possíveis:'.link_to(image_tag('backend/icons/color/plus', array('title'=>'Adicionar resposta', 'style'=>'margin: 0px 0px -3px 5px')), '#addPollAnswer()'):'' ?></label>
				<div class="formRight">
					<?php echo input_tag('answer[]', $pollAnswerObj->getAnswer(), array('size'=>20, 'maxlength'=>20)).($key==0 || $pollAnswerObj->getUserResponse()?'':link_to(image_tag('backend/icons/color/cross', array('title'=>'Excluir', 'style'=>'margin-left: 5px')), '#removePollAnswer('.$key.')')) ?>
				</div>
				<div class="clear"></div>
			</div>
		<?php endforeach; ?>
	</div>
</form>