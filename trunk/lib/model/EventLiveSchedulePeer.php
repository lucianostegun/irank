<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'event_live_schedule'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventLiveSchedulePeer extends BaseEventLiveSchedulePeer
{
	
	public static function retrieveById($eventLiveScheduleId){
		
		$criteria = new Criteria();
		$criteria->add( EventLiveSchedulePeer::ID, $eventLiveScheduleId);
		return EventLiveSchedulePeer::doSelectOne($criteria);
	}
	
	public static function search($criteria=null){
		
		$request = MyTools::getRequest();
		$clubId  = $request->getParameter('clubId');
		
		if( is_null($criteria) )
			$criteria = new Criteria();
			
		$criteria->add( EventLivePeer::ENABLED, true );
		$criteria->add( EventLivePeer::VISIBLE, true );
		$criteria->add( EventLivePeer::DELETED, false );

		$criterion = $criteria->getNewCriterion( RankingLivePeer::ENABLED, true );
		$criterion->addAnd( $criteria->getNewCriterion( RankingLivePeer::VISIBLE, true ) );
		$criterion->addAnd( $criteria->getNewCriterion( RankingLivePeer::DELETED, false ) );
		
		$criterion2 = $criteria->getNewCriterion( EventLivePeer::RANKING_LIVE_ID, NULL );
		$criterion->addOr($criterion2);
		$criteria->add($criterion);
		
		if( $clubId )
			$criteria->add( EventLivePeer::CLUB_ID, $clubId );
		
		$criteria->addJoin( EventLiveSchedulePeer::EVENT_LIVE_ID, EventLivePeer::ID, Criteria::INNER_JOIN );
		$criteria->addJoin( EventLivePeer::CLUB_ID, ClubPeer::ID, Criteria::INNER_JOIN );
		$criteria->addJoin( EventLivePeer::RANKING_LIVE_ID, RankingLivePeer::ID, Criteria::LEFT_JOIN );
		
		$criteria->addAscendingOrderByColumn( EventLivePeer::ENROLLMENT_START_DATE );
		$criteria->addAscendingOrderByColumn( EventLiveSchedulePeer::EVENT_DATE );
		$criteria->addAscendingOrderByColumn( EventLiveSchedulePeer::START_TIME );
		$criteria->addDescendingOrderByColumn( EventLivePeer::EVENT_DATE );
		$criteria->addAscendingOrderByColumn( EventLivePeer::START_TIME );
		
		return EventLiveSchedulePeer::doSelect($criteria);
	}
}
