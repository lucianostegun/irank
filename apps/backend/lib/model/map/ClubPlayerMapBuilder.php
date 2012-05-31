<?php



class ClubPlayerMapBuilder {

	
	const CLASS_NAME = '...apps.backend.lib.model.map.ClubPlayerMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('club_player');
		$tMap->setPhpName('ClubPlayer');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CLUB_ID', 'ClubId', 'int' , CreoleTypes::INTEGER, 'club', 'ID', true, null);

		$tMap->addForeignPrimaryKey('PEOPLE_ID', 'PeopleId', 'int' , CreoleTypes::INTEGER, 'people', 'ID', true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 