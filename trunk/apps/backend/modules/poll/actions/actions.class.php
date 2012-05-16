<?php

/**
 * poll actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Guilherme Sathler
 */
class pollActions extends sfActions
{

  public function preExecute(){
    
    if( !$this->getUser()->hasCredential('iRankAdmin') )
    	$this->redirect('home/error404');
    
    $this->pollId = $this->getRequestParameter('id');
    $this->pollId = $this->getRequestParameter('pollId', $this->pollId);
    
    $this->pathList = array('Enquetes'=>'poll/index');
    $this->toolbarList = array('new');
  }

  public function executeIndex($request){
    
  }
 
  public function executeNew($request){
  	
    $this->pollObj = Util::getNewObject('poll');
    
    $this->pathList['Nova enquete'] = '#';
    $this->setTemplate('edit');
    
    $this->toolbarList = array('new', 'save');
  }
  
  public function executeEdit($request){
    
    $this->pollObj = $pollObj = PollPeer::retrieveByPK($this->pollId);
    
    if( !is_object($pollObj) )
    	return $this->redirect('poll/index');
    	
    $this->pathList[$pollObj->getQuestion()] = '#';
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){
    
    $pollObj = PollPeer::retrieveByPK($this->pollId);
    
    $pollObj->quickSave($request);
    
    exit;
  }

  public function executeDelete($request){
    
    if( empty($this->pollId) )
    	Util::forceError('!Nenhum registro foi selecionado!');
    
    try{
    	
	    $criteria = new Criteria();
	    $criteria->add( PollPeer::ID, $this->pollId, Criteria::IN );
	    $criteria->add( PollPeer::VISIBLE, true );
	    $criteria->add( PollPeer::ENABLED, true );
	    $criteria->add( PollPeer::DELETED, false );
    	$pollObjList = PollPeer::doSelect($criteria);
    	
    	$pollIdList = array();
    	foreach($pollObjList as $pollObj){
    		
    		$pollObj->delete();
	    	$pollIdList[] = $pollObj->getId();
    	}
    	
    	echo implode(',', $pollIdList);
    }catch(Exception $e){
    	
    	Util::forceError($e->getMessage());
    }
    
    exit;
  }
}