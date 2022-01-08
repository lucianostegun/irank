<?php
	$eventObjList = Event::getList($criteria);
  	
	foreach($eventObjList as $eventObj):
		$isMyEvent = $eventObj->isMyEvent();
		
		$eventId = $eventObj->getId();
		$link = 'goModule(\'event\', \'edit\', \'eventId\', '.$eventId.')';
		
		$comments = Util::executeOne('SELECT COUNT(1) FROM event_comment WHERE event_id = '.$eventId);
		$photos   = Util::executeOne('SELECT COUNT(1) FROM event_photo WHERE event_id = '.$eventId);
?>
<tr class="recordRow" onmouseover="this.className='recordRowOver'" onmouseout="this.className='recordRow'">
	<td onclick="<?php echo $link ?>" class="recordCell" align="left"><?php echo $eventObj->getEventName().($isMyEvent?'*':'') ?></td>
	<td onclick="<?php echo $link ?>" class="recordCell" align="left"><?php echo $eventObj->getRanking()->getRankingName() ?></td>
	<td onclick="<?php echo $link ?>" class="recordCell" align="center"><?php echo $eventObj->getEventDate('d/m/Y').' '.$eventObj->getStartTime('H:i') ?></td>
	<td onclick="<?php echo $link ?>" class="recordCell" align="left"><?php echo $eventObj->getEventPlace() ?></td>
	<td onclick="<?php echo $link ?>" class="recordCell" align="center"><?php echo sprintf('%02d', $eventObj->getInvites()).' ('.sprintf('%02d', $eventObj->getPlayers()).')' ?></td>
	<td onclick="<?php echo $link ?>" class="recordCell" align="left" style="padding: 3px 0px 3px 6px"><?php echo ($comments>0?image_tag('icon/comment', array('title'=>'Este evento possui '.$comments.' comentário'.($comments==1?'':'s'))):'') ?></td>
	<td onclick="<?php echo $link ?>" class="recordCell" align="left" style="padding: 3px 0px 3px 6px"><?php echo ($photos>0?image_tag('icon/photo', array('title'=>'Este evento possui '.$photos.' foto'.($photos==1?'':'s'))):'') ?></td>
</tr>
<?php
	endforeach;
  	
	if( count($eventObjList)==0 ):
?>
<tr class="boxcontent">
	<td colspan="6">Não existem eventos disponíveis para seus rankings</td>
</tr>
<?php endif; ?>