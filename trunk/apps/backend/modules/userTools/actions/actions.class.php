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
    
  }
  
  public function executeEdit($request){
    
    $this->userAdminObj = UserAdmin::getCurrentUser();
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
