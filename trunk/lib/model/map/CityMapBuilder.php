<?php



class CityMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.CityMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('city');
		$tMap->setPhpName('City');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('city_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('STATE_ID', 'StateId', 'int', CreoleTypes::INTEGER, 'state', 'ID', false, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('ORDER_SEQ', 'OrderSeq', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 