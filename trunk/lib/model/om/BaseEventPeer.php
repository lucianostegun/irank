<?php


abstract class BaseEventPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'event';

	
	const CLASS_DEFAULT = 'lib.model.Event';

	
	const NUM_COLUMNS = 22;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'event.ID';

	
	const RANKING_ID = 'event.RANKING_ID';

	
	const EVENT_NAME = 'event.EVENT_NAME';

	
	const RANKING_PLACE_ID = 'event.RANKING_PLACE_ID';

	
	const BUYIN = 'event.BUYIN';

	
	const ENTRANCE_FEE = 'event.ENTRANCE_FEE';

	
	const PAID_PLACES = 'event.PAID_PLACES';

	
	const EVENT_DATE = 'event.EVENT_DATE';

	
	const START_TIME = 'event.START_TIME';

	
	const COMMENTS = 'event.COMMENTS';

	
	const SENT_EMAIL = 'event.SENT_EMAIL';

	
	const INVITES = 'event.INVITES';

	
	const PLAYERS = 'event.PLAYERS';

	
	const SAVED_RESULT = 'event.SAVED_RESULT';

	
	const IS_FREEROLL = 'event.IS_FREEROLL';

	
	const PRIZE_POT = 'event.PRIZE_POT';

	
	const ENABLED = 'event.ENABLED';

	
	const VISIBLE = 'event.VISIBLE';

	
	const DELETED = 'event.DELETED';

	
	const LOCKED = 'event.LOCKED';

	
	const CREATED_AT = 'event.CREATED_AT';

	
	const UPDATED_AT = 'event.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'RankingId', 'EventName', 'RankingPlaceId', 'Buyin', 'EntranceFee', 'PaidPlaces', 'EventDate', 'StartTime', 'Comments', 'SentEmail', 'Invites', 'Players', 'SavedResult', 'IsFreeroll', 'PrizePot', 'Enabled', 'Visible', 'Deleted', 'Locked', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (EventPeer::ID, EventPeer::RANKING_ID, EventPeer::EVENT_NAME, EventPeer::RANKING_PLACE_ID, EventPeer::BUYIN, EventPeer::ENTRANCE_FEE, EventPeer::PAID_PLACES, EventPeer::EVENT_DATE, EventPeer::START_TIME, EventPeer::COMMENTS, EventPeer::SENT_EMAIL, EventPeer::INVITES, EventPeer::PLAYERS, EventPeer::SAVED_RESULT, EventPeer::IS_FREEROLL, EventPeer::PRIZE_POT, EventPeer::ENABLED, EventPeer::VISIBLE, EventPeer::DELETED, EventPeer::LOCKED, EventPeer::CREATED_AT, EventPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'ranking_id', 'event_name', 'ranking_place_id', 'buyin', 'entrance_fee', 'paid_places', 'event_date', 'start_time', 'comments', 'sent_email', 'invites', 'players', 'saved_result', 'is_freeroll', 'prize_pot', 'enabled', 'visible', 'deleted', 'locked', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'RANKING_ID'=>'', 'EVENT_NAME'=>'', 'RANKING_PLACE_ID'=>'', 'BUYIN'=>'', 'ENTRANCE_FEE'=>'', 'PAID_PLACES'=>'', 'EVENT_DATE'=>'', 'START_TIME'=>'', 'COMMENTS'=>'', 'SENT_EMAIL'=>'', 'INVITES'=>'', 'PLAYERS'=>'', 'SAVED_RESULT'=>'', 'IS_FREEROLL'=>'', 'PRIZE_POT'=>'', 'ENABLED'=>'', 'VISIBLE'=>'', 'DELETED'=>'', 'LOCKED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'RankingId'=>1, 'EventName'=>2, 'RankingPlaceId'=>3, 'Buyin'=>4, 'EntranceFee'=>5, 'PaidPlaces'=>6, 'EventDate'=>7, 'StartTime'=>8, 'Comments'=>9, 'SentEmail'=>10, 'Invites'=>11, 'Players'=>12, 'SavedResult'=>13, 'IsFreeroll'=>14, 'PrizePot'=>15, 'Enabled'=>16, 'Visible'=>17, 'Deleted'=>18, 'Locked'=>19, 'CreatedAt'=>20, 'UpdatedAt'=>21, ),
		BasePeer::TYPE_COLNAME=>array (EventPeer::ID=>0, EventPeer::RANKING_ID=>1, EventPeer::EVENT_NAME=>2, EventPeer::RANKING_PLACE_ID=>3, EventPeer::BUYIN=>4, EventPeer::ENTRANCE_FEE=>5, EventPeer::PAID_PLACES=>6, EventPeer::EVENT_DATE=>7, EventPeer::START_TIME=>8, EventPeer::COMMENTS=>9, EventPeer::SENT_EMAIL=>10, EventPeer::INVITES=>11, EventPeer::PLAYERS=>12, EventPeer::SAVED_RESULT=>13, EventPeer::IS_FREEROLL=>14, EventPeer::PRIZE_POT=>15, EventPeer::ENABLED=>16, EventPeer::VISIBLE=>17, EventPeer::DELETED=>18, EventPeer::LOCKED=>19, EventPeer::CREATED_AT=>20, EventPeer::UPDATED_AT=>21, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'ranking_id'=>1, 'event_name'=>2, 'ranking_place_id'=>3, 'buyin'=>4, 'entrance_fee'=>5, 'paid_places'=>6, 'event_date'=>7, 'start_time'=>8, 'comments'=>9, 'sent_email'=>10, 'invites'=>11, 'players'=>12, 'saved_result'=>13, 'is_freeroll'=>14, 'prize_pot'=>15, 'enabled'=>16, 'visible'=>17, 'deleted'=>18, 'locked'=>19, 'created_at'=>20, 'updated_at'=>21, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/EventMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.EventMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EventPeer::getTableMap();
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
		return str_replace(EventPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EventPeer::ID);

		$criteria->addSelectColumn(EventPeer::RANKING_ID);

		$criteria->addSelectColumn(EventPeer::EVENT_NAME);

		$criteria->addSelectColumn(EventPeer::RANKING_PLACE_ID);

		$criteria->addSelectColumn(EventPeer::BUYIN);

		$criteria->addSelectColumn(EventPeer::ENTRANCE_FEE);

		$criteria->addSelectColumn(EventPeer::PAID_PLACES);

		$criteria->addSelectColumn(EventPeer::EVENT_DATE);

		$criteria->addSelectColumn(EventPeer::START_TIME);

		$criteria->addSelectColumn(EventPeer::COMMENTS);

		$criteria->addSelectColumn(EventPeer::SENT_EMAIL);

		$criteria->addSelectColumn(EventPeer::INVITES);

		$criteria->addSelectColumn(EventPeer::PLAYERS);

		$criteria->addSelectColumn(EventPeer::SAVED_RESULT);

		$criteria->addSelectColumn(EventPeer::IS_FREEROLL);

		$criteria->addSelectColumn(EventPeer::PRIZE_POT);

		$criteria->addSelectColumn(EventPeer::ENABLED);

		$criteria->addSelectColumn(EventPeer::VISIBLE);

		$criteria->addSelectColumn(EventPeer::DELETED);

		$criteria->addSelectColumn(EventPeer::LOCKED);

		$criteria->addSelectColumn(EventPeer::CREATED_AT);

		$criteria->addSelectColumn(EventPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(event.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT event.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EventPeer::doSelectRS($criteria, $con);
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
		$objects = EventPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EventPeer::populateObjects(EventPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EventPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EventPeer::getOMClass();
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
			$criteria->addSelectColumn(EventPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPeer::RANKING_ID, RankingPeer::ID);

		$rs = EventPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinRankingPlace(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPeer::RANKING_PLACE_ID, RankingPlacePeer::ID);

		$rs = EventPeer::doSelectRS($criteria, $con);
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

		EventPeer::addSelectColumns($c);
		$startcol = (EventPeer::NUM_COLUMNS - EventPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		RankingPeer::addSelectColumns($c);

		$c->addJoin(EventPeer::RANKING_ID, RankingPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPeer::getOMClass();

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
										$temp_obj2->addEvent($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventList();
				$obj2->addEvent($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinRankingPlace(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventPeer::addSelectColumns($c);
		$startcol = (EventPeer::NUM_COLUMNS - EventPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		RankingPlacePeer::addSelectColumns($c);

		$c->addJoin(EventPeer::RANKING_PLACE_ID, RankingPlacePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = RankingPlacePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getRankingPlace(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEvent($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventList();
				$obj2->addEvent($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPeer::RANKING_ID, RankingPeer::ID);

		$criteria->addJoin(EventPeer::RANKING_PLACE_ID, RankingPlacePeer::ID);

		$rs = EventPeer::doSelectRS($criteria, $con);
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

		EventPeer::addSelectColumns($c);
		$startcol2 = (EventPeer::NUM_COLUMNS - EventPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RankingPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RankingPeer::NUM_COLUMNS;

		RankingPlacePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + RankingPlacePeer::NUM_COLUMNS;

		$c->addJoin(EventPeer::RANKING_ID, RankingPeer::ID);

		$c->addJoin(EventPeer::RANKING_PLACE_ID, RankingPlacePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPeer::getOMClass();


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
					$temp_obj2->addEvent($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEventList();
				$obj2->addEvent($obj1);
			}


					
			$omClass = RankingPlacePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getRankingPlace(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEvent($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initEventList();
				$obj3->addEvent($obj1);
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
			$criteria->addSelectColumn(EventPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPeer::RANKING_PLACE_ID, RankingPlacePeer::ID);

		$rs = EventPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptRankingPlace(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPeer::RANKING_ID, RankingPeer::ID);

		$rs = EventPeer::doSelectRS($criteria, $con);
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

		EventPeer::addSelectColumns($c);
		$startcol2 = (EventPeer::NUM_COLUMNS - EventPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RankingPlacePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RankingPlacePeer::NUM_COLUMNS;

		$c->addJoin(EventPeer::RANKING_PLACE_ID, RankingPlacePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = RankingPlacePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getRankingPlace(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEvent($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEventList();
				$obj2->addEvent($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptRankingPlace(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventPeer::addSelectColumns($c);
		$startcol2 = (EventPeer::NUM_COLUMNS - EventPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RankingPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RankingPeer::NUM_COLUMNS;

		$c->addJoin(EventPeer::RANKING_ID, RankingPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPeer::getOMClass();

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
					$temp_obj2->addEvent($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEventList();
				$obj2->addEvent($obj1);
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
		return EventPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(EventPeer::ID); 

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
			$comparison = $criteria->getComparison(EventPeer::ID);
			$selectCriteria->add(EventPeer::ID, $criteria->remove(EventPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(EventPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EventPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Event) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(EventPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Event $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EventPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EventPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EventPeer::DATABASE_NAME, EventPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EventPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(EventPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(EventPeer::ID, $pk);


		$v = EventPeer::doSelect($criteria, $con);

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
			$criteria->add(EventPeer::ID, $pks, Criteria::IN);
			$objs = EventPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseEventPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/EventMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.EventMapBuilder');
}
