<?php


abstract class BasePurchaseTransactionLogPeer {

	
	const DATABASE_NAME = 'log';

	
	const TABLE_NAME = 'purchase_transaction_log';

	
	const CLASS_DEFAULT = 'lib.model.PurchaseTransactionLog';

	
	const NUM_COLUMNS = 15;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'purchase_transaction_log.ID';

	
	const PURCHASE_ID = 'purchase_transaction_log.PURCHASE_ID';

	
	const TRANSACTION_CODE = 'purchase_transaction_log.TRANSACTION_CODE';

	
	const TRANSACTION_TYPE = 'purchase_transaction_log.TRANSACTION_TYPE';

	
	const TRANSACTION_STATUS = 'purchase_transaction_log.TRANSACTION_STATUS';

	
	const PAYMETHOD_TYPE = 'purchase_transaction_log.PAYMETHOD_TYPE';

	
	const PAYMETHOD_CODE = 'purchase_transaction_log.PAYMETHOD_CODE';

	
	const GROSS_AMOUNT = 'purchase_transaction_log.GROSS_AMOUNT';

	
	const FEE_AMOUNT = 'purchase_transaction_log.FEE_AMOUNT';

	
	const NET_AMOUNT = 'purchase_transaction_log.NET_AMOUNT';

	
	const ESCROW_END_DATE = 'purchase_transaction_log.ESCROW_END_DATE';

	
	const EXTRA_AMOUNT = 'purchase_transaction_log.EXTRA_AMOUNT';

	
	const INSTALLMENT_COUNT = 'purchase_transaction_log.INSTALLMENT_COUNT';

	
	const CREATED_AT = 'purchase_transaction_log.CREATED_AT';

	
	const UPDATED_AT = 'purchase_transaction_log.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'PurchaseId', 'TransactionCode', 'TransactionType', 'TransactionStatus', 'PaymethodType', 'PaymethodCode', 'GrossAmount', 'FeeAmount', 'NetAmount', 'EscrowEndDate', 'ExtraAmount', 'InstallmentCount', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (PurchaseTransactionLogPeer::ID, PurchaseTransactionLogPeer::PURCHASE_ID, PurchaseTransactionLogPeer::TRANSACTION_CODE, PurchaseTransactionLogPeer::TRANSACTION_TYPE, PurchaseTransactionLogPeer::TRANSACTION_STATUS, PurchaseTransactionLogPeer::PAYMETHOD_TYPE, PurchaseTransactionLogPeer::PAYMETHOD_CODE, PurchaseTransactionLogPeer::GROSS_AMOUNT, PurchaseTransactionLogPeer::FEE_AMOUNT, PurchaseTransactionLogPeer::NET_AMOUNT, PurchaseTransactionLogPeer::ESCROW_END_DATE, PurchaseTransactionLogPeer::EXTRA_AMOUNT, PurchaseTransactionLogPeer::INSTALLMENT_COUNT, PurchaseTransactionLogPeer::CREATED_AT, PurchaseTransactionLogPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'purchase_id', 'transaction_code', 'transaction_type', 'transaction_status', 'paymethod_type', 'paymethod_code', 'gross_amount', 'fee_amount', 'net_amount', 'escrow_end_date', 'extra_amount', 'installment_count', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'PURCHASE_ID'=>'', 'TRANSACTION_CODE'=>'', 'TRANSACTION_TYPE'=>'', 'TRANSACTION_STATUS'=>'', 'PAYMETHOD_TYPE'=>'', 'PAYMETHOD_CODE'=>'', 'GROSS_AMOUNT'=>'', 'FEE_AMOUNT'=>'', 'NET_AMOUNT'=>'', 'ESCROW_END_DATE'=>'', 'EXTRA_AMOUNT'=>'', 'INSTALLMENT_COUNT'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'PurchaseId'=>1, 'TransactionCode'=>2, 'TransactionType'=>3, 'TransactionStatus'=>4, 'PaymethodType'=>5, 'PaymethodCode'=>6, 'GrossAmount'=>7, 'FeeAmount'=>8, 'NetAmount'=>9, 'EscrowEndDate'=>10, 'ExtraAmount'=>11, 'InstallmentCount'=>12, 'CreatedAt'=>13, 'UpdatedAt'=>14, ),
		BasePeer::TYPE_COLNAME=>array (PurchaseTransactionLogPeer::ID=>0, PurchaseTransactionLogPeer::PURCHASE_ID=>1, PurchaseTransactionLogPeer::TRANSACTION_CODE=>2, PurchaseTransactionLogPeer::TRANSACTION_TYPE=>3, PurchaseTransactionLogPeer::TRANSACTION_STATUS=>4, PurchaseTransactionLogPeer::PAYMETHOD_TYPE=>5, PurchaseTransactionLogPeer::PAYMETHOD_CODE=>6, PurchaseTransactionLogPeer::GROSS_AMOUNT=>7, PurchaseTransactionLogPeer::FEE_AMOUNT=>8, PurchaseTransactionLogPeer::NET_AMOUNT=>9, PurchaseTransactionLogPeer::ESCROW_END_DATE=>10, PurchaseTransactionLogPeer::EXTRA_AMOUNT=>11, PurchaseTransactionLogPeer::INSTALLMENT_COUNT=>12, PurchaseTransactionLogPeer::CREATED_AT=>13, PurchaseTransactionLogPeer::UPDATED_AT=>14, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'purchase_id'=>1, 'transaction_code'=>2, 'transaction_type'=>3, 'transaction_status'=>4, 'paymethod_type'=>5, 'paymethod_code'=>6, 'gross_amount'=>7, 'fee_amount'=>8, 'net_amount'=>9, 'escrow_end_date'=>10, 'extra_amount'=>11, 'installment_count'=>12, 'created_at'=>13, 'updated_at'=>14, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/PurchaseTransactionLogMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.PurchaseTransactionLogMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = PurchaseTransactionLogPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(PurchaseTransactionLogPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PurchaseTransactionLogPeer::ID);

		$criteria->addSelectColumn(PurchaseTransactionLogPeer::PURCHASE_ID);

		$criteria->addSelectColumn(PurchaseTransactionLogPeer::TRANSACTION_CODE);

		$criteria->addSelectColumn(PurchaseTransactionLogPeer::TRANSACTION_TYPE);

		$criteria->addSelectColumn(PurchaseTransactionLogPeer::TRANSACTION_STATUS);

		$criteria->addSelectColumn(PurchaseTransactionLogPeer::PAYMETHOD_TYPE);

		$criteria->addSelectColumn(PurchaseTransactionLogPeer::PAYMETHOD_CODE);

		$criteria->addSelectColumn(PurchaseTransactionLogPeer::GROSS_AMOUNT);

		$criteria->addSelectColumn(PurchaseTransactionLogPeer::FEE_AMOUNT);

		$criteria->addSelectColumn(PurchaseTransactionLogPeer::NET_AMOUNT);

		$criteria->addSelectColumn(PurchaseTransactionLogPeer::ESCROW_END_DATE);

		$criteria->addSelectColumn(PurchaseTransactionLogPeer::EXTRA_AMOUNT);

		$criteria->addSelectColumn(PurchaseTransactionLogPeer::INSTALLMENT_COUNT);

		$criteria->addSelectColumn(PurchaseTransactionLogPeer::CREATED_AT);

		$criteria->addSelectColumn(PurchaseTransactionLogPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(purchase_transaction_log.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT purchase_transaction_log.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PurchaseTransactionLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PurchaseTransactionLogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PurchaseTransactionLogPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = PurchaseTransactionLogPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return PurchaseTransactionLogPeer::populateObjects(PurchaseTransactionLogPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PurchaseTransactionLogPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = PurchaseTransactionLogPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return PurchaseTransactionLogPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(PurchaseTransactionLogPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(PurchaseTransactionLogPeer::ID);
			$selectCriteria->add(PurchaseTransactionLogPeer::ID, $criteria->remove(PurchaseTransactionLogPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(PurchaseTransactionLogPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(PurchaseTransactionLogPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof PurchaseTransactionLog) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PurchaseTransactionLogPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(PurchaseTransactionLog $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PurchaseTransactionLogPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PurchaseTransactionLogPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(PurchaseTransactionLogPeer::DATABASE_NAME, PurchaseTransactionLogPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PurchaseTransactionLogPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(PurchaseTransactionLogPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(PurchaseTransactionLogPeer::ID, $pk);


		$v = PurchaseTransactionLogPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(PurchaseTransactionLogPeer::ID, $pks, Criteria::IN);
			$objs = PurchaseTransactionLogPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasePurchaseTransactionLogPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/PurchaseTransactionLogMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.PurchaseTransactionLogMapBuilder');
}
