<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'event_live_player_disclosure'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventLivePlayerDisclosurePeer extends BaseEventLivePlayerDisclosurePeer
{
	
	public static function retrieveByPK($eventLiveId, $peopleId, $con=null){
		
		$eventLivePlayerDisclosureObj = parent::retrieveByPK($eventLiveId, $peopleId, $con);
		
		if( !is_object($eventLivePlayerDisclosureObj) ){
			
			$eventLivePlayerDisclosureObj = new EventLivePlayerDisclosure();
			$eventLivePlayerDisclosureObj->setEventLiveId($eventLiveId);
			$eventLivePlayerDisclosureObj->setPeopleId($peopleId);
			$eventLivePlayerDisclosureObj->save();
		}
		
		return $eventLivePlayerDisclosureObj;
	}
}
