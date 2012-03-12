<?php


abstract class BaseEventPhotoContestPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'event_photo_contest';

	
	const CLASS_DEFAULT = 'lib.model.EventPhotoContest';

	
	const NUM_COLUMNS = 8;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'event_photo_contest.ID';

	
	const EVENT_PHOTO_ID_LEFT = 'event_photo_contest.EVENT_PHOTO_ID_LEFT';

	
	const EVENT_PHOTO_ID_RIGHT = 'event_photo_contest.EVENT_PHOTO_ID_RIGHT';

	
	const EVENT_PHOTO_ID_WINNER = 'event_photo_contest.EVENT_PHOTO_ID_WINNER';

	
	const LOCK_KEY = 'event_photo_contest.LOCK_KEY';

	
	const IP_ADDRESS = 'event_photo_contest.IP_ADDRESS';

	
	const CREATED_AT = 'event_photo_contest.CREATED_AT';

	
	const UPDATED_AT = 'event_photo_contest.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'EventPhotoIdLeft', 'EventPhotoIdRight', 'EventPhotoIdWinner', 'LockKey', 'IpAddress', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (EventPhotoContestPeer::ID, EventPhotoContestPeer::EVENT_PHOTO_ID_LEFT, EventPhotoContestPeer::EVENT_PHOTO_ID_RIGHT, EventPhotoContestPeer::EVENT_PHOTO_ID_WINNER, EventPhotoContestPeer::LOCK_KEY, EventPhotoContestPeer::IP_ADDRESS, EventPhotoContestPeer::CREATED_AT, EventPhotoContestPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'event_photo_id_left', 'event_photo_id_right', 'event_photo_id_winner', 'lock_key', 'ip_address', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'EVENT_PHOTO_ID_LEFT'=>'', 'EVENT_PHOTO_ID_RIGHT'=>'', 'EVENT_PHOTO_ID_WINNER'=>'', 'LOCK_KEY'=>'', 'IP_ADDRESS'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'EventPhotoIdLeft'=>1, 'EventPhotoIdRight'=>2, 'EventPhotoIdWinner'=>3, 'LockKey'=>4, 'IpAddress'=>5, 'CreatedAt'=>6, 'UpdatedAt'=>7, ),
		BasePeer::TYPE_COLNAME=>array (EventPhotoContestPeer::ID=>0, EventPhotoContestPeer::EVENT_PHOTO_ID_LEFT=>1, EventPhotoContestPeer::EVENT_PHOTO_ID_RIGHT=>2, EventPhotoContestPeer::EVENT_PHOTO_ID_WINNER=>3, EventPhotoContestPeer::LOCK_KEY=>4, EventPhotoContestPeer::IP_ADDRESS=>5, EventPhotoContestPeer::CREATED_AT=>6, EventPhotoContestPeer::UPDATED_AT=>7, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'event_photo_id_left'=>1, 'event_photo_id_right'=>2, 'event_photo_id_winner'=>3, 'lock_key'=>4, 'ip_address'=>5, 'created_at'=>6, 'updated_at'=>7, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/EventPhotoContestMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.EventPhotoContestMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EventPhotoContestPeer::getTableMap();
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
		return str_replace(EventPhotoContestPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EventPhotoContestPeer::ID);

		$criteria->addSelectColumn(EventPhotoContestPeer::EVENT_PHOTO_ID_LEFT);

		$criteria->addSelectColumn(EventPhotoContestPeer::EVENT_PHOTO_ID_RIGHT);

		$criteria->addSelectColumn(EventPhotoContestPeer::EVENT_PHOTO_ID_WINNER);

		$criteria->addSelectColumn(EventPhotoContestPeer::LOCK_KEY);

		$criteria->addSelectColumn(EventPhotoContestPeer::IP_ADDRESS);

		$criteria->addSelectColumn(EventPhotoContestPeer::CREATED_AT);

		$criteria->addSelectColumn(EventPhotoContestPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(event_photo_contest.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT event_photo_contest.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPhotoContestPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPhotoContestPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EventPhotoContestPeer::doSelectRS($criteria, $con);
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
		$objects = EventPhotoContestPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EventPhotoContestPeer::populateObjects(EventPhotoContestPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EventPhotoContestPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EventPhotoContestPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinEventPhotoRelatedByEventPhotoIdLeft(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPhotoContestPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPhotoContestPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPhotoContestPeer::EVENT_PHOTO_ID_LEFT, EventPhotoPeer::ID);

		$rs = EventPhotoContestPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinEventPhotoRelatedByEventPhotoIdRight(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPhotoContestPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPhotoContestPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPhotoContestPeer::EVENT_PHOTO_ID_RIGHT, EventPhotoPeer::ID);

		$rs = EventPhotoContestPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinEventPhotoRelatedByEventPhotoIdWinner(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPhotoContestPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPhotoContestPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPhotoContestPeer::EVENT_PHOTO_ID_WINNER, EventPhotoPeer::ID);

		$rs = EventPhotoContestPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinEventPhotoRelatedByEventPhotoIdLeft(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventPhotoContestPeer::addSelectColumns($c);
		$startcol = (EventPhotoContestPeer::NUM_COLUMNS - EventPhotoContestPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		EventPhotoPeer::addSelectColumns($c);

		$c->addJoin(EventPhotoContestPeer::EVENT_PHOTO_ID_LEFT, EventPhotoPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPhotoContestPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EventPhotoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getEventPhotoRelatedByEventPhotoIdLeft(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEventPhotoContestRelatedByEventPhotoIdLeft($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventPhotoContestListRelatedByEventPhotoIdLeft();
				$obj2->addEventPhotoContestRelatedByEventPhotoIdLeft($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinEventPhotoRelatedByEventPhotoIdRight(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventPhotoContestPeer::addSelectColumns($c);
		$startcol = (EventPhotoContestPeer::NUM_COLUMNS - EventPhotoContestPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		EventPhotoPeer::addSelectColumns($c);

		$c->addJoin(EventPhotoContestPeer::EVENT_PHOTO_ID_RIGHT, EventPhotoPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPhotoContestPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EventPhotoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getEventPhotoRelatedByEventPhotoIdRight(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEventPhotoContestRelatedByEventPhotoIdRight($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventPhotoContestListRelatedByEventPhotoIdRight();
				$obj2->addEventPhotoContestRelatedByEventPhotoIdRight($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinEventPhotoRelatedByEventPhotoIdWinner(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventPhotoContestPeer::addSelectColumns($c);
		$startcol = (EventPhotoContestPeer::NUM_COLUMNS - EventPhotoContestPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		EventPhotoPeer::addSelectColumns($c);

		$c->addJoin(EventPhotoContestPeer::EVENT_PHOTO_ID_WINNER, EventPhotoPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPhotoContestPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EventPhotoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getEventPhotoRelatedByEventPhotoIdWinner(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEventPhotoContestRelatedByEventPhotoIdWinner($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventPhotoContestListRelatedByEventPhotoIdWinner();
				$obj2->addEventPhotoContestRelatedByEventPhotoIdWinner($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPhotoContestPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPhotoContestPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPhotoContestPeer::EVENT_PHOTO_ID_LEFT, EventPhotoPeer::ID);

		$criteria->addJoin(EventPhotoContestPeer::EVENT_PHOTO_ID_RIGHT, EventPhotoPeer::ID);

		$criteria->addJoin(EventPhotoContestPeer::EVENT_PHOTO_ID_WINNER, EventPhotoPeer::ID);

		$rs = EventPhotoContestPeer::doSelectRS($criteria, $con);
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

		EventPhotoContestPeer::addSelectColumns($c);
		$startcol2 = (EventPhotoContestPeer::NUM_COLUMNS - EventPhotoContestPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EventPhotoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EventPhotoPeer::NUM_COLUMNS;

		EventPhotoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + EventPhotoPeer::NUM_COLUMNS;

		EventPhotoPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + EventPhotoPeer::NUM_COLUMNS;

		$c->addJoin(EventPhotoContestPeer::EVENT_PHOTO_ID_LEFT, EventPhotoPeer::ID);

		$c->addJoin(EventPhotoContestPeer::EVENT_PHOTO_ID_RIGHT, EventPhotoPeer::ID);

		$c->addJoin(EventPhotoContestPeer::EVENT_PHOTO_ID_WINNER, EventPhotoPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPhotoContestPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = EventPhotoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getEventPhotoRelatedByEventPhotoIdLeft(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEventPhotoContestRelatedByEventPhotoIdLeft($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEventPhotoContestListRelatedByEventPhotoIdLeft();
				$obj2->addEventPhotoContestRelatedByEventPhotoIdLeft($obj1);
			}


					
			$omClass = EventPhotoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getEventPhotoRelatedByEventPhotoIdRight(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEventPhotoContestRelatedByEventPhotoIdRight($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initEventPhotoContestListRelatedByEventPhotoIdRight();
				$obj3->addEventPhotoContestRelatedByEventPhotoIdRight($obj1);
			}


					
			$omClass = EventPhotoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getEventPhotoRelatedByEventPhotoIdWinner(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addEventPhotoContestRelatedByEventPhotoIdWinner($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initEventPhotoContestListRelatedByEventPhotoIdWinner();
				$obj4->addEventPhotoContestRelatedByEventPhotoIdWinner($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptEventPhotoRelatedByEventPhotoIdLeft(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPhotoContestPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPhotoContestPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EventPhotoContestPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptEventPhotoRelatedByEventPhotoIdRight(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPhotoContestPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPhotoContestPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EventPhotoContestPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptEventPhotoRelatedByEventPhotoIdWinner(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPhotoContestPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPhotoContestPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EventPhotoContestPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptEventPhotoRelatedByEventPhotoIdLeft(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventPhotoContestPeer::addSelectColumns($c);
		$startcol2 = (EventPhotoContestPeer::NUM_COLUMNS - EventPhotoContestPeer::NUM_LAZY_LOAD_COLUMNS) + 1;


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPhotoContestPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptEventPhotoRelatedByEventPhotoIdRight(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventPhotoContestPeer::addSelectColumns($c);
		$startcol2 = (EventPhotoContestPeer::NUM_COLUMNS - EventPhotoContestPeer::NUM_LAZY_LOAD_COLUMNS) + 1;


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPhotoContestPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptEventPhotoRelatedByEventPhotoIdWinner(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventPhotoContestPeer::addSelectColumns($c);
		$startcol2 = (EventPhotoContestPeer::NUM_COLUMNS - EventPhotoContestPeer::NUM_LAZY_LOAD_COLUMNS) + 1;


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPhotoContestPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

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
		return EventPhotoContestPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(EventPhotoContestPeer::ID); 

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
			$comparison = $criteria->getComparison(EventPhotoContestPeer::ID);
			$selectCriteria->add(EventPhotoContestPeer::ID, $criteria->remove(EventPhotoContestPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(EventPhotoContestPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EventPhotoContestPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof EventPhotoContest) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(EventPhotoContestPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(EventPhotoContest $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EventPhotoContestPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EventPhotoContestPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EventPhotoContestPeer::DATABASE_NAME, EventPhotoContestPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EventPhotoContestPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(EventPhotoContestPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(EventPhotoContestPeer::ID, $pk);


		$v = EventPhotoContestPeer::doSelect($criteria, $con);

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
			$criteria->add(EventPhotoContestPeer::ID, $pks, Criteria::IN);
			$objs = EventPhotoContestPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseEventPhotoContestPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/EventPhotoContestMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.EventPhotoContestMapBuilder');
}
