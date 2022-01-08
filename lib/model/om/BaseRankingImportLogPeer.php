<?php


abstract class BaseRankingImportLogPeer {

	
	const DATABASE_NAME = 'log';

	
	const TABLE_NAME = 'ranking_import_log';

	
	const CLASS_DEFAULT = 'lib.model.RankingImportLog';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const RANKING_ID = 'ranking_import_log.RANKING_ID';

	
	const RANKING_ID_FROM = 'ranking_import_log.RANKING_ID_FROM';

	
	const IMPORT_TABLE = 'ranking_import_log.IMPORT_TABLE';

	
	const OBJECT_ID = 'ranking_import_log.OBJECT_ID';

	
	const CREATED_AT = 'ranking_import_log.CREATED_AT';

	
	const UPDATED_AT = 'ranking_import_log.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('RankingId', 'RankingIdFrom', 'ImportTable', 'ObjectId', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (RankingImportLogPeer::RANKING_ID, RankingImportLogPeer::RANKING_ID_FROM, RankingImportLogPeer::IMPORT_TABLE, RankingImportLogPeer::OBJECT_ID, RankingImportLogPeer::CREATED_AT, RankingImportLogPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('ranking_id', 'ranking_id_from', 'import_table', 'object_id', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('RANKING_ID'=>'', 'RANKING_ID_FROM'=>'', 'IMPORT_TABLE'=>'', 'OBJECT_ID'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('RankingId'=>0, 'RankingIdFrom'=>1, 'ImportTable'=>2, 'ObjectId'=>3, 'CreatedAt'=>4, 'UpdatedAt'=>5, ),
		BasePeer::TYPE_COLNAME=>array (RankingImportLogPeer::RANKING_ID=>0, RankingImportLogPeer::RANKING_ID_FROM=>1, RankingImportLogPeer::IMPORT_TABLE=>2, RankingImportLogPeer::OBJECT_ID=>3, RankingImportLogPeer::CREATED_AT=>4, RankingImportLogPeer::UPDATED_AT=>5, ),
		BasePeer::TYPE_FIELDNAME=>array ('ranking_id'=>0, 'ranking_id_from'=>1, 'import_table'=>2, 'object_id'=>3, 'created_at'=>4, 'updated_at'=>5, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/RankingImportLogMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.RankingImportLogMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = RankingImportLogPeer::getTableMap();
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
		return str_replace(RankingImportLogPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(RankingImportLogPeer::RANKING_ID);

		$criteria->addSelectColumn(RankingImportLogPeer::RANKING_ID_FROM);

		$criteria->addSelectColumn(RankingImportLogPeer::IMPORT_TABLE);

		$criteria->addSelectColumn(RankingImportLogPeer::OBJECT_ID);

		$criteria->addSelectColumn(RankingImportLogPeer::CREATED_AT);

		$criteria->addSelectColumn(RankingImportLogPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(ranking_import_log.RANKING_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT ranking_import_log.RANKING_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingImportLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingImportLogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = RankingImportLogPeer::doSelectRS($criteria, $con);
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
		$objects = RankingImportLogPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return RankingImportLogPeer::populateObjects(RankingImportLogPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			RankingImportLogPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = RankingImportLogPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return RankingImportLogPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(RankingImportLogPeer::RANKING_ID);
			$selectCriteria->add(RankingImportLogPeer::RANKING_ID, $criteria->remove(RankingImportLogPeer::RANKING_ID), $comparison);

			$comparison = $criteria->getComparison(RankingImportLogPeer::RANKING_ID_FROM);
			$selectCriteria->add(RankingImportLogPeer::RANKING_ID_FROM, $criteria->remove(RankingImportLogPeer::RANKING_ID_FROM), $comparison);

			$comparison = $criteria->getComparison(RankingImportLogPeer::IMPORT_TABLE);
			$selectCriteria->add(RankingImportLogPeer::IMPORT_TABLE, $criteria->remove(RankingImportLogPeer::IMPORT_TABLE), $comparison);

			$comparison = $criteria->getComparison(RankingImportLogPeer::OBJECT_ID);
			$selectCriteria->add(RankingImportLogPeer::OBJECT_ID, $criteria->remove(RankingImportLogPeer::OBJECT_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(RankingImportLogPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(RankingImportLogPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof RankingImportLog) {

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
				$vals[3][] = $value[3];
			}

			$criteria->add(RankingImportLogPeer::RANKING_ID, $vals[0], Criteria::IN);
			$criteria->add(RankingImportLogPeer::RANKING_ID_FROM, $vals[1], Criteria::IN);
			$criteria->add(RankingImportLogPeer::IMPORT_TABLE, $vals[2], Criteria::IN);
			$criteria->add(RankingImportLogPeer::OBJECT_ID, $vals[3], Criteria::IN);
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

	
	public static function doValidate(RankingImportLog $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RankingImportLogPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RankingImportLogPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(RankingImportLogPeer::DATABASE_NAME, RankingImportLogPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RankingImportLogPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $ranking_id, $ranking_id_from, $import_table, $object_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(RankingImportLogPeer::RANKING_ID, $ranking_id);
		$criteria->add(RankingImportLogPeer::RANKING_ID_FROM, $ranking_id_from);
		$criteria->add(RankingImportLogPeer::IMPORT_TABLE, $import_table);
		$criteria->add(RankingImportLogPeer::OBJECT_ID, $object_id);
		$v = RankingImportLogPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseRankingImportLogPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/RankingImportLogMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.RankingImportLogMapBuilder');
}
