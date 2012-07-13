<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'club_ranking_live'.
 *
 * 
 *
 * @package lib.model
 */ 
class ClubRankingLivePeer extends BaseClubRankingLivePeer
{
	
	public static function retrieveByPK($clubId, $rankingLiveId, $con=null){
		
		$clubRankingLiveObj = parent::retrieveByPK($clubId, $rankingLiveId, $con);
		
		if( !is_object($clubRankingLiveObj) ){
			
			$clubRankingLiveObj = new ClubRankingLive();
			$clubRankingLiveObj->setClubId($clubId);
			$clubRankingLiveObj->setRankingLiveId($rankingLiveId);
		}
		
		return $clubRankingLiveObj;
	}
}
