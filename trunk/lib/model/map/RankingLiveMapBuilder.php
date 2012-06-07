<?php



class RankingLiveMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.RankingLiveMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('ranking_live');
		$tMap->setPhpName('RankingLive');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('ranking_live_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('RANKING_NAME', 'RankingName', 'string', CreoleTypes::VARCHAR, false, 25);

		$tMap->addForeignKey('RANKING_TYPE_ID', 'RankingTypeId', 'int', CreoleTypes::INTEGER, 'virtual_table', 'ID', false, null);

		$tMap->addForeignKey('EMAIL_TEMPLATE_ID', 'EmailTemplateId', 'int', CreoleTypes::INTEGER, 'email_template', 'ID', false, null);

		$tMap->addColumn('START_DATE', 'StartDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('FINISH_DATE', 'FinishDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('IS_PRIVATE', 'IsPrivate', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('PLAYERS', 'Players', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('EVENTS', 'Events', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignKey('GAME_STYLE_ID', 'GameStyleId', 'int', CreoleTypes::INTEGER, 'virtual_table', 'ID', false, null);

		$tMap->addForeignKey('GAME_TYPE_ID', 'GameTypeId', 'int', CreoleTypes::INTEGER, 'virtual_table', 'ID', false, null);

		$tMap->addColumn('RANKING_TAG', 'RankingTag', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('SCORE_FORMULA_OPTION', 'ScoreFormulaOption', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('SCORE_FORMULA', 'ScoreFormula', 'string', CreoleTypes::VARCHAR, false, 250);

		$tMap->addColumn('FILE_NAME_LOGO', 'FileNameLogo', 'string', CreoleTypes::VARCHAR, false, 250);

		$tMap->addColumn('BUYIN', 'Buyin', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('ENTRANCE_FEE', 'EntranceFee', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('START_TIME', 'StartTime', 'int', CreoleTypes::TIME, false, null);

		$tMap->addColumn('IS_FREEROLL', 'IsFreeroll', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('BLIND_TIME', 'BlindTime', 'int', CreoleTypes::TIME, false, null);

		$tMap->addColumn('STACK_CHIPS', 'StackChips', 'double', CreoleTypes::DOUBLE, false, null);

		$tMap->addColumn('ALLOWED_REBUYS', 'AllowedRebuys', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ALLOWED_ADDONS', 'AllowedAddons', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TABLES_NUMBER', 'TablesNumber', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('IS_ILIMITED_REBUYS', 'IsIlimitedRebuys', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('PUBLISH_PRIZE', 'PublishPrize', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('PRIZE_SPLIT', 'PrizeSplit', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('RAKE_PERCENT', 'RakePercent', 'double', CreoleTypes::NUMERIC, false, 5);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('VISIBLE', 'Visible', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('LOCKED', 'Locked', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 