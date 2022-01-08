<?php

/**
 * productCategory actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class productCategoryActions extends sfActions
{

  public function preExecute(){
    
    $this->productCategoryId = $this->getRequestParameter('id');
    $this->productCategoryId = $this->getRequestParameter('productCategoryId', $this->productCategoryId);
    $this->productCategoryId = $this->getUser()->getAttribute('productCategoryId', $this->productCategoryId);
    
    $this->productCategoryIdAttribute = $this->getUser()->getAttribute('productCategoryId');
    
    $this->pathList = array('Categorias de produto'=>'productCategory/index');
    $this->toolbarList = array('new');
  }

  public function executeIndex($request){
    
  }

  public function executeUpload($request){
    
  }

  public function executeNew($request){
  	
    $this->productCategoryObj = Util::getNewObject('productCategory');
    
    $this->pathList['Novo productCategorye'] = '#';
    $this->setTemplate('edit');
    
    $this->toolbarList = array('new', 'save');
  }
  
  public function executeEdit($request){
    
    $this->productCategoryObj = $productCategoryObj = ProductCategoryPeer::retrieveByPK($this->productCategoryId);
    
    if( !is_object($productCategoryObj) )
    	return $this->redirect('productCategory/index');
    	
    $this->pathList[$productCategoryObj->getCategoryName()] = '#';
    
    $isAdmin = $this->getUser()->hasCredential('iRankAdmin');
    
    if( $this->productCategoryIdAttribute && !$isAdmin )
    	$this->toolbarList = array('save');
    else
    	$this->toolbarList = array('new', 'save', 'delete');
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){
    
    $productCategoryId  = $this->getUser()->getAttribute('productCategoryId');
    $productCategoryObj = ProductCategoryPeer::retrieveByPK($this->productCategoryId);
    
    $productCategoryObj->quickSave($request);
    
    exit;
  }

  public function executeDelete($request){
    
    if( empty($this->productCategoryId) )
    	Util::forceError('!Nenhum registro foi selecionado!');
    
    try{
    	
	    $criteria = new Criteria();
	    $criteria->add( ProductCategoryPeer::ID, $this->productCategoryId, Criteria::IN );
	    $criteria->add( ProductCategoryPeer::VISIBLE, true );
	    $criteria->add( ProductCategoryPeer::ENABLED, true );
	    $criteria->add( ProductCategoryPeer::DELETED, false );
    	$productCategoryObjList = ProductCategoryPeer::doSelect($criteria);
    	
    	$productCategoryIdList = array();
    	foreach($productCategoryObjList as $productCategoryObj){
    		
    		$productCategoryObj->delete();
	    	$productCategoryIdList[] = $productCategoryObj->getId();
    	}
    	
    	echo implode(',', $productCategoryIdList);
    }catch(Exception $e){
    	
    	Util::forceError($e->getMessage());
    }
    
    exit;
  }
}
