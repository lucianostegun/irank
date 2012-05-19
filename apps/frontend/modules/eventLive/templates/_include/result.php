<?php
	if( !$eventLiveObj->getSavedResult() ){
		
		echo '<div class="textC mt40"><h2>O resultado deste evento ainda não foi processado!</h2></div>';
		return;
	}
	
	$publishPrize = $eventLiveObj->getPublishPrize();
?>
<table border="0" cellspacing="0" cellpadding="0" class="gridTable">
	<tr class="header">
		<th style="width: 10%" class="first">Posição</th>
		<th style="width: 70%">Nome</th>
		<th style="width: 10%">Pontos</th>
		<?php if( $publishPrize ): ?>
			<th style="width: 10%"><?php echo __('Prize') ?></th>
		<?php endif; ?>
	</tr>
	<tbody>
<?php
	$eventLivePlayerObjList = $eventLiveObj->getEventLivePlayerResultList(null, true);
	$peopleIdCurrent        = $sf_user->getAttribute('peopleId');
	
	$eventPosition = 0;
	foreach($eventLivePlayerObjList as $eventLivePlayerObj):
	
		$peopleObj = $eventLivePlayerObj->getPeople();
		
		$eventPosition++;
		$peopleId     = $peopleObj->getId();
		$peopleName   = $peopleObj->getFullName();
		$emailAddress = $peopleObj->getEmailAddress();
		$prize        = $eventLivePlayerObj->getPrize();
		$score        = $eventLivePlayerObj->getScore();
		
		$class = ($peopleIdCurrent==$peopleId?'itsMe':'');
?>
<tr class="<?php echo $class ?>">
	<td class="textR"><?php echo $eventPosition ?>º</td> 
	<td><?php echo $peopleName ?></td>
	<td class="textR"><?php echo Util::formatFloat($score, true, 3) ?></td>
	<?php if( $publishPrize ): ?>
	<td class="textR"><?php echo Util::formatFloat($prize, true) ?></td>
	<?php endif; ?>
</tr>
<?php endforeach; ?>
</tbody>
</table>