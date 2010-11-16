<?php



class ConfigMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ConfigMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('config');
		$tMap->setPhpName('Config');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CONFIG_NAME', 'ConfigName', 'string', CreoleTypes::VARCHAR, true, 50);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, false, 150);

		$tMap->addColumn('CONFIG_VALUE', 'ConfigValue', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 