<div id="infoDiv" align="center">
	
	<br/><br/>
	
	<table width="95%" cellpadding="0" cellspacing="0" border="0" class="mobileForm">
		<tr>
			<td width="0" class="topLeft"><?php echo image_tag('mobile/form/topLeft') ?></td>
			<td width="100%" class="topMiddle"></td>
			<td width="0" class="topRight"><?php echo image_tag('mobile/form/topRight') ?></td>
		</tr>
	</table>
	<table width="95%" cellpadding="0" cellspacing="0" border="0" class="mobileForm">
		<tr>
			<td colspan="3" class="formContent">
			
				<table cellpadding="0" cellspacing="0" width="100%" class="formTable">
					<tr>
						<th class="firstLine"><?php echo __('event.rankingName') ?></th>
						<td class="firstLine"><?php echo $eventObj->getRanking()->getRankingName() ?></td>
					</tr>
					<tr>
						<th><?php echo __('event.eventName') ?></th>
						<td><?php echo $eventObj->getEventName() ?></td>
					</tr>
					<tr>
						<th><?php echo __('event.eventPlace') ?></th>
						<td>
							<?php echo link_to($eventObj->getEventPlace(), $eventObj->getRankingPlace()->getMapsLink(), array('target'=>'_blank')) ?>
						</td>
					</tr>
					<tr>
						<th><?php echo __('event.eventDate') ?></th>
						<td><?php echo $eventObj->getEventDate('d/m/Y') ?></td>
					</tr>
					<tr>
						<th><?php echo __('event.startTime') ?></th>
						<td><?php echo $eventObj->getStartTime('H:i') ?></td>
					</tr>
					<tr>
						<th><?php echo __('event.paidPlaces') ?></th>
						<td><?php echo $eventObj->getPaidPlaces() ?></td>
					</tr>
					<tr>
						<th>Buy-in</th>
						<td>
							<?php
								$entranceFee = $eventObj->getEntranceFee();
								echo ($entranceFee?Util::formatFloat($entranceFee, true).'+':'').Util::formatFloat($eventObj->getBuyin(), true);
							?>
						</td>
					</tr>
					<tr>
						<th><?php echo __('event.guests') ?></th>
						<td><?php echo sprintf('%02d', $eventObj->getInvites()) ?></td>
					</tr>
					<tr>
						<th class="lastLine"><?php echo __('event.players') ?></th>
						<td class="lastLine"><?php echo sprintf('%02d', $eventObj->getPlayers()) ?></td>
					</tr>
				</table>
							
			</td>
		</tr>
	</table>
	
	<table width="95%" cellpadding="0" cellspacing="0" border="0" class="mobileForm">
		<tr>
			<td class="baseLeft" width="0" valign="bottom"><?php echo image_tag('mobile/form/baseLeft') ?></td>
			<td width="100%" class="baseMiddle"></td>
			<td class="baseRight" width="0" valign="bottom"><?php echo image_tag('mobile/form/baseRight') ?></td>
		</tr>
	</table>

</div>
