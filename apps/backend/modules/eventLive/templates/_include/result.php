<?php
	$players = $eventLiveObj->getPlayers();
	
	$criteria = new Criteria();
	$criteria->add( EventLivePlayerPeer::ENABLED, true );
	$criteria->add( EventLivePlayerPeer::EVENT_POSITION, 0, Criteria::GREATER_THAN );
	$criteria->addAscendingOrderByColumn( EventLivePlayerPeer::EVENT_POSITION );
	$eventLivePlayerObjList = $eventLiveObj->getEventLivePlayerList($criteria);
	
	$eventPosition = 0;
	$eventPlayerPositionList = array();
	foreach($eventLivePlayerObjList as $eventLivePlayerObj)
		$eventPlayerPositionList[$eventLivePlayerObj->getEventPosition()] = $eventLivePlayerObj;
	
	for($eventPosition=1; $eventPosition <= $players; $eventPosition++):
	
		if( array_key_exists($eventPosition, $eventPlayerPositionList) ){
			
			$eventPlayerPositionObj = $eventPlayerPositionList[$eventPosition];
			$peopleObj              = $eventPlayerPositionObj->getPeople();
			
			$peopleId     = $peopleObj->getId();
			$peopleName   = $peopleObj->getFullName();
			$emailAddress = $peopleObj->getEmailAddress();
			$prize        = $eventLivePlayerObj->getPrize();
		}else{
			
			$peopleId     = null;
			$peopleName   = null;
			$emailAddress = null;
			$prize        = 0;
		}
	
		$class = ($eventPosition%2==0?'rd':'rl odd');
?>
<tr class="<?php echo $class ?>" id="eventLiveResultRow-<?php echo $eventPosition ?>" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">
	<td class="rowhandler"><div class="drag row"></div></td> 
	<td id="eventLivePositionLabel-<?php echo $eventPosition ?>" class="eventLivePositionLabel"><?php echo $eventPosition ?></td> 
	<td>
		<?php
		    echo input_hidden_tag('peopleIdPosition-'.$eventPosition, $peopleId);
			echo input_tag('peopleName', $peopleName, array('autocomplete' => 'off', 'size'=>40, 'id'=>'eventLivePeopleNameResult-'.$eventPosition));
		?>
		<div id="eventLivePeopleNameResult-<?php echo $eventPosition ?>_auto_complete" class="auto_complete"></div>
	</td>
	<td class="prize"><?php echo input_tag('peopleIdPrize-'.$eventPosition, Util::formatFloat($prize, true), array('size'=>6)); ?></td>
	<td class="emailAddress" id="eventLiveResultEmailAddressTd-<?php echo $eventPosition ?>"><?php echo $emailAddress ?></td>
</tr>
<?php
	endfor;
	
	echo "<script type=\"text/javascript\">";
	
	for($eventPosition=1; $eventPosition <= $players; $eventPosition++):
	
	echo "//<![CDATA[
	var autoComplete{$eventPosition}Obj = new Ajax.Autocompleter('eventLivePeopleNameResult-$eventPosition', 'eventLivePeopleNameResult-{$eventPosition}_auto_complete', '/backend_dev.php/eventLive/autoComplete/instanceName/player/eventLiveId/95', {afterUpdateElement:function (inputField, selectedItem){ handleSelectEventLivePlayerResult(selectedItem.id, inputField.value, $eventPosition) }, callback:function(element, value) { return  value+'?&peopleName='+\$(\"eventLivePeopleNameResult-$eventPosition\").value}});
	//]]>\n\n";
	
	endfor;
?>
</script>