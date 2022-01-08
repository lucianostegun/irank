<?php



class NewsI18nMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.NewsI18nMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('news_i18n');
		$tMap->setPhpName('NewsI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('NEWS_ID', 'NewsId', 'int' , CreoleTypes::INTEGER, 'news', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'Culture', 'string', CreoleTypes::CHAR, true, null);

		$tMap->addColumn('NEWS_TITLE_I18N', 'NewsTitleI18n', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('DESCRIPTION_I18N', 'DescriptionI18n', 'string', CreoleTypes::VARCHAR, false, null);

	} 
} 