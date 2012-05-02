<?php



class AccessAdminLogMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.AccessAdminLogMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('access_admin_log');
		$tMap->setPhpName('AccessAdminLog');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('USER_ADMIN_ID', 'UserAdminId', 'int' , CreoleTypes::INTEGER, 'user_admin', 'ID', true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('IP_ADDRESS', 'IpAddress', 'string', CreoleTypes::VARCHAR, false, null);

	} 
} 