<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'purchase_transaction_log'.
 *
 * 
 *
 * @package lib.model
 */ 
class PurchaseTransactionLogPeer extends BasePurchaseTransactionLogPeer
{
	
	public static function retrieveByCode($transactionCode){
		
		$criteria = new Criteria();
		$criteria->add( PurchaseTransactionLogPeer::TRANSACTION_CODE, $transactionCode );
		return PurchaseTransactionLogPeer::doSelectOne( $criteria );
	}
}
