<?php



class ProductCategoryMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ProductCategoryMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('product_category');
		$tMap->setPhpName('ProductCategory');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('product_category_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CATEGORY_NAME', 'CategoryName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('SHORT_NAME', 'ShortName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('TAG_NAME', 'TagName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('VISIBLE', 'Visible', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('LOCKED', 'Locked', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 