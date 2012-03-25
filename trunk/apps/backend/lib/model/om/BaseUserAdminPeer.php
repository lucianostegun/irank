<?php


abstract class BaseUserAdminPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'user_admin';

	
	const CLASS_DEFAULT = '...apps.backend.lib.model.UserAdmin';

	
	const NUM_COLUMNS = 14;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'user_admin.ID';

	
	const PEOPLE_ID = 'user_admin.PEOPLE_ID';

	
	const CLUB_ID = 'user_admin.CLUB_ID';

	
	const USERNAME = 'user_admin.USERNAME';

	
	const PASSWORD = 'user_admin.PASSWORD';

	
	const ACTIVE = 'user_admin.ACTIVE';

	
	const MASTER = 'user_admin.MASTER';

	
	const ENABLED = 'user_admin.ENABLED';

	
	const VISIBLE = 'user_admin.VISIBLE';

	
	const DELETED = 'user_admin.DELETED';

	
	const LOCKED = 'user_admin.LOCKED';

	
	const LAST_ACCESS_DATE = 'user_admin.LAST_ACCESS_DATE';

	
	const CREATED_AT = 'user_admin.CREATED_AT';

	
	const UPDATED_AT = 'user_admin.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'PeopleId', 'ClubId', 'Username', 'Password', 'Active', 'Master', 'Enabled', 'Visible', 'Deleted', 'Locked', 'LastAccessDate', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (UserAdminPeer::ID, UserAdminPeer::PEOPLE_ID, UserAdminPeer::CLUB_ID, UserAdminPeer::USERNAME, UserAdminPeer::PASSWORD, UserAdminPeer::ACTIVE, UserAdminPeer::MASTER, UserAdminPeer::ENABLED, UserAdminPeer::VISIBLE, UserAdminPeer::DELETED, UserAdminPeer::LOCKED, UserAdminPeer::LAST_ACCESS_DATE, UserAdminPeer::CREATED_AT, UserAdminPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'people_id', 'club_id', 'username', 'password', 'active', 'master', 'enabled', 'visible', 'deleted', 'locked', 'last_access_date', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'PEOPLE_ID'=>'', 'CLUB_ID'=>'', 'USERNAME'=>'', 'PASSWORD'=>'', 'ACTIVE'=>'', 'MASTER'=>'', 'ENABLED'=>'', 'VISIBLE'=>'', 'DELETED'=>'', 'LOCKED'=>'', 'LAST_ACCESS_DATE'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'PeopleId'=>1, 'ClubId'=>2, 'Username'=>3, 'Password'=>4, 'Active'=>5, 'Master'=>6, 'Enabled'=>7, 'Visible'=>8, 'Deleted'=>9, 'Locked'=>10, 'LastAccessDate'=>11, 'CreatedAt'=>12, 'UpdatedAt'=>13, ),
		BasePeer::TYPE_COLNAME=>array (UserAdminPeer::ID=>0, UserAdminPeer::PEOPLE_ID=>1, UserAdminPeer::CLUB_ID=>2, UserAdminPeer::USERNAME=>3, UserAdminPeer::PASSWORD=>4, UserAdminPeer::ACTIVE=>5, UserAdminPeer::MASTER=>6, UserAdminPeer::ENABLED=>7, UserAdminPeer::VISIBLE=>8, UserAdminPeer::DELETED=>9, UserAdminPeer::LOCKED=>10, UserAdminPeer::LAST_ACCESS_DATE=>11, UserAdminPeer::CREATED_AT=>12, UserAdminPeer::UPDATED_AT=>13, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'people_id'=>1, 'club_id'=>2, 'username'=>3, 'password'=>4, 'active'=>5, 'master'=>6, 'enabled'=>7, 'visible'=>8, 'deleted'=>9, 'locked'=>10, 'last_access_date'=>11, 'created_at'=>12, 'updated_at'=>13, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'apps/backend/lib/model/map/UserAdminMapBuilder.php';
		return BasePeer::getMapBuilder('...apps.backend.lib.model.map.UserAdminMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = UserAdminPeer::getTableMap();
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
		return str_replace(UserAdminPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(UserAdminPeer::ID);

		$criteria->addSelectColumn(UserAdminPeer::PEOPLE_ID);

		$criteria->addSelectColumn(UserAdminPeer::CLUB_ID);

		$criteria->addSelectColumn(UserAdminPeer::USERNAME);

		$criteria->addSelectColumn(UserAdminPeer::PASSWORD);

		$criteria->addSelectColumn(UserAdminPeer::ACTIVE);

		$criteria->addSelectColumn(UserAdminPeer::MASTER);

		$criteria->addSelectColumn(UserAdminPeer::ENABLED);

		$criteria->addSelectColumn(UserAdminPeer::VISIBLE);

		$criteria->addSelectColumn(UserAdminPeer::DELETED);

		$criteria->addSelectColumn(UserAdminPeer::LOCKED);

		$criteria->addSelectColumn(UserAdminPeer::LAST_ACCESS_DATE);

		$criteria->addSelectColumn(UserAdminPeer::CREATED_AT);

		$criteria->addSelectColumn(UserAdminPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(user_admin.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT user_admin.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UserAdminPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UserAdminPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = UserAdminPeer::doSelectRS($criteria, $con);
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
		$objects = UserAdminPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return UserAdminPeer::populateObjects(UserAdminPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			UserAdminPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = UserAdminPeer::getOMClass();
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
			$criteria->addSelectColumn(UserAdminPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UserAdminPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UserAdminPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = UserAdminPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinClub(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UserAdminPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UserAdminPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UserAdminPeer::CLUB_ID, ClubPeer::ID);

		$rs = UserAdminPeer::doSelectRS($criteria, $con);
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

		UserAdminPeer::addSelectColumns($c);
		$startcol = (UserAdminPeer::NUM_COLUMNS - UserAdminPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PeoplePeer::addSelectColumns($c);

		$c->addJoin(UserAdminPeer::PEOPLE_ID, PeoplePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = UserAdminPeer::getOMClass();

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
										$temp_obj2->addUserAdmin($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initUserAdminList();
				$obj2->addUserAdmin($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinClub(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UserAdminPeer::addSelectColumns($c);
		$startcol = (UserAdminPeer::NUM_COLUMNS - UserAdminPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ClubPeer::addSelectColumns($c);

		$c->addJoin(UserAdminPeer::CLUB_ID, ClubPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = UserAdminPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ClubPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getClub(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addUserAdmin($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initUserAdminList();
				$obj2->addUserAdmin($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UserAdminPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UserAdminPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UserAdminPeer::PEOPLE_ID, PeoplePeer::ID);

		$criteria->addJoin(UserAdminPeer::CLUB_ID, ClubPeer::ID);

		$rs = UserAdminPeer::doSelectRS($criteria, $con);
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

		UserAdminPeer::addSelectColumns($c);
		$startcol2 = (UserAdminPeer::NUM_COLUMNS - UserAdminPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PeoplePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PeoplePeer::NUM_COLUMNS;

		ClubPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ClubPeer::NUM_COLUMNS;

		$c->addJoin(UserAdminPeer::PEOPLE_ID, PeoplePeer::ID);

		$c->addJoin(UserAdminPeer::CLUB_ID, ClubPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = UserAdminPeer::getOMClass();


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
					$temp_obj2->addUserAdmin($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initUserAdminList();
				$obj2->addUserAdmin($obj1);
			}


					
			$omClass = ClubPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getClub(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addUserAdmin($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initUserAdminList();
				$obj3->addUserAdmin($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptPeople(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UserAdminPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UserAdminPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UserAdminPeer::CLUB_ID, ClubPeer::ID);

		$rs = UserAdminPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptClub(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UserAdminPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UserAdminPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UserAdminPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = UserAdminPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptPeople(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UserAdminPeer::addSelectColumns($c);
		$startcol2 = (UserAdminPeer::NUM_COLUMNS - UserAdminPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ClubPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ClubPeer::NUM_COLUMNS;

		$c->addJoin(UserAdminPeer::CLUB_ID, ClubPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = UserAdminPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ClubPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getClub(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addUserAdmin($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initUserAdminList();
				$obj2->addUserAdmin($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptClub(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UserAdminPeer::addSelectColumns($c);
		$startcol2 = (UserAdminPeer::NUM_COLUMNS - UserAdminPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PeoplePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(UserAdminPeer::PEOPLE_ID, PeoplePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = UserAdminPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PeoplePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPeople(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addUserAdmin($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initUserAdminList();
				$obj2->addUserAdmin($obj1);
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
		return UserAdminPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(UserAdminPeer::ID); 

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
			$comparison = $criteria->getComparison(UserAdminPeer::ID);
			$selectCriteria->add(UserAdminPeer::ID, $criteria->remove(UserAdminPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(UserAdminPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(UserAdminPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof UserAdmin) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(UserAdminPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(UserAdmin $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(UserAdminPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(UserAdminPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(UserAdminPeer::DATABASE_NAME, UserAdminPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = UserAdminPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(UserAdminPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(UserAdminPeer::ID, $pk);


		$v = UserAdminPeer::doSelect($criteria, $con);

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
			$criteria->add(UserAdminPeer::ID, $pks, Criteria::IN);
			$objs = UserAdminPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseUserAdminPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'apps/backend/lib/model/map/UserAdminMapBuilder.php';
	Propel::registerMapBuilder('...apps.backend.lib.model.map.UserAdminMapBuilder');
}
