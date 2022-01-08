<?php
	$eventObjList = Event::getList($criteria);
  	
	foreach($eventObjList as $eventObj):
		$isMyEvent = $eventObj->isMyEvent();
		
		$eventId = $eventObj->getId();
		$link = 'goModule(\'event\', \'edit\', \'eventId\', '.$eventId.', true)';
		
		$comments = Util::executeOne('SELECT COUNT(1) FROM event_comment WHERE event_id = '.$eventId.' AND deleted = false');
		$photos   = Util::executeOne('SELECT COUNT(1) FROM event_photo WHERE event_id = '.$eventId.' AND deleted = false');
?>
<tr onmouseover="this.className='recordRowOver'" onmouseout="this.className=''">
	<td onclick="<?php echo $link ?>" align="left"><?php echo $eventObj->getEventName().($isMyEvent?'*':'') ?></td>
	<td onclick="<?php echo $link ?>" align="left"><?php echo $eventObj->getRanking()->getRankingName() ?></td>
	<td onclick="<?php echo $link ?>" align="center"><?php echo $eventObj->getEventDate('d/m/Y').' '.$eventObj->getStartTime('H:i') ?></td>
	<td onclick="<?php echo $link ?>" align="left"><?php echo $eventObj->getEventPlace() ?></td>
	<td onclick="<?php echo $link ?>" align="center"><?php echo sprintf('%02d', $eventObj->getInvites()).' ('.sprintf('%02d', $eventObj->getPlayers()).')' ?></td>
	<td onclick="<?php echo $link ?>" class="icon" align="left"><?php echo ($comments>0?image_tag('icon/comment', array('title'=>__('event.hint.eventComment'.($comments==1?'':'s'), array('%comments%'=>$comments)))):'') ?></td>
	<td onclick="<?php echo $link ?>" class="icon" align="left"><?php echo ($photos>0?image_tag('icon/photo', array('title'=>__('event.hint.eventPhoto'.($photos==1?'':'s'), array('%photos%'=>$photos)))):'') ?></td>
</tr>
<?php
	endforeach;

	if( count($eventObjList)==0 ):
?>
<tr class="boxcontent">
	<td colspan="7"><?php echo __('event.noEvents') ?></td>
</tr>
<?php endif; ?>