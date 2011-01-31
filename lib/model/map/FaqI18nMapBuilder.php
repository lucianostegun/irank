<?php



class FaqI18nMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.FaqI18nMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('faq_i18n');
		$tMap->setPhpName('FaqI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('FAQ_ID', 'FaqId', 'int' , CreoleTypes::INTEGER, 'faq', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'Culture', 'string', CreoleTypes::CHAR, true, 5);

		$tMap->addColumn('QUESTION_I18N', 'QuestionI18n', 'string', CreoleTypes::VARCHAR, false, 200);

		$tMap->addColumn('ANSWER_I18N', 'AnswerI18n', 'string', CreoleTypes::LONGVARCHAR, false, null);

	} 
} 