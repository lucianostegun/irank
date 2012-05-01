<?php

	$scoreFormulaOption = $rankingLiveObj->getScoreFormulaOption();
	$scoreFormula       = $rankingLiveObj->getScoreFormula();
?>
	<div class="formRow">
		<label>Nome do ranking</label>
		<div class="formRight">
			<?php echo input_tag('rankingName', $rankingLiveObj->getRankingName(), array('size'=>30, 'maxlength'=>30, 'id'=>'rankingLiveRankingName')) ?>
			<div class="formNote error" id="rankingLiveFormErrorRankingName"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Modalidade</label>
		<div class="formRight">
			<?php echo select_tag('gameTypeId', VirtualTable::getOptionsForSelect('gameType', $rankingLiveObj->getGameTypeId()), array('id'=>'rankingLiveGameTypeId')) ?>
			<div class="clear"></div>
			<div class="formNote error" id="rankingLiveFormErrorGameTypeId"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Formato</label>
		<div class="formRight">
			<?php echo select_tag('gameStyleId', VirtualTable::getOptionsForSelect('gameStyle', $rankingLiveObj->getGameStyleId()), array('id'=>'rankingLiveGameStyleId')) ?>
			<div class="clear"></div>
			<div class="formNote error" id="rankingLiveFormErrorGameStyleId"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Data início</label>
		<div class="formRight">
			<?php echo input_tag('startDate', $rankingLiveObj->getStartDate('d/m/Y'), array('maxlength'=>10, 'class'=>'datepicker maskDate', 'id'=>'rankingLiveStartDate')) ?>
			<div class="formNote error" id="rankingLiveFormErrorStartDate"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Data término</label>
		<div class="formRight">
			<?php echo input_tag('finishDate', $rankingLiveObj->getFinishDate('d/m/Y'), array('maxlength'=>10, 'class'=>'datepicker maskDate', 'id'=>'rankingLiveFinishDate')) ?>
			<div class="formNote error" id="rankingLiveFormErrorFinishDate"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Ranking privado</label>
		<div class="formRight">
			<?php echo checkbox_tag('isPrivate', true, $rankingLiveObj->getIsPrivate(), array('id'=>'rankingLiveIsPrivate')) ?>
			<label for="rankingLiveIsPrivate">Apenas jogadores convidados podem participar</label>
			<div class="formNote error" id="rankingLiveFormErrorIsPrivate"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Classificação</label>
		<div class="formRight">
			<?php echo select_tag('rankingTypeId', VirtualTable::getOptionsForSelect('rankingType', $rankingLiveObj->getRankingTypeId()), array('id'=>'rankingLiveRankingTypeId')) ?>
			<div class="clear"></div>
			<div class="formNote error" id="rankingLiveFormErrorRankingTypeId"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Fórmula</label>
		<div class="formRight">
        	<span><?php echo radiobutton_tag('scoreFormulaOption', 'simple', ('simple'==$scoreFormulaOption), array('onclick'=>'handleScoreFormulaOption(this.value)', 'id'=>'rankingLiveScoreFormulaOptionSimple')) ?></span><label for="rankingLiveScoreFormulaOptionSimple">Simples</label>
        	<span><?php echo radiobutton_tag('scoreFormulaOption', 'multiple', ('multiple'==$scoreFormulaOption), array('onclick'=>'handleScoreFormulaOption(this.value)', 'id'=>'rankingLiveScoreFormulaOptionMultiple')) ?></span><label for="rankingLiveScoreFormulaOptionMultiple">Múltipla</label>
			<div class="clear mb10"></div>
			<div id="rankingLiveScoreFormulaSimpleDiv" class="clear" style="display: <?php echo ($scoreFormulaOption=='simple'?'block':'none') ?>">
				<?php echo input_tag('scoreFormula', ('simple'==$scoreFormulaOption?$scoreFormula:'1'), array('size'=>75, 'maxlength'=>150, 'id'=>'rankingLiveScoreFormula')) ?>
			</div>
			<div id="rankingLiveScoreFormulaMultipleDiv" class="clear" style="display: <?php echo ($scoreFormulaOption=='multiple'?'block':'none') ?>">
			    <?php echo input_tag('scoreFormulaCustom', ('multiple'==$scoreFormulaOption?$scoreFormula:''), array('class'=>'tags', 'style'=>'display: none', 'id'=>'rankingLiveScoreFormulaCustom')) ?>
			</div>
			<div class="clear"></div>
				<div class="formNote error" id="rankingLiveFormErrorScoreFormula"></div>
				<div class="formNote">Variáveis: POSICAO, EVENTOS, PREMIO, JOGADORES, BUYINS, BUYIN, ITM</div>
				<div class="formNote">Funções: ARRED_BAIXO(), ARRED_CIMA()</div>
		</div>
		<div class="clear"></div>
	</div>

	<?php
		$fileNameLogo = $rankingLiveObj->getFileNameLogo();
	?>
	<div class="formRow">
		<label>Logo</label>
		<div class="formRight">
			<label id="rankingLiveFileNameLogoDiv" style="height: 90px; width: 90px">
				<?php echo ($fileNameLogo?link_to(image_tag('ranking/'.$fileNameLogo), '#goToPage("rankingLive", "downloadLogo", "rankingLiveId", '.$rankingLiveObj->getId().')'):'Não disponível') ?>
			</label>
			<div class="upload">
				<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="32" height="32" id="uploadFileLink" align="middle">
					<param name="allowScriptAccess" value="sameDomain" />
					<param name="allowFullScreen" value="false" />
					<param name="FlashVars" value="scriptName=backend&moduleName=rankingLive&actionName=uploadLogo&fieldName=rankingLiveId&objectId=<?php echo $rankingLiveObj->getId() ?>&uid=<?php echo $userAdminId ?>" />
					<param name="movie" value="/flash/uploadFile.swf?scriptName=backend&moduleName=rankingLive&actionName=uploadLogo&fieldName=rankingLiveId&objectId=<?php echo $rankingLiveObj->getId() ?>&uid=<?php echo $userAdminId ?>&time=<?php echo time() ?>" />
					<param name="quality" value="high" />
					<param name="bgcolor" value="#FAFAFA" />
					<embed src="/flash/uploadFile.swf?scriptName=backend&moduleName=rankingLive&actionName=uploadLogo&fieldName=rankingLiveId&objectId=<?php echo $rankingLiveObj->getId() ?>&uid=<?php echo $userAdminId ?>&time=<?php echo time() ?>" quality="high" bgcolor="#FAFAFA" width="32" height="32" name="uploadFileLink" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
				</object>
			</div>
			<label>Imagem JPG com 90 x 90 pixels</label>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Informações</label>
		<div class="formRight">
			<?php echo textarea_tag('description', $rankingLiveObj->getDescription(), array('style'=>'height: 400px', 'id'=>'rankingLiveDescription')) ?>
			<div class="formNote error" id="rankingLiveFormErrorDescription"></div>
		</div>
		<div class="clear"></div>
	</div>