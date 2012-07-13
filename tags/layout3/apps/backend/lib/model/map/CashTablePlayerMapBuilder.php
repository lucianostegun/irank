<?php



class CashTablePlayerMapBuilder {

	
	const CLASS_NAME = '...apps.backend.lib.model.map.CashTablePlayerMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('cash_table_player');
		$tMap->setPhpName('CashTablePlayer');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('cash_table_player_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('CASH_TABLE_ID', 'CashTableId', 'int', CreoleTypes::INTEGER, 'cash_table', 'ID', false, null);

		$tMap->addForeignKey('CASH_TABLE_SESSION_ID', 'CashTableSessionId', 'int', CreoleTypes::INTEGER, 'cash_table_session', 'ID', false, null);

		$tMap->addForeignKey('PEOPLE_ID', 'PeopleId', 'int', CreoleTypes::INTEGER, 'people', 'ID', false, null);

		$tMap->addColumn('TABLE_POSITION', 'TablePosition', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TOTAL_BUYIN', 'TotalBuyin', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('TOTAL_ENTRANCE_FEE', 'TotalEntranceFee', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('CASHOUT_VALUE', 'CashoutValue', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('CHECKIN_AT', 'CheckinAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CHECKOUT_AT', 'CheckoutAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 