<?php



class RankingLiveTemplateMapBuilder {

	
	const CLASS_NAME = '...apps.backend.lib.model.map.RankingLiveTemplateMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('ranking_live_template');
		$tMap->setPhpName('RankingLiveTemplate');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('RANKING_LIVE_ID', 'RankingLiveId', 'int' , CreoleTypes::INTEGER, 'ranking_live', 'ID', true, null);

		$tMap->addPrimaryKey('DAYS_AFTER', 'DaysAfter', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addPrimaryKey('START_TIME', 'StartTime', 'int', CreoleTypes::TIME, true, null);

		$tMap->addColumn('STEP_DAY', 'StepDay', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 