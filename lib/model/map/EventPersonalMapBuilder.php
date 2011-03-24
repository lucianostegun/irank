<?php



class EventPersonalMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EventPersonalMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('event_personal');
		$tMap->setPhpName('EventPersonal');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('event_personal_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('USER_SITE_ID', 'UserSiteId', 'int', CreoleTypes::INTEGER, 'user_site', 'ID', false, null);

		$tMap->addForeignKey('GAME_STYLE_ID', 'GameStyleId', 'int', CreoleTypes::INTEGER, 'virtual_table', 'ID', false, null);

		$tMap->addColumn('EVENT_NAME', 'EventName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('EVENT_PLACE', 'EventPlace', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('EVENT_POSITION', 'EventPosition', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('BUYIN', 'Buyin', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('REBUY', 'Rebuy', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('ADDON', 'Addon', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('PRIZE', 'Prize', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('PAID_PLACES', 'PaidPlaces', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('EVENT_DATE', 'EventDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('COMMENTS', 'Comments', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('PLAYERS', 'Players', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('VISIBLE', 'Visible', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('LOCKED', 'Locked', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 