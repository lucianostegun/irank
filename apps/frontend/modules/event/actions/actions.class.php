<?php

class eventActions extends sfActions
{

  public function preExecute(){
	
	$this->userSiteId = $this->getUser()->getAttribute('userSiteId');
	$this->peopleId   = $this->getUser()->getAttribute('peopleId');
  }

  public function executeIndex($request){

	$this->userSiteObj = UserSitePeer::retrieveByPK( $this->userSiteId );
  }
  
  public function executeNew($request){

	return $this->forward('event', 'edit');
  }
  
  public function executeEdit($request){
  	
  	$eventId = $request->getParameter('eventId');
  	
  	if( $eventId ){
  		
		$this->eventObj = EventPeer::retrieveByPK( $eventId );
		
		if( !$this->eventObj->isMyEvent() )
			$this->setTemplate('show');
  	}else{
		
		$this->eventObj = Util::getNewObject('event');
  	}
  }
  
  public function executeShow($request){
  	
  	$eventId = $request->getParameter('eventId');
  	
  	if( $eventId ){
  		
		$this->eventObj = EventPeer::retrieveByPK( $eventId );
  	}else{
		
		$this->eventObj = Util::getNewObject('event');
  	}
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }
  
  public function executeSave($request){

	$eventId         = $request->getParameter('eventId');
	$rankingId       = $request->getParameter('rankingId');
	$gameStyleId     = $request->getParameter('gameStyleId');
	$eventName       = $request->getParameter('eventName');
	$eventPlace      = $request->getParameter('eventPlace');
	$eventDate       = $request->getParameter('eventDate');
	$startTime       = $request->getParameter('startTime');
	$paidPlaces      = $request->getParameter('paidPlaces');
	$buyIn           = $request->getParameter('buyIn');
	$comments        = $request->getParameter('comments');
	$sendEmail       = $request->getParameter('sendEmail');
	$confirmPresence = $request->getParameter('confirmPresence');

	$eventObj = EventPeer::retrieveByPK( $eventId );
	
	$firstSave = !$eventObj->getEnabled();

	$eventObj->setRankingId( $rankingId );
	$eventObj->setGameStyleId( $gameStyleId );
	$eventObj->setEventName( $eventName );
	$eventObj->setEventPlace( $eventPlace );
	$eventObj->setEventDate( Util::formatDate($eventDate) );
	$eventObj->setStartTime( $startTime );
	$eventObj->setPaidPlaces( ($paidPlaces?$paidPlaces:null) );
	$eventObj->setBuyIn( Util::formatFloat($buyIn) );
	$eventObj->setComments( ($comments?$comments:null) );
	$eventObj->setSentEmail( ($sendEmail || $eventObj->getSentEmail()?true:false) );
	$eventObj->setVisible(true);
	$eventObj->setEnabled(true);
	$eventObj->save();
	
	$rankingObj = $eventObj->getRanking();
	
	if( $firstSave ){
		
		$rankingObj->setEvents($rankingObj->getEvents()+1);
		$rankingObj->save();
	}
	
	$eventObj->importMembers();

	if( $confirmPresence )
		$eventObj->addMember( $rankingObj->getUserSite()->getPeopleId(), true );

	
    sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
	return $this->renderText(get_partial('event/include/member', array('eventObj'=>$eventObj)));
  }
  
  public function executeAddMember($request){

	$eventId  = $request->getParameter('eventId');
	
	$userSiteObj = UserSitePeer::retrieveByPK( $this->userSiteId );
	$eventObj    = EventPeer::retrieveByPK( $eventId );
	
	$eventObj->addMember( $userSiteObj->getPeopleId(), true );
    
    return $this->forward('event', 'getMemberList');
  }
  
  public function executeDeleteMember($request){

	$eventId  = $request->getParameter('eventId');
	
	$userSiteObj = UserSitePeer::retrieveByPK( $this->userSiteId );
	$eventObj    = EventPeer::retrieveByPK( $eventId );

	$eventObj = EventPeer::retrieveByPK( $eventId );
	$eventObj->deleteMember( $userSiteObj->getPeopleId() );
    
    return $this->forward('event', 'getMemberList');
  }
  
  public function executeTogglePresence($request){

	$eventId  = $request->getParameter('eventId');
	$peopleId = $request->getParameter('peopleId');
	
	$eventObj = EventPeer::retrieveByPK( $eventId );
	
	if( !$eventObj->isConfirmed($peopleId) )
		$eventObj->addMember( $peopleId, true );
	else
		$eventObj->deleteMember( $peopleId );
    
    exit;
  }

  public function executeGetMemberList($request){

	$eventId  = $request->getParameter('eventId');
	$eventObj = EventPeer::retrieveByPK( $eventId );

  	sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
	return $this->renderText(get_partial('event/include/member', array('eventObj'=>$eventObj)));
  }

  public function handleErrorSaveResult(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }
  
  public function executeSaveResult($request){

	$eventId = $request->getParameter('eventId');

	$eventObj   = EventPeer::retrieveByPK($eventId);
	$rankingObj = $eventObj->getRanking();
	$buyIn      = $eventObj->getBuyIn();
	
	$eventMemberObjList = $eventObj->getMemberList();
	foreach($eventMemberObjList as $eventMemberObj){
		
		$peopleId      = $eventMemberObj->getPeopleId();
		$rebuy         = $request->getParameter('rebuys'.$peopleId);
		$addon         = $request->getParameter('addons'.$peopleId);
		$eventPosition = $request->getParameter('eventPosition'.$peopleId);
		$prizeValue    = $request->getParameter('prizeValue'.$peopleId);
		
		$eventMemberObj = EventMemberPeer::retrieveByPK($eventId, $peopleId);
		$enabled        = $eventMemberObj->getEnabled();
		
		if( !$enabled && $eventPosition > 0 ){
			
			$eventObj->addMember($peopleId, true);
			$enabled = true;
		}
		
		if( $enabled ){
			
			$eventMemberObj->setEventPosition($eventPosition);
			$eventMemberObj->setPrizeValue( Util::formatFloat($prizeValue) );
			$eventMemberObj->setRebuys($rebuy);
			$eventMemberObj->setAddons($addon);
			$eventMemberObj->setBuyIn($buyIn);
			$eventMemberObj->save();
			
			$rankingObj->updateScore($peopleId);
		}
	}
	
	exit;
  }
  
  public function executeJavascript($request){
  	
  }
}
