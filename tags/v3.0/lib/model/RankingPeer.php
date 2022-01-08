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
		$app        = Util::getApp();

		$allowSearch     = false;
		$allowedPageList = array('event'=>array('facebookResultImage', 'share', 'facebookResult', 'getPhotoCommentList', 'resultShare', 'facebookResultShare'),
								 'ranking'=>array('share', 'requestSubscription'));
		
		if( array_key_exists($moduleName, $allowedPageList) && in_array($actionName, $allowedPageList[$moduleName]))
			$allowSearch = true;

		if(!$cron && !$allowSearch && $app!='ios'){
			
			if( !$criteria->isNoFilter() ){

				$criterion1 = $criteria->getNewCriterion( RankingPlayerPeer::PEOPLE_ID, $peopleId );
				$criterion1->addAnd( $criteria->getNewCriterion( RankingPlayerPeer::ENABLED, true ) );
				
				$criterion2 = $criteria->getNewCriterion( self::USER_SITE_ID, $userSiteId );
				
				$criterion3 = $criteria->getNewCriterion( self::IS_PRIVATE, false );
				
				$criterion2->addOr($criterion3);
				$criterion1->addOr($criterion2);
				$criteria->add($criterion1);
				
				$criteria->addAnd( self::DELETED, false );
			}else{
			
				$criterion = $criteria->getNewCriterion( RankingPlayerPeer::PEOPLE_ID, $peopleId );
				$criterion->addOr( $criteria->getNewCriterion( RankingPlayerPeer::PEOPLE_ID, null ) );
				$criteria->add($criterion);
			}
			
//			$criteria->addJoin( RankingPeer::ID, RankingPlayerPeer::RANKING_ID, Criteria::LEFT_JOIN );
		}
		
		$criteria->addJoin( RankingPeer::ID, RankingPlayerPeer::RANKING_ID, Criteria::LEFT_JOIN );
		
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
	
	public static function validateScoreSchema($scoreSchema){
		
		$scoreFormula = MyTools::getRequestParameter('scoreFormula');
		
		if( $scoreSchema!='custom' )
			return true;
		
		if( !$scoreFormula ){
			
			MyTools::setError('scoreFormula', __('form.error.requiredField'));
			return false;
		}
		
		return true;
	}
	
	public static function validateScoreFormula($formula){
		
		$scoreSchema = MyTools::getRequestParameter('scoreSchema');
		
		if( $scoreSchema!='custom' )
			return true;
		
		$position     = 1;
		$events       = 1;
		$prize        = 1;
		$players      = 1;
		$totalBuyins  = 1;
		$buyin        = 1;
		$itm          = 1;
		
		$formula = strtolower($formula);
		
		$formula = preg_replace('/posi[cç][aã]o|position/', '$position', $formula);
		$formula = preg_replace('/eventos|events/', '$events', $formula);
		$formula = preg_replace('/pr[eê]mio|prize/', '$prize', $formula);
		$formula = preg_replace('/jogadores|players/', '$players', $formula);
		$formula = preg_replace('/buyins/', '$totalBuyins', $formula);
		$formula = preg_replace('/buyin/', '$buyin', $formula);
		$formula = preg_replace('/itm/', '$itm', $formula);
		
		$formula = preg_replace('/raiz\(/', 'sqrt(', $formula);
		
		$formulaResult = null;
		
		@eval('$formulaResult = '.$formula.';');
		
		if( $formulaResult===null ){
			
			MyTools::setError('scoreFormula', __('ranking.invalidFormula'));
			return false;
		}
		
		return true;
	}
	
	public static function validateHasEvent($rankingId){
		
		$eventCount = Util::executeOne("SELECT COUNT(1) FROM event WHERE ranking_id = $rankingId AND visible AND enabled AND NOT deleted AND saved_result");
		
		return $eventCount > 0;
	}
	
	public static function checkRankingTag($rankingId){
		
		$rankingObj = RankingPeer::retrieveByPK($rankingId);
		return !is_null($rankingObj->getRankingTag());
	}
}
