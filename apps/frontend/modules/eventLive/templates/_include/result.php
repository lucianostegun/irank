<?php
	if( !$eventLiveObj->getSavedResult() ){
		
		echo '<br/><br/><center><h2>O resultado deste evento ainda não foi processado!</h2></center>';
		return;
	}
?>
<table border="0" cellspacing="0" cellpadding="0" class="gridTable">
	<tr class="header">
		<th style="width: 55px" class="first">Posição</th>
		<th>Nome</th>
		<th style="width: 80px">Pontos</th>
		<th style="width: 80px"><?php echo __('Prize') ?></th>
	</tr>
	<tbody>
<?php
	$eventLivePlayerObjList = $eventLiveObj->getEventLivePlayerResultList(null, true);
	
	$eventPosition = 0;
	foreach($eventLivePlayerObjList as $eventLivePlayerObj):
	
		$peopleObj = $eventLivePlayerObj->getPeople();
		
		$eventPosition++;
		$peopleId     = $peopleObj->getId();
		$peopleName   = $peopleObj->getFullName();
		$emailAddress = $peopleObj->getEmailAddress();
		$prize        = $eventLivePlayerObj->getPrize();
		$score        = $eventLivePlayerObj->getScore();
?>
<tr class="<?php echo $class ?>">
	<td><?php echo $eventPosition ?>º</td> 
	<td><?php echo $peopleName ?></td>
	<td style="text-align: right"><?php echo Util::formatFloat($score, true, 3) ?></td>
	<td style="text-align: right"><?php echo Util::formatFloat($prize, true) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>