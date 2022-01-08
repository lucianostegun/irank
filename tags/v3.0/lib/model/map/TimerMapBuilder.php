<?php



class TimerMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TimerMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('timer');
		$tMap->setPhpName('Timer');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('timer_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('USER_SITE_ID', 'UserSiteId', 'int', CreoleTypes::INTEGER, 'user_site', 'ID', false, null);

		$tMap->addColumn('TIMER_NAME', 'TimerName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('DEFAULT_DURATION', 'DefaultDuration', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('LEVELS', 'Levels', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PLAY_SOUND', 'PlaySound', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('MINUTE_ALERT', 'MinuteAlert', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CONFIRM_LEVEL', 'ConfirmLevel', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('HAS_ANTE', 'HasAnte', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 