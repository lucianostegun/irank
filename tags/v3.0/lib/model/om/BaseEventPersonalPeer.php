<?php


abstract class BaseEventPersonalPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'event_personal';

	
	const CLASS_DEFAULT = 'lib.model.EventPersonal';

	
	const NUM_COLUMNS = 20;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'event_personal.ID';

	
	const USER_SITE_ID = 'event_personal.USER_SITE_ID';

	
	const GAME_STYLE_ID = 'event_personal.GAME_STYLE_ID';

	
	const EVENT_NAME = 'event_personal.EVENT_NAME';

	
	const EVENT_PLACE = 'event_personal.EVENT_PLACE';

	
	const EVENT_POSITION = 'event_personal.EVENT_POSITION';

	
	const BUYIN = 'event_personal.BUYIN';

	
	const REBUY = 'event_personal.REBUY';

	
	const ADDON = 'event_personal.ADDON';

	
	const PRIZE = 'event_personal.PRIZE';

	
	const PAID_PLACES = 'event_personal.PAID_PLACES';

	
	const EVENT_DATE = 'event_personal.EVENT_DATE';

	
	const COMMENTS = 'event_personal.COMMENTS';

	
	const PLAYERS = 'event_personal.PLAYERS';

	
	const ENABLED = 'event_personal.ENABLED';

	
	const VISIBLE = 'event_personal.VISIBLE';

	
	const DELETED = 'event_personal.DELETED';

	
	const LOCKED = 'event_personal.LOCKED';

	
	const CREATED_AT = 'event_personal.CREATED_AT';

	
	const UPDATED_AT = 'event_personal.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'UserSiteId', 'GameStyleId', 'EventName', 'EventPlace', 'EventPosition', 'Buyin', 'Rebuy', 'Addon', 'Prize', 'PaidPlaces', 'EventDate', 'Comments', 'Players', 'Enabled', 'Visible', 'Deleted', 'Locked', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (EventPersonalPeer::ID, EventPersonalPeer::USER_SITE_ID, EventPersonalPeer::GAME_STYLE_ID, EventPersonalPeer::EVENT_NAME, EventPersonalPeer::EVENT_PLACE, EventPersonalPeer::EVENT_POSITION, EventPersonalPeer::BUYIN, EventPersonalPeer::REBUY, EventPersonalPeer::ADDON, EventPersonalPeer::PRIZE, EventPersonalPeer::PAID_PLACES, EventPersonalPeer::EVENT_DATE, EventPersonalPeer::COMMENTS, EventPersonalPeer::PLAYERS, EventPersonalPeer::ENABLED, EventPersonalPeer::VISIBLE, EventPersonalPeer::DELETED, EventPersonalPeer::LOCKED, EventPersonalPeer::CREATED_AT, EventPersonalPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'user_site_id', 'game_style_id', 'event_name', 'event_place', 'event_position', 'buyin', 'rebuy', 'addon', 'prize', 'paid_places', 'event_date', 'comments', 'players', 'enabled', 'visible', 'deleted', 'locked', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'USER_SITE_ID'=>'', 'GAME_STYLE_ID'=>'', 'EVENT_NAME'=>'', 'EVENT_PLACE'=>'', 'EVENT_POSITION'=>'', 'BUYIN'=>'', 'REBUY'=>'', 'ADDON'=>'', 'PRIZE'=>'', 'PAID_PLACES'=>'', 'EVENT_DATE'=>'', 'COMMENTS'=>'', 'PLAYERS'=>'', 'ENABLED'=>'', 'VISIBLE'=>'', 'DELETED'=>'', 'LOCKED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'UserSiteId'=>1, 'GameStyleId'=>2, 'EventName'=>3, 'EventPlace'=>4, 'EventPosition'=>5, 'Buyin'=>6, 'Rebuy'=>7, 'Addon'=>8, 'Prize'=>9, 'PaidPlaces'=>10, 'EventDate'=>11, 'Comments'=>12, 'Players'=>13, 'Enabled'=>14, 'Visible'=>15, 'Deleted'=>16, 'Locked'=>17, 'CreatedAt'=>18, 'UpdatedAt'=>19, ),
		BasePeer::TYPE_COLNAME=>array (EventPersonalPeer::ID=>0, EventPersonalPeer::USER_SITE_ID=>1, EventPersonalPeer::GAME_STYLE_ID=>2, EventPersonalPeer::EVENT_NAME=>3, EventPersonalPeer::EVENT_PLACE=>4, EventPersonalPeer::EVENT_POSITION=>5, EventPersonalPeer::BUYIN=>6, EventPersonalPeer::REBUY=>7, EventPersonalPeer::ADDON=>8, EventPersonalPeer::PRIZE=>9, EventPersonalPeer::PAID_PLACES=>10, EventPersonalPeer::EVENT_DATE=>11, EventPersonalPeer::COMMENTS=>12, EventPersonalPeer::PLAYERS=>13, EventPersonalPeer::ENABLED=>14, EventPersonalPeer::VISIBLE=>15, EventPersonalPeer::DELETED=>16, EventPersonalPeer::LOCKED=>17, EventPersonalPeer::CREATED_AT=>18, EventPersonalPeer::UPDATED_AT=>19, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'user_site_id'=>1, 'game_style_id'=>2, 'event_name'=>3, 'event_place'=>4, 'event_position'=>5, 'buyin'=>6, 'rebuy'=>7, 'addon'=>8, 'prize'=>9, 'paid_places'=>10, 'event_date'=>11, 'comments'=>12, 'players'=>13, 'enabled'=>14, 'visible'=>15, 'deleted'=>16, 'locked'=>17, 'created_at'=>18, 'updated_at'=>19, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/EventPersonalMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.EventPersonalMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EventPersonalPeer::getTableMap();
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
		return str_replace(EventPersonalPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EventPersonalPeer::ID);

		$criteria->addSelectColumn(EventPersonalPeer::USER_SITE_ID);

		$criteria->addSelectColumn(EventPersonalPeer::GAME_STYLE_ID);

		$criteria->addSelectColumn(EventPersonalPeer::EVENT_NAME);

		$criteria->addSelectColumn(EventPersonalPeer::EVENT_PLACE);

		$criteria->addSelectColumn(EventPersonalPeer::EVENT_POSITION);

		$criteria->addSelectColumn(EventPersonalPeer::BUYIN);

		$criteria->addSelectColumn(EventPersonalPeer::REBUY);

		$criteria->addSelectColumn(EventPersonalPeer::ADDON);

		$criteria->addSelectColumn(EventPersonalPeer::PRIZE);

		$criteria->addSelectColumn(EventPersonalPeer::PAID_PLACES);

		$criteria->addSelectColumn(EventPersonalPeer::EVENT_DATE);

		$criteria->addSelectColumn(EventPersonalPeer::COMMENTS);

		$criteria->addSelectColumn(EventPersonalPeer::PLAYERS);

		$criteria->addSelectColumn(EventPersonalPeer::ENABLED);

		$criteria->addSelectColumn(EventPersonalPeer::VISIBLE);

		$criteria->addSelectColumn(EventPersonalPeer::DELETED);

		$criteria->addSelectColumn(EventPersonalPeer::LOCKED);

		$criteria->addSelectColumn(EventPersonalPeer::CREATED_AT);

		$criteria->addSelectColumn(EventPersonalPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(event_personal.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT event_personal.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPersonalPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPersonalPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EventPersonalPeer::doSelectRS($criteria, $con);
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
		$objects = EventPersonalPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EventPersonalPeer::populateObjects(EventPersonalPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EventPersonalPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EventPersonalPeer::getOMClass();
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
			$criteria->addSelectColumn(EventPersonalPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPersonalPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPersonalPeer::USER_SITE_ID, UserSitePeer::ID);

		$rs = EventPersonalPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinVirtualTable(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPersonalPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPersonalPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPersonalPeer::GAME_STYLE_ID, VirtualTablePeer::ID);

		$rs = EventPersonalPeer::doSelectRS($criteria, $con);
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

		EventPersonalPeer::addSelectColumns($c);
		$startcol = (EventPersonalPeer::NUM_COLUMNS - EventPersonalPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserSitePeer::addSelectColumns($c);

		$c->addJoin(EventPersonalPeer::USER_SITE_ID, UserSitePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPersonalPeer::getOMClass();

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
										$temp_obj2->addEventPersonal($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventPersonalList();
				$obj2->addEventPersonal($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinVirtualTable(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventPersonalPeer::addSelectColumns($c);
		$startcol = (EventPersonalPeer::NUM_COLUMNS - EventPersonalPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		VirtualTablePeer::addSelectColumns($c);

		$c->addJoin(EventPersonalPeer::GAME_STYLE_ID, VirtualTablePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPersonalPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = VirtualTablePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getVirtualTable(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEventPersonal($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventPersonalList();
				$obj2->addEventPersonal($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPersonalPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPersonalPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPersonalPeer::USER_SITE_ID, UserSitePeer::ID);

		$criteria->addJoin(EventPersonalPeer::GAME_STYLE_ID, VirtualTablePeer::ID);

		$rs = EventPersonalPeer::doSelectRS($criteria, $con);
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

		EventPersonalPeer::addSelectColumns($c);
		$startcol2 = (EventPersonalPeer::NUM_COLUMNS - EventPersonalPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserSitePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserSitePeer::NUM_COLUMNS;

		VirtualTablePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + VirtualTablePeer::NUM_COLUMNS;

		$c->addJoin(EventPersonalPeer::USER_SITE_ID, UserSitePeer::ID);

		$c->addJoin(EventPersonalPeer::GAME_STYLE_ID, VirtualTablePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPersonalPeer::getOMClass();


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
					$temp_obj2->addEventPersonal($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEventPersonalList();
				$obj2->addEventPersonal($obj1);
			}


					
			$omClass = VirtualTablePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getVirtualTable(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEventPersonal($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initEventPersonalList();
				$obj3->addEventPersonal($obj1);
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
			$criteria->addSelectColumn(EventPersonalPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPersonalPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPersonalPeer::GAME_STYLE_ID, VirtualTablePeer::ID);

		$rs = EventPersonalPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptVirtualTable(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPersonalPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPersonalPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPersonalPeer::USER_SITE_ID, UserSitePeer::ID);

		$rs = EventPersonalPeer::doSelectRS($criteria, $con);
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

		EventPersonalPeer::addSelectColumns($c);
		$startcol2 = (EventPersonalPeer::NUM_COLUMNS - EventPersonalPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		VirtualTablePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + VirtualTablePeer::NUM_COLUMNS;

		$c->addJoin(EventPersonalPeer::GAME_STYLE_ID, VirtualTablePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPersonalPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getVirtualTable(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEventPersonal($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEventPersonalList();
				$obj2->addEventPersonal($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptVirtualTable(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventPersonalPeer::addSelectColumns($c);
		$startcol2 = (EventPersonalPeer::NUM_COLUMNS - EventPersonalPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserSitePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserSitePeer::NUM_COLUMNS;

		$c->addJoin(EventPersonalPeer::USER_SITE_ID, UserSitePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPersonalPeer::getOMClass();

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
					$temp_obj2->addEventPersonal($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEventPersonalList();
				$obj2->addEventPersonal($obj1);
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
		return EventPersonalPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(EventPersonalPeer::ID); 

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
			$comparison = $criteria->getComparison(EventPersonalPeer::ID);
			$selectCriteria->add(EventPersonalPeer::ID, $criteria->remove(EventPersonalPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(EventPersonalPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EventPersonalPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof EventPersonal) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(EventPersonalPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(EventPersonal $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EventPersonalPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EventPersonalPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EventPersonalPeer::DATABASE_NAME, EventPersonalPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EventPersonalPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(EventPersonalPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(EventPersonalPeer::ID, $pk);


		$v = EventPersonalPeer::doSelect($criteria, $con);

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
			$criteria->add(EventPersonalPeer::ID, $pks, Criteria::IN);
			$objs = EventPersonalPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseEventPersonalPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/EventPersonalMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.EventPersonalMapBuilder');
}
