<?php


abstract class BaseEventPhotoCommentPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'event_photo_comment';

	
	const CLASS_DEFAULT = 'lib.model.EventPhotoComment';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'event_photo_comment.ID';

	
	const EVENT_PHOTO_ID = 'event_photo_comment.EVENT_PHOTO_ID';

	
	const PEOPLE_ID = 'event_photo_comment.PEOPLE_ID';

	
	const COMMENT = 'event_photo_comment.COMMENT';

	
	const DELETED = 'event_photo_comment.DELETED';

	
	const CREATED_AT = 'event_photo_comment.CREATED_AT';

	
	const UPDATED_AT = 'event_photo_comment.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'EventPhotoId', 'PeopleId', 'Comment', 'Deleted', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (EventPhotoCommentPeer::ID, EventPhotoCommentPeer::EVENT_PHOTO_ID, EventPhotoCommentPeer::PEOPLE_ID, EventPhotoCommentPeer::COMMENT, EventPhotoCommentPeer::DELETED, EventPhotoCommentPeer::CREATED_AT, EventPhotoCommentPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'event_photo_id', 'people_id', 'comment', 'deleted', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'EVENT_PHOTO_ID'=>'', 'PEOPLE_ID'=>'', 'COMMENT'=>'', 'DELETED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'EventPhotoId'=>1, 'PeopleId'=>2, 'Comment'=>3, 'Deleted'=>4, 'CreatedAt'=>5, 'UpdatedAt'=>6, ),
		BasePeer::TYPE_COLNAME=>array (EventPhotoCommentPeer::ID=>0, EventPhotoCommentPeer::EVENT_PHOTO_ID=>1, EventPhotoCommentPeer::PEOPLE_ID=>2, EventPhotoCommentPeer::COMMENT=>3, EventPhotoCommentPeer::DELETED=>4, EventPhotoCommentPeer::CREATED_AT=>5, EventPhotoCommentPeer::UPDATED_AT=>6, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'event_photo_id'=>1, 'people_id'=>2, 'comment'=>3, 'deleted'=>4, 'created_at'=>5, 'updated_at'=>6, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/EventPhotoCommentMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.EventPhotoCommentMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EventPhotoCommentPeer::getTableMap();
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
		return str_replace(EventPhotoCommentPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EventPhotoCommentPeer::ID);

		$criteria->addSelectColumn(EventPhotoCommentPeer::EVENT_PHOTO_ID);

		$criteria->addSelectColumn(EventPhotoCommentPeer::PEOPLE_ID);

		$criteria->addSelectColumn(EventPhotoCommentPeer::COMMENT);

		$criteria->addSelectColumn(EventPhotoCommentPeer::DELETED);

		$criteria->addSelectColumn(EventPhotoCommentPeer::CREATED_AT);

		$criteria->addSelectColumn(EventPhotoCommentPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(event_photo_comment.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT event_photo_comment.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPhotoCommentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPhotoCommentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EventPhotoCommentPeer::doSelectRS($criteria, $con);
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
		$objects = EventPhotoCommentPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EventPhotoCommentPeer::populateObjects(EventPhotoCommentPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EventPhotoCommentPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EventPhotoCommentPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinEventPhoto(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPhotoCommentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPhotoCommentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPhotoCommentPeer::EVENT_PHOTO_ID, EventPhotoPeer::ID);

		$rs = EventPhotoCommentPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(EventPhotoCommentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPhotoCommentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPhotoCommentPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = EventPhotoCommentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinEventPhoto(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventPhotoCommentPeer::addSelectColumns($c);
		$startcol = (EventPhotoCommentPeer::NUM_COLUMNS - EventPhotoCommentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		EventPhotoPeer::addSelectColumns($c);

		$c->addJoin(EventPhotoCommentPeer::EVENT_PHOTO_ID, EventPhotoPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPhotoCommentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EventPhotoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getEventPhoto(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEventPhotoComment($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventPhotoCommentList();
				$obj2->addEventPhotoComment($obj1); 			}
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

		EventPhotoCommentPeer::addSelectColumns($c);
		$startcol = (EventPhotoCommentPeer::NUM_COLUMNS - EventPhotoCommentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PeoplePeer::addSelectColumns($c);

		$c->addJoin(EventPhotoCommentPeer::PEOPLE_ID, PeoplePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPhotoCommentPeer::getOMClass();

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
										$temp_obj2->addEventPhotoComment($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventPhotoCommentList();
				$obj2->addEventPhotoComment($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPhotoCommentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPhotoCommentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPhotoCommentPeer::EVENT_PHOTO_ID, EventPhotoPeer::ID);

		$criteria->addJoin(EventPhotoCommentPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = EventPhotoCommentPeer::doSelectRS($criteria, $con);
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

		EventPhotoCommentPeer::addSelectColumns($c);
		$startcol2 = (EventPhotoCommentPeer::NUM_COLUMNS - EventPhotoCommentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EventPhotoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EventPhotoPeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(EventPhotoCommentPeer::EVENT_PHOTO_ID, EventPhotoPeer::ID);

		$c->addJoin(EventPhotoCommentPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPhotoCommentPeer::getOMClass();


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
				$temp_obj2 = $temp_obj1->getEventPhoto(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEventPhotoComment($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEventPhotoCommentList();
				$obj2->addEventPhotoComment($obj1);
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
					$temp_obj3->addEventPhotoComment($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initEventPhotoCommentList();
				$obj3->addEventPhotoComment($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptEventPhoto(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPhotoCommentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPhotoCommentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPhotoCommentPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = EventPhotoCommentPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(EventPhotoCommentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPhotoCommentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPhotoCommentPeer::EVENT_PHOTO_ID, EventPhotoPeer::ID);

		$rs = EventPhotoCommentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptEventPhoto(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventPhotoCommentPeer::addSelectColumns($c);
		$startcol2 = (EventPhotoCommentPeer::NUM_COLUMNS - EventPhotoCommentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PeoplePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(EventPhotoCommentPeer::PEOPLE_ID, PeoplePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPhotoCommentPeer::getOMClass();

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
					$temp_obj2->addEventPhotoComment($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEventPhotoCommentList();
				$obj2->addEventPhotoComment($obj1);
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

		EventPhotoCommentPeer::addSelectColumns($c);
		$startcol2 = (EventPhotoCommentPeer::NUM_COLUMNS - EventPhotoCommentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		EventPhotoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + EventPhotoPeer::NUM_COLUMNS;

		$c->addJoin(EventPhotoCommentPeer::EVENT_PHOTO_ID, EventPhotoPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPhotoCommentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = EventPhotoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getEventPhoto(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEventPhotoComment($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEventPhotoCommentList();
				$obj2->addEventPhotoComment($obj1);
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
		return EventPhotoCommentPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(EventPhotoCommentPeer::ID); 

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
			$comparison = $criteria->getComparison(EventPhotoCommentPeer::ID);
			$selectCriteria->add(EventPhotoCommentPeer::ID, $criteria->remove(EventPhotoCommentPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(EventPhotoCommentPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EventPhotoCommentPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof EventPhotoComment) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(EventPhotoCommentPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(EventPhotoComment $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EventPhotoCommentPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EventPhotoCommentPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EventPhotoCommentPeer::DATABASE_NAME, EventPhotoCommentPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EventPhotoCommentPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(EventPhotoCommentPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(EventPhotoCommentPeer::ID, $pk);


		$v = EventPhotoCommentPeer::doSelect($criteria, $con);

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
			$criteria->add(EventPhotoCommentPeer::ID, $pks, Criteria::IN);
			$objs = EventPhotoCommentPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseEventPhotoCommentPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/EventPhotoCommentMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.EventPhotoCommentMapBuilder');
}
