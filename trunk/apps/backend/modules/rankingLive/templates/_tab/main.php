<?php
	echo form_remote_tag(array(
		'url'=>'rankingLive/save',
		'success'=>'handleSuccessRankingLive(response)',
		'failure'=>'handleFailureRankingLive(response.responseText)',
		),
		array('class'=>'form', 'id'=>'rankingLiveForm'));

	$iRankAdmin  = $sf_user->hasCredential('iRankAdmin');
	$userAdminId = $sf_user->getAttribute('userAdminId');
	$clubId      = $sf_user->getAttribute('clubId');
	
	echo input_hidden_tag('rankingLiveId', $rankingLiveObj->getId());
	
	if( !$iRankAdmin && $clubId )
		echo input_hidden_tag('clubId', $clubId);
?>
	<div class="formRow">
		<label>Nome do ranking</label>
		<div class="formRight"><?php echo input_tag('rankingName', $rankingLiveObj->getRankingName(), array('size'=>30, 'maxlength'=>30, 'id'=>'rankingLiveRankingName')) ?></div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Modalidade</label>
		<div class="formRight"><?php echo select_tag('gameTypeId', VirtualTable::getOptionsForSelect('gameType', $rankingLiveObj->getGameTypeId()), array('id'=>'rankingLiveGameTypeId')) ?></div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Formato</label>
		<div class="formRight"><?php echo select_tag('gameStyleId', VirtualTable::getOptionsForSelect('gameStyle', $rankingLiveObj->getGameStyleId()), array('id'=>'rankingLiveGameStyleId')) ?></div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Data início</label>
		<div class="formRight"><?php echo input_date_tag('startDate', $rankingLiveObj->getStartDate(), array('class'=>'calendar', 'id'=>'rankingLiveStartDate')) ?></div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Data término</label>
		<div class="formRight"><?php echo input_date_tag('finishDate', $rankingLiveObj->getFinishDate(), array('class'=>'calendar', 'id'=>'rankingLiveFinishDate')) ?></div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Ranking privado</label>
		<div class="formRight">
			<?php echo checkbox_tag('isPrivate', true, $rankingLiveObj->getIsPrivate(), array('id'=>'rankingLiveIsPrivate')) ?>
			<label for="rankingLiveIsPrivate">Apenas jogadores convidados podem participar</label>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Buy-in padrão</label>
		<div class="formRight"><?php echo input_tag('defaultBuyin', Util::formatFloat($rankingLiveObj->getDefaultBuyin(), true), array('size'=>8, 'maxlength'=>8, 'id'=>'rankingLiveDefaultBuyin')) ?></div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Taxa entrada padrão</label>
		<div class="formRight"><?php echo input_tag('defaultEntranceFee', Util::formatFloat($rankingLiveObj->getDefaultEntranceFee(), true), array('size'=>8, 'maxlength'=>8, 'id'=>'rankingLiveDefaultEntranceFee')) ?></div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Classificação</label>
		<div class="formRight"><?php echo select_tag('rankingTypeId', VirtualTable::getOptionsForSelect('rankingType', $rankingLiveObj->getRankingTypeId()), array('id'=>'rankingLiveRankingTypeId')) ?></div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Fórmula</label>
		<div class="formRight"><?php echo input_tag('scoreFormula', $rankingLiveObj->getScoreFormula(), array('size'=>45, 'maxlength'=>150, 'id'=>'rankingLiveScoreFormula')) ?></div>
		<div class="clear"></div>
	</div>
	<?php
		$fileNameLogo = $rankingLiveObj->getFileNameLogo(true);
	?>
	<div class="formRow">
		<label>Logo</label>
		<div class="formRight">
			<label id="rankingLiveFileNameLogoDiv"><?php echo ($fileNameLogo?link_to($fileNameLogo, '#goToPage("rankingLive", "downloadLogo", "rankingLiveId", '.$rankingLiveObj->getId().')'):'Não disponível') ?></label>
			<div class="upload">
				<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="16" height="16" id="uploadFileLink" align="middle">
					<param name="allowScriptAccess" value="sameDomain" />
					<param name="allowFullScreen" value="false" />
					<param name="FlashVars" value="scriptName=backend&moduleName=rankingLive&actionName=uploadLogo&fieldName=rankingLiveId&objectId=<?php echo $rankingLiveObj->getId() ?>&uid=<?php echo $userAdminId ?>" />
					<param name="movie" value="/flash/uploadFile.swf?scriptName=backend&moduleName=rankingLive&actionName=uploadLogo&fieldName=rankingLiveId&objectId=<?php echo $rankingLiveObj->getId() ?>&uid=<?php echo $userAdminId ?>&time=<?php echo time() ?>" />
					<param name="quality" value="high" />
					<param name="bgcolor" value="#FAFAFA" />
					<embed src="/flash/uploadFile.swf?scriptName=backend&moduleName=rankingLive&actionName=uploadLogo&fieldName=rankingLiveId&objectId=<?php echo $rankingLiveObj->getId() ?>&uid=<?php echo $userAdminId ?>&time=<?php echo time() ?>" quality="high" bgcolor="#FAFAFA" width="16" height="16" name="uploadFileLink" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
				</object>
			</div>
			<label>Imagem JPG com 90 x 90 pixels</label>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Informações</label>
		<div class="formRight"><?php echo textarea_tag('description', $rankingLiveObj->getDescription(), array('style'=>'height: 400px', 'id'=>'rankingLiveDescription')) ?></div>
		<div class="clear"></div>
	</div>
</form>