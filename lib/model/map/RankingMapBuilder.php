<?php



class RankingMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.RankingMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('ranking');
		$tMap->setPhpName('Ranking');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('ranking_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('RANKING_NAME', 'RankingName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('RANKING_TAG', 'RankingTag', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addForeignKey('USER_SITE_ID', 'UserSiteId', 'int', CreoleTypes::INTEGER, 'user_site', 'ID', false, null);

		$tMap->addForeignKey('RANKING_TYPE_ID', 'RankingTypeId', 'int', CreoleTypes::INTEGER, 'virtual_table', 'ID', false, null);

		$tMap->addForeignKey('GAME_STYLE_ID', 'GameStyleId', 'int', CreoleTypes::INTEGER, 'virtual_table', 'ID', true, null);

		$tMap->addColumn('START_DATE', 'StartDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('FINISH_DATE', 'FinishDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('IS_PRIVATE', 'IsPrivate', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DEFAULT_BUYIN', 'DefaultBuyin', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('PLAYERS', 'Players', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('EVENTS', 'Events', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SCORE_SCHEMA', 'ScoreSchema', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('SCORE_FORMULA', 'ScoreFormula', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('VISIBLE', 'Visible', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('LOCKED', 'Locked', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 