<?php


abstract class BaseLogPeer {

	
	const DATABASE_NAME = 'log';

	
	const TABLE_NAME = 'log';

	
	const CLASS_DEFAULT = 'lib.model.Log';

	
	const NUM_COLUMNS = 11;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'log.ID';

	
	const USER_SITE_ID = 'log.USER_SITE_ID';

	
	const USER_ADMIN_ID = 'log.USER_ADMIN_ID';

	
	const APP = 'log.APP';

	
	const MODULE_NAME = 'log.MODULE_NAME';

	
	const ACTION_NAME = 'log.ACTION_NAME';

	
	const CLASS_NAME = 'log.CLASS_NAME';

	
	const SEVERITY = 'log.SEVERITY';

	
	const MESSAGE = 'log.MESSAGE';

	
	const CREATED_AT = 'log.CREATED_AT';

	
	const UPDATED_AT = 'log.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'UserSiteId', 'UserAdminId', 'App', 'ModuleName', 'ActionName', 'ClassName', 'Severity', 'Message', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (LogPeer::ID, LogPeer::USER_SITE_ID, LogPeer::USER_ADMIN_ID, LogPeer::APP, LogPeer::MODULE_NAME, LogPeer::ACTION_NAME, LogPeer::CLASS_NAME, LogPeer::SEVERITY, LogPeer::MESSAGE, LogPeer::CREATED_AT, LogPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'user_site_id', 'user_admin_id', 'app', 'module_name', 'action_name', 'class_name', 'severity', 'message', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'USER_SITE_ID'=>'', 'USER_ADMIN_ID'=>'', 'APP'=>'', 'MODULE_NAME'=>'', 'ACTION_NAME'=>'', 'CLASS_NAME'=>'', 'SEVERITY'=>'', 'MESSAGE'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'UserSiteId'=>1, 'UserAdminId'=>2, 'App'=>3, 'ModuleName'=>4, 'ActionName'=>5, 'ClassName'=>6, 'Severity'=>7, 'Message'=>8, 'CreatedAt'=>9, 'UpdatedAt'=>10, ),
		BasePeer::TYPE_COLNAME=>array (LogPeer::ID=>0, LogPeer::USER_SITE_ID=>1, LogPeer::USER_ADMIN_ID=>2, LogPeer::APP=>3, LogPeer::MODULE_NAME=>4, LogPeer::ACTION_NAME=>5, LogPeer::CLASS_NAME=>6, LogPeer::SEVERITY=>7, LogPeer::MESSAGE=>8, LogPeer::CREATED_AT=>9, LogPeer::UPDATED_AT=>10, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'user_site_id'=>1, 'user_admin_id'=>2, 'app'=>3, 'module_name'=>4, 'action_name'=>5, 'class_name'=>6, 'severity'=>7, 'message'=>8, 'created_at'=>9, 'updated_at'=>10, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/LogMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.LogMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = LogPeer::getTableMap();
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
		return str_replace(LogPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(LogPeer::ID);

		$criteria->addSelectColumn(LogPeer::USER_SITE_ID);

		$criteria->addSelectColumn(LogPeer::USER_ADMIN_ID);

		$criteria->addSelectColumn(LogPeer::APP);

		$criteria->addSelectColumn(LogPeer::MODULE_NAME);

		$criteria->addSelectColumn(LogPeer::ACTION_NAME);

		$criteria->addSelectColumn(LogPeer::CLASS_NAME);

		$criteria->addSelectColumn(LogPeer::SEVERITY);

		$criteria->addSelectColumn(LogPeer::MESSAGE);

		$criteria->addSelectColumn(LogPeer::CREATED_AT);

		$criteria->addSelectColumn(LogPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(log.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT log.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(LogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(LogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = LogPeer::doSelectRS($criteria, $con);
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
		$objects = LogPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return LogPeer::populateObjects(LogPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			LogPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = LogPeer::getOMClass();
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
		return LogPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(LogPeer::ID); 

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
			$comparison = $criteria->getComparison(LogPeer::ID);
			$selectCriteria->add(LogPeer::ID, $criteria->remove(LogPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(LogPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(LogPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Log) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(LogPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Log $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(LogPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(LogPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(LogPeer::DATABASE_NAME, LogPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = LogPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(LogPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(LogPeer::ID, $pk);


		$v = LogPeer::doSelect($criteria, $con);

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
			$criteria->add(LogPeer::ID, $pks, Criteria::IN);
			$objs = LogPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseLogPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/LogMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.LogMapBuilder');
}
