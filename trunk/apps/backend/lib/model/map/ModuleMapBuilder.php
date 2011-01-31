<?php



class ModuleMapBuilder {

	
	const CLASS_NAME = '...apps.backend.lib.model.map.ModuleMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('module');
		$tMap->setPhpName('Module');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('module_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('MODULE_ID', 'ModuleId', 'int', CreoleTypes::INTEGER, 'module', 'ID', false, null);

		$tMap->addColumn('IS_MENU', 'IsMenu', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('TOOLBAR_DESCRIPTION', 'ToolbarDescription', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('IMAGE_MENU', 'ImageMenu', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('IMAGE_MODULE', 'ImageModule', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('EXECUTE_MODULE', 'ExecuteModule', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('EXECUTE_ACTION', 'ExecuteAction', 'string', CreoleTypes::VARCHAR, false, 15);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('MASTER_ONLY', 'MasterOnly', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('HAS_CHILD', 'HasChild', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('ORDER_SEQ', 'OrderSeq', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 