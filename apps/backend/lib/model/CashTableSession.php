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
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

			parent::save();
			
        	Log::quickLog('cash_table_session', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('cash_table_session', $this->getPrimaryKey(), $e);
        }
    }
	
	public function delete($con=null){
		
		$this->setVisible(false);
		$this->setDeleted(true);
		$this->save();
	}
	
	public function getCode(){
		
		return '#'.sprintf('%04d', $this->getId());
	}
}
