<?php



class CashTableSessionMapBuilder {

	
	const CLASS_NAME = '...apps.backend.lib.model.map.CashTableSessionMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('cash_table_session');
		$tMap->setPhpName('CashTableSession');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('cash_table_session_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('CASH_TABLE_ID', 'CashTableId', 'int', CreoleTypes::INTEGER, 'cash_table', 'ID', false, null);

		$tMap->addColumn('OPENED_AT', 'OpenedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CLOSED_AT', 'ClosedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addForeignKey('USER_ADMIN_ID_OPEN', 'UserAdminIdOpen', 'int', CreoleTypes::INTEGER, 'user_admin', 'ID', false, null);

		$tMap->addForeignKey('USER_ADMIN_ID_CLOSE', 'UserAdminIdClose', 'int', CreoleTypes::INTEGER, 'user_admin', 'ID', false, null);

		$tMap->addColumn('TOTAL_PLAYERS', 'TotalPlayers', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TOTAL_DEALERS', 'TotalDealers', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('DEALER_START_POSITION', 'DealerStartPosition', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('VISIBLE', 'Visible', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 