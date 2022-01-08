<?php



class SmsMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.SmsMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('sms');
		$tMap->setPhpName('Sms');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('sms_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('PEOPLE_ID', 'PeopleId', 'int', CreoleTypes::INTEGER, 'people', 'ID', false, null);

		$tMap->addColumn('PHONE_NUMBER', 'PhoneNumber', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('MESSAGE', 'Message', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('STATUS_CODE', 'StatusCode', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('STATUS_MESSAGE', 'StatusMessage', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('MESSAGE_ID', 'MessageId', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 