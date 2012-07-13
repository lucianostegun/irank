<?php



class NewsMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.NewsMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('news');
		$tMap->setPhpName('News');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('news_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NEWS_DATE', 'NewsDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('NEWS_TITLE', 'NewsTitle', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('INTERNAL_LINK', 'InternalLink', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('VISIBLE', 'Visible', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('LOCKED', 'Locked', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 