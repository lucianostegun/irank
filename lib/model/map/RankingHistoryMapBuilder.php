<?php



class RankingHistoryMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.RankingHistoryMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('ranking_history');
		$tMap->setPhpName('RankingHistory');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('RANKING_ID', 'RankingId', 'int' , CreoleTypes::INTEGER, 'ranking', 'ID', true, null);

		$tMap->addForeignPrimaryKey('PEOPLE_ID', 'PeopleId', 'int' , CreoleTypes::INTEGER, 'people', 'ID', true, null);

		$tMap->addPrimaryKey('RANKING_DATE', 'RankingDate', 'int', CreoleTypes::DATE, true, null);

		$tMap->addColumn('TOTAL_RANKING_POSITION', 'TotalRankingPosition', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('RANKING_POSITION', 'RankingPosition', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('EVENTS', 'Events', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SCORE', 'Score', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('PAID_VALUE', 'PaidValue', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('PRIZE_VALUE', 'PrizeValue', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('BALANCE_VALUE', 'BalanceValue', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('TOTAL_EVENTS', 'TotalEvents', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TOTAL_SCORE', 'TotalScore', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('TOTAL_PAID', 'TotalPaid', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('TOTAL_PRIZE', 'TotalPrize', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('TOTAL_BALANCE', 'TotalBalance', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 