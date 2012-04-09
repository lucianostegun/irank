<?php include_partial('home/include/formHeader', array('prefix'=>'rankingLive')) ?>
<div class="module_content">
	<div class="defaultForm" style="float: left; width: 50%">
		
		<section>
			<label>Nome do ranking</label>
			<?php echo input_tag('rankingName', $rankingLiveObj->getRankingName(), array('size'=>30, 'maxlength'=>30, 'id'=>'rankingLiveRankingName')) ?>
		</section>

		<section>
			<label>Modalidade</label>
			<?php echo select_tag('gameTypeId', VirtualTable::getOptionsForSelect('gameType', $rankingLiveObj->getGameTypeId()), array('id'=>'rankingLiveGameTypeId')) ?>
		</section>

		<section>
			<label>Formato</label>
			<?php echo select_tag('gameStyleId', VirtualTable::getOptionsForSelect('gameStyle', $rankingLiveObj->getGameStyleId()), array('id'=>'rankingLiveGameStyleId')) ?>
		</section>

		<section>
			<label>Data início</label>
			<?php echo input_date_tag('startDate', $rankingLiveObj->getStartDate(), array('id'=>'rankingLiveStartDate')) ?>
		</section>

		<section>
			<label>Data término</label>
			<?php echo input_date_tag('finishDate', $rankingLiveObj->getFinishDate(), array('id'=>'rankingLiveFinishDate')) ?>
		</section>

		<section>
			<label>Ranking privado</label>
			<?php echo checkbox_tag('isPrivate', true, $rankingLiveObj->getIsPrivate(), array('id'=>'rankingLiveIsPrivate')) ?>
			<div class="text">Apenas jogadores convidados podem participar</div>
		</section>

		<section>
			<label>Buy-in padrão</label>
			<?php echo input_tag('defaultBuyin', Util::formatFloat($rankingLiveObj->getDefaultBuyin(), true), array('size'=>8, 'maxlength'=>8, 'id'=>'rankingLiveDefaultBuyin')) ?>
		</section>

		<section>
			<label>Taxa entrada padrão</label>
			<?php echo input_tag('defaultEntranceFee', Util::formatFloat($rankingLiveObj->getDefaultEntranceFee(), true), array('size'=>8, 'maxlength'=>8, 'id'=>'rankingLiveDefaultEntranceFee')) ?>
		</section>

		<section>
			<label>Classificação</label>
			<?php echo select_tag('rankingTypeId', VirtualTable::getOptionsForSelect('rankingType', $rankingLiveObj->getRankingTypeId()), array('id'=>'rankingLiveRankingTypeId')) ?>
		</section>

		<section>
			<label>Fórmula</label>
			<?php echo input_tag('scoreFormula', $rankingLiveObj->getScoreFormula(), array('size'=>45, 'maxlength'=>150, 'id'=>'rankingLiveScoreFormula')) ?>
		</section>
		
		<?php
			$fileNameLogo = $rankingLiveObj->getFileNameLogo(true);
		?>
		<section>
			<label>Logo</label>
			<div class="text" style="min-width: 100px" id="rankingLiveFileNameLogoDiv"><?php echo ($fileNameLogo?link_to($fileNameLogo, '#goToPage("rankingLive", "downloadLogo", "rankingLiveId", '.$rankingLiveObj->getId().')'):'Não disponível') ?></div>
			<div class="upload">
				<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="16" height="16" id="uploadFileLink" align="middle">
					<param name="allowScriptAccess" value="sameDomain" />
					<param name="allowFullScreen" value="false" />
					<param name="FlashVars" value="scriptName=backend&moduleName=rankingLive&actionName=uploadLogo&fieldName=rankingLiveId&objectId=<?php echo $rankingLiveObj->getId() ?>&uid=<?php echo $userAdminId ?>" />
					<param name="movie" value="/flash/uploadFile.swf?scriptName=backend&moduleName=rankingLive&actionName=uploadLogo&fieldName=rankingLiveId&objectId=<?php echo $rankingLiveObj->getId() ?>&uid=<?php echo $userAdminId ?>&time=<?php echo time() ?>" />
					<param name="quality" value="high" />
					<param name="bgcolor" value="#E5E5E5" />
					<embed src="/flash/uploadFile.swf?scriptName=backend&moduleName=rankingLive&actionName=uploadLogo&fieldName=rankingLiveId&objectId=<?php echo $rankingLiveObj->getId() ?>&uid=<?php echo $userAdminId ?>&time=<?php echo time() ?>" quality="high" bgcolor="#E5E5E5" width="16" height="16" name="uploadFileLink" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
				</object>
			</div>
			<div class="text">Imagem JPG com 90 x 90 pixels</div>
		</section>
	</div>
	<div class="defaultForm" style="float: left; width: 50%; height: 300px">
		<?php
			if( $iRankAdmin )
				include_partial('rankingLive/include/club', array('rankingLiveObj'=>$rankingLiveObj));
		?>
	</div>
	<div class="defaultForm" style="clear: both; width: 100%">
		<section class="textarea" style="height: 570px">
			<label>Informações</label>
			<?php echo textarea_tag('description', $rankingLiveObj->getDescription(), array('style'=>'width: 80%; height: 550px', 'id'=>'rankingLiveDescription')) ?>
		</section>	
	</div>

		
	<div class="clear"></div>
	
</div>