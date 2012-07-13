<?php



class EventCommentMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EventCommentMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('event_comment');
		$tMap->setPhpName('EventComment');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('event_comment_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('EVENT_ID', 'EventId', 'int', CreoleTypes::INTEGER, 'event', 'ID', false, null);

		$tMap->addForeignKey('PEOPLE_ID', 'PeopleId', 'int', CreoleTypes::INTEGER, 'people', 'ID', false, null);

		$tMap->addColumn('COMMENT', 'Comment', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 