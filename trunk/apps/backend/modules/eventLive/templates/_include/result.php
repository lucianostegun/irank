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
			echo input_auto_complete_tag(
		      'peopleName',
		      $peopleName,
		      'eventLive/autoComplete?instanceName=player&eventLiveId='.$eventLiveObj->getId(),
		      array('autocomplete' => 'off', 'size'=>40, 'id'=>'eventLivePeopleNameResult-'.$eventPosition),
		      array(
		        'use_style'             => true,
		        'after_update_element'  => 'function (inputField, selectedItem){ handleSelectEventLivePlayerResult(selectedItem.id, inputField.value, '.$eventPosition.') }',
		      	'with'                  => ' value+\'?&peopleName=\'+$("eventLivePeopleNameResult-'.$eventPosition.'").value',
		      	'inTab'                 => false)
		    );
		?>
	</td>
	<td class="prize"><?php echo input_tag('peopleIdPrize-'.$eventPosition, Util::formatFloat($prize, true), array('size'=>6)); ?></td>
	<td class="emailAddress" id="eventLiveResultEmailAddressTd-<?php echo $eventPosition ?>"><?php echo $emailAddress ?></td>
</tr> 
<?php endfor; ?>