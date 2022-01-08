<?php



class ProductMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ProductMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('product');
		$tMap->setPhpName('Product');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('product_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PRODUCT_CODE', 'ProductCode', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addForeignKey('PRODUCT_CATEGORY_ID', 'ProductCategoryId', 'int', CreoleTypes::INTEGER, 'product_category', 'ID', false, null);

		$tMap->addColumn('PRODUCT_NAME', 'ProductName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('SHORT_NAME', 'ShortName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('DEFAULT_PRICE', 'DefaultPrice', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('DEFAULT_WEIGHT', 'DefaultWeight', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('IS_NEW', 'IsNew', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('STOCK', 'Stock', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('IMAGE_1', 'Image1', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('IMAGE_2', 'Image2', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('IMAGE_3', 'Image3', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('IMAGE_4', 'Image4', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('IMAGE_5', 'Image5', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('VISIBLE', 'Visible', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('LOCKED', 'Locked', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 