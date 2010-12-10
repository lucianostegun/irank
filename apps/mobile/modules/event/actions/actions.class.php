<?php

class eventActions extends sfActions
{

  public function preExecute(){
	
	$this->userSiteId = $this->getUser()->getAttribute('userSiteId');
	$this->peopleId   = $this->getUser()->getAttribute('peopleId');
  }

  public function executeIndex($request){

	$this->userSiteObj = UserSitePeer::retrieveByPK( $this->userSiteId );
	$this->criteria    = new Criteria();
  }
  
  public function executeEdit($request){
  	
  	$eventId       = $request->getParameter('eventId');
  	$this->isClone = $request->getParameter('isClone');
  	
  	if( $eventId ){
  		
		$this->eventObj = EventPeer::retrieveByPK( $eventId );

		if( !is_object($this->eventObj) )
			return $this->redirect('event/index');
		
		if( !$this->eventObj->isMyEvent() )
			$this->setTemplate('show');
  	}
  }
  
  public function executeShow($request){
  	
  	$eventId = $request->getParameter('eventId');
  	
  	if( $eventId ){
  		
		$this->eventObj = EventPeer::retrieveByPK( $eventId );

		if( !is_object($this->eventObj) )
			return $this->redirect('event/index');
  	}else{
		
		$this->eventObj = Util::getNewObject('event');
  	}
  }

  public function handleErrorSaveResult(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }
  
  public function executeSaveResult($request){

	$eventId  = $request->getParameter('eventId');
	$eventObj = EventPeer::retrieveByPK($eventId);
	
	if( !$eventObj->isEditable() )
		Util::forceError('!Este evento está bloqueado para edição', true);

	$rankingObj = $eventObj->getRanking();
	
	$paidPlaces = 0;
	
	$eventPlayerObjList = $eventObj->getPlayerList();
	foreach($eventPlayerObjList as $eventPlayerObj){
		
		$peopleId      = $eventPlayerObj->getPeopleId();
		$buyin         = $request->getParameter('buyin'.$peopleId);
		$rebuy         = $request->getParameter('rebuy'.$peopleId);
		$addon         = $request->getParameter('addon'.$peopleId);
		$eventPosition = $request->getParameter('eventPosition'.$peopleId);
		$prize    = $request->getParameter('prize'.$peopleId);
		
		$eventPlayerObj = EventPlayerPeer::retrieveByPK($eventId, $peopleId);
		$enabled        = $eventPlayerObj->getEnabled();
		
		if( !$enabled && $eventPosition > 0 ){
			
			$eventObj->addPlayer($peopleId, true, false);
			$enabled = true;
		}
		
		if( $enabled ){
			
			if( $prize > 0 )
				$paidPlaces++;

			$eventPlayerObj->setEventPosition($eventPosition);
			$eventPlayerObj->setPrize( Util::formatFloat($prize) );
			$eventPlayerObj->setRebuy( Util::formatFloat($rebuy) );
			$eventPlayerObj->setAddon( Util::formatFloat($addon) );
			$eventPlayerObj->setBuyin( Util::formatFloat($buyin) );
			$eventPlayerObj->save();
		}
	}
	
	$eventObj->setPaidPlaces($paidPlaces);
	$eventObj->setSavedResult(true);
	$eventObj->save();
	
	$rankingObj->updateScores();
	$rankingObj->updatePlayerEvents();
	$rankingObj->updateHistory($eventObj->getEventDate('d/m/Y'));
	
	$eventObj->notifyResult();
	
	exit;
  }
  
  public function executeJavascript($request){
  	
    header('Content-type: text/x-javascript');
		
  	$nl = chr(10);
  }
}
