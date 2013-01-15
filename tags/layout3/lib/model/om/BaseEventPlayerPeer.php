<?php


abstract class BaseEventPlayerPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'event_player';

	
	const CLASS_DEFAULT = 'lib.model.EventPlayer';

	
	const NUM_COLUMNS = 18;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const EVENT_ID = 'event_player.EVENT_ID';

	
	const PEOPLE_ID = 'event_player.PEOPLE_ID';

	
	const SHARE_ID = 'event_player.SHARE_ID';

	
	const ENTRANCE_FEE = 'event_player.ENTRANCE_FEE';

	
	const BUYIN = 'event_player.BUYIN';

	
	const REBUY = 'event_player.REBUY';

	
	const ADDON = 'event_player.ADDON';

	
	const EVENT_POSITION = 'event_player.EVENT_POSITION';

	
	const SCORE = 'event_player.SCORE';

	
	const PRIZE = 'event_player.PRIZE';

	
	const CONFIRM_CODE = 'event_player.CONFIRM_CODE';

	
	const INVITE_STATUS = 'event_player.INVITE_STATUS';

	
	const ALLOW_EDIT = 'event_player.ALLOW_EDIT';

	
	const SUPPRESS_NOTIFY = 'event_player.SUPPRESS_NOTIFY';

	
	const ENABLED = 'event_player.ENABLED';

	
	const DELETED = 'event_player.DELETED';

	
	const CREATED_AT = 'event_player.CREATED_AT';

	
	const UPDATED_AT = 'event_player.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('EventId', 'PeopleId', 'ShareId', 'EntranceFee', 'Buyin', 'Rebuy', 'Addon', 'EventPosition', 'Score', 'Prize', 'ConfirmCode', 'InviteStatus', 'AllowEdit', 'SuppressNotify', 'Enabled', 'Deleted', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (EventPlayerPeer::EVENT_ID, EventPlayerPeer::PEOPLE_ID, EventPlayerPeer::SHARE_ID, EventPlayerPeer::ENTRANCE_FEE, EventPlayerPeer::BUYIN, EventPlayerPeer::REBUY, EventPlayerPeer::ADDON, EventPlayerPeer::EVENT_POSITION, EventPlayerPeer::SCORE, EventPlayerPeer::PRIZE, EventPlayerPeer::CONFIRM_CODE, EventPlayerPeer::INVITE_STATUS, EventPlayerPeer::ALLOW_EDIT, EventPlayerPeer::SUPPRESS_NOTIFY, EventPlayerPeer::ENABLED, EventPlayerPeer::DELETED, EventPlayerPeer::CREATED_AT, EventPlayerPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('event_id', 'people_id', 'share_id', 'entrance_fee', 'buyin', 'rebuy', 'addon', 'event_position', 'score', 'prize', 'confirm_code', 'invite_status', 'allow_edit', 'suppress_notify', 'enabled', 'deleted', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('EVENT_ID'=>'', 'PEOPLE_ID'=>'', 'SHARE_ID'=>'', 'ENTRANCE_FEE'=>'', 'BUYIN'=>'', 'REBUY'=>'', 'ADDON'=>'', 'EVENT_POSITION'=>'', 'SCORE'=>'', 'PRIZE'=>'', 'CONFIRM_CODE'=>'', 'INVITE_STATUS'=>'', 'ALLOW_EDIT'=>'', 'SUPPRESS_NOTIFY'=>'', 'ENABLED'=>'', 'DELETED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('EventId'=>0, 'PeopleId'=>1, 'ShareId'=>2, 'EntranceFee'=>3, 'Buyin'=>4, 'Rebuy'=>5, 'Addon'=>6, 'EventPosition'=>7, 'Score'=>8, 'Prize'=>9, 'ConfirmCode'=>10, 'InviteStatus'=>11, 'AllowEdit'=>12, 'SuppressNotify'=>13, 'Enabled'=>14, 'Deleted'=>15, 'CreatedAt'=>16, 'UpdatedAt'=>17, ),
		BasePeer::TYPE_COLNAME=>array (EventPlayerPeer::EVENT_ID=>0, EventPlayerPeer::PEOPLE_ID=>1, EventPlayerPeer::SHARE_ID=>2, EventPlayerPeer::ENTRANCE_FEE=>3, EventPlayerPeer::BUYIN=>4, EventPlayerPeer::REBUY=>5, EventPlayerPeer::ADDON=>6, EventPlayerPeer::EVENT_POSITION=>7, EventPlayerPeer::SCORE=>8, EventPlayerPeer::PRIZE=>9, EventPlayerPeer::CONFIRM_CODE=>10, EventPlayerPeer::INVITE_STATUS=>11, EventPlayerPeer::ALLOW_EDIT=>12, EventPlayerPeer::SUPPRESS_NOTIFY=>13, EventPlayerPeer::ENABLED=>14, EventPlayerPeer::DELETED=>15, EventPlayerPeer::CREATED_AT=>16, EventPlayerPeer::UPDATED_AT=>17, ),
		BasePeer::TYPE_FIELDNAME=>array ('event_id'=>0, 'people_id'=>1, 'share_id'=>2, 'entrance_fee'=>3, 'buyin'=>4, 'rebuy'=>5, 'addon'=>6, 'event_position'=>7, 'score'=>8, 'prize'=>9, 'confirm_code'=>10, 'invite_status'=>11, 'allow_edit'=>12, 'suppress_notify'=>13, 'enabled'=>14, 'deleted'=>15, 'created_at'=>16, 'updated_at'=>17, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/EventPlayerMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.EventPlayerMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EventPlayerPeer::getTableMap();
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
		return str_replace(EventPlayerPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EventPlayerPeer::EVENT_ID);

		$criteria->addSelectColumn(EventPlayerPeer::PEOPLE_ID);

		$criteria->addSelectColumn(EventPlayerPeer::SHARE_ID);

		$criteria->addSelectColumn(EventPlayerPeer::ENTRANCE_FEE);

		$criteria->addSelectColumn(EventPlayerPeer::BUYIN);

		$criteria->addSelectColumn(EventPlayerPeer::REBUY);

		$criteria->addSelectColumn(EventPlayerPeer::ADDON);

		$criteria->addSelectColumn(EventPlayerPeer::EVENT_POSITION);

		$criteria->addSelectColumn(EventPlayerPeer::SCORE);

		$criteria->addSelectColumn(EventPlayerPeer::PRIZE);

		$criteria->addSelectColumn(EventPlayerPeer::CONFIRM_CODE);

		$criteria->addSelectColumn(EventPlayerPeer::INVITE_STATUS);

		$criteria->addSelectColumn(EventPlayerPeer::ALLOW_EDIT);

		$criteria->addSelectColumn(EventPlayerPeer::SUPPRESS_NOTIFY);

		$criteria->addSelectColumn(EventPlayerPeer::ENABLED);

		$criteria->addSelectColumn(EventPlayerPeer::DELETED);

		$criteria->addSelectColumn(EventPlayerPeer::CREATED_AT);

		$criteria->addSelectColumn(EventPlayerPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(event_player.EVENT_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT event_player.EVENT_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EventPlayerPeer::doSelectRS($criteria, $con);
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
		$objects = EventPlayerPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EventPlayerPeer::populateObjects(EventPlayerPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EventPlayerPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EventPlayerPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinEvent(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPlayerPeer::EVENT_ID, EventPeer::ID);

		$rs = EventPlayerPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(EventPlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPlayerPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = EventPlayerPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinEvent(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventPlayerPeer::addSelectColumns($c);
		$startcol = (EventPlayerPeer::NUM_COLUMNS - EventPlayerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		EventPeer::addSelectColumns($c);

		$c->addJoin(EventPlayerPeer::EVENT_ID, EventPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPlayerPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EventPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getEvent(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEventPlayer($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventPlayerList();
				$obj2->addEventPlayer($obj1); 			}
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

		EventPlayerPeer::addSelectColumns($c);
		$startcol = (EventPlayerPeer::NUM_COLUMNS - EventPlayerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PeoplePeer::addSelectColumns($c);

		$c->addJoin(EventPlayerPeer::PEOPLE_ID, PeoplePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPlayerPeer::getOMClass();

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
										$temp_obj2->addEventPlayer($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventPlayerList();
				$obj2->addEventPlayer($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPlayerPeer::EVENT_ID, EventPeer::ID);

		$criteria->addJoin(EventPlayerPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = EventPlayerPeer::doSelectRS($criteria, $con);
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

		EventPlayerPeer::addSelectColumns($c);
		$startcol2 = (EventPlayerPeer::NUM_COLUMNS - EventPlayerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EventPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EventPeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(EventPlayerPeer::EVENT_ID, EventPeer::ID);

		$c->addJoin(EventPlayerPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPlayerPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = EventPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getEvent(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEventPlayer($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEventPlayerList();
				$obj2->addEventPlayer($obj1);
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
					$temp_obj3->addEventPlayer($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initEventPlayerList();
				$obj3->addEventPlayer($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptEvent(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPlayerPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = EventPlayerPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(EventPlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPlayerPeer::EVENT_ID, EventPeer::ID);

		$rs = EventPlayerPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptEvent(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventPlayerPeer::addSelectColumns($c);
		$startcol2 = (EventPlayerPeer::NUM_COLUMNS - EventPlayerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PeoplePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(EventPlayerPeer::PEOPLE_ID, PeoplePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPlayerPeer::getOMClass();

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
					$temp_obj2->addEventPlayer($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEventPlayerList();
				$obj2->addEventPlayer($obj1);
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

		EventPlayerPeer::addSelectColumns($c);
		$startcol2 = (EventPlayerPeer::NUM_COLUMNS - EventPlayerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EventPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EventPeer::NUM_COLUMNS;

		$c->addJoin(EventPlayerPeer::EVENT_ID, EventPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPlayerPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EventPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getEvent(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEventPlayer($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEventPlayerList();
				$obj2->addEventPlayer($obj1);
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
		return EventPlayerPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(EventPlayerPeer::EVENT_ID);
			$selectCriteria->add(EventPlayerPeer::EVENT_ID, $criteria->remove(EventPlayerPeer::EVENT_ID), $comparison);

			$comparison = $criteria->getComparison(EventPlayerPeer::PEOPLE_ID);
			$selectCriteria->add(EventPlayerPeer::PEOPLE_ID, $criteria->remove(EventPlayerPeer::PEOPLE_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(EventPlayerPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EventPlayerPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof EventPlayer) {

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

			$criteria->add(EventPlayerPeer::EVENT_ID, $vals[0], Criteria::IN);
			$criteria->add(EventPlayerPeer::PEOPLE_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(EventPlayer $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EventPlayerPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EventPlayerPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EventPlayerPeer::DATABASE_NAME, EventPlayerPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EventPlayerPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $event_id, $people_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(EventPlayerPeer::EVENT_ID, $event_id);
		$criteria->add(EventPlayerPeer::PEOPLE_ID, $people_id);
		$v = EventPlayerPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseEventPlayerPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/EventPlayerMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.EventPlayerMapBuilder');
}
