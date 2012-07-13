<?php

class clubActions extends sfActions
{

  public function preExecute(){
  	
  	$this->clubId = $this->getRequestParameter('id');
  	$this->clubId = $this->getRequestParameter('clubId', $this->clubId);
  }

  public function executeIndex($request){
  	
  }

  public function executeDetails($request){
  	
  	$this->clubObj = ClubPeer::retrieveByPK($this->clubId);
  	$this->clubObj->updateVisitCount();
  }

  public function executeGetTabContent($request){
  	
  	$clubId = $request->getParameter('id');
  	$clubId = $request->getParameter('clubId', $clubId);
  	$tabId  = $request->getParameter('tabId');
  	$tabId  = strtolower($tabId);
  	
  	$clubObj = ClubPeer::retrieveByPK($clubId);
  	
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag');

	return $this->renderText(get_partial('club/include/'.$tabId, array('clubObj'=>$clubObj)));
  }
}
