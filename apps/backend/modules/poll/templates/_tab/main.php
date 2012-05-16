<?php
	echo form_remote_tag(array(
		'url'=>'poll/save',
		'success'=>'handleSuccessPoll(response)',
		'failure'=>'handleFailurePoll(response.responseText)',
		'loading'=>'showIndicator()',
		),
		array('class'=>'form', 'id'=>'pollForm'));

	$pollId = $pollObj->getId();
	
	echo input_hidden_tag('pollId', $pollId);
?>
	<div class="formRow">
		<label>Pergunta</label>
		<div class="formRight">
			<?php echo input_tag('question', $pollObj->getQuestion(), array('size'=>80, 'maxlength'=>200, 'id'=>'pollQuestion')) ?>
			<div class="formNote error" id="pollFormErrorQuestion"></div>
		</div>
		<div class="clear"></div>
	</div>

</form>