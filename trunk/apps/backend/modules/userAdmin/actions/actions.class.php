<?php

/**
 * userAdmin actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class userAdminActions extends sfActions
{

  public function preExecute(){
    
    $this->userAdminId = $this->getRequestParameter('id');
    $this->userAdminId = $this->getRequestParameter('userAdminId', $this->userAdminId);
    
    $this->pathList = array('Usuários'=>'userAdmin/index');
  }

  public function executeIndex($request){
    
  }

  public function executeNew($request){
    
    $this->userAdminObj = Util::getNewObject('userAdmin');
    
    $this->pathList['Novo usuário'] = '#';
    $this->setTemplate('edit');
  }
  
  public function executeEdit($request){
    
    $this->userAdminObj = $userAdminObj = UserAdminPeer::retrieveByPK($this->userAdminId);
    
    if( !is_object($userAdminObj) )
    	return $this->redirect('userAdmin/index');
    	
    $this->pathList[$userAdminObj->toString()] = '#';
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){
    
    $userAdminObj = UserAdminPeer::retrieveByPK($this->userAdminId);
    
    $userAdminObj->quickSave($request);
    
    exit;
  }

  public function executeDelete($request){
    
    if( empty($this->userAdminId) )
    	Util::forceError('!Nenhum registro foi selecionado!');
    
    try{
    	
	    $criteria = new Criteria();
	    $criteria->add( UserAdminPeer::ID, $this->userAdminId, Criteria::IN );
	    $criteria->add( UserAdminPeer::VISIBLE, true );
	    $criteria->add( UserAdminPeer::ENABLED, true );
	    $criteria->add( UserAdminPeer::DELETED, false );
    	$userAdminObjList = UserAdminPeer::doSelect($criteria);
    	
    	$userAdminIdList = array();
    	foreach($userAdminObjList as $userAdminObj){
    		
    		$userAdminObj->delete();
	    	$userAdminIdList[] = $userAdminObj->getId();
    	}
    	
    	echo implode(',', $userAdminIdList);
    }catch(Exception $e){
    	
    	Util::forceError($e->getMessage());
    }
    
    exit;
  }  
}
	