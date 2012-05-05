<?php


abstract class BaseEventLivePlayerPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'event_live_player';

	
	const CLASS_DEFAULT = 'lib.model.EventLivePlayer';

	
	const NUM_COLUMNS = 14;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const EVENT_LIVE_ID = 'event_live_player.EVENT_LIVE_ID';

	
	const PEOPLE_ID = 'event_live_player.PEOPLE_ID';

	
	const EMAIL_LOG_ID = 'event_live_player.EMAIL_LOG_ID';

	
	const ENABLED = 'event_live_player.ENABLED';

	
	const EVENT_POSITION = 'event_live_player.EVENT_POSITION';

	
	const PRIZE = 'event_live_player.PRIZE';

	
	const SCORE = 'event_live_player.SCORE';

	
	const ENTRANCE_FEE = 'event_live_player.ENTRANCE_FEE';

	
	const BUYIN = 'event_live_player.BUYIN';

	
	const REBUY = 'event_live_player.REBUY';

	
	const ADDON = 'event_live_player.ADDON';

	
	const DELETED = 'event_live_player.DELETED';

	
	const CREATED_AT = 'event_live_player.CREATED_AT';

	
	const UPDATED_AT = 'event_live_player.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('EventLiveId', 'PeopleId', 'EmailLogId', 'Enabled', 'EventPosition', 'Prize', 'Score', 'EntranceFee', 'Buyin', 'Rebuy', 'Addon', 'Deleted', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (EventLivePlayerPeer::EVENT_LIVE_ID, EventLivePlayerPeer::PEOPLE_ID, EventLivePlayerPeer::EMAIL_LOG_ID, EventLivePlayerPeer::ENABLED, EventLivePlayerPeer::EVENT_POSITION, EventLivePlayerPeer::PRIZE, EventLivePlayerPeer::SCORE, EventLivePlayerPeer::ENTRANCE_FEE, EventLivePlayerPeer::BUYIN, EventLivePlayerPeer::REBUY, EventLivePlayerPeer::ADDON, EventLivePlayerPeer::DELETED, EventLivePlayerPeer::CREATED_AT, EventLivePlayerPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('event_live_id', 'people_id', 'email_log_id', 'enabled', 'event_position', 'prize', 'score', 'entrance_fee', 'buyin', 'rebuy', 'addon', 'deleted', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('EVENT_LIVE_ID'=>'', 'PEOPLE_ID'=>'', 'EMAIL_LOG_ID'=>'', 'ENABLED'=>'', 'EVENT_POSITION'=>'', 'PRIZE'=>'', 'SCORE'=>'', 'ENTRANCE_FEE'=>'', 'BUYIN'=>'', 'REBUY'=>'', 'ADDON'=>'', 'DELETED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('EventLiveId'=>0, 'PeopleId'=>1, 'EmailLogId'=>2, 'Enabled'=>3, 'EventPosition'=>4, 'Prize'=>5, 'Score'=>6, 'EntranceFee'=>7, 'Buyin'=>8, 'Rebuy'=>9, 'Addon'=>10, 'Deleted'=>11, 'CreatedAt'=>12, 'UpdatedAt'=>13, ),
		BasePeer::TYPE_COLNAME=>array (EventLivePlayerPeer::EVENT_LIVE_ID=>0, EventLivePlayerPeer::PEOPLE_ID=>1, EventLivePlayerPeer::EMAIL_LOG_ID=>2, EventLivePlayerPeer::ENABLED=>3, EventLivePlayerPeer::EVENT_POSITION=>4, EventLivePlayerPeer::PRIZE=>5, EventLivePlayerPeer::SCORE=>6, EventLivePlayerPeer::ENTRANCE_FEE=>7, EventLivePlayerPeer::BUYIN=>8, EventLivePlayerPeer::REBUY=>9, EventLivePlayerPeer::ADDON=>10, EventLivePlayerPeer::DELETED=>11, EventLivePlayerPeer::CREATED_AT=>12, EventLivePlayerPeer::UPDATED_AT=>13, ),
		BasePeer::TYPE_FIELDNAME=>array ('event_live_id'=>0, 'people_id'=>1, 'email_log_id'=>2, 'enabled'=>3, 'event_position'=>4, 'prize'=>5, 'score'=>6, 'entrance_fee'=>7, 'buyin'=>8, 'rebuy'=>9, 'addon'=>10, 'deleted'=>11, 'created_at'=>12, 'updated_at'=>13, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/EventLivePlayerMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.EventLivePlayerMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EventLivePlayerPeer::getTableMap();
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
		return str_replace(EventLivePlayerPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EventLivePlayerPeer::EVENT_LIVE_ID);

		$criteria->addSelectColumn(EventLivePlayerPeer::PEOPLE_ID);

		$criteria->addSelectColumn(EventLivePlayerPeer::EMAIL_LOG_ID);

		$criteria->addSelectColumn(EventLivePlayerPeer::ENABLED);

		$criteria->addSelectColumn(EventLivePlayerPeer::EVENT_POSITION);

		$criteria->addSelectColumn(EventLivePlayerPeer::PRIZE);

		$criteria->addSelectColumn(EventLivePlayerPeer::SCORE);

		$criteria->addSelectColumn(EventLivePlayerPeer::ENTRANCE_FEE);

		$criteria->addSelectColumn(EventLivePlayerPeer::BUYIN);

		$criteria->addSelectColumn(EventLivePlayerPeer::REBUY);

		$criteria->addSelectColumn(EventLivePlayerPeer::ADDON);

		$criteria->addSelectColumn(EventLivePlayerPeer::DELETED);

		$criteria->addSelectColumn(EventLivePlayerPeer::CREATED_AT);

		$criteria->addSelectColumn(EventLivePlayerPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(event_live_player.EVENT_LIVE_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT event_live_player.EVENT_LIVE_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventLivePlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EventLivePlayerPeer::doSelectRS($criteria, $con);
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
		$objects = EventLivePlayerPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EventLivePlayerPeer::populateObjects(EventLivePlayerPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EventLivePlayerPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EventLivePlayerPeer::getOMClass();
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
			$criteria->addSelectColumn(EventLivePlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLivePlayerPeer::EVENT_LIVE_ID, EventLivePeer::ID);

		$rs = EventLivePlayerPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(EventLivePlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLivePlayerPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = EventLivePlayerPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinEmailLog(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventLivePlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLivePlayerPeer::EMAIL_LOG_ID, EmailLogPeer::ID);

		$rs = EventLivePlayerPeer::doSelectRS($criteria, $con);
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

		EventLivePlayerPeer::addSelectColumns($c);
		$startcol = (EventLivePlayerPeer::NUM_COLUMNS - EventLivePlayerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		EventLivePeer::addSelectColumns($c);

		$c->addJoin(EventLivePlayerPeer::EVENT_LIVE_ID, EventLivePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLivePlayerPeer::getOMClass();

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
										$temp_obj2->addEventLivePlayer($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventLivePlayerList();
				$obj2->addEventLivePlayer($obj1); 			}
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

		EventLivePlayerPeer::addSelectColumns($c);
		$startcol = (EventLivePlayerPeer::NUM_COLUMNS - EventLivePlayerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PeoplePeer::addSelectColumns($c);

		$c->addJoin(EventLivePlayerPeer::PEOPLE_ID, PeoplePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLivePlayerPeer::getOMClass();

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
										$temp_obj2->addEventLivePlayer($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventLivePlayerList();
				$obj2->addEventLivePlayer($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinEmailLog(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventLivePlayerPeer::addSelectColumns($c);
		$startcol = (EventLivePlayerPeer::NUM_COLUMNS - EventLivePlayerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		EmailLogPeer::addSelectColumns($c);

		$c->addJoin(EventLivePlayerPeer::EMAIL_LOG_ID, EmailLogPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLivePlayerPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EmailLogPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getEmailLog(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEventLivePlayer($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventLivePlayerList();
				$obj2->addEventLivePlayer($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventLivePlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLivePlayerPeer::EVENT_LIVE_ID, EventLivePeer::ID);

		$criteria->addJoin(EventLivePlayerPeer::PEOPLE_ID, PeoplePeer::ID);

		$criteria->addJoin(EventLivePlayerPeer::EMAIL_LOG_ID, EmailLogPeer::ID);

		$rs = EventLivePlayerPeer::doSelectRS($criteria, $con);
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

		EventLivePlayerPeer::addSelectColumns($c);
		$startcol2 = (EventLivePlayerPeer::NUM_COLUMNS - EventLivePlayerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EventLivePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EventLivePeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PeoplePeer::NUM_COLUMNS;

		EmailLogPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + EmailLogPeer::NUM_COLUMNS;

		$c->addJoin(EventLivePlayerPeer::EVENT_LIVE_ID, EventLivePeer::ID);

		$c->addJoin(EventLivePlayerPeer::PEOPLE_ID, PeoplePeer::ID);

		$c->addJoin(EventLivePlayerPeer::EMAIL_LOG_ID, EmailLogPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLivePlayerPeer::getOMClass();


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
					$temp_obj2->addEventLivePlayer($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEventLivePlayerList();
				$obj2->addEventLivePlayer($obj1);
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
					$temp_obj3->addEventLivePlayer($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initEventLivePlayerList();
				$obj3->addEventLivePlayer($obj1);
			}


					
			$omClass = EmailLogPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getEmailLog(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addEventLivePlayer($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initEventLivePlayerList();
				$obj4->addEventLivePlayer($obj1);
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
			$criteria->addSelectColumn(EventLivePlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLivePlayerPeer::PEOPLE_ID, PeoplePeer::ID);

		$criteria->addJoin(EventLivePlayerPeer::EMAIL_LOG_ID, EmailLogPeer::ID);

		$rs = EventLivePlayerPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(EventLivePlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLivePlayerPeer::EVENT_LIVE_ID, EventLivePeer::ID);

		$criteria->addJoin(EventLivePlayerPeer::EMAIL_LOG_ID, EmailLogPeer::ID);

		$rs = EventLivePlayerPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptEmailLog(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventLivePlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLivePlayerPeer::EVENT_LIVE_ID, EventLivePeer::ID);

		$criteria->addJoin(EventLivePlayerPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = EventLivePlayerPeer::doSelectRS($criteria, $con);
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

		EventLivePlayerPeer::addSelectColumns($c);
		$startcol2 = (EventLivePlayerPeer::NUM_COLUMNS - EventLivePlayerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PeoplePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PeoplePeer::NUM_COLUMNS;

		EmailLogPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + EmailLogPeer::NUM_COLUMNS;

		$c->addJoin(EventLivePlayerPeer::PEOPLE_ID, PeoplePeer::ID);

		$c->addJoin(EventLivePlayerPeer::EMAIL_LOG_ID, EmailLogPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLivePlayerPeer::getOMClass();

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
					$temp_obj2->addEventLivePlayer($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEventLivePlayerList();
				$obj2->addEventLivePlayer($obj1);
			}

			$omClass = EmailLogPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getEmailLog(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEventLivePlayer($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initEventLivePlayerList();
				$obj3->addEventLivePlayer($obj1);
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

		EventLivePlayerPeer::addSelectColumns($c);
		$startcol2 = (EventLivePlayerPeer::NUM_COLUMNS - EventLivePlayerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EventLivePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EventLivePeer::NUM_COLUMNS;

		EmailLogPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + EmailLogPeer::NUM_COLUMNS;

		$c->addJoin(EventLivePlayerPeer::EVENT_LIVE_ID, EventLivePeer::ID);

		$c->addJoin(EventLivePlayerPeer::EMAIL_LOG_ID, EmailLogPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLivePlayerPeer::getOMClass();

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
					$temp_obj2->addEventLivePlayer($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEventLivePlayerList();
				$obj2->addEventLivePlayer($obj1);
			}

			$omClass = EmailLogPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getEmailLog(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEventLivePlayer($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initEventLivePlayerList();
				$obj3->addEventLivePlayer($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptEmailLog(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventLivePlayerPeer::addSelectColumns($c);
		$startcol2 = (EventLivePlayerPeer::NUM_COLUMNS - EventLivePlayerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EventLivePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EventLivePeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(EventLivePlayerPeer::EVENT_LIVE_ID, EventLivePeer::ID);

		$c->addJoin(EventLivePlayerPeer::PEOPLE_ID, PeoplePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLivePlayerPeer::getOMClass();

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
					$temp_obj2->addEventLivePlayer($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEventLivePlayerList();
				$obj2->addEventLivePlayer($obj1);
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
					$temp_obj3->addEventLivePlayer($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initEventLivePlayerList();
				$obj3->addEventLivePlayer($obj1);
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
		return EventLivePlayerPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(EventLivePlayerPeer::EVENT_LIVE_ID);
			$selectCriteria->add(EventLivePlayerPeer::EVENT_LIVE_ID, $criteria->remove(EventLivePlayerPeer::EVENT_LIVE_ID), $comparison);

			$comparison = $criteria->getComparison(EventLivePlayerPeer::PEOPLE_ID);
			$selectCriteria->add(EventLivePlayerPeer::PEOPLE_ID, $criteria->remove(EventLivePlayerPeer::PEOPLE_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(EventLivePlayerPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EventLivePlayerPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof EventLivePlayer) {

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

			$criteria->add(EventLivePlayerPeer::EVENT_LIVE_ID, $vals[0], Criteria::IN);
			$criteria->add(EventLivePlayerPeer::PEOPLE_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(EventLivePlayer $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EventLivePlayerPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EventLivePlayerPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EventLivePlayerPeer::DATABASE_NAME, EventLivePlayerPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EventLivePlayerPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
		$criteria->add(EventLivePlayerPeer::EVENT_LIVE_ID, $event_live_id);
		$criteria->add(EventLivePlayerPeer::PEOPLE_ID, $people_id);
		$v = EventLivePlayerPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseEventLivePlayerPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/EventLivePlayerMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.EventLivePlayerMapBuilder');
}
