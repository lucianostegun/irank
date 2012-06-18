<?php


abstract class BaseEventLiveViewPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'event_live_view';

	
	const CLASS_DEFAULT = 'lib.model.EventLiveView';

	
	const NUM_COLUMNS = 31;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'event_live_view.ID';

	
	const RANKING_LIVE_ID = 'event_live_view.RANKING_LIVE_ID';

	
	const CLUB_ID = 'event_live_view.CLUB_ID';

	
	const EVENT_NAME = 'event_live_view.EVENT_NAME';

	
	const EVENT_DATE = 'event_live_view.EVENT_DATE';

	
	const START_TIME = 'event_live_view.START_TIME';

	
	const EVENT_DATE_TIME = 'event_live_view.EVENT_DATE_TIME';

	
	const STEP_NUMBER = 'event_live_view.STEP_NUMBER';

	
	const STEP_DAY = 'event_live_view.STEP_DAY';

	
	const COMMENTS = 'event_live_view.COMMENTS';

	
	const DESCRIPTION = 'event_live_view.DESCRIPTION';

	
	const IS_FREEROLL = 'event_live_view.IS_FREEROLL';

	
	const IS_MULTIDAY = 'event_live_view.IS_MULTIDAY';

	
	const IS_SATELLITE = 'event_live_view.IS_SATELLITE';

	
	const BUYIN = 'event_live_view.BUYIN';

	
	const ENTRANCE_FEE = 'event_live_view.ENTRANCE_FEE';

	
	const GUARANTEED_PRIZE = 'event_live_view.GUARANTEED_PRIZE';

	
	const BLIND_TIME = 'event_live_view.BLIND_TIME';

	
	const STACK_CHIPS = 'event_live_view.STACK_CHIPS';

	
	const PLAYERS = 'event_live_view.PLAYERS';

	
	const ALLOWED_REBUYS = 'event_live_view.ALLOWED_REBUYS';

	
	const ALLOWED_ADDONS = 'event_live_view.ALLOWED_ADDONS';

	
	const IS_ILIMITED_REBUYS = 'event_live_view.IS_ILIMITED_REBUYS';

	
	const SAVED_RESULT = 'event_live_view.SAVED_RESULT';

	
	const SUPPRESS_SCHEDULE = 'event_live_view.SUPPRESS_SCHEDULE';

	
	const SCHEDULE_START_DATE = 'event_live_view.SCHEDULE_START_DATE';

	
	const ENROLLMENT_START_DATE = 'event_live_view.ENROLLMENT_START_DATE';

	
	const ENROLLMENT_MODE = 'event_live_view.ENROLLMENT_MODE';

	
	const SUPPRESS_RANKING = 'event_live_view.SUPPRESS_RANKING';

	
	const CREATED_AT = 'event_live_view.CREATED_AT';

	
	const UPDATED_AT = 'event_live_view.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'RankingLiveId', 'ClubId', 'EventName', 'EventDate', 'StartTime', 'EventDateTime', 'StepNumber', 'StepDay', 'Comments', 'Description', 'IsFreeroll', 'IsMultiday', 'IsSatellite', 'Buyin', 'EntranceFee', 'GuaranteedPrize', 'BlindTime', 'StackChips', 'Players', 'AllowedRebuys', 'AllowedAddons', 'IsIlimitedRebuys', 'SavedResult', 'SuppressSchedule', 'ScheduleStartDate', 'EnrollmentStartDate', 'EnrollmentMode', 'SuppressRanking', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (EventLiveViewPeer::ID, EventLiveViewPeer::RANKING_LIVE_ID, EventLiveViewPeer::CLUB_ID, EventLiveViewPeer::EVENT_NAME, EventLiveViewPeer::EVENT_DATE, EventLiveViewPeer::START_TIME, EventLiveViewPeer::EVENT_DATE_TIME, EventLiveViewPeer::STEP_NUMBER, EventLiveViewPeer::STEP_DAY, EventLiveViewPeer::COMMENTS, EventLiveViewPeer::DESCRIPTION, EventLiveViewPeer::IS_FREEROLL, EventLiveViewPeer::IS_MULTIDAY, EventLiveViewPeer::IS_SATELLITE, EventLiveViewPeer::BUYIN, EventLiveViewPeer::ENTRANCE_FEE, EventLiveViewPeer::GUARANTEED_PRIZE, EventLiveViewPeer::BLIND_TIME, EventLiveViewPeer::STACK_CHIPS, EventLiveViewPeer::PLAYERS, EventLiveViewPeer::ALLOWED_REBUYS, EventLiveViewPeer::ALLOWED_ADDONS, EventLiveViewPeer::IS_ILIMITED_REBUYS, EventLiveViewPeer::SAVED_RESULT, EventLiveViewPeer::SUPPRESS_SCHEDULE, EventLiveViewPeer::SCHEDULE_START_DATE, EventLiveViewPeer::ENROLLMENT_START_DATE, EventLiveViewPeer::ENROLLMENT_MODE, EventLiveViewPeer::SUPPRESS_RANKING, EventLiveViewPeer::CREATED_AT, EventLiveViewPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'ranking_live_id', 'club_id', 'event_name', 'event_date', 'start_time', 'event_date_time', 'step_number', 'step_day', 'comments', 'description', 'is_freeroll', 'is_multiday', 'is_satellite', 'buyin', 'entrance_fee', 'guaranteed_prize', 'blind_time', 'stack_chips', 'players', 'allowed_rebuys', 'allowed_addons', 'is_ilimited_rebuys', 'saved_result', 'suppress_schedule', 'schedule_start_date', 'enrollment_start_date', 'enrollment_mode', 'suppress_ranking', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'RANKING_LIVE_ID'=>'', 'CLUB_ID'=>'', 'EVENT_NAME'=>'', 'EVENT_DATE'=>'', 'START_TIME'=>'', 'EVENT_DATE_TIME'=>'', 'STEP_NUMBER'=>'', 'STEP_DAY'=>'', 'COMMENTS'=>'', 'DESCRIPTION'=>'', 'IS_FREEROLL'=>'', 'IS_MULTIDAY'=>'', 'IS_SATELLITE'=>'', 'BUYIN'=>'', 'ENTRANCE_FEE'=>'', 'GUARANTEED_PRIZE'=>'', 'BLIND_TIME'=>'', 'STACK_CHIPS'=>'', 'PLAYERS'=>'', 'ALLOWED_REBUYS'=>'', 'ALLOWED_ADDONS'=>'', 'IS_ILIMITED_REBUYS'=>'', 'SAVED_RESULT'=>'', 'SUPPRESS_SCHEDULE'=>'', 'SCHEDULE_START_DATE'=>'', 'ENROLLMENT_START_DATE'=>'', 'ENROLLMENT_MODE'=>'', 'SUPPRESS_RANKING'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'RankingLiveId'=>1, 'ClubId'=>2, 'EventName'=>3, 'EventDate'=>4, 'StartTime'=>5, 'EventDateTime'=>6, 'StepNumber'=>7, 'StepDay'=>8, 'Comments'=>9, 'Description'=>10, 'IsFreeroll'=>11, 'IsMultiday'=>12, 'IsSatellite'=>13, 'Buyin'=>14, 'EntranceFee'=>15, 'GuaranteedPrize'=>16, 'BlindTime'=>17, 'StackChips'=>18, 'Players'=>19, 'AllowedRebuys'=>20, 'AllowedAddons'=>21, 'IsIlimitedRebuys'=>22, 'SavedResult'=>23, 'SuppressSchedule'=>24, 'ScheduleStartDate'=>25, 'EnrollmentStartDate'=>26, 'EnrollmentMode'=>27, 'SuppressRanking'=>28, 'CreatedAt'=>29, 'UpdatedAt'=>30, ),
		BasePeer::TYPE_COLNAME=>array (EventLiveViewPeer::ID=>0, EventLiveViewPeer::RANKING_LIVE_ID=>1, EventLiveViewPeer::CLUB_ID=>2, EventLiveViewPeer::EVENT_NAME=>3, EventLiveViewPeer::EVENT_DATE=>4, EventLiveViewPeer::START_TIME=>5, EventLiveViewPeer::EVENT_DATE_TIME=>6, EventLiveViewPeer::STEP_NUMBER=>7, EventLiveViewPeer::STEP_DAY=>8, EventLiveViewPeer::COMMENTS=>9, EventLiveViewPeer::DESCRIPTION=>10, EventLiveViewPeer::IS_FREEROLL=>11, EventLiveViewPeer::IS_MULTIDAY=>12, EventLiveViewPeer::IS_SATELLITE=>13, EventLiveViewPeer::BUYIN=>14, EventLiveViewPeer::ENTRANCE_FEE=>15, EventLiveViewPeer::GUARANTEED_PRIZE=>16, EventLiveViewPeer::BLIND_TIME=>17, EventLiveViewPeer::STACK_CHIPS=>18, EventLiveViewPeer::PLAYERS=>19, EventLiveViewPeer::ALLOWED_REBUYS=>20, EventLiveViewPeer::ALLOWED_ADDONS=>21, EventLiveViewPeer::IS_ILIMITED_REBUYS=>22, EventLiveViewPeer::SAVED_RESULT=>23, EventLiveViewPeer::SUPPRESS_SCHEDULE=>24, EventLiveViewPeer::SCHEDULE_START_DATE=>25, EventLiveViewPeer::ENROLLMENT_START_DATE=>26, EventLiveViewPeer::ENROLLMENT_MODE=>27, EventLiveViewPeer::SUPPRESS_RANKING=>28, EventLiveViewPeer::CREATED_AT=>29, EventLiveViewPeer::UPDATED_AT=>30, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'ranking_live_id'=>1, 'club_id'=>2, 'event_name'=>3, 'event_date'=>4, 'start_time'=>5, 'event_date_time'=>6, 'step_number'=>7, 'step_day'=>8, 'comments'=>9, 'description'=>10, 'is_freeroll'=>11, 'is_multiday'=>12, 'is_satellite'=>13, 'buyin'=>14, 'entrance_fee'=>15, 'guaranteed_prize'=>16, 'blind_time'=>17, 'stack_chips'=>18, 'players'=>19, 'allowed_rebuys'=>20, 'allowed_addons'=>21, 'is_ilimited_rebuys'=>22, 'saved_result'=>23, 'suppress_schedule'=>24, 'schedule_start_date'=>25, 'enrollment_start_date'=>26, 'enrollment_mode'=>27, 'suppress_ranking'=>28, 'created_at'=>29, 'updated_at'=>30, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/EventLiveViewMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.EventLiveViewMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EventLiveViewPeer::getTableMap();
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
		return str_replace(EventLiveViewPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EventLiveViewPeer::ID);

		$criteria->addSelectColumn(EventLiveViewPeer::RANKING_LIVE_ID);

		$criteria->addSelectColumn(EventLiveViewPeer::CLUB_ID);

		$criteria->addSelectColumn(EventLiveViewPeer::EVENT_NAME);

		$criteria->addSelectColumn(EventLiveViewPeer::EVENT_DATE);

		$criteria->addSelectColumn(EventLiveViewPeer::START_TIME);

		$criteria->addSelectColumn(EventLiveViewPeer::EVENT_DATE_TIME);

		$criteria->addSelectColumn(EventLiveViewPeer::STEP_NUMBER);

		$criteria->addSelectColumn(EventLiveViewPeer::STEP_DAY);

		$criteria->addSelectColumn(EventLiveViewPeer::COMMENTS);

		$criteria->addSelectColumn(EventLiveViewPeer::DESCRIPTION);

		$criteria->addSelectColumn(EventLiveViewPeer::IS_FREEROLL);

		$criteria->addSelectColumn(EventLiveViewPeer::IS_MULTIDAY);

		$criteria->addSelectColumn(EventLiveViewPeer::IS_SATELLITE);

		$criteria->addSelectColumn(EventLiveViewPeer::BUYIN);

		$criteria->addSelectColumn(EventLiveViewPeer::ENTRANCE_FEE);

		$criteria->addSelectColumn(EventLiveViewPeer::GUARANTEED_PRIZE);

		$criteria->addSelectColumn(EventLiveViewPeer::BLIND_TIME);

		$criteria->addSelectColumn(EventLiveViewPeer::STACK_CHIPS);

		$criteria->addSelectColumn(EventLiveViewPeer::PLAYERS);

		$criteria->addSelectColumn(EventLiveViewPeer::ALLOWED_REBUYS);

		$criteria->addSelectColumn(EventLiveViewPeer::ALLOWED_ADDONS);

		$criteria->addSelectColumn(EventLiveViewPeer::IS_ILIMITED_REBUYS);

		$criteria->addSelectColumn(EventLiveViewPeer::SAVED_RESULT);

		$criteria->addSelectColumn(EventLiveViewPeer::SUPPRESS_SCHEDULE);

		$criteria->addSelectColumn(EventLiveViewPeer::SCHEDULE_START_DATE);

		$criteria->addSelectColumn(EventLiveViewPeer::ENROLLMENT_START_DATE);

		$criteria->addSelectColumn(EventLiveViewPeer::ENROLLMENT_MODE);

		$criteria->addSelectColumn(EventLiveViewPeer::SUPPRESS_RANKING);

		$criteria->addSelectColumn(EventLiveViewPeer::CREATED_AT);

		$criteria->addSelectColumn(EventLiveViewPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(event_live_view.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT event_live_view.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventLiveViewPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLiveViewPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EventLiveViewPeer::doSelectRS($criteria, $con);
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
		$objects = EventLiveViewPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EventLiveViewPeer::populateObjects(EventLiveViewPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EventLiveViewPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EventLiveViewPeer::getOMClass();
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
			$criteria->addSelectColumn(EventLiveViewPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLiveViewPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLiveViewPeer::RANKING_LIVE_ID, RankingLivePeer::ID);

		$rs = EventLiveViewPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(EventLiveViewPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLiveViewPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLiveViewPeer::CLUB_ID, ClubPeer::ID);

		$rs = EventLiveViewPeer::doSelectRS($criteria, $con);
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

		EventLiveViewPeer::addSelectColumns($c);
		$startcol = (EventLiveViewPeer::NUM_COLUMNS - EventLiveViewPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		RankingLivePeer::addSelectColumns($c);

		$c->addJoin(EventLiveViewPeer::RANKING_LIVE_ID, RankingLivePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLiveViewPeer::getOMClass();

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
										$temp_obj2->addEventLiveView($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventLiveViewList();
				$obj2->addEventLiveView($obj1); 			}
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

		EventLiveViewPeer::addSelectColumns($c);
		$startcol = (EventLiveViewPeer::NUM_COLUMNS - EventLiveViewPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ClubPeer::addSelectColumns($c);

		$c->addJoin(EventLiveViewPeer::CLUB_ID, ClubPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLiveViewPeer::getOMClass();

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
										$temp_obj2->addEventLiveView($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventLiveViewList();
				$obj2->addEventLiveView($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventLiveViewPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLiveViewPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLiveViewPeer::RANKING_LIVE_ID, RankingLivePeer::ID);

		$criteria->addJoin(EventLiveViewPeer::CLUB_ID, ClubPeer::ID);

		$rs = EventLiveViewPeer::doSelectRS($criteria, $con);
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

		EventLiveViewPeer::addSelectColumns($c);
		$startcol2 = (EventLiveViewPeer::NUM_COLUMNS - EventLiveViewPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RankingLivePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RankingLivePeer::NUM_COLUMNS;

		ClubPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ClubPeer::NUM_COLUMNS;

		$c->addJoin(EventLiveViewPeer::RANKING_LIVE_ID, RankingLivePeer::ID);

		$c->addJoin(EventLiveViewPeer::CLUB_ID, ClubPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLiveViewPeer::getOMClass();


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
					$temp_obj2->addEventLiveView($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEventLiveViewList();
				$obj2->addEventLiveView($obj1);
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
					$temp_obj3->addEventLiveView($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initEventLiveViewList();
				$obj3->addEventLiveView($obj1);
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
			$criteria->addSelectColumn(EventLiveViewPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLiveViewPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLiveViewPeer::CLUB_ID, ClubPeer::ID);

		$rs = EventLiveViewPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(EventLiveViewPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLiveViewPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLiveViewPeer::RANKING_LIVE_ID, RankingLivePeer::ID);

		$rs = EventLiveViewPeer::doSelectRS($criteria, $con);
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

		EventLiveViewPeer::addSelectColumns($c);
		$startcol2 = (EventLiveViewPeer::NUM_COLUMNS - EventLiveViewPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ClubPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ClubPeer::NUM_COLUMNS;

		$c->addJoin(EventLiveViewPeer::CLUB_ID, ClubPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLiveViewPeer::getOMClass();

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
					$temp_obj2->addEventLiveView($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEventLiveViewList();
				$obj2->addEventLiveView($obj1);
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

		EventLiveViewPeer::addSelectColumns($c);
		$startcol2 = (EventLiveViewPeer::NUM_COLUMNS - EventLiveViewPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RankingLivePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RankingLivePeer::NUM_COLUMNS;

		$c->addJoin(EventLiveViewPeer::RANKING_LIVE_ID, RankingLivePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLiveViewPeer::getOMClass();

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
					$temp_obj2->addEventLiveView($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEventLiveViewList();
				$obj2->addEventLiveView($obj1);
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
		return EventLiveViewPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(EventLiveViewPeer::ID);
			$selectCriteria->add(EventLiveViewPeer::ID, $criteria->remove(EventLiveViewPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(EventLiveViewPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EventLiveViewPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof EventLiveView) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(EventLiveViewPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(EventLiveView $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EventLiveViewPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EventLiveViewPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EventLiveViewPeer::DATABASE_NAME, EventLiveViewPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EventLiveViewPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(EventLiveViewPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(EventLiveViewPeer::ID, $pk);


		$v = EventLiveViewPeer::doSelect($criteria, $con);

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
			$criteria->add(EventLiveViewPeer::ID, $pks, Criteria::IN);
			$objs = EventLiveViewPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseEventLiveViewPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/EventLiveViewMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.EventLiveViewMapBuilder');
}
