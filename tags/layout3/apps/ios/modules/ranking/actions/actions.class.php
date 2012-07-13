<?php

/**
 * ranking actions.
 *
 * @package    sf_sandbox
 * @subpackage ranking
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class rankingActions extends sfActions
{
	
  public function preExecute(){
  	
	$userSiteId = $this->getRequestParameter('userSiteId');
  	$language   = $this->getRequestParameter('language');
	
	$this->userSiteObj = UserSitePeer::retrieveByPK($userSiteId);
	
  	$culture = Util::getConvertCulture($language);
  	
  	MyTools::setCulture($culture);
	
	if( is_object($this->userSiteObj) )
		$this->getUser()->setAttribute('peopleId', $this->userSiteObj->getPeopleId());
		
	$this->getUser()->setAttribute('userSiteId', $userSiteId);
  }
  
  public function executeSavePlayer($request){
  	
  	$rankingId = $request->getParameter('rankingId');
  	$eventId   = $request->getParameter('eventId');
  	$xmlString = $request->getParameter('playerXml');

//	$file = fopen(Util::getFilePath('/xml.xml'), 'w');
//	fwrite($file, $xmlString);
//	fclose($file);
//	$xmlString = file_get_contents(Util::getFilePath('/xml.xml'));

	$xmlString = simplexml_load_string( $xmlString );
	
	$validate = new DOMDocument;
    $validate->loadXML($xmlString->asXml());
    
    $firstName    = null;
    $lastName     = null;
    $emailAddress = null;
    
	foreach( $xmlString->player as $playerNode ){
		
		foreach( $playerNode as $key=>$nodeValue )
			$$key = (string)$nodeValue;
	}

	$rankingObj = RankingPeer::retrieveByPK($rankingId);

	$peopleObj = PeoplePeer::retrieveByEmailAddress($emailAddress);
	
	if( !is_object($peopleObj) ){
		
		$peopleObj = People::getQuickPeople($firstName, $lastName, 'rankingPlayer');
		
		$peopleObj->setEmailAddress($emailAddress);
		$peopleObj->save();
		
		$infoList = $peopleObj->getInfo();
	}else{
		
		$infoList = $peopleObj->getInfo();
	}
	
	$rankingObj->addPlayer( $peopleObj->getId() );
	$rankingObj->addToOpenEvents($peopleObj->getId());
	
	if( $eventId ){
		
		$eventObj = EventPeer::retrieveByPK($eventId);
		$eventObj->importPlayers();
	}
	
	$infoList['saveStatus'] = 'saveSuccess';
	
	echo Util::parseInfo($infoList);
	exit;
  }
	
  /**
   * Executes index action
   *
   */
  public function executeGetXml($request){
  	
  	$userSiteId  = $request->getParameter('userSiteId');
  	$model       = $request->getParameter('model');
  	$deviceUDID  = $request->hasParameter('deviceUDID');
  	$userSiteObj = $this->userSiteObj;
	
	switch( $model ){
		case 'list':
			
			$rankingList = array();
			
			
			foreach($userSiteObj->getRankingList() as $rankingObj){
				
				$rankingNode = array();
				
				$rankingNode['@attributes']  = array('id'=>$rankingObj->getId(), 'gameStyleId'=>$rankingObj->getGameStyleId(), 'rankingTypeId'=>$rankingObj->getRankingTypeId(), 'events'=>$rankingObj->getEvents(), 'players'=>$rankingObj->getPlayers());
				$rankingNode['rankingName']  = $rankingObj->getRankingName();
				$rankingNode['credit']       = $rankingObj->getCredit();
				$rankingNode['gameStyle']    = $rankingObj->getGameStyle()->getDescription();
				$rankingNode['startDate']    = $rankingObj->getStartDate('d/m/Y');
				$rankingNode['finishDate']   = $rankingObj->getFinishDate('d/m/Y');
				$rankingNode['isPrivate']    = $rankingObj->getIsPrivate()?'true':'false';
				$rankingNode['rankingType']  = $rankingObj->getRankingType()->getDescription();
				
				$buyinTagName = ($deviceUDID?'buyin':'defaultBuyin');
				$rankingNode[$buyinTagName]  = $rankingObj->getBuyin();
				$rankingNode['isMyRanking']  = $rankingObj->isMyRanking();
				
				$rankingList[] = $rankingNode;
			}
			
			echo Ranking::getXml($rankingList);
			break;
		case 'rankingPlayer':

			$rankingId  = $request->getParameter('rankingId');
			$rankingObj = RankingPeer::retrieveByPK($rankingId);
						
			$rankingPlayerList = array();
			
			foreach($rankingObj->getClassify(null) as $key=>$rankingPlayerObj){
				
				$peopleObj       = $rankingPlayerObj->getPeople();
				$rankingPosition = $key+1;
				
				$rankingPlayerNode = array();
				
				$rankingPlayerNode['@attributes']  = array('playerId'=>$rankingPlayerObj->getPeopleId(), 'rankingId'=>$rankingPlayerObj->getRankingId(), 'rankingPosition'=>$rankingPosition);
				$rankingPlayerNode['firstName']    = $peopleObj->getFirstName();
				$rankingPlayerNode['lastName']     = $peopleObj->getLastName();
				$rankingPlayerNode['emailAddress'] = $peopleObj->getEmailAddress();
				$rankingPlayerNode['totalEvents']  = $rankingPlayerObj->getTotalEvents();
				$rankingPlayerNode['totalScore']   = $rankingPlayerObj->getTotalScore();
				$rankingPlayerNode['totalPaid']    = $rankingPlayerObj->getTotalPaid();
				$rankingPlayerNode['totalPrize']   = $rankingPlayerObj->getTotalPrize();
				$rankingPlayerNode['totalBalance'] = $rankingPlayerObj->getTotalBalance();
				$rankingPlayerNode['totalAverage'] = $rankingPlayerObj->getTotalAverage();
				
				$rankingPlayerList[$peopleObj->getFullName()] = $rankingPlayerNode;
			}
			
			ksort($rankingPlayerList);
			
			echo RankingPlayer::getXml($rankingPlayerList);
			break;
	}
	exit;
  }
}
