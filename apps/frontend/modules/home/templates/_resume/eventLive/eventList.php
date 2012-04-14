<?php
	$eventLiveObjList = EventLive::getList();
	if( empty($eventLiveObjList) )
		include_partial('home/resume/event/noEvent');
	else{
		
		foreach($eventLiveObjList as $eventLiveObj){
			
			if( $eventLiveObj->isPastDate() )
				include_partial('home/resume/eventLive/pastEvent', array('eventLiveObj'=>$eventLiveObj));
			else
				include_partial('home/resume/eventLive/nextEvent', array('eventLiveObj'=>$eventLiveObj));
		}
	}
?>