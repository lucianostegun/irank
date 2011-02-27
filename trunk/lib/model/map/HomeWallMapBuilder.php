<?php



class HomeWallMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.HomeWallMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('home_wall');
		$tMap->setPhpName('HomeWall');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('home_wall_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PEOPLE_NAME', 'PeopleName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addForeignKey('USER_SITE_ID', 'UserSiteId', 'int', CreoleTypes::INTEGER, 'user_site', 'ID', false, null);

		$tMap->addColumn('MESSAGE', 'Message', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('ICON', 'Icon', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('SHOW_WHO', 'ShowWho', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 