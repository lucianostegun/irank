<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'event_live_view'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventLiveViewPeer extends BaseEventLiveViewPeer
{
	
	public static function search($criteria=null, $returnIds=false){
		
		$request = MyTools::getRequest();
		$clubId  = $request->getParameter('clubId');
		
		if( is_null($criteria) )
			$criteria = new Criteria();
			
		$criterion = $criteria->getNewCriterion( RankingLivePeer::ENABLED, true );
		$criterion->addAnd( $criteria->getNewCriterion( RankingLivePeer::VISIBLE, true ) );
		$criterion->addAnd( $criteria->getNewCriterion( RankingLivePeer::DELETED, false ) );
		
		$criterion2 = $criteria->getNewCriterion( EventLiveViewPeer::RANKING_LIVE_ID, NULL );
		$criterion->addOr($criterion2);
		$criteria->add($criterion);
		
		if( $clubId )
			$criteria->add( EventLiveViewPeer::CLUB_ID, $clubId );
		
		$criteria->addJoin( EventLiveViewPeer::CLUB_ID, ClubPeer::ID, Criteria::INNER_JOIN );
		$criteria->addJoin( EventLiveViewPeer::RANKING_LIVE_ID, RankingLivePeer::ID, Criteria::LEFT_JOIN );
//		$criteria->addJoin( EventLiveViewPeer::ID, EventLiveViewSchedulePeer::EVENT_LIVE_ID, Criteria::LEFT_JOIN );
		
		$criteria->addAscendingOrderByColumn( EventLiveViewPeer::ENROLLMENT_START_DATE );
		$criteria->addDescendingOrderByColumn( EventLiveViewPeer::EVENT_DATE );
		$criteria->addAscendingOrderByColumn( EventLiveViewPeer::START_TIME );
		
		if( $returnIds ){
			
			$eventLiveViewObjList = EventLiveViewPeer::doSelect($criteria);
			$eventLiveViewIdList = array();
			foreach($eventLiveViewObjList as $eventLiveViewObj)
				$eventLiveViewIdList[] = $eventLiveViewObj->getId();
			
			$eventLiveViewObjList = null;
			unset($eventLiveViewObjList);
			
			return $eventLiveViewIdList;
		}
		
		return EventLiveViewPeer::doSelect($criteria);
	}
}
