<table width="100%" cellspacing="1" cellpadding="0" style="margin-top: 5px" class="defaultForm">
	<tr>
		<td valign="top">
			<?php if( Util::isDebug() ): ?>
			<div class="row">
				<div class="label">Cód.</div>
				<div class="text"><?php echo $eventObj->getCode() ?></div>
			</div>
			<?php endif; ?>
			
			<div class="row">
				<div class="label" id="eventRankingIdLabel">Ranking</div>
				<?php if( !$eventObj->getEnabled() ): ?>
					<div class="field" id="rankinkIdFieldDiv"><?php echo select_tag('rankingId', Ranking::getOptionsForSelect($eventObj->getRankingId(), false, true, true), array('class'=>'required', 'onchange'=>'loadDefaultBuyin(this.value); loadRankingPlaceList(this.value)', 'id'=>'eventRankingId')) ?></div>
					<div class="error" id="eventRankingIdError" onclick="showFormErrorDetails('event', 'rankingId')"></div>
				<?php else: ?>
					<?php echo input_hidden_tag('rankingId', $eventObj->getRankingId(), array('id'=>'eventRankingId')) ?>
					<div class="textFlex"><?php echo link_to($eventObj->getRanking()->getRankingName(), '#goModule("ranking", "edit", "rankingId", '.$eventObj->getRankingId().')') ?></div>
				<?php endif; ?>
			</div>
			<div class="row">
				<div class="label" id="eventEventNameLabel"><?php echo __('event.eventName') ?></div>
				<div class="field"><?php echo input_tag('eventName', $eventObj->getEventName(), array('size'=>25, 'maxlength'=>25, 'class'=>'required', 'id'=>'eventEventName')) ?></div>
				<div class="error" id="eventEventNameError" onclick="showFormErrorDetails('event', 'eventName')"></div>
			</div>
			<div class="row">
				<div class="label" id="eventRankingPlaceIdLabel"><?php echo __('event.eventPlace') ?></div>
				<div class="field" id="eventRankingPlaceIdDiv"><?php echo select_tag('rankingPlaceId', RankingPlace::getOptionsForSelect($eventObj->getRankingId(), $eventObj->getRankingPlaceId()), array('class'=>'required', 'onchange'=>'checkRankingPlace(this.value)', 'id'=>'eventRankingPlaceId')) ?></div>
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
			<div class="row">
				<div class="label" id="eventPaidPlacesLabel"><?php echo __('event.paidPlaces') ?></div>
				<div class="field"><?php echo input_tag('paidPlaces', $eventObj->getPaidPlaces(), array('size'=>2, 'maxlength'=>1, 'class'=>'required', 'id'=>'eventPaidPlaces')) ?></div>
				<div class="error" id="eventPaidPlacesError" onclick="showFormErrorDetails('event', 'paidPlaces')"></div>
			</div>
			<div class="row">
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
		</td>
	</tr>
</table>