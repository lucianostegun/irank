<?php



class ProductItemMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ProductItemMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('product_item');
		$tMap->setPhpName('ProductItem');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('product_item_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('PRODUCT_ID', 'ProductId', 'int', CreoleTypes::INTEGER, 'product', 'ID', false, null);

		$tMap->addForeignKey('PRODUCT_OPTION_ID_COLOR', 'ProductOptionIdColor', 'int', CreoleTypes::INTEGER, 'product_option', 'ID', false, null);

		$tMap->addForeignKey('PRODUCT_OPTION_ID_SIZE', 'ProductOptionIdSize', 'int', CreoleTypes::INTEGER, 'product_option', 'ID', false, null);

		$tMap->addColumn('PRICE', 'Price', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('WEIGHT', 'Weight', 'double', CreoleTypes::FLOAT, false, null);

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