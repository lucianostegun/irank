<?php



class EmailLogMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EmailLogMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('email_log');
		$tMap->setPhpName('EmailLog');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('EMAIL_ADDRESS', 'EmailAddress', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('EMAIL_SUBJECT', 'EmailSubject', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('SENDING_STATUS', 'SendingStatus', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 