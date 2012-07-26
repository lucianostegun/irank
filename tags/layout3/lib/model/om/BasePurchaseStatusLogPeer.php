<?php


abstract class BasePurchaseStatusLogPeer {

	
	const DATABASE_NAME = 'log';

	
	const TABLE_NAME = 'purchase_status_log';

	
	const CLASS_DEFAULT = 'lib.model.PurchaseStatusLog';

	
	const NUM_COLUMNS = 11;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'purchase_status_log.ID';

	
	const PURCHASE_ID = 'purchase_status_log.PURCHASE_ID';

	
	const TRANSACTION_DATE = 'purchase_status_log.TRANSACTION_DATE';

	
	const TRANSACTION_CODE = 'purchase_status_log.TRANSACTION_CODE';

	
	const TRANSACTION_STATUS = 'purchase_status_log.TRANSACTION_STATUS';

	
	const PAYMETHOD_TYPE = 'purchase_status_log.PAYMETHOD_TYPE';

	
	const EXTRA_AMOUNT = 'purchase_status_log.EXTRA_AMOUNT';

	
	const INSTALLMENT_COUNT = 'purchase_status_log.INSTALLMENT_COUNT';

	
	const CHANGE_SOURCE = 'purchase_status_log.CHANGE_SOURCE';

	
	const CREATED_AT = 'purchase_status_log.CREATED_AT';

	
	const UPDATED_AT = 'purchase_status_log.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'PurchaseId', 'TransactionDate', 'TransactionCode', 'TransactionStatus', 'PaymethodType', 'ExtraAmount', 'InstallmentCount', 'ChangeSource', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (PurchaseStatusLogPeer::ID, PurchaseStatusLogPeer::PURCHASE_ID, PurchaseStatusLogPeer::TRANSACTION_DATE, PurchaseStatusLogPeer::TRANSACTION_CODE, PurchaseStatusLogPeer::TRANSACTION_STATUS, PurchaseStatusLogPeer::PAYMETHOD_TYPE, PurchaseStatusLogPeer::EXTRA_AMOUNT, PurchaseStatusLogPeer::INSTALLMENT_COUNT, PurchaseStatusLogPeer::CHANGE_SOURCE, PurchaseStatusLogPeer::CREATED_AT, PurchaseStatusLogPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'purchase_id', 'transaction_date', 'transaction_code', 'transaction_status', 'paymethod_type', 'extra_amount', 'installment_count', 'change_source', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'PURCHASE_ID'=>'', 'TRANSACTION_DATE'=>'', 'TRANSACTION_CODE'=>'', 'TRANSACTION_STATUS'=>'', 'PAYMETHOD_TYPE'=>'', 'EXTRA_AMOUNT'=>'', 'INSTALLMENT_COUNT'=>'', 'CHANGE_SOURCE'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'PurchaseId'=>1, 'TransactionDate'=>2, 'TransactionCode'=>3, 'TransactionStatus'=>4, 'PaymethodType'=>5, 'ExtraAmount'=>6, 'InstallmentCount'=>7, 'ChangeSource'=>8, 'CreatedAt'=>9, 'UpdatedAt'=>10, ),
		BasePeer::TYPE_COLNAME=>array (PurchaseStatusLogPeer::ID=>0, PurchaseStatusLogPeer::PURCHASE_ID=>1, PurchaseStatusLogPeer::TRANSACTION_DATE=>2, PurchaseStatusLogPeer::TRANSACTION_CODE=>3, PurchaseStatusLogPeer::TRANSACTION_STATUS=>4, PurchaseStatusLogPeer::PAYMETHOD_TYPE=>5, PurchaseStatusLogPeer::EXTRA_AMOUNT=>6, PurchaseStatusLogPeer::INSTALLMENT_COUNT=>7, PurchaseStatusLogPeer::CHANGE_SOURCE=>8, PurchaseStatusLogPeer::CREATED_AT=>9, PurchaseStatusLogPeer::UPDATED_AT=>10, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'purchase_id'=>1, 'transaction_date'=>2, 'transaction_code'=>3, 'transaction_status'=>4, 'paymethod_type'=>5, 'extra_amount'=>6, 'installment_count'=>7, 'change_source'=>8, 'created_at'=>9, 'updated_at'=>10, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/PurchaseStatusLogMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.PurchaseStatusLogMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = PurchaseStatusLogPeer::getTableMap();
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
		return str_replace(PurchaseStatusLogPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PurchaseStatusLogPeer::ID);

		$criteria->addSelectColumn(PurchaseStatusLogPeer::PURCHASE_ID);

		$criteria->addSelectColumn(PurchaseStatusLogPeer::TRANSACTION_DATE);

		$criteria->addSelectColumn(PurchaseStatusLogPeer::TRANSACTION_CODE);

		$criteria->addSelectColumn(PurchaseStatusLogPeer::TRANSACTION_STATUS);

		$criteria->addSelectColumn(PurchaseStatusLogPeer::PAYMETHOD_TYPE);

		$criteria->addSelectColumn(PurchaseStatusLogPeer::EXTRA_AMOUNT);

		$criteria->addSelectColumn(PurchaseStatusLogPeer::INSTALLMENT_COUNT);

		$criteria->addSelectColumn(PurchaseStatusLogPeer::CHANGE_SOURCE);

		$criteria->addSelectColumn(PurchaseStatusLogPeer::CREATED_AT);

		$criteria->addSelectColumn(PurchaseStatusLogPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(purchase_status_log.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT purchase_status_log.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PurchaseStatusLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PurchaseStatusLogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PurchaseStatusLogPeer::doSelectRS($criteria, $con);
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
		$objects = PurchaseStatusLogPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return PurchaseStatusLogPeer::populateObjects(PurchaseStatusLogPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PurchaseStatusLogPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = PurchaseStatusLogPeer::getOMClass();
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
		return PurchaseStatusLogPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(PurchaseStatusLogPeer::ID); 

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
			$comparison = $criteria->getComparison(PurchaseStatusLogPeer::ID);
			$selectCriteria->add(PurchaseStatusLogPeer::ID, $criteria->remove(PurchaseStatusLogPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(PurchaseStatusLogPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PurchaseStatusLogPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof PurchaseStatusLog) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PurchaseStatusLogPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(PurchaseStatusLog $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PurchaseStatusLogPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PurchaseStatusLogPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PurchaseStatusLogPeer::DATABASE_NAME, PurchaseStatusLogPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PurchaseStatusLogPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(PurchaseStatusLogPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(PurchaseStatusLogPeer::ID, $pk);


		$v = PurchaseStatusLogPeer::doSelect($criteria, $con);

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
			$criteria->add(PurchaseStatusLogPeer::ID, $pks, Criteria::IN);
			$objs = PurchaseStatusLogPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasePurchaseStatusLogPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/PurchaseStatusLogMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.PurchaseStatusLogMapBuilder');
}
