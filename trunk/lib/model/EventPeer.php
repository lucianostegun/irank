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
		
		if( !$criteria->isNoFilter() ){
		
			$criterion = $criteria->getNewCriterion( EventPlayerPeer::PEOPLE_ID, $peopleId );
			$criterion2 = $criteria->getNewCriterion( EventPlayerPeer::PEOPLE_ID, null );
			$criterion2->addAnd( $criteria->getNewCriterion( EventPeer::ENABLED, false ) );
			
			$criterion2->addOr($criterion);
			$criteria->add($criterion2);
			
			$criteria->addJoin( EventPeer::ID, EventPlayerPeer::EVENT_ID, Criteria::LEFT_JOIN );
		}
		
		return parent::doSelectRS($criteria, $con);
	}
	
	public static function retrieveByPK($pk, $con = null){
		
		$eventObj = parent::retrieveByPK($pk, $con);
		
		if( !is_object($eventObj) ){
		
			Util::getHelper('i18n');	
			throw new Exception(__('eventNotFound'));
		}else
			return $eventObj;
	}
	
	public static function uniqueEventName($eventName){

		$rankingId = MyTools::getRequestParameter('rankingId');
		$eventId   = MyTools::getRequestParameter('eventId');
		$eventDate = MyTools::getRequestParameter('eventDate');
		
		$criteria = new Criteria();
		$criteria->add( EventPeer::VISIBLE, true );
		$criteria->add( EventPeer::ENABLED, true );
		$criteria->add( EventPeer::DELETED, false );
		$criteria->add( EventPeer::RANKING_ID, $rankingId );
		$criteria->add( EventPeer::ID, $eventId, Criteria::NOT_EQUAL );
		$criteria->add( EventPeer::EVENT_DATE, Util::formatDate($eventDate) );
		$criteria->add( EventPeer::EVENT_NAME, $eventName, Criteria::ILIKE );
		$eventCount = EventPeer::doCount($criteria);
		
		return ($eventCount==0);
	}
	
	public static function validateEventDate($eventDate){
		
		$rankingId = MyTools::getRequestParameter('rankingId');

		$criteria = new Criteria();
		$criteria->add( EventPeer::RANKING_ID, $rankingId );
		$criteria->add( EventPeer::EVENT_DATE, Util::formatDate($eventDate), Criteria::GREATER_THAN );
		$criteria->add( EventPeer::SAVED_RESULT, true );
		$criteria->add( EventPeer::ENABLED, true );
		$criteria->add( EventPeer::VISIBLE, true );
		$criteria->add( EventPeer::DELETED, false );
		$eventCount = EventPeer::doCount($criteria);

		return ($eventCount==0);
	}
}
