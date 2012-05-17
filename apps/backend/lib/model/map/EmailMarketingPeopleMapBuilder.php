<?php



class EmailMarketingPeopleMapBuilder {

	
	const CLASS_NAME = '...apps.backend.lib.model.map.EmailMarketingPeopleMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('email_marketing_people');
		$tMap->setPhpName('EmailMarketingPeople');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('EMAIL_MARKETING_ID', 'EmailMarketingId', 'int' , CreoleTypes::INTEGER, 'email_marketing', 'ID', true, null);

		$tMap->addForeignPrimaryKey('PEOPLE_ID', 'PeopleId', 'int' , CreoleTypes::INTEGER, 'people', 'ID', true, null);

		$tMap->addColumn('EMAIL_LOG_ID', 'EmailLogId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('RANDOM_CODE', 'RandomCode', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 