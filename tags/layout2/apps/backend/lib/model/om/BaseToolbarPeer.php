<?php


abstract class BaseToolbarPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'toolbar';

	
	const CLASS_DEFAULT = '...apps.backend.lib.model.Toolbar';

	
	const NUM_COLUMNS = 16;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'toolbar.ID';

	
	const MODULE_ID = 'toolbar.MODULE_ID';

	
	const DESCRIPTION = 'toolbar.DESCRIPTION';

	
	const TAG_NAME = 'toolbar.TAG_NAME';

	
	const TAG_ID = 'toolbar.TAG_ID';

	
	const IMAGE = 'toolbar.IMAGE';

	
	const ACTION_NAME = 'toolbar.ACTION_NAME';

	
	const EXECUTE_MODULE = 'toolbar.EXECUTE_MODULE';

	
	const EXECUTE_ACTION = 'toolbar.EXECUTE_ACTION';

	
	const IS_JAVASCRIPT = 'toolbar.IS_JAVASCRIPT';

	
	const ORDER_SEQ = 'toolbar.ORDER_SEQ';

	
	const START_DISABLED = 'toolbar.START_DISABLED';

	
	const VISIBLE_ACTION = 'toolbar.VISIBLE_ACTION';

	
	const ENABLED = 'toolbar.ENABLED';

	
	const CREATED_AT = 'toolbar.CREATED_AT';

	
	const UPDATED_AT = 'toolbar.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'ModuleId', 'Description', 'TagName', 'TagId', 'Image', 'ActionName', 'ExecuteModule', 'ExecuteAction', 'IsJavascript', 'OrderSeq', 'StartDisabled', 'VisibleAction', 'Enabled', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (ToolbarPeer::ID, ToolbarPeer::MODULE_ID, ToolbarPeer::DESCRIPTION, ToolbarPeer::TAG_NAME, ToolbarPeer::TAG_ID, ToolbarPeer::IMAGE, ToolbarPeer::ACTION_NAME, ToolbarPeer::EXECUTE_MODULE, ToolbarPeer::EXECUTE_ACTION, ToolbarPeer::IS_JAVASCRIPT, ToolbarPeer::ORDER_SEQ, ToolbarPeer::START_DISABLED, ToolbarPeer::VISIBLE_ACTION, ToolbarPeer::ENABLED, ToolbarPeer::CREATED_AT, ToolbarPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'module_id', 'description', 'tag_name', 'tag_id', 'image', 'action_name', 'execute_module', 'execute_action', 'is_javascript', 'order_seq', 'start_disabled', 'visible_action', 'enabled', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'MODULE_ID'=>'', 'DESCRIPTION'=>'', 'TAG_NAME'=>'', 'TAG_ID'=>'', 'IMAGE'=>'', 'ACTION_NAME'=>'', 'EXECUTE_MODULE'=>'', 'EXECUTE_ACTION'=>'', 'IS_JAVASCRIPT'=>'', 'ORDER_SEQ'=>'', 'START_DISABLED'=>'', 'VISIBLE_ACTION'=>'', 'ENABLED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'ModuleId'=>1, 'Description'=>2, 'TagName'=>3, 'TagId'=>4, 'Image'=>5, 'ActionName'=>6, 'ExecuteModule'=>7, 'ExecuteAction'=>8, 'IsJavascript'=>9, 'OrderSeq'=>10, 'StartDisabled'=>11, 'VisibleAction'=>12, 'Enabled'=>13, 'CreatedAt'=>14, 'UpdatedAt'=>15, ),
		BasePeer::TYPE_COLNAME=>array (ToolbarPeer::ID=>0, ToolbarPeer::MODULE_ID=>1, ToolbarPeer::DESCRIPTION=>2, ToolbarPeer::TAG_NAME=>3, ToolbarPeer::TAG_ID=>4, ToolbarPeer::IMAGE=>5, ToolbarPeer::ACTION_NAME=>6, ToolbarPeer::EXECUTE_MODULE=>7, ToolbarPeer::EXECUTE_ACTION=>8, ToolbarPeer::IS_JAVASCRIPT=>9, ToolbarPeer::ORDER_SEQ=>10, ToolbarPeer::START_DISABLED=>11, ToolbarPeer::VISIBLE_ACTION=>12, ToolbarPeer::ENABLED=>13, ToolbarPeer::CREATED_AT=>14, ToolbarPeer::UPDATED_AT=>15, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'module_id'=>1, 'description'=>2, 'tag_name'=>3, 'tag_id'=>4, 'image'=>5, 'action_name'=>6, 'execute_module'=>7, 'execute_action'=>8, 'is_javascript'=>9, 'order_seq'=>10, 'start_disabled'=>11, 'visible_action'=>12, 'enabled'=>13, 'created_at'=>14, 'updated_at'=>15, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'apps/backend/lib/model/map/ToolbarMapBuilder.php';
		return BasePeer::getMapBuilder('...apps.backend.lib.model.map.ToolbarMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ToolbarPeer::getTableMap();
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
		return str_replace(ToolbarPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ToolbarPeer::ID);

		$criteria->addSelectColumn(ToolbarPeer::MODULE_ID);

		$criteria->addSelectColumn(ToolbarPeer::DESCRIPTION);

		$criteria->addSelectColumn(ToolbarPeer::TAG_NAME);

		$criteria->addSelectColumn(ToolbarPeer::TAG_ID);

		$criteria->addSelectColumn(ToolbarPeer::IMAGE);

		$criteria->addSelectColumn(ToolbarPeer::ACTION_NAME);

		$criteria->addSelectColumn(ToolbarPeer::EXECUTE_MODULE);

		$criteria->addSelectColumn(ToolbarPeer::EXECUTE_ACTION);

		$criteria->addSelectColumn(ToolbarPeer::IS_JAVASCRIPT);

		$criteria->addSelectColumn(ToolbarPeer::ORDER_SEQ);

		$criteria->addSelectColumn(ToolbarPeer::START_DISABLED);

		$criteria->addSelectColumn(ToolbarPeer::VISIBLE_ACTION);

		$criteria->addSelectColumn(ToolbarPeer::ENABLED);

		$criteria->addSelectColumn(ToolbarPeer::CREATED_AT);

		$criteria->addSelectColumn(ToolbarPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(toolbar.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT toolbar.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ToolbarPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ToolbarPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ToolbarPeer::doSelectRS($criteria, $con);
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
		$objects = ToolbarPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ToolbarPeer::populateObjects(ToolbarPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ToolbarPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ToolbarPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinModule(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ToolbarPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ToolbarPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ToolbarPeer::MODULE_ID, ModulePeer::ID);

		$rs = ToolbarPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinModule(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ToolbarPeer::addSelectColumns($c);
		$startcol = (ToolbarPeer::NUM_COLUMNS - ToolbarPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ModulePeer::addSelectColumns($c);

		$c->addJoin(ToolbarPeer::MODULE_ID, ModulePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ToolbarPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ModulePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getModule(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addToolbar($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initToolbarList();
				$obj2->addToolbar($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ToolbarPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ToolbarPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ToolbarPeer::MODULE_ID, ModulePeer::ID);

		$rs = ToolbarPeer::doSelectRS($criteria, $con);
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

		ToolbarPeer::addSelectColumns($c);
		$startcol2 = (ToolbarPeer::NUM_COLUMNS - ToolbarPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ModulePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ModulePeer::NUM_COLUMNS;

		$c->addJoin(ToolbarPeer::MODULE_ID, ModulePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ToolbarPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = ModulePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getModule(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addToolbar($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initToolbarList();
				$obj2->addToolbar($obj1);
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
		return ToolbarPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(ToolbarPeer::ID); 

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
			$comparison = $criteria->getComparison(ToolbarPeer::ID);
			$selectCriteria->add(ToolbarPeer::ID, $criteria->remove(ToolbarPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(ToolbarPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ToolbarPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Toolbar) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ToolbarPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Toolbar $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ToolbarPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ToolbarPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ToolbarPeer::DATABASE_NAME, ToolbarPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ToolbarPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ToolbarPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(ToolbarPeer::ID, $pk);


		$v = ToolbarPeer::doSelect($criteria, $con);

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
			$criteria->add(ToolbarPeer::ID, $pks, Criteria::IN);
			$objs = ToolbarPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseToolbarPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'apps/backend/lib/model/map/ToolbarMapBuilder.php';
	Propel::registerMapBuilder('...apps.backend.lib.model.map.ToolbarMapBuilder');
}
