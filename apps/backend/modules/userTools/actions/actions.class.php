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
    $userAdminObj = UserAdmin::getCurrentUser();
    $peopleObj    = $userAdminObj->getPeople();
    
    $firstName = preg_replace('/ .*$/', '', $fullName);
    $lastName  = preg_replace('/^'.$firstName.' /', '', $fullName);
    
    $userAdminObj->quickSave($request, true);
    $peopleObj->setFirstName($firstName);
    $peopleObj->setLastName($lastName);
    $peopleObj->setFullName($fullName);
    $peopleObj->save();
    exit;
  }
}
