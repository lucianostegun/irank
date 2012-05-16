<?php



class PollAnswerMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PollAnswerMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('poll_answer');
		$tMap->setPhpName('PollAnswer');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignKey('POLL_ID', 'PollId', 'int', CreoleTypes::INTEGER, 'poll', 'ID', true, null);

		$tMap->addColumn('ANSWER', 'Answer', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('USER_RESPONSE', 'UserResponse', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 