<?php

/**
 * Subclasse de representação de objetos da tabela 'cash_table_player_buyin'.
 *
 * 
 *
 * @package ...apps.backend.lib.model
 */ 
class CashTablePlayerBuyin extends BaseCashTablePlayerBuyin
{
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

			parent::save();
			
        	Log::quickLog('cash_table_player_buyin', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('cash_table_player_buyin', $this->getPrimaryKey(), $e);
        }
    }
    
    public function addCheck($checkInfo, $con=null){
    	
    	$clubCheckObj = new ClubCheck();
    	$clubCheckObj->setClubId($this->getCashTable()->getClubId());
    	$clubCheckObj->setCashTableId($this->getCashTableId());
    	$clubCheckObj->setCashTableSessionId($this->getCashTableSessionId());
    	$clubCheckObj->setPeopleId($this->getPeopleId());
    	$clubCheckObj->setCheckNumber($checkInfo['checkNumber']);
    	$clubCheckObj->setCheckNominal($checkInfo['checkNominal']);
    	$clubCheckObj->setCheckBank($checkInfo['checkBank']);
    	$clubCheckObj->setCheckDate(Util::formatDate($checkInfo['checkDate']));
    	$clubCheckObj->save($con);
    	
    	$this->setClubCheckId($clubCheckObj->getId());
    }
}
