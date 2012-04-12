<?php

class eventLiveActions extends sfActions
{

  public function preExecute(){
  	
  	$this->eventLiveId = $this->getRequestParameter('id');
  	$this->eventLiveId = $this->getRequestParameter('eventLiveId', $this->eventLiveId);
  }
  
  public function executeIndex($request){
  	
  }

  public function executeDetails($request){
  	
  	if( !$this->eventLiveId )
  		$this->eventLiveId = Util::getDirectUrlId('eventLive/details');
  	
  	$this->eventLiveObj = EventLivePeer::retrieveByPK($this->eventLiveId);
  	
  	if( !is_object($this->eventLiveObj) )
  		return $this->redirect('eventLive/index');
  }

  public function executeGetTabContent($request){
  	
  	$tabId = $request->getParameter('tabId');
  	$tabId = strtolower($tabId);
  	
  	$eventLiveObj = EventLivePeer::retrieveByPK($this->eventLiveId);
  	
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag');

	return $this->renderText(get_partial('eventLive/include/'.$tabId, array('eventLiveObj'=>$eventLiveObj)));
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
  	
  	if( is_object($eventLiveObj) ){

	  	if( $eventLiveObj->isPastDate() ){
	  		
	  		$result       = 'error';
	  		$errorMessage = 'Este evento já foi realizado.';
	  	}else{
	  		
	  		$eventLivePlayerObj = EventLivePlayerPeer::retrieveByPK($this->eventLiveId, $peopleId);
	  		$eventLivePlayerObj->togglePresence();
	  		$currentStatus = $eventLivePlayerObj->getCurrentStatus();
	  	}
	  	
  		$players = $eventLiveObj->getPlayers(true);
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
}
