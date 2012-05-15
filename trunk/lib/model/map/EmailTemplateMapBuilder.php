<?php



class EmailTemplateMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.EmailTemplateMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('email_template');
		$tMap->setPhpName('EmailTemplate');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('email_template_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TEMPLATE_NAME', 'TemplateName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addForeignKey('FILE_ID', 'FileId', 'int', CreoleTypes::INTEGER, 'file', 'ID', false, null);

		$tMap->addForeignKey('CLUB_ID', 'ClubId', 'int', CreoleTypes::INTEGER, 'club', 'ID', false, null);

		$tMap->addForeignKey('EMAIL_TEMPLATE_ID', 'EmailTemplateId', 'int', CreoleTypes::INTEGER, 'email_template', 'ID', false, null);

		$tMap->addColumn('IS_AVAILABLE_FOR_USE', 'IsAvailableForUse', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('IS_AVAILABLE_FOR_SALE', 'IsAvailableForSale', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('TAG_NAME', 'TagName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('TAG_NAME_PARENT', 'TagNameParent', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('VISIBLE', 'Visible', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('LOCKED', 'Locked', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 