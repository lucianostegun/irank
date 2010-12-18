<?php

class eventActions extends sfActions
{

  public function preExecute(){
	
	$this->title = 'Eventos';
	
	$this->userSiteId = $this->getUser()->getAttribute('userSiteId');
	$this->peopleId   = $this->getUser()->getAttribute('peopleId');
  }

  public function executeIndex($request){

	$this->userSiteObj = UserSitePeer::retrieveByPK( $this->userSiteId );
	$this->criteria    = new Criteria();
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

  public function executeSearch($request){

  	$rankingId        = $request->getParameter('rankingId');
  	$this->rankingObj = RankingPeer::retrieveByPK($rankingId);
  	
  	$this->title = 'Eventos > '.$this->rankingObj->getRankingName();
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
  	}
  }

  public function handleErrorSaveResult(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }
  
  public function executeSaveResult($request){

	$eventId  = $request->getParameter('eventId');
	$eventObj = EventPeer::retrieveByPK($eventId);
	
	if( !$eventObj->isEditable() )
		Util::forceError('!Este evento está bloqueado para edição', true);
		
	$eventObj->saveResult($request);
	
	exit;
  }
  
  public function executeSaveComment($request){

	$eventId = $request->getParameter('eventId');
	$comment = $request->getParameter('comment');
	$comment = urldecode($comment);

	$comment = str_replace('|n', chr(10), $comment);

	$eventCommentObj = new EventComment();
	$eventCommentObj->setPeopleId( $this->peopleId );
	$eventCommentObj->setEventId( $eventId );
	$eventCommentObj->setComment( $comment );
	$eventCommentObj->save();
	
	$eventCommentObj->notify();
	
  	sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
	return $this->renderText(get_partial('event/include/comment', array('eventCommentObj'=>$eventCommentObj)));
	exit;
  }
  
  public function executeDeleteComment($request){

	$eventCommentId = $request->getParameter('eventCommentId');
	
	$eventCommentObj = EventCommentPeer::retrieveByPK($eventCommentId);
	
	if( !$eventCommentObj->isMyComment() )
		throw new Exception('Este comentário não foi escrito por você!');
	
	$eventCommentObj->delete();
	exit;
  }
  
  public function executeGetCommentList($request){

	$eventId = $request->getParameter('eventId');
	
	$eventObj = EventPeer::retrieveByPK($eventId);
	$eventCommentObjList = $eventObj->getCommentList();
	$eventCommentObjList = array_reverse($eventCommentObjList);
	
  	sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
	
	foreach($eventCommentObjList as $eventCommentObj)
		$this->renderText(include_partial('event/include/comment', array('eventCommentObj'=>$eventCommentObj)));
		
	exit;
  }
  
  public function executeJavascript($request){
  	
    header('Content-type: text/x-javascript');
		
  	$nl = chr(10);
  }
}
