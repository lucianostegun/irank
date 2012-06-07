<?php


abstract class BaseEventLiveSchedulePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'event_live_schedule';

	
	const CLASS_DEFAULT = 'lib.model.EventLiveSchedule';

	
	const NUM_COLUMNS = 8;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'event_live_schedule.ID';

	
	const EVENT_LIVE_ID = 'event_live_schedule.EVENT_LIVE_ID';

	
	const EVENT_DATE = 'event_live_schedule.EVENT_DATE';

	
	const START_TIME = 'event_live_schedule.START_TIME';

	
	const EVENT_DATE_TIME = 'event_live_schedule.EVENT_DATE_TIME';

	
	const DAYS_AFTER = 'event_live_schedule.DAYS_AFTER';

	
	const STEP_DAY = 'event_live_schedule.STEP_DAY';

	
	const CREATED_AT = 'event_live_schedule.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'EventLiveId', 'EventDate', 'StartTime', 'EventDateTime', 'DaysAfter', 'StepDay', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME=>array (EventLiveSchedulePeer::ID, EventLiveSchedulePeer::EVENT_LIVE_ID, EventLiveSchedulePeer::EVENT_DATE, EventLiveSchedulePeer::START_TIME, EventLiveSchedulePeer::EVENT_DATE_TIME, EventLiveSchedulePeer::DAYS_AFTER, EventLiveSchedulePeer::STEP_DAY, EventLiveSchedulePeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'event_live_id', 'event_date', 'start_time', 'event_date_time', 'days_after', 'step_day', 'created_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'EVENT_LIVE_ID'=>'', 'EVENT_DATE'=>'', 'START_TIME'=>'', 'EVENT_DATE_TIME'=>'', 'DAYS_AFTER'=>'', 'STEP_DAY'=>'', 'CREATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'EventLiveId'=>1, 'EventDate'=>2, 'StartTime'=>3, 'EventDateTime'=>4, 'DaysAfter'=>5, 'StepDay'=>6, 'CreatedAt'=>7, ),
		BasePeer::TYPE_COLNAME=>array (EventLiveSchedulePeer::ID=>0, EventLiveSchedulePeer::EVENT_LIVE_ID=>1, EventLiveSchedulePeer::EVENT_DATE=>2, EventLiveSchedulePeer::START_TIME=>3, EventLiveSchedulePeer::EVENT_DATE_TIME=>4, EventLiveSchedulePeer::DAYS_AFTER=>5, EventLiveSchedulePeer::STEP_DAY=>6, EventLiveSchedulePeer::CREATED_AT=>7, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'event_live_id'=>1, 'event_date'=>2, 'start_time'=>3, 'event_date_time'=>4, 'days_after'=>5, 'step_day'=>6, 'created_at'=>7, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/EventLiveScheduleMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.EventLiveScheduleMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EventLiveSchedulePeer::getTableMap();
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
		return str_replace(EventLiveSchedulePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EventLiveSchedulePeer::ID);

		$criteria->addSelectColumn(EventLiveSchedulePeer::EVENT_LIVE_ID);

		$criteria->addSelectColumn(EventLiveSchedulePeer::EVENT_DATE);

		$criteria->addSelectColumn(EventLiveSchedulePeer::START_TIME);

		$criteria->addSelectColumn(EventLiveSchedulePeer::EVENT_DATE_TIME);

		$criteria->addSelectColumn(EventLiveSchedulePeer::DAYS_AFTER);

		$criteria->addSelectColumn(EventLiveSchedulePeer::STEP_DAY);

		$criteria->addSelectColumn(EventLiveSchedulePeer::CREATED_AT);

	}

	const COUNT = 'COUNT(event_live_schedule.EVENT_LIVE_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT event_live_schedule.EVENT_LIVE_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventLiveSchedulePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLiveSchedulePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EventLiveSchedulePeer::doSelectRS($criteria, $con);
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
		$objects = EventLiveSchedulePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EventLiveSchedulePeer::populateObjects(EventLiveSchedulePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EventLiveSchedulePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EventLiveSchedulePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinEventLive(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventLiveSchedulePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLiveSchedulePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLiveSchedulePeer::EVENT_LIVE_ID, EventLivePeer::ID);

		$rs = EventLiveSchedulePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinEventLive(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventLiveSchedulePeer::addSelectColumns($c);
		$startcol = (EventLiveSchedulePeer::NUM_COLUMNS - EventLiveSchedulePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		EventLivePeer::addSelectColumns($c);

		$c->addJoin(EventLiveSchedulePeer::EVENT_LIVE_ID, EventLivePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLiveSchedulePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EventLivePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getEventLive(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEventLiveSchedule($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventLiveScheduleList();
				$obj2->addEventLiveSchedule($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventLiveSchedulePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLiveSchedulePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLiveSchedulePeer::EVENT_LIVE_ID, EventLivePeer::ID);

		$rs = EventLiveSchedulePeer::doSelectRS($criteria, $con);
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

		EventLiveSchedulePeer::addSelectColumns($c);
		$startcol2 = (EventLiveSchedulePeer::NUM_COLUMNS - EventLiveSchedulePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EventLivePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EventLivePeer::NUM_COLUMNS;

		$c->addJoin(EventLiveSchedulePeer::EVENT_LIVE_ID, EventLivePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLiveSchedulePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = EventLivePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getEventLive(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEventLiveSchedule($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEventLiveScheduleList();
				$obj2->addEventLiveSchedule($obj1);
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
		return EventLiveSchedulePeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(EventLiveSchedulePeer::EVENT_LIVE_ID);
			$selectCriteria->add(EventLiveSchedulePeer::EVENT_LIVE_ID, $criteria->remove(EventLiveSchedulePeer::EVENT_LIVE_ID), $comparison);

			$comparison = $criteria->getComparison(EventLiveSchedulePeer::EVENT_DATE);
			$selectCriteria->add(EventLiveSchedulePeer::EVENT_DATE, $criteria->remove(EventLiveSchedulePeer::EVENT_DATE), $comparison);

			$comparison = $criteria->getComparison(EventLiveSchedulePeer::START_TIME);
			$selectCriteria->add(EventLiveSchedulePeer::START_TIME, $criteria->remove(EventLiveSchedulePeer::START_TIME), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(EventLiveSchedulePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EventLiveSchedulePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof EventLiveSchedule) {

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
				$vals[2][] = $value[2];
			}

			$criteria->add(EventLiveSchedulePeer::EVENT_LIVE_ID, $vals[0], Criteria::IN);
			$criteria->add(EventLiveSchedulePeer::EVENT_DATE, $vals[1], Criteria::IN);
			$criteria->add(EventLiveSchedulePeer::START_TIME, $vals[2], Criteria::IN);
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

	
	public static function doValidate(EventLiveSchedule $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EventLiveSchedulePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EventLiveSchedulePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EventLiveSchedulePeer::DATABASE_NAME, EventLiveSchedulePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EventLiveSchedulePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $event_live_id, $event_date, $start_time, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(EventLiveSchedulePeer::EVENT_LIVE_ID, $event_live_id);
		$criteria->add(EventLiveSchedulePeer::EVENT_DATE, $event_date);
		$criteria->add(EventLiveSchedulePeer::START_TIME, $start_time);
		$v = EventLiveSchedulePeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseEventLiveSchedulePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/EventLiveScheduleMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.EventLiveScheduleMapBuilder');
}
