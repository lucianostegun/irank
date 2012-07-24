<?php

/**
 * product actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class productActions extends sfActions
{

  public function preExecute(){
    
    $this->productId = $this->getRequestParameter('id');
    $this->productId = $this->getRequestParameter('productId', $this->productId);
    $this->productId = $this->getUser()->getAttribute('productId', $this->productId);
    
    $this->productIdAttribute = $this->getUser()->getAttribute('productId');
    
    $this->pathList = array('Produtos'=>'product/index');
    $this->toolbarList = array('new');
  }

  public function executeIndex($request){
    
  }

  public function executeNew($request){
  	
    $this->productObj = Util::getNewObject('product');
    
    $this->pathList['Novo produto'] = '#';
    $this->setTemplate('edit');
    
    $this->toolbarList = array('new', 'save');
  }
  
  public function executeEdit($request){
    
    $this->productObj = $productObj = ProductPeer::retrieveByPK($this->productId);
    
    if( !is_object($productObj) )
    	return $this->redirect('product/index');
    	
    $this->pathList[$productObj->getProductName()] = '#';
    
    $isAdmin = $this->getUser()->hasCredential('iRankAdmin');
    
    if( $this->productIdAttribute && !$isAdmin )
    	$this->toolbarList = array('save');
    else
    	$this->toolbarList = array('new', 'save', 'delete');
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){
    
    $productObj = ProductPeer::retrieveByPK($this->productId);
    
    $productObj->quickSave($request);
    
    exit;
  }

  public function executeDelete($request){
    
    if( empty($this->productId) )
    	Util::forceError('!Nenhum registro foi selecionado!');
    
    try{
    	
	    $criteria = new Criteria();
	    $criteria->add( ProductPeer::ID, $this->productId, Criteria::IN );
	    $criteria->add( ProductPeer::VISIBLE, true );
	    $criteria->add( ProductPeer::ENABLED, true );
	    $criteria->add( ProductPeer::DELETED, false );
    	$productObjList = ProductPeer::doSelect($criteria);
    	
    	$productIdList = array();
    	foreach($productObjList as $productObj){
    		
    		$productObj->delete();
	    	$productIdList[] = $productObj->getId();
    	}
    	
    	echo implode(',', $productIdList);
    }catch(Exception $e){
    	
    	Util::forceError($e->getMessage());
    }
    
    exit;
  }

  public function executeGetNewProductItem($request){
  	
    $productItemObj = Util::getNewObject('productItem', array('productId'=>$this->productId));
    
    echo Util::parseInfo($productItemObj->getInfo());
    exit;
  }
  
  public function executeGetProductItem($request){
  	
  	$productItemId  = $request->getParameter('productItemId');
    $productItemObj = ProductItemPeer::retrieveByPK($productItemId);
    
    echo Util::parseInfo($productItemObj->getInfo());
    exit;
  }

  public function handleErrorSaveItem(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSaveItem($request){
    
    $productItemId  = $request->getParameter('productItemId');
    $productItemObj = ProductItemPeer::retrieveByPK($productItemId);
    
    $productItemObj->quickSave($request);
    
    echo Util::parseInfo($productItemObj->getInfo());
    
    exit;
  }
  
  public function executeDeleteProductItem($request){
  	
  	$productItemId  = $request->getParameter('productItemId');
    $productItemObj = ProductItemPeer::retrieveByPK($productItemId);
    
    $productItemObj->delete();
    
    echo $productItemObj->getProduct()->getStock();
    
    exit;
  }
  
  public function executeGetProductItemList($request){
  	
    $productObj = ProductPeer::retrieveByPK($this->productId);
    
    sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
	return $this->renderText(get_partial('product/include/itens', array('productObj'=>$productObj)));
    exit;
  }
  
  public function executeUploadImage($request){
	
	$imageIndex    = $request->getParameter('imageIndex');
	$productCode   = $request->getParameter('productCode');
	$productItemId = $request->getParameter('productItemId');
	$isProductItem = !empty($productItemId);
	
	if( $productItemId )
		$genericObj = ProductItemPeer::retrieveByPK($productItemId);
	else
		$genericObj = ProductPeer::retrieveByPK($this->productId);
	
	$maxFileSize = (1024*1024*1);
	
	$fileName = sprintf('%s-%02d', strtolower($productCode), $imageIndex);
	
	try {
		$options = array('noFile'=>true,
						 'fileName'=>$fileName,
						 'maxFileSize'=>$maxFileSize);
		
		$fileObj = File::upload($request, 'filePath-'.$imageIndex, '/images/store/product/full', $options);
	}catch( FileException $e ){
	
		echo '<script>';
		echo 'window.parent.handleUploadFileFailure("'.$e->getMessage().'", '.($isProductItem?'true':'false').');';
		echo '</script>';
		exit;
	}catch( Exception $e ){
	
		exit;
	}
	
	$fileObj->createThumbnail('/images/store/product', 250, 250, 75);
	$fileObj->createThumbnail('/images/store/product/preview', 180, 180, 65);
	$fileObj->createThumbnail('/images/store/product/thumb', 40, 40, 50);
	
	$function = 'setImage'.$imageIndex;
	
	$genericObj->$function($fileObj->getFileName());
	$genericObj->save();
	
	$fileId   = $fileObj->getId();
	$fileName = $fileObj->getFileName();
	
	echo '<script>';
	echo 'window.parent.handleUploadFileSuccessProductImage("'.$fileName.'", '.$imageIndex.', '.($isProductItem?'true':'false').');';
	echo '</script>';
	
  	exit;
  }
  
  public function executeDeleteImage($request){
	
	$imageIndex    = $request->getParameter('imageIndex');
	$productId     = $request->getParameter('productItemId');
	$isProductItem = !empty($productItemId);
	
	if( $productItemId )
		$genericObj = ProductItemPeer::retrieveByPK($productItemId);
	else
		$genericObj = ProductPeer::retrieveByPK($this->productId);
	
	$function = 'setImage'.$imageIndex;
	
	$genericObj->$function(null);
	$genericObj->save();
	
  	exit;
  }
}
