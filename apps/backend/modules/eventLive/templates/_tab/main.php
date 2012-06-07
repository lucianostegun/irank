<?php
	$isNew         = $eventLiveObj->getIsNew();
	$clubId        = $eventLiveObj->getClubId();
	$rankingLiveId = $eventLiveObj->getRankingLiveId();
	$savedResult   = $eventLiveObj->getSavedResult();
	$isMultiday    = $eventLiveObj->getIsMultiday();
	
	if( !$clubId )
		$clubId = $sf_user->getAttribute('clubId');
	
	$allowedRebuys = $eventLiveObj->getAllowedRebuys();
	
	if( !$isNew || !$iRankAdmin ){
		
		echo input_hidden_tag('clubId', $clubId, array('id'=>'eventLiveClubId'));
		
		if( !$isNew )
			echo input_hidden_tag('rankingLiveId', $rankingLiveId, array('id'=>'eventLiveRankingLiveId'));
	}
	
	$eventLiveScheduleObjList = $eventLiveObj->getScheduleList();
	
	echo input_hidden_tag(($savedResult?'eventDate':'eventDateTmp'), $eventLiveObj->getEventDate('d/m/Y'), array('id'=>'eventLiveEventDateTmp'));
	echo input_hidden_tag('stepDayCurrentIndex', count($eventLiveScheduleObjList)-1, array('id'=>'eventLiveStepDayCurrentIndex'));
