<?php
	$eventPersonalObjList = EventPersonal::getList($criteria);
  	
	foreach($eventPersonalObjList as $eventPersonalObj):
		
		$eventPersonalId = $eventPersonalObj->getId();
		$link = 'goModule(\'eventPersonal\', \'edit\', \'eventPersonalId\', '.$eventPersonalId.')';
?>
<tr onmouseover="this.className='recordRowOver'" onmouseout="this.className=''">
	<td onclick="<?php echo $link ?>" align="left"><?php echo $eventPersonalObj->getEventName() ?></td>
	<td onclick="<?php echo $link ?>" align="center"><?php echo $eventPersonalObj->getEventDate('d/m/Y') ?></td>
	<td onclick="<?php echo $link ?>" align="left"><?php echo $eventPersonalObj->getEventPlace() ?></td>
	<td onclick="<?php echo $link ?>" align="center"><?php echo sprintf('%02d', $eventPersonalObj->getPlayers()) ?></td>
	<td onclick="<?php echo $link ?>" align="center">#<?php echo sprintf('%02d', $eventPersonalObj->getEventPosition()) ?></td>
	<td onclick="<?php echo $link ?>" align="center"><?php echo Util::formatFloat($eventPersonalObj->getBRA(), true) ?></td>
	<td onclick="<?php echo $link ?>" align="center"><?php echo Util::formatFloat($eventPersonalObj->getPrize(), true) ?></td>
</tr>
<?php
	endforeach;

	if( count($eventPersonalObjList)==0 ):
?>
<tr class="boxcontent">
	<td colspan="7">
		<?php echo __('eventPersonal.noEvents') ?><br/>
		<?php echo __('eventPersonal.newEventInvite', array('%clickHere%'=>link_to(__('ClickHere'), 'eventPersonal/new'))) ?>
	</td>
</tr>
<?php endif; ?>