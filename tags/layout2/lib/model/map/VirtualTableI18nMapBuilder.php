<?php



class VirtualTableI18nMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.VirtualTableI18nMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('virtual_table_i18n');
		$tMap->setPhpName('VirtualTableI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('VIRTUAL_TABLE_ID', 'VirtualTableId', 'int' , CreoleTypes::INTEGER, 'virtual_table', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'Culture', 'string', CreoleTypes::CHAR, true, null);

		$tMap->addColumn('DESCRIPTION_I18N', 'DescriptionI18n', 'string', CreoleTypes::VARCHAR, false, null);

	} 
} 