<?php

class photoWallActions extends sfActions
{

  public function preExecute(){
	
  }

  public function executeIndex($request){

  }
  
  public function executeGetPhotoInfo($request){

	$eventId      = $request->getParameter('eventId');
	$eventPhotoId = $request->getParameter('eventPhotoId');
	
	$eventPhotoObj = EventPhotoPeer::retrieveByPK($eventPhotoId);
	
	echo Util::parseInfo($eventPhotoObj->getInfo());
		
	exit;
  }
}
