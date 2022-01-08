<?php


abstract class BaseUserAdminSettingsPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'user_admin_settings';

	
	const CLASS_DEFAULT = '...apps.backend.lib.model.UserAdminSettings';

	
	const NUM_COLUMNS = 5;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const USER_ADMIN_ID = 'user_admin_settings.USER_ADMIN_ID';

	
	const SETTINGS_ID = 'user_admin_settings.SETTINGS_ID';

	
	const SETTINGS_VALUE = 'user_admin_settings.SETTINGS_VALUE';

	
	const CREATED_AT = 'user_admin_settings.CREATED_AT';

	
	const UPDATED_AT = 'user_admin_settings.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('UserAdminId', 'SettingsId', 'SettingsValue', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (UserAdminSettingsPeer::USER_ADMIN_ID, UserAdminSettingsPeer::SETTINGS_ID, UserAdminSettingsPeer::SETTINGS_VALUE, UserAdminSettingsPeer::CREATED_AT, UserAdminSettingsPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('user_admin_id', 'settings_id', 'settings_value', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('USER_ADMIN_ID'=>'', 'SETTINGS_ID'=>'', 'SETTINGS_VALUE'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('UserAdminId'=>0, 'SettingsId'=>1, 'SettingsValue'=>2, 'CreatedAt'=>3, 'UpdatedAt'=>4, ),
		BasePeer::TYPE_COLNAME=>array (UserAdminSettingsPeer::USER_ADMIN_ID=>0, UserAdminSettingsPeer::SETTINGS_ID=>1, UserAdminSettingsPeer::SETTINGS_VALUE=>2, UserAdminSettingsPeer::CREATED_AT=>3, UserAdminSettingsPeer::UPDATED_AT=>4, ),
		BasePeer::TYPE_FIELDNAME=>array ('user_admin_id'=>0, 'settings_id'=>1, 'settings_value'=>2, 'created_at'=>3, 'updated_at'=>4, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'apps/backend/lib/model/map/UserAdminSettingsMapBuilder.php';
		return BasePeer::getMapBuilder('...apps.backend.lib.model.map.UserAdminSettingsMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = UserAdminSettingsPeer::getTableMap();
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
		return str_replace(UserAdminSettingsPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(UserAdminSettingsPeer::USER_ADMIN_ID);

		$criteria->addSelectColumn(UserAdminSettingsPeer::SETTINGS_ID);

		$criteria->addSelectColumn(UserAdminSettingsPeer::SETTINGS_VALUE);

		$criteria->addSelectColumn(UserAdminSettingsPeer::CREATED_AT);

		$criteria->addSelectColumn(UserAdminSettingsPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(user_admin_settings.USER_ADMIN_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT user_admin_settings.USER_ADMIN_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UserAdminSettingsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UserAdminSettingsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = UserAdminSettingsPeer::doSelectRS($criteria, $con);
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
		$objects = UserAdminSettingsPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return UserAdminSettingsPeer::populateObjects(UserAdminSettingsPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			UserAdminSettingsPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = UserAdminSettingsPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinUserAdmin(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UserAdminSettingsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UserAdminSettingsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UserAdminSettingsPeer::USER_ADMIN_ID, UserAdminPeer::ID);

		$rs = UserAdminSettingsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinSettings(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UserAdminSettingsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UserAdminSettingsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UserAdminSettingsPeer::SETTINGS_ID, SettingsPeer::ID);

		$rs = UserAdminSettingsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinUserAdmin(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UserAdminSettingsPeer::addSelectColumns($c);
		$startcol = (UserAdminSettingsPeer::NUM_COLUMNS - UserAdminSettingsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserAdminPeer::addSelectColumns($c);

		$c->addJoin(UserAdminSettingsPeer::USER_ADMIN_ID, UserAdminPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = UserAdminSettingsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserAdminPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUserAdmin(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addUserAdminSettings($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initUserAdminSettingsList();
				$obj2->addUserAdminSettings($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinSettings(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UserAdminSettingsPeer::addSelectColumns($c);
		$startcol = (UserAdminSettingsPeer::NUM_COLUMNS - UserAdminSettingsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SettingsPeer::addSelectColumns($c);

		$c->addJoin(UserAdminSettingsPeer::SETTINGS_ID, SettingsPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = UserAdminSettingsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SettingsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getSettings(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addUserAdminSettings($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initUserAdminSettingsList();
				$obj2->addUserAdminSettings($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UserAdminSettingsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UserAdminSettingsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UserAdminSettingsPeer::USER_ADMIN_ID, UserAdminPeer::ID);

		$criteria->addJoin(UserAdminSettingsPeer::SETTINGS_ID, SettingsPeer::ID);

		$rs = UserAdminSettingsPeer::doSelectRS($criteria, $con);
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

		UserAdminSettingsPeer::addSelectColumns($c);
		$startcol2 = (UserAdminSettingsPeer::NUM_COLUMNS - UserAdminSettingsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserAdminPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserAdminPeer::NUM_COLUMNS;

		SettingsPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SettingsPeer::NUM_COLUMNS;

		$c->addJoin(UserAdminSettingsPeer::USER_ADMIN_ID, UserAdminPeer::ID);

		$c->addJoin(UserAdminSettingsPeer::SETTINGS_ID, SettingsPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = UserAdminSettingsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = UserAdminPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUserAdmin(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addUserAdminSettings($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initUserAdminSettingsList();
				$obj2->addUserAdminSettings($obj1);
			}


					
			$omClass = SettingsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getSettings(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addUserAdminSettings($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initUserAdminSettingsList();
				$obj3->addUserAdminSettings($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptUserAdmin(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UserAdminSettingsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UserAdminSettingsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UserAdminSettingsPeer::SETTINGS_ID, SettingsPeer::ID);

		$rs = UserAdminSettingsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptSettings(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UserAdminSettingsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UserAdminSettingsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(UserAdminSettingsPeer::USER_ADMIN_ID, UserAdminPeer::ID);

		$rs = UserAdminSettingsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptUserAdmin(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UserAdminSettingsPeer::addSelectColumns($c);
		$startcol2 = (UserAdminSettingsPeer::NUM_COLUMNS - UserAdminSettingsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SettingsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SettingsPeer::NUM_COLUMNS;

		$c->addJoin(UserAdminSettingsPeer::SETTINGS_ID, SettingsPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = UserAdminSettingsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SettingsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSettings(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addUserAdminSettings($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initUserAdminSettingsList();
				$obj2->addUserAdminSettings($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptSettings(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UserAdminSettingsPeer::addSelectColumns($c);
		$startcol2 = (UserAdminSettingsPeer::NUM_COLUMNS - UserAdminSettingsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserAdminPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserAdminPeer::NUM_COLUMNS;

		$c->addJoin(UserAdminSettingsPeer::USER_ADMIN_ID, UserAdminPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = UserAdminSettingsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserAdminPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUserAdmin(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addUserAdminSettings($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initUserAdminSettingsList();
				$obj2->addUserAdminSettings($obj1);
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
		return UserAdminSettingsPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(UserAdminSettingsPeer::USER_ADMIN_ID);
			$selectCriteria->add(UserAdminSettingsPeer::USER_ADMIN_ID, $criteria->remove(UserAdminSettingsPeer::USER_ADMIN_ID), $comparison);

			$comparison = $criteria->getComparison(UserAdminSettingsPeer::SETTINGS_ID);
			$selectCriteria->add(UserAdminSettingsPeer::SETTINGS_ID, $criteria->remove(UserAdminSettingsPeer::SETTINGS_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(UserAdminSettingsPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(UserAdminSettingsPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof UserAdminSettings) {

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

			$criteria->add(UserAdminSettingsPeer::USER_ADMIN_ID, $vals[0], Criteria::IN);
			$criteria->add(UserAdminSettingsPeer::SETTINGS_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(UserAdminSettings $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(UserAdminSettingsPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(UserAdminSettingsPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(UserAdminSettingsPeer::DATABASE_NAME, UserAdminSettingsPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = UserAdminSettingsPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $user_admin_id, $settings_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(UserAdminSettingsPeer::USER_ADMIN_ID, $user_admin_id);
		$criteria->add(UserAdminSettingsPeer::SETTINGS_ID, $settings_id);
		$v = UserAdminSettingsPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseUserAdminSettingsPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'apps/backend/lib/model/map/UserAdminSettingsMapBuilder.php';
	Propel::registerMapBuilder('...apps.backend.lib.model.map.UserAdminSettingsMapBuilder');
}
