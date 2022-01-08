<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'ranking_prize_split'.
 *
 * 
 *
 * @package lib.model
 */ 
class RankingPrizeSplitPeer extends BaseRankingPrizeSplitPeer
{
	
	public static function validatePrizeSplit($option){
		
		Util::getHelper('I18N');
		
		$rankingId = MyTools::getRequestParameter('rankingId');
		
		if( !$rankingId )
			return true;

		$rankingObj = RankingPeer::retrieveByPK($rankingId);
		
		foreach($rankingObj->getPrizeSplitList() as $rankingPrizeSplitObj){
			
			$paidPlaces  = $rankingPrizeSplitObj->getPaidPlaces();
			$buyins      = MyTools::getRequestParameter('buyins'.$paidPlaces);
			$percentList = MyTools::getRequestParameter('percentList'.$paidPlaces);
			
			if( !is_numeric($buyins) )
				MyTools::setError('splitPrizeBuyins'.$paidPlaces, 'erro');
			
			if( !preg_match('/^[0-9]+%?([,;] ?[0-9]+%?)*$/', $percentList) )
				MyTools::setError('splitPrizePercentList'.$paidPlaces, 'erro');
		}

		return !MyTools::getRequest()->hasErrors();
	}
}
