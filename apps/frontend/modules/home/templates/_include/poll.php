<?php
	$pollObj = PollPeer::getRandonPoll();
	
	if(is_object($pollObj)):
	
		sfContext::getInstance()->getResponse()->addStylesheet('poll');
		sfContext::getInstance()->getResponse()->addJavascript('poll');
?>
<div id="handPoll">
	<div class="question"><?php echo $pollObj->getQuestion() ?></div>
	<div class="image"><?php echo image_tag('poll/'.$pollObj->getPollImage()) ?></div>
	<div class="options">
		<?php foreach($pollObj->getPollAnswerList() as $pollAnswerObj):?>
			<div class="option" onclick="selectPollResponse(<?php echo $pollObj->getId() ?>, <?php echo $pollAnswerObj->getId() ?>)" id="pollAnswer-<?php echo $pollAnswerObj->getId() ?>"><?php echo $pollAnswerObj->getAnswer() ?></div>
		<?php endforeach; ?>
	</div>
	<div class="clear"></div>
</div>
<?php endif; ?>