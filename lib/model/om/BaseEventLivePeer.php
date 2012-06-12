<?php


abstract class BaseEventLivePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'event_live';

	
	const CLASS_DEFAULT = 'lib.model.EventLive';

	
	const NUM_COLUMNS = 42;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'event_live.ID';

	
	const RANKING_LIVE_ID = 'event_live.RANKING_LIVE_ID';

	
	const CLUB_ID = 'event_live.CLUB_ID';

	
	const EMAIL_TEMPLATE_ID = 'event_live.EMAIL_TEMPLATE_ID';

	
	const EVENT_NAME = 'event_live.EVENT_NAME';

	
	const EVENT_SHORT_NAME = 'event_live.EVENT_SHORT_NAME';

	
	const EVENT_DATE = 'event_live.EVENT_DATE';

	
	const START_TIME = 'event_live.START_TIME';

	
	const EVENT_DATE_TIME = 'event_live.EVENT_DATE_TIME';

	
	const STEP_NUMBER = 'event_live.STEP_NUMBER';

	
	const COMMENTS = 'event_live.COMMENTS';

	
	const DESCRIPTION = 'event_live.DESCRIPTION';

	
	const IS_FREEROLL = 'event_live.IS_FREEROLL';

	
	const IS_MULTIDAY = 'event_live.IS_MULTIDAY';

	
	const IS_SATELLITE = 'event_live.IS_SATELLITE';

	
	const TABLES_NUMBER = 'event_live.TABLES_NUMBER';

	
	const BUYIN = 'event_live.BUYIN';

	
	const ENTRANCE_FEE = 'event_live.ENTRANCE_FEE';

	
	const RAKE_PERCENT = 'event_live.RAKE_PERCENT';

	
	const GUARANTEED_PRIZE = 'event_live.GUARANTEED_PRIZE';

	
	const BLIND_TIME = 'event_live.BLIND_TIME';

	
	const STACK_CHIPS = 'event_live.STACK_CHIPS';

	
	const PLAYERS = 'event_live.PLAYERS';

	
	const ALLOWED_REBUYS = 'event_live.ALLOWED_REBUYS';

	
	const ALLOWED_ADDONS = 'event_live.ALLOWED_ADDONS';

	
	const IS_ILIMITED_REBUYS = 'event_live.IS_ILIMITED_REBUYS';

	
	const SAVED_RESULT = 'event_live.SAVED_RESULT';

	
	const TOTAL_REBUYS = 'event_live.TOTAL_REBUYS';

	
	const PUBLISH_PRIZE = 'event_live.PUBLISH_PRIZE';

	
	const SUPPRESS_SCHEDULE = 'event_live.SUPPRESS_SCHEDULE';

	
	const PRIZE_SPLIT = 'event_live.PRIZE_SPLIT';

	
	const VISIT_COUNT = 'event_live.VISIT_COUNT';

	
	const SCHEDULE_START_DATE = 'event_live.SCHEDULE_START_DATE';

	
	const ENROLLMENT_START_DATE = 'event_live.ENROLLMENT_START_DATE';

	
	const ENROLLMENT_MODE = 'event_live.ENROLLMENT_MODE';

	
	const SUPPRESS_RANKING = 'event_live.SUPPRESS_RANKING';

	
	const ENABLED = 'event_live.ENABLED';

	
	const VISIBLE = 'event_live.VISIBLE';

	
	const DELETED = 'event_live.DELETED';

	
	const LOCKED = 'event_live.LOCKED';

	
	const CREATED_AT = 'event_live.CREATED_AT';

	
	const UPDATED_AT = 'event_live.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'RankingLiveId', 'ClubId', 'EmailTemplateId', 'EventName', 'EventShortName', 'EventDate', 'StartTime', 'EventDateTime', 'StepNumber', 'Comments', 'Description', 'IsFreeroll', 'IsMultiday', 'IsSatellite', 'TablesNumber', 'Buyin', 'EntranceFee', 'RakePercent', 'GuaranteedPrize', 'BlindTime', 'StackChips', 'Players', 'AllowedRebuys', 'AllowedAddons', 'IsIlimitedRebuys', 'SavedResult', 'TotalRebuys', 'PublishPrize', 'SuppressSchedule', 'PrizeSplit', 'VisitCount', 'ScheduleStartDate', 'EnrollmentStartDate', 'EnrollmentMode', 'SuppressRanking', 'Enabled', 'Visible', 'Deleted', 'Locked', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (EventLivePeer::ID, EventLivePeer::RANKING_LIVE_ID, EventLivePeer::CLUB_ID, EventLivePeer::EMAIL_TEMPLATE_ID, EventLivePeer::EVENT_NAME, EventLivePeer::EVENT_SHORT_NAME, EventLivePeer::EVENT_DATE, EventLivePeer::START_TIME, EventLivePeer::EVENT_DATE_TIME, EventLivePeer::STEP_NUMBER, EventLivePeer::COMMENTS, EventLivePeer::DESCRIPTION, EventLivePeer::IS_FREEROLL, EventLivePeer::IS_MULTIDAY, EventLivePeer::IS_SATELLITE, EventLivePeer::TABLES_NUMBER, EventLivePeer::BUYIN, EventLivePeer::ENTRANCE_FEE, EventLivePeer::RAKE_PERCENT, EventLivePeer::GUARANTEED_PRIZE, EventLivePeer::BLIND_TIME, EventLivePeer::STACK_CHIPS, EventLivePeer::PLAYERS, EventLivePeer::ALLOWED_REBUYS, EventLivePeer::ALLOWED_ADDONS, EventLivePeer::IS_ILIMITED_REBUYS, EventLivePeer::SAVED_RESULT, EventLivePeer::TOTAL_REBUYS, EventLivePeer::PUBLISH_PRIZE, EventLivePeer::SUPPRESS_SCHEDULE, EventLivePeer::PRIZE_SPLIT, EventLivePeer::VISIT_COUNT, EventLivePeer::SCHEDULE_START_DATE, EventLivePeer::ENROLLMENT_START_DATE, EventLivePeer::ENROLLMENT_MODE, EventLivePeer::SUPPRESS_RANKING, EventLivePeer::ENABLED, EventLivePeer::VISIBLE, EventLivePeer::DELETED, EventLivePeer::LOCKED, EventLivePeer::CREATED_AT, EventLivePeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'ranking_live_id', 'club_id', 'email_template_id', 'event_name', 'event_short_name', 'event_date', 'start_time', 'event_date_time', 'step_number', 'comments', 'description', 'is_freeroll', 'is_multiday', 'is_satellite', 'tables_number', 'buyin', 'entrance_fee', 'rake_percent', 'guaranteed_prize', 'blind_time', 'stack_chips', 'players', 'allowed_rebuys', 'allowed_addons', 'is_ilimited_rebuys', 'saved_result', 'total_rebuys', 'publish_prize', 'suppress_schedule', 'prize_split', 'visit_count', 'schedule_start_date', 'enrollment_start_date', 'enrollment_mode', 'suppress_ranking', 'enabled', 'visible', 'deleted', 'locked', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'RANKING_LIVE_ID'=>'', 'CLUB_ID'=>'', 'EMAIL_TEMPLATE_ID'=>'', 'EVENT_NAME'=>'', 'EVENT_SHORT_NAME'=>'', 'EVENT_DATE'=>'', 'START_TIME'=>'', 'EVENT_DATE_TIME'=>'', 'STEP_NUMBER'=>'', 'COMMENTS'=>'', 'DESCRIPTION'=>'', 'IS_FREEROLL'=>'', 'IS_MULTIDAY'=>'', 'IS_SATELLITE'=>'', 'TABLES_NUMBER'=>'', 'BUYIN'=>'', 'ENTRANCE_FEE'=>'', 'RAKE_PERCENT'=>'', 'GUARANTEED_PRIZE'=>'', 'BLIND_TIME'=>'', 'STACK_CHIPS'=>'', 'PLAYERS'=>'', 'ALLOWED_REBUYS'=>'', 'ALLOWED_ADDONS'=>'', 'IS_ILIMITED_REBUYS'=>'', 'SAVED_RESULT'=>'', 'TOTAL_REBUYS'=>'', 'PUBLISH_PRIZE'=>'', 'SUPPRESS_SCHEDULE'=>'', 'PRIZE_SPLIT'=>'', 'VISIT_COUNT'=>'', 'SCHEDULE_START_DATE'=>'', 'ENROLLMENT_START_DATE'=>'', 'ENROLLMENT_MODE'=>'', 'SUPPRESS_RANKING'=>'', 'ENABLED'=>'', 'VISIBLE'=>'', 'DELETED'=>'', 'LOCKED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'RankingLiveId'=>1, 'ClubId'=>2, 'EmailTemplateId'=>3, 'EventName'=>4, 'EventShortName'=>5, 'EventDate'=>6, 'StartTime'=>7, 'EventDateTime'=>8, 'StepNumber'=>9, 'Comments'=>10, 'Description'=>11, 'IsFreeroll'=>12, 'IsMultiday'=>13, 'IsSatellite'=>14, 'TablesNumber'=>15, 'Buyin'=>16, 'EntranceFee'=>17, 'RakePercent'=>18, 'GuaranteedPrize'=>19, 'BlindTime'=>20, 'StackChips'=>21, 'Players'=>22, 'AllowedRebuys'=>23, 'AllowedAddons'=>24, 'IsIlimitedRebuys'=>25, 'SavedResult'=>26, 'TotalRebuys'=>27, 'PublishPrize'=>28, 'SuppressSchedule'=>29, 'PrizeSplit'=>30, 'VisitCount'=>31, 'ScheduleStartDate'=>32, 'EnrollmentStartDate'=>33, 'EnrollmentMode'=>34, 'SuppressRanking'=>35, 'Enabled'=>36, 'Visible'=>37, 'Deleted'=>38, 'Locked'=>39, 'CreatedAt'=>40, 'UpdatedAt'=>41, ),
		BasePeer::TYPE_COLNAME=>array (EventLivePeer::ID=>0, EventLivePeer::RANKING_LIVE_ID=>1, EventLivePeer::CLUB_ID=>2, EventLivePeer::EMAIL_TEMPLATE_ID=>3, EventLivePeer::EVENT_NAME=>4, EventLivePeer::EVENT_SHORT_NAME=>5, EventLivePeer::EVENT_DATE=>6, EventLivePeer::START_TIME=>7, EventLivePeer::EVENT_DATE_TIME=>8, EventLivePeer::STEP_NUMBER=>9, EventLivePeer::COMMENTS=>10, EventLivePeer::DESCRIPTION=>11, EventLivePeer::IS_FREEROLL=>12, EventLivePeer::IS_MULTIDAY=>13, EventLivePeer::IS_SATELLITE=>14, EventLivePeer::TABLES_NUMBER=>15, EventLivePeer::BUYIN=>16, EventLivePeer::ENTRANCE_FEE=>17, EventLivePeer::RAKE_PERCENT=>18, EventLivePeer::GUARANTEED_PRIZE=>19, EventLivePeer::BLIND_TIME=>20, EventLivePeer::STACK_CHIPS=>21, EventLivePeer::PLAYERS=>22, EventLivePeer::ALLOWED_REBUYS=>23, EventLivePeer::ALLOWED_ADDONS=>24, EventLivePeer::IS_ILIMITED_REBUYS=>25, EventLivePeer::SAVED_RESULT=>26, EventLivePeer::TOTAL_REBUYS=>27, EventLivePeer::PUBLISH_PRIZE=>28, EventLivePeer::SUPPRESS_SCHEDULE=>29, EventLivePeer::PRIZE_SPLIT=>30, EventLivePeer::VISIT_COUNT=>31, EventLivePeer::SCHEDULE_START_DATE=>32, EventLivePeer::ENROLLMENT_START_DATE=>33, EventLivePeer::ENROLLMENT_MODE=>34, EventLivePeer::SUPPRESS_RANKING=>35, EventLivePeer::ENABLED=>36, EventLivePeer::VISIBLE=>37, EventLivePeer::DELETED=>38, EventLivePeer::LOCKED=>39, EventLivePeer::CREATED_AT=>40, EventLivePeer::UPDATED_AT=>41, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'ranking_live_id'=>1, 'club_id'=>2, 'email_template_id'=>3, 'event_name'=>4, 'event_short_name'=>5, 'event_date'=>6, 'start_time'=>7, 'event_date_time'=>8, 'step_number'=>9, 'comments'=>10, 'description'=>11, 'is_freeroll'=>12, 'is_multiday'=>13, 'is_satellite'=>14, 'tables_number'=>15, 'buyin'=>16, 'entrance_fee'=>17, 'rake_percent'=>18, 'guaranteed_prize'=>19, 'blind_time'=>20, 'stack_chips'=>21, 'players'=>22, 'allowed_rebuys'=>23, 'allowed_addons'=>24, 'is_ilimited_rebuys'=>25, 'saved_result'=>26, 'total_rebuys'=>27, 'publish_prize'=>28, 'suppress_schedule'=>29, 'prize_split'=>30, 'visit_count'=>31, 'schedule_start_date'=>32, 'enrollment_start_date'=>33, 'enrollment_mode'=>34, 'suppress_ranking'=>35, 'enabled'=>36, 'visible'=>37, 'deleted'=>38, 'locked'=>39, 'created_at'=>40, 'updated_at'=>41, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, )
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

		$criteria->addSelectColumn(EventLivePeer::CLUB_ID);

		$criteria->addSelectColumn(EventLivePeer::EMAIL_TEMPLATE_ID);

		$criteria->addSelectColumn(EventLivePeer::EVENT_NAME);

		$criteria->addSelectColumn(EventLivePeer::EVENT_SHORT_NAME);

		$criteria->addSelectColumn(EventLivePeer::EVENT_DATE);

		$criteria->addSelectColumn(EventLivePeer::START_TIME);

		$criteria->addSelectColumn(EventLivePeer::EVENT_DATE_TIME);

		$criteria->addSelectColumn(EventLivePeer::STEP_NUMBER);

		$criteria->addSelectColumn(EventLivePeer::COMMENTS);

		$criteria->addSelectColumn(EventLivePeer::DESCRIPTION);

		$criteria->addSelectColumn(EventLivePeer::IS_FREEROLL);

		$criteria->addSelectColumn(EventLivePeer::IS_MULTIDAY);

		$criteria->addSelectColumn(EventLivePeer::IS_SATELLITE);

		$criteria->addSelectColumn(EventLivePeer::TABLES_NUMBER);

		$criteria->addSelectColumn(EventLivePeer::BUYIN);

		$criteria->addSelectColumn(EventLivePeer::ENTRANCE_FEE);

		$criteria->addSelectColumn(EventLivePeer::RAKE_PERCENT);

		$criteria->addSelectColumn(EventLivePeer::GUARANTEED_PRIZE);

		$criteria->addSelectColumn(EventLivePeer::BLIND_TIME);

		$criteria->addSelectColumn(EventLivePeer::STACK_CHIPS);

		$criteria->addSelectColumn(EventLivePeer::PLAYERS);

		$criteria->addSelectColumn(EventLivePeer::ALLOWED_REBUYS);

		$criteria->addSelectColumn(EventLivePeer::ALLOWED_ADDONS);

		$criteria->addSelectColumn(EventLivePeer::IS_ILIMITED_REBUYS);

		$criteria->addSelectColumn(EventLivePeer::SAVED_RESULT);

		$criteria->addSelectColumn(EventLivePeer::TOTAL_REBUYS);

		$criteria->addSelectColumn(EventLivePeer::PUBLISH_PRIZE);

		$criteria->addSelectColumn(EventLivePeer::SUPPRESS_SCHEDULE);

		$criteria->addSelectColumn(EventLivePeer::PRIZE_SPLIT);

		$criteria->addSelectColumn(EventLivePeer::VISIT_COUNT);

		$criteria->addSelectColumn(EventLivePeer::SCHEDULE_START_DATE);

		$criteria->addSelectColumn(EventLivePeer::ENROLLMENT_START_DATE);

		$criteria->addSelectColumn(EventLivePeer::ENROLLMENT_MODE);

		$criteria->addSelectColumn(EventLivePeer::SUPPRESS_RANKING);

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


	
	public static function doCountJoinEmailTemplate(Criteria $criteria, $distinct = false, $con = null)
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

		$criteria->addJoin(EventLivePeer::EMAIL_TEMPLATE_ID, EmailTemplatePeer::ID);

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


	
	public static function doSelectJoinEmailTemplate(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventLivePeer::addSelectColumns($c);
		$startcol = (EventLivePeer::NUM_COLUMNS - EventLivePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		EmailTemplatePeer::addSelectColumns($c);

		$c->addJoin(EventLivePeer::EMAIL_TEMPLATE_ID, EmailTemplatePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLivePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EmailTemplatePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getEmailTemplate(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
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

		$criteria->addJoin(EventLivePeer::EMAIL_TEMPLATE_ID, EmailTemplatePeer::ID);

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

		EmailTemplatePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + EmailTemplatePeer::NUM_COLUMNS;

		$c->addJoin(EventLivePeer::RANKING_LIVE_ID, RankingLivePeer::ID);

		$c->addJoin(EventLivePeer::CLUB_ID, ClubPeer::ID);

		$c->addJoin(EventLivePeer::EMAIL_TEMPLATE_ID, EmailTemplatePeer::ID);

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


					
			$omClass = EmailTemplatePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getEmailTemplate(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addEventLive($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initEventLiveList();
				$obj4->addEventLive($obj1);
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

		$criteria->addJoin(EventLivePeer::EMAIL_TEMPLATE_ID, EmailTemplatePeer::ID);

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

		$criteria->addJoin(EventLivePeer::EMAIL_TEMPLATE_ID, EmailTemplatePeer::ID);

		$rs = EventLivePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptEmailTemplate(Criteria $criteria, $distinct = false, $con = null)
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

		EmailTemplatePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + EmailTemplatePeer::NUM_COLUMNS;

		$c->addJoin(EventLivePeer::CLUB_ID, ClubPeer::ID);

		$c->addJoin(EventLivePeer::EMAIL_TEMPLATE_ID, EmailTemplatePeer::ID);


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

			$omClass = EmailTemplatePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getEmailTemplate(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEventLive($obj1);
					break;
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

		EmailTemplatePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + EmailTemplatePeer::NUM_COLUMNS;

		$c->addJoin(EventLivePeer::RANKING_LIVE_ID, RankingLivePeer::ID);

		$c->addJoin(EventLivePeer::EMAIL_TEMPLATE_ID, EmailTemplatePeer::ID);


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

			$omClass = EmailTemplatePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getEmailTemplate(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEventLive($obj1);
					break;
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


	
	public static function doSelectJoinAllExceptEmailTemplate(Criteria $c, $con = null)
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

			$omClass = ClubPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getClub(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEventLive($obj1);
					break;
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
