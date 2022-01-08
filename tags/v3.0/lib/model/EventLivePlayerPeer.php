<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'event_live_player'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventLivePlayerPeer extends BaseEventLivePlayerPeer
{
	
	public static function retrieveByPK($eventLiveId, $peopleId, $con=null){
		
		$eventLivePlayerObj = parent::retrieveByPK($eventLiveId, $peopleId, $con);
		
		if( !is_object($eventLivePlayerObj) ){
			
			$eventLivePlayerObj = new EventLivePlayer();
			$eventLivePlayerObj->setEventLiveId($eventLiveId);
			$eventLivePlayerObj->setPeopleId($peopleId);
			$eventLivePlayerObj->setEnabled(false);
			$eventLivePlayerObj->save();
		}
		
		return $eventLivePlayerObj;
	}
}
