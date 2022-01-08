<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'event_live_player_disclosure_email'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventLivePlayerDisclosureEmailPeer extends BaseEventLivePlayerDisclosureEmailPeer
{
	
	public static function retrieveByPK($eventLiveId, $peopleId, $con=null){
		
		$eventLivePlayerDisclosureEmailObj = parent::retrieveByPK($eventLiveId, $peopleId, $con);
		
		if( !is_object($eventLivePlayerDisclosureEmailObj) ){
			
			$eventLivePlayerDisclosureEmailObj = new EventLivePlayerDisclosureEmail();
			$eventLivePlayerDisclosureEmailObj->setEventLiveId($eventLiveId);
			$eventLivePlayerDisclosureEmailObj->setPeopleId($peopleId);
		}
		
		return $eventLivePlayerDisclosureEmailObj;
	}
}
