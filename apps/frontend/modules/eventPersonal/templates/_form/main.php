<table width="100%" cellspacing="1" cellpadding="0" style="margin-top: 5px" class="defaultForm">
	<tr>
		<td valign="top">
			<div class="row">
				<div class="label" id="eventPersonalEventNameLabel"><?php echo __('event.eventName') ?></div>
				<div class="field"><?php echo input_tag('eventName', $eventPersonalObj->getEventName(), array('size'=>25, 'maxlength'=>25, 'class'=>'required', 'id'=>'eventPersonalEventName')) ?></div>
				<div class="error" id="eventPersonalEventNameError" onclick="showFormErrorDetails('eventPersonal', 'eventName')"></div>
			</div>
			<div class="row">
				<div class="label" id="eventPersonalEventDateLabel"><?php echo __('event.date') ?></div>
				<div class="field"><?php echo input_date_tag('eventDate', $eventPersonalObj->getEventDate(), array('size'=>10, 'maxlength'=>10, 'class'=>'required', 'id'=>'eventPersonalEventDate')) ?></div>
				<div class="error" id="eventPersonalEventDateError" onclick="showFormErrorDetails('eventPersonal', 'eventDate')"></div>
			</div>
			<div class="row">
				<div class="label" id="eventPersonalBuyinLabel">Buy-in</div>
				<div class="field"><?php echo input_tag('buyin', Util::formatFloat($eventPersonalObj->getBuyin(), true), array('size'=>6, 'maxlength'=>6, 'onkeyup'=>'maskCurrency(event)', 'class'=>'required', 'style'=>'text-align: right', 'id'=>'eventPersonalBuyin')) ?></div>
				<div class="error" id="eventPersonalBuyinError" onclick="showFormErrorDetails('eventPersonal', 'buyin')"></div>
				<div class="textFlex">Ex: <?php echo __('zero.zeroZero') ?></div>
			</div>
			<div class="row">
				<div class="label" id="eventPersonalRebuyLabel">Rebuy</div>
				<div class="field"><?php echo input_tag('rebuy', Util::formatFloat($eventPersonalObj->getRebuy(), true), array('size'=>6, 'maxlength'=>6, 'onkeyup'=>'maskCurrency(event)', 'class'=>'required', 'style'=>'text-align: right', 'id'=>'eventPersonalRebuy')) ?></div>
				<div class="error" id="eventPersonalRebuyError" onclick="showFormErrorDetails('eventPersonal', 'rebuy')"></div>
				<div class="textFlex">Ex: <?php echo __('zero.zeroZero') ?></div>
			</div>
			<div class="row">
				<div class="label" id="eventPersonalAddonLabel">Add-on</div>
				<div class="field"><?php echo input_tag('addon', Util::formatFloat($eventPersonalObj->getAddon(), true), array('size'=>6, 'maxlength'=>6, 'onkeyup'=>'maskCurrency(event)', 'class'=>'required', 'style'=>'text-align: right', 'id'=>'eventPersonalAddon')) ?></div>
				<div class="error" id="eventPersonalAddonError" onclick="showFormErrorDetails('eventPersonal', 'addon')"></div>
				<div class="textFlex">Ex: <?php echo __('zero.zeroZero') ?></div>
			</div>
			<div class="row">
				<div class="label" id="eventPersonalPrizeLabel"><?php echo __('Prize') ?></div>
				<div class="field"><?php echo input_tag('prize', Util::formatFloat($eventPersonalObj->getPrize(), true), array('size'=>7, 'maxlength'=>7, 'onkeyup'=>'maskCurrency(event)', 'class'=>'required', 'style'=>'text-align: right', 'id'=>'eventPersonalPrize')) ?></div>
				<div class="error" id="eventPersonalPrizeError" onclick="showFormErrorDetails('eventPersonal', 'prize')"></div>
				<div class="textFlex">Ex: <?php echo __('zero.zeroZero') ?></div>
			</div>
			
			<h1><?php echo __('event.eventDetails') ?></h1>
			<div class="row">
				<div class="label" id="eventPersonalEventPlaceLabel"><?php echo __('event.eventPlace') ?></div>
				<div class="field"><?php echo input_tag('eventPlace', $eventPersonalObj->getEventPlace(), array('size'=>25, 'maxlength'=>25, 'class'=>'required', 'id'=>'eventPersonalEventPlace')) ?></div>
				<div class="error" id="eventPersonalEventPlaceError" onclick="showFormErrorDetails('eventPersonal', 'eventPlace')"></div>
			</div>
			<div class="row">
				<div class="label" id="eventPersonalGameStyleIdLabel"><?php echo __('ranking.style') ?></div>
				<div class="field"><?php echo select_tag('gameStyleId', VirtualTable::getOptionsForSelect('gameStyle', $eventPersonalObj->getGameStyleId()), array('class'=>'required', 'id'=>'eventPersonalGameStyleId')) ?></div>
				<div class="error" id="eventPersonalGameStyleIdError" onclick="showFormErrorDetails('eventPersonal', 'gameStyleId')"></div>
			</div>
			<div class="row">
				<div class="label" id="eventPersonalPaidPlacesLabel"><?php echo __('event.paidPlaces') ?></div>
				<div class="field"><?php echo input_tag('paidPlaces', $eventPersonalObj->getPaidPlaces(), array('size'=>2, 'maxlength'=>3, 'class'=>'required', 'id'=>'eventPersonalPaidPlaces')) ?></div>
				<div class="error" id="eventPersonalPaidPlacesError" onclick="showFormErrorDetails('eventPersonal', 'paidPlaces')"></div>
			</div>
			<div class="row">
				<div class="label" id="eventPersonalEventPositionLabel"><?php echo __('Position') ?></div>
				<div class="field"><?php echo input_tag('eventPosition', $eventPersonalObj->getEventPosition(), array('size'=>2, 'maxlength'=>3, 'class'=>'required', 'id'=>'eventPersonalEventPosition')) ?></div>
				<div class="error" id="eventPersonalEventPositionError" onclick="showFormErrorDetails('eventPersonal', 'eventPosition')"></div>
			</div>
			<div class="row">
				<div class="label" id="eventPersonalPlayersLabel"><?php echo __('Players') ?></div>
				<div class="field"><?php echo input_tag('players', $eventPersonalObj->getPlayers(), array('size'=>3, 'maxlength'=>3, 'class'=>'required', 'id'=>'eventPersonalPlayers')) ?></div>
				<div class="error" id="eventPersonalPlayersError" onclick="showFormErrorDetails('eventPersonal', 'players')"></div>
			</div>
			<div class="rowTextArea">
				<div class="label" id="eventPersonalCommentsLabel"><?php echo __('event.comments') ?></div>
				<div class="field"><?php echo textarea_tag('comments', $eventPersonalObj->getComments(), array('id'=>'eventPersonalComments')) ?></div>
				<div class="error" id="eventPersonalCommentsError" onclick="showFormErrorDetails('eventPersonal', 'comments')"></div>
			</div>
		</td>
	</tr>
</table>