<?php



class RankingImportLogMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.RankingImportLogMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('ranking_import_log');
		$tMap->setPhpName('RankingImportLog');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('RANKING_ID', 'RankingId', 'int' , CreoleTypes::INTEGER, 'ranking', 'ID', true, null);

		$tMap->addForeignPrimaryKey('RANKING_ID_FROM', 'RankingIdFrom', 'int' , CreoleTypes::INTEGER, 'ranking', 'ID', true, null);

		$tMap->addPrimaryKey('IMPORT_TABLE', 'ImportTable', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addPrimaryKey('OBJECT_ID', 'ObjectId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 