<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'event_live_player_disclosure_sms'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventLivePlayerDisclosureSmsPeer extends BaseEventLivePlayerDisclosureSmsPeer
{
	
	public static function retrieveByPK($eventLiveId, $peopleId, $con=null){
		
		$eventLivePlayerDisclosureSmsObj = parent::retrieveByPK($eventLiveId, $peopleId, $con);
		
		if( !is_object($eventLivePlayerDisclosureSmsObj) ){
			
			$eventLivePlayerDisclosureSmsObj = new EventLivePlayerDisclosureSms();
			$eventLivePlayerDisclosureSmsObj->setEventLiveId($eventLiveId);
			$eventLivePlayerDisclosureSmsObj->setPeopleId($peopleId);
		}
		
		return $eventLivePlayerDisclosureSmsObj;
	}
}
