<?php


abstract class BaseProductOptionPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'product_option';

	
	const CLASS_DEFAULT = 'lib.model.ProductOption';

	
	const NUM_COLUMNS = 14;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'product_option.ID';

	
	const PRODUCT_CATEGORY_ID = 'product_option.PRODUCT_CATEGORY_ID';

	
	const OPTION_TYPE = 'product_option.OPTION_TYPE';

	
	const OPTION_NAME = 'product_option.OPTION_NAME';

	
	const DESCRIPTION = 'product_option.DESCRIPTION';

	
	const TAG_NAME = 'product_option.TAG_NAME';

	
	const IS_DEFAULT = 'product_option.IS_DEFAULT';

	
	const ORDER_SEQ = 'product_option.ORDER_SEQ';

	
	const ENABLED = 'product_option.ENABLED';

	
	const VISIBLE = 'product_option.VISIBLE';

	
	const DELETED = 'product_option.DELETED';

	
	const LOCKED = 'product_option.LOCKED';

	
	const CREATED_AT = 'product_option.CREATED_AT';

	
	const UPDATED_AT = 'product_option.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'ProductCategoryId', 'OptionType', 'OptionName', 'Description', 'TagName', 'IsDefault', 'OrderSeq', 'Enabled', 'Visible', 'Deleted', 'Locked', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (ProductOptionPeer::ID, ProductOptionPeer::PRODUCT_CATEGORY_ID, ProductOptionPeer::OPTION_TYPE, ProductOptionPeer::OPTION_NAME, ProductOptionPeer::DESCRIPTION, ProductOptionPeer::TAG_NAME, ProductOptionPeer::IS_DEFAULT, ProductOptionPeer::ORDER_SEQ, ProductOptionPeer::ENABLED, ProductOptionPeer::VISIBLE, ProductOptionPeer::DELETED, ProductOptionPeer::LOCKED, ProductOptionPeer::CREATED_AT, ProductOptionPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'product_category_id', 'option_type', 'option_name', 'description', 'tag_name', 'is_default', 'order_seq', 'enabled', 'visible', 'deleted', 'locked', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'PRODUCT_CATEGORY_ID'=>'', 'OPTION_TYPE'=>'', 'OPTION_NAME'=>'', 'DESCRIPTION'=>'', 'TAG_NAME'=>'', 'IS_DEFAULT'=>'', 'ORDER_SEQ'=>'', 'ENABLED'=>'', 'VISIBLE'=>'', 'DELETED'=>'', 'LOCKED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'ProductCategoryId'=>1, 'OptionType'=>2, 'OptionName'=>3, 'Description'=>4, 'TagName'=>5, 'IsDefault'=>6, 'OrderSeq'=>7, 'Enabled'=>8, 'Visible'=>9, 'Deleted'=>10, 'Locked'=>11, 'CreatedAt'=>12, 'UpdatedAt'=>13, ),
		BasePeer::TYPE_COLNAME=>array (ProductOptionPeer::ID=>0, ProductOptionPeer::PRODUCT_CATEGORY_ID=>1, ProductOptionPeer::OPTION_TYPE=>2, ProductOptionPeer::OPTION_NAME=>3, ProductOptionPeer::DESCRIPTION=>4, ProductOptionPeer::TAG_NAME=>5, ProductOptionPeer::IS_DEFAULT=>6, ProductOptionPeer::ORDER_SEQ=>7, ProductOptionPeer::ENABLED=>8, ProductOptionPeer::VISIBLE=>9, ProductOptionPeer::DELETED=>10, ProductOptionPeer::LOCKED=>11, ProductOptionPeer::CREATED_AT=>12, ProductOptionPeer::UPDATED_AT=>13, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'product_category_id'=>1, 'option_type'=>2, 'option_name'=>3, 'description'=>4, 'tag_name'=>5, 'is_default'=>6, 'order_seq'=>7, 'enabled'=>8, 'visible'=>9, 'deleted'=>10, 'locked'=>11, 'created_at'=>12, 'updated_at'=>13, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ProductOptionMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ProductOptionMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ProductOptionPeer::getTableMap();
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
		return str_replace(ProductOptionPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ProductOptionPeer::ID);

		$criteria->addSelectColumn(ProductOptionPeer::PRODUCT_CATEGORY_ID);

		$criteria->addSelectColumn(ProductOptionPeer::OPTION_TYPE);

		$criteria->addSelectColumn(ProductOptionPeer::OPTION_NAME);

		$criteria->addSelectColumn(ProductOptionPeer::DESCRIPTION);

		$criteria->addSelectColumn(ProductOptionPeer::TAG_NAME);

		$criteria->addSelectColumn(ProductOptionPeer::IS_DEFAULT);

		$criteria->addSelectColumn(ProductOptionPeer::ORDER_SEQ);

		$criteria->addSelectColumn(ProductOptionPeer::ENABLED);

		$criteria->addSelectColumn(ProductOptionPeer::VISIBLE);

		$criteria->addSelectColumn(ProductOptionPeer::DELETED);

		$criteria->addSelectColumn(ProductOptionPeer::LOCKED);

		$criteria->addSelectColumn(ProductOptionPeer::CREATED_AT);

		$criteria->addSelectColumn(ProductOptionPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(product_option.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT product_option.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProductOptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProductOptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ProductOptionPeer::doSelectRS($criteria, $con);
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
		$objects = ProductOptionPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ProductOptionPeer::populateObjects(ProductOptionPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ProductOptionPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ProductOptionPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinProductCategory(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProductOptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProductOptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProductOptionPeer::PRODUCT_CATEGORY_ID, ProductCategoryPeer::ID);

		$rs = ProductOptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinProductCategory(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProductOptionPeer::addSelectColumns($c);
		$startcol = (ProductOptionPeer::NUM_COLUMNS - ProductOptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProductCategoryPeer::addSelectColumns($c);

		$c->addJoin(ProductOptionPeer::PRODUCT_CATEGORY_ID, ProductCategoryPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProductOptionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProductCategoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getProductCategory(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addProductOption($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initProductOptionList();
				$obj2->addProductOption($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProductOptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProductOptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProductOptionPeer::PRODUCT_CATEGORY_ID, ProductCategoryPeer::ID);

		$rs = ProductOptionPeer::doSelectRS($criteria, $con);
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

		ProductOptionPeer::addSelectColumns($c);
		$startcol2 = (ProductOptionPeer::NUM_COLUMNS - ProductOptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProductCategoryPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProductCategoryPeer::NUM_COLUMNS;

		$c->addJoin(ProductOptionPeer::PRODUCT_CATEGORY_ID, ProductCategoryPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProductOptionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = ProductCategoryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProductCategory(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addProductOption($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initProductOptionList();
				$obj2->addProductOption($obj1);
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
		return ProductOptionPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(ProductOptionPeer::ID); 

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
			$comparison = $criteria->getComparison(ProductOptionPeer::ID);
			$selectCriteria->add(ProductOptionPeer::ID, $criteria->remove(ProductOptionPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(ProductOptionPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ProductOptionPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof ProductOption) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ProductOptionPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(ProductOption $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ProductOptionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ProductOptionPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ProductOptionPeer::DATABASE_NAME, ProductOptionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ProductOptionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ProductOptionPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(ProductOptionPeer::ID, $pk);


		$v = ProductOptionPeer::doSelect($criteria, $con);

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
			$criteria->add(ProductOptionPeer::ID, $pks, Criteria::IN);
			$objs = ProductOptionPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseProductOptionPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ProductOptionMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ProductOptionMapBuilder');
}
