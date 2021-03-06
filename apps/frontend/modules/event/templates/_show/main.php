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
			<?php echo input_hidden_tag('buyin', Util::formatFloat($eventObj->getBuyin(), true), array('id'=>'eventBuyin')) ?>
			<?php if( !$eventObj->getIsFreeroll() ): ?>
			<div class="row">
				<div class="label">Buy-in</div>
				<div class="textFlex"><?php echo __('currency') ?> <?php echo Util::formatFloat($eventObj->getBuyin(), true) ?></div>
			</div>
			<div class="row">
				<div class="label"><?php echo __('event.entranceFee') ?></div>
				<div class="textFlex"><?php echo __('currency') ?> <?php echo Util::formatFloat($eventObj->getEntranceFee(), true) ?></div>
			</div>
			<?php endif; ?>
			<div class="rowTextArea">
				<div class="label"><?php echo __('event.comments') ?></div>
				<div class="textFlex" style="width: 260px"><?php echo $eventObj->getComments() ?></div>
			</div>
		</td>
		
		<td valign="top" width="300">
			<div id="prizeConfigDiv" style="display: <?php echo ($eventObj->getIsFreeroll()?'block':'none') ?>">
				<h1><?php echo __('event.prizeConfig') ?></h1>
				<div class="row">
					<div class="label" id="eventPrizePotLabel"><?php echo __('event.prizePot') ?></div>
					<div class="textFlex"><?php echo Util::formatFloat($eventObj->getPrizePot(), true) ?></div>
				</div>
				
				<div style="margin-top: 10px" id="prizeShareListDiv">
					<?php
						if( $eventObj->getIsFreeroll() ):
							foreach($eventObj->getPrizeConfigList() as $eventPrizeConfigObj):
								$eventPosition = $eventPrizeConfigObj->getEventPosition();
								
								$isPercent = $eventPrizeConfigObj->getIsPercent();
					?>
					<div class="row">
						<div class="label"><?php echo $eventPosition.Util::getOrdinalSufix($eventPosition).' '.__('event.place') ?></div>
						<div class="textFlex"><?php echo Util::formatFloat($eventPrizeConfigObj->getPrizeValue(), true).($isPercent?'%':'') ?></div>
					</div>
					<?php
							endforeach;
						endif;
					?>
				</div>
			</div>
		</td>
	</tr>
</table>