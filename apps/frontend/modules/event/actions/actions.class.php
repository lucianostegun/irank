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
	$sendEmail       = $request->getParameter('sendEmail');

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
	
	$rankingObj = $eventObj->getRanking();
	
	if( $firstSave ){
		
		$rankingObj->setEvents($rankingObj->getEvents()+1);
		$rankingObj->save();
	}
	
	$eventObj->importPlayers();

	if( $confirmPresence )
		$eventObj->addPlayer( $this->peopleId, true );

	if( $sendEmail )
		$eventObj->notify();
		
	$eventObj->save();

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
  
  public function executeChoosePresence($request){

	$eventId = $request->getParameter('eventId');
	$choice  = $request->getParameter('choice');

	$eventObj    = EventPeer::retrieveByPK( $eventId );
	
//	if( !$eventObj->isEditable() )
//		Util::forceError('!Este evento está bloqueado para edição', true);

	$eventObj->togglePresence( $this->peopleId, $choice );
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
	$notify   = $request->getParameter('notify');
	$notify   = ($notify?true:false);
	
	$eventObj = EventPeer::retrieveByPK( $eventId );
	
	if( !$eventObj->isMyEvent() )
		throw new Exception('Você não está autorizado a editar as informações deste evento!');
	
	if( !$eventObj->isConfirmed($peopleId) )
		$eventObj->togglePresence($peopleId, 'yes', $notify);
	else
		$eventObj->togglePresence($peopleId, 'no', $notify);
    
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
  
  public function executeToggleShare($request){

	$eventId  = $request->getParameter('eventId');
	$peopleId = $request->getParameter('peopleId');
	
	$eventPlayerObj = EventPlayerPeer::retrieveByPK( $eventId, $peopleId );
	$peopleIdOwner  = $eventPlayerObj->getEvent()->getRanking()->getUserSite()->getPeopleId();
	
	if( $peopleIdOwner==$peopleId || $peopleId==$this->peopleId || !is_object($eventPlayerObj) )
		throw new Exception('Não é possível habilitar/desabilitar a edição do evento para esta pessoa');
	
	$eventPlayerObj->setAllowEdit( !$eventPlayerObj->getAllowEdit() );
	$eventPlayerObj->save();
	
    echo ($eventPlayerObj->getAllowEdit()?'lock':'unlock');
    exit;
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
  
  public function executeConfirmPresence($request){
  	
  	$confirmCode = $request->getParameter('confirmCode');

	$eventPlayerObj = EventPlayerPeer::retrieveByConfirmCode($confirmCode);
  	
  	if( !$confirmCode || !is_object($eventPlayerObj) )
  		return $this->redirect('event/index');
  	
  	$peopleIdTmp = $this->getUser()->getAttribute('peopleId');
  	$this->getUser()->setAttribute('peopleId', $eventPlayerObj->getPeopleId());
  	
  	$eventPlayerObj->confirmPresence();
  	
  	if( $eventPlayerObj->getPeople()->isPeopleType('userSite') )
  		$eventPlayerObj->getPeople()->getUserSite()->login();
  	
  	$this->getUser()->setAttribute('peopleId', $peopleIdTmp);
  	
  	$this->eventObj = $eventPlayerObj->getEvent();
  }
  
  public function executeJavascript($request){
  	
    header('Content-type: text/x-javascript');
		
  	$nl = chr(10);
  }
  
  public function executeDebug($request){
  	
  	$rankingId  = $request->getParameter('rankingId');
  	$rankingObj = RankingPeer::retrieveByPK($rankingId);

  	foreach($rankingObj->getEventDateList() as $eventDate)
  		$rankingObj->updateHistory($eventDate);
  	
  	echo 'ok '.date('d/m/D H:i:s');
  	exit;
  }
}
