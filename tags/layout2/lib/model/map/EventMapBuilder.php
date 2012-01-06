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

		$tMap->addColumn('EVENT_NAME', 'EventName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addForeignKey('RANKING_PLACE_ID', 'RankingPlaceId', 'int', CreoleTypes::INTEGER, 'ranking_place', 'ID', true, null);

		$tMap->addColumn('BUYIN', 'Buyin', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('ENTRANCE_FEE', 'EntranceFee', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('PAID_PLACES', 'PaidPlaces', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('EVENT_DATE', 'EventDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('START_TIME', 'StartTime', 'int', CreoleTypes::TIME, false, null);

		$tMap->addColumn('EVENT_DATE_TIME', 'EventDateTime', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('COMMENTS', 'Comments', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('SENT_EMAIL', 'SentEmail', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('INVITES', 'Invites', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PLAYERS', 'Players', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SAVED_RESULT', 'SavedResult', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('IS_FREEROLL', 'IsFreeroll', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('PRIZE_POT', 'PrizePot', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('ALLOW_REBUY', 'AllowRebuy', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('ALLOW_ADDON', 'AllowAddon', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('VISIBLE', 'Visible', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('LOCKED', 'Locked', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 