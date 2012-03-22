<?php

class eventLiveActions extends sfActions
{

  public function executeIndex($request){
  	
  }

  public function executeDetails($request){
  	
  	$eventLiveId = $request->getParameter('id');
  	$this->eventLiveObj = EventLivePeer::retrieveByPK($eventLiveId);
  }

  public function executeGetTabContent($request){
  	
  	$eventLiveId = $request->getParameter('id');
  	$tabId       = $request->getParameter('tabId');
  	$tabId       = strtolower($tabId);
  	
  	$eventLiveObj = EventLivePeer::retrieveByPK($eventLiveId);
  	
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag');

	return $this->renderText(get_partial('eventLive/include/'.$tabId, array('eventLiveObj'=>$eventLiveObj)));
  }
}
