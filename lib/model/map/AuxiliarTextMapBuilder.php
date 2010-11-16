<?php



class AuxiliarTextMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.AuxiliarTextMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('auxiliar_text');
		$tMap->setPhpName('AuxiliarText');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('auxiliar_text_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, false, 150);

		$tMap->addForeignKey('FILE_ID', 'FileId', 'int', CreoleTypes::INTEGER, 'file', 'ID', false, null);

		$tMap->addColumn('TAG_NAME', 'TagName', 'string', CreoleTypes::VARCHAR, false, 30);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('VISIBLE', 'Visible', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('LOCKED', 'Locked', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 