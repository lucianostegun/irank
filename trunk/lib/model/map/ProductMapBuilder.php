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

		$tMap->addColumn('PRODUCT_NAME', 'ProductName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addForeignKey('PRODUCT_TYPE_ID', 'ProductTypeId', 'int', CreoleTypes::INTEGER, 'virtual_table', 'ID', false, null);

		$tMap->addColumn('IS_NEW', 'IsNew', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DEFAULT_PRICE', 'DefaultPrice', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('VISIBLE', 'Visible', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('LOCKED', 'Locked', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 