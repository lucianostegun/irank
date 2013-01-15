<?php


abstract class BaseSmsPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'sms';

	
	const CLASS_DEFAULT = 'lib.model.Sms';

	
	const NUM_COLUMNS = 8;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'sms.ID';

	
	const PEOPLE_ID = 'sms.PEOPLE_ID';

	
	const PHONE_NUMBER = 'sms.PHONE_NUMBER';

	
	const MESSAGE = 'sms.MESSAGE';

	
	const STATUS_CODE = 'sms.STATUS_CODE';

	
	const STATUS_MESSAGE = 'sms.STATUS_MESSAGE';

	
	const MESSAGE_ID = 'sms.MESSAGE_ID';

	
	const CREATED_AT = 'sms.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'PeopleId', 'PhoneNumber', 'Message', 'StatusCode', 'StatusMessage', 'MessageId', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME=>array (SmsPeer::ID, SmsPeer::PEOPLE_ID, SmsPeer::PHONE_NUMBER, SmsPeer::MESSAGE, SmsPeer::STATUS_CODE, SmsPeer::STATUS_MESSAGE, SmsPeer::MESSAGE_ID, SmsPeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'people_id', 'phone_number', 'message', 'status_code', 'status_message', 'message_id', 'created_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'PEOPLE_ID'=>'', 'PHONE_NUMBER'=>'', 'MESSAGE'=>'', 'STATUS_CODE'=>'', 'STATUS_MESSAGE'=>'', 'MESSAGE_ID'=>'', 'CREATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'PeopleId'=>1, 'PhoneNumber'=>2, 'Message'=>3, 'StatusCode'=>4, 'StatusMessage'=>5, 'MessageId'=>6, 'CreatedAt'=>7, ),
		BasePeer::TYPE_COLNAME=>array (SmsPeer::ID=>0, SmsPeer::PEOPLE_ID=>1, SmsPeer::PHONE_NUMBER=>2, SmsPeer::MESSAGE=>3, SmsPeer::STATUS_CODE=>4, SmsPeer::STATUS_MESSAGE=>5, SmsPeer::MESSAGE_ID=>6, SmsPeer::CREATED_AT=>7, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'people_id'=>1, 'phone_number'=>2, 'message'=>3, 'status_code'=>4, 'status_message'=>5, 'message_id'=>6, 'created_at'=>7, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/SmsMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.SmsMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = SmsPeer::getTableMap();
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
		return str_replace(SmsPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(SmsPeer::ID);

		$criteria->addSelectColumn(SmsPeer::PEOPLE_ID);

		$criteria->addSelectColumn(SmsPeer::PHONE_NUMBER);

		$criteria->addSelectColumn(SmsPeer::MESSAGE);

		$criteria->addSelectColumn(SmsPeer::STATUS_CODE);

		$criteria->addSelectColumn(SmsPeer::STATUS_MESSAGE);

		$criteria->addSelectColumn(SmsPeer::MESSAGE_ID);

		$criteria->addSelectColumn(SmsPeer::CREATED_AT);

	}

	const COUNT = 'COUNT(sms.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT sms.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SmsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SmsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SmsPeer::doSelectRS($criteria, $con);
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
		$objects = SmsPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return SmsPeer::populateObjects(SmsPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			SmsPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = SmsPeer::getOMClass();
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
			$criteria->addSelectColumn(SmsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SmsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SmsPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = SmsPeer::doSelectRS($criteria, $con);
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

		SmsPeer::addSelectColumns($c);
		$startcol = (SmsPeer::NUM_COLUMNS - SmsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PeoplePeer::addSelectColumns($c);

		$c->addJoin(SmsPeer::PEOPLE_ID, PeoplePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SmsPeer::getOMClass();

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
										$temp_obj2->addSms($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initSmsList();
				$obj2->addSms($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SmsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SmsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SmsPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = SmsPeer::doSelectRS($criteria, $con);
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

		SmsPeer::addSelectColumns($c);
		$startcol2 = (SmsPeer::NUM_COLUMNS - SmsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PeoplePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(SmsPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SmsPeer::getOMClass();


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
					$temp_obj2->addSms($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initSmsList();
				$obj2->addSms($obj1);
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
		return SmsPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(SmsPeer::ID); 

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
			$comparison = $criteria->getComparison(SmsPeer::ID);
			$selectCriteria->add(SmsPeer::ID, $criteria->remove(SmsPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(SmsPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(SmsPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Sms) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SmsPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Sms $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SmsPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SmsPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(SmsPeer::DATABASE_NAME, SmsPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SmsPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(SmsPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(SmsPeer::ID, $pk);


		$v = SmsPeer::doSelect($criteria, $con);

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
			$criteria->add(SmsPeer::ID, $pks, Criteria::IN);
			$objs = SmsPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseSmsPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/SmsMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.SmsMapBuilder');
}
