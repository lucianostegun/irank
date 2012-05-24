<script>
var pollAnswered = false;

function selectPollResponse(pollId, pollAnswerId){

	if( pollAnswered )
		return;
		
	showIndicator();
		
	var successFunc = function(t){

		var content = parseInfo(t.responseText);
		$('pollAnswer-'+pollAnswerId).addClassName('strong');
		alert(content)
		pollAnswered = true;
		hideIndicator();
	};
		
	var failureFunc = function(t){

		var content = t.responseText;
		alert(content);
		hideIndicator();
	};
	
	var urlAjax = _webRoot+'/home/savePollAnswer/pollId/'+pollId+'/pollAnswerId/'+pollAnswerId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}
</script>

<?php
	sfContext::getInstance()->getResponse()->addStylesheet('poll');
	
	$pollObj = PollPeer::getRandonPoll();

	if(is_object($pollObj)):
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