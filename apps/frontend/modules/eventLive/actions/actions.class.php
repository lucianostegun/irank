<?php

class eventLiveActions extends sfActions
{

  public function executeIndex($request){
  	
  }

  public function executeDetails($request){
  	
  	$eventLiveId = $request->getParameter('id');
  	$eventLiveId = $request->getParameter('eventLiveId', $eventLiveId);
  	
  	if( !$eventLiveId )
  		$eventLiveId = Util::getDirectUrlId('eventLive/details');
  	
  	$this->eventLiveObj = EventLivePeer::retrieveByPK($eventLiveId);
  	
  	if( !is_object($this->eventLiveObj) )
  		return $this->redirect('eventLive/index');
  }

  public function executeGetTabContent($request){
  	
  	$eventLiveId = $request->getParameter('id');
  	$eventLiveId = $request->getParameter('eventLiveId', $eventLiveId);
  	$tabId       = $request->getParameter('tabId');
  	$tabId       = strtolower($tabId);
  	
  	$eventLiveObj = EventLivePeer::retrieveByPK($eventLiveId);
  	
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag');

	return $this->renderText(get_partial('eventLive/include/'.$tabId, array('eventLiveObj'=>$eventLiveObj)));
  }

  public function executeTogglePresence($request){
  	
  	$isAuthenticated = $this->getUser()->isAuthenticated();
  	$iRankSite       = $this->getUser()->hasCredential('iRankSite');
  	
  	if( !$isAuthenticated || !$iRankSite )
  		Util::forceError('!Você precisa estar logado para confirmar sua presença no evento.');
  		
  	$peopleId    = $this->getUser()->getAttribute('peopleId');
  	$eventLiveId = $request->getParameter('eventLiveId');
  	
  	$result        = 'success';
  	$errorMessage  = null;
  	$currentStatus = 'no';
  	
  	$eventLiveObj = EventLivePeer::retrieveByPK($eventLiveId);
  	
  	if( is_object($eventLiveObj) ){

	  	if( $eventLiveObj->isPastDate() ){
	  		
	  		$result       = 'error';
	  		$errorMessage = 'Este evento já foi realizado.';
	  	}else{
	  		
	  		$eventLivePlayerObj = EventLivePlayerPeer::retrieveByPK($eventLiveId, $peopleId);
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
}
