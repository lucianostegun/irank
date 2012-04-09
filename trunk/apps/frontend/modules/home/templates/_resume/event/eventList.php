<?php
	$userSiteObj = UserSite::getCurrentUser();
	$eventObjList = $userSiteObj->getEventListResume(5, $offset, $eventDate);
	
	if( empty($eventObjList) )
		include_partial('home/resume/event/noEvent');
	else{
		
		foreach($eventObjList as $eventObj){
			
			if( $eventObj->isPastDate() )
				include_partial('home/resume/event/pastEvent', array('eventObj'=>$eventObj));
			else
				include_partial('home/resume/event/nextEvent', array('eventObj'=>$eventObj));
		}
	}
?>