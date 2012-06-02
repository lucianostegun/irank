<?php



class ClubCheckMapBuilder {

	
	const CLASS_NAME = '...apps.backend.lib.model.map.ClubCheckMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('club_check');
		$tMap->setPhpName('ClubCheck');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('club_check_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('CLUB_ID', 'ClubId', 'int', CreoleTypes::INTEGER, 'club', 'ID', false, null);

		$tMap->addForeignKey('CASH_TABLE_ID', 'CashTableId', 'int', CreoleTypes::INTEGER, 'cash_table', 'ID', false, null);

		$tMap->addForeignKey('CASH_TABLE_SESSION_ID', 'CashTableSessionId', 'int', CreoleTypes::INTEGER, 'cash_table_session', 'ID', false, null);

		$tMap->addForeignKey('PEOPLE_ID', 'PeopleId', 'int', CreoleTypes::INTEGER, 'people', 'ID', false, null);

		$tMap->addColumn('CHECK_NUMBER', 'CheckNumber', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CHECK_NOMINAL', 'CheckNominal', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CHECK_BANK', 'CheckBank', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CHECK_DATE', 'CheckDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('IS_PENDING', 'IsPending', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 