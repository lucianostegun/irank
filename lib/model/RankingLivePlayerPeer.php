<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'ranking_live_player'.
 *
 * 
 *
 * @package lib.model
 */ 
class RankingLivePlayerPeer extends BaseRankingLivePlayerPeer
{
	
	public static function retrieveByPK($rankingLiveId, $peopleId, $con=null){
		
		$rankingLivePlayerObj = parent::retrieveByPK($rankingLiveId, $peopleId, $con);
		
		if( !is_object($rankingLivePlayerObj) ){
			
			$rankingLivePlayerObj = new RankingLivePlayer();
			$rankingLivePlayerObj->setRankingLiveId($rankingLiveId);
			$rankingLivePlayerObj->setPeopleId($peopleId);
		}
		
		return $rankingLivePlayerObj;
	}
}
