<table border="0" cellspacing="0" cellpadding="0" class="gridTable">
	<tr class="header">
		<th class="first">Ranking</th>
		<th class="first">Etapa</th>
		<th><?php echo __('DateTime') ?></th>
	</tr>
	<tbody>
	<?php
		$criteria = new Criteria();
		$criteria->addDescendingOrderByColumn( EventLivePeer::EVENT_DATE );

		$recordCount = 0;
		foreach($clubObj->getEventLiveList($criteria) as $key=>$eventLiveObj):
			
			$eventLiveId = $eventLiveObj->getId();
			$onclick     = 'goModule(\'eventLive\', \'details\', \'id\', '.$eventLiveId.')';
			
			$className = ($key%2==0?'':'odd');
			$className .= ($key==0?' first':'');
			
			$recordCount++;
	?>
	<tr onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" class="<?php echo $className ?>">
		<td onclick="<?php echo $onclick ?>" align="left"><?php echo $eventLiveObj->getRankingLive()->toString() ?></td>
		<td onclick="<?php echo $onclick ?>" align="left"><?php echo $eventLiveObj->getEventName() ?></td>
		<td onclick="<?php echo $onclick ?>" align="center"><?php echo $eventLiveObj->getEventDate('d/m/Y').' '.$eventLiveObj->getStartTime('H:i') ?></td>
	</tr>
	<?php
		endforeach;
		
		if( $recordCount==0 ):
	?>
	<tr>
		<td colspan="3">Nenhum evento encontrado para este clube</td>
	</tr>
	<?php endif; ?>
	</tbody>
</table>