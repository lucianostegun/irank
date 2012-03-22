<?php

/**
 * club actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class clubActions extends sfActions
{

  public function preExecute(){
    
    $this->clubId = $this->getRequestParameter('id');
    $this->clubId = $this->getRequestParameter('clubId', $this->clubId);
    
    $this->pathList = array('Clubes'=>'club/index');
  }

  public function executeIndex($request){
    
  }

  public function executeNew($request){
    
    $this->clubObj = Util::getNewObject('club');
    
    $this->pathList['Novo clube'] = '#';
    $this->setTemplate('edit');
  }
  
  public function executeEdit($request){
    
    $this->clubObj = $clubObj = ClubPeer::retrieveByPK($this->clubId);
    
    if( !is_object($clubObj) )
    	return $this->redirect('club/index');
    	
    $this->pathList[$clubObj->getClubName()] = '#';
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){
    
    $clubObj = ClubPeer::retrieveByPK($this->clubId);
    
    $clubObj->quickSave($request);
    
    exit;
  }
}
