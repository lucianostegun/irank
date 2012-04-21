<?php
	echo form_remote_tag(array(
		'url'=>'eventLive/save',
		'success'=>'handleSuccessEventLive(response)',
		'failure'=>'handleFailureEventLive(response.responseText)',
		'loading'=>'showIndicator();',
		),
		array('class'=>'form', 'id'=>'eventLiveForm'));
//	echo form_tag('eventLive/save', array('class'=>'form', 'id'=>'eventLiveForm'));

	$isNew         = $eventLiveObj->getIsNew();
	$clubId        = $eventLiveObj->getClubId();
	$rankingLiveId = $eventLiveObj->getRankingLiveId();
	
	echo input_hidden_tag('eventLiveId', $eventLiveObj->getId());
	
	if( !$isNew || !$iRankAdmin ){
		
		echo input_hidden_tag('clubId', $clubId, array('id'=>'eventLiveClubId'));
		
		if( !$isNew )
			echo input_hidden_tag('rankingLiveId', $rankingLiveId, array('id'=>'eventLiveRankingLiveId'));
	}
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
			<?php echo select_tag('rankingLiveId', RankingLive::getOptionsForSelect($eventLiveObj->getClubId()|$clubId, $rankingLiveId), array('onchange'=>'loadDefaultValues(this.value)', 'id'=>'eventLiveRankingLiveId')) ?>
			<div class="clear"></div>
			<div class="formNote error" id="eventLiveFormErrorRankingLiveId"></div>
			<?php else: ?>
			<label><?php echo $eventLiveObj->getRankingLive()->toString() ?></label>
			<?php endif; ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Nome do evento</label>
		<div class="formRight">
			<?php echo input_tag('eventName', $eventLiveObj->getEventName(), array('size'=>50, 'maxlength'=>100, 'onblur'=>'replicateEventName(this.value)', 'id'=>'eventLiveEventName')) ?>
			<div class="formNote error" id="eventLiveFormErrorEventName"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Nome curto</label>
		<div class="formRight">
			<?php echo input_tag('eventShortName', $eventLiveObj->getEventShortName(), array('size'=>30, 'maxlength'=>40, 'id'=>'eventLiveEventShortName')) ?>
			<div class="formNote error" id="eventLiveFormErrorEventShortName"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Data</label>
		<div class="formRight">
			<?php echo input_tag('eventDate', $eventLiveObj->getEventDate('d/m/Y'), array('maxlength'=>10, 'class'=>'datepicker maskDate', 'id'=>'eventLiveEventDate')) ?>
			<div class="formNote error" id="eventLiveFormErrorEventDate"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Hora</label>
		<div class="formRight">
			<?php echo input_tag('startTime', $eventLiveObj->getStartTime('H:i'), array('size'=>5, 'maxlength'=>5, 'onkeyup'=>'maskTime(event)', 'id'=>'eventLiveStartTime')) ?>
			<div class="formNote error" id="eventLiveFormErrorStartTime"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Buy-in</label>
		<div class="formRight">
			<span class="multi"><?php echo input_tag('buyin', Util::formatFloat($eventLiveObj->getBuyin(), true), array('size'=>7, 'maxlength'=>7, 'class'=>'textR', 'disabled'=>$eventLiveObj->getIsFreeroll(), 'id'=>'eventLiveBuyin')) ?></span>
			<span class="multi"><label class="text">+</label></span>
			<span class="multi"><?php echo input_tag('entranceFee', Util::formatFloat($eventLiveObj->getEntranceFee(), true), array('size'=>7, 'maxlength'=>7, 'class'=>'textR', 'id'=>'eventLiveEntranceFee')) ?></span>
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
			<?php echo input_tag('blindTime', $eventLiveObj->getBlindTime('H:i'), array('size'=>5, 'maxlength'=>5, 'onkeyup'=>'maskTime(event)', 'id'=>'eventLiveBlindTime')) ?>
			<div class="formNote error" id="eventLiveFormErrorBlindTime"></div>
			<span class="formNote">Formato: hh:mm</span>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Stack inicial</label>
		<div class="formRight">
			<?php echo input_tag('stackChips', $eventLiveObj->getStackChips(), array('size'=>7, 'maxlength'=>7, 'id'=>'eventLiveStackChips')) ?>
			<div class="formNote error" id="eventLiveFormErrorStackChips"></div>
			<span class="formNote">Formato: 00000 ou 0K</span>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Rebuys permitidos</label>
		<div class="formRight">
			<span class="multi"><?php echo input_tag('allowedRebuys', ($allowedRebuys=$eventLiveObj->getAllowedRebuys()?$allowedRebuys:0), array('size'=>1, 'maxlength'=>2, 'disabled'=>$eventLiveObj->getIsIlimitedRebuys(), 'id'=>'eventLiveAllowedRebuys')) ?></span>
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
		<label>Informações</label>
		<div class="formRight">
			<?php echo textarea_tag('description', $eventLiveObj->getDescription(false), array('style'=>'height: 400px', 'id'=>'eventLiveDescription')) ?>
			<div class="formNote error" id="eventLiveFormErrorDescription"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Observações</label>
		<div class="formRight">
			<?php echo textarea_tag('comments', $eventLiveObj->getComments(), array('style'=>'height: 150px', 'id'=>'eventLiveComments')) ?>
			<div class="formNote error" id="eventLiveFormErrorComments"></div>
		</div>
		<div class="clear"></div>
	</div>
</form>