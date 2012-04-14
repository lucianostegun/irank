<?php
	$players = $eventLiveObj->getPlayers();
	
	$eventLivePlayerObjList = $eventLiveObj->getEventLivePlayerResultList();
	
	$eventPosition = 0;
	$eventLiveId   = $eventLiveObj->getId();
	$eventPlayerPositionList = array();
	foreach($eventLivePlayerObjList as $eventLivePlayerObj)
		$eventPlayerPositionList[$eventLivePlayerObj->getEventPosition()] = $eventLivePlayerObj;
	
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
	
		$class = ($eventPosition%2==0?'rd':'rl odd');
?>
<tr class="<?php echo $class ?>" id="eventLiveResultRow-<?php echo $eventPosition ?>">
	<td class="rowhandler"><div class="drag row"></div></td> 
	<td id="eventLivePositionLabel-<?php echo $eventPosition ?>" class="eventLivePositionLabel"><?php echo $eventPosition ?></td> 
	<td>
		<?php
		    echo input_hidden_tag('peopleIdPosition-'.$eventPosition, $peopleId);
			echo input_tag('peopleName', $peopleName, array('autocomplete'=>'off', 'onblur'=>'checkEventPositionField('.$eventPosition.')', 'size'=>40, 'class'=>'autocompletePlayer', 'id'=>'eventLivePeopleNameResult-'.$eventPosition));
		?>
		<div id="eventLivePeopleNameResult-<?php echo $eventPosition ?>_auto_complete" class="auto_complete"></div>
	</td>
	<td class="prize"><?php echo input_tag('prize-'.$eventPosition, Util::formatFloat($prize, true), array('maxlength'=>7)); ?></td>
	<td class="score"><?php echo input_tag('score-'.$eventPosition, Util::formatFloat($score, true), array('maxlength'=>6)); ?></td>
	<td class="emailAddress" id="eventLiveResultEmailAddressTd-<?php echo $eventPosition ?>"><?php echo $emailAddress ?></td>
</tr>
<?php endfor; ?>
<script type="text/javascript">
	setupEventLiveResultAutoComplete();
</script>