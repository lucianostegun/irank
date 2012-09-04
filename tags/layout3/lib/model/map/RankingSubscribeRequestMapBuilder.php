<?php



class RankingSubscribeRequestMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.RankingSubscribeRequestMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('ranking_subscribe_request');
		$tMap->setPhpName('RankingSubscribeRequest');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('ranking_subscribe_request_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('USER_SITE_ID', 'UserSiteId', 'int', CreoleTypes::INTEGER, 'user_site', 'ID', false, null);

		$tMap->addForeignKey('USER_SITE_ID_OWNER', 'UserSiteIdOwner', 'int', CreoleTypes::INTEGER, 'user_site', 'ID', false, null);

		$tMap->addForeignKey('RANKING_ID', 'RankingId', 'int', CreoleTypes::INTEGER, 'ranking', 'ID', false, null);

		$tMap->addColumn('REQUEST_STATUS', 'RequestStatus', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 