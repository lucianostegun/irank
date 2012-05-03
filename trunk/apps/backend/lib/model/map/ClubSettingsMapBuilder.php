<?php



class ClubSettingsMapBuilder {

	
	const CLASS_NAME = '...apps.backend.lib.model.map.ClubSettingsMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('club_settings');
		$tMap->setPhpName('ClubSettings');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CLUB_ID', 'ClubId', 'int' , CreoleTypes::INTEGER, 'club', 'ID', true, null);

		$tMap->addForeignPrimaryKey('SETTINGS_ID', 'SettingsId', 'int' , CreoleTypes::INTEGER, 'settings', 'ID', true, null);

		$tMap->addColumn('SETTINGS_VALUE', 'SettingsValue', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 