?>
	<?php if( $iRankAdmin ): ?>
	<div class="formRow">
		<label>Clube</label>
		<div class="formRight">
			<?php if( $isNew ): ?>
			<?php echo select_tag('clubId', Club::getOptionsForSelect($clubId), array('onchange'=>'loadSelectField(this, "rankingLive", "eventLiveRankingLiveIdDiv", "eventLiveRankingLiveId")', 'id'=>'eventLiveClubId')) ?>
			<div class="clear"></div>
			<div class="formNote error" id="eventLiveFormErrorClubId"></div>
			<?php else: ?>
			<label><?php echo $eventLiveObj->getClub()->toString() ?></label>
			<?php endif; ?>
		</div>
		<div class="clear"></div>
	</div>
	<?php endif; ?>

	<div class="formRow">
		<label>Ranking</label>
		<div class="formRight" id="eventLiveRankingLiveIdDiv">
			<?php if( $isNew ): ?>
			<?php echo select_tag('rankingLiveId', RankingLive::getOptionsForSelect($eventLiveObj->getClubId()|$clubId, $rankingLiveId), array('onchange'=>'loadDefaultValues(this.value); loadEventStats()', 'id'=>'eventLiveRankingLiveId')) ?>
			<div class="clear"></div>
			<div class="formNote error" id="eventLiveFormErrorRankingLiveId"></div>
			<?php else: ?>
			<label><?php echo $eventLiveObj->getRankingLive()->toString() ?></label>
			<?php endif; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Etapa / Título</label>
		<div class="formRight">
			<?php echo input_tag('stepNumber', $eventLiveObj->getStepNumber(), array('size'=>3, 'maxlength'=>2, 'onblur'=>'updateEventNamePreview()', 'id'=>'eventLiveEventStepNumber')) ?>
			<?php echo input_tag('eventName', $eventLiveObj->getEventName(), array('size'=>50, 'maxlength'=>100, 'onblur'=>'replicateEventName(this.value); updateEventNamePreview()', 'id'=>'eventLiveEventName')) ?>
			<div class="formNote error" id="eventLiveFormErrorEventStepNumber"></div>
			<div class="formNote error" id="eventLiveFormErrorEventName"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow hidden">
		<label>Nome curto</label>
		<div class="formRight">
			<?php echo input_tag('eventShortName', $eventLiveObj->getEventShortName(), array('size'=>50, 'maxlength'=>100, 'id'=>'eventLiveEventShortName')) ?>
			<div class="formNote error" id="eventLiveFormErrorEventShortName"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Garantido</label>
		<div class="formRight">
			<?php echo input_tag('guaranteedPrize', Util::formatFloat($eventLiveObj->getGuaranteedPrize(), true), array('size'=>10, 'maxlength'=>10, 'class'=>'textR', 'onblur'=>'updateEventNamePreview()', 'id'=>'eventLiveGuaranteedPrize')) ?>
			<div class="formNote error" id="eventLiveFormErrorGuaranteedPrize"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Preview</label>
		<div class="formRight">
			<label style="margin-right: 5px" id="eventLiveEventNamePreview">
				<?php
					$eventNamePreview = $eventLiveObj->toString();
					echo nvl($eventNamePreview, 'Preview do nome do evento');
				?>
			</label>
			<label style="color: #909090"> - Dia X</label>
		</div>
		<div class="clear"></div>
	</div>
	

	<div class="formRow">
		<label class="">Múltiplos dias</label>
		<div class="formRight">
			<?php echo checkbox_tag('isMultiday', true, $isMultiday, array('onclick'=>'handleIsMultiday(this.checked)', 'id'=>'eventLiveIsMultiday')) ?>
			<div class="clear"></div>
			<div class="formNote error" id="eventLiveFormErrorIsMultiday"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow <?php echo ($isMultiday?'hidden':'') ?>" id="eventLiveEventDateRowDiv">
		<label class="">Data/Hora</label>
		<div class="formRight">
			<div>
				<span class="multi"><?php echo input_tag((!$savedResult?'eventDate':'eventDateOld'), $eventLiveObj->getEventDate('d/m/Y'), array('disabled'=>$savedResult, 'maxlength'=>10, 'class'=>'maskDate', 'id'=>'eventLiveEventDate')) ?></span>
				<span class="multi"><?php echo input_tag('startTime', $eventLiveObj->getStartTime('H:i'), array('size'=>5, 'maxlength'=>5, 'onkeyup'=>'maskTime(event)', 'id'=>'eventLiveStartTime')) ?></span>
			</div>
			<div class="clear"></div>
			<div class="formNote error" id="eventLiveFormErrorEventDate"></div>
			<div class="formNote error" id="eventLiveFormErrorStartTime"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow <?php echo ($isMultiday?'':'hidden') ?>" id="eventLiveStepDayRowDiv">
		<label class="">Dia / Data / Hora</label>
		<div class="formRight">
			<div class="formRight" id="eventLiveStepDayListDiv">
				<?php foreach($eventLiveScheduleObjList as $key=>$eventLiveScheduleObj): ?>
				<?php if( $key > 0 ): ?><div class="clear mt6"></div><?php endif; ?>
				<div id="eventLiveStepDayRow-<?php echo $key ?>">
					<span class="multi"><?php echo input_tag('stepDay[]', $eventLiveScheduleObj->getStepDay(), array('size'=>5, 'maxlength'=>5, 'id'=>'eventLiveStepDay')) ?></span>
					<span class="multi"><?php echo input_tag('stepEventDate[]', $eventLiveScheduleObj->getEventDate('d/m/Y'), array('disabled'=>$savedResult, 'maxlength'=>10, 'class'=>'stepEventDate maskDate', 'id'=>'eventLiveStepEventDate-')) ?></span>
					<span class="multi"><?php echo input_tag('stepStartTime[]', $eventLiveScheduleObj->getStartTime('H:i'), array('size'=>5, 'maxlength'=>5, 'onkeyup'=>'maskTime(event)', 'id'=>'eventLiveStepStartTime')) ?></span>
					<?php if( $key==0 ): ?>
					<span class="multi"><?php echo link_to(image_tag('backend/icons/color/plus', array('title'=>'Adicionar dia', 'class'=>'mt7')), '#addStepDay()') ?></span>
					<?php else: ?>
					<span class="multi"><?php echo link_to(image_tag('backend/icons/color/cross', array('title'=>'Excluir dia', 'class'=>'mt7')), '#removeStepDay('.$key.')') ?></span>
					<?php endif; ?>
					<div class="clear"></div>
				</div>
				<?php endforeach; ?>
			</div>
			<div class="clear"></div>
			<div class="formNote error" id="eventLiveFormErrorStepDay"></div>
			<div class="formNote error" id="eventLiveFormErrorStepEventDate"></div>
			<div class="formNote error" id="eventLiveFormErrorStepStartTime"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Buy-in</label>
		<div class="formRight">
			<span class="multi"><?php echo input_tag('buyin', Util::formatFloat($eventLiveObj->getBuyin(), true), array('size'=>7, 'maxlength'=>7, 'class'=>'textR', 'onkeyup'=>'updateMainBalanceByEventLive()', 'disabled'=>$eventLiveObj->getIsFreeroll(), 'id'=>'eventLiveBuyin')) ?></span>
			<span class="multi"><label class="text">+</label></span>
			<span class="multi"><?php echo input_tag('entranceFee', Util::formatFloat($eventLiveObj->getEntranceFee(), true), array('size'=>7, 'maxlength'=>7, 'class'=>'textR', 'onkeyup'=>'updateMainBalanceByEventLive()', 'id'=>'eventLiveEntranceFee')) ?></span>
			<span class="multi"><?php echo checkbox_tag('isFreeroll', true, $eventLiveObj->getIsFreeroll(), array('onclick'=>'handleIsFreeroll(this.checked)', 'id'=>'eventLiveIsFreeroll')) ?></span>
			<span class="multi"><label for="eventLiveIsFreeroll">Freeroll</label></span>
			<div class="clear"></div>
			<div class="formNote error" id="eventLiveFormErrorBuyin"></div>
			<div class="formNote">Buyin + Taxa de entrada</div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Rake</label>
		<div class="formRight">
			<span class="multi"><?php echo input_tag('rakePercent', Util::formatFloat($eventLiveObj->getRakePercent(), true), array('size'=>7, 'maxlength'=>7, 'class'=>'textR', 'id'=>'eventLiveRakePercent')) ?></span>
			<span class="multi"><label class="text">%</label></span>
			<div class="clear"></div>
			<div class="formNote error" id="eventLiveFormErrorRakePercent"></div>
			<div class="formNote">Porcentagem do clube</div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Duração dos blinds</label>
		<div class="formRight">
			<?php echo input_tag('blindTime', $eventLiveObj->getBlindTime('H:i'), array('size'=>5, 'maxlength'=>5, 'id'=>'eventLiveBlindTime')) ?>
			<div class="formNote error" id="eventLiveFormErrorBlindTime"></div>
			<span class="formNote">Formato: hh:mm ou 00min</span>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Stack inicial</label>
		<div class="formRight">
			<?php echo input_tag('stackChips', $eventLiveObj->getStackChips(true), array('size'=>7, 'maxlength'=>7, 'id'=>'eventLiveStackChips')) ?>
			<div class="formNote error" id="eventLiveFormErrorStackChips"></div>
			<span class="formNote">Formato: 00000 ou 0K</span>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Rebuys permitidos</label>
		<div class="formRight">
			<span class="multi"><?php echo input_tag('allowedRebuys', ($allowedRebuys?$allowedRebuys:0), array('size'=>1, 'maxlength'=>2, 'disabled'=>$eventLiveObj->getIsIlimitedRebuys(), 'id'=>'eventLiveAllowedRebuys')) ?></span>
			<span class="multi"><?php echo checkbox_tag('ilimitedRebuys', true, $eventLiveObj->getIsIlimitedRebuys(), array('onclick'=>'handleIsIlimitedRebuys(this.checked)', 'id'=>'eventLiveIsIlimitedRebuys')) ?></span>
			<span class="multi"><label for="eventLiveIsIlimitedRebuys" class="checkbox">ilimitados</label></span>
			<div class="clear"></div>
			<div class="formNote error" id="eventLiveFormErrorAllowedRebuys"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Add-ons permitidos</label>
		<div class="formRight">
			<?php echo input_tag('allowedAddons', $eventLiveObj->getAllowedAddons(), array('size'=>1, 'maxlength'=>2, 'id'=>'eventLiveAllowedAddons')) ?>
			<div class="formNote error" id="eventLiveFormErrorAllowedAddons"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Nº de mesas</label>
		<div class="formRight">
			<?php echo input_tag('tablesNumber', $eventLiveObj->getTablesNumber(), array('size'=>1, 'maxlength'=>2, 'id'=>'eventLiveTablesNumber')) ?>
			<div class="formNote error" id="eventLiveFormErrorTablesNumber"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Informações</label>
		<div class="formRight" style="width: 70%">
			<?php echo textarea_tag('description', $eventLiveObj->getDescription(false), array('style'=>'height: 400px', 'id'=>'eventLiveDescription')) ?>
			<div class="formNote error" id="eventLiveFormErrorDescription"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Observações</label>
		<div class="formRight" style="width: 70%">
			<?php echo textarea_tag('comments', $eventLiveObj->getComments(), array('style'=>'height: 150px', 'id'=>'eventLiveComments')) ?>
			<div class="formNote error" id="eventLiveFormErrorComments"></div>
		</div>
		<div class="clear"></div>
	</div>