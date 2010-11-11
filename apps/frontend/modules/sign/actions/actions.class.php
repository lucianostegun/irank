<?php

class signActions extends sfActions
{

  public function executeIndex($request){

  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){
  	
  	$userSiteObj = new UserSite();

  	$userSiteObj->quickSave($request);
  }  	
}
