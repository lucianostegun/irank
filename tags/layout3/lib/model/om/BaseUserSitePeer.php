<?php


abstract class BaseUserSitePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'user_site';

	
	const CLASS_DEFAULT = 'lib.model.UserSite';

	
	const NUM_COLUMNS = 18;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'user_site.ID';

	
	const PEOPLE_ID = 'user_site.PEOPLE_ID';

	
	const USERNAME = 'user_site.USERNAME';

	
	const PASSWORD = 'user_site.PASSWORD';

	
	const HTPASSWD_LINE = 'user_site.HTPASSWD_LINE';

	
	const IMAGE_PATH = 'user_site.IMAGE_PATH';

	
	const SIGNED_SCHEDULE = 'user_site.SIGNED_SCHEDULE';

	
	const SCHEDULE_START_DATE = 'user_site.SCHEDULE_START_DATE';

	
	const DEVICEUDID = 'user_site.DEVICEUDID';

	
	const MOBILE_TOKEN = 'user_site.MOBILE_TOKEN';

	
	const ACTIVE = 'user_site.ACTIVE';

	
	const ENABLED = 'user_site.ENABLED';

	
	const VISIBLE = 'user_site.VISIBLE';

	
	const DELETED = 'user_site.DELETED';

	
	const LOCKED = 'user_site.LOCKED';

	
	const LAST_ACCESS_DATE = 'user_site.LAST_ACCESS_DATE';

	
	const CREATED_AT = 'user_site.CREATED_AT';

	
	const UPDATED_AT = 'user_site.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'PeopleId', 'Username', 'Password', 'HtpasswdLine', 'ImagePath', 'SignedSchedule', 'ScheduleStartDate', 'Deviceudid', 'MobileToken', 'Active', 'Enabled', 'Visible', 'Deleted', 'Locked', 'LastAccessDate', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (UserSitePeer::ID, UserSitePeer::PEOPLE_ID, UserSitePeer::USERNAME, UserSitePeer::PASSWORD, UserSitePeer::HTPASSWD_LINE, UserSitePeer::IMAGE_PATH, UserSitePeer::SIGNED_SCHEDULE, UserSitePeer::SCHEDULE_START_DATE, UserSitePeer::DEVICEUDID, UserSitePeer::MOBILE_TOKEN, UserSitePeer::ACTIVE, UserSitePeer::ENABLED, UserSitePeer::VISIBLE, UserSitePeer::DELETED, UserSitePeer::LOCKED, UserSitePeer::LAST_ACCESS_DATE, UserSitePeer::CREATED_AT, UserSitePeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'people_id', 'username', 'password', 'htpasswd_line', 'image_path', 'signed_schedule', 'schedule_start_date', 'deviceUDID', 'mobile_token', 'active', 'enabled', 'visible', 'deleted', 'locked', 'last_access_date', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'PEOPLE_ID'=>'', 'USERNAME'=>'', 'PASSWORD'=>'', 'HTPASSWD_LINE'=>'', 'IMAGE_PATH'=>'', 'SIGNED_SCHEDULE'=>'', 'SCHEDULE_START_DATE'=>'', 'DEVICEUDID'=>'', 'MOBILE_TOKEN'=>'', 'ACTIVE'=>'', 'ENABLED'=>'', 'VISIBLE'=>'', 'DELETED'=>'', 'LOCKED'=>'', 'LAST_ACCESS_DATE'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'PeopleId'=>1, 'Username'=>2, 'Password'=>3, 'HtpasswdLine'=>4, 'ImagePath'=>5, 'SignedSchedule'=>6, 'ScheduleStartDate'=>7, 'Deviceudid'=>8, 'MobileToken'=>9, 'Active'=>10, 'Enabled'=>11, 'Visible'=>12, 'Deleted'=>13, 'Locked'=>14, 'LastAccessDate'=>15, 'CreatedAt'=>16, 'UpdatedAt'=>17, ),
		BasePeer::TYPE_COLNAME=>array (UserSitePeer::ID=>0, UserSitePeer::PEOPLE_ID=>1, UserSitePeer::USERNAME=>2, UserSitePeer::PASSWORD=>3, UserSitePeer::HTPASSWD_LINE=>4, UserSitePeer::IMAGE_PATH=>5, UserSitePeer::SIGNED_SCHEDULE=>6, UserSitePeer::SCHEDULE_START_DATE=>7, UserSitePeer::DEVICEUDID=>8, UserSitePeer::MOBILE_TOKEN=>9, UserSitePeer::ACTIVE=>10, UserSitePeer::ENABLED=>11, UserSitePeer::VISIBLE=>12, UserSitePeer::DELETED=>13, UserSitePeer::LOCKED=>14, UserSitePeer::LAST_ACCESS_DATE=>15, UserSitePeer::CREATED_AT=>16, UserSitePeer::UPDATED_AT=>17, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'people_id'=>1, 'username'=>2, 'password'=>3, 'htpasswd_line'=>4, 'image_path'=>5, 'signed_schedule'=>6, 'schedule_start_date'=>7, 'deviceUDID'=>8, 'mobile_token'=>9, 'active'=>10, 'enabled'=>11, 'visible'=>12, 'deleted'=>13, 'locked'=>14, 'last_access_date'=>15, 'created_at'=>16, 'updated_at'=>17, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/UserSiteMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.UserSiteMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = UserSitePeer::getTableMap();
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
		return str_replace(UserSitePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(UserSitePeer::ID);

		$criteria->addSelectColumn(UserSitePeer::PEOPLE_ID);

		$criteria->addSelectColumn(UserSitePeer::USERNAME);

		$criteria->addSelectColumn(UserSitePeer::PASSWORD);

		$criteria->addSelectColumn(UserSitePeer::HTPASSWD_LINE);

		$criteria->addSelectColumn(UserSitePeer::IMAGE_PATH);

		$criteria->addSelectColumn(UserSitePeer::SIGNED_SCHEDULE);

		$criteria->addSelectColumn(UserSitePeer::SCHEDULE_START_DATE);

		$criteria->addSelectColumn(UserSitePeer::DEVICEUDID);

		$criteria->addSelectColumn(UserSitePeer::MOBILE_TOKEN);

		$criteria->addSelectColumn(UserSitePeer::ACTIVE);

		$criteria->addSelectColumn(UserSitePeer::ENABLED);

		$criteria->addSelectColumn(UserSitePeer::VISIBLE);

		$criteria->addSelectColumn(UserSitePeer::DELETED);

		$criteria->addSelectColumn(UserSitePeer::LOCKED);

		$criteria->addSelectColumn(UserSitePeer::LAST_ACCESS_DATE);

		$criteria->addSelectColumn(UserSitePeer::CREATED_AT);

		$criteria->addSelectColumn(UserSitePeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(user_site.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT user_site.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UserSitePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UserSitePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = UserSitePeer::doSelectRS($criteria, $con);
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
		$objects = UserSitePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return UserSitePeer::populateObjects(UserSitePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			UserSitePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = UserSitePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinPeople(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UserSitePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UserSitePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UserSitePeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = UserSitePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinPeople(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UserSitePeer::addSelectColumns($c);
		$startcol = (UserSitePeer::NUM_COLUMNS - UserSitePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PeoplePeer::addSelectColumns($c);

		$c->addJoin(UserSitePeer::PEOPLE_ID, PeoplePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = UserSitePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PeoplePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getPeople(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addUserSite($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initUserSiteList();
				$obj2->addUserSite($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UserSitePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UserSitePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UserSitePeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = UserSitePeer::doSelectRS($criteria, $con);
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

		UserSitePeer::addSelectColumns($c);
		$startcol2 = (UserSitePeer::NUM_COLUMNS - UserSitePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PeoplePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(UserSitePeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = UserSitePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = PeoplePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPeople(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addUserSite($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initUserSiteList();
				$obj2->addUserSite($obj1);
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
		return UserSitePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(UserSitePeer::ID); 

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
			$comparison = $criteria->getComparison(UserSitePeer::ID);
			$selectCriteria->add(UserSitePeer::ID, $criteria->remove(UserSitePeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(UserSitePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(UserSitePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof UserSite) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(UserSitePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(UserSite $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(UserSitePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(UserSitePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(UserSitePeer::DATABASE_NAME, UserSitePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = UserSitePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(UserSitePeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(UserSitePeer::ID, $pk);


		$v = UserSitePeer::doSelect($criteria, $con);

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
			$criteria->add(UserSitePeer::ID, $pks, Criteria::IN);
			$objs = UserSitePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseUserSitePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/UserSiteMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.UserSiteMapBuilder');
}
