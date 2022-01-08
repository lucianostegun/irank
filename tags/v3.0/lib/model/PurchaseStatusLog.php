<?php

/**
 * Subclasse de representação de objetos da tabela 'purchase_status_log'.
 *
 * 
 *
 * @package lib.model
 */ 
class PurchaseStatusLog extends BasePurchaseStatusLog
{
	
	public static function getList(Criteria $criteria=null){
		
		if( is_null($criteria) )
			$criteria = new Criteria();
			
		$criteria->addDescendingOrderByColumn( PurchaseStatusLogPeer::CREATED_AT );
		
		return PurchaseStatusLogPeer::doSelect($criteria);
	}
}
