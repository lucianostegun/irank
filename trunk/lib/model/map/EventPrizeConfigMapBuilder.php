<?php



class EventPrizeConfigMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EventPrizeConfigMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('event_prize_config');
		$tMap->setPhpName('EventPrizeConfig');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('EVENT_ID', 'EventId', 'int' , CreoleTypes::INTEGER, 'event', 'ID', true, null);

		$tMap->addPrimaryKey('EVENT_POSITION', 'EventPosition', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PRIZE_VALUE', 'PrizeValue', 'double', CreoleTypes::FLOAT, false, null);

	} 
} 