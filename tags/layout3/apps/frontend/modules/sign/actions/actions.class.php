<?php

class signActions extends sfActions
{

  public function preExecute(){

	if( $this->getUser()->isAuthenticated() )
		return $this->forward('myAccount', 'index');
  }

  public function executeIndex($request){
	
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){

	$userSiteId   = MyTools::getAttribute('userSiteId');
	$emailAddress = $request->getParameter('emailAddress');
	
	$userSiteObj = new UserSite();
	$peopleObj   = PeoplePeer::retrieveByEmailAddress($emailAddress);
	
	$this->setFlash('showSuccess', true);
	
	if( is_object($peopleObj) && $peopleObj->isPeopleType('rankingPlayer') )
		$userSiteObj->setPeopleId($peopleObj->getId());
  	
  	$userSiteObj->quickSave($request);
  	$userSiteObj->login();

	$userSiteObj->resetOptions();
	$userSiteObj->sendWelcomeMail($request);
	$userSiteObj->getImagePath(true);
  	exit;
  }
}
