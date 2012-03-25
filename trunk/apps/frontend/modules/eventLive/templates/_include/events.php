<table border="0" cellspacing="0" cellpadding="0" class="gridTable">
	<tr class="header">
		<th class="first">Etapa</th>
		<th><?php echo __('DateTime') ?></th>
		<th><?php echo __('Place') ?></th>
		<th colspan="3">Jogadores</th>
	</tr>
	<tbody>
	<?php
		$criteria = new Criteria();
		$criteria->addDescendingOrderByColumn( EventLivePeer::EVENT_DATE );

		foreach($eventLiveObj->getRankingLive()->getEventLiveList($criteria) as $key=>$eventLiveObj):
			
			$eventLiveId = $eventLiveObj->getId();
			$onclick     = 'goModule(\'eventLive\', \'details\', \'id\', '.$eventLiveId.')';
			
			$className = ($key%2==0?'':'odd');
			$className .= ($key==0?' first':'');
	?>
	<tr onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" class="<?php echo $className ?>">
		<td onclick="<?php echo $onclick ?>" align="left"><?php echo $eventLiveObj->getEventName() ?></td>
		<td onclick="<?php echo $onclick ?>" align="center"><?php echo $eventLiveObj->getEventDate('d/m/Y').' '.$eventLiveObj->getStartTime('H:i') ?></td>
		<td onclick="<?php echo $onclick ?>" align="left"><?php echo $eventLiveObj->getEventPlace() ?></td>
		<td onclick="<?php echo $onclick ?>" align="center"><?php echo $eventLiveObj->getPlayers() ?></td>
	</tr>
	<?php endforeach; ?>
	</tbody>
</table>