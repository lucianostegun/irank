<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'event'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventPeer extends BaseEventPeer
{
	
	public static function doSelectRS(Criteria $criteria, $con = null){
		
		$peopleId = MyTools::getAttribute('peopleId');
		
		$criteria->addAnd( self::DELETED, false );
		
		$criterion = $criteria->getNewCriterion( EventMemberPeer::PEOPLE_ID, $peopleId );
		$criterion2 = $criteria->getNewCriterion( EventMemberPeer::PEOPLE_ID, null );
		$criterion2->addAnd( $criteria->getNewCriterion( EventPeer::ENABLED, false ) );
		
		$criterion2->addOr($criterion);
		$criteria->add($criterion2);
		
		$criteria->addJoin( EventPeer::ID, EventMemberPeer::EVENT_ID, Criteria::LEFT_JOIN );
		
		return parent::doSelectRS($criteria, $con);
	}
	
	public static function retrieveByPK($pk, $con = null){
		
		$eventObj = parent::retrieveByPK($pk, $con);
		
		if( !is_object($eventObj) )
			throw new Exception('Evento não encontrado!');
		else
			return $eventObj;
	}
	public static function uniqueEventName($eventName){

		$eventId   = MyTools::getRequestParameter('eventId');
		$eventDate = MyTools::getRequestParameter('eventDate');
		
		$criteria = new Criteria();
		$criteria->add( EventPeer::VISIBLE, true );
		$criteria->add( EventPeer::ENABLED, true );
		$criteria->add( EventPeer::DELETED, false );
		$criteria->add( EventPeer::ID, $eventId, Criteria::NOT_EQUAL );
		$criteria->add( EventPeer::EVENT_DATE, Util::formatDate($eventDate) );
		$criteria->add( EventPeer::EVENT_NAME, $eventName, Criteria::ILIKE );
		$eventObj = EventPeer::doSelectOne( $criteria );
		
		return !is_object( $eventObj );
	}
}
