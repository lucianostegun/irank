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
	<?php
		$pollImage = $pollObj->getPollImage(true);
	?>
	<div class="formRow">
		<label>Imagem</label>
		<div class="formRight">
			<label id="pollPollImageDiv" style="height: 130px; width: 130px">
				<?php echo ($pollImage?link_to(image_tag('poll/'.$pollImage), '#goToPage("poll", "downloadImage", "pollId", '.$pollObj->getId().')'):'Não disponível') ?>
			</label>
			<div class="upload">
				<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="32" height="32" id="uploadFileLink" align="middle">
					<param name="allowScriptAccess" value="sameDomain" />
					<param name="allowFullScreen" value="false" />
					<param name="FlashVars" value="scriptName=backend&moduleName=poll&actionName=uploadImage&fieldName=pollId&objectId=<?php echo $pollObj->getId() ?>&uid=<?php echo $userAdminId ?>" />
					<param name="movie" value="/flash/uploadFile.swf?scriptName=backend&moduleName=poll&actionName=uploadImage&fieldName=pollId&objectId=<?php echo $pollObj->getId() ?>&uid=<?php echo $userAdminId ?>&time=<?php echo time() ?>" />
					<param name="quality" value="high" />
					<param name="bgcolor" value="#FAFAFA" />
					<embed src="/flash/uploadFile.swf?scriptName=backend&moduleName=poll&actionName=uploadImage&fieldName=pollId&objectId=<?php echo $pollObj->getId() ?>&uid=<?php echo $userAdminId ?>&time=<?php echo time() ?>" quality="high" bgcolor="#FAFAFA" width="32" height="32" name="uploadFileLink" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
				</object>
			</div>
			<label>Imagem JPG com 90 x 100 pixels</label>
		</div>
		<div class="clear"></div>
	</div>
	
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