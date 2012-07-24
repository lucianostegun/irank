<?php


abstract class BasePurchaseTransactionPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'purchase_transaction';

	
	const CLASS_DEFAULT = 'lib.model.PurchaseTransaction';

	
	const NUM_COLUMNS = 15;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'purchase_transaction.ID';

	
	const PURCHASE_ID = 'purchase_transaction.PURCHASE_ID';

	
	const TRANSACTION_CODE = 'purchase_transaction.TRANSACTION_CODE';

	
	const TRANSACTION_TYPE = 'purchase_transaction.TRANSACTION_TYPE';

	
	const TRANSACTION_STATUS = 'purchase_transaction.TRANSACTION_STATUS';

	
	const PAYMETHOD_TYPE = 'purchase_transaction.PAYMETHOD_TYPE';

	
	const PAYMETHOD_CODE = 'purchase_transaction.PAYMETHOD_CODE';

	
	const GROSS_AMOUNT = 'purchase_transaction.GROSS_AMOUNT';

	
	const FEE_AMOUNT = 'purchase_transaction.FEE_AMOUNT';

	
	const NET_AMOUNT = 'purchase_transaction.NET_AMOUNT';

	
	const ESCROW_END_DATE = 'purchase_transaction.ESCROW_END_DATE';

	
	const EXTRA_AMOUNT = 'purchase_transaction.EXTRA_AMOUNT';

	
	const INSTALLMENT_COUNT = 'purchase_transaction.INSTALLMENT_COUNT';

	
	const CREATED_AT = 'purchase_transaction.CREATED_AT';

	
	const UPDATED_AT = 'purchase_transaction.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'PurchaseId', 'TransactionCode', 'TransactionType', 'TransactionStatus', 'PaymethodType', 'PaymethodCode', 'GrossAmount', 'FeeAmount', 'NetAmount', 'EscrowEndDate', 'ExtraAmount', 'InstallmentCount', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (PurchaseTransactionPeer::ID, PurchaseTransactionPeer::PURCHASE_ID, PurchaseTransactionPeer::TRANSACTION_CODE, PurchaseTransactionPeer::TRANSACTION_TYPE, PurchaseTransactionPeer::TRANSACTION_STATUS, PurchaseTransactionPeer::PAYMETHOD_TYPE, PurchaseTransactionPeer::PAYMETHOD_CODE, PurchaseTransactionPeer::GROSS_AMOUNT, PurchaseTransactionPeer::FEE_AMOUNT, PurchaseTransactionPeer::NET_AMOUNT, PurchaseTransactionPeer::ESCROW_END_DATE, PurchaseTransactionPeer::EXTRA_AMOUNT, PurchaseTransactionPeer::INSTALLMENT_COUNT, PurchaseTransactionPeer::CREATED_AT, PurchaseTransactionPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'purchase_id', 'transaction_code', 'transaction_type', 'transaction_status', 'paymethod_type', 'paymethod_code', 'gross_amount', 'fee_amount', 'net_amount', 'escrow_end_date', 'extra_amount', 'installment_count', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'PURCHASE_ID'=>'', 'TRANSACTION_CODE'=>'', 'TRANSACTION_TYPE'=>'', 'TRANSACTION_STATUS'=>'', 'PAYMETHOD_TYPE'=>'', 'PAYMETHOD_CODE'=>'', 'GROSS_AMOUNT'=>'', 'FEE_AMOUNT'=>'', 'NET_AMOUNT'=>'', 'ESCROW_END_DATE'=>'', 'EXTRA_AMOUNT'=>'', 'INSTALLMENT_COUNT'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'PurchaseId'=>1, 'TransactionCode'=>2, 'TransactionType'=>3, 'TransactionStatus'=>4, 'PaymethodType'=>5, 'PaymethodCode'=>6, 'GrossAmount'=>7, 'FeeAmount'=>8, 'NetAmount'=>9, 'EscrowEndDate'=>10, 'ExtraAmount'=>11, 'InstallmentCount'=>12, 'CreatedAt'=>13, 'UpdatedAt'=>14, ),
		BasePeer::TYPE_COLNAME=>array (PurchaseTransactionPeer::ID=>0, PurchaseTransactionPeer::PURCHASE_ID=>1, PurchaseTransactionPeer::TRANSACTION_CODE=>2, PurchaseTransactionPeer::TRANSACTION_TYPE=>3, PurchaseTransactionPeer::TRANSACTION_STATUS=>4, PurchaseTransactionPeer::PAYMETHOD_TYPE=>5, PurchaseTransactionPeer::PAYMETHOD_CODE=>6, PurchaseTransactionPeer::GROSS_AMOUNT=>7, PurchaseTransactionPeer::FEE_AMOUNT=>8, PurchaseTransactionPeer::NET_AMOUNT=>9, PurchaseTransactionPeer::ESCROW_END_DATE=>10, PurchaseTransactionPeer::EXTRA_AMOUNT=>11, PurchaseTransactionPeer::INSTALLMENT_COUNT=>12, PurchaseTransactionPeer::CREATED_AT=>13, PurchaseTransactionPeer::UPDATED_AT=>14, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'purchase_id'=>1, 'transaction_code'=>2, 'transaction_type'=>3, 'transaction_status'=>4, 'paymethod_type'=>5, 'paymethod_code'=>6, 'gross_amount'=>7, 'fee_amount'=>8, 'net_amount'=>9, 'escrow_end_date'=>10, 'extra_amount'=>11, 'installment_count'=>12, 'created_at'=>13, 'updated_at'=>14, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/PurchaseTransactionMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.PurchaseTransactionMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = PurchaseTransactionPeer::getTableMap();
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
		return str_replace(PurchaseTransactionPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PurchaseTransactionPeer::ID);

		$criteria->addSelectColumn(PurchaseTransactionPeer::PURCHASE_ID);

		$criteria->addSelectColumn(PurchaseTransactionPeer::TRANSACTION_CODE);

		$criteria->addSelectColumn(PurchaseTransactionPeer::TRANSACTION_TYPE);

		$criteria->addSelectColumn(PurchaseTransactionPeer::TRANSACTION_STATUS);

		$criteria->addSelectColumn(PurchaseTransactionPeer::PAYMETHOD_TYPE);

		$criteria->addSelectColumn(PurchaseTransactionPeer::PAYMETHOD_CODE);

		$criteria->addSelectColumn(PurchaseTransactionPeer::GROSS_AMOUNT);

		$criteria->addSelectColumn(PurchaseTransactionPeer::FEE_AMOUNT);

		$criteria->addSelectColumn(PurchaseTransactionPeer::NET_AMOUNT);

		$criteria->addSelectColumn(PurchaseTransactionPeer::ESCROW_END_DATE);

		$criteria->addSelectColumn(PurchaseTransactionPeer::EXTRA_AMOUNT);

		$criteria->addSelectColumn(PurchaseTransactionPeer::INSTALLMENT_COUNT);

		$criteria->addSelectColumn(PurchaseTransactionPeer::CREATED_AT);

		$criteria->addSelectColumn(PurchaseTransactionPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(purchase_transaction.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT purchase_transaction.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PurchaseTransactionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PurchaseTransactionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PurchaseTransactionPeer::doSelectRS($criteria, $con);
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
		$objects = PurchaseTransactionPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return PurchaseTransactionPeer::populateObjects(PurchaseTransactionPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PurchaseTransactionPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = PurchaseTransactionPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinPurchase(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PurchaseTransactionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PurchaseTransactionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PurchaseTransactionPeer::PURCHASE_ID, PurchasePeer::ID);

		$rs = PurchaseTransactionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinPurchase(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PurchaseTransactionPeer::addSelectColumns($c);
		$startcol = (PurchaseTransactionPeer::NUM_COLUMNS - PurchaseTransactionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PurchasePeer::addSelectColumns($c);

		$c->addJoin(PurchaseTransactionPeer::PURCHASE_ID, PurchasePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PurchaseTransactionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PurchasePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getPurchase(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addPurchaseTransaction($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPurchaseTransactionList();
				$obj2->addPurchaseTransaction($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PurchaseTransactionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PurchaseTransactionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PurchaseTransactionPeer::PURCHASE_ID, PurchasePeer::ID);

		$rs = PurchaseTransactionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PurchaseTransactionPeer::addSelectColumns($c);
		$startcol2 = (PurchaseTransactionPeer::NUM_COLUMNS - PurchaseTransactionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PurchasePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PurchasePeer::NUM_COLUMNS;

		$c->addJoin(PurchaseTransactionPeer::PURCHASE_ID, PurchasePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PurchaseTransactionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = PurchasePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPurchase(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPurchaseTransaction($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initPurchaseTransactionList();
				$obj2->addPurchaseTransaction($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return PurchaseTransactionPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(PurchaseTransactionPeer::ID); 

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
			$comparison = $criteria->getComparison(PurchaseTransactionPeer::ID);
			$selectCriteria->add(PurchaseTransactionPeer::ID, $criteria->remove(PurchaseTransactionPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(PurchaseTransactionPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PurchaseTransactionPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof PurchaseTransaction) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PurchaseTransactionPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(PurchaseTransaction $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PurchaseTransactionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PurchaseTransactionPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PurchaseTransactionPeer::DATABASE_NAME, PurchaseTransactionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PurchaseTransactionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(PurchaseTransactionPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(PurchaseTransactionPeer::ID, $pk);


		$v = PurchaseTransactionPeer::doSelect($criteria, $con);

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
			$criteria->add(PurchaseTransactionPeer::ID, $pks, Criteria::IN);
			$objs = PurchaseTransactionPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasePurchaseTransactionPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/PurchaseTransactionMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.PurchaseTransactionMapBuilder');
}
