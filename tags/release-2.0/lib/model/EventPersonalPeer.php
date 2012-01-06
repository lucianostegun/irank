<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'event_personal'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventPersonalPeer extends BaseEventPersonalPeer
{
	
	public static function uniqueEventName($eventName){

		$eventPersonalId = MyTools::getRequestParameter('eventPersonalId');
		$eventDate       = MyTools::getRequestParameter('eventDate');
		
		$criteria = new Criteria();
		$criteria->add( EventPersonalPeer::VISIBLE, true );
		$criteria->add( EventPersonalPeer::ENABLED, true );
		$criteria->add( EventPersonalPeer::DELETED, false );
		$criteria->add( EventPersonalPeer::ID, $eventPersonalId, Criteria::NOT_EQUAL );
		$criteria->add( EventPersonalPeer::EVENT_DATE, Util::formatDate($eventDate) );
		$criteria->add( EventPersonalPeer::EVENT_NAME, $eventName, Criteria::ILIKE );
		$eventPersonalCount = EventPersonalPeer::doCount($criteria);
		
		return ($eventPersonalCount==0);
	}
}
