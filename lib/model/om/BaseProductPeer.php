<?php


abstract class BaseProductPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'product';

	
	const CLASS_DEFAULT = 'lib.model.Product';

	
	const NUM_COLUMNS = 21;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'product.ID';

	
	const PRODUCT_CODE = 'product.PRODUCT_CODE';

	
	const PRODUCT_CATEGORY_ID = 'product.PRODUCT_CATEGORY_ID';

	
	const PRODUCT_NAME = 'product.PRODUCT_NAME';

	
	const SHORT_NAME = 'product.SHORT_NAME';

	
	const DESCRIPTION = 'product.DESCRIPTION';

	
	const DEFAULT_PRICE = 'product.DEFAULT_PRICE';

	
	const DEFAULT_WEIGHT = 'product.DEFAULT_WEIGHT';

	
	const IS_NEW = 'product.IS_NEW';

	
	const STOCK = 'product.STOCK';

	
	const IMAGE_1 = 'product.IMAGE_1';

	
	const IMAGE_2 = 'product.IMAGE_2';

	
	const IMAGE_3 = 'product.IMAGE_3';

	
	const IMAGE_4 = 'product.IMAGE_4';

	
	const IMAGE_5 = 'product.IMAGE_5';

	
	const ENABLED = 'product.ENABLED';

	
	const VISIBLE = 'product.VISIBLE';

	
	const DELETED = 'product.DELETED';

	
	const LOCKED = 'product.LOCKED';

	
	const CREATED_AT = 'product.CREATED_AT';

	
	const UPDATED_AT = 'product.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'ProductCode', 'ProductCategoryId', 'ProductName', 'ShortName', 'Description', 'DefaultPrice', 'DefaultWeight', 'IsNew', 'Stock', 'Image1', 'Image2', 'Image3', 'Image4', 'Image5', 'Enabled', 'Visible', 'Deleted', 'Locked', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (ProductPeer::ID, ProductPeer::PRODUCT_CODE, ProductPeer::PRODUCT_CATEGORY_ID, ProductPeer::PRODUCT_NAME, ProductPeer::SHORT_NAME, ProductPeer::DESCRIPTION, ProductPeer::DEFAULT_PRICE, ProductPeer::DEFAULT_WEIGHT, ProductPeer::IS_NEW, ProductPeer::STOCK, ProductPeer::IMAGE_1, ProductPeer::IMAGE_2, ProductPeer::IMAGE_3, ProductPeer::IMAGE_4, ProductPeer::IMAGE_5, ProductPeer::ENABLED, ProductPeer::VISIBLE, ProductPeer::DELETED, ProductPeer::LOCKED, ProductPeer::CREATED_AT, ProductPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'product_code', 'product_category_id', 'product_name', 'short_name', 'description', 'default_price', 'default_weight', 'is_new', 'stock', 'image_1', 'image_2', 'image_3', 'image_4', 'image_5', 'enabled', 'visible', 'deleted', 'locked', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'PRODUCT_CODE'=>'', 'PRODUCT_CATEGORY_ID'=>'', 'PRODUCT_NAME'=>'', 'SHORT_NAME'=>'', 'DESCRIPTION'=>'', 'DEFAULT_PRICE'=>'', 'DEFAULT_WEIGHT'=>'', 'IS_NEW'=>'', 'STOCK'=>'', 'IMAGE_1'=>'', 'IMAGE_2'=>'', 'IMAGE_3'=>'', 'IMAGE_4'=>'', 'IMAGE_5'=>'', 'ENABLED'=>'', 'VISIBLE'=>'', 'DELETED'=>'', 'LOCKED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'ProductCode'=>1, 'ProductCategoryId'=>2, 'ProductName'=>3, 'ShortName'=>4, 'Description'=>5, 'DefaultPrice'=>6, 'DefaultWeight'=>7, 'IsNew'=>8, 'Stock'=>9, 'Image1'=>10, 'Image2'=>11, 'Image3'=>12, 'Image4'=>13, 'Image5'=>14, 'Enabled'=>15, 'Visible'=>16, 'Deleted'=>17, 'Locked'=>18, 'CreatedAt'=>19, 'UpdatedAt'=>20, ),
		BasePeer::TYPE_COLNAME=>array (ProductPeer::ID=>0, ProductPeer::PRODUCT_CODE=>1, ProductPeer::PRODUCT_CATEGORY_ID=>2, ProductPeer::PRODUCT_NAME=>3, ProductPeer::SHORT_NAME=>4, ProductPeer::DESCRIPTION=>5, ProductPeer::DEFAULT_PRICE=>6, ProductPeer::DEFAULT_WEIGHT=>7, ProductPeer::IS_NEW=>8, ProductPeer::STOCK=>9, ProductPeer::IMAGE_1=>10, ProductPeer::IMAGE_2=>11, ProductPeer::IMAGE_3=>12, ProductPeer::IMAGE_4=>13, ProductPeer::IMAGE_5=>14, ProductPeer::ENABLED=>15, ProductPeer::VISIBLE=>16, ProductPeer::DELETED=>17, ProductPeer::LOCKED=>18, ProductPeer::CREATED_AT=>19, ProductPeer::UPDATED_AT=>20, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'product_code'=>1, 'product_category_id'=>2, 'product_name'=>3, 'short_name'=>4, 'description'=>5, 'default_price'=>6, 'default_weight'=>7, 'is_new'=>8, 'stock'=>9, 'image_1'=>10, 'image_2'=>11, 'image_3'=>12, 'image_4'=>13, 'image_5'=>14, 'enabled'=>15, 'visible'=>16, 'deleted'=>17, 'locked'=>18, 'created_at'=>19, 'updated_at'=>20, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ProductMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ProductMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ProductPeer::getTableMap();
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
		return str_replace(ProductPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ProductPeer::ID);

		$criteria->addSelectColumn(ProductPeer::PRODUCT_CODE);

		$criteria->addSelectColumn(ProductPeer::PRODUCT_CATEGORY_ID);

		$criteria->addSelectColumn(ProductPeer::PRODUCT_NAME);

		$criteria->addSelectColumn(ProductPeer::SHORT_NAME);

		$criteria->addSelectColumn(ProductPeer::DESCRIPTION);

		$criteria->addSelectColumn(ProductPeer::DEFAULT_PRICE);

		$criteria->addSelectColumn(ProductPeer::DEFAULT_WEIGHT);

		$criteria->addSelectColumn(ProductPeer::IS_NEW);

		$criteria->addSelectColumn(ProductPeer::STOCK);

		$criteria->addSelectColumn(ProductPeer::IMAGE_1);

		$criteria->addSelectColumn(ProductPeer::IMAGE_2);

		$criteria->addSelectColumn(ProductPeer::IMAGE_3);

		$criteria->addSelectColumn(ProductPeer::IMAGE_4);

		$criteria->addSelectColumn(ProductPeer::IMAGE_5);

		$criteria->addSelectColumn(ProductPeer::ENABLED);

		$criteria->addSelectColumn(ProductPeer::VISIBLE);

		$criteria->addSelectColumn(ProductPeer::DELETED);

		$criteria->addSelectColumn(ProductPeer::LOCKED);

		$criteria->addSelectColumn(ProductPeer::CREATED_AT);

		$criteria->addSelectColumn(ProductPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(product.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT product.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProductPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProductPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ProductPeer::doSelectRS($criteria, $con);
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
		$objects = ProductPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ProductPeer::populateObjects(ProductPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ProductPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ProductPeer::getOMClass();
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
			$criteria->addSelectColumn(ProductPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProductPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProductPeer::PRODUCT_CATEGORY_ID, ProductCategoryPeer::ID);

		$rs = ProductPeer::doSelectRS($criteria, $con);
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

		ProductPeer::addSelectColumns($c);
		$startcol = (ProductPeer::NUM_COLUMNS - ProductPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProductCategoryPeer::addSelectColumns($c);

		$c->addJoin(ProductPeer::PRODUCT_CATEGORY_ID, ProductCategoryPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProductPeer::getOMClass();

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
										$temp_obj2->addProduct($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initProductList();
				$obj2->addProduct($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProductPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProductPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProductPeer::PRODUCT_CATEGORY_ID, ProductCategoryPeer::ID);

		$rs = ProductPeer::doSelectRS($criteria, $con);
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

		ProductPeer::addSelectColumns($c);
		$startcol2 = (ProductPeer::NUM_COLUMNS - ProductPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProductCategoryPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProductCategoryPeer::NUM_COLUMNS;

		$c->addJoin(ProductPeer::PRODUCT_CATEGORY_ID, ProductCategoryPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProductPeer::getOMClass();


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
					$temp_obj2->addProduct($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initProductList();
				$obj2->addProduct($obj1);
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
		return ProductPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(ProductPeer::ID); 

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
			$comparison = $criteria->getComparison(ProductPeer::ID);
			$selectCriteria->add(ProductPeer::ID, $criteria->remove(ProductPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(ProductPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ProductPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Product) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ProductPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Product $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ProductPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ProductPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ProductPeer::DATABASE_NAME, ProductPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ProductPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ProductPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(ProductPeer::ID, $pk);


		$v = ProductPeer::doSelect($criteria, $con);

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
			$criteria->add(ProductPeer::ID, $pks, Criteria::IN);
			$objs = ProductPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseProductPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ProductMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ProductMapBuilder');
}
