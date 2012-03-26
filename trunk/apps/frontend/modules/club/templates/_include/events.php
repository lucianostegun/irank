<table border="0" cellspacing="0" cellpadding="0" class="gridTable">
	<tr class="header">
		<th class="first">Ranking</th>
		<th class="first">Etapa</th>
		<th><?php echo __('DateTime') ?></th>
	</tr>
	<tbody>
	<?php
		$criteria = new Criteria();
		$criteria->add( EventLivePeer::CLUB_ID, $clubObj->getId() );
		$criteria->addDescendingOrderByColumn( EventLivePeer::EVENT_DATE );

		foreach($clubObj->getEventLiveList($criteria) as $key=>$eventLiveObj):
			
			$eventLiveId = $eventLiveObj->getId();
			$onclick     = 'goModule(\'eventLive\', \'details\', \'id\', '.$eventLiveId.')';
			
			$className = ($key%2==0?'':'odd');
			$className .= ($key==0?' first':'');
	?>
	<tr onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" class="<?php echo $className ?>">
		<td onclick="<?php echo $onclick ?>" align="left"><?php echo $eventLiveObj->getRankingLive()->toString() ?></td>
		<td onclick="<?php echo $onclick ?>" align="left"><?php echo $eventLiveObj->getEventName() ?></td>
		<td onclick="<?php echo $onclick ?>" align="center"><?php echo $eventLiveObj->getEventDate('d/m/Y').' '.$eventLiveObj->getStartTime('H:i') ?></td>
	</tr>
	<?php endforeach; ?>
	</tbody>
</table>