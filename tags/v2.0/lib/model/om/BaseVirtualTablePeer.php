<?php


abstract class BaseVirtualTablePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'virtual_table';

	
	const CLASS_DEFAULT = 'lib.model.VirtualTable';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'virtual_table.ID';

	
	const VIRTUAL_TABLE_NAME = 'virtual_table.VIRTUAL_TABLE_NAME';

	
	const DESCRIPTION = 'virtual_table.DESCRIPTION';

	
	const TAG_NAME = 'virtual_table.TAG_NAME';

	
	const ENABLED = 'virtual_table.ENABLED';

	
	const VISIBLE = 'virtual_table.VISIBLE';

	
	const DELETED = 'virtual_table.DELETED';

	
	const LOCKED = 'virtual_table.LOCKED';

	
	const CREATED_AT = 'virtual_table.CREATED_AT';

	
	const UPDATED_AT = 'virtual_table.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'VirtualTableName', 'Description', 'TagName', 'Enabled', 'Visible', 'Deleted', 'Locked', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (VirtualTablePeer::ID, VirtualTablePeer::VIRTUAL_TABLE_NAME, VirtualTablePeer::DESCRIPTION, VirtualTablePeer::TAG_NAME, VirtualTablePeer::ENABLED, VirtualTablePeer::VISIBLE, VirtualTablePeer::DELETED, VirtualTablePeer::LOCKED, VirtualTablePeer::CREATED_AT, VirtualTablePeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'virtual_table_name', 'description', 'tag_name', 'enabled', 'visible', 'deleted', 'locked', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'VIRTUAL_TABLE_NAME'=>'', 'DESCRIPTION'=>'', 'TAG_NAME'=>'', 'ENABLED'=>'', 'VISIBLE'=>'', 'DELETED'=>'', 'LOCKED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'VirtualTableName'=>1, 'Description'=>2, 'TagName'=>3, 'Enabled'=>4, 'Visible'=>5, 'Deleted'=>6, 'Locked'=>7, 'CreatedAt'=>8, 'UpdatedAt'=>9, ),
		BasePeer::TYPE_COLNAME=>array (VirtualTablePeer::ID=>0, VirtualTablePeer::VIRTUAL_TABLE_NAME=>1, VirtualTablePeer::DESCRIPTION=>2, VirtualTablePeer::TAG_NAME=>3, VirtualTablePeer::ENABLED=>4, VirtualTablePeer::VISIBLE=>5, VirtualTablePeer::DELETED=>6, VirtualTablePeer::LOCKED=>7, VirtualTablePeer::CREATED_AT=>8, VirtualTablePeer::UPDATED_AT=>9, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'virtual_table_name'=>1, 'description'=>2, 'tag_name'=>3, 'enabled'=>4, 'visible'=>5, 'deleted'=>6, 'locked'=>7, 'created_at'=>8, 'updated_at'=>9, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/VirtualTableMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.VirtualTableMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = VirtualTablePeer::getTableMap();
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
		return str_replace(VirtualTablePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(VirtualTablePeer::ID);

		$criteria->addSelectColumn(VirtualTablePeer::VIRTUAL_TABLE_NAME);

		$criteria->addSelectColumn(VirtualTablePeer::DESCRIPTION);

		$criteria->addSelectColumn(VirtualTablePeer::TAG_NAME);

		$criteria->addSelectColumn(VirtualTablePeer::ENABLED);

		$criteria->addSelectColumn(VirtualTablePeer::VISIBLE);

		$criteria->addSelectColumn(VirtualTablePeer::DELETED);

		$criteria->addSelectColumn(VirtualTablePeer::LOCKED);

		$criteria->addSelectColumn(VirtualTablePeer::CREATED_AT);

		$criteria->addSelectColumn(VirtualTablePeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(virtual_table.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT virtual_table.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(VirtualTablePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VirtualTablePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = VirtualTablePeer::doSelectRS($criteria, $con);
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
		$objects = VirtualTablePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return VirtualTablePeer::populateObjects(VirtualTablePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			VirtualTablePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = VirtualTablePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

  
  public static function doSelectWithI18n(Criteria $c, $culture = null, $con = null)
  {
        $c = clone $c;
    if ($culture === null)
    {
      $culture = sfContext::getInstance()->getUser()->getCulture();
    }

        if ($c->getDbName() == Propel::getDefaultDB())
    {
      $c->setDbName(self::DATABASE_NAME);
    }

    VirtualTablePeer::addSelectColumns($c);
    $startcol = (VirtualTablePeer::NUM_COLUMNS - VirtualTablePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

    VirtualTableI18nPeer::addSelectColumns($c);

    $c->addJoin(VirtualTablePeer::ID, VirtualTableI18nPeer::VIRTUAL_TABLE_ID);
    $c->add(VirtualTableI18nPeer::CULTURE, $culture);

    $rs = BasePeer::doSelect($c, $con);
    $results = array();

    while($rs->next()) {

      $omClass = VirtualTablePeer::getOMClass();

      $cls = Propel::import($omClass);
      $obj1 = new $cls();
      $obj1->hydrate($rs);
      $obj1->setCulture($culture);

      $omClass = VirtualTableI18nPeer::getOMClass($rs, $startcol);

      $cls = Propel::import($omClass);
      $obj2 = new $cls();
      $obj2->hydrate($rs, $startcol);

      $obj1->setVirtualTableI18nForCulture($obj2, $culture);
      $obj2->setVirtualTable($obj1);

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
		return VirtualTablePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(VirtualTablePeer::ID); 

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
			$comparison = $criteria->getComparison(VirtualTablePeer::ID);
			$selectCriteria->add(VirtualTablePeer::ID, $criteria->remove(VirtualTablePeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(VirtualTablePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(VirtualTablePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof VirtualTable) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(VirtualTablePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(VirtualTable $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(VirtualTablePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(VirtualTablePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(VirtualTablePeer::DATABASE_NAME, VirtualTablePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = VirtualTablePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(VirtualTablePeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(VirtualTablePeer::ID, $pk);


		$v = VirtualTablePeer::doSelect($criteria, $con);

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
			$criteria->add(VirtualTablePeer::ID, $pks, Criteria::IN);
			$objs = VirtualTablePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseVirtualTablePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/VirtualTableMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.VirtualTableMapBuilder');
}
