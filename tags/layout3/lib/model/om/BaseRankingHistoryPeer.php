<?php


abstract class BaseRankingHistoryPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'ranking_history';

	
	const CLASS_DEFAULT = 'lib.model.RankingHistory';

	
	const NUM_COLUMNS = 20;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const RANKING_ID = 'ranking_history.RANKING_ID';

	
	const PEOPLE_ID = 'ranking_history.PEOPLE_ID';

	
	const RANKING_DATE = 'ranking_history.RANKING_DATE';

	
	const TOTAL_RANKING_POSITION = 'ranking_history.TOTAL_RANKING_POSITION';

	
	const RANKING_POSITION = 'ranking_history.RANKING_POSITION';

	
	const EVENTS = 'ranking_history.EVENTS';

	
	const SCORE = 'ranking_history.SCORE';

	
	const AVERAGE = 'ranking_history.AVERAGE';

	
	const PAID_VALUE = 'ranking_history.PAID_VALUE';

	
	const PRIZE_VALUE = 'ranking_history.PRIZE_VALUE';

	
	const BALANCE_VALUE = 'ranking_history.BALANCE_VALUE';

	
	const TOTAL_EVENTS = 'ranking_history.TOTAL_EVENTS';

	
	const TOTAL_SCORE = 'ranking_history.TOTAL_SCORE';

	
	const TOTAL_PAID = 'ranking_history.TOTAL_PAID';

	
	const TOTAL_PRIZE = 'ranking_history.TOTAL_PRIZE';

	
	const TOTAL_BALANCE = 'ranking_history.TOTAL_BALANCE';

	
	const TOTAL_AVERAGE = 'ranking_history.TOTAL_AVERAGE';

	
	const ENABLED = 'ranking_history.ENABLED';

	
	const CREATED_AT = 'ranking_history.CREATED_AT';

	
	const UPDATED_AT = 'ranking_history.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('RankingId', 'PeopleId', 'RankingDate', 'TotalRankingPosition', 'RankingPosition', 'Events', 'Score', 'Average', 'PaidValue', 'PrizeValue', 'BalanceValue', 'TotalEvents', 'TotalScore', 'TotalPaid', 'TotalPrize', 'TotalBalance', 'TotalAverage', 'Enabled', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (RankingHistoryPeer::RANKING_ID, RankingHistoryPeer::PEOPLE_ID, RankingHistoryPeer::RANKING_DATE, RankingHistoryPeer::TOTAL_RANKING_POSITION, RankingHistoryPeer::RANKING_POSITION, RankingHistoryPeer::EVENTS, RankingHistoryPeer::SCORE, RankingHistoryPeer::AVERAGE, RankingHistoryPeer::PAID_VALUE, RankingHistoryPeer::PRIZE_VALUE, RankingHistoryPeer::BALANCE_VALUE, RankingHistoryPeer::TOTAL_EVENTS, RankingHistoryPeer::TOTAL_SCORE, RankingHistoryPeer::TOTAL_PAID, RankingHistoryPeer::TOTAL_PRIZE, RankingHistoryPeer::TOTAL_BALANCE, RankingHistoryPeer::TOTAL_AVERAGE, RankingHistoryPeer::ENABLED, RankingHistoryPeer::CREATED_AT, RankingHistoryPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('ranking_id', 'people_id', 'ranking_date', 'total_ranking_position', 'ranking_position', 'events', 'score', 'average', 'paid_value', 'prize_value', 'balance_value', 'total_events', 'total_score', 'total_paid', 'total_prize', 'total_balance', 'total_average', 'enabled', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('RANKING_ID'=>'', 'PEOPLE_ID'=>'', 'RANKING_DATE'=>'', 'TOTAL_RANKING_POSITION'=>'', 'RANKING_POSITION'=>'', 'EVENTS'=>'', 'SCORE'=>'', 'AVERAGE'=>'', 'PAID_VALUE'=>'', 'PRIZE_VALUE'=>'', 'BALANCE_VALUE'=>'', 'TOTAL_EVENTS'=>'', 'TOTAL_SCORE'=>'', 'TOTAL_PAID'=>'', 'TOTAL_PRIZE'=>'', 'TOTAL_BALANCE'=>'', 'TOTAL_AVERAGE'=>'', 'ENABLED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('RankingId'=>0, 'PeopleId'=>1, 'RankingDate'=>2, 'TotalRankingPosition'=>3, 'RankingPosition'=>4, 'Events'=>5, 'Score'=>6, 'Average'=>7, 'PaidValue'=>8, 'PrizeValue'=>9, 'BalanceValue'=>10, 'TotalEvents'=>11, 'TotalScore'=>12, 'TotalPaid'=>13, 'TotalPrize'=>14, 'TotalBalance'=>15, 'TotalAverage'=>16, 'Enabled'=>17, 'CreatedAt'=>18, 'UpdatedAt'=>19, ),
		BasePeer::TYPE_COLNAME=>array (RankingHistoryPeer::RANKING_ID=>0, RankingHistoryPeer::PEOPLE_ID=>1, RankingHistoryPeer::RANKING_DATE=>2, RankingHistoryPeer::TOTAL_RANKING_POSITION=>3, RankingHistoryPeer::RANKING_POSITION=>4, RankingHistoryPeer::EVENTS=>5, RankingHistoryPeer::SCORE=>6, RankingHistoryPeer::AVERAGE=>7, RankingHistoryPeer::PAID_VALUE=>8, RankingHistoryPeer::PRIZE_VALUE=>9, RankingHistoryPeer::BALANCE_VALUE=>10, RankingHistoryPeer::TOTAL_EVENTS=>11, RankingHistoryPeer::TOTAL_SCORE=>12, RankingHistoryPeer::TOTAL_PAID=>13, RankingHistoryPeer::TOTAL_PRIZE=>14, RankingHistoryPeer::TOTAL_BALANCE=>15, RankingHistoryPeer::TOTAL_AVERAGE=>16, RankingHistoryPeer::ENABLED=>17, RankingHistoryPeer::CREATED_AT=>18, RankingHistoryPeer::UPDATED_AT=>19, ),
		BasePeer::TYPE_FIELDNAME=>array ('ranking_id'=>0, 'people_id'=>1, 'ranking_date'=>2, 'total_ranking_position'=>3, 'ranking_position'=>4, 'events'=>5, 'score'=>6, 'average'=>7, 'paid_value'=>8, 'prize_value'=>9, 'balance_value'=>10, 'total_events'=>11, 'total_score'=>12, 'total_paid'=>13, 'total_prize'=>14, 'total_balance'=>15, 'total_average'=>16, 'enabled'=>17, 'created_at'=>18, 'updated_at'=>19, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/RankingHistoryMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.RankingHistoryMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = RankingHistoryPeer::getTableMap();
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
		return str_replace(RankingHistoryPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(RankingHistoryPeer::RANKING_ID);

		$criteria->addSelectColumn(RankingHistoryPeer::PEOPLE_ID);

		$criteria->addSelectColumn(RankingHistoryPeer::RANKING_DATE);

		$criteria->addSelectColumn(RankingHistoryPeer::TOTAL_RANKING_POSITION);

		$criteria->addSelectColumn(RankingHistoryPeer::RANKING_POSITION);

		$criteria->addSelectColumn(RankingHistoryPeer::EVENTS);

		$criteria->addSelectColumn(RankingHistoryPeer::SCORE);

		$criteria->addSelectColumn(RankingHistoryPeer::AVERAGE);

		$criteria->addSelectColumn(RankingHistoryPeer::PAID_VALUE);

		$criteria->addSelectColumn(RankingHistoryPeer::PRIZE_VALUE);

		$criteria->addSelectColumn(RankingHistoryPeer::BALANCE_VALUE);

		$criteria->addSelectColumn(RankingHistoryPeer::TOTAL_EVENTS);

		$criteria->addSelectColumn(RankingHistoryPeer::TOTAL_SCORE);

		$criteria->addSelectColumn(RankingHistoryPeer::TOTAL_PAID);

		$criteria->addSelectColumn(RankingHistoryPeer::TOTAL_PRIZE);

		$criteria->addSelectColumn(RankingHistoryPeer::TOTAL_BALANCE);

		$criteria->addSelectColumn(RankingHistoryPeer::TOTAL_AVERAGE);

		$criteria->addSelectColumn(RankingHistoryPeer::ENABLED);

		$criteria->addSelectColumn(RankingHistoryPeer::CREATED_AT);

		$criteria->addSelectColumn(RankingHistoryPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(ranking_history.RANKING_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT ranking_history.RANKING_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingHistoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = RankingHistoryPeer::doSelectRS($criteria, $con);
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
		$objects = RankingHistoryPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return RankingHistoryPeer::populateObjects(RankingHistoryPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			RankingHistoryPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = RankingHistoryPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinRanking(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingHistoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingHistoryPeer::RANKING_ID, RankingPeer::ID);

		$rs = RankingHistoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(RankingHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingHistoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingHistoryPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = RankingHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinRanking(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RankingHistoryPeer::addSelectColumns($c);
		$startcol = (RankingHistoryPeer::NUM_COLUMNS - RankingHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		RankingPeer::addSelectColumns($c);

		$c->addJoin(RankingHistoryPeer::RANKING_ID, RankingPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingHistoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = RankingPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getRanking(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addRankingHistory($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRankingHistoryList();
				$obj2->addRankingHistory($obj1); 			}
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

		RankingHistoryPeer::addSelectColumns($c);
		$startcol = (RankingHistoryPeer::NUM_COLUMNS - RankingHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PeoplePeer::addSelectColumns($c);

		$c->addJoin(RankingHistoryPeer::PEOPLE_ID, PeoplePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingHistoryPeer::getOMClass();

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
										$temp_obj2->addRankingHistory($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRankingHistoryList();
				$obj2->addRankingHistory($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingHistoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingHistoryPeer::RANKING_ID, RankingPeer::ID);

		$criteria->addJoin(RankingHistoryPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = RankingHistoryPeer::doSelectRS($criteria, $con);
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

		RankingHistoryPeer::addSelectColumns($c);
		$startcol2 = (RankingHistoryPeer::NUM_COLUMNS - RankingHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RankingPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RankingPeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(RankingHistoryPeer::RANKING_ID, RankingPeer::ID);

		$c->addJoin(RankingHistoryPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingHistoryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = RankingPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getRanking(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRankingHistory($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initRankingHistoryList();
				$obj2->addRankingHistory($obj1);
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
					$temp_obj3->addRankingHistory($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initRankingHistoryList();
				$obj3->addRankingHistory($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptRanking(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingHistoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingHistoryPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = RankingHistoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(RankingHistoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingHistoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingHistoryPeer::RANKING_ID, RankingPeer::ID);

		$rs = RankingHistoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptRanking(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RankingHistoryPeer::addSelectColumns($c);
		$startcol2 = (RankingHistoryPeer::NUM_COLUMNS - RankingHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PeoplePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(RankingHistoryPeer::PEOPLE_ID, PeoplePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingHistoryPeer::getOMClass();

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
					$temp_obj2->addRankingHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRankingHistoryList();
				$obj2->addRankingHistory($obj1);
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

		RankingHistoryPeer::addSelectColumns($c);
		$startcol2 = (RankingHistoryPeer::NUM_COLUMNS - RankingHistoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RankingPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RankingPeer::NUM_COLUMNS;

		$c->addJoin(RankingHistoryPeer::RANKING_ID, RankingPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingHistoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = RankingPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getRanking(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRankingHistory($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRankingHistoryList();
				$obj2->addRankingHistory($obj1);
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
		return RankingHistoryPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(RankingHistoryPeer::RANKING_ID);
			$selectCriteria->add(RankingHistoryPeer::RANKING_ID, $criteria->remove(RankingHistoryPeer::RANKING_ID), $comparison);

			$comparison = $criteria->getComparison(RankingHistoryPeer::PEOPLE_ID);
			$selectCriteria->add(RankingHistoryPeer::PEOPLE_ID, $criteria->remove(RankingHistoryPeer::PEOPLE_ID), $comparison);

			$comparison = $criteria->getComparison(RankingHistoryPeer::RANKING_DATE);
			$selectCriteria->add(RankingHistoryPeer::RANKING_DATE, $criteria->remove(RankingHistoryPeer::RANKING_DATE), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(RankingHistoryPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(RankingHistoryPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof RankingHistory) {

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

			$criteria->add(RankingHistoryPeer::RANKING_ID, $vals[0], Criteria::IN);
			$criteria->add(RankingHistoryPeer::PEOPLE_ID, $vals[1], Criteria::IN);
			$criteria->add(RankingHistoryPeer::RANKING_DATE, $vals[2], Criteria::IN);
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

	
	public static function doValidate(RankingHistory $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RankingHistoryPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RankingHistoryPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(RankingHistoryPeer::DATABASE_NAME, RankingHistoryPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RankingHistoryPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $ranking_id, $people_id, $ranking_date, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(RankingHistoryPeer::RANKING_ID, $ranking_id);
		$criteria->add(RankingHistoryPeer::PEOPLE_ID, $people_id);
		$criteria->add(RankingHistoryPeer::RANKING_DATE, $ranking_date);
		$v = RankingHistoryPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseRankingHistoryPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/RankingHistoryMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.RankingHistoryMapBuilder');
}
