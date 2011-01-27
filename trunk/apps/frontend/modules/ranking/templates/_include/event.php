<table border="0" cellspacing="1" cellpadding="2" class="gridTabTable">
	<tr class="header">
		<th width="200"><?php echo __('Event') ?></th>
		<th><?php echo __('DateTime') ?></th>
		<th><?php echo __('Place') ?></th>
		<th><?php echo __('Guests') ?></th>
	</tr>
	<?php
		$eventObjList = $rankingObj->getEventList();
		foreach($eventObjList as $eventObj): ?>
	<tr>
		<td><?php echo link_to($eventObj->getEventName(), '#goModule(\'event\', \'edit\', \'eventId\', '.$eventObj->getId().')') ?></td>
		<td align="center"><?php echo $eventObj->getEventDate('d/m/Y').' '.$eventObj->getStartTime('H:i') ?></td>
		<td><?php echo $eventObj->getEventPlace() ?></td>
		<td align="center"><?php echo sprintf('%02d', $eventObj->getInvites()).' ('.sprintf('%02d', $eventObj->getPlayers()).')' ?></td>
	</tr>
	<?php
		endforeach;
		
		if( !count($eventObjList) ):
	?>
	<tr>
		<td colspan="4">
			<?php echo __('ranking.eventsTab.noEvents', array('%link%'=>link_to(__('clickHere'), 'event/new'))) ?>
		</td>
	</tr>
	<?php
		endif;
	?>
</table>