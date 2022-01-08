<?php



class EventLivePlayerDisclosureSmsMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EventLivePlayerDisclosureSmsMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('event_live_player_disclosure_sms');
		$tMap->setPhpName('EventLivePlayerDisclosureSms');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('EVENT_LIVE_ID', 'EventLiveId', 'int' , CreoleTypes::INTEGER, 'event_live', 'ID', true, null);

		$tMap->addForeignPrimaryKey('PEOPLE_ID', 'PeopleId', 'int' , CreoleTypes::INTEGER, 'people', 'ID', true, null);

		$tMap->addColumn('SMS_LOG_ID', 'SmsLogId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addForeignKey('SMS_ID', 'SmsId', 'int', CreoleTypes::INTEGER, 'sms', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 