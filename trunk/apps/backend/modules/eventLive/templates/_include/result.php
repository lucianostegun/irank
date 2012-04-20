<?php
	$players = $eventLiveObj->getPlayers();
	
	$eventLivePlayerObjList = $eventLiveObj->getEventLivePlayerResultList(null, true);
	
	$totalPrizeValue = 0;
	$eventPosition   = 0;
	$eventLiveId     = $eventLiveObj->getId();
	
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
	<td width="10" class="rowhandler"><div class="drag row"></div></td> 
	<td width="5%" id="eventLivePositionLabel-<?php echo $eventPosition ?>" class="eventLivePositionLabel"><?php echo $eventPosition ?></td> 
	<td width="40%">
		<?php
		    echo input_hidden_tag('peopleIdPosition-'.$eventPosition, $peopleId);
			echo input_tag('peopleName', $peopleName, array('tabindex'=>$eventPosition, 'autocomplete'=>'off', 'onblur'=>'checkEventPositionField('.$eventPosition.')', 'size'=>40, 'class'=>'autocompletePlayer', 'id'=>'eventLivePeopleNameResult-'.$eventPosition));
		?>
		<div id="eventLivePeopleNameResult-<?php echo $eventPosition ?>_auto_complete" class="auto_complete"></div>
	</td>
	<td width="35%" class="emailAddress" id="eventLiveResultEmailAddressTd-<?php echo $eventPosition ?>"><?php echo $emailAddress ?></td>
	<td class="prize"><?php echo input_tag('prize-'.$eventPosition, Util::formatFloat($prize, true), array('maxlength'=>7, 'class'=>'decimal', 'tabindex'=>($players+$eventPosition), 'onkeyup'=>'updateTotalPrizeValue()')); ?></td>
	<td class="score"><?php echo input_tag('score-'.$eventPosition, Util::formatFloat($score, true, 3), array('maxlength'=>6, 'class'=>'decimal', 'tabindex'=>(($players*2)+$eventPosition))); ?></td>
</tr>
<?php endfor; ?>
	<tr class="tfoot resumeEventResult"> 
		<th></th>
		<th></th> 
		<th></th> 
		<th></th> 
		<th id="totalPrizeValue"><?php echo Util::formatFloat($totalPrizeValue, true) ?></th> 
		<th></th> 
	</tr>
<script type="text/javascript">
	setupEventLiveResultAutoComplete();
</script>