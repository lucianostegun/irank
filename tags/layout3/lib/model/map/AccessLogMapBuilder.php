<?php



class AccessLogMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.AccessLogMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('access_log');
		$tMap->setPhpName('AccessLog');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('USER_SITE_ID', 'UserSiteId', 'int' , CreoleTypes::INTEGER, 'user_site', 'ID', true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('IP_ADDRESS', 'IpAddress', 'string', CreoleTypes::VARCHAR, false, null);

	} 
} 