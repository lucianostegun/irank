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
	
	public static function retrieveByOrderNumber($orderNumber, $userSiteId=null){
		
		$criteria = new Criteria();
		$criteria->add( PurchasePeer::ORDER_NUMBER, $orderNumber );
		if( $userSiteId )
			$criteria->add( PurchasePeer::USER_SITE_ID, $userSiteId );
			
		return PurchasePeer::doSelectOne($criteria);
	}
}
