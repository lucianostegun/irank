<?php


abstract class BaseClubCheckPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'club_check';

	
	const CLASS_DEFAULT = '...apps.backend.lib.model.ClubCheck';

	
	const NUM_COLUMNS = 11;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'club_check.ID';

	
	const CLUB_ID = 'club_check.CLUB_ID';

	
	const CASH_TABLE_ID = 'club_check.CASH_TABLE_ID';

	
	const CASH_TABLE_SESSION_ID = 'club_check.CASH_TABLE_SESSION_ID';

	
	const PEOPLE_ID = 'club_check.PEOPLE_ID';

	
	const CHECK_NUMBER = 'club_check.CHECK_NUMBER';

	
	const CHECK_NOMINAL = 'club_check.CHECK_NOMINAL';

	
	const CHECK_BANK = 'club_check.CHECK_BANK';

	
	const CHECK_DATE = 'club_check.CHECK_DATE';

	
	const IS_PENDING = 'club_check.IS_PENDING';

	
	const CREATED_AT = 'club_check.CREATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'ClubId', 'CashTableId', 'CashTableSessionId', 'PeopleId', 'CheckNumber', 'CheckNominal', 'CheckBank', 'CheckDate', 'IsPending', 'CreatedAt', ),
		BasePeer::TYPE_COLNAME=>array (ClubCheckPeer::ID, ClubCheckPeer::CLUB_ID, ClubCheckPeer::CASH_TABLE_ID, ClubCheckPeer::CASH_TABLE_SESSION_ID, ClubCheckPeer::PEOPLE_ID, ClubCheckPeer::CHECK_NUMBER, ClubCheckPeer::CHECK_NOMINAL, ClubCheckPeer::CHECK_BANK, ClubCheckPeer::CHECK_DATE, ClubCheckPeer::IS_PENDING, ClubCheckPeer::CREATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'club_id', 'cash_table_id', 'cash_table_session_id', 'people_id', 'check_number', 'check_nominal', 'check_bank', 'check_date', 'is_pending', 'created_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'CLUB_ID'=>'', 'CASH_TABLE_ID'=>'', 'CASH_TABLE_SESSION_ID'=>'', 'PEOPLE_ID'=>'', 'CHECK_NUMBER'=>'', 'CHECK_NOMINAL'=>'', 'CHECK_BANK'=>'', 'CHECK_DATE'=>'', 'IS_PENDING'=>'', 'CREATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'ClubId'=>1, 'CashTableId'=>2, 'CashTableSessionId'=>3, 'PeopleId'=>4, 'CheckNumber'=>5, 'CheckNominal'=>6, 'CheckBank'=>7, 'CheckDate'=>8, 'IsPending'=>9, 'CreatedAt'=>10, ),
		BasePeer::TYPE_COLNAME=>array (ClubCheckPeer::ID=>0, ClubCheckPeer::CLUB_ID=>1, ClubCheckPeer::CASH_TABLE_ID=>2, ClubCheckPeer::CASH_TABLE_SESSION_ID=>3, ClubCheckPeer::PEOPLE_ID=>4, ClubCheckPeer::CHECK_NUMBER=>5, ClubCheckPeer::CHECK_NOMINAL=>6, ClubCheckPeer::CHECK_BANK=>7, ClubCheckPeer::CHECK_DATE=>8, ClubCheckPeer::IS_PENDING=>9, ClubCheckPeer::CREATED_AT=>10, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'club_id'=>1, 'cash_table_id'=>2, 'cash_table_session_id'=>3, 'people_id'=>4, 'check_number'=>5, 'check_nominal'=>6, 'check_bank'=>7, 'check_date'=>8, 'is_pending'=>9, 'created_at'=>10, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'apps/backend/lib/model/map/ClubCheckMapBuilder.php';
		return BasePeer::getMapBuilder('...apps.backend.lib.model.map.ClubCheckMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ClubCheckPeer::getTableMap();
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
		return str_replace(ClubCheckPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ClubCheckPeer::ID);

		$criteria->addSelectColumn(ClubCheckPeer::CLUB_ID);

		$criteria->addSelectColumn(ClubCheckPeer::CASH_TABLE_ID);

		$criteria->addSelectColumn(ClubCheckPeer::CASH_TABLE_SESSION_ID);

		$criteria->addSelectColumn(ClubCheckPeer::PEOPLE_ID);

		$criteria->addSelectColumn(ClubCheckPeer::CHECK_NUMBER);

		$criteria->addSelectColumn(ClubCheckPeer::CHECK_NOMINAL);

		$criteria->addSelectColumn(ClubCheckPeer::CHECK_BANK);

		$criteria->addSelectColumn(ClubCheckPeer::CHECK_DATE);

		$criteria->addSelectColumn(ClubCheckPeer::IS_PENDING);

		$criteria->addSelectColumn(ClubCheckPeer::CREATED_AT);

	}

	const COUNT = 'COUNT(club_check.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT club_check.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ClubCheckPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClubCheckPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ClubCheckPeer::doSelectRS($criteria, $con);
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
		$objects = ClubCheckPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ClubCheckPeer::populateObjects(ClubCheckPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ClubCheckPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ClubCheckPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinClub(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ClubCheckPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClubCheckPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ClubCheckPeer::CLUB_ID, ClubPeer::ID);

		$rs = ClubCheckPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinCashTable(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ClubCheckPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClubCheckPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ClubCheckPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$rs = ClubCheckPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinCashTableSession(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ClubCheckPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClubCheckPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ClubCheckPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$rs = ClubCheckPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ClubCheckPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClubCheckPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ClubCheckPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = ClubCheckPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinClub(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ClubCheckPeer::addSelectColumns($c);
		$startcol = (ClubCheckPeer::NUM_COLUMNS - ClubCheckPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ClubPeer::addSelectColumns($c);

		$c->addJoin(ClubCheckPeer::CLUB_ID, ClubPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ClubCheckPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ClubPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getClub(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addClubCheck($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initClubCheckList();
				$obj2->addClubCheck($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinCashTable(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ClubCheckPeer::addSelectColumns($c);
		$startcol = (ClubCheckPeer::NUM_COLUMNS - ClubCheckPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CashTablePeer::addSelectColumns($c);

		$c->addJoin(ClubCheckPeer::CASH_TABLE_ID, CashTablePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ClubCheckPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CashTablePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getCashTable(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addClubCheck($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initClubCheckList();
				$obj2->addClubCheck($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinCashTableSession(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ClubCheckPeer::addSelectColumns($c);
		$startcol = (ClubCheckPeer::NUM_COLUMNS - ClubCheckPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CashTableSessionPeer::addSelectColumns($c);

		$c->addJoin(ClubCheckPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ClubCheckPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CashTableSessionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getCashTableSession(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addClubCheck($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initClubCheckList();
				$obj2->addClubCheck($obj1); 			}
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

		ClubCheckPeer::addSelectColumns($c);
		$startcol = (ClubCheckPeer::NUM_COLUMNS - ClubCheckPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PeoplePeer::addSelectColumns($c);

		$c->addJoin(ClubCheckPeer::PEOPLE_ID, PeoplePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ClubCheckPeer::getOMClass();

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
										$temp_obj2->addClubCheck($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initClubCheckList();
				$obj2->addClubCheck($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ClubCheckPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClubCheckPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ClubCheckPeer::CLUB_ID, ClubPeer::ID);

		$criteria->addJoin(ClubCheckPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$criteria->addJoin(ClubCheckPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$criteria->addJoin(ClubCheckPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = ClubCheckPeer::doSelectRS($criteria, $con);
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

		ClubCheckPeer::addSelectColumns($c);
		$startcol2 = (ClubCheckPeer::NUM_COLUMNS - ClubCheckPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ClubPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ClubPeer::NUM_COLUMNS;

		CashTablePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CashTablePeer::NUM_COLUMNS;

		CashTableSessionPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + CashTableSessionPeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(ClubCheckPeer::CLUB_ID, ClubPeer::ID);

		$c->addJoin(ClubCheckPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$c->addJoin(ClubCheckPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$c->addJoin(ClubCheckPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ClubCheckPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = ClubPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getClub(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addClubCheck($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initClubCheckList();
				$obj2->addClubCheck($obj1);
			}


					
			$omClass = CashTablePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getCashTable(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addClubCheck($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initClubCheckList();
				$obj3->addClubCheck($obj1);
			}


					
			$omClass = CashTableSessionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getCashTableSession(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addClubCheck($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initClubCheckList();
				$obj4->addClubCheck($obj1);
			}


					
			$omClass = PeoplePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getPeople(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addClubCheck($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initClubCheckList();
				$obj5->addClubCheck($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptClub(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ClubCheckPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClubCheckPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ClubCheckPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$criteria->addJoin(ClubCheckPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$criteria->addJoin(ClubCheckPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = ClubCheckPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptCashTable(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ClubCheckPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClubCheckPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ClubCheckPeer::CLUB_ID, ClubPeer::ID);

		$criteria->addJoin(ClubCheckPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$criteria->addJoin(ClubCheckPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = ClubCheckPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptCashTableSession(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ClubCheckPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClubCheckPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ClubCheckPeer::CLUB_ID, ClubPeer::ID);

		$criteria->addJoin(ClubCheckPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$criteria->addJoin(ClubCheckPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = ClubCheckPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ClubCheckPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClubCheckPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ClubCheckPeer::CLUB_ID, ClubPeer::ID);

		$criteria->addJoin(ClubCheckPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$criteria->addJoin(ClubCheckPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$rs = ClubCheckPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptClub(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ClubCheckPeer::addSelectColumns($c);
		$startcol2 = (ClubCheckPeer::NUM_COLUMNS - ClubCheckPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CashTablePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CashTablePeer::NUM_COLUMNS;

		CashTableSessionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CashTableSessionPeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(ClubCheckPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$c->addJoin(ClubCheckPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$c->addJoin(ClubCheckPeer::PEOPLE_ID, PeoplePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ClubCheckPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CashTablePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCashTable(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addClubCheck($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initClubCheckList();
				$obj2->addClubCheck($obj1);
			}

			$omClass = CashTableSessionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getCashTableSession(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addClubCheck($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initClubCheckList();
				$obj3->addClubCheck($obj1);
			}

			$omClass = PeoplePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getPeople(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addClubCheck($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initClubCheckList();
				$obj4->addClubCheck($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptCashTable(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ClubCheckPeer::addSelectColumns($c);
		$startcol2 = (ClubCheckPeer::NUM_COLUMNS - ClubCheckPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ClubPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ClubPeer::NUM_COLUMNS;

		CashTableSessionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CashTableSessionPeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(ClubCheckPeer::CLUB_ID, ClubPeer::ID);

		$c->addJoin(ClubCheckPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$c->addJoin(ClubCheckPeer::PEOPLE_ID, PeoplePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ClubCheckPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ClubPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getClub(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addClubCheck($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initClubCheckList();
				$obj2->addClubCheck($obj1);
			}

			$omClass = CashTableSessionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getCashTableSession(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addClubCheck($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initClubCheckList();
				$obj3->addClubCheck($obj1);
			}

			$omClass = PeoplePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getPeople(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addClubCheck($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initClubCheckList();
				$obj4->addClubCheck($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptCashTableSession(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ClubCheckPeer::addSelectColumns($c);
		$startcol2 = (ClubCheckPeer::NUM_COLUMNS - ClubCheckPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ClubPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ClubPeer::NUM_COLUMNS;

		CashTablePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CashTablePeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(ClubCheckPeer::CLUB_ID, ClubPeer::ID);

		$c->addJoin(ClubCheckPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$c->addJoin(ClubCheckPeer::PEOPLE_ID, PeoplePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ClubCheckPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ClubPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getClub(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addClubCheck($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initClubCheckList();
				$obj2->addClubCheck($obj1);
			}

			$omClass = CashTablePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getCashTable(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addClubCheck($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initClubCheckList();
				$obj3->addClubCheck($obj1);
			}

			$omClass = PeoplePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getPeople(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addClubCheck($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initClubCheckList();
				$obj4->addClubCheck($obj1);
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

		ClubCheckPeer::addSelectColumns($c);
		$startcol2 = (ClubCheckPeer::NUM_COLUMNS - ClubCheckPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ClubPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ClubPeer::NUM_COLUMNS;

		CashTablePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CashTablePeer::NUM_COLUMNS;

		CashTableSessionPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + CashTableSessionPeer::NUM_COLUMNS;

		$c->addJoin(ClubCheckPeer::CLUB_ID, ClubPeer::ID);

		$c->addJoin(ClubCheckPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$c->addJoin(ClubCheckPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ClubCheckPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ClubPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getClub(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addClubCheck($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initClubCheckList();
				$obj2->addClubCheck($obj1);
			}

			$omClass = CashTablePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getCashTable(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addClubCheck($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initClubCheckList();
				$obj3->addClubCheck($obj1);
			}

			$omClass = CashTableSessionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getCashTableSession(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addClubCheck($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initClubCheckList();
				$obj4->addClubCheck($obj1);
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
		return ClubCheckPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(ClubCheckPeer::ID); 

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
			$comparison = $criteria->getComparison(ClubCheckPeer::ID);
			$selectCriteria->add(ClubCheckPeer::ID, $criteria->remove(ClubCheckPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(ClubCheckPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ClubCheckPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof ClubCheck) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ClubCheckPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(ClubCheck $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ClubCheckPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ClubCheckPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ClubCheckPeer::DATABASE_NAME, ClubCheckPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ClubCheckPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ClubCheckPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(ClubCheckPeer::ID, $pk);


		$v = ClubCheckPeer::doSelect($criteria, $con);

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
			$criteria->add(ClubCheckPeer::ID, $pks, Criteria::IN);
			$objs = ClubCheckPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseClubCheckPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'apps/backend/lib/model/map/ClubCheckMapBuilder.php';
	Propel::registerMapBuilder('...apps.backend.lib.model.map.ClubCheckMapBuilder');
}
