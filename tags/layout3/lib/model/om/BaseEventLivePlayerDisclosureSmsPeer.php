<?php


abstract class BaseEventLivePlayerDisclosureSmsPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'event_live_player_disclosure_sms';

	
	const CLASS_DEFAULT = 'lib.model.EventLivePlayerDisclosureSms';

	
	const NUM_COLUMNS = 5;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const EVENT_LIVE_ID = 'event_live_player_disclosure_sms.EVENT_LIVE_ID';

	
	const PEOPLE_ID = 'event_live_player_disclosure_sms.PEOPLE_ID';

	
	const SMS_LOG_ID = 'event_live_player_disclosure_sms.SMS_LOG_ID';

	
	const SMS_ID = 'event_live_player_disclosure_sms.SMS_ID';

	
	const CREATED_AT = 'event_live_player_disclosure_sms.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('EventLiveId', 'PeopleId', 'SmsLogId', 'SmsId', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME=>array (EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID, EventLivePlayerDisclosureSmsPeer::PEOPLE_ID, EventLivePlayerDisclosureSmsPeer::SMS_LOG_ID, EventLivePlayerDisclosureSmsPeer::SMS_ID, EventLivePlayerDisclosureSmsPeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('event_live_id', 'people_id', 'sms_log_id', 'sms_id', 'created_at', ),
		BasePeer::TYPE_ALIAS=>array ('EVENT_LIVE_ID'=>'', 'PEOPLE_ID'=>'', 'SMS_LOG_ID'=>'', 'SMS_ID'=>'', 'CREATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('EventLiveId'=>0, 'PeopleId'=>1, 'SmsLogId'=>2, 'SmsId'=>3, 'CreatedAt'=>4, ),
		BasePeer::TYPE_COLNAME=>array (EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID=>0, EventLivePlayerDisclosureSmsPeer::PEOPLE_ID=>1, EventLivePlayerDisclosureSmsPeer::SMS_LOG_ID=>2, EventLivePlayerDisclosureSmsPeer::SMS_ID=>3, EventLivePlayerDisclosureSmsPeer::CREATED_AT=>4, ),
		BasePeer::TYPE_FIELDNAME=>array ('event_live_id'=>0, 'people_id'=>1, 'sms_log_id'=>2, 'sms_id'=>3, 'created_at'=>4, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/EventLivePlayerDisclosureSmsMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.EventLivePlayerDisclosureSmsMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EventLivePlayerDisclosureSmsPeer::getTableMap();
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
		return str_replace(EventLivePlayerDisclosureSmsPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID);

		$criteria->addSelectColumn(EventLivePlayerDisclosureSmsPeer::PEOPLE_ID);

		$criteria->addSelectColumn(EventLivePlayerDisclosureSmsPeer::SMS_LOG_ID);

		$criteria->addSelectColumn(EventLivePlayerDisclosureSmsPeer::SMS_ID);

		$criteria->addSelectColumn(EventLivePlayerDisclosureSmsPeer::CREATED_AT);

	}

	const COUNT = 'COUNT(event_live_player_disclosure_sms.EVENT_LIVE_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT event_live_player_disclosure_sms.EVENT_LIVE_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventLivePlayerDisclosureSmsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePlayerDisclosureSmsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EventLivePlayerDisclosureSmsPeer::doSelectRS($criteria, $con);
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
		$objects = EventLivePlayerDisclosureSmsPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EventLivePlayerDisclosureSmsPeer::populateObjects(EventLivePlayerDisclosureSmsPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EventLivePlayerDisclosureSmsPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EventLivePlayerDisclosureSmsPeer::getOMClass();
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
			$criteria->addSelectColumn(EventLivePlayerDisclosureSmsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePlayerDisclosureSmsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID, EventLivePeer::ID);

		$rs = EventLivePlayerDisclosureSmsPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(EventLivePlayerDisclosureSmsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePlayerDisclosureSmsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLivePlayerDisclosureSmsPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = EventLivePlayerDisclosureSmsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinSms(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventLivePlayerDisclosureSmsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePlayerDisclosureSmsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLivePlayerDisclosureSmsPeer::SMS_ID, SmsPeer::ID);

		$rs = EventLivePlayerDisclosureSmsPeer::doSelectRS($criteria, $con);
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

		EventLivePlayerDisclosureSmsPeer::addSelectColumns($c);
		$startcol = (EventLivePlayerDisclosureSmsPeer::NUM_COLUMNS - EventLivePlayerDisclosureSmsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		EventLivePeer::addSelectColumns($c);

		$c->addJoin(EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID, EventLivePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLivePlayerDisclosureSmsPeer::getOMClass();

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
										$temp_obj2->addEventLivePlayerDisclosureSms($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventLivePlayerDisclosureSmsList();
				$obj2->addEventLivePlayerDisclosureSms($obj1); 			}
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

		EventLivePlayerDisclosureSmsPeer::addSelectColumns($c);
		$startcol = (EventLivePlayerDisclosureSmsPeer::NUM_COLUMNS - EventLivePlayerDisclosureSmsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PeoplePeer::addSelectColumns($c);

		$c->addJoin(EventLivePlayerDisclosureSmsPeer::PEOPLE_ID, PeoplePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLivePlayerDisclosureSmsPeer::getOMClass();

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
										$temp_obj2->addEventLivePlayerDisclosureSms($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventLivePlayerDisclosureSmsList();
				$obj2->addEventLivePlayerDisclosureSms($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinSms(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventLivePlayerDisclosureSmsPeer::addSelectColumns($c);
		$startcol = (EventLivePlayerDisclosureSmsPeer::NUM_COLUMNS - EventLivePlayerDisclosureSmsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SmsPeer::addSelectColumns($c);

		$c->addJoin(EventLivePlayerDisclosureSmsPeer::SMS_ID, SmsPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLivePlayerDisclosureSmsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SmsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getSms(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEventLivePlayerDisclosureSms($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventLivePlayerDisclosureSmsList();
				$obj2->addEventLivePlayerDisclosureSms($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventLivePlayerDisclosureSmsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePlayerDisclosureSmsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID, EventLivePeer::ID);

		$criteria->addJoin(EventLivePlayerDisclosureSmsPeer::PEOPLE_ID, PeoplePeer::ID);

		$criteria->addJoin(EventLivePlayerDisclosureSmsPeer::SMS_ID, SmsPeer::ID);

		$rs = EventLivePlayerDisclosureSmsPeer::doSelectRS($criteria, $con);
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

		EventLivePlayerDisclosureSmsPeer::addSelectColumns($c);
		$startcol2 = (EventLivePlayerDisclosureSmsPeer::NUM_COLUMNS - EventLivePlayerDisclosureSmsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EventLivePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EventLivePeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PeoplePeer::NUM_COLUMNS;

		SmsPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SmsPeer::NUM_COLUMNS;

		$c->addJoin(EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID, EventLivePeer::ID);

		$c->addJoin(EventLivePlayerDisclosureSmsPeer::PEOPLE_ID, PeoplePeer::ID);

		$c->addJoin(EventLivePlayerDisclosureSmsPeer::SMS_ID, SmsPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLivePlayerDisclosureSmsPeer::getOMClass();


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
					$temp_obj2->addEventLivePlayerDisclosureSms($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEventLivePlayerDisclosureSmsList();
				$obj2->addEventLivePlayerDisclosureSms($obj1);
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
					$temp_obj3->addEventLivePlayerDisclosureSms($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initEventLivePlayerDisclosureSmsList();
				$obj3->addEventLivePlayerDisclosureSms($obj1);
			}


					
			$omClass = SmsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getSms(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addEventLivePlayerDisclosureSms($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initEventLivePlayerDisclosureSmsList();
				$obj4->addEventLivePlayerDisclosureSms($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptEventLive(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventLivePlayerDisclosureSmsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePlayerDisclosureSmsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLivePlayerDisclosureSmsPeer::PEOPLE_ID, PeoplePeer::ID);

		$criteria->addJoin(EventLivePlayerDisclosureSmsPeer::SMS_ID, SmsPeer::ID);

		$rs = EventLivePlayerDisclosureSmsPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(EventLivePlayerDisclosureSmsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePlayerDisclosureSmsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID, EventLivePeer::ID);

		$criteria->addJoin(EventLivePlayerDisclosureSmsPeer::SMS_ID, SmsPeer::ID);

		$rs = EventLivePlayerDisclosureSmsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptSms(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventLivePlayerDisclosureSmsPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePlayerDisclosureSmsPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID, EventLivePeer::ID);

		$criteria->addJoin(EventLivePlayerDisclosureSmsPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = EventLivePlayerDisclosureSmsPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptEventLive(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventLivePlayerDisclosureSmsPeer::addSelectColumns($c);
		$startcol2 = (EventLivePlayerDisclosureSmsPeer::NUM_COLUMNS - EventLivePlayerDisclosureSmsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PeoplePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PeoplePeer::NUM_COLUMNS;

		SmsPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SmsPeer::NUM_COLUMNS;

		$c->addJoin(EventLivePlayerDisclosureSmsPeer::PEOPLE_ID, PeoplePeer::ID);

		$c->addJoin(EventLivePlayerDisclosureSmsPeer::SMS_ID, SmsPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLivePlayerDisclosureSmsPeer::getOMClass();

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
					$temp_obj2->addEventLivePlayerDisclosureSms($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEventLivePlayerDisclosureSmsList();
				$obj2->addEventLivePlayerDisclosureSms($obj1);
			}

			$omClass = SmsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getSms(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEventLivePlayerDisclosureSms($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initEventLivePlayerDisclosureSmsList();
				$obj3->addEventLivePlayerDisclosureSms($obj1);
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

		EventLivePlayerDisclosureSmsPeer::addSelectColumns($c);
		$startcol2 = (EventLivePlayerDisclosureSmsPeer::NUM_COLUMNS - EventLivePlayerDisclosureSmsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EventLivePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EventLivePeer::NUM_COLUMNS;

		SmsPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SmsPeer::NUM_COLUMNS;

		$c->addJoin(EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID, EventLivePeer::ID);

		$c->addJoin(EventLivePlayerDisclosureSmsPeer::SMS_ID, SmsPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLivePlayerDisclosureSmsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EventLivePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getEventLive(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEventLivePlayerDisclosureSms($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEventLivePlayerDisclosureSmsList();
				$obj2->addEventLivePlayerDisclosureSms($obj1);
			}

			$omClass = SmsPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getSms(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEventLivePlayerDisclosureSms($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initEventLivePlayerDisclosureSmsList();
				$obj3->addEventLivePlayerDisclosureSms($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptSms(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventLivePlayerDisclosureSmsPeer::addSelectColumns($c);
		$startcol2 = (EventLivePlayerDisclosureSmsPeer::NUM_COLUMNS - EventLivePlayerDisclosureSmsPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EventLivePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EventLivePeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID, EventLivePeer::ID);

		$c->addJoin(EventLivePlayerDisclosureSmsPeer::PEOPLE_ID, PeoplePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLivePlayerDisclosureSmsPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EventLivePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getEventLive(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEventLivePlayerDisclosureSms($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEventLivePlayerDisclosureSmsList();
				$obj2->addEventLivePlayerDisclosureSms($obj1);
			}

			$omClass = PeoplePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getPeople(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEventLivePlayerDisclosureSms($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initEventLivePlayerDisclosureSmsList();
				$obj3->addEventLivePlayerDisclosureSms($obj1);
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
		return EventLivePlayerDisclosureSmsPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID);
			$selectCriteria->add(EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID, $criteria->remove(EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID), $comparison);

			$comparison = $criteria->getComparison(EventLivePlayerDisclosureSmsPeer::PEOPLE_ID);
			$selectCriteria->add(EventLivePlayerDisclosureSmsPeer::PEOPLE_ID, $criteria->remove(EventLivePlayerDisclosureSmsPeer::PEOPLE_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(EventLivePlayerDisclosureSmsPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EventLivePlayerDisclosureSmsPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof EventLivePlayerDisclosureSms) {

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

			$criteria->add(EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID, $vals[0], Criteria::IN);
			$criteria->add(EventLivePlayerDisclosureSmsPeer::PEOPLE_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(EventLivePlayerDisclosureSms $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EventLivePlayerDisclosureSmsPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EventLivePlayerDisclosureSmsPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EventLivePlayerDisclosureSmsPeer::DATABASE_NAME, EventLivePlayerDisclosureSmsPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EventLivePlayerDisclosureSmsPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $event_live_id, $people_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID, $event_live_id);
		$criteria->add(EventLivePlayerDisclosureSmsPeer::PEOPLE_ID, $people_id);
		$v = EventLivePlayerDisclosureSmsPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseEventLivePlayerDisclosureSmsPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/EventLivePlayerDisclosureSmsMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.EventLivePlayerDisclosureSmsMapBuilder');
}
