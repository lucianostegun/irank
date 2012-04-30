<?php
	$players = $eventLiveObj->getPlayers();
	
	$eventLivePlayerObjList = $eventLiveObj->getEventLivePlayerResultList(null, true);
	
	$totalPrizeValue = 0;
	$eventPosition   = 0;
	$eventLiveId     = $eventLiveObj->getId();
?>
<tr class="thead">
	<th colspan="3" class="mark"><div id="playerResultCountDiv"><?php echo $players.' Jogador'.($players==1?'':'es').' inscrito'.($players==1?'':'s') ?></div></th> 
	<th colspan="2" class="calculateScore mark"></th> 
</tr>
<tr class="thead"> 
	<th class="mark">#</th> 
	<th class="mark">Nome</th> 
	<th class="mark">E-mail</th> 
	<th class="mark">Premiação</th> 
	<th class="mark">Pontos</th> 
</tr>
<?php
	$eventPlayerPositionList = array();
	foreach($eventLivePlayerObjList as $eventPosition=>$eventLivePlayerObj)
		$eventPlayerPositionList[$eventPosition+1] = $eventLivePlayerObj;
	
	for($eventPosition=1; $eventPosition <= $players; $eventPosition++):
	
		if( array_key_exists($eventPosition, $eventPlayerPositionList) ){
			
			$eventLivePlayerObj = $eventPlayerPositionList[$eventPosition];
			$peopleObj          = $eventLivePlayerObj->getPeople();
			
			$peopleId     = $peopleObj->getId();
			$peopleName   = $peopleObj->getFullName();
			$emailAddress = $peopleObj->getEmailAddress();
			$prize        = $eventLivePlayerObj->getPrize();
			$score        = $eventLivePlayerObj->getScore();
		}else{
			
			$peopleId     = null;
			$peopleName   = null;
			$emailAddress = null;
			$prize        = 0;
			$score        = 0;
		}
	
		$totalPrizeValue += $prize;
		
		$class = ($eventPosition%2==0?'rd':'rl odd');
?>
<tr class="<?php echo $class ?> gradeB" id="eventLiveResultRow-<?php echo $eventPosition ?>">
	<td class="eventLivePositionLabel" width="5%" id="eventLivePositionLabel-<?php echo $eventPosition ?>"><?php echo $eventPosition ?></td> 
	<td class="playerName" width="40%"><?php echo $peopleName ?></td>
	<td class="emailAddress" width="35%" id="eventLiveResultEmailAddressTd-<?php echo $eventPosition ?>"><?php echo $emailAddress ?></td>
	<td class="prizeRo textR"><?php echo Util::formatFloat($prize, true) ?></td>
	<td class="scoreRo textR"><?php echo Util::formatFloat($score, true, 3) ?></td>
</tr>
<?php endfor; ?>
	<tr class="tfoot resumeEventResult"> 
		<th></th> 
		<th></th> 
		<th></th> 
		<th id="totalPrizeValue"><?php echo Util::formatFloat($totalPrizeValue, true) ?></th> 
		<th></th> 
	</tr>