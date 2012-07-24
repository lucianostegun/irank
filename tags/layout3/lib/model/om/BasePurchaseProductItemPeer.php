<?php


abstract class BasePurchaseProductItemPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'purchase_product_item';

	
	const CLASS_DEFAULT = 'lib.model.PurchaseProductItem';

	
	const NUM_COLUMNS = 8;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const PURCHASE_ID = 'purchase_product_item.PURCHASE_ID';

	
	const PRODUCT_ITEM_ID = 'purchase_product_item.PRODUCT_ITEM_ID';

	
	const PRICE = 'purchase_product_item.PRICE';

	
	const WEIGHT = 'purchase_product_item.WEIGHT';

	
	const QUANTITY = 'purchase_product_item.QUANTITY';

	
	const TOTAL_VALUE = 'purchase_product_item.TOTAL_VALUE';

	
	const CREATED_AT = 'purchase_product_item.CREATED_AT';

	
	const UPDATED_AT = 'purchase_product_item.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('PurchaseId', 'ProductItemId', 'Price', 'Weight', 'Quantity', 'TotalValue', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (PurchaseProductItemPeer::PURCHASE_ID, PurchaseProductItemPeer::PRODUCT_ITEM_ID, PurchaseProductItemPeer::PRICE, PurchaseProductItemPeer::WEIGHT, PurchaseProductItemPeer::QUANTITY, PurchaseProductItemPeer::TOTAL_VALUE, PurchaseProductItemPeer::CREATED_AT, PurchaseProductItemPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('purchase_id', 'product_item_id', 'price', 'weight', 'quantity', 'total_value', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('PURCHASE_ID'=>'', 'PRODUCT_ITEM_ID'=>'', 'PRICE'=>'', 'WEIGHT'=>'', 'QUANTITY'=>'', 'TOTAL_VALUE'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('PurchaseId'=>0, 'ProductItemId'=>1, 'Price'=>2, 'Weight'=>3, 'Quantity'=>4, 'TotalValue'=>5, 'CreatedAt'=>6, 'UpdatedAt'=>7, ),
		BasePeer::TYPE_COLNAME=>array (PurchaseProductItemPeer::PURCHASE_ID=>0, PurchaseProductItemPeer::PRODUCT_ITEM_ID=>1, PurchaseProductItemPeer::PRICE=>2, PurchaseProductItemPeer::WEIGHT=>3, PurchaseProductItemPeer::QUANTITY=>4, PurchaseProductItemPeer::TOTAL_VALUE=>5, PurchaseProductItemPeer::CREATED_AT=>6, PurchaseProductItemPeer::UPDATED_AT=>7, ),
		BasePeer::TYPE_FIELDNAME=>array ('purchase_id'=>0, 'product_item_id'=>1, 'price'=>2, 'weight'=>3, 'quantity'=>4, 'total_value'=>5, 'created_at'=>6, 'updated_at'=>7, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/PurchaseProductItemMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.PurchaseProductItemMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = PurchaseProductItemPeer::getTableMap();
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
		return str_replace(PurchaseProductItemPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PurchaseProductItemPeer::PURCHASE_ID);

		$criteria->addSelectColumn(PurchaseProductItemPeer::PRODUCT_ITEM_ID);

		$criteria->addSelectColumn(PurchaseProductItemPeer::PRICE);

		$criteria->addSelectColumn(PurchaseProductItemPeer::WEIGHT);

		$criteria->addSelectColumn(PurchaseProductItemPeer::QUANTITY);

		$criteria->addSelectColumn(PurchaseProductItemPeer::TOTAL_VALUE);

		$criteria->addSelectColumn(PurchaseProductItemPeer::CREATED_AT);

		$criteria->addSelectColumn(PurchaseProductItemPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(purchase_product_item.PURCHASE_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT purchase_product_item.PURCHASE_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PurchaseProductItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PurchaseProductItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PurchaseProductItemPeer::doSelectRS($criteria, $con);
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
		$objects = PurchaseProductItemPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return PurchaseProductItemPeer::populateObjects(PurchaseProductItemPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PurchaseProductItemPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = PurchaseProductItemPeer::getOMClass();
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
			$criteria->addSelectColumn(PurchaseProductItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PurchaseProductItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PurchaseProductItemPeer::PURCHASE_ID, PurchasePeer::ID);

		$rs = PurchaseProductItemPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinProductItem(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PurchaseProductItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PurchaseProductItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PurchaseProductItemPeer::PRODUCT_ITEM_ID, ProductItemPeer::ID);

		$rs = PurchaseProductItemPeer::doSelectRS($criteria, $con);
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

		PurchaseProductItemPeer::addSelectColumns($c);
		$startcol = (PurchaseProductItemPeer::NUM_COLUMNS - PurchaseProductItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PurchasePeer::addSelectColumns($c);

		$c->addJoin(PurchaseProductItemPeer::PURCHASE_ID, PurchasePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PurchaseProductItemPeer::getOMClass();

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
										$temp_obj2->addPurchaseProductItem($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPurchaseProductItemList();
				$obj2->addPurchaseProductItem($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinProductItem(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PurchaseProductItemPeer::addSelectColumns($c);
		$startcol = (PurchaseProductItemPeer::NUM_COLUMNS - PurchaseProductItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProductItemPeer::addSelectColumns($c);

		$c->addJoin(PurchaseProductItemPeer::PRODUCT_ITEM_ID, ProductItemPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PurchaseProductItemPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProductItemPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getProductItem(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addPurchaseProductItem($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPurchaseProductItemList();
				$obj2->addPurchaseProductItem($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PurchaseProductItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PurchaseProductItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PurchaseProductItemPeer::PURCHASE_ID, PurchasePeer::ID);

		$criteria->addJoin(PurchaseProductItemPeer::PRODUCT_ITEM_ID, ProductItemPeer::ID);

		$rs = PurchaseProductItemPeer::doSelectRS($criteria, $con);
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

		PurchaseProductItemPeer::addSelectColumns($c);
		$startcol2 = (PurchaseProductItemPeer::NUM_COLUMNS - PurchaseProductItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PurchasePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PurchasePeer::NUM_COLUMNS;

		ProductItemPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProductItemPeer::NUM_COLUMNS;

		$c->addJoin(PurchaseProductItemPeer::PURCHASE_ID, PurchasePeer::ID);

		$c->addJoin(PurchaseProductItemPeer::PRODUCT_ITEM_ID, ProductItemPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PurchaseProductItemPeer::getOMClass();


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
					$temp_obj2->addPurchaseProductItem($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initPurchaseProductItemList();
				$obj2->addPurchaseProductItem($obj1);
			}


					
			$omClass = ProductItemPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProductItem(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addPurchaseProductItem($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initPurchaseProductItemList();
				$obj3->addPurchaseProductItem($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptPurchase(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PurchaseProductItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PurchaseProductItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PurchaseProductItemPeer::PRODUCT_ITEM_ID, ProductItemPeer::ID);

		$rs = PurchaseProductItemPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptProductItem(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PurchaseProductItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PurchaseProductItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PurchaseProductItemPeer::PURCHASE_ID, PurchasePeer::ID);

		$rs = PurchaseProductItemPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptPurchase(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PurchaseProductItemPeer::addSelectColumns($c);
		$startcol2 = (PurchaseProductItemPeer::NUM_COLUMNS - PurchaseProductItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProductItemPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProductItemPeer::NUM_COLUMNS;

		$c->addJoin(PurchaseProductItemPeer::PRODUCT_ITEM_ID, ProductItemPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PurchaseProductItemPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProductItemPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProductItem(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPurchaseProductItem($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPurchaseProductItemList();
				$obj2->addPurchaseProductItem($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptProductItem(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PurchaseProductItemPeer::addSelectColumns($c);
		$startcol2 = (PurchaseProductItemPeer::NUM_COLUMNS - PurchaseProductItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PurchasePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PurchasePeer::NUM_COLUMNS;

		$c->addJoin(PurchaseProductItemPeer::PURCHASE_ID, PurchasePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PurchaseProductItemPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PurchasePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPurchase(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPurchaseProductItem($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPurchaseProductItemList();
				$obj2->addPurchaseProductItem($obj1);
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
		return PurchaseProductItemPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}


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
			$comparison = $criteria->getComparison(PurchaseProductItemPeer::PURCHASE_ID);
			$selectCriteria->add(PurchaseProductItemPeer::PURCHASE_ID, $criteria->remove(PurchaseProductItemPeer::PURCHASE_ID), $comparison);

			$comparison = $criteria->getComparison(PurchaseProductItemPeer::PRODUCT_ITEM_ID);
			$selectCriteria->add(PurchaseProductItemPeer::PRODUCT_ITEM_ID, $criteria->remove(PurchaseProductItemPeer::PRODUCT_ITEM_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(PurchaseProductItemPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PurchaseProductItemPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof PurchaseProductItem) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
												if(count($values) == count($values, COUNT_RECURSIVE))
			{
								$values = array($values);
			}
			$vals = array();
			foreach($values as $value)
			{

				$vals[0][] = $value[0];
				$vals[1][] = $value[1];
			}

			$criteria->add(PurchaseProductItemPeer::PURCHASE_ID, $vals[0], Criteria::IN);
			$criteria->add(PurchaseProductItemPeer::PRODUCT_ITEM_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(PurchaseProductItem $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PurchaseProductItemPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PurchaseProductItemPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PurchaseProductItemPeer::DATABASE_NAME, PurchaseProductItemPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PurchaseProductItemPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $purchase_id, $product_item_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(PurchaseProductItemPeer::PURCHASE_ID, $purchase_id);
		$criteria->add(PurchaseProductItemPeer::PRODUCT_ITEM_ID, $product_item_id);
		$v = PurchaseProductItemPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BasePurchaseProductItemPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/PurchaseProductItemMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.PurchaseProductItemMapBuilder');
}