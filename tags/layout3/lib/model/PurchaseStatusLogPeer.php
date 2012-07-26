<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'purchase_status_log'.
 *
 * 
 *
 * @package lib.model
 */ 
class PurchaseStatusLogPeer extends BasePurchaseStatusLogPeer
{
	
	public static function retrieveByCode($transactionCode){
		
		$criteria = new Criteria();
		$criteria->add( PurchaseStatusLogPeer::TRANSACTION_CODE, $transactionCode );
		return PurchaseStatusLogPeer::doSelectOne( $criteria );
	}
}
