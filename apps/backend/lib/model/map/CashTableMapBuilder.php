<?php



class CashTableMapBuilder {

	
	const CLASS_NAME = '...apps.backend.lib.model.map.CashTableMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('cash_table');
		$tMap->setPhpName('CashTable');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('cash_table_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('CLUB_ID', 'ClubId', 'int', CreoleTypes::INTEGER, 'club', 'ID', false, null);

		$tMap->addForeignKey('PEOPLE_ID_DEALER', 'PeopleIdDealer', 'int', CreoleTypes::INTEGER, 'people', 'ID', false, null);

		$tMap->addForeignKey('GAME_TYPE_ID', 'GameTypeId', 'int', CreoleTypes::INTEGER, 'virtual_table', 'ID', false, null);

		$tMap->addColumn('CASH_TABLE_NAME', 'CashTableName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('TABLE_STATUS', 'TableStatus', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('PLAYERS', 'Players', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SEATS', 'Seats', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ENTRANCE_FEE', 'EntranceFee', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('BUYIN', 'Buyin', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('COMMENTS', 'Comments', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('LAST_OPENED_AT', 'LastOpenedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addForeignKey('CASH_TABLE_SESSION_ID', 'CashTableSessionId', 'int', CreoleTypes::INTEGER, 'cash_table_session', 'ID', false, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('VISIBLE', 'Visible', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('LOCKED', 'Locked', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 