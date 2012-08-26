<?php
	$eventPersonalObjList = EventPersonal::getList($criteria);
  	
	foreach($eventPersonalObjList as $eventPersonalObj):
		
		$eventPersonalId = $eventPersonalObj->getId();
		$link = 'goModule(\'eventPersonal\', \'edit\', \'eventPersonalId\', '.$eventPersonalId.')';
		
		$players       = $eventPersonalObj->getPlayers();
		$eventPosition = $eventPersonalObj->getEventPosition();

		$players       = ($players?sprintf('%02d', $players):'-');
		$eventPosition = ($eventPosition?sprintf('#%02d', $eventPosition):'-');
?>
<tr onclick="<?php echo $link ?>" class="hoverable">
	<td class="textL"><?php echo $eventPersonalObj->getEventName() ?></td>
	<td class="textC"><?php echo $eventPersonalObj->getEventDate('d/m/Y') ?></td>
	<td class="textL"><?php echo $eventPersonalObj->getEventPlace() ?></td>
	<td class="textC"><?php echo $players ?></td>
	<td class="textC"><?php echo $eventPosition ?></td>
	<td class="textR"><?php echo Util::formatFloat($eventPersonalObj->getBRA(), true) ?></td>
	<td class="textR"><?php echo Util::formatFloat($eventPersonalObj->getPrize(), true) ?></td>
</tr>
<?php
	endforeach;

	if( count($eventPersonalObjList)==0 ):
?>
<tr class="boxcontent">
	<td colspan="7">
		<div class="p20">
		Você ainda não cadastrou nenhum evento pessoal em seu histórico.<br/>
		<?php echo link_to('Clique aqui', 'eventPersonal/new') ?> para criar um novo evento.
		</div>
	</td>
</tr>
<?php endif; ?>