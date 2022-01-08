<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'ranking_place'.
 *
 * 
 *
 * @package lib.model
 */ 
class RankingPlacePeer extends BaseRankingPlacePeer
{
    
	public static function uniquePlaceName( $placeName ){

		$rankingId      = MyTools::getRequestParameter('rankingId');
		$rankingPlaceId = MyTools::getRequestParameter('rankingPlaceId');
		
		$criteria = new Criteria();
		$criteria->add( RankingPlacePeer::DELETED, false );
		$criteria->add( RankingPlacePeer::RANKING_ID, $rankingId );
		$criteria->add( RankingPlacePeer::ID, $rankingPlaceId, Criteria::NOT_EQUAL );
		$criteria->add( RankingPlacePeer::PLACE_NAME, $placeName, Criteria::ILIKE );
		$rankingPlaceObj = RankingPlacePeer::doSelectOne( $criteria );
		
		return !is_object( $rankingPlaceObj );
	}
}
