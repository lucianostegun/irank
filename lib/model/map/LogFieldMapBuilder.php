<?php



class LogFieldMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.LogFieldMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('log_field');
		$tMap->setPhpName('LogField');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignKey('LOG_ID', 'LogId', 'int', CreoleTypes::INTEGER, 'log', 'ID', true, null);

		$tMap->addColumn('FIELD_NAME', 'FieldName', 'string', CreoleTypes::VARCHAR, false, 32);

		$tMap->addColumn('FIELD_VALUE', 'FieldValue', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 