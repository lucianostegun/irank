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
	
	if( $userSiteId )
  		$userSiteObj = UserSitePeer::retrieveByPK($userSiteId);
  	else{
  		
  		$userSiteObj = new UserSite();
  		$peopleObj   = PeoplePeer::retrieveByEmailAddress($emailAddress);
  		
  		if( $peopleObj->isPeopleType('rankingMember') )
  			$userSiteObj->setPeopleId($peopleObj->getId());
  	}

  	$userSiteObj->quickSave($request);
  	$userSiteObj->login();
  	exit;
  }
}
