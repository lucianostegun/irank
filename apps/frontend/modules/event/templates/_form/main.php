<table width="100%" cellspacing="1" cellpadding="0" style="margin-top: 5px" class="defaultForm">
	<tr>
		<td valign="top">
			<div class="row">
				<div class="label" id="eventRankingIdLabel">Ranking</div>
				<?php if( !$eventObj->getEnabled() ): ?>
					<div class="field" id="rankinkIdFieldDiv"><?php echo select_tag('rankingId', Ranking::getOptionsForSelect($eventObj->getRankingId()), array('class'=>'required', 'onchange'=>'loadDefaultBuyin(this.value)', 'id'=>'eventRankingId')) ?></div>
					<div class="error" id="eventRankingIdError" onclick="showFormErrorDetails('event', 'rankingId')"></div>
				<?php else: ?>
					<?php echo input_hidden_tag('rankingId', $eventObj->getRankingId()) ?>
					<div class="textFlex"><?php echo link_to($eventObj->getRanking()->getRankingName(), '#goModule("ranking", "edit", "rankingId", '.$eventObj->getRankingId().')') ?></div>
				<?php endif; ?>
			</div>
			<div class="row">
				<div class="label" id="eventEventNameLabel">Título</div>
				<div class="field"><?php echo input_tag('eventName', $eventObj->getEventName(), array('size'=>25, 'maxlength'=>25, 'class'=>'required', 'id'=>'eventEventName')) ?></div>
				<div class="error" id="eventEventNameError" onclick="showFormErrorDetails('event', 'eventName')"></div>
			</div>
			<div class="row">
				<div class="label" id="eventEventPlaceLabel">Local</div>
				<div class="field"><?php echo input_tag('eventPlace', $eventObj->getEventPlace(), array('size'=>30, 'maxlength'=>250, 'class'=>'required', 'id'=>'eventEventPlace')) ?></div>
				<div class="error" id="eventEventPlaceError" onclick="showFormErrorDetails('event', 'eventPlace')"></div>
			</div>
			<div class="row">
				<div class="label" id="eventEventDateLabel">Data</div>
				<div class="field"><?php echo input_date_tag('eventDate', $eventObj->getEventDate(), array('size'=>10, 'maxlength'=>10, 'class'=>'required', 'id'=>'eventEventDate')) ?></div>
				<div class="error" id="eventEventDateError" onclick="showFormErrorDetails('event', 'eventDate')"></div>
			</div>
			<div class="row">
				<div class="label" id="eventStartTimeLabel">Horário</div>
				<div class="field"><?php echo input_tag('startTime', $eventObj->getStartTime('H:i'), array('size'=>5, 'maxlength'=>5, 'onkeyup'=>'maskTime(event)', 'class'=>'required', 'id'=>'eventStartTime')) ?></div>
				<div class="error" id="eventStartTimeError" onclick="showFormErrorDetails('event', 'startTime')"></div>
			</div>
			<div class="row">
				<div class="label" id="eventPaidPlacesLabel">Posições pagas</div>
				<div class="field"><?php echo input_tag('paidPlaces', $eventObj->getPaidPlaces(), array('size'=>2, 'maxlength'=>1, 'class'=>'required', 'id'=>'eventPaidPlaces')) ?></div>
				<div class="error" id="eventPaidPlacesError" onclick="showFormErrorDetails('event', 'paidPlaces')"></div>
			</div>
			<div class="row">
				<div class="label" id="eventBuyinLabel">Buy-in</div>
				<div class="field"><?php echo input_tag('buyin', Util::formatFloat($eventObj->getBuyin(), true), array('size'=>6, 'maxlength'=>6, 'onkeyup'=>'maskCurrency(event)', 'style'=>'text-align: right', 'id'=>'eventBuyin')) ?></div>
				<div class="error" id="eventBuyinError" onclick="showFormErrorDetails('event', 'buyin')"></div>
				<div class="textFlex">Ex: 0,00</div>
			</div>
			<div class="rowTextArea">
				<div class="label" id="eventCommentsLabel">Observações</div>
				<div class="field"><?php echo textarea_tag('comments', $eventObj->getComments(), array('id'=>'eventComments')) ?></div>
				<div class="error" id="eventCommentsError" onclick="showFormErrorDetails('event', 'comments')"></div>
			</div>
			<div class="row">
				<div class="label">Notificar por email</div>
				<div class="field"><?php echo checkbox_tag('sendEmail', true, false, array('id'=>'eventSendEmail')) ?></div>
				<div class="textFlex" style="display: <?php echo ($eventObj->getSentEmail()?'block':'none') ?>" id="sentEmailDiv">Notificação já enviada</div>
			</div>
		</td>
	</tr>
</table>