<?php


abstract class BaseAuxiliarTextPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'auxiliar_text';

	
	const CLASS_DEFAULT = 'lib.model.AuxiliarText';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'auxiliar_text.ID';

	
	const DESCRIPTION = 'auxiliar_text.DESCRIPTION';

	
	const FILE_ID = 'auxiliar_text.FILE_ID';

	
	const TAG_NAME = 'auxiliar_text.TAG_NAME';

	
	const ENABLED = 'auxiliar_text.ENABLED';

	
	const VISIBLE = 'auxiliar_text.VISIBLE';

	
	const DELETED = 'auxiliar_text.DELETED';

	
	const LOCKED = 'auxiliar_text.LOCKED';

	
	const CREATED_AT = 'auxiliar_text.CREATED_AT';

	
	const UPDATED_AT = 'auxiliar_text.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'Description', 'FileId', 'TagName', 'Enabled', 'Visible', 'Deleted', 'Locked', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (AuxiliarTextPeer::ID, AuxiliarTextPeer::DESCRIPTION, AuxiliarTextPeer::FILE_ID, AuxiliarTextPeer::TAG_NAME, AuxiliarTextPeer::ENABLED, AuxiliarTextPeer::VISIBLE, AuxiliarTextPeer::DELETED, AuxiliarTextPeer::LOCKED, AuxiliarTextPeer::CREATED_AT, AuxiliarTextPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'description', 'file_id', 'tag_name', 'enabled', 'visible', 'deleted', 'locked', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'DESCRIPTION'=>'', 'FILE_ID'=>'', 'TAG_NAME'=>'', 'ENABLED'=>'', 'VISIBLE'=>'', 'DELETED'=>'', 'LOCKED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'Description'=>1, 'FileId'=>2, 'TagName'=>3, 'Enabled'=>4, 'Visible'=>5, 'Deleted'=>6, 'Locked'=>7, 'CreatedAt'=>8, 'UpdatedAt'=>9, ),
		BasePeer::TYPE_COLNAME=>array (AuxiliarTextPeer::ID=>0, AuxiliarTextPeer::DESCRIPTION=>1, AuxiliarTextPeer::FILE_ID=>2, AuxiliarTextPeer::TAG_NAME=>3, AuxiliarTextPeer::ENABLED=>4, AuxiliarTextPeer::VISIBLE=>5, AuxiliarTextPeer::DELETED=>6, AuxiliarTextPeer::LOCKED=>7, AuxiliarTextPeer::CREATED_AT=>8, AuxiliarTextPeer::UPDATED_AT=>9, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'description'=>1, 'file_id'=>2, 'tag_name'=>3, 'enabled'=>4, 'visible'=>5, 'deleted'=>6, 'locked'=>7, 'created_at'=>8, 'updated_at'=>9, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/AuxiliarTextMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.AuxiliarTextMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = AuxiliarTextPeer::getTableMap();
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
		return str_replace(AuxiliarTextPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(AuxiliarTextPeer::ID);

		$criteria->addSelectColumn(AuxiliarTextPeer::DESCRIPTION);

		$criteria->addSelectColumn(AuxiliarTextPeer::FILE_ID);

		$criteria->addSelectColumn(AuxiliarTextPeer::TAG_NAME);

		$criteria->addSelectColumn(AuxiliarTextPeer::ENABLED);

		$criteria->addSelectColumn(AuxiliarTextPeer::VISIBLE);

		$criteria->addSelectColumn(AuxiliarTextPeer::DELETED);

		$criteria->addSelectColumn(AuxiliarTextPeer::LOCKED);

		$criteria->addSelectColumn(AuxiliarTextPeer::CREATED_AT);

		$criteria->addSelectColumn(AuxiliarTextPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(auxiliar_text.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT auxiliar_text.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AuxiliarTextPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AuxiliarTextPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = AuxiliarTextPeer::doSelectRS($criteria, $con);
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
		$objects = AuxiliarTextPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return AuxiliarTextPeer::populateObjects(AuxiliarTextPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			AuxiliarTextPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = AuxiliarTextPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinFile(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AuxiliarTextPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AuxiliarTextPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(AuxiliarTextPeer::FILE_ID, FilePeer::ID);

		$rs = AuxiliarTextPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinFile(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AuxiliarTextPeer::addSelectColumns($c);
		$startcol = (AuxiliarTextPeer::NUM_COLUMNS - AuxiliarTextPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		FilePeer::addSelectColumns($c);

		$c->addJoin(AuxiliarTextPeer::FILE_ID, FilePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AuxiliarTextPeer::getOMClass();

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
										$temp_obj2->addAuxiliarText($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initAuxiliarTextList();
				$obj2->addAuxiliarText($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(AuxiliarTextPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AuxiliarTextPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(AuxiliarTextPeer::FILE_ID, FilePeer::ID);

		$rs = AuxiliarTextPeer::doSelectRS($criteria, $con);
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

		AuxiliarTextPeer::addSelectColumns($c);
		$startcol2 = (AuxiliarTextPeer::NUM_COLUMNS - AuxiliarTextPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		FilePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + FilePeer::NUM_COLUMNS;

		$c->addJoin(AuxiliarTextPeer::FILE_ID, FilePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AuxiliarTextPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = FilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getFile(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addAuxiliarText($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initAuxiliarTextList();
				$obj2->addAuxiliarText($obj1);
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
		return AuxiliarTextPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(AuxiliarTextPeer::ID); 

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
			$comparison = $criteria->getComparison(AuxiliarTextPeer::ID);
			$selectCriteria->add(AuxiliarTextPeer::ID, $criteria->remove(AuxiliarTextPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(AuxiliarTextPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(AuxiliarTextPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof AuxiliarText) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(AuxiliarTextPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(AuxiliarText $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(AuxiliarTextPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(AuxiliarTextPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(AuxiliarTextPeer::DATABASE_NAME, AuxiliarTextPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = AuxiliarTextPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(AuxiliarTextPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(AuxiliarTextPeer::ID, $pk);


		$v = AuxiliarTextPeer::doSelect($criteria, $con);

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
			$criteria->add(AuxiliarTextPeer::ID, $pks, Criteria::IN);
			$objs = AuxiliarTextPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseAuxiliarTextPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/AuxiliarTextMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.AuxiliarTextMapBuilder');
}
