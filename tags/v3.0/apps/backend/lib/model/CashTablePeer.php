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
		
		if( !in_array($saveAction, array('cashout', 'cashoutDealer', 'seatDealer')) && $buyin < $cashTableObj->getBuyin() )
			MyTools::setError('buyin', 'Informe um valor maior que '.$cashTableObj->getBuyin());
		
		return !MyTools::getRequest()->hasErrors();
	}
	
	public static function validateCheckFields($payMethodId){
		
		$payMethodIdDatedCheck = VirtualTable::getIdByTagName('payMethod', 'datedCheck');
		
		if( $payMethodId!=$payMethodIdDatedCheck )
			return true;
	
		$checkDate = MyTools::getRequestParameter('checkNumber');
		
		return !empty($checkDate);		
	}

	public static function validateRequiredFields($cashTableId){
		
		$saveAction = MyTools::getRequestParameter('saveAction');
		
		if( in_array($saveAction, array('seatPlayer', 'rebuy')) ){
			
			$payMethodId = MyTools::getRequestParameter('saveAction');
			if( !$payMethodId )
				MyTools::setError('payMethodId', 'Informe a forma de pagamento');
		}
		
		return !MyTools::getRequest()->hasErrors();
	}
}
