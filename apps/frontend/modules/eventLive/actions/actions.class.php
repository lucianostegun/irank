<?php

class eventLiveActions extends sfActions
{

  public function preExecute(){
  	
  	$eventCode = $this->getRequestParameter('eventCode');
  	$eventCode = ($eventCode?base64_decode($eventCode):null);
  	
  	$this->eventLiveId   = $this->getRequestParameter('id', $eventCode);
  	$this->eventLiveId   = $this->getRequestParameter('eventLiveId', $this->eventLiveId);
  	
  	$this->eventLiveScheduleId = $this->getRequestParameter('eventLiveScheduleId');
  }
  
  public function executeIndex($request){
  	
  }

  public function executeDetails($request){
  	
  	if( !$this->eventLiveId )
  		$this->eventLiveId = Util::getDirectUrlId('eventLive/details');
  	
  	$this->eventLiveObj = EventLivePeer::retrieveByPK($this->eventLiveId);
  	
  	$this->facebookMetaList = array('title'=>$this->eventLiveObj->getEventName(),
  									'description'=>$this->eventLiveObj->getFacebookDescription());
  	
  	if( !is_object($this->eventLiveObj) )
  		return $this->redirect('eventLive/index');
  		
  	$this->eventLiveObj->updateVisitCount();
  	
  	if( !is_object($this->eventLiveObj) )
  		return $this->redirect('eventLive/index');
  }

  public function executeTogglePresence($request){
  	
  	$isAuthenticated = $this->getUser()->isAuthenticated();
  	$iRankSite       = $this->getUser()->hasCredential('iRankSite');
  	
  	if( !$isAuthenticated || !$iRankSite )
  		Util::forceError('!Você precisa estar logado para confirmar sua presença no evento.');
  		
  	$peopleId = $this->getUser()->getAttribute('peopleId');
  	
  	$result        = 'success';
  	$errorMessage  = null;
  	$currentStatus = 'no';
  	
  	$eventLiveObj = EventLivePeer::retrieveByPK($this->eventLiveId);
  	$players      = $eventLiveObj->getPlayers(false, false);
  	
  	if( is_object($eventLiveObj) ){

	  	if( $eventLiveObj->isPastDate() ){
	  		
	  		$result       = 'error';
	  		$errorMessage = 'Este evento já foi realizado.';
	  	}elseif( !$eventLiveObj->isEnrollmentOpen() ){
	  		
	  		$result       = 'error';
	  		$errorMessage = 'As inscrições deste evento iniciam apenas em '.$eventLiveObj->getEnrollmentStartDate('d/m/Y').'.';
	  	}else{
	  		
	  		$eventLivePlayerObj = EventLivePlayerPeer::retrieveByPK($this->eventLiveId, $peopleId);
	  		$eventLivePlayerObj->togglePresence();
	  		$currentStatus = $eventLivePlayerObj->getCurrentStatus();
	  		
	  		
	  		if( $currentStatus=='yes' )
	  			$players++;
	  		else
	  			$players--;
	  	}
	  	
  		
  	}else{

  		$result       = 'error';
  		$errorMessage = 'Evento não encontrado.';
  	}
  	
  	$infoList = array();
	$infoList['result']        = $result;
  	$infoList['currentStatus'] = $currentStatus;
	$infoList['players']       = $players;
	$infoList['errorMessage']  = $errorMessage;
  	
  	echo Util::parseInfo($infoList);
  	exit;
  }

  public function executeGetInfo($request){
  	
  	$eventLiveObj = EventLivePeer::retrieveByPK($this->eventLiveId);
  	echo Util::parseInfo($eventLiveObj->getInfo());
  	exit;
  }

  public function executeGetTabContent($request){
  	
  	$tabId = $request->getParameter('tabId');
  	$tabId = strtolower($tabId);
  	
  	$eventLiveObj = EventLivePeer::retrieveByPK($this->eventLiveId);
  	
  	if( is_object($eventLiveObj) )
  		$tabPath = 'eventLive/include/'.$tabId;
  	else
  		$tabPath = 'eventLive/include/list/'.$tabId;
  	
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag');
	return $this->renderText(get_partial($tabPath, array('eventLiveObj'=>$eventLiveObj)));
  }
}
