<?php
	echo form_remote_tag(array(
		'url'=>'eventLive/save',
		'success'=>'handleSuccessEventLive(response)',
		'failure'=>'handleFailureEventLive(response.responseText)',
		),
		array('class'=>'form', 'id'=>'eventLiveForm'));
//	echo form_tag('eventLive/save', array('class'=>'form', 'id'=>'eventLiveForm'));
	
	echo input_hidden_tag('eventLiveId', $eventLiveObj->getId());
	
	if( !$iRankAdmin )
		echo input_hidden_tag('clubId', $clubId);
?>

	<?php if( $iRankAdmin ): ?>
	<div class="formRow">
		<label>Clube</label>
		<div class="formRight"><?php echo select_tag('clubId', Club::getOptionsForSelect($eventLiveObj->getClubId()), array('onchange'=>'loadSelectField(this, "rankingLive", "eventLiveRankingLiveIdDiv", "eventLiveRankingLiveId")', 'id'=>'eventLiveClubId')) ?></div>
		<div class="clear"></div>
	</div>
	<?php endif; ?>

	<div class="formRow">
		<label>Ranking</label>
		<div class="formRight" id="eventLiveRankingLiveIdDiv"><?php echo select_tag('rankingLiveId', RankingLive::getOptionsForSelect($eventLiveObj->getClubId()|$clubId, $eventLiveObj->getRankingLiveId()), array('onchange'=>'loadDefaultValues(this.value)', 'id'=>'eventLiveRankingLiveId')) ?></div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Nome do evento</label>
		<div class="formRight"><?php echo input_tag('eventName', $eventLiveObj->getEventName(), array('size'=>50, 'maxlength'=>100, 'onblur'=>'replicateEventName(this.value)', 'id'=>'eventLiveEventName')) ?></div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Nome curto</label>
		<div class="formRight"><?php echo input_tag('eventShortName', $eventLiveObj->getEventShortName(), array('size'=>30, 'maxlength'=>40, 'id'=>'eventLiveEventShortName')) ?></div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Data</label>
		<div class="formRight"><?php echo input_date_tag('eventDate', $eventLiveObj->getEventDate(), array('id'=>'eventLiveEventDate')) ?></div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Hora</label>
		<div class="formRight"><?php echo input_tag('startTime', $eventLiveObj->getStartTime('H:i'), array('size'=>5, 'maxlength'=>5, 'onkeyup'=>'maskTime(event)', 'id'=>'eventLiveStartTime')) ?></div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Buy-in</label>
		<div class="formRight">
			<span class="multi"><?php echo input_tag('entranceFee', Util::formatFloat($eventLiveObj->getEntranceFee(), true), array('size'=>7, 'maxlength'=>7, 'class'=>'textR', 'id'=>'eventLiveEntranceFee')) ?></span>
			<span class="multi"><label class="text">+</label></span>
			<span class="multi"><?php echo input_tag('buyin', Util::formatFloat($eventLiveObj->getBuyin(), true), array('size'=>7, 'maxlength'=>7, 'class'=>'textR', 'disabled'=>$eventLiveObj->getIsFreeroll(), 'id'=>'eventLiveBuyin')) ?></span>
			<span class="multi"><?php echo checkbox_tag('isFreeroll', true, $eventLiveObj->getIsFreeroll(), array('onclick'=>'handleIsFreeroll(this.checked)', 'id'=>'eventLiveIsFreeroll')) ?></span>
			<span class="multi"><label for="eventLiveIsFreeroll">Freeroll</label></span>
			<div class="clear"></div>
			<div class="formNote">Taxa de entrada + Buyin</div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Rake</label>
		<div class="formRight">
			<span class="multi"><?php echo input_tag('rakePercent', Util::formatFloat($eventLiveObj->getrakePercent(), true), array('size'=>7, 'maxlength'=>7, 'class'=>'textR', 'id'=>'eventLiveRakePercent')) ?></span>
			<span class="multi"><label class="text">%</label></span>
			<div class="clear"></div>
			<div class="formNote">Porcentagem do clube</div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Duração dos blinds</label>
		<div class="formRight">
			<?php echo input_tag('blindTime', $eventLiveObj->getBlindTime('H:i'), array('size'=>5, 'maxlength'=>5, 'onkeyup'=>'maskTime(event)', 'id'=>'eventLiveBlindTime')) ?>
			<span class="formNote">Formato: hh:mm</span>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Stack inicial</label>
		<div class="formRight">
			<?php echo input_tag('stackChips', $eventLiveObj->getStackChips(), array('size'=>7, 'maxlength'=>7, 'id'=>'eventLiveStackChips')) ?>
			<span class="formNote">Formato: 00000 ou 0K</span>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Rebuys permitidos</label>
		<div class="formRight">
			<span class="multi"><?php echo input_tag('allowedRebuys', $eventLiveObj->getAllowedRebuys(), array('size'=>1, 'maxlength'=>2, 'disabled'=>$eventLiveObj->getIsIlimitedRebuys(), 'id'=>'eventLiveAllowedRebuys')) ?></span>
			<span class="multi"><?php echo checkbox_tag('ilimitedRebuys', true, $eventLiveObj->getIsIlimitedRebuys(), array('onclick'=>'handleIsIlimitedRebuys(this.checked)', 'id'=>'eventLiveIsIlimitedRebuys')) ?></span>
			<span class="multi"><label for="eventLiveIsIlimitedRebuys" class="checkbox">ilimitados</label></span>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Add-ons permitidos</label>
		<div class="formRight"><?php echo input_tag('allowedAddons', $eventLiveObj->getAllowedAddons(), array('size'=>1, 'maxlength'=>2, 'id'=>'eventLiveAllowedAddons')) ?></div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Informações</label>
		<div class="formRight"><?php echo textarea_tag('description', $eventLiveObj->getDescription(false), array('style'=>'height: 400px', 'id'=>'eventLiveDescription')) ?></div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Observações</label>
		<div class="formRight"><?php echo textarea_tag('comments', $eventLiveObj->getComments(), array('style'=>'height: 150px', 'id'=>'eventLiveComments')) ?></div>
		<div class="clear"></div>
	</div>
</form>