<?php

/**
 * Subclasse de representação de objetos da tabela 'cash_table_session'.
 *
 * 
 *
 * @package ...apps.backend.lib.model
 */ 
class CashTableSession extends BaseCashTableSession
{
	
    public function delete($con=null){
		
		$this->setVisible(false);
		$this->setDeleted(true);
		$this->save();
	}
	
	public function getCode(){
		
		return '#'.sprintf('%04d', $this->getId());
	}
}
