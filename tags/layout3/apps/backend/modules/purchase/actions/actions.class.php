<?php

/**
 * purchase actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class purchaseActions extends sfActions
{

  public function preExecute(){
    
    $this->purchaseId = $this->getRequestParameter('id');
    $this->purchaseId = $this->getRequestParameter('purchaseId', $this->purchaseId);
    $this->purchaseId = $this->getUser()->getAttribute('purchaseId', $this->purchaseId);
    
    $this->purchaseIdAttribute = $this->getUser()->getAttribute('purchaseId');
    
    $this->pathList = array('Pedidos'=>'purchase/index');
    $this->toolbarList = array('new');
  }

  public function executeIndex($request){
    
  }
  
  public function executeEdit($request){
    
    $this->purchaseObj = $purchaseObj = PurchasePeer::retrieveByPK($this->purchaseId);
    
    if( !is_object($purchaseObj) )
    	return $this->redirect('purchase/index');
    	
    $this->pathList[$purchaseObj->getOrderNumber()] = '#';
    
   	$this->toolbarList = array('save');
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){
    
    $purchaseId  = $this->getUser()->getAttribute('purchaseId');
    $purchaseObj = PurchasePeer::retrieveByPK($this->purchaseId);
    
    $purchaseObj->quickSave($request);
    
    exit;
  }
}
