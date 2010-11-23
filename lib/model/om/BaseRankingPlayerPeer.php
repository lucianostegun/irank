<?php


abstract class BaseRankingPlayerPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'ranking_player';

	
	const CLASS_DEFAULT = 'lib.model.RankingPlayer';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const RANKING_ID = 'ranking_player.RANKING_ID';

	
	const PEOPLE_ID = 'ranking_player.PEOPLE_ID';

	
	const EVENTS = 'ranking_player.EVENTS';

	
	const SCORE = 'ranking_player.SCORE';

	
	const TOTAL_PAID = 'ranking_player.TOTAL_PAID';

	
	const TOTAL_PRIZE = 'ranking_player.TOTAL_PRIZE';

	
	const BALANCE = 'ranking_player.BALANCE';

	
	const ENABLED = 'ranking_player.ENABLED';

	
	const CREATED_AT = 'ranking_player.CREATED_AT';

	
	const UPDATED_AT = 'ranking_player.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('RankingId', 'PeopleId', 'Events', 'Score', 'TotalPaid', 'TotalPrize', 'Balance', 'Enabled', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (RankingPlayerPeer::RANKING_ID, RankingPlayerPeer::PEOPLE_ID, RankingPlayerPeer::EVENTS, RankingPlayerPeer::SCORE, RankingPlayerPeer::TOTAL_PAID, RankingPlayerPeer::TOTAL_PRIZE, RankingPlayerPeer::BALANCE, RankingPlayerPeer::ENABLED, RankingPlayerPeer::CREATED_AT, RankingPlayerPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('ranking_id', 'people_id', 'events', 'score', 'total_paid', 'total_prize', 'balance', 'enabled', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('RANKING_ID'=>'', 'PEOPLE_ID'=>'', 'EVENTS'=>'', 'SCORE'=>'', 'TOTAL_PAID'=>'', 'TOTAL_PRIZE'=>'', 'BALANCE'=>'', 'ENABLED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('RankingId'=>0, 'PeopleId'=>1, 'Events'=>2, 'Score'=>3, 'TotalPaid'=>4, 'TotalPrize'=>5, 'Balance'=>6, 'Enabled'=>7, 'CreatedAt'=>8, 'UpdatedAt'=>9, ),
		BasePeer::TYPE_COLNAME=>array (RankingPlayerPeer::RANKING_ID=>0, RankingPlayerPeer::PEOPLE_ID=>1, RankingPlayerPeer::EVENTS=>2, RankingPlayerPeer::SCORE=>3, RankingPlayerPeer::TOTAL_PAID=>4, RankingPlayerPeer::TOTAL_PRIZE=>5, RankingPlayerPeer::BALANCE=>6, RankingPlayerPeer::ENABLED=>7, RankingPlayerPeer::CREATED_AT=>8, RankingPlayerPeer::UPDATED_AT=>9, ),
		BasePeer::TYPE_FIELDNAME=>array ('ranking_id'=>0, 'people_id'=>1, 'events'=>2, 'score'=>3, 'total_paid'=>4, 'total_prize'=>5, 'balance'=>6, 'enabled'=>7, 'created_at'=>8, 'updated_at'=>9, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/RankingPlayerMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.RankingPlayerMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = RankingPlayerPeer::getTableMap();
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
		return str_replace(RankingPlayerPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(RankingPlayerPeer::RANKING_ID);

		$criteria->addSelectColumn(RankingPlayerPeer::PEOPLE_ID);

		$criteria->addSelectColumn(RankingPlayerPeer::EVENTS);

		$criteria->addSelectColumn(RankingPlayerPeer::SCORE);

		$criteria->addSelectColumn(RankingPlayerPeer::TOTAL_PAID);

		$criteria->addSelectColumn(RankingPlayerPeer::TOTAL_PRIZE);

		$criteria->addSelectColumn(RankingPlayerPeer::BALANCE);

		$criteria->addSelectColumn(RankingPlayerPeer::ENABLED);

		$criteria->addSelectColumn(RankingPlayerPeer::CREATED_AT);

		$criteria->addSelectColumn(RankingPlayerPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(ranking_player.RANKING_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT ranking_player.RANKING_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingPlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingPlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = RankingPlayerPeer::doSelectRS($criteria, $con);
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
		$objects = RankingPlayerPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return RankingPlayerPeer::populateObjects(RankingPlayerPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			RankingPlayerPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = RankingPlayerPeer::getOMClass();
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
			$criteria->addSelectColumn(RankingPlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingPlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingPlayerPeer::RANKING_ID, RankingPeer::ID);

		$rs = RankingPlayerPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(RankingPlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingPlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingPlayerPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = RankingPlayerPeer::doSelectRS($criteria, $con);
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

		RankingPlayerPeer::addSelectColumns($c);
		$startcol = (RankingPlayerPeer::NUM_COLUMNS - RankingPlayerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		RankingPeer::addSelectColumns($c);

		$c->addJoin(RankingPlayerPeer::RANKING_ID, RankingPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingPlayerPeer::getOMClass();

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
										$temp_obj2->addRankingPlayer($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRankingPlayerList();
				$obj2->addRankingPlayer($obj1); 			}
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

		RankingPlayerPeer::addSelectColumns($c);
		$startcol = (RankingPlayerPeer::NUM_COLUMNS - RankingPlayerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PeoplePeer::addSelectColumns($c);

		$c->addJoin(RankingPlayerPeer::PEOPLE_ID, PeoplePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingPlayerPeer::getOMClass();

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
										$temp_obj2->addRankingPlayer($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRankingPlayerList();
				$obj2->addRankingPlayer($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingPlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingPlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingPlayerPeer::RANKING_ID, RankingPeer::ID);

		$criteria->addJoin(RankingPlayerPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = RankingPlayerPeer::doSelectRS($criteria, $con);
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

		RankingPlayerPeer::addSelectColumns($c);
		$startcol2 = (RankingPlayerPeer::NUM_COLUMNS - RankingPlayerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RankingPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RankingPeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(RankingPlayerPeer::RANKING_ID, RankingPeer::ID);

		$c->addJoin(RankingPlayerPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingPlayerPeer::getOMClass();


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
					$temp_obj2->addRankingPlayer($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initRankingPlayerList();
				$obj2->addRankingPlayer($obj1);
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
					$temp_obj3->addRankingPlayer($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initRankingPlayerList();
				$obj3->addRankingPlayer($obj1);
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
			$criteria->addSelectColumn(RankingPlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingPlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingPlayerPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = RankingPlayerPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(RankingPlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingPlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingPlayerPeer::RANKING_ID, RankingPeer::ID);

		$rs = RankingPlayerPeer::doSelectRS($criteria, $con);
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

		RankingPlayerPeer::addSelectColumns($c);
		$startcol2 = (RankingPlayerPeer::NUM_COLUMNS - RankingPlayerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PeoplePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(RankingPlayerPeer::PEOPLE_ID, PeoplePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingPlayerPeer::getOMClass();

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
					$temp_obj2->addRankingPlayer($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRankingPlayerList();
				$obj2->addRankingPlayer($obj1);
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

		RankingPlayerPeer::addSelectColumns($c);
		$startcol2 = (RankingPlayerPeer::NUM_COLUMNS - RankingPlayerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RankingPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RankingPeer::NUM_COLUMNS;

		$c->addJoin(RankingPlayerPeer::RANKING_ID, RankingPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingPlayerPeer::getOMClass();

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
					$temp_obj2->addRankingPlayer($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRankingPlayerList();
				$obj2->addRankingPlayer($obj1);
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
		return RankingPlayerPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(RankingPlayerPeer::RANKING_ID);
			$selectCriteria->add(RankingPlayerPeer::RANKING_ID, $criteria->remove(RankingPlayerPeer::RANKING_ID), $comparison);

			$comparison = $criteria->getComparison(RankingPlayerPeer::PEOPLE_ID);
			$selectCriteria->add(RankingPlayerPeer::PEOPLE_ID, $criteria->remove(RankingPlayerPeer::PEOPLE_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(RankingPlayerPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(RankingPlayerPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof RankingPlayer) {

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

			$criteria->add(RankingPlayerPeer::RANKING_ID, $vals[0], Criteria::IN);
			$criteria->add(RankingPlayerPeer::PEOPLE_ID, $vals[1], Criteria::IN);
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

	
	public static function doValidate(RankingPlayer $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RankingPlayerPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RankingPlayerPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(RankingPlayerPeer::DATABASE_NAME, RankingPlayerPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RankingPlayerPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
		$criteria->add(RankingPlayerPeer::RANKING_ID, $ranking_id);
		$criteria->add(RankingPlayerPeer::PEOPLE_ID, $people_id);
		$v = RankingPlayerPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseRankingPlayerPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/RankingPlayerMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.RankingPlayerMapBuilder');
}
