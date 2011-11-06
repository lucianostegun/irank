<?php

/**
 * event actions.
 *
 * @package    sf_sandbox
 * @subpackage event
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class eventActions extends sfActions
{
  
  public function executeUpdateInviteStatus($request){
  	
  	$userSiteId   = $request->getParameter('userSiteId');
  	$eventId      = $request->getParameter('eventId');
  	$inviteStatus = $request->getParameter('inviteStatus');
  	$userSiteObj  = UserSitePeer::retrieveByPK($userSiteId);
  	
	$eventObj = EventPeer::retrieveByPK( $eventId );
	
  	try{
  		
  		MyTools::setAttribute('peopleId', $userSiteObj->getPeopleId());
  		MyTools::setCulture('pt_BR');
  		$eventObj->togglePresence( $userSiteObj->getPeopleId(), $inviteStatus );
  		echo $inviteStatus;	
  	}catch(Exception $e){
  	
  		echo 'error';
  	}
  	
  	exit;
  }
  
  /**
   * Executes index action
   *
   */
  public function executeGetXml($request){
  	
  	$userSiteId  = $request->getParameter('userSiteId');
  	$eventId     = $request->getParameter('eventId');
  	$model       = $request->getParameter('model');
  	$userSiteObj = UserSitePeer::retrieveByPK($userSiteId);
	
	switch( $model ){
		case 'nextEvents':
		case 'previousEvents':
			$criteria = new Criteria();
			$criteria->setNoFilter(true);
		
  			$limit = $request->getParameter('limit');
  			
			switch($model){
				case 'nextEvents':
				$eventObjList = Event::getNextList($criteria, $limit, $userSiteId);
				break;
				case 'previousEvents':
				$eventObjList = Event::getPreviousList($criteria, $limit, $userSiteId);
				break;
			}
		
			$eventList = array();
			foreach($eventObjList as $eventObj){
				
				$eventNode = array();
				
				$eventNode['@attributes']  = array('id'=>$eventObj->getId(), 'rankingId'=>$eventObj->getRankingId());
				$eventNode['eventName']    = $eventObj->getEventName();
				$eventNode['eventDate']    = $eventObj->getEventDate('d/m/Y');
				$eventNode['startTime']    = $eventObj->getStartTime('H:i');
				$eventNode['rankingName']  = $eventObj->getRanking()->getRankingName();
				$eventNode['eventPlace']   = $eventObj->getRankingPlace()->getPlaceName();
				$eventNode['paidPlaces']   = $eventObj->getPaidPlaces();
				$eventNode['entranceFee']  = $eventObj->getEntranceFee();
				$eventNode['buyin']        = $eventObj->getBuyin();
				$eventNode['savedResult']  = $eventObj->getSavedResult()?'true':'false';
				$eventNode['comments']     = $eventObj->getComments();
				$eventNode['inviteStatus'] = $eventObj->getInviteStatus($userSiteObj->getPeopleId());
				
				$eventList[] = $eventNode;
			}
			
			echo Event::getXml($eventList);
			break;
		case 'eventPlayer':

			$eventObj = EventPeer::retrieveByPK($eventId);
			
			$eventPlayerList = array();
			foreach($eventObj->getEventPlayerList() as $eventPlayerObj){
				
				$peopleObj = $eventPlayerObj->getPeople();
				
				$eventNode = array();
				$eventNode['@attributes']  = array('playerId'=>$peopleObj->getId());
				$eventNode['enabled']      = ($eventPlayerObj->getEnabled()?'true':'false');
				$eventNode['inviteStatus'] = $eventPlayerObj->getInviteStatus();
				$eventNode['player']       = array('firstName'=>$peopleObj->getFirstName(), 'lastName'=>$peopleObj->getLastName(), 'emailAddress'=>$peopleObj->getEmailAddress());
				
				$eventPlayerList[] = $eventNode;
			}
			
			echo EventPlayer::getXml($eventPlayerList);
			break;
	}
	exit;
  }
}
