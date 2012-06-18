<?php



class ClubMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ClubMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('club');
		$tMap->setPhpName('Club');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('club_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CLUB_NAME', 'ClubName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('TAG_NAME', 'TagName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('FILE_NAME_LOGO', 'FileNameLogo', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('ADDRESS_NAME', 'AddressName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('ADDRESS_NUMBER', 'AddressNumber', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('ADDRESS_QUARTER', 'AddressQuarter', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addForeignKey('CITY_ID', 'CityId', 'int', CreoleTypes::INTEGER, 'city', 'ID', false, null);

		$tMap->addColumn('MAPS_LINK', 'MapsLink', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('LATITUDE', 'Latitude', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('LONGITUDE', 'Longitude', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('CLUB_SITE', 'ClubSite', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('PHONE_NUMBER_1', 'PhoneNumber1', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('PHONE_NUMBER_2', 'PhoneNumber2', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('PHONE_NUMBER_3', 'PhoneNumber3', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('VISIT_COUNT', 'VisitCount', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SMS_CREDIT', 'SmsCredit', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('VISIBLE', 'Visible', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('LOCKED', 'Locked', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 