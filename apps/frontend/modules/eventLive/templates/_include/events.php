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
		$criteria->add( EventLivePeer::RANKING_LIVE_ID, $eventLiveObj->getRankingLiveId() );
		$criteria->addAnd( EventLivePeer::RANKING_LIVE_ID, null, Criteria::NOT_EQUAL );
		$criteria->addAnd( EventLivePeer::ID, $eventLiveObj->getId(), Criteria::NOT_EQUAL );
		$criteria->add( EventLivePeer::ENABLED, true );
		$criteria->add( EventLivePeer::VISIBLE, true );
		$criteria->add( EventLivePeer::DELETED, false );
		$criteria->addDescendingOrderByColumn( EventLivePeer::EVENT_DATE );
		
		$eventLiveIdCurrent = $eventLiveObj->getId();
		$recordCount = 0;
		foreach($eventLiveObj->getRankingLive()->getEventLiveList($criteria) as $key=>$eventLiveObj):
			
			$eventLiveId = $eventLiveObj->getId();
			$onclick     = 'goModule(\'eventLive\', \'details\', \'id\', '.$eventLiveId.')';
			
			if( $eventLiveId==$eventLiveIdCurrent )
				$onclick = 'alert(\'A etapa selecionada é a mesma que você está visualizando agora!\')';
			
			$className = ($key%2==0?'':'odd');
			$className .= ($key==0?' first':'');
			
			$recordCount++;
	?>
	<tr onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" class="<?php echo $className ?>">
		<td onclick="<?php echo $onclick ?>" align="left"><?php echo $eventLiveObj->getEventName() ?></td>
		<td onclick="<?php echo $onclick ?>" align="center"><?php echo $eventLiveObj->getEventDate('d/m/Y').' '.$eventLiveObj->getStartTime('H:i') ?></td>
		<td onclick="<?php echo $onclick ?>" align="left"><?php echo $eventLiveObj->getEventPlace() ?></td>
		<td onclick="<?php echo $onclick ?>" align="center"><?php echo $eventLiveObj->getPlayers() ?></td>
	</tr>
	<?php endforeach; ?>
	<?php if($recordCount==0): ?>
	<tr class="<?php echo $className ?>">
		<td align="center" colspan="4">Não existem outras etapas cadastradas para este ranking</td>
	</tr>
	<?php endif; ?>
	</tbody>
</table>