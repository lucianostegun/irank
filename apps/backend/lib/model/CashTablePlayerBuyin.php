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
    
    public function getPayMethod(){
    	
    	return $this->getVirtualTable();
    }
}
