<?php
	$eventObjList = Event::getList($criteria);
  	
	foreach($eventObjList as $key=>$eventObj):
		
		$eventId = $eventObj->getId();
		$link = 'goModule(\'event\', \'edit\', \'eventId\', '.$eventId.')';
		
		$comments = Util::executeOne('SELECT COUNT(1) FROM event_comment WHERE event_id = '.$eventId.' AND deleted = false');
		$photos   = Util::executeOne('SELECT COUNT(1) FROM event_photo WHERE event_id = '.$eventId.' AND deleted = false');
		
		$className = ($key%2==0?'':'odd');
		$className .= ($key==0?' first':'');
?>
<tr onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" class="<?php echo $className ?>">
	<td onclick="<?php echo $link ?>" align="left"><?php echo $eventObj->getEventName() ?></td>
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
	<td colspan="7">
		Nenhum evento foi encontrado para os parâmetros pesquisados.<br/>
		<?php echo link_to('Clique aqui', 'event/new') ?> para criar um novo evento.
	</td>
</tr>
<?php endif; ?>