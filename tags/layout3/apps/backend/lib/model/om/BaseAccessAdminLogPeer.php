<?php


abstract class BaseAccessAdminLogPeer {

	
	const DATABASE_NAME = 'log';

	
	const TABLE_NAME = 'access_admin_log';

	
	const CLASS_DEFAULT = '...apps.backend.lib.model.AccessAdminLog';

	
	const NUM_COLUMNS = 3;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const USER_ADMIN_ID = 'access_admin_log.USER_ADMIN_ID';

	
	const CREATED_AT = 'access_admin_log.CREATED_AT';

	
	const IP_ADDRESS = 'access_admin_log.IP_ADDRESS';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('UserAdminId', 'CreatedAt', 'IpAddress', ),
		BasePeer::TYPE_COLNAME=>array (AccessAdminLogPeer::USER_ADMIN_ID, AccessAdminLogPeer::CREATED_AT, AccessAdminLogPeer::IP_ADDRESS, ),
		BasePeer::TYPE_FIELDNAME=>array ('user_admin_id', 'created_at', 'ip_address', ),
		BasePeer::TYPE_ALIAS=>array ('USER_ADMIN_ID'=>'', 'CREATED_AT'=>'', 'IP_ADDRESS'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('UserAdminId'=>0, 'CreatedAt'=>1, 'IpAddress'=>2, ),
		BasePeer::TYPE_COLNAME=>array (AccessAdminLogPeer::USER_ADMIN_ID=>0, AccessAdminLogPeer::CREATED_AT=>1, AccessAdminLogPeer::IP_ADDRESS=>2, ),
		BasePeer::TYPE_FIELDNAME=>array ('user_admin_id'=>0, 'created_at'=>1, 'ip_address'=>2, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'apps/backend/lib/model/map/AccessAdminLogMapBuilder.php';
		return BasePeer::getMapBuilder('...apps.backend.lib.model.map.AccessAdminLogMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = AccessAdminLogPeer::getTableMap();
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
		return str_replace(AccessAdminLogPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(AccessAdminLogPeer::USER_ADMIN_ID);

		$criteria->addSelectColumn(AccessAdminLogPeer::CREATED_AT);

		$criteria->addSelectColumn(AccessAdminLogPeer::IP_ADDRESS);

	}

	const COUNT = 'COUNT(access_admin_log.USER_ADMIN_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT access_admin_log.USER_ADMIN_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AccessAdminLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AccessAdminLogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = AccessAdminLogPeer::doSelectRS($criteria, $con);
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
		$objects = AccessAdminLogPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return AccessAdminLogPeer::populateObjects(AccessAdminLogPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			AccessAdminLogPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = AccessAdminLogPeer::getOMClass();
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
		return AccessAdminLogPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(AccessAdminLogPeer::USER_ADMIN_ID);
			$selectCriteria->add(AccessAdminLogPeer::USER_ADMIN_ID, $criteria->remove(AccessAdminLogPeer::USER_ADMIN_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(AccessAdminLogPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(AccessAdminLogPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof AccessAdminLog) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(AccessAdminLogPeer::USER_ADMIN_ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(AccessAdminLog $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(AccessAdminLogPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(AccessAdminLogPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(AccessAdminLogPeer::DATABASE_NAME, AccessAdminLogPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = AccessAdminLogPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(AccessAdminLogPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(AccessAdminLogPeer::USER_ADMIN_ID, $pk);


		$v = AccessAdminLogPeer::doSelect($criteria, $con);

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
			$criteria->add(AccessAdminLogPeer::USER_ADMIN_ID, $pks, Criteria::IN);
			$objs = AccessAdminLogPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseAccessAdminLogPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'apps/backend/lib/model/map/AccessAdminLogMapBuilder.php';
	Propel::registerMapBuilder('...apps.backend.lib.model.map.AccessAdminLogMapBuilder');
}
