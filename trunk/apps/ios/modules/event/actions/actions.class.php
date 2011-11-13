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
	
  public function preExecute(){
  	
	$userSiteId = $this->getRequestParameter('userSiteId');
	
	$this->userSiteObj = UserSitePeer::retrieveByPK($userSiteId);
	
	MyTools::setCulture('pt_BR');
	
	if( is_object($this->userSiteObj) )
		$this->getUser()->setAttribute('peopleId', $this->userSiteObj->getPeopleId());
		
	$this->getUser()->setAttribute('userSiteId', $userSiteId);
  }
  
  public function executeComments($request){
  	
  	$this->eventId = $request->getParameter('eventId');

	$criteria = new Criteria();

	sfConfig::set('sf_web_debug', false);
  }
  
  public function executeSaveComment($request){

	$eventId    = $request->getParameter('eventId');
	$userSiteId = $request->getParameter('userSiteId');
	$comment    = $request->getParameter('comment');
	$comment    = urldecode($comment);

	$comment = (strlen($comment)>140?substr($comment, 0, 140):$comment);

	$userSiteObj = $this->userSiteObj;

	$eventCommentObj = new EventComment();
	$eventCommentObj->setPeopleId( $userSiteObj->getPeopleId() );
	$eventCommentObj->setEventId( $eventId );
	$eventCommentObj->setComment( $comment );
	$eventCommentObj->save();
	
	$eventCommentObj->notify();
	
	echo 'ok';
	
	exit;
  }
  
  public function executeUpdateInviteStatus($request){
  	
  	$userSiteId   = $request->getParameter('userSiteId');
  	$eventId      = $request->getParameter('eventId');
  	$inviteStatus = $request->getParameter('inviteStatus');
  	$userSiteObj  = $this->userSiteObj;
  	
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
  
  public function executeTogglePresence($request){

	Util::getHelper('I18N');
	
	$eventId    = $request->getParameter('eventId');
	$peopleId   = $request->getParameter('peopleId');
	$choice     = $request->getParameter('choice');
	
	$eventObj = EventPeer::retrieveByPK( $eventId );
	
	$notify = (!$eventObj->isPastDate());
	
	if( $choice=='yes' && !$eventObj->isConfirmed($peopleId) )
		$eventObj->togglePresence($peopleId, 'yes', $notify);
	else
		$eventObj->togglePresence($peopleId, 'no', $notify);
    
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
  	$userSiteObj = $this->userSiteObj;
	
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
				$eventNode['isMyEvent']    = $eventObj->isMyEvent()?'true':'false';
				$eventNode['isPastDate']   = $eventObj->isPastDate()?'true':'false';
				$eventNode['gameStyle']    = $eventObj->getRanking()->getGameStyle()->getTagName();
				
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
				$eventNode['@attributes']  = array('playerId'=>$peopleObj->getId(), 'eventId'=>$eventPlayerObj->getEventId());
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
