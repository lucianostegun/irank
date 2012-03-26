<?php
	$players = $eventLiveObj->getPlayers();
?>
<div class="inner_table">
	<table class="tablesorter hoHeader" cellspacing="0"> 
	<thead>
		<tr>
			<td colspan="3"><?php echo $players.' Jogador'.($players==1?'':'es').' confirmado'.($players==1?'':'s') ?></td> 
		</tr>
		<tr> 
			<th>Nome</th> 
			<th>E-mail</th> 
			<th>Confirmação</th> 
		</tr>
	</thead> 
	<tbody> 
		<?php
			$criteria = new Criteria();
			$criteria->add( EventLivePlayerPeer::ENABLED, true );
			$eventLivePlayerObjList = $eventLiveObj->getEventLivePlayerList($criteria);
			
			foreach($eventLivePlayerObjList as $eventLivePlayerObj):
			
				$peopleObj = $eventLivePlayerObj->getPeople();
		?>
		<tr>
			<td><?php echo $peopleObj->getName() ?></td> 
			<td><?php echo $peopleObj->getEmailAddress() ?></td> 
			<td><?php echo $eventLivePlayerObj->getCreatedAt('d/m/Y H:i') ?></td> 
		</tr> 
		<?php endforeach; ?>
	</tbody>
	</table>
</div>