<?php



class EventLivePlayerMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EventLivePlayerMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('event_live_player');
		$tMap->setPhpName('EventLivePlayer');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('EVENT_LIVE_ID', 'EventLiveId', 'int' , CreoleTypes::INTEGER, 'event_live', 'ID', true, null);

		$tMap->addForeignPrimaryKey('PEOPLE_ID', 'PeopleId', 'int' , CreoleTypes::INTEGER, 'people', 'ID', true, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('EVENT_POSITION', 'EventPosition', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PRIZE', 'Prize', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 