<?php

/**
 * glossary actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class glossaryActions extends sfActions
{

  public function preExecute(){
    
    $this->glossaryId = $this->getRequestParameter('id');
    $this->glossaryId = $this->getRequestParameter('glossaryId', $this->glossaryId);
    $this->glossaryId = $this->getUser()->getAttribute('glossaryId', $this->glossaryId);
    
    $this->glossaryIdAttribute = $this->getUser()->getAttribute('glossaryId');
    
    $this->pathList = array('Glossário de termos'=>'glossary/index');
    $this->toolbarList = array('new');
  }

  public function executeIndex($request){
    
  }

  public function executeUpload($request){
    
  }

  public function executeNew($request){
  	
    $this->glossaryObj = Util::getNewObject('glossary');
    
    $this->pathList['Novo termo'] = '#';
    $this->setTemplate('edit');
    
    $this->toolbarList = array('new', 'save');
  }
  
  public function executeEdit($request){
    
    $this->glossaryObj = $glossaryObj = GlossaryPeer::retrieveByPK($this->glossaryId);
    
    if( !is_object($glossaryObj) )
    	return $this->redirect('glossary/index');
    	
    $this->pathList[$glossaryObj->getTerm()] = '#';
    
    $isAdmin = $this->getUser()->hasCredential('iRankAdmin');
    
    if( $this->glossaryIdAttribute && !$isAdmin )
    	$this->toolbarList = array('save');
    else
    	$this->toolbarList = array('new', 'save', 'delete');
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){
    
    $glossaryId  = $this->getUser()->getAttribute('glossaryId');
    $glossaryObj = GlossaryPeer::retrieveByPK($this->glossaryId);
    
    $glossaryObj->quickSave($request);
    
    exit;
  }

  public function executeDelete($request){
    
    if( empty($this->glossaryId) )
    	Util::forceError('!Nenhum registro foi selecionado!');
    
    try{
    	
	    $criteria = new Criteria();
	    $criteria->add( GlossaryPeer::ID, $this->glossaryId, Criteria::IN );
	    $criteria->add( GlossaryPeer::VISIBLE, true );
	    $criteria->add( GlossaryPeer::ENABLED, true );
	    $criteria->add( GlossaryPeer::DELETED, false );
    	$glossaryObjList = GlossaryPeer::doSelect($criteria);
    	
    	$glossaryIdList = array();
    	foreach($glossaryObjList as $glossaryObj){
    		
    		$glossaryObj->delete();
	    	$glossaryIdList[] = $glossaryObj->getId();
    	}
    	
    	echo implode(',', $glossaryIdList);
    }catch(Exception $e){
    	
    	Util::forceError($e->getMessage());
    }
    
    exit;
  }
}
