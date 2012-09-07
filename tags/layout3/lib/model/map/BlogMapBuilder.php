<?php



class BlogMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.BlogMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('blog');
		$tMap->setPhpName('Blog');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('blog_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('SHORT_TITLE', 'ShortTitle', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CAPTION', 'Caption', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addForeignKey('BLOG_CATEGORY_ID', 'BlogCategoryId', 'int', CreoleTypes::INTEGER, 'virtual_table', 'ID', false, null);

		$tMap->addColumn('PERMALINK', 'Permalink', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('TAGS', 'Tags', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addForeignKey('PEOPLE_ID', 'PeopleId', 'int', CreoleTypes::INTEGER, 'people', 'ID', false, null);

		$tMap->addColumn('CONTENT', 'Content', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('GLOSSARY', 'Glossary', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('IS_DRAFT', 'IsDraft', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('PUBLISH_DATE', 'PublishDate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('VISIBLE', 'Visible', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('LOCKED', 'Locked', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 