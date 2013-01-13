<?php
	$permalink = $eventObj->getPermalink(true);
?>
<div style="margin-top: 5px" class="defaultForm">
	<?php if( Util::isDebug() ): ?>
	<div class="row">
		<div class="label">Cód.</div>
		<div class="text"><?php echo $eventObj->getCode() ?></div>
	</div>
	<?php endif; ?>
	
	<div class="row">
		<div class="label" id="eventRankingIdLabel">Ranking</div>
		<?php if( !$eventObj->getEnabled() ): ?>
			<div class="field" id="rankinkIdFieldDiv"><?php echo select_tag('rankingId', Ranking::getOptionsForSelect($eventObj->getRankingId(), false, true, true), array('class'=>'required', 'onchange'=>'handleRankingChoice(this.value); loadRankingPlaceList(this.value); checkRankingTag()', 'id'=>'eventRankingId')) ?></div>
			<div class="error" id="eventRankingIdError" onclick="showFormErrorDetails('event', 'rankingId')"></div>
		<?php else: ?>
			<?php echo input_hidden_tag('rankingId', $eventObj->getRankingId(), array('id'=>'eventRankingId')) ?>
			<div class="textFlex"><?php echo link_to($eventObj->getRanking()->getRankingName(), '#goModule("ranking", "edit", "rankingId", '.$eventObj->getRankingId().')') ?></div>
		<?php endif; ?>
	</div>
	<div class="row">
		<div class="label" id="eventEventNameLabel"><?php echo __('event.eventName') ?></div>
		<div class="field"><?php echo input_tag('eventName', $eventObj->getEventName(false), array('size'=>25, 'maxlength'=>25, 'class'=>'required', 'id'=>'eventEventName')) ?></div>
		<div class="error" id="eventEventNameError" onclick="showFormErrorDetails('event', 'eventName')"></div>
		
		<?php if( !$eventObj->getRanking(true)->getGameStyle()->isTagName('ring') ): ?>
		<div id="eventIsFreerollField" class="fieldCheckbox" style="margin-left: 15px"><?php echo checkbox_tag('isFreeroll', true, $eventObj->getIsFreeroll(), array('onclick'=>'toggleFreerollFields(this.checked)', 'id'=>'eventIsFreeroll')) ?></div>
		<label id="eventIsFreerollLabel" for="eventIsFreeroll">Freeroll</label>
		<div class="error" id="eventIsFreerollError" onclick="showFormErrorDetails('event', 'eventName')"></div>
		<?php endif; ?>
	</div>
	<div class="row" style="display: <?php echo ($permalink?'block':'none') ?>" id="rankingPermalinkRowDiv">
		<div class="label">Permalink</div>
		<div class="textFlex" id="rankingPermalinkDiv"><?php echo $permalink ?></div>
	</div>
	<div class="row">
		<div class="label" id="eventRankingPlaceIdLabel"><?php echo __('event.eventPlace') ?></div>
		<div class="field" id="eventRankingPlaceIdDiv"><?php echo select_tag('rankingPlaceId', RankingPlace::getOptionsForSelect($eventObj->getRankingId(), $eventObj->getRankingPlaceId()), array('class'=>'required', 'onchange'=>'checkRankingPlace(this.value)', 'id'=>'eventRankingPlaceId')) ?></div>
		<div class="textFlex <?php echo $eventObj->isNew()?'hidden':'block' ?>" id="eventRankingPlaceIdEditDiv"><?php echo link_to('Editar', '#editRankingPlace($(\'eventRankingPlaceId\').value, $(\'eventRankingId\').value)') ?></div>
		<div class="error" id="eventRankingPlaceIdError" onclick="showFormErrorDetails('event', 'rankingPlaceId')"></div>
	</div>
	<div class="row">
		<div class="label" id="eventEventDateLabel"><?php echo __('event.date') ?></div>
		<div class="field"><?php echo input_date_tag('eventDate', $eventObj->getEventDate(), array('size'=>10, 'maxlength'=>10, 'class'=>'required', 'id'=>'eventEventDate')) ?></div>
		<div class="error" id="eventEventDateError" onclick="showFormErrorDetails('event', 'eventDate')"></div>
	</div>
	<div class="row">
		<div class="label" id="eventStartTimeLabel"><?php echo __('event.startTime') ?></div>
		<div class="field"><?php echo input_tag('startTime', $eventObj->getStartTime('H:i'), array('size'=>5, 'maxlength'=>5, 'onkeyup'=>'maskTime(event)', 'class'=>'required', 'id'=>'eventStartTime')) ?></div>
		<div class="error" id="eventStartTimeError" onclick="showFormErrorDetails('event', 'startTime')"></div>
	</div>
	<div class="row" id="eventPaidPlacesRow">
		<div class="label" id="eventPaidPlacesLabel"><?php echo __('event.paidPlaces') ?></div>
		<div class="field"><?php echo input_tag('paidPlaces', $eventObj->getPaidPlaces(), array('size'=>2, 'maxlength'=>2, 'class'=>'required', 'id'=>'eventPaidPlaces')) ?></div>
		<div class="error" id="eventPaidPlacesError" onclick="showFormErrorDetails('event', 'paidPlaces')"></div>
		<div class="textFlex" id="eventFreerollLinkDiv" style="display: <?php echo ($eventObj->getIsFreeroll()?'block':'none') ?>"><?php echo link_to(__('event.configurePrize'), '#configurePrize(true)') ?></div>
	</div>
	<div class="row">
		<div class="label"><?php echo __('event.allowRebuy') ?></div>
		<div class="field"><?php echo checkbox_tag('allowRebuy', true, $eventObj->getAllowRebuy(), array('id'=>'eventAllowRebuy')) ?></div>
	</div>
	<div class="row">
		<div class="label"><?php echo __('event.allowAddon') ?></div>
		<div class="field"><?php echo checkbox_tag('allowAddon', true, $eventObj->getAllowAddon(), array('id'=>'eventAllowAddon')) ?></div>
	</div>
	<div class="row" id="eventEntranceFeeRow" style="display: <?php echo ($eventObj->getIsFreeroll()?'none':'block') ?>">
		<div class="label" id="eventEntranceFeeLabel"><?php echo __('event.entranceFee') ?></div>
		<div class="field"><?php echo input_tag('entranceFee', Util::formatFloat($eventObj->getEntranceFee(), true), array('size'=>6, 'maxlength'=>6, 'onkeyup'=>'maskCurrency(event)', 'style'=>'text-align: right', 'id'=>'eventEntranceFee')) ?></div>
		<div class="error" id="eventEntranceFeeError" onclick="showFormErrorDetails('event', 'entranceFee')"></div>
		<div class="textFlex">Ex: <?php echo __('zero.zeroZero') ?></div>
	</div>
	<div class="row" id="eventBuyinRow" style="display: <?php echo ($eventObj->getIsFreeroll()?'none':'block') ?>">
		<div class="label" id="eventBuyinLabel">Buy-in</div>
		<div class="field"><?php echo input_tag('buyin', Util::formatFloat($eventObj->getBuyin(), true), array('size'=>6, 'maxlength'=>6, 'onkeyup'=>'maskCurrency(event)', 'style'=>'text-align: right', 'id'=>'eventBuyin')) ?></div>
		<div class="error" id="eventBuyinError" onclick="showFormErrorDetails('event', 'buyin')"></div>
		<div class="textFlex">Ex: <?php echo __('zero.zeroZero') ?></div>
	</div>
	<div class="rowTextArea">
		<div class="label" id="eventCommentsLabel"><?php echo __('event.comments') ?></div>
		<div class="field"><?php echo textarea_tag('comments', $eventObj->getComments(), array('id'=>'eventComments')) ?></div>
		<div class="error" id="eventCommentsError" onclick="showFormErrorDetails('event', 'comments')"></div>
	</div>
	<div class="row">
		<div class="label"><?php echo __('event.emailNotify') ?></div>
		<div class="field"><?php echo checkbox_tag('sendEmail', true, (!$eventObj->getSentEmail() && !$isClone), array('id'=>'eventSendEmail')) ?></div>
		<div class="textFlex" style="display: <?php echo ($eventObj->getSentEmail()?'block':'none') ?>" id="sentEmailDiv"><?php echo __('event.sentNotify') ?></div>
	</div>
	
	
	<fieldset id="prizeConfigDiv" style="display: <?php echo ($eventObj->getIsFreeroll()?'block':'none') ?>">
		<legend>Configuração da premiação</legend>
		<div class="row clean">
			<div class="label"><?php echo __('event.rankingAvailableCredit') ?></div>
			<div class="textFlex" id="eventRankingAvailableCredit"><?php echo Util::formatFloat($eventObj->getRanking(true)->getCredit(), true) ?></div>
		</div>
		<div class="row">
			<div class="label" id="eventPrizePotLabel"><?php echo __('event.prizePot') ?></div>
			<div class="field"><?php echo input_tag('prizePot', Util::formatFloat($eventObj->getPrizePot(), true), array('size'=>5, 'maxlength'=>6, 'onkeyup'=>'maskCurrency(event)', 'style'=>'text-align: right', 'id'=>'eventPrizePot')) ?></div>
			<div class="error" id="eventPrizePotError" onclick="showFormErrorDetails('event', 'buyin')"></div>
		</div>
		
		<div id="prizeShareListDiv" class="mt20">
			<?php
				if( $eventObj->getIsFreeroll() ):
					foreach($eventObj->getPrizeConfigList() as $eventPrizeConfigObj):
						$eventPosition = $eventPrizeConfigObj->getEventPosition();
						
						$isPercent = $eventPrizeConfigObj->getIsPercent();
			?>
			<div class="row">
				<div class="label"><?php echo $eventPosition.Util::getOrdinalSufix($eventPosition).' '.__('event.place') ?></div>
				<div class="field"><?php echo input_tag('paidPlace'.$eventPosition, Util::formatFloat($eventPrizeConfigObj->getPrizeValue(), true).($isPercent?'%':''), array('size'=>5, 'maxlength'=>6, 'autocomplete'=>'off', 'onkeyup'=>'maskCurrency(event)', 'style'=>'text-align: right', 'id'=>'eventPaidPlace'.$eventPosition)) ?></div>
			</div>
			<?php
					endforeach;
				endif;
			?>
		</div>
	</fieldset>
</div>