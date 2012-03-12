<?php



class EventPhotoContestMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EventPhotoContestMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('event_photo_contest');
		$tMap->setPhpName('EventPhotoContest');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('event_photo_contest_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('EVENT_PHOTO_ID_LEFT', 'EventPhotoIdLeft', 'int', CreoleTypes::INTEGER, 'event_photo', 'ID', true, null);

		$tMap->addForeignKey('EVENT_PHOTO_ID_RIGHT', 'EventPhotoIdRight', 'int', CreoleTypes::INTEGER, 'event_photo', 'ID', true, null);

		$tMap->addForeignKey('EVENT_PHOTO_ID_WINNER', 'EventPhotoIdWinner', 'int', CreoleTypes::INTEGER, 'event_photo', 'ID', true, null);

		$tMap->addColumn('LOCK_KEY', 'LockKey', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('IP_ADDRESS', 'IpAddress', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 