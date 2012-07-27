<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'purchase'.
 *
 * 
 *
 * @package lib.model
 */ 
class PurchasePeer extends BasePurchasePeer
{
	
	public static function retrieveByPK($purchaseId, $con=null){
		
		$app = Util::getApp();

		$purchaseObj = parent::retrieveByPK($purchaseId, $con);
		$userSiteId  = MyTools::getAttribute('userSiteId');
		
		if( $app!='backend' && is_object($purchaseObj) && $purchaseObj->getUserSiteId()!=$userSiteId )
			throw new Exception('Pedido não encontrado para este usuário');
			
		return $purchaseObj;
	}
	
	public static function retrieveByOrderNumber($orderNumber, $userSiteId=null, $force=false){
		
		$criteria = new Criteria();
		$criteria->add( PurchasePeer::ORDER_NUMBER, $orderNumber );
		
		if( $userSiteId && !$force )
			$criteria->add( PurchasePeer::USER_SITE_ID, $userSiteId );
			
		$purchaseObj = PurchasePeer::doSelectOne($criteria);
		
		$userSiteId = MyTools::getAttribute('userSiteId');
		
		if( is_object($purchaseObj) && $purchaseObj->getUserSiteId()!=$userSiteId && !$force )
			throw new Exception('Pedido não encontrado para este usuário');
			
		return $purchaseObj;
	}
	
	public static function validateOrderStatus($orderStatus){
		
		$shippingDate = MyTools::getRequestParameter('shippingDate');
		$tracingCode  = MyTools::getRequestParameter('tracingCode');
		
		if( $orderStatus=='shipped' ){
			
			if( !$shippingDate )
				MyTools::setError('shippingDate', 'form.error.requiredField');

			if( !$tracingCode )
				MyTools::setError('tracingCode', 'form.error.requiredField');
		}
		
		return !MyTools::getRequest()->hasErrors();;
	}
}
