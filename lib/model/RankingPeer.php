<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'ranking'.
 *
 * 
 *
 * @package lib.model
 */ 
class RankingPeer extends BaseRankingPeer
{
	
	public static function doSelectRS(Criteria $criteria, $con = null){
		
		$userSiteId = MyTools::getAttribute('userSiteId');
		$peopleId   = MyTools::getAttribute('peopleId');
		$cron       = MyTools::getAttribute('cron');
		
		if(!$cron){
			
			if( !$criteria->isNoFilter() ){
	
				$criterion = $criteria->getNewCriterion( RankingPlayerPeer::PEOPLE_ID, $peopleId );
				$criterion->addOr( $criteria->getNewCriterion( self::USER_SITE_ID, $userSiteId ) );
				$criteria->add($criterion);
				
				$criteria->addAnd( self::DELETED, false );
			}else{
			
				$criteria->add( RankingPlayerPeer::PEOPLE_ID, $peopleId );
			}
			
			$criteria->addJoin( RankingPeer::ID, RankingPlayerPeer::RANKING_ID, Criteria::INNER_JOIN );
		}
		
		return parent::doSelectRS($criteria, $con);
	}
    
	public static function uniqueRankingName( $rankingName ){

		$rankingId  = MyTools::getRequestParameter('rankingId');
		$userSiteId = MyTools::getAttribute('userSiteId');
		
		$criteria = new Criteria();
		$criteria->add( RankingPeer::VISIBLE, true );
		$criteria->add( RankingPeer::ENABLED, true );
		$criteria->add( RankingPeer::DELETED, false );
		$criteria->add( RankingPeer::USER_SITE_ID, $userSiteId );
		$criteria->add( RankingPeer::ID, $rankingId, Criteria::NOT_EQUAL );
		$criteria->add( RankingPeer::RANKING_NAME, $rankingName, Criteria::ILIKE );
		$rankingObj = RankingPeer::doSelectOne( $criteria );
		
		return !is_object( $rankingObj );
	}
}