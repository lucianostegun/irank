<?php


abstract class BaseUserSiteOptionPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'user_site_option';

	
	const CLASS_DEFAULT = 'lib.model.UserSiteOption';

	
	const NUM_COLUMNS = 5;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const PEOPLE_ID = 'user_site_option.PEOPLE_ID';

	
	const USER_SITE_OPTION_ID = 'user_site_option.USER_SITE_OPTION_ID';

	
	const OPTION_VALUE = 'user_site_option.OPTION_VALUE';

	
	const CREATED_AT = 'user_site_option.CREATED_AT';

	
	const UPDATED_AT = 'user_site_option.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('PeopleId', 'UserSiteOptionId', 'OptionValue', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (UserSiteOptionPeer::PEOPLE_ID, UserSiteOptionPeer::USER_SITE_OPTION_ID, UserSiteOptionPeer::OPTION_VALUE, UserSiteOptionPeer::CREATED_AT, UserSiteOptionPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('people_id', 'user_site_option_id', 'option_value', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('PEOPLE_ID'=>'', 'USER_SITE_OPTION_ID'=>'', 'OPTION_VALUE'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('PeopleId'=>0, 'UserSiteOptionId'=>1, 'OptionValue'=>2, 'CreatedAt'=>3, 'UpdatedAt'=>4, ),
		BasePeer::TYPE_COLNAME=>array (UserSiteOptionPeer::PEOPLE_ID=>0, UserSiteOptionPeer::USER_SITE_OPTION_ID=>1, UserSiteOptionPeer::OPTION_VALUE=>2, UserSiteOptionPeer::CREATED_AT=>3, UserSiteOptionPeer::UPDATED_AT=>4, ),
		BasePeer::TYPE_FIELDNAME=>array ('people_id'=>0, 'user_site_option_id'=>1, 'option_value'=>2, 'created_at'=>3, 'updated_at'=>4, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/UserSiteOptionMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.UserSiteOptionMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = UserSiteOptionPeer::getTableMap();
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
		return str_replace(UserSiteOptionPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(UserSiteOptionPeer::PEOPLE_ID);

		$criteria->addSelectColumn(UserSiteOptionPeer::USER_SITE_OPTION_ID);

		$criteria->addSelectColumn(UserSiteOptionPeer::OPTION_VALUE);

		$criteria->addSelectColumn(UserSiteOptionPeer::CREATED_AT);

		$criteria->addSelectColumn(UserSiteOptionPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(user_site_option.PEOPLE_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT user_site_option.PEOPLE_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UserSiteOptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UserSiteOptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = UserSiteOptionPeer::doSelectRS($criteria, $con);
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
		$objects = UserSiteOptionPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return UserSiteOptionPeer::populateObjects(UserSiteOptionPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			UserSiteOptionPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = UserSiteOptionPeer::getOMClass();
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
			$criteria->addSelectColumn(UserSiteOptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UserSiteOptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UserSiteOptionPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = UserSiteOptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinVirtualTable(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UserSiteOptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UserSiteOptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UserSiteOptionPeer::USER_SITE_OPTION_ID, VirtualTablePeer::ID);

		$rs = UserSiteOptionPeer::doSelectRS($criteria, $con);
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

		UserSiteOptionPeer::addSelectColumns($c);
		$startcol = (UserSiteOptionPeer::NUM_COLUMNS - UserSiteOptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PeoplePeer::addSelectColumns($c);

		$c->addJoin(UserSiteOptionPeer::PEOPLE_ID, PeoplePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = UserSiteOptionPeer::getOMClass();

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
										$temp_obj2->addUserSiteOption($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initUserSiteOptionList();
				$obj2->addUserSiteOption($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinVirtualTable(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UserSiteOptionPeer::addSelectColumns($c);
		$startcol = (UserSiteOptionPeer::NUM_COLUMNS - UserSiteOptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		VirtualTablePeer::addSelectColumns($c);

		$c->addJoin(UserSiteOptionPeer::USER_SITE_OPTION_ID, VirtualTablePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = UserSiteOptionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = VirtualTablePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getVirtualTable(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addUserSiteOption($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initUserSiteOptionList();
				$obj2->addUserSiteOption($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UserSiteOptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UserSiteOptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UserSiteOptionPeer::PEOPLE_ID, PeoplePeer::ID);

		$criteria->addJoin(UserSiteOptionPeer::USER_SITE_OPTION_ID, VirtualTablePeer::ID);

		$rs = UserSiteOptionPeer::doSelectRS($criteria, $con);
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

		UserSiteOptionPeer::addSelectColumns($c);
		$startcol2 = (UserSiteOptionPeer::NUM_COLUMNS - UserSiteOptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PeoplePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PeoplePeer::NUM_COLUMNS;

		VirtualTablePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + VirtualTablePeer::NUM_COLUMNS;

		$c->addJoin(UserSiteOptionPeer::PEOPLE_ID, PeoplePeer::ID);

		$c->addJoin(UserSiteOptionPeer::USER_SITE_OPTION_ID, VirtualTablePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = UserSiteOptionPeer::getOMClass();


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
					$temp_obj2->addUserSiteOption($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initUserSiteOptionList();
				$obj2->addUserSiteOption($obj1);
			}


					
			$omClass = VirtualTablePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getVirtualTable(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addUserSiteOption($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initUserSiteOptionList();
				$obj3->addUserSiteOption($obj1);
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
			$criteria->addSelectColumn(UserSiteOptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UserSiteOptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UserSiteOptionPeer::USER_SITE_OPTION_ID, VirtualTablePeer::ID);

		$rs = UserSiteOptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptVirtualTable(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UserSiteOptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UserSiteOptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UserSiteOptionPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = UserSiteOptionPeer::doSelectRS($criteria, $con);
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

		UserSiteOptionPeer::addSelectColumns($c);
		$startcol2 = (UserSiteOptionPeer::NUM_COLUMNS - UserSiteOptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		VirtualTablePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + VirtualTablePeer::NUM_COLUMNS;

		$c->addJoin(UserSiteOptionPeer::USER_SITE_OPTION_ID, VirtualTablePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = UserSiteOptionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = VirtualTablePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getVirtualTable(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addUserSiteOption($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initUserSiteOptionList();
				$obj2->addUserSiteOption($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptVirtualTable(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UserSiteOptionPeer::addSelectColumns($c);
		$startcol2 = (UserSiteOptionPeer::NUM_COLUMNS - UserSiteOptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PeoplePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(UserSiteOptionPeer::PEOPLE_ID, PeoplePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = UserSiteOptionPeer::getOMClass();

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
					$temp_obj2->addUserSiteOption($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initUserSiteOptionList();
				$obj2->addUserSiteOption($obj1);
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
		return UserSiteOptionPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(UserSiteOptionPeer::PEOPLE_ID);
			$selectCriteria->add(UserSiteOptionPeer::PEOPLE_ID, $criteria->remove(UserSiteOptionPeer::PEOPLE_ID), $comparison);

			$comparison = $criteria->getComparison(UserSiteOptionPeer::USER_SITE_OPTION_ID);
			$selectCriteria->add(UserSiteOptionPeer::USER_SITE_OPTION_ID, $criteria->remove(UserSiteOptionPeer::USER_SITE_OPTION_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(UserSiteOptionPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(UserSiteOptionPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof UserSiteOption) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
												if(count($values) == count($values, COUNT_RECURSIVE))
			{
								$values = array($values);
			}
			$vals = array();
			foreach($values as $value)
			{

				$vals[0][] = $value[0];
				$vals[1][] = $value[1];
			}

			$criteria->add(UserSiteOptionPeer::PEOPLE_ID, $vals[0], Criteria::IN);
			$criteria->add(UserSiteOptionPeer::USER_SITE_OPTION_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(UserSiteOption $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(UserSiteOptionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(UserSiteOptionPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(UserSiteOptionPeer::DATABASE_NAME, UserSiteOptionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = UserSiteOptionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $people_id, $user_site_option_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(UserSiteOptionPeer::PEOPLE_ID, $people_id);
		$criteria->add(UserSiteOptionPeer::USER_SITE_OPTION_ID, $user_site_option_id);
		$v = UserSiteOptionPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseUserSiteOptionPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/UserSiteOptionMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.UserSiteOptionMapBuilder');
}
