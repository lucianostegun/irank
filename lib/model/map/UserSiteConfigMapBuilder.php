<?php



class UserSiteConfigMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.UserSiteConfigMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('user_site_config');
		$tMap->setPhpName('UserSiteConfig');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('USER_SITE_ID', 'UserSiteId', 'int' , CreoleTypes::INTEGER, 'user_site', 'ID', true, null);

		$tMap->addColumn('BANKROLL_TUTORIAL_HOME', 'BankrollTutorialHome', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SMS_VALIDATION_CODE', 'SmsValidationCode', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('SMS_VALIDATION_ATTEMPTS', 'SmsValidationAttempts', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('AGREED_SMS_TERMS', 'AgreedSmsTerms', 'boolean', CreoleTypes::BOOLEAN, false, null);

	} 
} 