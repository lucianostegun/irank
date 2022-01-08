<?php

/**
 * Subclasse de representação de objetos da tabela 'cash_table_player'.
 *
 * 
 *
 * @package ...apps.backend.lib.model
 */ 
class CashTablePlayer extends BaseCashTablePlayer
{
	
    public function addBuyin($buyin, $entranceFee, $payMethodId, $checkInfo, $con=null){
		
		if( is_null($con) )
			$con = Propel::getConnection();
		
		$con->begin();
		
		$payMethodIdCheck      = VirtualTable::getIdByTagName('payMethod', 'check');
		$payMethodIdDatedCheck = VirtualTable::getIdByTagName('payMethod', 'datedCheck');
		
		try{
			
			$this->setTotalBuyin($this->getTotalBuyin()+$buyin);
			$this->setTotalEntranceFee($this->getTotalEntranceFee()+$entranceFee);
			
			$cashTablePlayerBuyinObj = new CashTablePlayerBuyin();
			$cashTablePlayerBuyinObj->setCashTableId($this->getCashTableId());
			$cashTablePlayerBuyinObj->setCashTableSessionId($this->getCashTableSessionId());
			$cashTablePlayerBuyinObj->setCashTablePlayer($this);
			$cashTablePlayerBuyinObj->setPeopleId($this->getPeopleId());
			$cashTablePlayerBuyinObj->setBuyin($buyin);
			$cashTablePlayerBuyinObj->setPayMethodId($payMethodId);
			$cashTablePlayerBuyinObj->setEntranceFee($entranceFee);
			
			if( in_array($payMethodId, array($payMethodIdCheck, $payMethodIdDatedCheck)) )
	    		$cashTablePlayerBuyinObj->addCheck($checkInfo, $con);
			
	    	$cashTablePlayerBuyinObj->save($con);
	    	
	    	$con->commit();
	    	
	    	return true;
		}catch(Exception $e){
			
			$con->rollback();
			
			return false;
		}
	}

	public function cashout($cashoutValue, $con=null){
		
		if( !is_null($this->getCheckoutAt()) )
			throw new Exception('Este jogador já foi removido da mesa!');
			
		$cashTableObj = $this->getCashTable();
		
		$currentValue = $cashTableObj->getCurrentValue(false);
		
		if( $cashoutValue > $currentValue )
			throw new Exception("O valor informado é maior que o saldo da mesa.\nO limite para cashout é de ".Util::formatFloat($currentValue, true)."!");
		
		if( is_null($con) )
			$con = Propel::getConnection();
		
		$con->begin();
		
		try{
			
			$cashTableObj->setPlayers($cashTableObj->getPlayers()-1);
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
