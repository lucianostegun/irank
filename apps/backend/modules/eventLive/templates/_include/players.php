<?php
	$criteria = new Criteria();
	$criteria->add( EventLivePlayerPeer::ENABLED, true );
	$eventLivePlayerObjList = $eventLiveObj->getEventLivePlayerList($criteria);
	
	foreach($eventLivePlayerObjList as $key=>$eventLivePlayerObj):
	
		$peopleObj = $eventLivePlayerObj->getPeople();
		$peopleId  = $peopleObj->getId();
		$class     = ($key%2==0?'':'odd');
		
		$emailAddress = $peopleObj->getEmailAddress();
		if( !$emailAddress )
			$emailAddress = 'Não informado';
?>
<tr class="<?php echo $class ?>" id="eventLivePeopleIdRow-<?php echo $peopleId ?>" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">
	<td><?php echo $peopleObj->getName() ?></td> 
	<td><?php echo $emailAddress ?></td> 
	<td><?php echo $eventLivePlayerObj->getCreatedAt('d/m/Y H:i') ?></td> 
	<td><?php echo link_to(image_tag('icon/delete'), '#removePlayer('.$peopleId.')', array('title'=>'Remover jogador "'.$peopleObj->getFullName().'" do evento')) ?></td> 
</tr> 
<?php endforeach; ?>