<?php



class EmailOptionMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EmailOptionMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('email_option');
		$tMap->setPhpName('EmailOption');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('EMAIL_ADDRESS', 'EmailAddress', 'string' , CreoleTypes::VARCHAR, 'people', 'EMAIL_ADDRESS', true, null);

		$tMap->addForeignPrimaryKey('EMAIL_TEMPLATE_ID', 'EmailTemplateId', 'int' , CreoleTypes::INTEGER, 'email_template', 'ID', true, null);

		$tMap->addColumn('LOCK_SEND', 'LockSend', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 