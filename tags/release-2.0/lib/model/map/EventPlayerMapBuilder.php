<?php



class EventPlayerMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EventPlayerMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('event_player');
		$tMap->setPhpName('EventPlayer');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('EVENT_ID', 'EventId', 'int' , CreoleTypes::INTEGER, 'event', 'ID', true, null);

		$tMap->addForeignPrimaryKey('PEOPLE_ID', 'PeopleId', 'int' , CreoleTypes::INTEGER, 'people', 'ID', true, null);

		$tMap->addColumn('SHARE_ID', 'ShareId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ENTRANCE_FEE', 'EntranceFee', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('BUYIN', 'Buyin', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('REBUY', 'Rebuy', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('ADDON', 'Addon', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('EVENT_POSITION', 'EventPosition', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SCORE', 'Score', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('PRIZE', 'Prize', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('CONFIRM_CODE', 'ConfirmCode', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('INVITE_STATUS', 'InviteStatus', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('ALLOW_EDIT', 'AllowEdit', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 