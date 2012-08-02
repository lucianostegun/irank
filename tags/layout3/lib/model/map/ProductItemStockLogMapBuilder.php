<?php



class ProductItemStockLogMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ProductItemStockLogMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap('log');

		$tMap = $this->dbMap->addTable('product_item_stock_log');
		$tMap->setPhpName('ProductItemStockLog');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('product_item_stock_log_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PRODUCT_ITEM_ID', 'ProductItemId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('STOCK', 'Stock', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('COMMENTS', 'Comments', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 