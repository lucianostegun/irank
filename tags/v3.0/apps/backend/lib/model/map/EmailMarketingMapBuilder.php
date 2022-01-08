<?php



class EmailMarketingMapBuilder {

	
	const CLASS_NAME = '...apps.backend.lib.model.map.EmailMarketingMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('email_marketing');
		$tMap->setPhpName('EmailMarketing');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('email_marketing_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addForeignKey('FILE_ID', 'FileId', 'int', CreoleTypes::INTEGER, 'file', 'ID', false, null);

		$tMap->addForeignKey('CLUB_ID', 'ClubId', 'int', CreoleTypes::INTEGER, 'club', 'ID', false, null);

		$tMap->addForeignKey('EMAIL_TEMPLATE_ID', 'EmailTemplateId', 'int', CreoleTypes::INTEGER, 'email_template', 'ID', false, null);

		$tMap->addColumn('EMAIL_SUBJECT', 'EmailSubject', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('SCHEDULE_DATE', 'ScheduleDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('SENDING_STATUS', 'SendingStatus', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('LAST_SENT_DATE', 'LastSentDate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CLASS_NAME', 'ClassName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('VISIBLE', 'Visible', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('LOCKED', 'Locked', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 