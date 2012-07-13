<table border="0" cellspacing="0" cellpadding="0" class="gridTable">
	<tr class="header">
		<th width="45%" class="first">Etapa</th>
		<th width="20%"><?php echo __('DateTime') ?></th>
		<th width="25%"><?php echo __('Place') ?></th>
		<th width="10%">Jogadores</th>
	</tr>
	<tbody>
	<?php
		$criteria = new Criteria();
		$criteria->add( EventLivePeer::RANKING_LIVE_ID, $rankingLiveObj->getId() );
		$criteria->addAnd( EventLivePeer::RANKING_LIVE_ID, null, Criteria::NOT_EQUAL );
//		$criteria->addAnd( EventLivePeer::ID, $eventLiveObj->getId(), Criteria::NOT_EQUAL );
		$criteria->add( EventLivePeer::ENABLED, true );
		$criteria->add( EventLivePeer::VISIBLE, true );
		$criteria->add( EventLivePeer::DELETED, false );
		$criteria->addAscendingOrderByColumn( EventLivePeer::EVENT_DATE );
		
		$recordCount = 0;
		foreach($rankingLiveObj->getEventLiveList($criteria) as $key=>$eventLiveObj):
			
			$eventLiveId = $eventLiveObj->getId();
			
			$className = ($key%2==0?'':'odd');
			$className .= ($key==0?' first':'');
			
			$criteria = new Criteria();
			foreach($eventLiveObj->getScheduleList($criteria) as $eventLiveScheduleObj):
				
				$eventLiveScheduleId = nvl($eventLiveScheduleObj->getId(), 0);
				$stepDay             = $eventLiveScheduleObj->getStepDay();
				$stepDay             = ($stepDay?' - Dia '.$stepDay:'');
				
				$onclick = 'goToPage(\'eventLive\', \'details\', \'id\', '.$eventLiveId.', false, event, \'eventLiveScheduleId\', '.$eventLiveScheduleId.')';
			
			$recordCount++;
	?>
	<tr onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" class="<?php echo $className ?>">
		<td onclick="<?php echo $onclick ?>" align="left"><?php echo $eventLiveObj->toString().$stepDay ?></td>
		<td onclick="<?php echo $onclick ?>" align="center"><?php echo $eventLiveObj->getEventDate('d/m/Y').' '.$eventLiveObj->getStartTime('H:i') ?></td>
		<td onclick="<?php echo $onclick ?>" align="left"><?php echo $eventLiveObj->getEventPlace() ?></td>
		<td onclick="<?php echo $onclick ?>" align="center"><?php echo $eventLiveObj->getPlayers() ?></td>
	</tr>
	<?php endforeach; ?>
	<?php endforeach; ?>
	<?php if($recordCount==0): ?>
	<tr>
		<td align="center" colspan="4">Ainda não foram cadastradas etapas para este ranking</td>
	</tr>
	<?php endif; ?>
	</tbody>
</table>