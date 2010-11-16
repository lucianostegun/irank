<?php


abstract class BaseConfigPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'config';

	
	const CLASS_DEFAULT = 'lib.model.Config';

	
	const NUM_COLUMNS = 5;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const CONFIG_NAME = 'config.CONFIG_NAME';

	
	const DESCRIPTION = 'config.DESCRIPTION';

	
	const CONFIG_VALUE = 'config.CONFIG_VALUE';

	
	const CREATED_AT = 'config.CREATED_AT';

	
	const UPDATED_AT = 'config.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('ConfigName', 'Description', 'ConfigValue', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (ConfigPeer::CONFIG_NAME, ConfigPeer::DESCRIPTION, ConfigPeer::CONFIG_VALUE, ConfigPeer::CREATED_AT, ConfigPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('config_name', 'description', 'config_value', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('CONFIG_NAME'=>'Configuração', 'DESCRIPTION'=>'Descrição', 'CONFIG_VALUE'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('ConfigName'=>0, 'Description'=>1, 'ConfigValue'=>2, 'CreatedAt'=>3, 'UpdatedAt'=>4, ),
		BasePeer::TYPE_COLNAME=>array (ConfigPeer::CONFIG_NAME=>0, ConfigPeer::DESCRIPTION=>1, ConfigPeer::CONFIG_VALUE=>2, ConfigPeer::CREATED_AT=>3, ConfigPeer::UPDATED_AT=>4, ),
		BasePeer::TYPE_FIELDNAME=>array ('config_name'=>0, 'description'=>1, 'config_value'=>2, 'created_at'=>3, 'updated_at'=>4, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ConfigMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ConfigMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ConfigPeer::getTableMap();
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
		return str_replace(ConfigPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ConfigPeer::CONFIG_NAME);

		$criteria->addSelectColumn(ConfigPeer::DESCRIPTION);

		$criteria->addSelectColumn(ConfigPeer::CONFIG_VALUE);

		$criteria->addSelectColumn(ConfigPeer::CREATED_AT);

		$criteria->addSelectColumn(ConfigPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(config.CONFIG_NAME)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT config.CONFIG_NAME)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ConfigPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ConfigPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ConfigPeer::doSelectRS($criteria, $con);
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
		$objects = ConfigPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ConfigPeer::populateObjects(ConfigPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ConfigPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ConfigPeer::getOMClass();
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
		return ConfigPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(ConfigPeer::CONFIG_NAME);
			$selectCriteria->add(ConfigPeer::CONFIG_NAME, $criteria->remove(ConfigPeer::CONFIG_NAME), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(ConfigPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ConfigPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Config) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ConfigPeer::CONFIG_NAME, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Config $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ConfigPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ConfigPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ConfigPeer::DATABASE_NAME, ConfigPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ConfigPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ConfigPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(ConfigPeer::CONFIG_NAME, $pk);


		$v = ConfigPeer::doSelect($criteria, $con);

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
			$criteria->add(ConfigPeer::CONFIG_NAME, $pks, Criteria::IN);
			$objs = ConfigPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseConfigPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ConfigMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ConfigMapBuilder');
}
