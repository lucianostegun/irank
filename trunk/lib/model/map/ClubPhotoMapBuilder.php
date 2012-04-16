<?php



class ClubPhotoMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ClubPhotoMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('club_photo');
		$tMap->setPhpName('ClubPhoto');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('club_photo_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('CLUB_ID', 'ClubId', 'int', CreoleTypes::INTEGER, 'club', 'ID', true, null);

		$tMap->addForeignKey('FILE_ID', 'FileId', 'int', CreoleTypes::INTEGER, 'file', 'ID', true, null);

		$tMap->addColumn('WIDTH', 'Width', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('HEIGHT', 'Height', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ORIENTATION', 'Orientation', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 