<?php



class EventLivePlayerScoreMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EventLivePlayerScoreMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('event_live_player_score');
		$tMap->setPhpName('EventLivePlayerScore');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('EVENT_LIVE_ID', 'EventLiveId', 'int' , CreoleTypes::INTEGER, 'event_live', 'ID', true, null);

		$tMap->addForeignPrimaryKey('PEOPLE_ID', 'PeopleId', 'int' , CreoleTypes::INTEGER, 'people', 'ID', true, null);

		$tMap->addColumn('LABEL', 'Label', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('SCORE', 'Score', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('ORDER_SEQ', 'OrderSeq', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 