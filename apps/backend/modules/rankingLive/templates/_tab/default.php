<?php
	$allowedRebuys = $rankingLiveObj->getAllowedRebuys();
?>
	<div class="formRow">
		<label>Hora</label>
		<div class="formRight">
			<?php echo input_tag('startTime', $rankingLiveObj->getStartTime('H:i'), array('size'=>5, 'maxlength'=>5, 'onkeyup'=>'maskTime(event)', 'onblur'=>'replicateStartTime(this.value)', 'id'=>'rankingLiveStartTime')) ?>
			<div class="formNote error" id="rankingLiveFormErrorStartTime"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Buy-in</label>
		<div class="formRight">
			<span class="multi"><?php echo input_tag('buyin', Util::formatFloat($rankingLiveObj->getBuyin(), true), array('size'=>7, 'maxlength'=>7, 'onblur'=>'validateAllQuickAddEvent()', 'class'=>'textR', 'disabled'=>$rankingLiveObj->getIsFreeroll(), 'id'=>'rankingLiveBuyin')) ?></span>
			<span class="multi"><label class="text">+</label></span>
			<span class="multi"><?php echo input_tag('entranceFee', Util::formatFloat($rankingLiveObj->getEntranceFee(), true), array('size'=>7, 'maxlength'=>7, 'class'=>'textR', 'id'=>'rankingLiveEntranceFee')) ?></span>
			<span class="multi"><?php echo checkbox_tag('isFreeroll', true, $rankingLiveObj->getIsFreeroll(), array('onclick'=>'handleIsFreeroll(this.checked); validateAllQuickAddEvent()', 'id'=>'rankingLiveIsFreeroll')) ?></span>
			<span class="multi"><label for="rankingLiveIsFreeroll">Freeroll</label></span>
			<div class="clear"></div>
			<div class="formNote error" id="rankingLiveFormErrorBuyin"></div>
			<div class="formNote">Buyin + Taxa de entrada</div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow"> 
		<label>Duração dos blinds</label>
		<div class="formRight">
			<?php echo input_tag('blindTime', $rankingLiveObj->getBlindTime('H:i'), array('size'=>5, 'maxlength'=>5, 'onblur'=>'validateAllQuickAddEvent()', 'id'=>'rankingLiveBlindTime')) ?>
			<div class="formNote error" id="rankingLiveFormErrorBlindTime"></div>
			<span class="formNote">Formato: hh:mm ou 00min</span>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Stack inicial</label>
		<div class="formRight">
			<?php echo input_tag('stackChips', $rankingLiveObj->getStackChips(true), array('size'=>7, 'maxlength'=>7, 'onblur'=>'validateAllQuickAddEvent()', 'id'=>'rankingLiveStackChips')) ?>
			<div class="formNote error" id="rankingLiveFormErrorStackChips"></div>
			<span class="formNote">Formato: 00000 ou 0K</span>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Rebuys permitidos</label>
		<div class="formRight">
			<span class="multi"><?php echo input_tag('allowedRebuys', ($allowedRebuys?$allowedRebuys:0), array('size'=>1, 'maxlength'=>2, 'disabled'=>$rankingLiveObj->getIsIlimitedRebuys(), 'id'=>'rankingLiveAllowedRebuys')) ?></span>
			<span class="multi"><?php echo checkbox_tag('isIlimitedRebuys', true, $rankingLiveObj->getIsIlimitedRebuys(), array('onclick'=>'handleIsIlimitedRebuys(this.checked)', 'id'=>'rankingLiveIsIlimitedRebuys')) ?></span>
			<span class="multi"><label for="rankingLiveIsIlimitedRebuys" class="checkbox">ilimitados</label></span>
			<div class="clear"></div>
			<div class="formNote error" id="rankingLiveFormErrorAllowedRebuys"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Add-ons permitidos</label>
		<div class="formRight">
			<?php echo input_tag('allowedAddons', $rankingLiveObj->getAllowedAddons(), array('size'=>1, 'maxlength'=>2, 'id'=>'rankingLiveAllowedAddons')) ?>
			<div class="formNote error" id="rankingLiveFormErrorAllowedAddons"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<br/>
	<h5>Divulgação</h5>
	<hr/>
	<br/>

	<div class="formRow">
		<label>Template padrão</label>
		<div class="formRight">
			<span class="multi"><?php echo select_tag('emailTemplateId', EmailTemplate::getOptionsForSelectClub(($rankingLiveObj->getEmailTemplateId()|Settings::getValue('emailTemplateIdEventCreateNotify'))), array('id'=>'rankingLiveEmailTemplateIdEventCreateNotify')) ?></span>
			<div class="clear"></div>
			<div class="formNote">Template padrão de divulgação dos eventos por e-mail</div>
		</div>
		<div class="clear"></div>
	</div>
	
	<br/>
	<h5>Resultado</h5>
	<hr/>
	<br/>

	<div class="formRow">
		<label>Rake</label>
		<div class="formRight">
			<span class="multi"><?php echo input_tag('rakePercent', Util::formatFloat($rankingLiveObj->getRakePercent(), true), array('size'=>7, 'maxlength'=>7, 'class'=>'textR', 'id'=>'rankingLiveRakePercent')) ?></span>
			<span class="multi"><label class="text">%</label></span>
			<div class="clear"></div>
			<div class="formNote error" id="rankingLiveFormErrorRakePercent"></div>
			<div class="formNote">Porcentagem do clube</div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Divisão do prêmio</label>
		<div class="formRight">
			<span class="multi"><?php echo input_tag('prizeSplit', $rankingLiveObj->getPrizeSplit(), array('size'=>60, 'onkeyup'=>'updatePrizeSplitLabel()', 'id'=>'rankingLivePrizeSplit')) ?></span>
			<span class="multi"><label id="prizeSplitTotalLabel"><?php echo Util::formatFloat($rankingLiveObj->getTotalPercentPrizeSplit()) ?>%</label></span>
			<div class="clear"></div>
			<div class="formNote error" id="rankingLiveFormErrorPrizeSplit"></div>
			<div class="formNote">Formato: 25%; 15%; 7,5%, ...</div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Divulgar premiação</label>
		<div class="formRight">
			<?php echo checkbox_tag('publishPrize', true, $rankingLiveObj->getPublishPrize(), array('id'=>'rankingLivePublishPrize')) ?>
		</div>
		<div class="clear"></div>
	</div>