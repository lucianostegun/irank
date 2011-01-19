<?php


abstract class BasePeoplePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'people';

	
	const CLASS_DEFAULT = 'lib.model.People';

	
	const NUM_COLUMNS = 13;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'people.ID';

	
	const PEOPLE_TYPE_ID = 'people.PEOPLE_TYPE_ID';

	
	const FIRST_NAME = 'people.FIRST_NAME';

	
	const LAST_NAME = 'people.LAST_NAME';

	
	const FULL_NAME = 'people.FULL_NAME';

	
	const EMAIL_ADDRESS = 'people.EMAIL_ADDRESS';

	
	const BIRTHDAY = 'people.BIRTHDAY';

	
	const ENABLED = 'people.ENABLED';

	
	const VISIBLE = 'people.VISIBLE';

	
	const DELETED = 'people.DELETED';

	
	const LOCKED = 'people.LOCKED';

	
	const CREATED_AT = 'people.CREATED_AT';

	
	const UPDATED_AT = 'people.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'PeopleTypeId', 'FirstName', 'LastName', 'FullName', 'EmailAddress', 'Birthday', 'Enabled', 'Visible', 'Deleted', 'Locked', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (PeoplePeer::ID, PeoplePeer::PEOPLE_TYPE_ID, PeoplePeer::FIRST_NAME, PeoplePeer::LAST_NAME, PeoplePeer::FULL_NAME, PeoplePeer::EMAIL_ADDRESS, PeoplePeer::BIRTHDAY, PeoplePeer::ENABLED, PeoplePeer::VISIBLE, PeoplePeer::DELETED, PeoplePeer::LOCKED, PeoplePeer::CREATED_AT, PeoplePeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'people_type_id', 'first_name', 'last_name', 'full_name', 'email_address', 'birthday', 'enabled', 'visible', 'deleted', 'locked', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'PEOPLE_TYPE_ID'=>'Tipo de pessoa', 'FIRST_NAME'=>'Nome', 'LAST_NAME'=>'Sobrenome', 'FULL_NAME'=>'', 'EMAIL_ADDRESS'=>'E-mail', 'BIRTHDAY'=>'Nascimento', 'ENABLED'=>'', 'VISIBLE'=>'', 'DELETED'=>'', 'LOCKED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'PeopleTypeId'=>1, 'FirstName'=>2, 'LastName'=>3, 'FullName'=>4, 'EmailAddress'=>5, 'Birthday'=>6, 'Enabled'=>7, 'Visible'=>8, 'Deleted'=>9, 'Locked'=>10, 'CreatedAt'=>11, 'UpdatedAt'=>12, ),
		BasePeer::TYPE_COLNAME=>array (PeoplePeer::ID=>0, PeoplePeer::PEOPLE_TYPE_ID=>1, PeoplePeer::FIRST_NAME=>2, PeoplePeer::LAST_NAME=>3, PeoplePeer::FULL_NAME=>4, PeoplePeer::EMAIL_ADDRESS=>5, PeoplePeer::BIRTHDAY=>6, PeoplePeer::ENABLED=>7, PeoplePeer::VISIBLE=>8, PeoplePeer::DELETED=>9, PeoplePeer::LOCKED=>10, PeoplePeer::CREATED_AT=>11, PeoplePeer::UPDATED_AT=>12, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'people_type_id'=>1, 'first_name'=>2, 'last_name'=>3, 'full_name'=>4, 'email_address'=>5, 'birthday'=>6, 'enabled'=>7, 'visible'=>8, 'deleted'=>9, 'locked'=>10, 'created_at'=>11, 'updated_at'=>12, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/PeopleMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.PeopleMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = PeoplePeer::getTableMap();
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
		return str_replace(PeoplePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PeoplePeer::ID);

		$criteria->addSelectColumn(PeoplePeer::PEOPLE_TYPE_ID);

		$criteria->addSelectColumn(PeoplePeer::FIRST_NAME);

		$criteria->addSelectColumn(PeoplePeer::LAST_NAME);

		$criteria->addSelectColumn(PeoplePeer::FULL_NAME);

		$criteria->addSelectColumn(PeoplePeer::EMAIL_ADDRESS);

		$criteria->addSelectColumn(PeoplePeer::BIRTHDAY);

		$criteria->addSelectColumn(PeoplePeer::ENABLED);

		$criteria->addSelectColumn(PeoplePeer::VISIBLE);

		$criteria->addSelectColumn(PeoplePeer::DELETED);

		$criteria->addSelectColumn(PeoplePeer::LOCKED);

		$criteria->addSelectColumn(PeoplePeer::CREATED_AT);

		$criteria->addSelectColumn(PeoplePeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(people.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT people.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PeoplePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PeoplePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PeoplePeer::doSelectRS($criteria, $con);
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
		$objects = PeoplePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return PeoplePeer::populateObjects(PeoplePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PeoplePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = PeoplePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinVirtualTable(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PeoplePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PeoplePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PeoplePeer::PEOPLE_TYPE_ID, VirtualTablePeer::ID);

		$rs = PeoplePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinVirtualTable(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PeoplePeer::addSelectColumns($c);
		$startcol = (PeoplePeer::NUM_COLUMNS - PeoplePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		VirtualTablePeer::addSelectColumns($c);

		$c->addJoin(PeoplePeer::PEOPLE_TYPE_ID, VirtualTablePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PeoplePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = VirtualTablePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getVirtualTable(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addPeople($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPeopleList();
				$obj2->addPeople($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PeoplePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PeoplePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PeoplePeer::PEOPLE_TYPE_ID, VirtualTablePeer::ID);

		$rs = PeoplePeer::doSelectRS($criteria, $con);
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

		PeoplePeer::addSelectColumns($c);
		$startcol2 = (PeoplePeer::NUM_COLUMNS - PeoplePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		VirtualTablePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + VirtualTablePeer::NUM_COLUMNS;

		$c->addJoin(PeoplePeer::PEOPLE_TYPE_ID, VirtualTablePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PeoplePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = VirtualTablePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getVirtualTable(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPeople($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initPeopleList();
				$obj2->addPeople($obj1);
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
		return PeoplePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(PeoplePeer::ID); 

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
			$comparison = $criteria->getComparison(PeoplePeer::ID);
			$selectCriteria->add(PeoplePeer::ID, $criteria->remove(PeoplePeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(PeoplePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PeoplePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof People) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PeoplePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(People $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PeoplePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PeoplePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PeoplePeer::DATABASE_NAME, PeoplePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PeoplePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(PeoplePeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(PeoplePeer::ID, $pk);


		$v = PeoplePeer::doSelect($criteria, $con);

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
			$criteria->add(PeoplePeer::ID, $pks, Criteria::IN);
			$objs = PeoplePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasePeoplePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/PeopleMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.PeopleMapBuilder');
}
