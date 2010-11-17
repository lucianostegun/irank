<?php


abstract class BaseRankingMemberPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'ranking_member';

	
	const CLASS_DEFAULT = 'lib.model.RankingMember';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const RANKING_ID = 'ranking_member.RANKING_ID';

	
	const PEOPLE_ID = 'ranking_member.PEOPLE_ID';

	
	const EVENTS = 'ranking_member.EVENTS';

	
	const SCORE = 'ranking_member.SCORE';

	
	const TOTAL_PAID = 'ranking_member.TOTAL_PAID';

	
	const TOTAL_PRIZE = 'ranking_member.TOTAL_PRIZE';

	
	const BALANCE = 'ranking_member.BALANCE';

	
	const ENABLED = 'ranking_member.ENABLED';

	
	const CREATED_AT = 'ranking_member.CREATED_AT';

	
	const UPDATED_AT = 'ranking_member.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('RankingId', 'PeopleId', 'Events', 'Score', 'TotalPaid', 'TotalPrize', 'Balance', 'Enabled', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (RankingMemberPeer::RANKING_ID, RankingMemberPeer::PEOPLE_ID, RankingMemberPeer::EVENTS, RankingMemberPeer::SCORE, RankingMemberPeer::TOTAL_PAID, RankingMemberPeer::TOTAL_PRIZE, RankingMemberPeer::BALANCE, RankingMemberPeer::ENABLED, RankingMemberPeer::CREATED_AT, RankingMemberPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('ranking_id', 'people_id', 'events', 'score', 'total_paid', 'total_prize', 'balance', 'enabled', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('RANKING_ID'=>'', 'PEOPLE_ID'=>'', 'EVENTS'=>'', 'SCORE'=>'', 'TOTAL_PAID'=>'', 'TOTAL_PRIZE'=>'', 'BALANCE'=>'', 'ENABLED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('RankingId'=>0, 'PeopleId'=>1, 'Events'=>2, 'Score'=>3, 'TotalPaid'=>4, 'TotalPrize'=>5, 'Balance'=>6, 'Enabled'=>7, 'CreatedAt'=>8, 'UpdatedAt'=>9, ),
		BasePeer::TYPE_COLNAME=>array (RankingMemberPeer::RANKING_ID=>0, RankingMemberPeer::PEOPLE_ID=>1, RankingMemberPeer::EVENTS=>2, RankingMemberPeer::SCORE=>3, RankingMemberPeer::TOTAL_PAID=>4, RankingMemberPeer::TOTAL_PRIZE=>5, RankingMemberPeer::BALANCE=>6, RankingMemberPeer::ENABLED=>7, RankingMemberPeer::CREATED_AT=>8, RankingMemberPeer::UPDATED_AT=>9, ),
		BasePeer::TYPE_FIELDNAME=>array ('ranking_id'=>0, 'people_id'=>1, 'events'=>2, 'score'=>3, 'total_paid'=>4, 'total_prize'=>5, 'balance'=>6, 'enabled'=>7, 'created_at'=>8, 'updated_at'=>9, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/RankingMemberMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.RankingMemberMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = RankingMemberPeer::getTableMap();
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
		return str_replace(RankingMemberPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(RankingMemberPeer::RANKING_ID);

		$criteria->addSelectColumn(RankingMemberPeer::PEOPLE_ID);

		$criteria->addSelectColumn(RankingMemberPeer::EVENTS);

		$criteria->addSelectColumn(RankingMemberPeer::SCORE);

		$criteria->addSelectColumn(RankingMemberPeer::TOTAL_PAID);

		$criteria->addSelectColumn(RankingMemberPeer::TOTAL_PRIZE);

		$criteria->addSelectColumn(RankingMemberPeer::BALANCE);

		$criteria->addSelectColumn(RankingMemberPeer::ENABLED);

		$criteria->addSelectColumn(RankingMemberPeer::CREATED_AT);

		$criteria->addSelectColumn(RankingMemberPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(ranking_member.RANKING_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT ranking_member.RANKING_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingMemberPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingMemberPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = RankingMemberPeer::doSelectRS($criteria, $con);
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
		$objects = RankingMemberPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return RankingMemberPeer::populateObjects(RankingMemberPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			RankingMemberPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = RankingMemberPeer::getOMClass();
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
			$criteria->addSelectColumn(RankingMemberPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingMemberPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingMemberPeer::RANKING_ID, RankingPeer::ID);

		$rs = RankingMemberPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(RankingMemberPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingMemberPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingMemberPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = RankingMemberPeer::doSelectRS($criteria, $con);
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

		RankingMemberPeer::addSelectColumns($c);
		$startcol = (RankingMemberPeer::NUM_COLUMNS - RankingMemberPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		RankingPeer::addSelectColumns($c);

		$c->addJoin(RankingMemberPeer::RANKING_ID, RankingPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingMemberPeer::getOMClass();

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
										$temp_obj2->addRankingMember($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRankingMemberList();
				$obj2->addRankingMember($obj1); 			}
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

		RankingMemberPeer::addSelectColumns($c);
		$startcol = (RankingMemberPeer::NUM_COLUMNS - RankingMemberPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PeoplePeer::addSelectColumns($c);

		$c->addJoin(RankingMemberPeer::PEOPLE_ID, PeoplePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingMemberPeer::getOMClass();

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
										$temp_obj2->addRankingMember($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRankingMemberList();
				$obj2->addRankingMember($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingMemberPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingMemberPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingMemberPeer::RANKING_ID, RankingPeer::ID);

		$criteria->addJoin(RankingMemberPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = RankingMemberPeer::doSelectRS($criteria, $con);
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

		RankingMemberPeer::addSelectColumns($c);
		$startcol2 = (RankingMemberPeer::NUM_COLUMNS - RankingMemberPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RankingPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RankingPeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(RankingMemberPeer::RANKING_ID, RankingPeer::ID);

		$c->addJoin(RankingMemberPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingMemberPeer::getOMClass();


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
					$temp_obj2->addRankingMember($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initRankingMemberList();
				$obj2->addRankingMember($obj1);
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
					$temp_obj3->addRankingMember($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initRankingMemberList();
				$obj3->addRankingMember($obj1);
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
			$criteria->addSelectColumn(RankingMemberPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingMemberPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingMemberPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = RankingMemberPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(RankingMemberPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingMemberPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingMemberPeer::RANKING_ID, RankingPeer::ID);

		$rs = RankingMemberPeer::doSelectRS($criteria, $con);
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

		RankingMemberPeer::addSelectColumns($c);
		$startcol2 = (RankingMemberPeer::NUM_COLUMNS - RankingMemberPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PeoplePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(RankingMemberPeer::PEOPLE_ID, PeoplePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingMemberPeer::getOMClass();

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
					$temp_obj2->addRankingMember($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRankingMemberList();
				$obj2->addRankingMember($obj1);
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

		RankingMemberPeer::addSelectColumns($c);
		$startcol2 = (RankingMemberPeer::NUM_COLUMNS - RankingMemberPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RankingPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RankingPeer::NUM_COLUMNS;

		$c->addJoin(RankingMemberPeer::RANKING_ID, RankingPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingMemberPeer::getOMClass();

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
					$temp_obj2->addRankingMember($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRankingMemberList();
				$obj2->addRankingMember($obj1);
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
		return RankingMemberPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(RankingMemberPeer::RANKING_ID);
			$selectCriteria->add(RankingMemberPeer::RANKING_ID, $criteria->remove(RankingMemberPeer::RANKING_ID), $comparison);

			$comparison = $criteria->getComparison(RankingMemberPeer::PEOPLE_ID);
			$selectCriteria->add(RankingMemberPeer::PEOPLE_ID, $criteria->remove(RankingMemberPeer::PEOPLE_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(RankingMemberPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(RankingMemberPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof RankingMember) {

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

			$criteria->add(RankingMemberPeer::RANKING_ID, $vals[0], Criteria::IN);
			$criteria->add(RankingMemberPeer::PEOPLE_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(RankingMember $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RankingMemberPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RankingMemberPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(RankingMemberPeer::DATABASE_NAME, RankingMemberPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RankingMemberPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $ranking_id, $people_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(RankingMemberPeer::RANKING_ID, $ranking_id);
		$criteria->add(RankingMemberPeer::PEOPLE_ID, $people_id);
		$v = RankingMemberPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseRankingMemberPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/RankingMemberMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.RankingMemberMapBuilder');
}
