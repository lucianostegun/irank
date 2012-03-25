<?php



class UserAdminMapBuilder {

	
	const CLASS_NAME = '...apps.backend.lib.model.map.UserAdminMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('user_admin');
		$tMap->setPhpName('UserAdmin');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('user_admin_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('PEOPLE_ID', 'PeopleId', 'int', CreoleTypes::INTEGER, 'people', 'ID', false, null);

		$tMap->addForeignKey('CLUB_ID', 'ClubId', 'int', CreoleTypes::INTEGER, 'club', 'ID', false, null);

		$tMap->addColumn('USERNAME', 'Username', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('PASSWORD', 'Password', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('ACTIVE', 'Active', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('MASTER', 'Master', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('VISIBLE', 'Visible', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('LOCKED', 'Locked', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('LAST_ACCESS_DATE', 'LastAccessDate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 