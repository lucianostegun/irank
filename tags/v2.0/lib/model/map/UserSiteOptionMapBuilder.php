<?php



class UserSiteOptionMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.UserSiteOptionMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('user_site_option');
		$tMap->setPhpName('UserSiteOption');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('PEOPLE_ID', 'PeopleId', 'int' , CreoleTypes::INTEGER, 'people', 'ID', true, null);

		$tMap->addForeignPrimaryKey('USER_SITE_OPTION_ID', 'UserSiteOptionId', 'int' , CreoleTypes::INTEGER, 'virtual_table', 'ID', true, null);

		$tMap->addColumn('OPTION_VALUE', 'OptionValue', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 