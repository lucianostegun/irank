<table width="100%" cellspacing="1" cellpadding="0" style="margin-top: 5px" class="defaultForm">
	<tr>
		<td valign="top">
			<div class="row">
				<div class="label" id="eventRankingIdLabel">Ranking</div>
				<div class="textFlex"><?php echo $eventObj->getRanking()->getRankingName() ?></div>
				<?php echo input_hidden_tag('rankingId', $eventObj->getRankingId(), array('id'=>'eventRankingId')) ?>
			</div>
			<div class="row">
				<div class="label"><?php echo __('event.eventName') ?></div>
				<div class="textFlex"><?php echo $eventObj->getEventName() ?></div>
			</div>
			<div class="row">
				<div class="label"><?php echo __('event.eventPlace') ?></div>
				<div class="textFlex"><?php echo $eventObj->getEventPlace() ?></div>
			</div>
			<div class="row">
				<div class="label"><?php echo __('event.date') ?></div>
				<div class="textFlex"><?php echo $eventObj->getEventDate('d/m/Y') ?></div>
			</div>
			<div class="row">
				<div class="label"><?php echo __('event.startTime') ?></div>
				<div class="textFlex"><?php echo $eventObj->getStartTime('H:i') ?></div>
			</div>
			<div class="row">
				<div class="label"><?php echo __('event.paidPlaces') ?></div>
				<div class="textFlex"><?php echo $eventObj->getPaidPlaces() ?></div>
			</div>
			<div class="row">
				<div class="label">Buy-in</div>
				<div class="textFlex"><?php echo __('currency') ?> <?php echo Util::formatFloat($eventObj->getBuyin(), true) ?></div>
			</div>
			<div class="rowTextArea">
				<div class="label"><?php echo __('event.comments') ?></div>
				<div class="textFlex"><?php echo $eventObj->getComments() ?></div>
			</div>
		</td>
	</tr>
</table>