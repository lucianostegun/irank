<?php



class EventLiveMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EventLiveMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('event_live');
		$tMap->setPhpName('EventLive');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('event_live_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('RANKING_LIVE_ID', 'RankingLiveId', 'int', CreoleTypes::INTEGER, 'ranking_live', 'ID', true, null);

		$tMap->addColumn('EVENT_NAME', 'EventName', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('EVENT_SHORT_NAME', 'EventShortName', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('EVENT_DATE', 'EventDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('START_TIME', 'StartTime', 'int', CreoleTypes::TIME, false, null);

		$tMap->addColumn('EVENT_DATE_TIME', 'EventDateTime', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('COMMENTS', 'Comments', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('IS_FREEROLL', 'IsFreeroll', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addForeignKey('CLUB_ID', 'ClubId', 'int', CreoleTypes::INTEGER, 'club', 'ID', false, null);

		$tMap->addColumn('BUYIN', 'Buyin', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('ENTRANCE_FEE', 'EntranceFee', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('BLIND_TIME', 'BlindTime', 'int', CreoleTypes::TIME, false, null);

		$tMap->addColumn('STACK_CHIPS', 'StackChips', 'double', CreoleTypes::DOUBLE, false, null);

		$tMap->addColumn('PLAYERS', 'Players', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ALLOWED_REBUYS', 'AllowedRebuys', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ALLOWED_ADDONS', 'AllowedAddons', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('IS_ILIMITED_REBUYS', 'IsIlimitedRebuys', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('SAVED_RESULT', 'SavedResult', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('VISIBLE', 'Visible', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('LOCKED', 'Locked', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 