<?php



class FileMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.FileMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('file');
		$tMap->setPhpName('File');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('file_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('FILE_NAME', 'FileName', 'string', CreoleTypes::VARCHAR, false, 200);

		$tMap->addColumn('FILE_PATH', 'FilePath', 'string', CreoleTypes::VARCHAR, false, 200);

		$tMap->addColumn('FILE_SIZE', 'FileSize', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('IS_IMAGE', 'IsImage', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, false, 250);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 