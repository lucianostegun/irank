<?php



class TimerLevelMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TimerLevelMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('timer_level');
		$tMap->setPhpName('TimerLevel');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('timer_level_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('TIMER_ID', 'TimerId', 'int', CreoleTypes::INTEGER, 'timer', 'ID', false, null);

		$tMap->addColumn('SMALL_BLIND', 'SmallBlind', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('BIG_BLIND', 'BigBlind', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ANTE', 'Ante', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('DURATION', 'Duration', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('IS_PAUSE', 'IsPause', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 