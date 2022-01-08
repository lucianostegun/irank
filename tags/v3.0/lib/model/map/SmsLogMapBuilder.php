<?php



class SmsLogMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.SmsLogMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('sms_log');
		$tMap->setPhpName('SmsLog');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('sms_log_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('SMS_ID', 'SmsId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('MESSAGE_ID', 'MessageId', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('PHONE_NUMBER', 'PhoneNumber', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('SENDING_STATUS', 'SendingStatus', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 