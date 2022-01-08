<?php



class SmsOptionMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.SmsOptionMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('sms_option');
		$tMap->setPhpName('SmsOption');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('PEOPLE_ID', 'PeopleId', 'int' , CreoleTypes::INTEGER, 'people', 'ID', true, null);

		$tMap->addForeignPrimaryKey('SMS_TEMPLATE_ID', 'SmsTemplateId', 'int' , CreoleTypes::INTEGER, 'sms_template', 'ID', true, null);

		$tMap->addColumn('LOCK_SEND', 'LockSend', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 