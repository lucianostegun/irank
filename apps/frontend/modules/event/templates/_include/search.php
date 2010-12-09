<?php
	$eventObjList = Event::getList($criteria);
  	
	foreach($eventObjList as $eventObj):
		$myEvent = $eventObj->isMyEvent();
		
		$link = 'goModule(\'event\', \'edit\', \'eventId\', '.$eventObj->getId().')';
?>
<tr class="recordRow" onmouseover="this.className='recordRowOver'" onmouseout="this.className='recordRow'">
	<td onclick="<?php echo $link ?>" class="recordCell" align="left"><?php echo $eventObj->getEventName().($myEvent?'*':'') ?></td>
	<td onclick="<?php echo $link ?>" class="recordCell" align="left"><?php echo $eventObj->getRanking()->getRankingName() ?></td>
	<td onclick="<?php echo $link ?>" class="recordCell" align="center"><?php echo $eventObj->getEventDate('d/m/Y').' '.$eventObj->getStartTime('H:i') ?></td>
	<td onclick="<?php echo $link ?>" class="recordCell" align="left"><?php echo $eventObj->getEventPlace() ?></td>
	<td onclick="<?php echo $link ?>" class="recordCell" align="center"><?php echo sprintf('%02d', $eventObj->getInvites()).' ('.sprintf('%02d', $eventObj->getPlayers()).')' ?></td>
	<td class="recordCell" align="left" style="padding: 3px 0px 3px 6px"><?php echo link_to(image_tag('icon/clone'), '#cloneEvent('.$eventObj->getId().')', array('title'=>'Duplicar evento a partir deste')) ?></td>
</tr>
<?php
	endforeach;
  	
	if( count($eventObjList)==0 ):
?>
<tr class="boxcontent">
	<td colspan="6">Não existem eventos disponíveis para seus rankings</td>
</tr>
<?php endif; ?>