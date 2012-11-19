<?php



class PurchaseMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PurchaseMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('purchase');
		$tMap->setPhpName('Purchase');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('purchase_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('USER_SITE_ID', 'UserSiteId', 'int', CreoleTypes::INTEGER, 'user_site', 'ID', false, null);

		$tMap->addForeignKey('FILE_ID', 'FileId', 'int', CreoleTypes::INTEGER, 'file', 'ID', false, null);

		$tMap->addColumn('PAGSEGURO_URL', 'PagseguroUrl', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('ORDER_NUMBER', 'OrderNumber', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('ORDER_STATUS', 'OrderStatus', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('HAS_NEW_STATUS', 'HasNewStatus', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('ORDER_VALUE', 'OrderValue', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('PRODUCTS', 'Products', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ITENS', 'Itens', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addForeignKey('DISCOUNT_COUPON_ID', 'DiscountCouponId', 'int', CreoleTypes::INTEGER, 'discount_coupon', 'ID', false, null);

		$tMap->addColumn('SHIPPING_VALUE', 'ShippingValue', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('DISCOUNT_VALUE', 'DiscountValue', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('TOTAL_VALUE', 'TotalValue', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('PAYMETHOD', 'Paymethod', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('IP_ADDRESS', 'IpAddress', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('APPROVAL_DATE', 'ApprovalDate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('REFUSAL_DATE', 'RefusalDate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('REFUSAL_REASON', 'RefusalReason', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('SHIPPING_DATE', 'ShippingDate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('TRACING_CODE', 'TracingCode', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CUSTOMER_NAME', 'CustomerName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('ADDRESS_NAME', 'AddressName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('ADDRESS_NUMBER', 'AddressNumber', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('ADDRESS_QUARTER', 'AddressQuarter', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('ADDRESS_COMPLEMENT', 'AddressComplement', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('ADDRESS_CITY', 'AddressCity', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('ADDRESS_STATE', 'AddressState', 'string', CreoleTypes::CHAR, false, null);

		$tMap->addColumn('ADDRESS_ZIPCODE', 'AddressZipcode', 'string', CreoleTypes::CHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('FINISHED_AT', 'FinishedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 