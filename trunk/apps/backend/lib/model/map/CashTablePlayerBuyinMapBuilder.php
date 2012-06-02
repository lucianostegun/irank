<?php



class CashTablePlayerBuyinMapBuilder {

	
	const CLASS_NAME = '...apps.backend.lib.model.map.CashTablePlayerBuyinMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('cash_table_player_buyin');
		$tMap->setPhpName('CashTablePlayerBuyin');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('cash_table_player_buyin_SEQ');

		$tMap->addColumn('ID', 'Id', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addForeignPrimaryKey('CASH_TABLE_ID', 'CashTableId', 'int' , CreoleTypes::INTEGER, 'cash_table', 'ID', true, null);

		$tMap->addForeignPrimaryKey('CASH_TABLE_SESSION_ID', 'CashTableSessionId', 'int' , CreoleTypes::INTEGER, 'cash_table_session', 'ID', true, null);

		$tMap->addForeignPrimaryKey('PEOPLE_ID', 'PeopleId', 'int' , CreoleTypes::INTEGER, 'people', 'ID', true, null);

		$tMap->addForeignKey('PAY_METHOD_ID', 'PayMethodId', 'int', CreoleTypes::INTEGER, 'virtual_table', 'ID', false, null);

		$tMap->addForeignKey('CLUB_CHECK_ID', 'ClubCheckId', 'int', CreoleTypes::INTEGER, 'club_check', 'ID', false, null);

		$tMap->addColumn('BUYIN', 'Buyin', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('ENTRANCE_FEE', 'EntranceFee', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 