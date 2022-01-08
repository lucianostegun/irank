<?php


abstract class BaseRankingLiveTemplatePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'ranking_live_template';

	
	const CLASS_DEFAULT = '...apps.backend.lib.model.RankingLiveTemplate';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const RANKING_LIVE_ID = 'ranking_live_template.RANKING_LIVE_ID';

	
	const DAYS_AFTER = 'ranking_live_template.DAYS_AFTER';

	
	const START_TIME = 'ranking_live_template.START_TIME';

	
	const STEP_DAY = 'ranking_live_template.STEP_DAY';

	
	const IS_SATELLITE = 'ranking_live_template.IS_SATELLITE';

	
	const CREATED_AT = 'ranking_live_template.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('RankingLiveId', 'DaysAfter', 'StartTime', 'StepDay', 'IsSatellite', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME=>array (RankingLiveTemplatePeer::RANKING_LIVE_ID, RankingLiveTemplatePeer::DAYS_AFTER, RankingLiveTemplatePeer::START_TIME, RankingLiveTemplatePeer::STEP_DAY, RankingLiveTemplatePeer::IS_SATELLITE, RankingLiveTemplatePeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('ranking_live_id', 'days_after', 'start_time', 'step_day', 'is_satellite', 'created_at', ),
		BasePeer::TYPE_ALIAS=>array ('RANKING_LIVE_ID'=>'', 'DAYS_AFTER'=>'', 'START_TIME'=>'', 'STEP_DAY'=>'', 'IS_SATELLITE'=>'', 'CREATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('RankingLiveId'=>0, 'DaysAfter'=>1, 'StartTime'=>2, 'StepDay'=>3, 'IsSatellite'=>4, 'CreatedAt'=>5, ),
		BasePeer::TYPE_COLNAME=>array (RankingLiveTemplatePeer::RANKING_LIVE_ID=>0, RankingLiveTemplatePeer::DAYS_AFTER=>1, RankingLiveTemplatePeer::START_TIME=>2, RankingLiveTemplatePeer::STEP_DAY=>3, RankingLiveTemplatePeer::IS_SATELLITE=>4, RankingLiveTemplatePeer::CREATED_AT=>5, ),
		BasePeer::TYPE_FIELDNAME=>array ('ranking_live_id'=>0, 'days_after'=>1, 'start_time'=>2, 'step_day'=>3, 'is_satellite'=>4, 'created_at'=>5, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'apps/backend/lib/model/map/RankingLiveTemplateMapBuilder.php';
		return BasePeer::getMapBuilder('...apps.backend.lib.model.map.RankingLiveTemplateMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = RankingLiveTemplatePeer::getTableMap();
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
		return str_replace(RankingLiveTemplatePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(RankingLiveTemplatePeer::RANKING_LIVE_ID);

		$criteria->addSelectColumn(RankingLiveTemplatePeer::DAYS_AFTER);

		$criteria->addSelectColumn(RankingLiveTemplatePeer::START_TIME);

		$criteria->addSelectColumn(RankingLiveTemplatePeer::STEP_DAY);

		$criteria->addSelectColumn(RankingLiveTemplatePeer::IS_SATELLITE);

		$criteria->addSelectColumn(RankingLiveTemplatePeer::CREATED_AT);

	}

	const COUNT = 'COUNT(ranking_live_template.RANKING_LIVE_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT ranking_live_template.RANKING_LIVE_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingLiveTemplatePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingLiveTemplatePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = RankingLiveTemplatePeer::doSelectRS($criteria, $con);
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
		$objects = RankingLiveTemplatePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return RankingLiveTemplatePeer::populateObjects(RankingLiveTemplatePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			RankingLiveTemplatePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = RankingLiveTemplatePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinRankingLive(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingLiveTemplatePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingLiveTemplatePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingLiveTemplatePeer::RANKING_LIVE_ID, RankingLivePeer::ID);

		$rs = RankingLiveTemplatePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinRankingLive(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RankingLiveTemplatePeer::addSelectColumns($c);
		$startcol = (RankingLiveTemplatePeer::NUM_COLUMNS - RankingLiveTemplatePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		RankingLivePeer::addSelectColumns($c);

		$c->addJoin(RankingLiveTemplatePeer::RANKING_LIVE_ID, RankingLivePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingLiveTemplatePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = RankingLivePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getRankingLive(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addRankingLiveTemplate($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRankingLiveTemplateList();
				$obj2->addRankingLiveTemplate($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingLiveTemplatePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingLiveTemplatePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingLiveTemplatePeer::RANKING_LIVE_ID, RankingLivePeer::ID);

		$rs = RankingLiveTemplatePeer::doSelectRS($criteria, $con);
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

		RankingLiveTemplatePeer::addSelectColumns($c);
		$startcol2 = (RankingLiveTemplatePeer::NUM_COLUMNS - RankingLiveTemplatePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RankingLivePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RankingLivePeer::NUM_COLUMNS;

		$c->addJoin(RankingLiveTemplatePeer::RANKING_LIVE_ID, RankingLivePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingLiveTemplatePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = RankingLivePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getRankingLive(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRankingLiveTemplate($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initRankingLiveTemplateList();
				$obj2->addRankingLiveTemplate($obj1);
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
		return RankingLiveTemplatePeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(RankingLiveTemplatePeer::RANKING_LIVE_ID);
			$selectCriteria->add(RankingLiveTemplatePeer::RANKING_LIVE_ID, $criteria->remove(RankingLiveTemplatePeer::RANKING_LIVE_ID), $comparison);

			$comparison = $criteria->getComparison(RankingLiveTemplatePeer::DAYS_AFTER);
			$selectCriteria->add(RankingLiveTemplatePeer::DAYS_AFTER, $criteria->remove(RankingLiveTemplatePeer::DAYS_AFTER), $comparison);

			$comparison = $criteria->getComparison(RankingLiveTemplatePeer::START_TIME);
			$selectCriteria->add(RankingLiveTemplatePeer::START_TIME, $criteria->remove(RankingLiveTemplatePeer::START_TIME), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(RankingLiveTemplatePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(RankingLiveTemplatePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof RankingLiveTemplate) {

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

			$criteria->add(RankingLiveTemplatePeer::RANKING_LIVE_ID, $vals[0], Criteria::IN);
			$criteria->add(RankingLiveTemplatePeer::DAYS_AFTER, $vals[1], Criteria::IN);
			$criteria->add(RankingLiveTemplatePeer::START_TIME, $vals[2], Criteria::IN);
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

	
	public static function doValidate(RankingLiveTemplate $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RankingLiveTemplatePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RankingLiveTemplatePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(RankingLiveTemplatePeer::DATABASE_NAME, RankingLiveTemplatePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RankingLiveTemplatePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $ranking_live_id, $days_after, $start_time, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(RankingLiveTemplatePeer::RANKING_LIVE_ID, $ranking_live_id);
		$criteria->add(RankingLiveTemplatePeer::DAYS_AFTER, $days_after);
		$criteria->add(RankingLiveTemplatePeer::START_TIME, $start_time);
		$v = RankingLiveTemplatePeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseRankingLiveTemplatePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'apps/backend/lib/model/map/RankingLiveTemplateMapBuilder.php';
	Propel::registerMapBuilder('...apps.backend.lib.model.map.RankingLiveTemplateMapBuilder');
}
