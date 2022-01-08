<?php


abstract class BaseRankingPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'ranking';

	
	const CLASS_DEFAULT = 'lib.model.Ranking';

	
	const NUM_COLUMNS = 22;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'ranking.ID';

	
	const RANKING_NAME = 'ranking.RANKING_NAME';

	
	const RANKING_TAG = 'ranking.RANKING_TAG';

	
	const USER_SITE_ID = 'ranking.USER_SITE_ID';

	
	const RANKING_TYPE_ID = 'ranking.RANKING_TYPE_ID';

	
	const GAME_STYLE_ID = 'ranking.GAME_STYLE_ID';

	
	const START_DATE = 'ranking.START_DATE';

	
	const START_TIME = 'ranking.START_TIME';

	
	const FINISH_DATE = 'ranking.FINISH_DATE';

	
	const IS_PRIVATE = 'ranking.IS_PRIVATE';

	
	const BUYIN = 'ranking.BUYIN';

	
	const ENTRANCE_FEE = 'ranking.ENTRANCE_FEE';

	
	const PLAYERS = 'ranking.PLAYERS';

	
	const EVENTS = 'ranking.EVENTS';

	
	const SCORE_SCHEMA = 'ranking.SCORE_SCHEMA';

	
	const SCORE_FORMULA = 'ranking.SCORE_FORMULA';

	
	const ENABLED = 'ranking.ENABLED';

	
	const VISIBLE = 'ranking.VISIBLE';

	
	const DELETED = 'ranking.DELETED';

	
	const LOCKED = 'ranking.LOCKED';

	
	const CREATED_AT = 'ranking.CREATED_AT';

	
	const UPDATED_AT = 'ranking.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'RankingName', 'RankingTag', 'UserSiteId', 'RankingTypeId', 'GameStyleId', 'StartDate', 'StartTime', 'FinishDate', 'IsPrivate', 'Buyin', 'EntranceFee', 'Players', 'Events', 'ScoreSchema', 'ScoreFormula', 'Enabled', 'Visible', 'Deleted', 'Locked', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (RankingPeer::ID, RankingPeer::RANKING_NAME, RankingPeer::RANKING_TAG, RankingPeer::USER_SITE_ID, RankingPeer::RANKING_TYPE_ID, RankingPeer::GAME_STYLE_ID, RankingPeer::START_DATE, RankingPeer::START_TIME, RankingPeer::FINISH_DATE, RankingPeer::IS_PRIVATE, RankingPeer::BUYIN, RankingPeer::ENTRANCE_FEE, RankingPeer::PLAYERS, RankingPeer::EVENTS, RankingPeer::SCORE_SCHEMA, RankingPeer::SCORE_FORMULA, RankingPeer::ENABLED, RankingPeer::VISIBLE, RankingPeer::DELETED, RankingPeer::LOCKED, RankingPeer::CREATED_AT, RankingPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'ranking_name', 'ranking_tag', 'user_site_id', 'ranking_type_id', 'game_style_id', 'start_date', 'start_time', 'finish_date', 'is_private', 'buyin', 'entrance_fee', 'players', 'events', 'score_schema', 'score_formula', 'enabled', 'visible', 'deleted', 'locked', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'RANKING_NAME'=>'', 'RANKING_TAG'=>'', 'USER_SITE_ID'=>'', 'RANKING_TYPE_ID'=>'', 'GAME_STYLE_ID'=>'', 'START_DATE'=>'', 'START_TIME'=>'', 'FINISH_DATE'=>'', 'IS_PRIVATE'=>'', 'BUYIN'=>'', 'ENTRANCE_FEE'=>'', 'PLAYERS'=>'', 'EVENTS'=>'', 'SCORE_SCHEMA'=>'', 'SCORE_FORMULA'=>'', 'ENABLED'=>'', 'VISIBLE'=>'', 'DELETED'=>'', 'LOCKED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'RankingName'=>1, 'RankingTag'=>2, 'UserSiteId'=>3, 'RankingTypeId'=>4, 'GameStyleId'=>5, 'StartDate'=>6, 'StartTime'=>7, 'FinishDate'=>8, 'IsPrivate'=>9, 'Buyin'=>10, 'EntranceFee'=>11, 'Players'=>12, 'Events'=>13, 'ScoreSchema'=>14, 'ScoreFormula'=>15, 'Enabled'=>16, 'Visible'=>17, 'Deleted'=>18, 'Locked'=>19, 'CreatedAt'=>20, 'UpdatedAt'=>21, ),
		BasePeer::TYPE_COLNAME=>array (RankingPeer::ID=>0, RankingPeer::RANKING_NAME=>1, RankingPeer::RANKING_TAG=>2, RankingPeer::USER_SITE_ID=>3, RankingPeer::RANKING_TYPE_ID=>4, RankingPeer::GAME_STYLE_ID=>5, RankingPeer::START_DATE=>6, RankingPeer::START_TIME=>7, RankingPeer::FINISH_DATE=>8, RankingPeer::IS_PRIVATE=>9, RankingPeer::BUYIN=>10, RankingPeer::ENTRANCE_FEE=>11, RankingPeer::PLAYERS=>12, RankingPeer::EVENTS=>13, RankingPeer::SCORE_SCHEMA=>14, RankingPeer::SCORE_FORMULA=>15, RankingPeer::ENABLED=>16, RankingPeer::VISIBLE=>17, RankingPeer::DELETED=>18, RankingPeer::LOCKED=>19, RankingPeer::CREATED_AT=>20, RankingPeer::UPDATED_AT=>21, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'ranking_name'=>1, 'ranking_tag'=>2, 'user_site_id'=>3, 'ranking_type_id'=>4, 'game_style_id'=>5, 'start_date'=>6, 'start_time'=>7, 'finish_date'=>8, 'is_private'=>9, 'buyin'=>10, 'entrance_fee'=>11, 'players'=>12, 'events'=>13, 'score_schema'=>14, 'score_formula'=>15, 'enabled'=>16, 'visible'=>17, 'deleted'=>18, 'locked'=>19, 'created_at'=>20, 'updated_at'=>21, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/RankingMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.RankingMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = RankingPeer::getTableMap();
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
		return str_replace(RankingPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(RankingPeer::ID);

		$criteria->addSelectColumn(RankingPeer::RANKING_NAME);

		$criteria->addSelectColumn(RankingPeer::RANKING_TAG);

		$criteria->addSelectColumn(RankingPeer::USER_SITE_ID);

		$criteria->addSelectColumn(RankingPeer::RANKING_TYPE_ID);

		$criteria->addSelectColumn(RankingPeer::GAME_STYLE_ID);

		$criteria->addSelectColumn(RankingPeer::START_DATE);

		$criteria->addSelectColumn(RankingPeer::START_TIME);

		$criteria->addSelectColumn(RankingPeer::FINISH_DATE);

		$criteria->addSelectColumn(RankingPeer::IS_PRIVATE);

		$criteria->addSelectColumn(RankingPeer::BUYIN);

		$criteria->addSelectColumn(RankingPeer::ENTRANCE_FEE);

		$criteria->addSelectColumn(RankingPeer::PLAYERS);

		$criteria->addSelectColumn(RankingPeer::EVENTS);

		$criteria->addSelectColumn(RankingPeer::SCORE_SCHEMA);

		$criteria->addSelectColumn(RankingPeer::SCORE_FORMULA);

		$criteria->addSelectColumn(RankingPeer::ENABLED);

		$criteria->addSelectColumn(RankingPeer::VISIBLE);

		$criteria->addSelectColumn(RankingPeer::DELETED);

		$criteria->addSelectColumn(RankingPeer::LOCKED);

		$criteria->addSelectColumn(RankingPeer::CREATED_AT);

		$criteria->addSelectColumn(RankingPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(ranking.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT ranking.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = RankingPeer::doSelectRS($criteria, $con);
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
		$objects = RankingPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return RankingPeer::populateObjects(RankingPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			RankingPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = RankingPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinUserSite(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingPeer::USER_SITE_ID, UserSitePeer::ID);

		$rs = RankingPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinVirtualTableRelatedByRankingTypeId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingPeer::RANKING_TYPE_ID, VirtualTablePeer::ID);

		$rs = RankingPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinVirtualTableRelatedByGameStyleId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingPeer::GAME_STYLE_ID, VirtualTablePeer::ID);

		$rs = RankingPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinUserSite(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RankingPeer::addSelectColumns($c);
		$startcol = (RankingPeer::NUM_COLUMNS - RankingPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserSitePeer::addSelectColumns($c);

		$c->addJoin(RankingPeer::USER_SITE_ID, UserSitePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserSitePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUserSite(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addRanking($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRankingList();
				$obj2->addRanking($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinVirtualTableRelatedByRankingTypeId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RankingPeer::addSelectColumns($c);
		$startcol = (RankingPeer::NUM_COLUMNS - RankingPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		VirtualTablePeer::addSelectColumns($c);

		$c->addJoin(RankingPeer::RANKING_TYPE_ID, VirtualTablePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = VirtualTablePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getVirtualTableRelatedByRankingTypeId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addRankingRelatedByRankingTypeId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRankingListRelatedByRankingTypeId();
				$obj2->addRankingRelatedByRankingTypeId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinVirtualTableRelatedByGameStyleId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RankingPeer::addSelectColumns($c);
		$startcol = (RankingPeer::NUM_COLUMNS - RankingPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		VirtualTablePeer::addSelectColumns($c);

		$c->addJoin(RankingPeer::GAME_STYLE_ID, VirtualTablePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = VirtualTablePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getVirtualTableRelatedByGameStyleId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addRankingRelatedByGameStyleId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRankingListRelatedByGameStyleId();
				$obj2->addRankingRelatedByGameStyleId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingPeer::USER_SITE_ID, UserSitePeer::ID);

		$criteria->addJoin(RankingPeer::RANKING_TYPE_ID, VirtualTablePeer::ID);

		$criteria->addJoin(RankingPeer::GAME_STYLE_ID, VirtualTablePeer::ID);

		$rs = RankingPeer::doSelectRS($criteria, $con);
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

		RankingPeer::addSelectColumns($c);
		$startcol2 = (RankingPeer::NUM_COLUMNS - RankingPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserSitePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserSitePeer::NUM_COLUMNS;

		VirtualTablePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + VirtualTablePeer::NUM_COLUMNS;

		VirtualTablePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + VirtualTablePeer::NUM_COLUMNS;

		$c->addJoin(RankingPeer::USER_SITE_ID, UserSitePeer::ID);

		$c->addJoin(RankingPeer::RANKING_TYPE_ID, VirtualTablePeer::ID);

		$c->addJoin(RankingPeer::GAME_STYLE_ID, VirtualTablePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = UserSitePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUserSite(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRanking($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initRankingList();
				$obj2->addRanking($obj1);
			}


					
			$omClass = VirtualTablePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getVirtualTableRelatedByRankingTypeId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addRankingRelatedByRankingTypeId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initRankingListRelatedByRankingTypeId();
				$obj3->addRankingRelatedByRankingTypeId($obj1);
			}


					
			$omClass = VirtualTablePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getVirtualTableRelatedByGameStyleId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addRankingRelatedByGameStyleId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initRankingListRelatedByGameStyleId();
				$obj4->addRankingRelatedByGameStyleId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptUserSite(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingPeer::RANKING_TYPE_ID, VirtualTablePeer::ID);

		$criteria->addJoin(RankingPeer::GAME_STYLE_ID, VirtualTablePeer::ID);

		$rs = RankingPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptVirtualTableRelatedByRankingTypeId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingPeer::USER_SITE_ID, UserSitePeer::ID);

		$rs = RankingPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptVirtualTableRelatedByGameStyleId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingPeer::USER_SITE_ID, UserSitePeer::ID);

		$rs = RankingPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptUserSite(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RankingPeer::addSelectColumns($c);
		$startcol2 = (RankingPeer::NUM_COLUMNS - RankingPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		VirtualTablePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + VirtualTablePeer::NUM_COLUMNS;

		VirtualTablePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + VirtualTablePeer::NUM_COLUMNS;

		$c->addJoin(RankingPeer::RANKING_TYPE_ID, VirtualTablePeer::ID);

		$c->addJoin(RankingPeer::GAME_STYLE_ID, VirtualTablePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getVirtualTableRelatedByRankingTypeId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRankingRelatedByRankingTypeId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRankingListRelatedByRankingTypeId();
				$obj2->addRankingRelatedByRankingTypeId($obj1);
			}

			$omClass = VirtualTablePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getVirtualTableRelatedByGameStyleId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addRankingRelatedByGameStyleId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initRankingListRelatedByGameStyleId();
				$obj3->addRankingRelatedByGameStyleId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptVirtualTableRelatedByRankingTypeId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RankingPeer::addSelectColumns($c);
		$startcol2 = (RankingPeer::NUM_COLUMNS - RankingPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserSitePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserSitePeer::NUM_COLUMNS;

		$c->addJoin(RankingPeer::USER_SITE_ID, UserSitePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserSitePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUserSite(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRanking($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRankingList();
				$obj2->addRanking($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptVirtualTableRelatedByGameStyleId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RankingPeer::addSelectColumns($c);
		$startcol2 = (RankingPeer::NUM_COLUMNS - RankingPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserSitePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserSitePeer::NUM_COLUMNS;

		$c->addJoin(RankingPeer::USER_SITE_ID, UserSitePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserSitePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUserSite(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRanking($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRankingList();
				$obj2->addRanking($obj1);
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
		return RankingPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(RankingPeer::ID); 

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
			$comparison = $criteria->getComparison(RankingPeer::ID);
			$selectCriteria->add(RankingPeer::ID, $criteria->remove(RankingPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(RankingPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(RankingPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Ranking) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(RankingPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Ranking $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RankingPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RankingPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(RankingPeer::DATABASE_NAME, RankingPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RankingPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(RankingPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(RankingPeer::ID, $pk);


		$v = RankingPeer::doSelect($criteria, $con);

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
			$criteria->add(RankingPeer::ID, $pks, Criteria::IN);
			$objs = RankingPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseRankingPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/RankingMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.RankingMapBuilder');
}
