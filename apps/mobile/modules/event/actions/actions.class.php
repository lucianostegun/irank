<?php

class eventActions extends sfActions
{

  public function preExecute(){
	
	Util::getHelper('I18N');
	
	$this->title = __('event.title');
	
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
  	
  	$this->title = __('event.title').' > '.$this->rankingObj->getRankingName();
  }
  
  public function executeEdit($request){
  	
  	$eventId       = $request->getParameter('eventId');
  	$this->isClone = $request->getParameter('isClone');
  	
  	if( $eventId ){
  		
		$this->eventObj = EventPeer::retrieveByPK( $eventId );

		if( !is_object($this->eventObj) )
			return $this->redirect('event/index');
		
		if( !$this->eventObj->isMyEvent() || !$this->eventObj->isEditable() )
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
		Util::forceError(__('event.exception.lockedEvent'), true);
		
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
		throw new Exception(__('event.exception.notYourComment'));
	
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
  	
  	echo 'var i18n_event_result_successMessage = "'.__('event.result.successMessage').'";'.$nl;
  	echo 'var i18n_event_result_errorMessage   = "'.__('event.result.errorMessage').'";'.$nl;
  	echo 'var i18n_event_result_waitMessage    = "'.__('event.result.waitMessage').'";'.$nl;
  	echo 'var i18n_event_result_saveConfirm    = "'.__('event.result.saveConfirm').'";'.$nl;
  	echo 'var i18n_event_comment_waitMessage   = "'.__('event.comment.waitMessage').'";'.$nl;
  	echo 'var i18n_event_comment_fieldMessage  = "'.__('event.comment.fieldMessage').'";'.$nl;
  	echo 'var i18n_event_comment_publishing    = "'.__('event.comment.publishing').'";'.$nl;
  	echo 'var i18n_event_comment_published     = "'.__('event.comment.published').'";'.$nl;
  	echo 'var i18n_event_comment_errorMessage  = "'.__('event.comment.errorMessage').'";'.$nl;
  	echo 'var i18n_event_comment_deleteError   = "'.__('event.comment.deleteError').'";'.$nl;
  	echo 'var i18n_leftChar                    = "'.__('leftChar').'";'.$nl;
  	echo 'var i18n_leftChars                   = "'.__('leftChars').'";'.$nl;
  	
  	exit;
  }
}
