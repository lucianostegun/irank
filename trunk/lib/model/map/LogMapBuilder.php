<?php



class LogMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.LogMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap('log');

		$tMap = $this->dbMap->addTable('log');
		$tMap->setPhpName('Log');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('log_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('USER_SITE_ID', 'UserSiteId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('USER_ADMIN_ID', 'UserAdminId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('APP', 'App', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('MODULE_NAME', 'ModuleName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('ACTION_NAME', 'ActionName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CLASS_NAME', 'ClassName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('SEVERITY', 'Severity', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('MESSAGE', 'Message', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 