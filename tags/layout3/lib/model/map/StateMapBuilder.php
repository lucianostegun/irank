<?php



class StateMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.StateMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('state');
		$tMap->setPhpName('State');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('state_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('INITIAL', 'Initial', 'string', CreoleTypes::CHAR, false, null);

		$tMap->addColumn('STATE_NAME', 'StateName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('ORDER_SEQ', 'OrderSeq', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 