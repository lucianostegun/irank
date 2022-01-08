<?php



class AccessAdminLogMapBuilder {

	
	const CLASS_NAME = '...apps.backend.lib.model.map.AccessAdminLogMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('access_admin_log');
		$tMap->setPhpName('AccessAdminLog');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('USER_ADMIN_ID', 'UserAdminId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('IP_ADDRESS', 'IpAddress', 'string', CreoleTypes::VARCHAR, false, null);

	} 
} 