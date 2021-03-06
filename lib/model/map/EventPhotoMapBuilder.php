<?php



class EventPhotoMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EventPhotoMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('event_photo');
		$tMap->setPhpName('EventPhoto');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('event_photo_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('EVENT_ID', 'EventId', 'int', CreoleTypes::INTEGER, 'event', 'ID', false, null);

		$tMap->addForeignKey('FILE_ID', 'FileId', 'int', CreoleTypes::INTEGER, 'file', 'ID', false, null);

		$tMap->addForeignKey('PEOPLE_ID', 'PeopleId', 'int', CreoleTypes::INTEGER, 'people', 'ID', false, null);

		$tMap->addColumn('IS_SHARED', 'IsShared', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('WIDTH', 'Width', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('HEIGHT', 'Height', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ORIENTATION', 'Orientation', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CONTEST_RUNS', 'ContestRuns', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CONTEST_WINS', 'ContestWins', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CONTEST_RATIO', 'ContestRatio', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 