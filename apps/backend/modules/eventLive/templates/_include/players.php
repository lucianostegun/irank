<?php
	$criteria = new Criteria();
	$criteria->addAscendingOrderByColumn( PeoplePeer::FULL_NAME );
	$eventLivePlayerObjList = $eventLiveObj->getEventLivePlayerList($criteria);
	
	foreach($eventLivePlayerObjList as $key=>$eventLivePlayerObj):
	
		$peopleObj = $eventLivePlayerObj->getPeople();
		$peopleId  = $peopleObj->getId();
		$class     = ($key%2==0?'':'odd');
		
		$emailAddress = $peopleObj->getEmailAddress();
		if( !$emailAddress )
			$emailAddress = 'Não informado';
?>
<tr class="<?php echo $class ?>" id="eventLivePeopleIdRow-<?php echo $peopleId ?>">
	<td id="eventLivePlayer-peopleName-<?php echo $peopleId ?>"><?php echo $peopleObj->getName() ?></td> 
	<td id="eventLivePlayer-emailAddress-<?php echo $peopleId ?>"><?php echo $emailAddress ?></td> 
	<td class="textC"><?php echo $eventLivePlayerObj->getCreatedAt('d/m/Y H:i') ?></td>
	<td><?php echo $eventLivePlayerObj->getEnrollmentStatus(true) ?></td>
	<?php if( !$savedResult ): ?> 
	<td align="center" class="playerRemoveColumn"><?php echo link_to(image_tag('backend/icons/color/minus-circle'), '#removePlayer('.$peopleId.')', array('title'=>'Remover jogador "'.$peopleObj->getFullName().'" do evento')) ?></td>
	<?php endif; ?>
	<td align="center" class="playerEditColumn"><?php echo link_to(image_tag('backend/icons/color/pencil'), '#editPlayerInfoEventLive('.$peopleId.')', array('title'=>'Editar informações do jogador')) ?></td>
</tr> 
<?php endforeach; ?>