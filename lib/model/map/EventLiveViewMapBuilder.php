<?php



class EventLiveViewMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EventLiveViewMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('event_live_view');
		$tMap->setPhpName('EventLiveView');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('RANKING_LIVE_ID', 'RankingLiveId', 'int', CreoleTypes::INTEGER, 'ranking_live', 'ID', false, null);

		$tMap->addForeignKey('CLUB_ID', 'ClubId', 'int', CreoleTypes::INTEGER, 'club', 'ID', false, null);

		$tMap->addColumn('EVENT_NAME', 'EventName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('EVENT_DATE', 'EventDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('START_TIME', 'StartTime', 'int', CreoleTypes::TIME, false, null);

		$tMap->addColumn('EVENT_DATE_TIME', 'EventDateTime', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('STEP_NUMBER', 'StepNumber', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('COMMENTS', 'Comments', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('IS_FREEROLL', 'IsFreeroll', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('IS_MULTIDAY', 'IsMultiday', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('IS_SATELLITE', 'IsSatellite', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('BUYIN', 'Buyin', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('ENTRANCE_FEE', 'EntranceFee', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('GUARANTEED_PRIZE', 'GuaranteedPrize', 'double', CreoleTypes::NUMERIC, false, 5);

		$tMap->addColumn('BLIND_TIME', 'BlindTime', 'int', CreoleTypes::TIME, false, null);

		$tMap->addColumn('STACK_CHIPS', 'StackChips', 'double', CreoleTypes::DOUBLE, false, null);

		$tMap->addColumn('PLAYERS', 'Players', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ALLOWED_REBUYS', 'AllowedRebuys', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ALLOWED_ADDONS', 'AllowedAddons', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('IS_ILIMITED_REBUYS', 'IsIlimitedRebuys', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('SAVED_RESULT', 'SavedResult', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('SUPPRESS_SCHEDULE', 'SuppressSchedule', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('SCHEDULE_START_DATE', 'ScheduleStartDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('ENROLLMENT_START_DATE', 'EnrollmentStartDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('ENROLLMENT_MODE', 'EnrollmentMode', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('SUPPRESS_RANKING', 'SuppressRanking', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 