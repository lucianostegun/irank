<?php



class PurchaseStatusLogMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PurchaseStatusLogMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('purchase_status_log');
		$tMap->setPhpName('PurchaseStatusLog');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('purchase_status_log_SEQ');

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PURCHASE_ID', 'PurchaseId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TRANSACTION_DATE', 'TransactionDate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('TRANSACTION_CODE', 'TransactionCode', 'string', CreoleTypes::CHAR, false, null);

		$tMap->addColumn('TRANSACTION_STATUS', 'TransactionStatus', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('PAYMETHOD_TYPE', 'PaymethodType', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('EXTRA_AMOUNT', 'ExtraAmount', 'double', CreoleTypes::NUMERIC, false, 10);

		$tMap->addColumn('INSTALLMENT_COUNT', 'InstallmentCount', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CHANGE_SOURCE', 'ChangeSource', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 