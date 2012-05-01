<?php


abstract class BaseEventLivePlayerScorePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'event_live_player_score';

	
	const CLASS_DEFAULT = 'lib.model.EventLivePlayerScore';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const EVENT_LIVE_ID = 'event_live_player_score.EVENT_LIVE_ID';

	
	const PEOPLE_ID = 'event_live_player_score.PEOPLE_ID';

	
	const LABEL = 'event_live_player_score.LABEL';

	
	const SCORE = 'event_live_player_score.SCORE';

	
	const ORDER_SEQ = 'event_live_player_score.ORDER_SEQ';

	
	const CREATED_AT = 'event_live_player_score.CREATED_AT';

	
	const UPDATED_AT = 'event_live_player_score.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('EventLiveId', 'PeopleId', 'Label', 'Score', 'OrderSeq', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (EventLivePlayerScorePeer::EVENT_LIVE_ID, EventLivePlayerScorePeer::PEOPLE_ID, EventLivePlayerScorePeer::LABEL, EventLivePlayerScorePeer::SCORE, EventLivePlayerScorePeer::ORDER_SEQ, EventLivePlayerScorePeer::CREATED_AT, EventLivePlayerScorePeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('event_live_id', 'people_id', 'label', 'score', 'order_seq', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('EVENT_LIVE_ID'=>'', 'PEOPLE_ID'=>'', 'LABEL'=>'', 'SCORE'=>'', 'ORDER_SEQ'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('EventLiveId'=>0, 'PeopleId'=>1, 'Label'=>2, 'Score'=>3, 'OrderSeq'=>4, 'CreatedAt'=>5, 'UpdatedAt'=>6, ),
		BasePeer::TYPE_COLNAME=>array (EventLivePlayerScorePeer::EVENT_LIVE_ID=>0, EventLivePlayerScorePeer::PEOPLE_ID=>1, EventLivePlayerScorePeer::LABEL=>2, EventLivePlayerScorePeer::SCORE=>3, EventLivePlayerScorePeer::ORDER_SEQ=>4, EventLivePlayerScorePeer::CREATED_AT=>5, EventLivePlayerScorePeer::UPDATED_AT=>6, ),
		BasePeer::TYPE_FIELDNAME=>array ('event_live_id'=>0, 'people_id'=>1, 'label'=>2, 'score'=>3, 'order_seq'=>4, 'created_at'=>5, 'updated_at'=>6, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/EventLivePlayerScoreMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.EventLivePlayerScoreMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EventLivePlayerScorePeer::getTableMap();
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
		return str_replace(EventLivePlayerScorePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EventLivePlayerScorePeer::EVENT_LIVE_ID);

		$criteria->addSelectColumn(EventLivePlayerScorePeer::PEOPLE_ID);

		$criteria->addSelectColumn(EventLivePlayerScorePeer::LABEL);

		$criteria->addSelectColumn(EventLivePlayerScorePeer::SCORE);

		$criteria->addSelectColumn(EventLivePlayerScorePeer::ORDER_SEQ);

		$criteria->addSelectColumn(EventLivePlayerScorePeer::CREATED_AT);

		$criteria->addSelectColumn(EventLivePlayerScorePeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(event_live_player_score.EVENT_LIVE_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT event_live_player_score.EVENT_LIVE_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventLivePlayerScorePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePlayerScorePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EventLivePlayerScorePeer::doSelectRS($criteria, $con);
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
		$objects = EventLivePlayerScorePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EventLivePlayerScorePeer::populateObjects(EventLivePlayerScorePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EventLivePlayerScorePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EventLivePlayerScorePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinPeople(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventLivePlayerScorePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePlayerScorePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLivePlayerScorePeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = EventLivePlayerScorePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinEventLive(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventLivePlayerScorePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePlayerScorePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLivePlayerScorePeer::EVENT_LIVE_ID, EventLivePeer::ID);

		$rs = EventLivePlayerScorePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinPeople(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventLivePlayerScorePeer::addSelectColumns($c);
		$startcol = (EventLivePlayerScorePeer::NUM_COLUMNS - EventLivePlayerScorePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PeoplePeer::addSelectColumns($c);

		$c->addJoin(EventLivePlayerScorePeer::PEOPLE_ID, PeoplePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLivePlayerScorePeer::getOMClass();

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
										$temp_obj2->addEventLivePlayerScore($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventLivePlayerScoreList();
				$obj2->addEventLivePlayerScore($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinEventLive(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventLivePlayerScorePeer::addSelectColumns($c);
		$startcol = (EventLivePlayerScorePeer::NUM_COLUMNS - EventLivePlayerScorePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		EventLivePeer::addSelectColumns($c);

		$c->addJoin(EventLivePlayerScorePeer::EVENT_LIVE_ID, EventLivePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLivePlayerScorePeer::getOMClass();

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
										$temp_obj2->addEventLivePlayerScore($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventLivePlayerScoreList();
				$obj2->addEventLivePlayerScore($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventLivePlayerScorePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePlayerScorePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLivePlayerScorePeer::PEOPLE_ID, PeoplePeer::ID);

		$criteria->addJoin(EventLivePlayerScorePeer::EVENT_LIVE_ID, EventLivePeer::ID);

		$rs = EventLivePlayerScorePeer::doSelectRS($criteria, $con);
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

		EventLivePlayerScorePeer::addSelectColumns($c);
		$startcol2 = (EventLivePlayerScorePeer::NUM_COLUMNS - EventLivePlayerScorePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PeoplePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PeoplePeer::NUM_COLUMNS;

		EventLivePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + EventLivePeer::NUM_COLUMNS;

		$c->addJoin(EventLivePlayerScorePeer::PEOPLE_ID, PeoplePeer::ID);

		$c->addJoin(EventLivePlayerScorePeer::EVENT_LIVE_ID, EventLivePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLivePlayerScorePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = PeoplePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPeople(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEventLivePlayerScore($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEventLivePlayerScoreList();
				$obj2->addEventLivePlayerScore($obj1);
			}


					
			$omClass = EventLivePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getEventLive(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEventLivePlayerScore($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initEventLivePlayerScoreList();
				$obj3->addEventLivePlayerScore($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptPeople(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventLivePlayerScorePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePlayerScorePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLivePlayerScorePeer::EVENT_LIVE_ID, EventLivePeer::ID);

		$rs = EventLivePlayerScorePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptEventLive(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventLivePlayerScorePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventLivePlayerScorePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventLivePlayerScorePeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = EventLivePlayerScorePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptPeople(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventLivePlayerScorePeer::addSelectColumns($c);
		$startcol2 = (EventLivePlayerScorePeer::NUM_COLUMNS - EventLivePlayerScorePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EventLivePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EventLivePeer::NUM_COLUMNS;

		$c->addJoin(EventLivePlayerScorePeer::EVENT_LIVE_ID, EventLivePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLivePlayerScorePeer::getOMClass();

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
					$temp_obj2->addEventLivePlayerScore($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEventLivePlayerScoreList();
				$obj2->addEventLivePlayerScore($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptEventLive(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventLivePlayerScorePeer::addSelectColumns($c);
		$startcol2 = (EventLivePlayerScorePeer::NUM_COLUMNS - EventLivePlayerScorePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PeoplePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(EventLivePlayerScorePeer::PEOPLE_ID, PeoplePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventLivePlayerScorePeer::getOMClass();

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
					$temp_obj2->addEventLivePlayerScore($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEventLivePlayerScoreList();
				$obj2->addEventLivePlayerScore($obj1);
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
		return EventLivePlayerScorePeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(EventLivePlayerScorePeer::EVENT_LIVE_ID);
			$selectCriteria->add(EventLivePlayerScorePeer::EVENT_LIVE_ID, $criteria->remove(EventLivePlayerScorePeer::EVENT_LIVE_ID), $comparison);

			$comparison = $criteria->getComparison(EventLivePlayerScorePeer::PEOPLE_ID);
			$selectCriteria->add(EventLivePlayerScorePeer::PEOPLE_ID, $criteria->remove(EventLivePlayerScorePeer::PEOPLE_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(EventLivePlayerScorePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EventLivePlayerScorePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof EventLivePlayerScore) {

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

			$criteria->add(EventLivePlayerScorePeer::EVENT_LIVE_ID, $vals[0], Criteria::IN);
			$criteria->add(EventLivePlayerScorePeer::PEOPLE_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(EventLivePlayerScore $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EventLivePlayerScorePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EventLivePlayerScorePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EventLivePlayerScorePeer::DATABASE_NAME, EventLivePlayerScorePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EventLivePlayerScorePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
		$criteria->add(EventLivePlayerScorePeer::EVENT_LIVE_ID, $event_live_id);
		$criteria->add(EventLivePlayerScorePeer::PEOPLE_ID, $people_id);
		$v = EventLivePlayerScorePeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseEventLivePlayerScorePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/EventLivePlayerScoreMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.EventLivePlayerScoreMapBuilder');
}
