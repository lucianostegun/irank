<?php



class ToolbarMapBuilder {

	
	const CLASS_NAME = '...apps.backend.lib.model.map.ToolbarMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('toolbar');
		$tMap->setPhpName('Toolbar');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('toolbar_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('MODULE_ID', 'ModuleId', 'int', CreoleTypes::INTEGER, 'module', 'ID', false, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('TAG_NAME', 'TagName', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('TAG_ID', 'TagId', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('IMAGE', 'Image', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('ACTION_NAME', 'ActionName', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('EXECUTE_MODULE', 'ExecuteModule', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('EXECUTE_ACTION', 'ExecuteAction', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('IS_JAVASCRIPT', 'IsJavascript', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('ORDER_SEQ', 'OrderSeq', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('START_DISABLED', 'StartDisabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('VISIBLE_ACTION', 'VisibleAction', 'string', CreoleTypes::VARCHAR, false, 30);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 