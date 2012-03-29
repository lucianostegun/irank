<table border="0" cellspacing="0" cellpadding="0" class="gridTable">
	<tr class="header">
		<th style="width: 55px" class="first">Posição</th>
		<th>Nome</th>
		<th style="width: 80px">Pontos</th>
		<th style="width: 80px"><?php echo __('Prize') ?></th>
	</tr>
	<tbody>
<?php
	$eventLivePlayerObjList = $eventLiveObj->getEventLivePlayerResultList();
	
	foreach($eventLivePlayerObjList as $eventLivePlayerObj):
	
		$peopleObj = $eventLivePlayerObj->getPeople();
		
		$peopleId     = $peopleObj->getId();
		$peopleName   = $peopleObj->getFullName();
		$emailAddress = $peopleObj->getEmailAddress();
		$prize        = $eventLivePlayerObj->getPrize();
		$score        = $eventLivePlayerObj->getScore();
?>
<tr class="<?php echo $class ?>">
	<td><?php echo $eventLivePlayerObj->getEventPosition() ?></td> 
	<td><?php echo $peopleName ?></td>
	<td style="text-align: right"><?php echo Util::formatFloat($score, true, 1) ?></td>
	<td style="text-align: right"><?php echo Util::formatFloat($prize, true) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>