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
  
  public function executeNew($request){

	return $this->forward('event', 'edit');
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
  	}else{
		
		$this->eventObj = Util::getNewObject('event');
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

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }
  
  public function executeSave($request){

	$eventId         = $request->getParameter('eventId');
	$rankingId       = $request->getParameter('rankingId');
	$eventName       = $request->getParameter('eventName');
	$eventPlace      = $request->getParameter('eventPlace');
	$eventDate       = $request->getParameter('eventDate');
	$startTime       = $request->getParameter('startTime');
	$paidPlaces      = $request->getParameter('paidPlaces');
	$buyin           = $request->getParameter('buyin');
	$comments        = $request->getParameter('comments');
	$confirmPresence = $request->getParameter('confirmPresence');

	$eventObj = EventPeer::retrieveByPK( $eventId );
	
	if( !$eventObj->isEditable() )
		Util::forceError('!Este evento está bloqueado para edição', true);
	
	$firstSave = !$eventObj->getEnabled();

	$eventObj->setRankingId( $rankingId );
	$eventObj->setEventName( $eventName );
	$eventObj->setEventPlace( $eventPlace );
	$eventObj->setEventDate( Util::formatDate($eventDate) );
	$eventObj->setStartTime( $startTime );
	$eventObj->setPaidPlaces( ($paidPlaces?$paidPlaces:null) );
	$eventObj->setBuyin( Util::formatFloat($buyin) );
	$eventObj->setComments( ($comments?$comments:null) );
	$eventObj->setVisible(true);
	$eventObj->setEnabled(true);
	$eventObj->save();
	
	$rankingObj = $eventObj->getRanking();
	
	if( $firstSave ){
		
		$rankingObj->setEvents($rankingObj->getEvents()+1);
		$rankingObj->save();
	}
	
	$eventObj->importPlayers();

	if( $confirmPresence )
		$eventObj->addPlayer( $rankingObj->getUserSite()->getPeopleId(), true );

	$eventObj->notify();

    echo Util::parseInfo($eventObj->getInfo());
    exit;
  }
  
  public function executeDelete($request){

	$eventId  = $request->getParameter('eventId');
	$eventObj = EventPeer::retrieveByPK( $eventId );
	
	if( !is_object($eventObj) )
		throw new Exception('Evento não encontrado!');
	
	if( !$eventObj->isEditable() )
		Util::forceError('!Este evento está bloqueado para exclusão', true);
	
	$eventObj->delete();
	exit;
  }
  
  public function executeAddPlayer($request){

	$eventId  = $request->getParameter('eventId');
	
	$userSiteObj = UserSitePeer::retrieveByPK( $this->userSiteId );
	$eventObj    = EventPeer::retrieveByPK( $eventId );
	
	$eventObj->addPlayer( $userSiteObj->getPeopleId(), true );
    
    return $this->forward('event', 'getPlayerList');
  }
  
  public function executeDeletePlayer($request){

	$eventId = $request->getParameter('eventId');
	
	$userSiteObj = UserSitePeer::retrieveByPK( $this->userSiteId );
	$eventObj    = EventPeer::retrieveByPK( $eventId );
	
	if( !$eventObj->isEditable() )
		Util::forceError('!Este evento está bloqueado para edição', true);

	$eventObj->deletePlayer( $userSiteObj->getPeopleId() );
    
    return $this->forward('event', 'getPlayerList');
  }

  public function executeRemovePlayer($request){

	$eventId  = $request->getParameter('eventId');
	$peopleId = $request->getParameter('peopleId');
	
	$userSiteObj = UserSitePeer::retrieveByPK( $this->userSiteId );
	$eventObj    = EventPeer::retrieveByPK( $eventId );
	
	if( !$eventObj->isEditable() )
		Util::forceError('!Este evento está bloqueado para edição', true);

	$eventObj->removePlayer( $peopleId );
    
    return $this->forward('event', 'getPlayerList');
  }
  
  public function executeTogglePresence($request){

	$eventId  = $request->getParameter('eventId');
	$peopleId = $request->getParameter('peopleId');
	
	$eventObj = EventPeer::retrieveByPK( $eventId );
	
	if( !$eventObj->isEditable() )
		Util::forceError('!Este evento está bloqueado para edição', true);
	
	if( !$eventObj->isConfirmed($peopleId) )
		$eventObj->addPlayer( $peopleId, true );
	else
		$eventObj->deletePlayer( $peopleId );
    
    exit;
  }

  public function executeGetPlayerList($request){

	$eventId  = $request->getParameter('eventId');
	$eventObj = EventPeer::retrieveByPK( $eventId );

  	sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
	return $this->renderText(get_partial('event/include/player', array('eventObj'=>$eventObj)));
  }

  public function handleErrorSaveResult(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }
  
  public function executeCloneEvent($request){
  	
  	$eventId = $request->getParameter('eventId');
  	
	$eventObj = EventPeer::retrieveByPK( $eventId );
	$eventObj = $eventObj->getClone();
	
	$request->setParameter('eventId', $eventObj->getId());
	$request->setParameter('isClone', true);
	return $this->forward('event', 'edit');
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
			
			$eventObj->addPlayer($peopleId, true);
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
	$rankingObj->updateHistory($eventObj->getEventDate('d/m/Y'));
	
	$eventObj->notifyResult();
	
	exit;
  }  
  
  public function executeSearch($request){
  	
  	$renderize  = $request->getParameter('isIE');
  	$eventName  = $request->getParameter('eventName');
  	$eventPlace = $request->getParameter('eventPlace');
  	$eventDate  = $request->getParameter('eventDate');
  	$rankingId  = $request->getParameter('rankingId');
  	
  	if( !Validate::validateDate($eventDate) )
  		$eventDate = null;

  	$criteria = new Criteria();
  	if( $eventName ) $criteria->addAnd( EventPeer::EVENT_NAME, '%'.$eventName.'%', Criteria::ILIKE );
  	if( $eventDate ) $criteria->addAnd( EventPeer::EVENT_DATE, Util::formatDate($eventDate) );
  	if( $eventPlace ) $criteria->addAnd( EventPeer::EVENT_PLACE, '%'.$eventPlace.'%', Criteria::ILIKE );
  	if( $rankingId ) $criteria->addAnd( EventPeer::RANKING_ID, $rankingId );

	if( $renderize ){
		
		$this->criteria = $criteria;
		$this->setTemplate('index');
	}else{
	  	
	  	sfConfig::set('sf_web_debug', false);
		sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
		return $this->renderText(get_partial('event/include/search', array('criteria'=>$criteria)));
	}  	
  }
  
  public function executeJavascript($request){
  	
    header('Content-type: text/x-javascript');
		
  	$nl = chr(10);
  }
  
  
  
  public function executeDebug($request){
  	
  	$rankingObj = RankingPeer::retrieveByPK(2);
  	
  	foreach($rankingObj->getEventDateList() as $eventDate)
  		$rankingObj->updateHistory($eventDate);
  	
  	echo 'ok '.date('d/m/D H:i:s');
  	exit;
  }
}
