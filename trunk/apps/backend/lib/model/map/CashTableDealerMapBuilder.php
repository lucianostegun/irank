<?php



class CashTableDealerMapBuilder {

	
	const CLASS_NAME = '...apps.backend.lib.model.map.CashTableDealerMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('cash_table_dealer');
		$tMap->setPhpName('CashTableDealer');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('cash_table_dealer_SEQ');

		$tMap->addColumn('ID', 'Id', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addForeignPrimaryKey('CASH_TABLE_ID', 'CashTableId', 'int' , CreoleTypes::INTEGER, 'cash_table', 'ID', true, null);

		$tMap->addForeignPrimaryKey('CASH_TABLE_SESSION_ID', 'CashTableSessionId', 'int' , CreoleTypes::INTEGER, 'cash_table_session', 'ID', true, null);

		$tMap->addForeignPrimaryKey('PEOPLE_ID', 'PeopleId', 'int' , CreoleTypes::INTEGER, 'people', 'ID', true, null);

		$tMap->addColumn('CASHOUT_VALUE', 'CashoutValue', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('CHECKIN_AT', 'CheckinAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CHECKOUT_AT', 'CheckoutAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 