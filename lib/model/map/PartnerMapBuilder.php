<?php



class PartnerMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PartnerMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('partner');
		$tMap->setPhpName('Partner');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('partner_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PARTNER_NAME', 'PartnerName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('EXTERNAL_URL', 'ExternalUrl', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addForeignKey('FILE_ID', 'FileId', 'int', CreoleTypes::INTEGER, 'file', 'ID', false, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('VISIBLE', 'Visible', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('LOCKED', 'Locked', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 