<?php

/**
 * eventLive actions.
 *
 * @package    sf_sandbox
 * @subpackage eventLive
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class eventLiveActions extends sfActions
{
	
  public function preExecute(){
  	
	$this->userSiteId  = $this->getRequestParameter('userSiteId');
	$this->eventLiveId = $this->getRequestParameter('id');
	$this->eventLiveId = $this->getRequestParameter('eventLiveId', $this->eventLiveId);
	
	$this->peopleId = null;
	
	if( $this->userSiteId )
		$this->peopleId = Util::executeOne("SELECT people_id FROM user_site WHERE id = $this->userSiteId");
		
	if( $this->peopleId )
		$this->getUser()->setAttribute('peopleId', $this->peopleId);
		
	$this->getUser()->setAttribute('userSiteId', $this->userSiteId);
  }

  public function executeTogglePresence($request){
  	
  	$inviteStatus  = $request->getParameter('inviteStatus');
  	$errorMessage  = null;
  	
  	$eventLiveObj = EventLivePeer::retrieveByPK($this->eventLiveId);
  	$players      = $eventLiveObj->getPlayers(false, false);
  	
  	if( is_object($eventLiveObj) ){

	  	if( $eventLiveObj->isPastDate() ){
	  		
	  		$errorMessage = 'Este evento já foi realizado.';
	  	}elseif( !$eventLiveObj->isEnrollmentOpen() ){
	  		
	  		$errorMessage = 'As inscrições deste evento iniciam apenas em '.$eventLiveObj->getEnrollmentStartDate('d/m/Y').'.';
	  	}else{
	  		
	  		$eventLivePlayerObj = EventLivePlayerPeer::retrieveByPK($this->eventLiveId, $this->peopleId);
	  		
	  		if( $inviteStatus )
	  			$eventLivePlayerObj->confirmPresence();
	  		else
	  			$eventLivePlayerObj->declinePresence();
	  			
	  		$players = Util::executeOne("SELECT players FROM event_live WHERE id = {$this->eventLiveId}");
	  	}
  	}else{

  		$errorMessage = 'Evento não encontrado.';
  	}
  	
  	if( $errorMessage )
  		Util::forceError($errorMessage);
  	else
  		echo $players;
  		
  	exit;
  }
  
  /**
   * Executes index action
   *
   */
  public function executeGetXml($request){
  	
  	$clubId      = $request->getParameter('clubId');
  	$model       = $request->getParameter('model');
  	$limit       = $request->getParameter('limit', null);
  	$userSiteObj = $this->userSiteObj;
  	
  	$host = $request->getHost();
  	
	switch( $model ){
		case 'nextEvents':
  			$clubObj = ClubPeer::retrieveByPK($clubId);
  			
  			$criteria = new Criteria();
			$criteria->add( EventLiveViewPeer::EVENT_DATE, date('Y-m-d'), Criteria::GREATER_EQUAL );
			$criteria->setLimit($limit);
		
			$eventList = array();
			foreach($clubObj->getSchedule($criteria) as $eventLiveObj){
				
				$eventNode = array();
				
				$description = $eventLiveObj->getDescription();
				$description = strip_tags($description);
				
				$eventNode['@attributes']   = array('id'=>$eventLiveObj->getId(), 'inviteStatus'=>$eventLiveObj->getPlayerStatus($this->peopleId, true));
				$eventNode['eventName']     = $eventLiveObj->toString();
				$eventNode['eventDate']     = $eventLiveObj->getEventDate('d/m/Y');
				$eventNode['weekDay']       = $eventLiveObj->getWeekDay();
				$eventNode['description']   = $description;
				$eventNode['startTime']     = $eventLiveObj->getStartTime('H:i');
				$eventNode['rankingName']   = $eventLiveObj->getRankingLive()->getRankingName();
				$eventNode['buyin']         = $eventLiveObj->getBuyin();
				$eventNode['entranceFee']   = $eventLiveObj->getEntranceFee();
				$eventNode['stackChips']    = $eventLiveObj->getStackChips(true);
				$eventNode['blindTime']     = $eventLiveObj->getBlindTime('H:i');
				$eventNode['players']       = $eventLiveObj->getPlayers();
				$eventNode['gameStyle']     = $eventLiveObj->getGameStyle()->getDescription();
				$eventNode['gameType']      = $eventLiveObj->getGameType()->getDescription();
				$eventNode['savedResult']   = $eventLiveObj->getSavedResult()?'true':'false';
				$eventNode['isFreeroll']    = $eventLiveObj->getIsFreeroll()?'true':'false';
				$eventNode['isPastDate']    = $eventLiveObj->isPastDate()?'true':'false';
				$eventNode['allowedRebuys'] = $eventLiveObj->getAllowedRebuys()?'true':'false';
				$eventNode['allowedAddons'] = $eventLiveObj->getAllowedAddons()?'true':'false';
				$eventNode['logoUrl']       = 'http://'.$host.'/images/'.$eventLiveObj->getFileNameLogo();
				
				$eventList[] = $eventNode;
			}
			
			echo EventLive::getXml($eventList);
			break;
	}
	exit;
  }
}
