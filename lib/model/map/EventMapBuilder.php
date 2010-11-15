<?php



class EventMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EventMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('event');
		$tMap->setPhpName('Event');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('event_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('RANKING_ID', 'RankingId', 'int', CreoleTypes::INTEGER, 'ranking', 'ID', true, null);

		$tMap->addForeignKey('GAME_STYLE_ID', 'GameStyleId', 'int', CreoleTypes::INTEGER, 'virtual_table', 'ID', true, null);

		$tMap->addColumn('EVENT_NAME', 'EventName', 'string', CreoleTypes::VARCHAR, false, 25);

		$tMap->addColumn('EVENT_PLACE', 'EventPlace', 'string', CreoleTypes::VARCHAR, false, 250);

		$tMap->addColumn('BUY_IN', 'BuyIn', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('PAID_PLACES', 'PaidPlaces', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('EVENT_DATE', 'EventDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('START_TIME', 'StartTime', 'int', CreoleTypes::TIME, false, null);

		$tMap->addColumn('COMMENTS', 'Comments', 'string', CreoleTypes::VARCHAR, false, 140);

		$tMap->addColumn('SENT_EMAIL', 'SentEmail', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('INVITES', 'Invites', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('MEMBERS', 'Members', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('VISIBLE', 'Visible', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('LOCKED', 'Locked', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 