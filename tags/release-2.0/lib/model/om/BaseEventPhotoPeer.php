<?php


abstract class BaseEventPhotoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'event_photo';

	
	const CLASS_DEFAULT = 'lib.model.EventPhoto';

	
	const NUM_COLUMNS = 11;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'event_photo.ID';

	
	const EVENT_ID = 'event_photo.EVENT_ID';

	
	const FILE_ID = 'event_photo.FILE_ID';

	
	const PEOPLE_ID = 'event_photo.PEOPLE_ID';

	
	const IS_SHARED = 'event_photo.IS_SHARED';

	
	const WIDTH = 'event_photo.WIDTH';

	
	const HEIGHT = 'event_photo.HEIGHT';

	
	const ORIENTATION = 'event_photo.ORIENTATION';

	
	const DELETED = 'event_photo.DELETED';

	
	const CREATED_AT = 'event_photo.CREATED_AT';

	
	const UPDATED_AT = 'event_photo.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'EventId', 'FileId', 'PeopleId', 'IsShared', 'Width', 'Height', 'Orientation', 'Deleted', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (EventPhotoPeer::ID, EventPhotoPeer::EVENT_ID, EventPhotoPeer::FILE_ID, EventPhotoPeer::PEOPLE_ID, EventPhotoPeer::IS_SHARED, EventPhotoPeer::WIDTH, EventPhotoPeer::HEIGHT, EventPhotoPeer::ORIENTATION, EventPhotoPeer::DELETED, EventPhotoPeer::CREATED_AT, EventPhotoPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'event_id', 'file_id', 'people_id', 'is_shared', 'width', 'height', 'orientation', 'deleted', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'EVENT_ID'=>'', 'FILE_ID'=>'', 'PEOPLE_ID'=>'', 'IS_SHARED'=>'', 'WIDTH'=>'', 'HEIGHT'=>'', 'ORIENTATION'=>'', 'DELETED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'EventId'=>1, 'FileId'=>2, 'PeopleId'=>3, 'IsShared'=>4, 'Width'=>5, 'Height'=>6, 'Orientation'=>7, 'Deleted'=>8, 'CreatedAt'=>9, 'UpdatedAt'=>10, ),
		BasePeer::TYPE_COLNAME=>array (EventPhotoPeer::ID=>0, EventPhotoPeer::EVENT_ID=>1, EventPhotoPeer::FILE_ID=>2, EventPhotoPeer::PEOPLE_ID=>3, EventPhotoPeer::IS_SHARED=>4, EventPhotoPeer::WIDTH=>5, EventPhotoPeer::HEIGHT=>6, EventPhotoPeer::ORIENTATION=>7, EventPhotoPeer::DELETED=>8, EventPhotoPeer::CREATED_AT=>9, EventPhotoPeer::UPDATED_AT=>10, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'event_id'=>1, 'file_id'=>2, 'people_id'=>3, 'is_shared'=>4, 'width'=>5, 'height'=>6, 'orientation'=>7, 'deleted'=>8, 'created_at'=>9, 'updated_at'=>10, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/EventPhotoMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.EventPhotoMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EventPhotoPeer::getTableMap();
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
		return str_replace(EventPhotoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EventPhotoPeer::ID);

		$criteria->addSelectColumn(EventPhotoPeer::EVENT_ID);

		$criteria->addSelectColumn(EventPhotoPeer::FILE_ID);

		$criteria->addSelectColumn(EventPhotoPeer::PEOPLE_ID);

		$criteria->addSelectColumn(EventPhotoPeer::IS_SHARED);

		$criteria->addSelectColumn(EventPhotoPeer::WIDTH);

		$criteria->addSelectColumn(EventPhotoPeer::HEIGHT);

		$criteria->addSelectColumn(EventPhotoPeer::ORIENTATION);

		$criteria->addSelectColumn(EventPhotoPeer::DELETED);

		$criteria->addSelectColumn(EventPhotoPeer::CREATED_AT);

		$criteria->addSelectColumn(EventPhotoPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(event_photo.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT event_photo.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPhotoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPhotoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EventPhotoPeer::doSelectRS($criteria, $con);
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
		$objects = EventPhotoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EventPhotoPeer::populateObjects(EventPhotoPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EventPhotoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EventPhotoPeer::getOMClass();
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
			$criteria->addSelectColumn(EventPhotoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPhotoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPhotoPeer::EVENT_ID, EventPeer::ID);

		$rs = EventPhotoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinFile(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPhotoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPhotoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPhotoPeer::FILE_ID, FilePeer::ID);

		$rs = EventPhotoPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(EventPhotoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPhotoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPhotoPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = EventPhotoPeer::doSelectRS($criteria, $con);
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

		EventPhotoPeer::addSelectColumns($c);
		$startcol = (EventPhotoPeer::NUM_COLUMNS - EventPhotoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		EventPeer::addSelectColumns($c);

		$c->addJoin(EventPhotoPeer::EVENT_ID, EventPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPhotoPeer::getOMClass();

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
										$temp_obj2->addEventPhoto($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventPhotoList();
				$obj2->addEventPhoto($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinFile(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventPhotoPeer::addSelectColumns($c);
		$startcol = (EventPhotoPeer::NUM_COLUMNS - EventPhotoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		FilePeer::addSelectColumns($c);

		$c->addJoin(EventPhotoPeer::FILE_ID, FilePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPhotoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = FilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getFile(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEventPhoto($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventPhotoList();
				$obj2->addEventPhoto($obj1); 			}
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

		EventPhotoPeer::addSelectColumns($c);
		$startcol = (EventPhotoPeer::NUM_COLUMNS - EventPhotoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PeoplePeer::addSelectColumns($c);

		$c->addJoin(EventPhotoPeer::PEOPLE_ID, PeoplePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPhotoPeer::getOMClass();

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
										$temp_obj2->addEventPhoto($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventPhotoList();
				$obj2->addEventPhoto($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPhotoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPhotoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPhotoPeer::EVENT_ID, EventPeer::ID);

		$criteria->addJoin(EventPhotoPeer::FILE_ID, FilePeer::ID);

		$criteria->addJoin(EventPhotoPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = EventPhotoPeer::doSelectRS($criteria, $con);
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

		EventPhotoPeer::addSelectColumns($c);
		$startcol2 = (EventPhotoPeer::NUM_COLUMNS - EventPhotoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EventPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EventPeer::NUM_COLUMNS;

		FilePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + FilePeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(EventPhotoPeer::EVENT_ID, EventPeer::ID);

		$c->addJoin(EventPhotoPeer::FILE_ID, FilePeer::ID);

		$c->addJoin(EventPhotoPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPhotoPeer::getOMClass();


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
					$temp_obj2->addEventPhoto($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEventPhotoList();
				$obj2->addEventPhoto($obj1);
			}


					
			$omClass = FilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getFile(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEventPhoto($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initEventPhotoList();
				$obj3->addEventPhoto($obj1);
			}


					
			$omClass = PeoplePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getPeople(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addEventPhoto($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initEventPhotoList();
				$obj4->addEventPhoto($obj1);
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
			$criteria->addSelectColumn(EventPhotoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPhotoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPhotoPeer::FILE_ID, FilePeer::ID);

		$criteria->addJoin(EventPhotoPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = EventPhotoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptFile(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPhotoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPhotoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPhotoPeer::EVENT_ID, EventPeer::ID);

		$criteria->addJoin(EventPhotoPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = EventPhotoPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(EventPhotoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPhotoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPhotoPeer::EVENT_ID, EventPeer::ID);

		$criteria->addJoin(EventPhotoPeer::FILE_ID, FilePeer::ID);

		$rs = EventPhotoPeer::doSelectRS($criteria, $con);
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

		EventPhotoPeer::addSelectColumns($c);
		$startcol2 = (EventPhotoPeer::NUM_COLUMNS - EventPhotoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		FilePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + FilePeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(EventPhotoPeer::FILE_ID, FilePeer::ID);

		$c->addJoin(EventPhotoPeer::PEOPLE_ID, PeoplePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPhotoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = FilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getFile(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEventPhoto($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEventPhotoList();
				$obj2->addEventPhoto($obj1);
			}

			$omClass = PeoplePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getPeople(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEventPhoto($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initEventPhotoList();
				$obj3->addEventPhoto($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptFile(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventPhotoPeer::addSelectColumns($c);
		$startcol2 = (EventPhotoPeer::NUM_COLUMNS - EventPhotoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EventPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EventPeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(EventPhotoPeer::EVENT_ID, EventPeer::ID);

		$c->addJoin(EventPhotoPeer::PEOPLE_ID, PeoplePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPhotoPeer::getOMClass();

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
					$temp_obj2->addEventPhoto($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEventPhotoList();
				$obj2->addEventPhoto($obj1);
			}

			$omClass = PeoplePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getPeople(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEventPhoto($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initEventPhotoList();
				$obj3->addEventPhoto($obj1);
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

		EventPhotoPeer::addSelectColumns($c);
		$startcol2 = (EventPhotoPeer::NUM_COLUMNS - EventPhotoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EventPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EventPeer::NUM_COLUMNS;

		FilePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + FilePeer::NUM_COLUMNS;

		$c->addJoin(EventPhotoPeer::EVENT_ID, EventPeer::ID);

		$c->addJoin(EventPhotoPeer::FILE_ID, FilePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPhotoPeer::getOMClass();

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
					$temp_obj2->addEventPhoto($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEventPhotoList();
				$obj2->addEventPhoto($obj1);
			}

			$omClass = FilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getFile(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEventPhoto($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initEventPhotoList();
				$obj3->addEventPhoto($obj1);
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
		return EventPhotoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(EventPhotoPeer::ID); 

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
			$comparison = $criteria->getComparison(EventPhotoPeer::ID);
			$selectCriteria->add(EventPhotoPeer::ID, $criteria->remove(EventPhotoPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(EventPhotoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EventPhotoPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof EventPhoto) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(EventPhotoPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(EventPhoto $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EventPhotoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EventPhotoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EventPhotoPeer::DATABASE_NAME, EventPhotoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EventPhotoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(EventPhotoPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(EventPhotoPeer::ID, $pk);


		$v = EventPhotoPeer::doSelect($criteria, $con);

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
			$criteria->add(EventPhotoPeer::ID, $pks, Criteria::IN);
			$objs = EventPhotoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseEventPhotoPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/EventPhotoMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.EventPhotoMapBuilder');
}
