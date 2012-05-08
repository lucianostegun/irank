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

		$tMap->addForeignKey('CLUB_ID', 'ClubId', 'int', CreoleTypes::INTEGER, 'club', 'ID', true, null);

		$tMap->addForeignKey('PEOPLE_ID', 'PeopleId', 'int', CreoleTypes::INTEGER, 'people', 'ID', true, null);

		$tMap->addColumn('TOKEN', 'Token', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('TEXT_MESSAGE', 'TextMessage', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('TOTAL_MESSAGES', 'TotalMessages', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SUCCESS_MESSAGES', 'SuccessMessages', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ERROR_MESSAGES', 'ErrorMessages', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CLASS_NAME', 'ClassName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('OBJECT_ID', 'ObjectId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 