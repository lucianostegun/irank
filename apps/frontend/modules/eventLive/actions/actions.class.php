<?php

class eventLiveActions extends sfActions
{

  public function executeIndex($request){
  	
  }

  public function executeDetails($request){
  	
  	$eventLiveId = $request->getParameter('id');
  	$this->eventLiveObj = EventLivePeer::retrieveByPK($eventLiveId);
  }
}
