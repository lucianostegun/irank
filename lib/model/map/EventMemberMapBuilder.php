<?php



class EventMemberMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EventMemberMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('event_member');
		$tMap->setPhpName('EventMember');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('EVENT_ID', 'EventId', 'int' , CreoleTypes::INTEGER, 'event', 'ID', true, null);

		$tMap->addForeignPrimaryKey('PEOPLE_ID', 'PeopleId', 'int' , CreoleTypes::INTEGER, 'people', 'ID', true, null);

		$tMap->addColumn('BUYIN', 'Buyin', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('REBUYS', 'Rebuys', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ADDONS', 'Addons', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('EVENT_POSITION', 'EventPosition', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PRIZE_VALUE', 'PrizeValue', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('EMAIL_SENT', 'EmailSent', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 