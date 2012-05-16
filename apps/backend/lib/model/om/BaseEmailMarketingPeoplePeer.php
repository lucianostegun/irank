<?php


abstract class BaseEmailMarketingPeoplePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'email_marketing_people';

	
	const CLASS_DEFAULT = '...apps.backend.lib.model.EmailMarketingPeople';

	
	const NUM_COLUMNS = 4;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const EMAIL_MARKETING_ID = 'email_marketing_people.EMAIL_MARKETING_ID';

	
	const PEOPLE_ID = 'email_marketing_people.PEOPLE_ID';

	
	const EMAIL_LOG_ID = 'email_marketing_people.EMAIL_LOG_ID';

	
	const CREATED_AT = 'email_marketing_people.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('EmailMarketingId', 'PeopleId', 'EmailLogId', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME=>array (EmailMarketingPeoplePeer::EMAIL_MARKETING_ID, EmailMarketingPeoplePeer::PEOPLE_ID, EmailMarketingPeoplePeer::EMAIL_LOG_ID, EmailMarketingPeoplePeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('email_marketing_id', 'people_id', 'email_log_id', 'created_at', ),
		BasePeer::TYPE_ALIAS=>array ('EMAIL_MARKETING_ID'=>'', 'PEOPLE_ID'=>'', 'EMAIL_LOG_ID'=>'', 'CREATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('EmailMarketingId'=>0, 'PeopleId'=>1, 'EmailLogId'=>2, 'CreatedAt'=>3, ),
		BasePeer::TYPE_COLNAME=>array (EmailMarketingPeoplePeer::EMAIL_MARKETING_ID=>0, EmailMarketingPeoplePeer::PEOPLE_ID=>1, EmailMarketingPeoplePeer::EMAIL_LOG_ID=>2, EmailMarketingPeoplePeer::CREATED_AT=>3, ),
		BasePeer::TYPE_FIELDNAME=>array ('email_marketing_id'=>0, 'people_id'=>1, 'email_log_id'=>2, 'created_at'=>3, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'apps/backend/lib/model/map/EmailMarketingPeopleMapBuilder.php';
		return BasePeer::getMapBuilder('...apps.backend.lib.model.map.EmailMarketingPeopleMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EmailMarketingPeoplePeer::getTableMap();
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
		return str_replace(EmailMarketingPeoplePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EmailMarketingPeoplePeer::EMAIL_MARKETING_ID);

		$criteria->addSelectColumn(EmailMarketingPeoplePeer::PEOPLE_ID);

		$criteria->addSelectColumn(EmailMarketingPeoplePeer::EMAIL_LOG_ID);

		$criteria->addSelectColumn(EmailMarketingPeoplePeer::CREATED_AT);

	}

	const COUNT = 'COUNT(email_marketing_people.EMAIL_MARKETING_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT email_marketing_people.EMAIL_MARKETING_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EmailMarketingPeoplePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EmailMarketingPeoplePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EmailMarketingPeoplePeer::doSelectRS($criteria, $con);
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
		$objects = EmailMarketingPeoplePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EmailMarketingPeoplePeer::populateObjects(EmailMarketingPeoplePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EmailMarketingPeoplePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EmailMarketingPeoplePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinEmailMarketing(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EmailMarketingPeoplePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EmailMarketingPeoplePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EmailMarketingPeoplePeer::EMAIL_MARKETING_ID, EmailMarketingPeer::ID);

		$rs = EmailMarketingPeoplePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinPeople(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EmailMarketingPeoplePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EmailMarketingPeoplePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EmailMarketingPeoplePeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = EmailMarketingPeoplePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinEmailMarketing(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EmailMarketingPeoplePeer::addSelectColumns($c);
		$startcol = (EmailMarketingPeoplePeer::NUM_COLUMNS - EmailMarketingPeoplePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		EmailMarketingPeer::addSelectColumns($c);

		$c->addJoin(EmailMarketingPeoplePeer::EMAIL_MARKETING_ID, EmailMarketingPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EmailMarketingPeoplePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EmailMarketingPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getEmailMarketing(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEmailMarketingPeople($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEmailMarketingPeopleList();
				$obj2->addEmailMarketingPeople($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinPeople(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EmailMarketingPeoplePeer::addSelectColumns($c);
		$startcol = (EmailMarketingPeoplePeer::NUM_COLUMNS - EmailMarketingPeoplePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PeoplePeer::addSelectColumns($c);

		$c->addJoin(EmailMarketingPeoplePeer::PEOPLE_ID, PeoplePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EmailMarketingPeoplePeer::getOMClass();

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
										$temp_obj2->addEmailMarketingPeople($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEmailMarketingPeopleList();
				$obj2->addEmailMarketingPeople($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EmailMarketingPeoplePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EmailMarketingPeoplePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EmailMarketingPeoplePeer::EMAIL_MARKETING_ID, EmailMarketingPeer::ID);

		$criteria->addJoin(EmailMarketingPeoplePeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = EmailMarketingPeoplePeer::doSelectRS($criteria, $con);
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

		EmailMarketingPeoplePeer::addSelectColumns($c);
		$startcol2 = (EmailMarketingPeoplePeer::NUM_COLUMNS - EmailMarketingPeoplePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EmailMarketingPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EmailMarketingPeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(EmailMarketingPeoplePeer::EMAIL_MARKETING_ID, EmailMarketingPeer::ID);

		$c->addJoin(EmailMarketingPeoplePeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EmailMarketingPeoplePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = EmailMarketingPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getEmailMarketing(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEmailMarketingPeople($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEmailMarketingPeopleList();
				$obj2->addEmailMarketingPeople($obj1);
			}


					
			$omClass = PeoplePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getPeople(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEmailMarketingPeople($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initEmailMarketingPeopleList();
				$obj3->addEmailMarketingPeople($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptEmailMarketing(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EmailMarketingPeoplePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EmailMarketingPeoplePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EmailMarketingPeoplePeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = EmailMarketingPeoplePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptPeople(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EmailMarketingPeoplePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EmailMarketingPeoplePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EmailMarketingPeoplePeer::EMAIL_MARKETING_ID, EmailMarketingPeer::ID);

		$rs = EmailMarketingPeoplePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptEmailMarketing(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EmailMarketingPeoplePeer::addSelectColumns($c);
		$startcol2 = (EmailMarketingPeoplePeer::NUM_COLUMNS - EmailMarketingPeoplePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PeoplePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(EmailMarketingPeoplePeer::PEOPLE_ID, PeoplePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EmailMarketingPeoplePeer::getOMClass();

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
					$temp_obj2->addEmailMarketingPeople($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEmailMarketingPeopleList();
				$obj2->addEmailMarketingPeople($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptPeople(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EmailMarketingPeoplePeer::addSelectColumns($c);
		$startcol2 = (EmailMarketingPeoplePeer::NUM_COLUMNS - EmailMarketingPeoplePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EmailMarketingPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EmailMarketingPeer::NUM_COLUMNS;

		$c->addJoin(EmailMarketingPeoplePeer::EMAIL_MARKETING_ID, EmailMarketingPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EmailMarketingPeoplePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EmailMarketingPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getEmailMarketing(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEmailMarketingPeople($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEmailMarketingPeopleList();
				$obj2->addEmailMarketingPeople($obj1);
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
		return EmailMarketingPeoplePeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(EmailMarketingPeoplePeer::EMAIL_MARKETING_ID);
			$selectCriteria->add(EmailMarketingPeoplePeer::EMAIL_MARKETING_ID, $criteria->remove(EmailMarketingPeoplePeer::EMAIL_MARKETING_ID), $comparison);

			$comparison = $criteria->getComparison(EmailMarketingPeoplePeer::PEOPLE_ID);
			$selectCriteria->add(EmailMarketingPeoplePeer::PEOPLE_ID, $criteria->remove(EmailMarketingPeoplePeer::PEOPLE_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(EmailMarketingPeoplePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EmailMarketingPeoplePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof EmailMarketingPeople) {

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

			$criteria->add(EmailMarketingPeoplePeer::EMAIL_MARKETING_ID, $vals[0], Criteria::IN);
			$criteria->add(EmailMarketingPeoplePeer::PEOPLE_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(EmailMarketingPeople $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EmailMarketingPeoplePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EmailMarketingPeoplePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EmailMarketingPeoplePeer::DATABASE_NAME, EmailMarketingPeoplePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EmailMarketingPeoplePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $email_marketing_id, $people_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(EmailMarketingPeoplePeer::EMAIL_MARKETING_ID, $email_marketing_id);
		$criteria->add(EmailMarketingPeoplePeer::PEOPLE_ID, $people_id);
		$v = EmailMarketingPeoplePeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseEmailMarketingPeoplePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'apps/backend/lib/model/map/EmailMarketingPeopleMapBuilder.php';
	Propel::registerMapBuilder('...apps.backend.lib.model.map.EmailMarketingPeopleMapBuilder');
}
