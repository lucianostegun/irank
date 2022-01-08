<?php


abstract class BaseRankingLiveHistoryPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'ranking_live_history';

	
	const CLASS_DEFAULT = 'lib.model.RankingLiveHistory';

	
	const NUM_COLUMNS = 20;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const RANKING_LIVE_ID = 'ranking_live_history.RANKING_LIVE_ID';

	
	const PEOPLE_ID = 'ranking_live_history.PEOPLE_ID';

	
	const RANKING_DATE = 'ranking_live_history.RANKING_DATE';

	
	const RANKING_POSITION = 'ranking_live_history.RANKING_POSITION';

	
	const EVENTS = 'ranking_live_history.EVENTS';

	
	const SCORE = 'ranking_live_history.SCORE';

	
	const AVERAGE = 'ranking_live_history.AVERAGE';

	
	const PAID_VALUE = 'ranking_live_history.PAID_VALUE';

	
	const PRIZE_VALUE = 'ranking_live_history.PRIZE_VALUE';

	
	const BALANCE_VALUE = 'ranking_live_history.BALANCE_VALUE';

	
	const TOTAL_RANKING_POSITION = 'ranking_live_history.TOTAL_RANKING_POSITION';

	
	const TOTAL_EVENTS = 'ranking_live_history.TOTAL_EVENTS';

	
	const TOTAL_SCORE = 'ranking_live_history.TOTAL_SCORE';

	
	const TOTAL_PAID = 'ranking_live_history.TOTAL_PAID';

	
	const TOTAL_PRIZE = 'ranking_live_history.TOTAL_PRIZE';

	
	const TOTAL_BALANCE = 'ranking_live_history.TOTAL_BALANCE';

	
	const TOTAL_AVERAGE = 'ranking_live_history.TOTAL_AVERAGE';

	
	const ENABLED = 'ranking_live_history.ENABLED';

	
	const CREATED_AT = 'ranking_live_history.CREATED_AT';

	
	const UPDATED_AT = 'ranking_live_history.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('RankingLiveId', 'PeopleId', 'RankingDate', 'RankingPosition', 'Events', 'Score', 'Average', 'PaidValue', 'PrizeValue', 'BalanceValue', 'TotalRankingPosition', 'TotalEvents', 'TotalScore', 'TotalPaid', 'TotalPrize', 'TotalBalance', 'TotalAverage', 'Enabled', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (RankingLiveHistoryPeer::RANKING_LIVE_ID, RankingLiveHistoryPeer::PEOPLE_ID, RankingLiveHistoryPeer::RANKING_DATE, RankingLiveHistoryPeer::RANKING_POSITION, RankingLiveHistoryPeer::EVENTS, RankingLiveHistoryPeer::SCORE, RankingLiveHistoryPeer::AVERAGE, RankingLiveHistoryPeer::PAID_VALUE, RankingLiveHistoryPeer::PRIZE_VALUE, RankingLiveHistoryPeer::BALANCE_VALUE, RankingLiveHistoryPeer::TOTAL_RANKING_POSITION, RankingLiveHistoryPeer::TOTAL_EVENTS, RankingLiveHistoryPeer::TOTAL_SCORE, RankingLiveHistoryPeer::TOTAL_PAID, RankingLiveHistoryPeer::TOTAL_PRIZE, RankingLiveHistoryPeer::TOTAL_BALANCE, RankingLiveHistoryPeer::TOTAL_AVERAGE, RankingLiveHistoryPeer::ENABLED, RankingLiveHistoryPeer::CREATED_AT, RankingLiveHistoryPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('ranking_live_id', 'people_id', 'ranking_date', 'ranking_position', 'events', 'score', 'average', 'paid_value', 'prize_value', 'balance_value', 'total_ranking_position', 'total_events', 'total_score', 'total_paid', 'total_prize', 'total_balance', 'total_average', 'enabled', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('RANKING_LIVE_ID'=>'', 'PEOPLE_ID'=>'', 'RANKING_DATE'=>'', 'RANKING_POSITION'=>'', 'EVENTS'=>'', 'SCORE'=>'', 'AVERAGE'=>'', 'PAID_VALUE'=>'', 'PRIZE_VALUE'=>'', 'BALANCE_VALUE'=>'', 'TOTAL_RANKING_POSITION'=>'', 'TOTAL_EVENTS'=>'', 'TOTAL_SCORE'=>'', 'TOTAL_PAID'=>'', 'TOTAL_PRIZE'=>'', 'TOTAL_BALANCE'=>'', 'TOTAL_AVERAGE'=>'', 'ENABLED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('RankingLiveId'=>0, 'PeopleId'=>1, 'RankingDate'=>2, 'RankingPosition'=>3, 'Events'=>4, 'Score'=>5, 'Average'=>6, 'PaidValue'=>7, 'PrizeValue'=>8, 'BalanceValue'=>9, 'TotalRankingPosition'=>10, 'TotalEvents'=>11, 'TotalScore'=>12, 'TotalPaid'=>13, 'TotalPrize'=>14, 'TotalBalance'=>15, 'TotalAverage'=>16, 'Enabled'=>17, 'CreatedAt'=>18, 'UpdatedAt'=>19, ),
		BasePeer::TYPE_COLNAME=>array (RankingLiveHistoryPeer::RANKING_LIVE_ID=>0, RankingLiveHistoryPeer::PEOPLE_ID=>1, RankingLiveHistoryPeer::RANKING_DATE=>2, RankingLiveHistoryPeer::RANKING_POSITION=>3, RankingLiveHistoryPeer::EVENTS=>4, RankingLiveHistoryPeer::SCORE=>5, RankingLiveHistoryPeer::AVERAGE=>6, RankingLiveHistoryPeer::PAID_VALUE=>7, RankingLiveHistoryPeer::PRIZE_VALUE=>8, RankingLiveHistoryPeer::BALANCE_VALUE=>9, RankingLiveHistoryPeer::TOTAL_RANKING_POSITION=>10, RankingLiveHistoryPeer::TOTAL_EVENTS=>11, RankingLiveHistoryPeer::TOTAL_SCORE=>12, RankingLiveHistoryPeer::TOTAL_PAID=>13, RankingLiveHistoryPeer::TOTAL_PRIZE=>14, RankingLiveHistoryPeer::TOTAL_BALANCE=>15, RankingLiveHistoryPeer::TOTAL_AVERAGE=>16, RankingLiveHistoryPeer::ENABLED=>17, RankingLiveHistoryPeer::CREATED_AT=>18, RankingLiveHistoryPeer::UPDATED_AT=>19, ),
		BasePeer::TYPE_FIELDNAME=>array ('ranking_live_id'=>0, 'people_id'=>1, 'ranking_date'=>2, 'ranking_position'=>3, 'events'=>4, 'score'=>5, 'average'=>6, 'paid_value'=>7, 'prize_value'=>8, 'balance_value'=>9, 'total_ranking_position'=>10, 'total_events'=>11, 'total_score'=>12, 'total_paid'=>13, 'total_prize'=>14, 'total_balance'=>15, 'total_average'=>16, 'enabled'=>17, 'created_at'=>18, 'updated_at'=>19, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/RankingLiveHistoryMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.RankingLiveHistoryMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = RankingLiveHistoryPeer::getTableMap();
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
		return str_replace(RankingLiveHistoryPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(RankingLiveHistoryPeer::RANKING_LIVE_ID);

		$criteria->addSelectColumn(RankingLiveHistoryPeer::PEOPLE_ID);

		$criteria->addSelectColumn(RankingLiveHistoryPeer::RANKING_DATE);

		$criteria->addSelectColumn(RankingLiveHistoryPeer::RANKING_POSITION);

		$criteria->addSelectColumn(RankingLiveHistoryPeer::EVENTS);

		$criteria->addSelectColumn(RankingLiveHistoryPeer::SCORE);

		$criteria->addSelectColumn(RankingLiveHistoryPeer::AVERAGE);

		$criteria->addSelectColumn(RankingLiveHistoryPeer::PAID_VALUE);

		$criteria->addSelectColumn(RankingLiveHistoryPeer::PRIZE_VALUE);

		$criteria->addSelectColumn(RankingLiveHistoryPeer::BALANCE_VALUE);

		$criteria->addSelectColumn(RankingLiveHistoryPeer::TOTAL_RANKING_POSITION);

		$criteria->addSelectColumn(RankingLiveHistoryPeer::TOTAL_EVENTS);

		$criteria->addSelectColumn(RankingLiveHistoryPeer::TOTAL_SCORE);

		$criteria->addSelectColumn(RankingLiveHistoryPeer::TOTAL_PAID);

		$criteria->addSelectColumn(RankingLiveHistoryPeer::TOTAL_PRIZE);

		$criteria->addSelectColumn(RankingLiveHistoryPeer::TOTAL_BALANCE);

		$criteria->addSelectColumn(RankingLiveHistoryPeer::TOTAL_AVERAGE);

		$criteria->addSelectColumn(RankingLiveHistoryPeer::ENABLED);

		$criteria->addSelectColumn(RankingLiveHistoryPeer::CREATED_AT);

		$criteria->addSelectColumn(RankingLiveHistoryPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(ranking_live_history.RANKING_LIVE_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT ranking_live_history.RANKING_LIVE_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingLiveHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingLiveHistoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = RankingLiveHistoryPeer::doSelectRS($criteria, $con);
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
		$objects = RankingLiveHistoryPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return RankingLiveHistoryPeer::populateObjects(RankingLiveHistoryPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			RankingLiveHistoryPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = RankingLiveHistoryPeer::getOMClass();
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
			$criteria->addSelectColumn(RankingLiveHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingLiveHistoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingLiveHistoryPeer::RANKING_LIVE_ID, RankingLivePeer::ID);

		$rs = RankingLiveHistoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(RankingLiveHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingLiveHistoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingLiveHistoryPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = RankingLiveHistoryPeer::doSelectRS($criteria, $con);
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

		RankingLiveHistoryPeer::addSelectColumns($c);
		$startcol = (RankingLiveHistoryPeer::NUM_COLUMNS - RankingLiveHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		RankingLivePeer::addSelectColumns($c);

		$c->addJoin(RankingLiveHistoryPeer::RANKING_LIVE_ID, RankingLivePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingLiveHistoryPeer::getOMClass();

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
										$temp_obj2->addRankingLiveHistory($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRankingLiveHistoryList();
				$obj2->addRankingLiveHistory($obj1); 			}
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

		RankingLiveHistoryPeer::addSelectColumns($c);
		$startcol = (RankingLiveHistoryPeer::NUM_COLUMNS - RankingLiveHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PeoplePeer::addSelectColumns($c);

		$c->addJoin(RankingLiveHistoryPeer::PEOPLE_ID, PeoplePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingLiveHistoryPeer::getOMClass();

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
										$temp_obj2->addRankingLiveHistory($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRankingLiveHistoryList();
				$obj2->addRankingLiveHistory($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingLiveHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingLiveHistoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingLiveHistoryPeer::RANKING_LIVE_ID, RankingLivePeer::ID);

		$criteria->addJoin(RankingLiveHistoryPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = RankingLiveHistoryPeer::doSelectRS($criteria, $con);
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

		RankingLiveHistoryPeer::addSelectColumns($c);
		$startcol2 = (RankingLiveHistoryPeer::NUM_COLUMNS - RankingLiveHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RankingLivePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RankingLivePeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(RankingLiveHistoryPeer::RANKING_LIVE_ID, RankingLivePeer::ID);

		$c->addJoin(RankingLiveHistoryPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingLiveHistoryPeer::getOMClass();


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
					$temp_obj2->addRankingLiveHistory($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initRankingLiveHistoryList();
				$obj2->addRankingLiveHistory($obj1);
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
					$temp_obj3->addRankingLiveHistory($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initRankingLiveHistoryList();
				$obj3->addRankingLiveHistory($obj1);
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
			$criteria->addSelectColumn(RankingLiveHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingLiveHistoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingLiveHistoryPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = RankingLiveHistoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(RankingLiveHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingLiveHistoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingLiveHistoryPeer::RANKING_LIVE_ID, RankingLivePeer::ID);

		$rs = RankingLiveHistoryPeer::doSelectRS($criteria, $con);
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

		RankingLiveHistoryPeer::addSelectColumns($c);
		$startcol2 = (RankingLiveHistoryPeer::NUM_COLUMNS - RankingLiveHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PeoplePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(RankingLiveHistoryPeer::PEOPLE_ID, PeoplePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingLiveHistoryPeer::getOMClass();

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
					$temp_obj2->addRankingLiveHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRankingLiveHistoryList();
				$obj2->addRankingLiveHistory($obj1);
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

		RankingLiveHistoryPeer::addSelectColumns($c);
		$startcol2 = (RankingLiveHistoryPeer::NUM_COLUMNS - RankingLiveHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RankingLivePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RankingLivePeer::NUM_COLUMNS;

		$c->addJoin(RankingLiveHistoryPeer::RANKING_LIVE_ID, RankingLivePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingLiveHistoryPeer::getOMClass();

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
					$temp_obj2->addRankingLiveHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRankingLiveHistoryList();
				$obj2->addRankingLiveHistory($obj1);
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
		return RankingLiveHistoryPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(RankingLiveHistoryPeer::RANKING_LIVE_ID);
			$selectCriteria->add(RankingLiveHistoryPeer::RANKING_LIVE_ID, $criteria->remove(RankingLiveHistoryPeer::RANKING_LIVE_ID), $comparison);

			$comparison = $criteria->getComparison(RankingLiveHistoryPeer::PEOPLE_ID);
			$selectCriteria->add(RankingLiveHistoryPeer::PEOPLE_ID, $criteria->remove(RankingLiveHistoryPeer::PEOPLE_ID), $comparison);

			$comparison = $criteria->getComparison(RankingLiveHistoryPeer::RANKING_DATE);
			$selectCriteria->add(RankingLiveHistoryPeer::RANKING_DATE, $criteria->remove(RankingLiveHistoryPeer::RANKING_DATE), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(RankingLiveHistoryPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(RankingLiveHistoryPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof RankingLiveHistory) {

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

			$criteria->add(RankingLiveHistoryPeer::RANKING_LIVE_ID, $vals[0], Criteria::IN);
			$criteria->add(RankingLiveHistoryPeer::PEOPLE_ID, $vals[1], Criteria::IN);
			$criteria->add(RankingLiveHistoryPeer::RANKING_DATE, $vals[2], Criteria::IN);
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

	
	public static function doValidate(RankingLiveHistory $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RankingLiveHistoryPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RankingLiveHistoryPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(RankingLiveHistoryPeer::DATABASE_NAME, RankingLiveHistoryPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RankingLiveHistoryPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $ranking_live_id, $people_id, $ranking_date, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(RankingLiveHistoryPeer::RANKING_LIVE_ID, $ranking_live_id);
		$criteria->add(RankingLiveHistoryPeer::PEOPLE_ID, $people_id);
		$criteria->add(RankingLiveHistoryPeer::RANKING_DATE, $ranking_date);
		$v = RankingLiveHistoryPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseRankingLiveHistoryPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/RankingLiveHistoryMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.RankingLiveHistoryMapBuilder');
}
