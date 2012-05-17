<?php

	// Busca todos os eventos até a hora atual
	$criteria = new Criteria();
	$criteria->add( EventLivePeer::EVENT_DATE_TIME, date('Y-m-d H:00'), Criteria::GREATER_EQUAL );
	$criteria->add( EventLivePeer::EVENT_DATE, Util::getDate('1m'), Criteria::LESS_EQUAL );
	$criteria->add( RankingLivePeer::IS_PRIVATE, false );
	$criteria->addJoin( EventLivePeer::RANKING_LIVE_ID, RankingLivePeer::ID, Criteria::LEFT_JOIN );
	$criteria->setLimit($limit);
	$criteria->setOffset($offset);
	
	$eventLiveObjList = EventLive::getList($criteria);
	if( !empty($eventLiveObjList) ){
		foreach($eventLiveObjList as $eventLiveObj){
			
			if( $eventLiveObj->isPastDate() )
				include_partial('home/resume/eventLive/pastEvent', array('eventLiveObj'=>$eventLiveObj));
			else
				include_partial('home/resume/eventLive/nextEvent', array('eventLiveObj'=>$eventLiveObj));
		}
	}
?>