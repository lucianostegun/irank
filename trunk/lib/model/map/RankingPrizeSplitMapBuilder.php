<?php



class RankingPrizeSplitMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.RankingPrizeSplitMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('ranking_prize_split');
		$tMap->setPhpName('RankingPrizeSplit');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('ranking_prize_split_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('RANKING_ID', 'RankingId', 'int', CreoleTypes::INTEGER, 'ranking', 'ID', true, null);

		$tMap->addColumn('BUYINS', 'Buyins', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PAID_PLACES', 'PaidPlaces', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PERCENT_LIST', 'PercentList', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 