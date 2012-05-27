<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'cash_table'.
 *
 * 
 *
 * @package ...apps.backend.lib.model
 */ 
class CashTablePeer extends BaseCashTablePeer
{
	
	public static function validateBuyin($buyin){
		
		$cashTableId  = MyTools::getRequestParameter('cashTableId');
		$saveAction   = MyTools::getRequestParameter('saveAction');
		$cashTableObj = CashTablePeer::retrieveByPK($cashTableId);
		
		$buyin = Util::formatFloat($buyin);
		
		if( !in_array($saveAction, array('cashout', 'seatDealer')) && $buyin < $cashTableObj->getBuyin() )
			MyTools::setError('buyin', 'Informe um valor maior que '.$cashTableObj->getBuyin());
		
		return !MyTools::getRequest()->hasErrors();
	}
}
