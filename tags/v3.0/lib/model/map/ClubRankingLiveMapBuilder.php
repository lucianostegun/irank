<?php



class ClubRankingLiveMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ClubRankingLiveMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('club_ranking_live');
		$tMap->setPhpName('ClubRankingLive');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CLUB_ID', 'ClubId', 'int' , CreoleTypes::INTEGER, 'club', 'ID', true, null);

		$tMap->addForeignPrimaryKey('RANKING_LIVE_ID', 'RankingLiveId', 'int' , CreoleTypes::INTEGER, 'ranking_live', 'ID', true, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 