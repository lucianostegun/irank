<?php

/**
 * userTools actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class userToolsActions extends sfActions
{

  public function preExecute(){
    
    $this->pathList    = array('Perfil'=>'userTools/edit');
    $this->toolbarList = array('save');
  }
  
  public function executeEdit($request){
    
    $this->userAdminObj = UserAdmin::getCurrentUser();
    
    $peopleName = $this->userAdminObj->getPeople()->getName();
    $this->pathList[$peopleName] = null;
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){
    
    $fullName     = $request->getParameter('peopleName');
    $emailAddress = $request->getParameter('emailAddress');
    
    $userAdminObj = UserAdmin::getCurrentUser();
    $peopleObj    = $userAdminObj->getPeople();
    
    $userAdminObj->quickSave($request, true);
    
    $peopleObj->setName($fullName);
    $peopleObj->setEmailAddress($emailAddress);
    $peopleObj->save();
    exit;
  }
}
