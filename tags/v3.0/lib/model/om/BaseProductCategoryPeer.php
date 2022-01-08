<?php


abstract class BaseProductCategoryPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'product_category';

	
	const CLASS_DEFAULT = 'lib.model.ProductCategory';

	
	const NUM_COLUMNS = 11;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'product_category.ID';

	
	const CATEGORY_NAME = 'product_category.CATEGORY_NAME';

	
	const SHORT_NAME = 'product_category.SHORT_NAME';

	
	const DESCRIPTION = 'product_category.DESCRIPTION';

	
	const TAG_NAME = 'product_category.TAG_NAME';

	
	const ENABLED = 'product_category.ENABLED';

	
	const VISIBLE = 'product_category.VISIBLE';

	
	const DELETED = 'product_category.DELETED';

	
	const LOCKED = 'product_category.LOCKED';

	
	const CREATED_AT = 'product_category.CREATED_AT';

	
	const UPDATED_AT = 'product_category.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'CategoryName', 'ShortName', 'Description', 'TagName', 'Enabled', 'Visible', 'Deleted', 'Locked', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (ProductCategoryPeer::ID, ProductCategoryPeer::CATEGORY_NAME, ProductCategoryPeer::SHORT_NAME, ProductCategoryPeer::DESCRIPTION, ProductCategoryPeer::TAG_NAME, ProductCategoryPeer::ENABLED, ProductCategoryPeer::VISIBLE, ProductCategoryPeer::DELETED, ProductCategoryPeer::LOCKED, ProductCategoryPeer::CREATED_AT, ProductCategoryPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'category_name', 'short_name', 'description', 'tag_name', 'enabled', 'visible', 'deleted', 'locked', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'CATEGORY_NAME'=>'', 'SHORT_NAME'=>'', 'DESCRIPTION'=>'', 'TAG_NAME'=>'', 'ENABLED'=>'', 'VISIBLE'=>'', 'DELETED'=>'', 'LOCKED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'CategoryName'=>1, 'ShortName'=>2, 'Description'=>3, 'TagName'=>4, 'Enabled'=>5, 'Visible'=>6, 'Deleted'=>7, 'Locked'=>8, 'CreatedAt'=>9, 'UpdatedAt'=>10, ),
		BasePeer::TYPE_COLNAME=>array (ProductCategoryPeer::ID=>0, ProductCategoryPeer::CATEGORY_NAME=>1, ProductCategoryPeer::SHORT_NAME=>2, ProductCategoryPeer::DESCRIPTION=>3, ProductCategoryPeer::TAG_NAME=>4, ProductCategoryPeer::ENABLED=>5, ProductCategoryPeer::VISIBLE=>6, ProductCategoryPeer::DELETED=>7, ProductCategoryPeer::LOCKED=>8, ProductCategoryPeer::CREATED_AT=>9, ProductCategoryPeer::UPDATED_AT=>10, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'category_name'=>1, 'short_name'=>2, 'description'=>3, 'tag_name'=>4, 'enabled'=>5, 'visible'=>6, 'deleted'=>7, 'locked'=>8, 'created_at'=>9, 'updated_at'=>10, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ProductCategoryMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ProductCategoryMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ProductCategoryPeer::getTableMap();
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
		return str_replace(ProductCategoryPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ProductCategoryPeer::ID);

		$criteria->addSelectColumn(ProductCategoryPeer::CATEGORY_NAME);

		$criteria->addSelectColumn(ProductCategoryPeer::SHORT_NAME);

		$criteria->addSelectColumn(ProductCategoryPeer::DESCRIPTION);

		$criteria->addSelectColumn(ProductCategoryPeer::TAG_NAME);

		$criteria->addSelectColumn(ProductCategoryPeer::ENABLED);

		$criteria->addSelectColumn(ProductCategoryPeer::VISIBLE);

		$criteria->addSelectColumn(ProductCategoryPeer::DELETED);

		$criteria->addSelectColumn(ProductCategoryPeer::LOCKED);

		$criteria->addSelectColumn(ProductCategoryPeer::CREATED_AT);

		$criteria->addSelectColumn(ProductCategoryPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(product_category.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT product_category.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProductCategoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProductCategoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ProductCategoryPeer::doSelectRS($criteria, $con);
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
		$objects = ProductCategoryPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ProductCategoryPeer::populateObjects(ProductCategoryPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ProductCategoryPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ProductCategoryPeer::getOMClass();
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
		return ProductCategoryPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(ProductCategoryPeer::ID); 

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
			$comparison = $criteria->getComparison(ProductCategoryPeer::ID);
			$selectCriteria->add(ProductCategoryPeer::ID, $criteria->remove(ProductCategoryPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(ProductCategoryPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ProductCategoryPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof ProductCategory) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ProductCategoryPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(ProductCategory $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ProductCategoryPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ProductCategoryPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ProductCategoryPeer::DATABASE_NAME, ProductCategoryPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ProductCategoryPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ProductCategoryPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(ProductCategoryPeer::ID, $pk);


		$v = ProductCategoryPeer::doSelect($criteria, $con);

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
			$criteria->add(ProductCategoryPeer::ID, $pks, Criteria::IN);
			$objs = ProductCategoryPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseProductCategoryPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ProductCategoryMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ProductCategoryMapBuilder');
}
