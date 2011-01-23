<?php

class myAccountActions extends sfActions
{

  public function preExecute(){

  }

  public function executeIndex($request){

	$userSiteId = MyTools::getAttribute('userSiteId');
	
	$this->userSiteObj = UserSitePeer::retrieveByPK($userSiteId);
	$this->showSuccess = $this->getFlash('showSuccess');
	$this->selectedTab = $request->getParameter('tab', 'main');
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){

	$userSiteId  = MyTools::getAttribute('userSiteId');
	$userSiteObj = UserSitePeer::retrieveByPK($userSiteId);
	$firstSave   = false;

  	$userSiteObj->quickSave($request);
  	$userSiteObj->saveEmailOptions($request);
  	exit;
  }
}
