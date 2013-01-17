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
  	
  	$this->facebookMetaList = array();
	$this->facebookMetaList['image'] = array('http://[host]/images/club/'.$this->clubObj->getFileNameLogo());
	$this->facebookMetaList['url']         = 'http://www.irank.com.br/'.$this->clubObj->getTagName();
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

  public function executeRate($request){
  	
  	$peopleId = $this->getUser()->getAttribute('peopleId');
  	$rating   = $request->getParameter('rating');
  	
  	if( !$peopleId )
  		throw new Exception('user not logged');
  	
  	$clubPlayerObj = ClubPlayerPeer::retrieveByPK($this->clubId, $peopleId);
  	
  	if( !is_object($clubPlayerObj) )
  		throw new Exception('club/player not found');
  	
  	$clubPlayerObj->setRating($rating);
  	$clubPlayerObj->save();
  	
  	exit;
  }
}
