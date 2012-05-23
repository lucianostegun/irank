<?php $pollObj = PollPeer::getRandonPoll(); ?>
<?php if(is_object($pollObj)): ?>
<script>
function selectPollResponse( pollId, pollAnswerId ){
	
	window.location = '<?php echo url_for('home/poll') ?>?pollId='+pollId+'&pollAnswerId='+pollAnswerId;
}
</script>
<style>
*{
	font-size: 		12px;
	font-family:	Arial;
}
.handQuiz .options {

	float: 			left;
	position: 		relative;
	top: 			5px
}

.handQuiz .options .option {

	margin-top: 	2px;
	margin-left: 	3px;
	background: 	#F0F0F0 url('/images/quiz/optionBg.gif') repeat-x;
	padding: 		2px 4px 2px 8px;
	width: 			76px;
	
	border: 				1px solid #D0D0D0;
	-moz-border-radius: 	5px;
	-webkit-border-radius: 	5px;
	border-radius: 			5px;
}

.handQuiz .options .option:hover {

	background-position: 	0 -20px;
}

.handQuiz .options .option:selected {

	background-position: 	0 -40px;
	font-weight: 			bold;
}

.handQuiz .options a {

	color: 				#505050;
	text-decoration: 	none;
}
</style>
<div class="handQuiz" style="position: relative; left: 0px; top: 0px; background: #FAFAFA; padding-top: 10px">
	<div style="margin: -2px 8px 5px 8px"><?php echo $pollObj->getQuestion() ?></div>
	<div class="image" style="float: left; margin: 5px"><?php echo image_tag('poll/'.$pollObj->getPollImage()) ?></div>
	<div class="options">
		<?php foreach($pollObj->getPollAnswerList() as $pollAnswerObj):?>
			<?php echo link_to('<div class="option">'.$pollAnswerObj->getAnswer().'</div>', '#selectPollResponse('.$pollObj->getId().', \''.$pollAnswerObj->getId().'\')') ?>
		<?php endforeach; ?>
	</div>
	<div class="clear"></div>
</div>
<?php endif; ?>