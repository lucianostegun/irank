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
		
		$purchaseObj = parent::retrieveByPK($purchaseId, $con);
		$userSiteId  = MyTools::getAttribute('userSiteId');
		
		if( is_object($purchaseObj) && $purchaseObj->getUserSiteId()!=$userSiteId )
			throw new Exception('Pedido não encontrado para este usuário');
			
		return $purchaseObj;
	}
	
	public static function retrieveByOrderNumber($orderNumber, $userSiteId=null){
		
		$criteria = new Criteria();
		$criteria->add( PurchasePeer::ORDER_NUMBER, $orderNumber );
		if( $userSiteId )
			$criteria->add( PurchasePeer::USER_SITE_ID, $userSiteId );
			
		$purchaseObj = PurchasePeer::doSelectOne($criteria);
		
		$userSiteId = MyTools::getAttribute('userSiteId');
		
		if( is_object($purchaseObj) && $purchaseObj->getUserSiteId()!=$userSiteId )
			throw new Exception('Pedido não encontrado para este usuário');
			
		return $purchaseObj;
	}
}
