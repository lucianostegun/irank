<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'event_prize_config'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventPrizeConfigPeer extends BaseEventPrizeConfigPeer
{
	
	public static function retrieveByPK($eventId, $eventPosition, $con=null){
		
		$eventPrizeConfigObj = parent::retrieveByPK($eventId, $eventPosition, $con);
		
		if( !is_object($eventPrizeConfigObj) ){
			
			$eventPrizeConfigObj = new EventPrizeConfig();
			$eventPrizeConfigObj->setEventId($eventId);
			$eventPrizeConfigObj->setEventPosition($eventPosition);
		}
		
		return $eventPrizeConfigObj;
	}
}
