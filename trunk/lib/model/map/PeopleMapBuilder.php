<?php



class PeopleMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PeopleMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('people');
		$tMap->setPhpName('People');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('people_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('PEOPLE_TYPE_ID', 'PeopleTypeId', 'int', CreoleTypes::INTEGER, 'virtual_table', 'ID', false, null);

		$tMap->addColumn('FIRST_NAME', 'FirstName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('LAST_NAME', 'LastName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('FULL_NAME', 'FullName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('EMAIL_ADDRESS', 'EmailAddress', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('BIRTHDAY', 'Birthday', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('DEFAULT_LANGUAGE', 'DefaultLanguage', 'string', CreoleTypes::CHAR, false, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('VISIBLE', 'Visible', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('LOCKED', 'Locked', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 