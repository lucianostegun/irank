<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'cash_table_player'.
 *
 * 
 *
 * @package ...apps.backend.lib.model
 */ 
class CashTablePlayerPeer extends BaseCashTablePlayerPeer
{
	
	public static function retrieveByFields($cashTableId, $cashTableSessionId, $peopleId){
		
		$criteria = new Criteria();
		$criteria->add( CashTablePlayerPeer::CASH_TABLE_ID, $cashTableId );
		$criteria->add( CashTablePlayerPeer::CASH_TABLE_SESSION_ID, $cashTableSessionId );
		$criteria->add( CashTablePlayerPeer::PEOPLE_ID, $peopleId );
		return CashTablePlayerPeer::doSelectOne($criteria);
	}
}
