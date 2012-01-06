<?php


abstract class BaseHomeWallPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'home_wall';

	
	const CLASS_DEFAULT = 'lib.model.HomeWall';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'home_wall.ID';

	
	const PEOPLE_NAME = 'home_wall.PEOPLE_NAME';

	
	const USER_SITE_ID = 'home_wall.USER_SITE_ID';

	
	const MESSAGE = 'home_wall.MESSAGE';

	
	const ICON = 'home_wall.ICON';

	
	const SHOW_WHO = 'home_wall.SHOW_WHO';

	
	const DELETED = 'home_wall.DELETED';

	
	const CREATED_AT = 'home_wall.CREATED_AT';

	
	const UPDATED_AT = 'home_wall.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'PeopleName', 'UserSiteId', 'Message', 'Icon', 'ShowWho', 'Deleted', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (HomeWallPeer::ID, HomeWallPeer::PEOPLE_NAME, HomeWallPeer::USER_SITE_ID, HomeWallPeer::MESSAGE, HomeWallPeer::ICON, HomeWallPeer::SHOW_WHO, HomeWallPeer::DELETED, HomeWallPeer::CREATED_AT, HomeWallPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'people_name', 'user_site_id', 'message', 'icon', 'show_who', 'deleted', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'PEOPLE_NAME'=>'', 'USER_SITE_ID'=>'', 'MESSAGE'=>'', 'ICON'=>'', 'SHOW_WHO'=>'', 'DELETED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'PeopleName'=>1, 'UserSiteId'=>2, 'Message'=>3, 'Icon'=>4, 'ShowWho'=>5, 'Deleted'=>6, 'CreatedAt'=>7, 'UpdatedAt'=>8, ),
		BasePeer::TYPE_COLNAME=>array (HomeWallPeer::ID=>0, HomeWallPeer::PEOPLE_NAME=>1, HomeWallPeer::USER_SITE_ID=>2, HomeWallPeer::MESSAGE=>3, HomeWallPeer::ICON=>4, HomeWallPeer::SHOW_WHO=>5, HomeWallPeer::DELETED=>6, HomeWallPeer::CREATED_AT=>7, HomeWallPeer::UPDATED_AT=>8, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'people_name'=>1, 'user_site_id'=>2, 'message'=>3, 'icon'=>4, 'show_who'=>5, 'deleted'=>6, 'created_at'=>7, 'updated_at'=>8, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/HomeWallMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.HomeWallMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = HomeWallPeer::getTableMap();
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
		return str_replace(HomeWallPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(HomeWallPeer::ID);

		$criteria->addSelectColumn(HomeWallPeer::PEOPLE_NAME);

		$criteria->addSelectColumn(HomeWallPeer::USER_SITE_ID);

		$criteria->addSelectColumn(HomeWallPeer::MESSAGE);

		$criteria->addSelectColumn(HomeWallPeer::ICON);

		$criteria->addSelectColumn(HomeWallPeer::SHOW_WHO);

		$criteria->addSelectColumn(HomeWallPeer::DELETED);

		$criteria->addSelectColumn(HomeWallPeer::CREATED_AT);

		$criteria->addSelectColumn(HomeWallPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(home_wall.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT home_wall.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HomeWallPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HomeWallPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = HomeWallPeer::doSelectRS($criteria, $con);
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
		$objects = HomeWallPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return HomeWallPeer::populateObjects(HomeWallPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			HomeWallPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = HomeWallPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinUserSite(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HomeWallPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HomeWallPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HomeWallPeer::USER_SITE_ID, UserSitePeer::ID);

		$rs = HomeWallPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinUserSite(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HomeWallPeer::addSelectColumns($c);
		$startcol = (HomeWallPeer::NUM_COLUMNS - HomeWallPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserSitePeer::addSelectColumns($c);

		$c->addJoin(HomeWallPeer::USER_SITE_ID, UserSitePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HomeWallPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserSitePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUserSite(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addHomeWall($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initHomeWallList();
				$obj2->addHomeWall($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HomeWallPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HomeWallPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HomeWallPeer::USER_SITE_ID, UserSitePeer::ID);

		$rs = HomeWallPeer::doSelectRS($criteria, $con);
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

		HomeWallPeer::addSelectColumns($c);
		$startcol2 = (HomeWallPeer::NUM_COLUMNS - HomeWallPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserSitePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserSitePeer::NUM_COLUMNS;

		$c->addJoin(HomeWallPeer::USER_SITE_ID, UserSitePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HomeWallPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = UserSitePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUserSite(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addHomeWall($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initHomeWallList();
				$obj2->addHomeWall($obj1);
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
		return HomeWallPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(HomeWallPeer::ID); 

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
			$comparison = $criteria->getComparison(HomeWallPeer::ID);
			$selectCriteria->add(HomeWallPeer::ID, $criteria->remove(HomeWallPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(HomeWallPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(HomeWallPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof HomeWall) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(HomeWallPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(HomeWall $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(HomeWallPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(HomeWallPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(HomeWallPeer::DATABASE_NAME, HomeWallPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = HomeWallPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(HomeWallPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(HomeWallPeer::ID, $pk);


		$v = HomeWallPeer::doSelect($criteria, $con);

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
			$criteria->add(HomeWallPeer::ID, $pks, Criteria::IN);
			$objs = HomeWallPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseHomeWallPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/HomeWallMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.HomeWallMapBuilder');
}
