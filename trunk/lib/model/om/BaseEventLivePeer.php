<?php


abstract class BaseEventLivePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'event_live';

	
	const CLASS_DEFAULT = 'lib.model.EventLive';

	
	const NUM_COLUMNS = 22;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'event_live.ID';

	
	const RANKING_LIVE_ID = 'event_live.RANKING_LIVE_ID';

	
	const EVENT_NAME = 'event_live.EVENT_NAME';

	
	const EVENT_SHORT_NAME = 'event_live.EVENT_SHORT_NAME';

	
	const EVENT_DATE = 'event_live.EVENT_DATE';

	
	const START_TIME = 'event_live.START_TIME';

	
	const EVENT_DATETIME = 'event_live.EVENT_DATETIME';

	
	const DESCRIPTION = 'event_live.DESCRIPTION';

	
	const CLUB_ID = 'event_live.CLUB_ID';

	
	const BUYIN = 'event_live.BUYIN';

	
	const BLIND_TIME = 'event_live.BLIND_TIME';

	
	const STACK_CHIPS = 'event_live.STACK_CHIPS';

	
	const PLAYERS = 'event_live.PLAYERS';

	
	const ALLOWED_REBUYS = 'event_live.ALLOWED_REBUYS';

	
	const ALLOWED_ADDONS = 'event_live.ALLOWED_ADDONS';

	
	const IS_ILIMITED_REBUYS = 'event_live.IS_ILIMITED_REBUYS';

	
	const ENABLED = 'event_live.ENABLED';

	
	const VISIBLE = 'event_live.VISIBLE';

	
	const DELETED = 'event_live.DELETED';

	
	const LOCKED = 'event_live.LOCKED';

	
	const CREATED_AT = 'event_live.CREATED_AT';

	
	const UPDATED_AT = 'event_live.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'RankingLiveId', 'EventName', 'EventShortName', 'EventDate', 'StartTime', 'EventDatetime', 'Description', 'ClubId', 'Buyin', 'BlindTime', 'StackChips', 'Players', 'AllowedRebuys', 'AllowedAddons', 'IsIlimitedRebuys', 'Enabled', 'Visible', 'Deleted', 'Locked', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (EventLivePeer::ID, EventLivePeer::RANKING_LIVE_ID, EventLivePeer::EVENT_NAME, EventLivePeer::EVENT_SHORT_NAME, EventLivePeer::EVENT_DATE, EventLivePeer::START_TIME, EventLivePeer::EVENT_DATETIME, EventLivePeer::DESCRIPTION, EventLivePeer::CLUB_ID, EventLivePeer::BUYIN, EventLivePeer::BLIND_TIME, EventLivePeer::STACK_CHIPS, EventLivePeer::PLAYERS, EventLivePeer::ALLOWED_REBUYS, EventLivePeer::ALLOWED_ADDONS, EventLivePeer::IS_ILIMITED_REBUYS, EventLivePeer::ENABLED, EventLivePeer::VISIBLE, EventLivePeer::DELETED, EventLivePeer::LOCKED, EventLivePeer::CREATED_AT, EventLivePeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'ranking_live_id', 'event_name', 'event_short_name', 'event_date', 'start_time', 'event_datetime', 'description', 'club_id', 'buyin', 'blind_time', 'stack_chips', 'players', 'allowed_rebuys', 'allowed_addons', 'is_ilimited_rebuys', 'enabled', 'visible', 'deleted', 'locked', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'RANKING_LIVE_ID'=>'', 'EVENT_NAME'=>'', 'EVENT_SHORT_NAME'=>'', 'EVENT_DATE'=>'', 'START_TIME'=>'', 'EVENT_DATETIME'=>'', 'DESCRIPTION'=>'', 'CLUB_ID'=>'', 'BUYIN'=>'', 'BLIND_TIME'=>'', 'STACK_CHIPS'=>'', 'PLAYERS'=>'', 'ALLOWED_REBUYS'=>'', 'ALLOWED_ADDONS'=>'', 'IS_ILIMITED_REBUYS'=>'', 'ENABLED'=>'', 'VISIBLE'=>'', 'DELETED'=>'', 'LOCKED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'RankingLiveId'=>1, 'EventName'=>2, 'EventShortName'=>3, 'EventDate'=>4, 'StartTime'=>5, 'EventDatetime'=>6, 'Description'=>7, 'ClubId'=>8, 'Buyin'=>9, 'BlindTime'=>10, 'StackChips'=>11, 'Players'=>12, 'AllowedRebuys'=>13, 'AllowedAddons'=>14, 'IsIlimitedRebuys'=>15, 'Enabled'=>16, 'Visible'=>17, 'Deleted'=>18, 'Locked'=>19, 'CreatedAt'=>20, 'UpdatedAt'=>21, ),
		BasePeer::TYPE_COLNAME=>array (EventLivePeer::ID=>0, EventLivePeer::RANKING_LIVE_ID=>1, EventLivePeer::EVENT_NAME=>2, EventLivePeer::EVENT_SHORT_NAME=>3, EventLivePeer::EVENT_DATE=>4, EventLivePeer::START_TIME=>5, EventLivePeer::EVENT_DATETIME=>6, EventLivePeer::DESCRIPTION=>7, EventLivePeer::CLUB_ID=>8, EventLivePeer::BUYIN=>9, EventLivePeer::BLIND_TIME=>10, EventLivePeer::STACK_CHIPS=>11, EventLivePeer::PLAYERS=>12, EventLivePeer::ALLOWED_REBUYS=>13, EventLivePeer::ALLOWED_ADDONS=>14, EventLivePeer::IS_ILIMITED_REBUYS=>15, EventLivePeer::ENABLED=>16, EventLivePeer::VISIBLE=>17, EventLivePeer::DELETED=>18, EventLivePeer::LOCKED=>19, EventLivePeer::CREATED_AT=>20, EventLivePeer::UPDATED_AT=>21, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'ranking_live_id'=>1, 'event_name'=>2, 'event_short_name'=>3, 'event_date'=>4, 'start_time'=>5, 'event_datetime'=>6, 'description'=>7, 'club_id'=>8, 'buyin'=>9, 'blind_time'=>10, 'stack_chips'=>11, 'players'=>12, 'allowed_rebuys'=>13, 'allowed_addons'=>14, 'is_ilimited_rebuys'=>15, 'enabled'=>16, 'visible'=>17, 'deleted'=>18, 'locked'=>19, 'created_at'=>20, 'updated_at'=>21, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/EventLiveMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.EventLiveMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EventLivePeer::getTableMap();
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
		return str_replace(EventLivePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EventLivePeer::ID);

		$criteria->addSelectColumn(EventLivePeer::RANKING_LIVE_ID);

		$criteria->addSelectColumn(EventLivePeer::EVENT_NAME);

		$criteria->addSelectColumn(EventLivePeer::EVENT_SHORT_NAME);

		$criteria->addSelectColumn(EventLivePeer::EVENT_DATE);

		$criteria->addSelectColumn(EventLivePeer::START_TIME);

		$criteria->addSelectColumn(EventLivePeer::EVENT_DATETIME);

		$criteria->addSelectColumn(EventLivePeer::DESCRIPTION);

		$criteria->addSelectColumn(EventLivePeer::CLUB_ID);

		$criteria->addSelectColumn(EventLivePeer::BUYIN);

		$criteria->addSelectColumn(EventLivePeer::BLIND_TIME);

		$criteria->addSelectColumn(EventLivePeer::STACK_CHIPS);

		$criteria->addSelectColumn(EventLivePeer::PLAYERS);

		$criteria->addSelectColumn(EventLivePeer::ALLOWED_REBUYS);

		$criteria->addSelectColumn(EventLivePeer::ALLOWED_ADDONS);

		$criteria->addSelectColumn(EventLivePeer::IS_ILIMITED_REBUYS);

		$criteria->addSelectColumn(EventLivePeer::ENABLED);

		$criteria->addSelectColumn(EventLivePeer::VISIBLE);

		$criteria->addSelectColumn(EventLivePeer::DELETED);

		$criteria->addSelectColumn(EventLivePeer::LOCKED);

		$criteria->addSelectColumn(EventLivePeer::CREATED_AT);

		$criteria->addSelectColumn(EventLivePeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(event_live.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT event_live.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventLivePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EventLivePeer::doSelectRS($criteria, $con);
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
		$objects = EventLivePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EventLivePeer::populateObjects(EventLivePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EventLivePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EventLivePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinRankingLive(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventLivePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLivePeer::RANKING_LIVE_ID, RankingLivePeer::ID);

		$rs = EventLivePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(EventLivePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLivePeer::CLUB_ID, ClubPeer::ID);

		$rs = EventLivePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinRankingLive(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventLivePeer::addSelectColumns($c);
		$startcol = (EventLivePeer::NUM_COLUMNS - EventLivePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		RankingLivePeer::addSelectColumns($c);

		$c->addJoin(EventLivePeer::RANKING_LIVE_ID, RankingLivePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLivePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = RankingLivePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getRankingLive(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEventLive($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventLiveList();
				$obj2->addEventLive($obj1); 			}
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

		EventLivePeer::addSelectColumns($c);
		$startcol = (EventLivePeer::NUM_COLUMNS - EventLivePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ClubPeer::addSelectColumns($c);

		$c->addJoin(EventLivePeer::CLUB_ID, ClubPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLivePeer::getOMClass();

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
										$temp_obj2->addEventLive($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventLiveList();
				$obj2->addEventLive($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventLivePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLivePeer::RANKING_LIVE_ID, RankingLivePeer::ID);

		$criteria->addJoin(EventLivePeer::CLUB_ID, ClubPeer::ID);

		$rs = EventLivePeer::doSelectRS($criteria, $con);
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

		EventLivePeer::addSelectColumns($c);
		$startcol2 = (EventLivePeer::NUM_COLUMNS - EventLivePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RankingLivePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RankingLivePeer::NUM_COLUMNS;

		ClubPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ClubPeer::NUM_COLUMNS;

		$c->addJoin(EventLivePeer::RANKING_LIVE_ID, RankingLivePeer::ID);

		$c->addJoin(EventLivePeer::CLUB_ID, ClubPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLivePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = RankingLivePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getRankingLive(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEventLive($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEventLiveList();
				$obj2->addEventLive($obj1);
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
					$temp_obj3->addEventLive($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initEventLiveList();
				$obj3->addEventLive($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptRankingLive(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventLivePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLivePeer::CLUB_ID, ClubPeer::ID);

		$rs = EventLivePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(EventLivePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLivePeer::RANKING_LIVE_ID, RankingLivePeer::ID);

		$rs = EventLivePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptRankingLive(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventLivePeer::addSelectColumns($c);
		$startcol2 = (EventLivePeer::NUM_COLUMNS - EventLivePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ClubPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ClubPeer::NUM_COLUMNS;

		$c->addJoin(EventLivePeer::CLUB_ID, ClubPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLivePeer::getOMClass();

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
					$temp_obj2->addEventLive($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEventLiveList();
				$obj2->addEventLive($obj1);
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

		EventLivePeer::addSelectColumns($c);
		$startcol2 = (EventLivePeer::NUM_COLUMNS - EventLivePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RankingLivePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RankingLivePeer::NUM_COLUMNS;

		$c->addJoin(EventLivePeer::RANKING_LIVE_ID, RankingLivePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLivePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = RankingLivePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getRankingLive(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEventLive($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEventLiveList();
				$obj2->addEventLive($obj1);
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
		return EventLivePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(EventLivePeer::ID); 

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
			$comparison = $criteria->getComparison(EventLivePeer::ID);
			$selectCriteria->add(EventLivePeer::ID, $criteria->remove(EventLivePeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(EventLivePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EventLivePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof EventLive) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(EventLivePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(EventLive $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EventLivePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EventLivePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EventLivePeer::DATABASE_NAME, EventLivePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EventLivePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(EventLivePeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(EventLivePeer::ID, $pk);


		$v = EventLivePeer::doSelect($criteria, $con);

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
			$criteria->add(EventLivePeer::ID, $pks, Criteria::IN);
			$objs = EventLivePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseEventLivePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/EventLiveMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.EventLiveMapBuilder');
}
