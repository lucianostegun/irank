<?php


abstract class BaseModulePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'module';

	
	const CLASS_DEFAULT = '...apps.backend.lib.model.Module';

	
	const NUM_COLUMNS = 15;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'module.ID';

	
	const MODULE_ID = 'module.MODULE_ID';

	
	const IS_MENU = 'module.IS_MENU';

	
	const DESCRIPTION = 'module.DESCRIPTION';

	
	const TOOLBAR_DESCRIPTION = 'module.TOOLBAR_DESCRIPTION';

	
	const IMAGE_MENU = 'module.IMAGE_MENU';

	
	const IMAGE_MODULE = 'module.IMAGE_MODULE';

	
	const EXECUTE_MODULE = 'module.EXECUTE_MODULE';

	
	const EXECUTE_ACTION = 'module.EXECUTE_ACTION';

	
	const ENABLED = 'module.ENABLED';

	
	const MASTER_ONLY = 'module.MASTER_ONLY';

	
	const HAS_CHILD = 'module.HAS_CHILD';

	
	const ORDER_SEQ = 'module.ORDER_SEQ';

	
	const CREATED_AT = 'module.CREATED_AT';

	
	const UPDATED_AT = 'module.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'ModuleId', 'IsMenu', 'Description', 'ToolbarDescription', 'ImageMenu', 'ImageModule', 'ExecuteModule', 'ExecuteAction', 'Enabled', 'MasterOnly', 'HasChild', 'OrderSeq', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (ModulePeer::ID, ModulePeer::MODULE_ID, ModulePeer::IS_MENU, ModulePeer::DESCRIPTION, ModulePeer::TOOLBAR_DESCRIPTION, ModulePeer::IMAGE_MENU, ModulePeer::IMAGE_MODULE, ModulePeer::EXECUTE_MODULE, ModulePeer::EXECUTE_ACTION, ModulePeer::ENABLED, ModulePeer::MASTER_ONLY, ModulePeer::HAS_CHILD, ModulePeer::ORDER_SEQ, ModulePeer::CREATED_AT, ModulePeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'module_id', 'is_menu', 'description', 'toolbar_description', 'image_menu', 'image_module', 'execute_module', 'execute_action', 'enabled', 'master_only', 'has_child', 'order_seq', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'MODULE_ID'=>'', 'IS_MENU'=>'', 'DESCRIPTION'=>'', 'TOOLBAR_DESCRIPTION'=>'', 'IMAGE_MENU'=>'', 'IMAGE_MODULE'=>'', 'EXECUTE_MODULE'=>'', 'EXECUTE_ACTION'=>'', 'ENABLED'=>'', 'MASTER_ONLY'=>'', 'HAS_CHILD'=>'', 'ORDER_SEQ'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'ModuleId'=>1, 'IsMenu'=>2, 'Description'=>3, 'ToolbarDescription'=>4, 'ImageMenu'=>5, 'ImageModule'=>6, 'ExecuteModule'=>7, 'ExecuteAction'=>8, 'Enabled'=>9, 'MasterOnly'=>10, 'HasChild'=>11, 'OrderSeq'=>12, 'CreatedAt'=>13, 'UpdatedAt'=>14, ),
		BasePeer::TYPE_COLNAME=>array (ModulePeer::ID=>0, ModulePeer::MODULE_ID=>1, ModulePeer::IS_MENU=>2, ModulePeer::DESCRIPTION=>3, ModulePeer::TOOLBAR_DESCRIPTION=>4, ModulePeer::IMAGE_MENU=>5, ModulePeer::IMAGE_MODULE=>6, ModulePeer::EXECUTE_MODULE=>7, ModulePeer::EXECUTE_ACTION=>8, ModulePeer::ENABLED=>9, ModulePeer::MASTER_ONLY=>10, ModulePeer::HAS_CHILD=>11, ModulePeer::ORDER_SEQ=>12, ModulePeer::CREATED_AT=>13, ModulePeer::UPDATED_AT=>14, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'module_id'=>1, 'is_menu'=>2, 'description'=>3, 'toolbar_description'=>4, 'image_menu'=>5, 'image_module'=>6, 'execute_module'=>7, 'execute_action'=>8, 'enabled'=>9, 'master_only'=>10, 'has_child'=>11, 'order_seq'=>12, 'created_at'=>13, 'updated_at'=>14, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'apps/backend/lib/model/map/ModuleMapBuilder.php';
		return BasePeer::getMapBuilder('...apps.backend.lib.model.map.ModuleMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ModulePeer::getTableMap();
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
		return str_replace(ModulePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ModulePeer::ID);

		$criteria->addSelectColumn(ModulePeer::MODULE_ID);

		$criteria->addSelectColumn(ModulePeer::IS_MENU);

		$criteria->addSelectColumn(ModulePeer::DESCRIPTION);

		$criteria->addSelectColumn(ModulePeer::TOOLBAR_DESCRIPTION);

		$criteria->addSelectColumn(ModulePeer::IMAGE_MENU);

		$criteria->addSelectColumn(ModulePeer::IMAGE_MODULE);

		$criteria->addSelectColumn(ModulePeer::EXECUTE_MODULE);

		$criteria->addSelectColumn(ModulePeer::EXECUTE_ACTION);

		$criteria->addSelectColumn(ModulePeer::ENABLED);

		$criteria->addSelectColumn(ModulePeer::MASTER_ONLY);

		$criteria->addSelectColumn(ModulePeer::HAS_CHILD);

		$criteria->addSelectColumn(ModulePeer::ORDER_SEQ);

		$criteria->addSelectColumn(ModulePeer::CREATED_AT);

		$criteria->addSelectColumn(ModulePeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(module.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT module.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ModulePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ModulePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ModulePeer::doSelectRS($criteria, $con);
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
		$objects = ModulePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ModulePeer::populateObjects(ModulePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ModulePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ModulePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ModulePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ModulePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ModulePeer::doSelectRS($criteria, $con);
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

		ModulePeer::addSelectColumns($c);
		$startcol2 = (ModulePeer::NUM_COLUMNS - ModulePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ModulePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

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
		return ModulePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(ModulePeer::ID); 

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
			$comparison = $criteria->getComparison(ModulePeer::ID);
			$selectCriteria->add(ModulePeer::ID, $criteria->remove(ModulePeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(ModulePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ModulePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Module) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ModulePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Module $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ModulePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ModulePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ModulePeer::DATABASE_NAME, ModulePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ModulePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ModulePeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(ModulePeer::ID, $pk);


		$v = ModulePeer::doSelect($criteria, $con);

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
			$criteria->add(ModulePeer::ID, $pks, Criteria::IN);
			$objs = ModulePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseModulePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'apps/backend/lib/model/map/ModuleMapBuilder.php';
	Propel::registerMapBuilder('...apps.backend.lib.model.map.ModuleMapBuilder');
}
