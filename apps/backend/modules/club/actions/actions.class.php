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

  public function executeDelete($request){
    
    if( empty($this->clubId) )
    	Util::forceError('!Nenhum registro foi selecionado!');
    
    try{
    	
	    $criteria = new Criteria();
	    $criteria->add( ClubPeer::ID, $this->clubId, Criteria::IN );
	    $criteria->add( ClubPeer::VISIBLE, true );
	    $criteria->add( ClubPeer::ENABLED, true );
	    $criteria->add( ClubPeer::DELETED, false );
    	$clubObjList = ClubPeer::doSelect($criteria);
    	
    	$clubIdList = array();
    	foreach($clubObjList as $clubObj){
    		
    		$clubObj->delete();
	    	$clubIdList[] = $clubObj->getId();
    	}
    	
    	echo implode(',', $clubIdList);
    }catch(Exception $e){
    	
    	Util::forceError($e->getMessage());
    }
    
    exit;
  }
}
