<?php


abstract class BaseDiscountCouponPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'discount_coupon';

	
	const CLASS_DEFAULT = 'lib.model.DiscountCoupon';

	
	const NUM_COLUMNS = 12;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'discount_coupon.ID';

	
	const COUPON_CODE = 'discount_coupon.COUPON_CODE';

	
	const DISCOUNT_RULE = 'discount_coupon.DISCOUNT_RULE';

	
	const PURCHASE_ID = 'discount_coupon.PURCHASE_ID';

	
	const IS_ACTIVE = 'discount_coupon.IS_ACTIVE';

	
	const HAS_USED = 'discount_coupon.HAS_USED';

	
	const ENABLED = 'discount_coupon.ENABLED';

	
	const VISIBLE = 'discount_coupon.VISIBLE';

	
	const DELETED = 'discount_coupon.DELETED';

	
	const LOCKED = 'discount_coupon.LOCKED';

	
	const CREATED_AT = 'discount_coupon.CREATED_AT';

	
	const UPDATED_AT = 'discount_coupon.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'CouponCode', 'DiscountRule', 'PurchaseId', 'IsActive', 'HasUsed', 'Enabled', 'Visible', 'Deleted', 'Locked', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (DiscountCouponPeer::ID, DiscountCouponPeer::COUPON_CODE, DiscountCouponPeer::DISCOUNT_RULE, DiscountCouponPeer::PURCHASE_ID, DiscountCouponPeer::IS_ACTIVE, DiscountCouponPeer::HAS_USED, DiscountCouponPeer::ENABLED, DiscountCouponPeer::VISIBLE, DiscountCouponPeer::DELETED, DiscountCouponPeer::LOCKED, DiscountCouponPeer::CREATED_AT, DiscountCouponPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'coupon_code', 'discount_rule', 'purchase_id', 'is_active', 'has_used', 'enabled', 'visible', 'deleted', 'locked', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'COUPON_CODE'=>'', 'DISCOUNT_RULE'=>'', 'PURCHASE_ID'=>'', 'IS_ACTIVE'=>'', 'HAS_USED'=>'', 'ENABLED'=>'', 'VISIBLE'=>'', 'DELETED'=>'', 'LOCKED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'CouponCode'=>1, 'DiscountRule'=>2, 'PurchaseId'=>3, 'IsActive'=>4, 'HasUsed'=>5, 'Enabled'=>6, 'Visible'=>7, 'Deleted'=>8, 'Locked'=>9, 'CreatedAt'=>10, 'UpdatedAt'=>11, ),
		BasePeer::TYPE_COLNAME=>array (DiscountCouponPeer::ID=>0, DiscountCouponPeer::COUPON_CODE=>1, DiscountCouponPeer::DISCOUNT_RULE=>2, DiscountCouponPeer::PURCHASE_ID=>3, DiscountCouponPeer::IS_ACTIVE=>4, DiscountCouponPeer::HAS_USED=>5, DiscountCouponPeer::ENABLED=>6, DiscountCouponPeer::VISIBLE=>7, DiscountCouponPeer::DELETED=>8, DiscountCouponPeer::LOCKED=>9, DiscountCouponPeer::CREATED_AT=>10, DiscountCouponPeer::UPDATED_AT=>11, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'coupon_code'=>1, 'discount_rule'=>2, 'purchase_id'=>3, 'is_active'=>4, 'has_used'=>5, 'enabled'=>6, 'visible'=>7, 'deleted'=>8, 'locked'=>9, 'created_at'=>10, 'updated_at'=>11, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/DiscountCouponMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.DiscountCouponMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = DiscountCouponPeer::getTableMap();
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
		return str_replace(DiscountCouponPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(DiscountCouponPeer::ID);

		$criteria->addSelectColumn(DiscountCouponPeer::COUPON_CODE);

		$criteria->addSelectColumn(DiscountCouponPeer::DISCOUNT_RULE);

		$criteria->addSelectColumn(DiscountCouponPeer::PURCHASE_ID);

		$criteria->addSelectColumn(DiscountCouponPeer::IS_ACTIVE);

		$criteria->addSelectColumn(DiscountCouponPeer::HAS_USED);

		$criteria->addSelectColumn(DiscountCouponPeer::ENABLED);

		$criteria->addSelectColumn(DiscountCouponPeer::VISIBLE);

		$criteria->addSelectColumn(DiscountCouponPeer::DELETED);

		$criteria->addSelectColumn(DiscountCouponPeer::LOCKED);

		$criteria->addSelectColumn(DiscountCouponPeer::CREATED_AT);

		$criteria->addSelectColumn(DiscountCouponPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(discount_coupon.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT discount_coupon.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DiscountCouponPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscountCouponPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DiscountCouponPeer::doSelectRS($criteria, $con);
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
		$objects = DiscountCouponPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return DiscountCouponPeer::populateObjects(DiscountCouponPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			DiscountCouponPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = DiscountCouponPeer::getOMClass();
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
			$criteria->addSelectColumn(DiscountCouponPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscountCouponPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiscountCouponPeer::PURCHASE_ID, PurchasePeer::ID);

		$rs = DiscountCouponPeer::doSelectRS($criteria, $con);
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

		DiscountCouponPeer::addSelectColumns($c);
		$startcol = (DiscountCouponPeer::NUM_COLUMNS - DiscountCouponPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PurchasePeer::addSelectColumns($c);

		$c->addJoin(DiscountCouponPeer::PURCHASE_ID, PurchasePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiscountCouponPeer::getOMClass();

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
										$temp_obj2->addDiscountCoupon($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDiscountCouponList();
				$obj2->addDiscountCoupon($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DiscountCouponPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DiscountCouponPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DiscountCouponPeer::PURCHASE_ID, PurchasePeer::ID);

		$rs = DiscountCouponPeer::doSelectRS($criteria, $con);
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

		DiscountCouponPeer::addSelectColumns($c);
		$startcol2 = (DiscountCouponPeer::NUM_COLUMNS - DiscountCouponPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PurchasePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PurchasePeer::NUM_COLUMNS;

		$c->addJoin(DiscountCouponPeer::PURCHASE_ID, PurchasePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DiscountCouponPeer::getOMClass();


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
					$temp_obj2->addDiscountCoupon($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initDiscountCouponList();
				$obj2->addDiscountCoupon($obj1);
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
		return DiscountCouponPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(DiscountCouponPeer::ID); 

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
			$comparison = $criteria->getComparison(DiscountCouponPeer::ID);
			$selectCriteria->add(DiscountCouponPeer::ID, $criteria->remove(DiscountCouponPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(DiscountCouponPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(DiscountCouponPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof DiscountCoupon) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(DiscountCouponPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(DiscountCoupon $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(DiscountCouponPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(DiscountCouponPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(DiscountCouponPeer::DATABASE_NAME, DiscountCouponPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = DiscountCouponPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(DiscountCouponPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(DiscountCouponPeer::ID, $pk);


		$v = DiscountCouponPeer::doSelect($criteria, $con);

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
			$criteria->add(DiscountCouponPeer::ID, $pks, Criteria::IN);
			$objs = DiscountCouponPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseDiscountCouponPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/DiscountCouponMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.DiscountCouponMapBuilder');
}
