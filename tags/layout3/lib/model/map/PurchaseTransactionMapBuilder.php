<?php



class PurchaseTransactionMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PurchaseTransactionMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('purchase_transaction');
		$tMap->setPhpName('PurchaseTransaction');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('purchase_transaction_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('PURCHASE_ID', 'PurchaseId', 'int', CreoleTypes::INTEGER, 'purchase', 'ID', false, null);

		$tMap->addColumn('TRANSACTION_CODE', 'TransactionCode', 'string', CreoleTypes::CHAR, false, null);

		$tMap->addColumn('TRANSACTION_TYPE', 'TransactionType', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TRANSACTION_STATUS', 'TransactionStatus', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PAYMETHOD_TYPE', 'PaymethodType', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PAYMETHOD_CODE', 'PaymethodCode', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('GROSS_AMOUNT', 'GrossAmount', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('FEE_AMOUNT', 'FeeAmount', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('NET_AMOUNT', 'NetAmount', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('ESCROW_END_DATE', 'EscrowEndDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('EXTRA_AMOUNT', 'ExtraAmount', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('INSTALLMENT_COUNT', 'InstallmentCount', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 