<table width="100%" cellpadding="0" cellspacing="0" class="tableMenu">
<?php
	$eventObjList = $rankingObj->getEventList();
  	
	foreach($eventObjList as $eventObj):
?>
	<tr onclick="goModule('event', 'edit', 'eventId', <?php echo $eventObj->getId() ?>)">
		<td>
			<?php echo $eventObj->getEventName() ?><br/>
			<span><?php echo $eventObj->getEventDate('d/m/Y').' '.$eventObj->getStartTime('H:i').' - '.$eventObj->getEventPlace() ?></span></td>
	</tr>
  <?php
  	endforeach;
  	
  	if( count($eventObjList)==0 ):
  ?>
    <br/><div class="text">Não existem eventos disponíveis para este ranking</div>
  <?php endif; ?>
</table>