<?php

/**
 * discountCoupon actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class discountCouponActions extends sfActions
{

  public function preExecute(){
    
    $this->discountCouponId = $this->getRequestParameter('id');
    $this->discountCouponId = $this->getRequestParameter('discountCouponId', $this->discountCouponId);
    
    $this->pathList = array('Cupons de desconto'=>'discountCoupon/index');
    $this->toolbarList = array('new');
  }

  public function executeIndex($request){
    
  }

  public function executeUpload($request){
    
  }

  public function executeNew($request){
  	
    $this->discountCouponObj = Util::getNewObject('discountCoupon');
    
    $this->pathList['Novo cupom'] = '#';
    $this->setTemplate('edit');
    
    $this->toolbarList = array('new', 'save');
  }
  
  public function executeEdit($request){
    
    $this->discountCouponObj = $discountCouponObj = DiscountCouponPeer::retrieveByPK($this->discountCouponId);
    
    if( !is_object($discountCouponObj) )
    	return $this->redirect('discountCoupon/index');
    	
    if( $discountCouponObj->getHasUsed() )
    	return $this->forward('discountCoupon', 'view');
    	
    $this->pathList[$discountCouponObj->getCouponCode()] = '#';
    
    $isAdmin = $this->getUser()->hasCredential('iRankAdmin');
    
    if( $this->discountCouponIdAttribute && !$isAdmin )
    	$this->toolbarList = array('save');
    else
    	$this->toolbarList = array('new', 'save', 'delete');
  }

  public function executeView($request){
    
    $this->discountCouponObj = $discountCouponObj = DiscountCouponPeer::retrieveByPK($this->discountCouponId);
    
    if( !is_object($discountCouponObj) )
    	return $this->redirect('discountCoupon/index');
    	
    $this->pathList[$discountCouponObj->getCouponCode()] = '#';
   	$this->toolbarList = array();
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){
    
    $discountCouponObj = DiscountCouponPeer::retrieveByPK($this->discountCouponId);
    
    $discountCouponObj->quickSave($request);
    
    exit;
  }

  public function executeDelete($request){
    
    if( empty($this->discountCouponId) )
    	Util::forceError('!Nenhum registro foi selecionado!');
    
    try{
    	
	    $criteria = new Criteria();
	    $criteria->add( DiscountCouponPeer::ID, $this->discountCouponId, Criteria::IN );
	    $criteria->add( DiscountCouponPeer::VISIBLE, true );
	    $criteria->add( DiscountCouponPeer::ENABLED, true );
	    $criteria->add( DiscountCouponPeer::DELETED, false );
    	$discountCouponObjList = DiscountCouponPeer::doSelect($criteria);
    	
    	$discountCouponIdList = array();
    	foreach($discountCouponObjList as $discountCouponObj){
    		
    		$discountCouponObj->delete();
	    	$discountCouponIdList[] = $discountCouponObj->getId();
    	}
    	
    	echo implode(',', $discountCouponIdList);
    }catch(Exception $e){
    	
    	Util::forceError($e->getMessage());
    }
    
    exit;
  }
}
