<?php



class EventLiveScheduleMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EventLiveScheduleMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('event_live_schedule');
		$tMap->setPhpName('EventLiveSchedule');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('ID', 'Id', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addForeignPrimaryKey('EVENT_LIVE_ID', 'EventLiveId', 'int' , CreoleTypes::INTEGER, 'event_live', 'ID', true, null);

		$tMap->addPrimaryKey('EVENT_DATE', 'EventDate', 'int', CreoleTypes::DATE, true, null);

		$tMap->addPrimaryKey('START_TIME', 'StartTime', 'int', CreoleTypes::TIME, true, null);

		$tMap->addColumn('EVENT_DATE_TIME', 'EventDateTime', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('DAYS_AFTER', 'DaysAfter', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('STEP_DAY', 'StepDay', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 