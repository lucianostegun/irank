<?php

class signActions extends sfActions
{

  public function preExecute(){

  }

  public function executeIndex($request){
	
	if( $this->getUser()->isAuthenticated() )
		return $this->forward('sign', 'edit');
  }

  public function executeEdit($request){

	$userSiteId = MyTools::getAttribute('userSiteId');
	
	$this->userSiteObj = UserSitePeer::retrieveByPK($userSiteId);
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){

	$userSiteId   = MyTools::getAttribute('userSiteId');
	$emailAddress = $request->getParameter('emailAddress');
	
	if( $userSiteId ){
		
  		$userSiteObj = UserSitePeer::retrieveByPK($userSiteId);
  		$firstSave   = false;
	}else{
  		
  		$userSiteObj = new UserSite();
  		$peopleObj   = PeoplePeer::retrieveByEmailAddress($emailAddress);
  		$firstSave   = true;
  		
  		if( is_object($peopleObj) && $peopleObj->isPeopleType('rankingPlayer') )
  			$userSiteObj->setPeopleId($peopleObj->getId());
  	}

  	$userSiteObj->quickSave($request);
  	$userSiteObj->login();
  	
  	if( $firstSave ){
  		
  		$userSiteObj->resetOptions();
  		$userSiteObj->sendWelcomeMail($request);
  	}
  	exit;
  }

  public function executeOptions($request){
	
	$userSiteId = MyTools::getAttribute('userSiteId');
	
	$this->userSiteObj = UserSitePeer::retrieveByPK($userSiteId);
  }

  public function executeSaveOptions($request){
	
	$userSiteId  = MyTools::getAttribute('userSiteId');
	$userSiteObj = UserSitePeer::retrieveByPK($userSiteId);
	
	$receiveFriendEventConfirmNotify = $request->getParameter('receiveFriendEventConfirmNotify');
	$receiveEventReminder0           = $request->getParameter('receiveEventReminder0');
	$receiveEventReminder3           = $request->getParameter('receiveEventReminder3');
	$receiveEventReminder7           = $request->getParameter('receiveEventReminder7');
	$receiveEventCommentNotify       = $request->getParameter('receiveEventCommentNotify');
	
	$userSiteObj->setOptionValue('receiveFriendEventConfirmNotify', ($receiveFriendEventConfirmNotify?'1':'0'));
	$userSiteObj->setOptionValue('receiveEventReminder0', ($receiveEventReminder0?'1':'0'));
	$userSiteObj->setOptionValue('receiveEventReminder3', ($receiveEventReminder3?'1':'0'));
	$userSiteObj->setOptionValue('receiveEventReminder7', ($receiveEventReminder7?'1':'0'));
	$userSiteObj->setOptionValue('receiveEventCommentNotify', ($receiveEventCommentNotify?'1':'0'));
	exit;
  }
}
