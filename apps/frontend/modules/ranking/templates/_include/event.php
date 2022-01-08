<table border="0" cellspacing="0" cellpadding="0" class="gridTable gridTabTable">
	<tr class="header">
		<th class="first" width="200"><?php echo __('Event') ?></th>
		<th><?php echo __('DateTime') ?></th>
		<th><?php echo __('Place') ?></th>
		<th><?php echo __('Guests') ?></th>
	</tr>
	<?php
		$criteria = new Criteria();
		$criteria->setNoFilter($readOnly);
		
		$eventObjList = $rankingObj->getEventList($criteria);
		foreach($eventObjList as $eventObj): ?>
	<tr>
		<td><?php echo link_to($eventObj->getEventName(), '#goModule("event", "'.($readOnly?'share':'edit').'", "eventId", '.$eventObj->getId().')') ?></td>
		<td align="center"><?php echo $eventObj->getEventDate('d/m/Y').' '.$eventObj->getStartTime('H:i') ?></td>
		<td><?php echo $eventObj->getEventPlace() ?></td>
		<td align="center"><?php echo sprintf('%02d', $eventObj->getInvites()).' ('.sprintf('%02d', $eventObj->getPlayers()).')' ?></td>
	</tr>
	<?php
		endforeach;
		
		if( !count($eventObjList) && !$readOnly ):
	?>
	<tr>
		<td colspan="4" class="p10">
			<?php echo __('ranking.eventsTab.noEvents', array('%link%'=>link_to(__('ClickHere'), 'event/new'))) ?>
		</td>
	</tr>
	<?php
		endif;
	?>
</table>