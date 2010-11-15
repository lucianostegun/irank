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
		
		if( !$criteria->isNoFilter() ){
			
			$userSiteId = MyTools::getAttribute('userSiteId');
			$criteria->addAnd( self::USER_SITE_ID, $userSiteId );
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
