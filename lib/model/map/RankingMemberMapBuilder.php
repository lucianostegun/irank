<?php



class RankingMemberMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.RankingMemberMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('ranking_member');
		$tMap->setPhpName('RankingMember');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('RANKING_ID', 'RankingId', 'int' , CreoleTypes::INTEGER, 'ranking', 'ID', true, null);

		$tMap->addForeignPrimaryKey('PEOPLE_ID', 'PeopleId', 'int' , CreoleTypes::INTEGER, 'people', 'ID', true, null);

		$tMap->addColumn('EVENTS', 'Events', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SCORE', 'Score', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 