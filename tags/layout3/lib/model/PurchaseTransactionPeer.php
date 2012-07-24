<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'purchase_transaction'.
 *
 * 
 *
 * @package lib.model
 */ 
class PurchaseTransactionPeer extends BasePurchaseTransactionPeer
{
	
	public static function retrieveByCode($transactionCode){
		
		$criteria = new Criteria();
		$criteria->add( PurchaseTransactionPeer::TRANSACTION_CODE, $transactionCode );
		return PurchaseTransactionPeer::doSelectOne( $criteria );
	}
}
