<?php



class RankingPlaceMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.RankingPlaceMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('ranking_place');
		$tMap->setPhpName('RankingPlace');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('ranking_place_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('RANKING_ID', 'RankingId', 'int', CreoleTypes::INTEGER, 'ranking', 'ID', false, null);

		$tMap->addColumn('PLACE_NAME', 'PlaceName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('MAPS_LINK', 'MapsLink', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 