<?php

/**
 * blogCategory actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class blogCategoryActions extends sfActions
{

  public function preExecute(){
    
    $this->blogCategoryId = $this->getRequestParameter('id');
    $this->blogCategoryId = $this->getRequestParameter('blogCategoryId', $this->blogCategoryId);
    $this->blogCategoryId = $this->getUser()->getAttribute('blogCategoryId', $this->blogCategoryId);
    
    $this->blogCategoryIdAttribute = $this->getUser()->getAttribute('blogCategoryId');
    
    $this->pathList = array('Categorias de artigos'=>'blogCategory/index');
    $this->toolbarList = array('new');
  }

  public function executeIndex($request){
    
  }

  public function executeUpload($request){
    
  }

  public function executeNew($request){
  	
    $this->blogCategoryObj = Util::getNewObject('virtualTable', array('virtualTableName'=>'blogCategory'));
    
    $this->pathList['Novo categoria'] = '#';
    $this->setTemplate('edit');
    
    $this->toolbarList = array('new', 'save');
  }
  
  public function executeEdit($request){
    
    $this->blogCategoryObj = $blogCategoryObj = VirtualTablePeer::retrieveByPK($this->blogCategoryId);
    
    if( !is_object($blogCategoryObj) )
    	return $this->redirect('blogCategory/index');
    	
    $this->pathList[$blogCategoryObj->getDescription()] = '#';
    
    $isAdmin = $this->getUser()->hasCredential('iRankAdmin');
    
    if( $this->blogCategoryIdAttribute && !$isAdmin )
    	$this->toolbarList = array('save');
    else
    	$this->toolbarList = array('new', 'save', 'delete');
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){
    
    $blogCategoryId  = $this->getUser()->getAttribute('blogCategoryId');
    $blogCategoryObj = VirtualTablePeer::retrieveByPK($this->blogCategoryId);
    
    $blogCategoryObj->quickSave($request);
    
    exit;
  }

  public function executeDelete($request){
    
    if( empty($this->blogCategoryId) )
    	Util::forceError('!Nenhum registro foi selecionado!');
    
    try{
    	
	    $criteria = new Criteria();
	    $criteria->add( VirtualTablePeer::ID, $this->blogCategoryId, Criteria::IN );
	    $criteria->add( VirtualTablePeer::VISIBLE, true );
	    $criteria->add( VirtualTablePeer::ENABLED, true );
	    $criteria->add( VirtualTablePeer::DELETED, false );
    	$blogCategoryObjList = VirtualTablePeer::doSelect($criteria);
    	
    	$blogCategoryIdList = array();
    	foreach($blogCategoryObjList as $blogCategoryObj){
    		
    		$blogCategoryObj->delete();
	    	$blogCategoryIdList[] = $blogCategoryObj->getId();
    	}
    	
    	echo implode(',', $blogCategoryIdList);
    }catch(Exception $e){
    	
    	Util::forceError($e->getMessage());
    }
    
    exit;
  }
}
