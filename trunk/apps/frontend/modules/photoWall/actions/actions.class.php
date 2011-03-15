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
  
  public function executeGetLastPhoto($request){

	$offset = $request->getParameter('offset');
	
	$criteria = new Criteria();
	$criteria->add( EventPhotoPeer::IS_SHARED, true );
	$criteria->setOffset($offset);
	$criteria->addDescendingOrderByColumn( EventPhotoPeer::CREATED_AT );
	$eventPhotoObj = EventPhotoPeer::doSelectOne($criteria);
	
	$eventPhotoObj->getFile()->getResized(300);
		
	exit;
  }
}
