<?php


abstract class BaseClubPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'club';

	
	const CLASS_DEFAULT = 'lib.model.Club';

	
	const NUM_COLUMNS = 22;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'club.ID';

	
	const CLUB_NAME = 'club.CLUB_NAME';

	
	const TAG_NAME = 'club.TAG_NAME';

	
	const FILE_NAME_LOGO = 'club.FILE_NAME_LOGO';

	
	const ADDRESS_NAME = 'club.ADDRESS_NAME';

	
	const ADDRESS_NUMBER = 'club.ADDRESS_NUMBER';

	
	const ADDRESS_QUARTER = 'club.ADDRESS_QUARTER';

	
	const CITY_ID = 'club.CITY_ID';

	
	const MAPS_LINK = 'club.MAPS_LINK';

	
	const CLUB_SITE = 'club.CLUB_SITE';

	
	const DESCRIPTION = 'club.DESCRIPTION';

	
	const PHONE_NUMBER_1 = 'club.PHONE_NUMBER_1';

	
	const PHONE_NUMBER_2 = 'club.PHONE_NUMBER_2';

	
	const PHONE_NUMBER_3 = 'club.PHONE_NUMBER_3';

	
	const VISIT_COUNT = 'club.VISIT_COUNT';

	
	const SMS_CREDIT = 'club.SMS_CREDIT';

	
	const ENABLED = 'club.ENABLED';

	
	const VISIBLE = 'club.VISIBLE';

	
	const DELETED = 'club.DELETED';

	
	const LOCKED = 'club.LOCKED';

	
	const CREATED_AT = 'club.CREATED_AT';

	
	const UPDATED_AT = 'club.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'ClubName', 'TagName', 'FileNameLogo', 'AddressName', 'AddressNumber', 'AddressQuarter', 'CityId', 'MapsLink', 'ClubSite', 'Description', 'PhoneNumber1', 'PhoneNumber2', 'PhoneNumber3', 'VisitCount', 'SmsCredit', 'Enabled', 'Visible', 'Deleted', 'Locked', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (ClubPeer::ID, ClubPeer::CLUB_NAME, ClubPeer::TAG_NAME, ClubPeer::FILE_NAME_LOGO, ClubPeer::ADDRESS_NAME, ClubPeer::ADDRESS_NUMBER, ClubPeer::ADDRESS_QUARTER, ClubPeer::CITY_ID, ClubPeer::MAPS_LINK, ClubPeer::CLUB_SITE, ClubPeer::DESCRIPTION, ClubPeer::PHONE_NUMBER_1, ClubPeer::PHONE_NUMBER_2, ClubPeer::PHONE_NUMBER_3, ClubPeer::VISIT_COUNT, ClubPeer::SMS_CREDIT, ClubPeer::ENABLED, ClubPeer::VISIBLE, ClubPeer::DELETED, ClubPeer::LOCKED, ClubPeer::CREATED_AT, ClubPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'club_name', 'tag_name', 'file_name_logo', 'address_name', 'address_number', 'address_quarter', 'city_id', 'maps_link', 'club_site', 'description', 'phone_number_1', 'phone_number_2', 'phone_number_3', 'visit_count', 'sms_credit', 'enabled', 'visible', 'deleted', 'locked', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'CLUB_NAME'=>'', 'TAG_NAME'=>'', 'FILE_NAME_LOGO'=>'', 'ADDRESS_NAME'=>'', 'ADDRESS_NUMBER'=>'', 'ADDRESS_QUARTER'=>'', 'CITY_ID'=>'', 'MAPS_LINK'=>'', 'CLUB_SITE'=>'', 'DESCRIPTION'=>'', 'PHONE_NUMBER_1'=>'', 'PHONE_NUMBER_2'=>'', 'PHONE_NUMBER_3'=>'', 'VISIT_COUNT'=>'', 'SMS_CREDIT'=>'', 'ENABLED'=>'', 'VISIBLE'=>'', 'DELETED'=>'', 'LOCKED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'ClubName'=>1, 'TagName'=>2, 'FileNameLogo'=>3, 'AddressName'=>4, 'AddressNumber'=>5, 'AddressQuarter'=>6, 'CityId'=>7, 'MapsLink'=>8, 'ClubSite'=>9, 'Description'=>10, 'PhoneNumber1'=>11, 'PhoneNumber2'=>12, 'PhoneNumber3'=>13, 'VisitCount'=>14, 'SmsCredit'=>15, 'Enabled'=>16, 'Visible'=>17, 'Deleted'=>18, 'Locked'=>19, 'CreatedAt'=>20, 'UpdatedAt'=>21, ),
		BasePeer::TYPE_COLNAME=>array (ClubPeer::ID=>0, ClubPeer::CLUB_NAME=>1, ClubPeer::TAG_NAME=>2, ClubPeer::FILE_NAME_LOGO=>3, ClubPeer::ADDRESS_NAME=>4, ClubPeer::ADDRESS_NUMBER=>5, ClubPeer::ADDRESS_QUARTER=>6, ClubPeer::CITY_ID=>7, ClubPeer::MAPS_LINK=>8, ClubPeer::CLUB_SITE=>9, ClubPeer::DESCRIPTION=>10, ClubPeer::PHONE_NUMBER_1=>11, ClubPeer::PHONE_NUMBER_2=>12, ClubPeer::PHONE_NUMBER_3=>13, ClubPeer::VISIT_COUNT=>14, ClubPeer::SMS_CREDIT=>15, ClubPeer::ENABLED=>16, ClubPeer::VISIBLE=>17, ClubPeer::DELETED=>18, ClubPeer::LOCKED=>19, ClubPeer::CREATED_AT=>20, ClubPeer::UPDATED_AT=>21, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'club_name'=>1, 'tag_name'=>2, 'file_name_logo'=>3, 'address_name'=>4, 'address_number'=>5, 'address_quarter'=>6, 'city_id'=>7, 'maps_link'=>8, 'club_site'=>9, 'description'=>10, 'phone_number_1'=>11, 'phone_number_2'=>12, 'phone_number_3'=>13, 'visit_count'=>14, 'sms_credit'=>15, 'enabled'=>16, 'visible'=>17, 'deleted'=>18, 'locked'=>19, 'created_at'=>20, 'updated_at'=>21, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ClubMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ClubMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ClubPeer::getTableMap();
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
		return str_replace(ClubPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ClubPeer::ID);

		$criteria->addSelectColumn(ClubPeer::CLUB_NAME);

		$criteria->addSelectColumn(ClubPeer::TAG_NAME);

		$criteria->addSelectColumn(ClubPeer::FILE_NAME_LOGO);

		$criteria->addSelectColumn(ClubPeer::ADDRESS_NAME);

		$criteria->addSelectColumn(ClubPeer::ADDRESS_NUMBER);

		$criteria->addSelectColumn(ClubPeer::ADDRESS_QUARTER);

		$criteria->addSelectColumn(ClubPeer::CITY_ID);

		$criteria->addSelectColumn(ClubPeer::MAPS_LINK);

		$criteria->addSelectColumn(ClubPeer::CLUB_SITE);

		$criteria->addSelectColumn(ClubPeer::DESCRIPTION);

		$criteria->addSelectColumn(ClubPeer::PHONE_NUMBER_1);

		$criteria->addSelectColumn(ClubPeer::PHONE_NUMBER_2);

		$criteria->addSelectColumn(ClubPeer::PHONE_NUMBER_3);

		$criteria->addSelectColumn(ClubPeer::VISIT_COUNT);

		$criteria->addSelectColumn(ClubPeer::SMS_CREDIT);

		$criteria->addSelectColumn(ClubPeer::ENABLED);

		$criteria->addSelectColumn(ClubPeer::VISIBLE);

		$criteria->addSelectColumn(ClubPeer::DELETED);

		$criteria->addSelectColumn(ClubPeer::LOCKED);

		$criteria->addSelectColumn(ClubPeer::CREATED_AT);

		$criteria->addSelectColumn(ClubPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(club.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT club.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ClubPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClubPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ClubPeer::doSelectRS($criteria, $con);
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
		$objects = ClubPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ClubPeer::populateObjects(ClubPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ClubPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ClubPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinCity(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ClubPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClubPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ClubPeer::CITY_ID, CityPeer::ID);

		$rs = ClubPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinCity(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ClubPeer::addSelectColumns($c);
		$startcol = (ClubPeer::NUM_COLUMNS - ClubPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CityPeer::addSelectColumns($c);

		$c->addJoin(ClubPeer::CITY_ID, CityPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ClubPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CityPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getCity(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addClub($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initClubList();
				$obj2->addClub($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ClubPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClubPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ClubPeer::CITY_ID, CityPeer::ID);

		$rs = ClubPeer::doSelectRS($criteria, $con);
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

		ClubPeer::addSelectColumns($c);
		$startcol2 = (ClubPeer::NUM_COLUMNS - ClubPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CityPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CityPeer::NUM_COLUMNS;

		$c->addJoin(ClubPeer::CITY_ID, CityPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ClubPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = CityPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCity(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addClub($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initClubList();
				$obj2->addClub($obj1);
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
		return ClubPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(ClubPeer::ID); 

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
			$comparison = $criteria->getComparison(ClubPeer::ID);
			$selectCriteria->add(ClubPeer::ID, $criteria->remove(ClubPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(ClubPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ClubPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Club) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ClubPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Club $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ClubPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ClubPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ClubPeer::DATABASE_NAME, ClubPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ClubPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ClubPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(ClubPeer::ID, $pk);


		$v = ClubPeer::doSelect($criteria, $con);

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
			$criteria->add(ClubPeer::ID, $pks, Criteria::IN);
			$objs = ClubPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseClubPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ClubMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ClubMapBuilder');
}
