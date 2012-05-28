<?php

/**
 * Subclasse de representação de objetos da tabela 'cash_table_dealer'.
 *
 * 
 *
 * @package ...apps.backend.lib.model
 */ 
class CashTableDealer extends BaseCashTableDealer
{

	public function cashout($cashoutValue, $con=null){
		
		if( !is_null($this->getCheckoutAt()) )
			throw new Exception('Este dealer já foi removido da mesa!');
			
		$cashTableObj = $this->getCashTable();
		
		$currentValue = $cashTableObj->getCurrentValue(false);
		
		if( $cashoutValue > $currentValue )
			throw new Exception("O valor informado é maior que o saldo da mesa.\nO limite para cashout é de ".Util::formatFloat($currentValue, true)."!");
		
		if( is_null($con) )
			$con = Propel::getConnection();
		
		$con->begin();
		
		try{
			
			$cashTableObj->setPeopleIdDealer(null);
			$cashTableObj->save($con);
			
			$this->setCashoutValue($cashoutValue);
			$this->setCheckoutAt(time());
			$this->save($con);
			
	    	$con->commit();
	    	
	    	return true;
		}catch(Exception $e){
			
			$con->rollback();
			
			return false;
		}
	}
}
