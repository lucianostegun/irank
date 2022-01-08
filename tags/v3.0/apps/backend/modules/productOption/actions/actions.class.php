<?php

/**
 * productOption actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class productOptionActions extends sfActions
{

  public function preExecute(){
    
    $this->productOptionId = $this->getRequestParameter('id');
    $this->productOptionId = $this->getRequestParameter('productOptionId', $this->productOptionId);
    $this->productOptionId = $this->getUser()->getAttribute('productOptionId', $this->productOptionId);
    
    $this->productOptionIdAttribute = $this->getUser()->getAttribute('productOptionId');
    
    $this->pathList = array('Opções de produto'=>'productOption/index');
    $this->toolbarList = array('new');
  }

  public function executeIndex($request){
    
  }

  public function executeUpload($request){
    
  }

  public function executeNew($request){
  	
    $this->productOptionObj = Util::getNewObject('productOption');
    
    $this->pathList['Nova opção'] = '#';
    $this->setTemplate('edit');
    
    $this->toolbarList = array('new', 'save');
  }
  
  public function executeEdit($request){
    
    $this->productOptionObj = $productOptionObj = ProductOptionPeer::retrieveByPK($this->productOptionId);
    
    if( !is_object($productOptionObj) )
    	return $this->redirect('productOption/index');
    	
    $this->pathList[$productOptionObj->getOptionName()] = '#';
    
    $isAdmin = $this->getUser()->hasCredential('iRankAdmin');
    
    if( $this->productOptionIdAttribute && !$isAdmin )
    	$this->toolbarList = array('save');
    else
    	$this->toolbarList = array('new', 'save', 'delete');
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){
    
    $productOptionId  = $this->getUser()->getAttribute('productOptionId');
    $productOptionObj = ProductOptionPeer::retrieveByPK($this->productOptionId);
    
    $productOptionObj->quickSave($request);
    
    exit;
  }

  public function executeDelete($request){
    
    if( empty($this->productOptionId) )
    	Util::forceError('!Nenhum registro foi selecionado!');
    
    try{
    	
	    $criteria = new Criteria();
	    $criteria->add( ProductOptionPeer::ID, $this->productOptionId, Criteria::IN );
	    $criteria->add( ProductOptionPeer::VISIBLE, true );
	    $criteria->add( ProductOptionPeer::ENABLED, true );
	    $criteria->add( ProductOptionPeer::DELETED, false );
    	$productOptionObjList = ProductOptionPeer::doSelect($criteria);
    	
    	$productOptionIdList = array();
    	foreach($productOptionObjList as $productOptionObj){
    		
    		$productOptionObj->delete();
	    	$productOptionIdList[] = $productOptionObj->getId();
    	}
    	
    	echo implode(',', $productOptionIdList);
    }catch(Exception $e){
    	
    	Util::forceError($e->getMessage());
    }
    
    exit;
  }
}
