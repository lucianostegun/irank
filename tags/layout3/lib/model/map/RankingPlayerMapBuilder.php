<?php



class RankingPlayerMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.RankingPlayerMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('ranking_player');
		$tMap->setPhpName('RankingPlayer');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('RANKING_ID', 'RankingId', 'int' , CreoleTypes::INTEGER, 'ranking', 'ID', true, null);

		$tMap->addForeignPrimaryKey('PEOPLE_ID', 'PeopleId', 'int' , CreoleTypes::INTEGER, 'people', 'ID', true, null);

		$tMap->addColumn('TOTAL_EVENTS', 'TotalEvents', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TOTAL_SCORE', 'TotalScore', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('TOTAL_PAID', 'TotalPaid', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('TOTAL_PRIZE', 'TotalPrize', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('TOTAL_BALANCE', 'TotalBalance', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('TOTAL_AVERAGE', 'TotalAverage', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('ALLOW_EDIT', 'AllowEdit', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('SUPPRESS_EMAIL_NOTIFY', 'SuppressEmailNotify', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('SUPPRESS_SMS_NOTIFY', 'SuppressSmsNotify', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 