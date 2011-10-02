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
		
		$moduleName = MyTools::getContext()->getModuleName();
		$actionName = MyTools::getContext()->getActionName();
		
		$allowSearch     = false;
		$allowedPageList = array('event'=>array('facebookResultImage'));
		
		if( array_key_exists($moduleName, $allowedPageList) && in_array($actionName, $allowedPageList[$moduleName]))
			$allowSearch = true;

		if(!$cron && !$allowSearch){
			
			if( !$criteria->isNoFilter() ){

				$criterion = $criteria->getNewCriterion( RankingPlayerPeer::PEOPLE_ID, $peopleId );
				$criterion->addOr( $criteria->getNewCriterion( self::USER_SITE_ID, $userSiteId ) );
				$criteria->add($criterion);
				
				$criteria->addAnd( self::DELETED, false );
			}else{
			
				$criterion = $criteria->getNewCriterion( RankingPlayerPeer::PEOPLE_ID, $peopleId );
				$criterion->addOr( $criteria->getNewCriterion( RankingPlayerPeer::PEOPLE_ID, null ) );
				$criteria->add($criterion);
			}
			
			$criteria->addJoin( RankingPeer::ID, RankingPlayerPeer::RANKING_ID, Criteria::LEFT_JOIN );
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
    
	public static function uniqueRankingTag( $rankingTag ){

		$rankingId  = MyTools::getRequestParameter('rankingId');
		
		$criteria = new Criteria();
		$criteria->add( RankingPeer::VISIBLE, true );
		$criteria->add( RankingPeer::ENABLED, true );
		$criteria->add( RankingPeer::DELETED, false );
		$criteria->add( RankingPeer::ID, $rankingId, Criteria::NOT_EQUAL );
		$criteria->add( RankingPeer::RANKING_TAG, $rankingTag, Criteria::ILIKE );
		$rankingObj = RankingPeer::doSelectOne( $criteria );
		
		return !is_object( $rankingObj );
	}
	
	public static function validateImport($rankingIdImport){

		$rankingId = MyTools::getRequestParameter('rankingId');

		return ($rankingIdImport!=$rankingId);
	}
}
