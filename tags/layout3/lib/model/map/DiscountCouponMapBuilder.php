<?php



class DiscountCouponMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DiscountCouponMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('discount_coupon');
		$tMap->setPhpName('DiscountCoupon');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('discount_coupon_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('COUPON_CODE', 'CouponCode', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('DISCOUNT_RULE', 'DiscountRule', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('IS_ACTIVE', 'IsActive', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('HAS_USED', 'HasUsed', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('ENABLED', 'Enabled', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('VISIBLE', 'Visible', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETED', 'Deleted', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('LOCKED', 'Locked', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 