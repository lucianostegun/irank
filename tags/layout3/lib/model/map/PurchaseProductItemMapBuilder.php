<?php



class PurchaseProductItemMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PurchaseProductItemMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('purchase_product_item');
		$tMap->setPhpName('PurchaseProductItem');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('PURCHASE_ID', 'PurchaseId', 'int' , CreoleTypes::INTEGER, 'purchase', 'ID', true, null);

		$tMap->addForeignPrimaryKey('PRODUCT_ITEM_ID', 'ProductItemId', 'int' , CreoleTypes::INTEGER, 'product_item', 'ID', true, null);

		$tMap->addColumn('PRICE', 'Price', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('WEIGHT', 'Weight', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('QUANTITY', 'Quantity', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TOTAL_VALUE', 'TotalValue', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 