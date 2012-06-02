<?php


abstract class BaseCashTablePlayerBuyinPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'cash_table_player_buyin';

	
	const CLASS_DEFAULT = '...apps.backend.lib.model.CashTablePlayerBuyin';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'cash_table_player_buyin.ID';

	
	const CASH_TABLE_ID = 'cash_table_player_buyin.CASH_TABLE_ID';

	
	const CASH_TABLE_SESSION_ID = 'cash_table_player_buyin.CASH_TABLE_SESSION_ID';

	
	const PEOPLE_ID = 'cash_table_player_buyin.PEOPLE_ID';

	
	const PAY_METHOD_ID = 'cash_table_player_buyin.PAY_METHOD_ID';

	
	const CLUB_CHECK_ID = 'cash_table_player_buyin.CLUB_CHECK_ID';

	
	const BUYIN = 'cash_table_player_buyin.BUYIN';

	
	const ENTRANCE_FEE = 'cash_table_player_buyin.ENTRANCE_FEE';

	
	const CREATED_AT = 'cash_table_player_buyin.CREATED_AT';

	
	const UPDATED_AT = 'cash_table_player_buyin.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'CashTableId', 'CashTableSessionId', 'PeopleId', 'PayMethodId', 'ClubCheckId', 'Buyin', 'EntranceFee', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (CashTablePlayerBuyinPeer::ID, CashTablePlayerBuyinPeer::CASH_TABLE_ID, CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, CashTablePlayerBuyinPeer::PEOPLE_ID, CashTablePlayerBuyinPeer::PAY_METHOD_ID, CashTablePlayerBuyinPeer::CLUB_CHECK_ID, CashTablePlayerBuyinPeer::BUYIN, CashTablePlayerBuyinPeer::ENTRANCE_FEE, CashTablePlayerBuyinPeer::CREATED_AT, CashTablePlayerBuyinPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'cash_table_id', 'cash_table_session_id', 'people_id', 'pay_method_id', 'club_check_id', 'buyin', 'entrance_fee', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'CASH_TABLE_ID'=>'', 'CASH_TABLE_SESSION_ID'=>'', 'PEOPLE_ID'=>'', 'PAY_METHOD_ID'=>'', 'CLUB_CHECK_ID'=>'', 'BUYIN'=>'', 'ENTRANCE_FEE'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'CashTableId'=>1, 'CashTableSessionId'=>2, 'PeopleId'=>3, 'PayMethodId'=>4, 'ClubCheckId'=>5, 'Buyin'=>6, 'EntranceFee'=>7, 'CreatedAt'=>8, 'UpdatedAt'=>9, ),
		BasePeer::TYPE_COLNAME=>array (CashTablePlayerBuyinPeer::ID=>0, CashTablePlayerBuyinPeer::CASH_TABLE_ID=>1, CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID=>2, CashTablePlayerBuyinPeer::PEOPLE_ID=>3, CashTablePlayerBuyinPeer::PAY_METHOD_ID=>4, CashTablePlayerBuyinPeer::CLUB_CHECK_ID=>5, CashTablePlayerBuyinPeer::BUYIN=>6, CashTablePlayerBuyinPeer::ENTRANCE_FEE=>7, CashTablePlayerBuyinPeer::CREATED_AT=>8, CashTablePlayerBuyinPeer::UPDATED_AT=>9, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'cash_table_id'=>1, 'cash_table_session_id'=>2, 'people_id'=>3, 'pay_method_id'=>4, 'club_check_id'=>5, 'buyin'=>6, 'entrance_fee'=>7, 'created_at'=>8, 'updated_at'=>9, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'apps/backend/lib/model/map/CashTablePlayerBuyinMapBuilder.php';
		return BasePeer::getMapBuilder('...apps.backend.lib.model.map.CashTablePlayerBuyinMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = CashTablePlayerBuyinPeer::getTableMap();
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
		return str_replace(CashTablePlayerBuyinPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(CashTablePlayerBuyinPeer::ID);

		$criteria->addSelectColumn(CashTablePlayerBuyinPeer::CASH_TABLE_ID);

		$criteria->addSelectColumn(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID);

		$criteria->addSelectColumn(CashTablePlayerBuyinPeer::PEOPLE_ID);

		$criteria->addSelectColumn(CashTablePlayerBuyinPeer::PAY_METHOD_ID);

		$criteria->addSelectColumn(CashTablePlayerBuyinPeer::CLUB_CHECK_ID);

		$criteria->addSelectColumn(CashTablePlayerBuyinPeer::BUYIN);

		$criteria->addSelectColumn(CashTablePlayerBuyinPeer::ENTRANCE_FEE);

		$criteria->addSelectColumn(CashTablePlayerBuyinPeer::CREATED_AT);

		$criteria->addSelectColumn(CashTablePlayerBuyinPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(cash_table_player_buyin.CASH_TABLE_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT cash_table_player_buyin.CASH_TABLE_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CashTablePlayerBuyinPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePlayerBuyinPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = CashTablePlayerBuyinPeer::doSelectRS($criteria, $con);
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
		$objects = CashTablePlayerBuyinPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return CashTablePlayerBuyinPeer::populateObjects(CashTablePlayerBuyinPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			CashTablePlayerBuyinPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = CashTablePlayerBuyinPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinCashTable(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CashTablePlayerBuyinPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePlayerBuyinPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePlayerBuyinPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$rs = CashTablePlayerBuyinPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(CashTablePlayerBuyinPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePlayerBuyinPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$rs = CashTablePlayerBuyinPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(CashTablePlayerBuyinPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePlayerBuyinPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePlayerBuyinPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = CashTablePlayerBuyinPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinVirtualTable(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CashTablePlayerBuyinPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePlayerBuyinPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePlayerBuyinPeer::PAY_METHOD_ID, VirtualTablePeer::ID);

		$rs = CashTablePlayerBuyinPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinClubCheck(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CashTablePlayerBuyinPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePlayerBuyinPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePlayerBuyinPeer::CLUB_CHECK_ID, ClubCheckPeer::ID);

		$rs = CashTablePlayerBuyinPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinCashTable(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CashTablePlayerBuyinPeer::addSelectColumns($c);
		$startcol = (CashTablePlayerBuyinPeer::NUM_COLUMNS - CashTablePlayerBuyinPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CashTablePeer::addSelectColumns($c);

		$c->addJoin(CashTablePlayerBuyinPeer::CASH_TABLE_ID, CashTablePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePlayerBuyinPeer::getOMClass();

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
										$temp_obj2->addCashTablePlayerBuyin($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCashTablePlayerBuyinList();
				$obj2->addCashTablePlayerBuyin($obj1); 			}
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

		CashTablePlayerBuyinPeer::addSelectColumns($c);
		$startcol = (CashTablePlayerBuyinPeer::NUM_COLUMNS - CashTablePlayerBuyinPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CashTableSessionPeer::addSelectColumns($c);

		$c->addJoin(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePlayerBuyinPeer::getOMClass();

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
										$temp_obj2->addCashTablePlayerBuyin($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCashTablePlayerBuyinList();
				$obj2->addCashTablePlayerBuyin($obj1); 			}
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

		CashTablePlayerBuyinPeer::addSelectColumns($c);
		$startcol = (CashTablePlayerBuyinPeer::NUM_COLUMNS - CashTablePlayerBuyinPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PeoplePeer::addSelectColumns($c);

		$c->addJoin(CashTablePlayerBuyinPeer::PEOPLE_ID, PeoplePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePlayerBuyinPeer::getOMClass();

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
										$temp_obj2->addCashTablePlayerBuyin($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCashTablePlayerBuyinList();
				$obj2->addCashTablePlayerBuyin($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinVirtualTable(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CashTablePlayerBuyinPeer::addSelectColumns($c);
		$startcol = (CashTablePlayerBuyinPeer::NUM_COLUMNS - CashTablePlayerBuyinPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		VirtualTablePeer::addSelectColumns($c);

		$c->addJoin(CashTablePlayerBuyinPeer::PAY_METHOD_ID, VirtualTablePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePlayerBuyinPeer::getOMClass();

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
										$temp_obj2->addCashTablePlayerBuyin($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCashTablePlayerBuyinList();
				$obj2->addCashTablePlayerBuyin($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinClubCheck(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CashTablePlayerBuyinPeer::addSelectColumns($c);
		$startcol = (CashTablePlayerBuyinPeer::NUM_COLUMNS - CashTablePlayerBuyinPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ClubCheckPeer::addSelectColumns($c);

		$c->addJoin(CashTablePlayerBuyinPeer::CLUB_CHECK_ID, ClubCheckPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePlayerBuyinPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ClubCheckPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getClubCheck(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addCashTablePlayerBuyin($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCashTablePlayerBuyinList();
				$obj2->addCashTablePlayerBuyin($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CashTablePlayerBuyinPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePlayerBuyinPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePlayerBuyinPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$criteria->addJoin(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$criteria->addJoin(CashTablePlayerBuyinPeer::PEOPLE_ID, PeoplePeer::ID);

		$criteria->addJoin(CashTablePlayerBuyinPeer::PAY_METHOD_ID, VirtualTablePeer::ID);

		$criteria->addJoin(CashTablePlayerBuyinPeer::CLUB_CHECK_ID, ClubCheckPeer::ID);

		$rs = CashTablePlayerBuyinPeer::doSelectRS($criteria, $con);
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

		CashTablePlayerBuyinPeer::addSelectColumns($c);
		$startcol2 = (CashTablePlayerBuyinPeer::NUM_COLUMNS - CashTablePlayerBuyinPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CashTablePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CashTablePeer::NUM_COLUMNS;

		CashTableSessionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CashTableSessionPeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + PeoplePeer::NUM_COLUMNS;

		VirtualTablePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + VirtualTablePeer::NUM_COLUMNS;

		ClubCheckPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + ClubCheckPeer::NUM_COLUMNS;

		$c->addJoin(CashTablePlayerBuyinPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$c->addJoin(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$c->addJoin(CashTablePlayerBuyinPeer::PEOPLE_ID, PeoplePeer::ID);

		$c->addJoin(CashTablePlayerBuyinPeer::PAY_METHOD_ID, VirtualTablePeer::ID);

		$c->addJoin(CashTablePlayerBuyinPeer::CLUB_CHECK_ID, ClubCheckPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePlayerBuyinPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = CashTablePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCashTable(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCashTablePlayerBuyin($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initCashTablePlayerBuyinList();
				$obj2->addCashTablePlayerBuyin($obj1);
			}


					
			$omClass = CashTableSessionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getCashTableSession(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addCashTablePlayerBuyin($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initCashTablePlayerBuyinList();
				$obj3->addCashTablePlayerBuyin($obj1);
			}


					
			$omClass = PeoplePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getPeople(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addCashTablePlayerBuyin($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initCashTablePlayerBuyinList();
				$obj4->addCashTablePlayerBuyin($obj1);
			}


					
			$omClass = VirtualTablePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getVirtualTable(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addCashTablePlayerBuyin($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initCashTablePlayerBuyinList();
				$obj5->addCashTablePlayerBuyin($obj1);
			}


					
			$omClass = ClubCheckPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6 = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getClubCheck(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addCashTablePlayerBuyin($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj6->initCashTablePlayerBuyinList();
				$obj6->addCashTablePlayerBuyin($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptCashTable(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CashTablePlayerBuyinPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePlayerBuyinPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$criteria->addJoin(CashTablePlayerBuyinPeer::PEOPLE_ID, PeoplePeer::ID);

		$criteria->addJoin(CashTablePlayerBuyinPeer::PAY_METHOD_ID, VirtualTablePeer::ID);

		$criteria->addJoin(CashTablePlayerBuyinPeer::CLUB_CHECK_ID, ClubCheckPeer::ID);

		$rs = CashTablePlayerBuyinPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(CashTablePlayerBuyinPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePlayerBuyinPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePlayerBuyinPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$criteria->addJoin(CashTablePlayerBuyinPeer::PEOPLE_ID, PeoplePeer::ID);

		$criteria->addJoin(CashTablePlayerBuyinPeer::PAY_METHOD_ID, VirtualTablePeer::ID);

		$criteria->addJoin(CashTablePlayerBuyinPeer::CLUB_CHECK_ID, ClubCheckPeer::ID);

		$rs = CashTablePlayerBuyinPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(CashTablePlayerBuyinPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePlayerBuyinPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePlayerBuyinPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$criteria->addJoin(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$criteria->addJoin(CashTablePlayerBuyinPeer::PAY_METHOD_ID, VirtualTablePeer::ID);

		$criteria->addJoin(CashTablePlayerBuyinPeer::CLUB_CHECK_ID, ClubCheckPeer::ID);

		$rs = CashTablePlayerBuyinPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptVirtualTable(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CashTablePlayerBuyinPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePlayerBuyinPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePlayerBuyinPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$criteria->addJoin(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$criteria->addJoin(CashTablePlayerBuyinPeer::PEOPLE_ID, PeoplePeer::ID);

		$criteria->addJoin(CashTablePlayerBuyinPeer::CLUB_CHECK_ID, ClubCheckPeer::ID);

		$rs = CashTablePlayerBuyinPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptClubCheck(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CashTablePlayerBuyinPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePlayerBuyinPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePlayerBuyinPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$criteria->addJoin(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$criteria->addJoin(CashTablePlayerBuyinPeer::PEOPLE_ID, PeoplePeer::ID);

		$criteria->addJoin(CashTablePlayerBuyinPeer::PAY_METHOD_ID, VirtualTablePeer::ID);

		$rs = CashTablePlayerBuyinPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptCashTable(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CashTablePlayerBuyinPeer::addSelectColumns($c);
		$startcol2 = (CashTablePlayerBuyinPeer::NUM_COLUMNS - CashTablePlayerBuyinPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CashTableSessionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CashTableSessionPeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PeoplePeer::NUM_COLUMNS;

		VirtualTablePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + VirtualTablePeer::NUM_COLUMNS;

		ClubCheckPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ClubCheckPeer::NUM_COLUMNS;

		$c->addJoin(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$c->addJoin(CashTablePlayerBuyinPeer::PEOPLE_ID, PeoplePeer::ID);

		$c->addJoin(CashTablePlayerBuyinPeer::PAY_METHOD_ID, VirtualTablePeer::ID);

		$c->addJoin(CashTablePlayerBuyinPeer::CLUB_CHECK_ID, ClubCheckPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePlayerBuyinPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CashTableSessionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCashTableSession(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCashTablePlayerBuyin($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCashTablePlayerBuyinList();
				$obj2->addCashTablePlayerBuyin($obj1);
			}

			$omClass = PeoplePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getPeople(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addCashTablePlayerBuyin($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initCashTablePlayerBuyinList();
				$obj3->addCashTablePlayerBuyin($obj1);
			}

			$omClass = VirtualTablePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getVirtualTable(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addCashTablePlayerBuyin($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initCashTablePlayerBuyinList();
				$obj4->addCashTablePlayerBuyin($obj1);
			}

			$omClass = ClubCheckPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getClubCheck(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addCashTablePlayerBuyin($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initCashTablePlayerBuyinList();
				$obj5->addCashTablePlayerBuyin($obj1);
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

		CashTablePlayerBuyinPeer::addSelectColumns($c);
		$startcol2 = (CashTablePlayerBuyinPeer::NUM_COLUMNS - CashTablePlayerBuyinPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CashTablePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CashTablePeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PeoplePeer::NUM_COLUMNS;

		VirtualTablePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + VirtualTablePeer::NUM_COLUMNS;

		ClubCheckPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ClubCheckPeer::NUM_COLUMNS;

		$c->addJoin(CashTablePlayerBuyinPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$c->addJoin(CashTablePlayerBuyinPeer::PEOPLE_ID, PeoplePeer::ID);

		$c->addJoin(CashTablePlayerBuyinPeer::PAY_METHOD_ID, VirtualTablePeer::ID);

		$c->addJoin(CashTablePlayerBuyinPeer::CLUB_CHECK_ID, ClubCheckPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePlayerBuyinPeer::getOMClass();

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
					$temp_obj2->addCashTablePlayerBuyin($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCashTablePlayerBuyinList();
				$obj2->addCashTablePlayerBuyin($obj1);
			}

			$omClass = PeoplePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getPeople(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addCashTablePlayerBuyin($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initCashTablePlayerBuyinList();
				$obj3->addCashTablePlayerBuyin($obj1);
			}

			$omClass = VirtualTablePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getVirtualTable(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addCashTablePlayerBuyin($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initCashTablePlayerBuyinList();
				$obj4->addCashTablePlayerBuyin($obj1);
			}

			$omClass = ClubCheckPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getClubCheck(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addCashTablePlayerBuyin($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initCashTablePlayerBuyinList();
				$obj5->addCashTablePlayerBuyin($obj1);
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

		CashTablePlayerBuyinPeer::addSelectColumns($c);
		$startcol2 = (CashTablePlayerBuyinPeer::NUM_COLUMNS - CashTablePlayerBuyinPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CashTablePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CashTablePeer::NUM_COLUMNS;

		CashTableSessionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CashTableSessionPeer::NUM_COLUMNS;

		VirtualTablePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + VirtualTablePeer::NUM_COLUMNS;

		ClubCheckPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ClubCheckPeer::NUM_COLUMNS;

		$c->addJoin(CashTablePlayerBuyinPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$c->addJoin(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$c->addJoin(CashTablePlayerBuyinPeer::PAY_METHOD_ID, VirtualTablePeer::ID);

		$c->addJoin(CashTablePlayerBuyinPeer::CLUB_CHECK_ID, ClubCheckPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePlayerBuyinPeer::getOMClass();

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
					$temp_obj2->addCashTablePlayerBuyin($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCashTablePlayerBuyinList();
				$obj2->addCashTablePlayerBuyin($obj1);
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
					$temp_obj3->addCashTablePlayerBuyin($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initCashTablePlayerBuyinList();
				$obj3->addCashTablePlayerBuyin($obj1);
			}

			$omClass = VirtualTablePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getVirtualTable(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addCashTablePlayerBuyin($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initCashTablePlayerBuyinList();
				$obj4->addCashTablePlayerBuyin($obj1);
			}

			$omClass = ClubCheckPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getClubCheck(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addCashTablePlayerBuyin($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initCashTablePlayerBuyinList();
				$obj5->addCashTablePlayerBuyin($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptVirtualTable(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CashTablePlayerBuyinPeer::addSelectColumns($c);
		$startcol2 = (CashTablePlayerBuyinPeer::NUM_COLUMNS - CashTablePlayerBuyinPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CashTablePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CashTablePeer::NUM_COLUMNS;

		CashTableSessionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CashTableSessionPeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + PeoplePeer::NUM_COLUMNS;

		ClubCheckPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ClubCheckPeer::NUM_COLUMNS;

		$c->addJoin(CashTablePlayerBuyinPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$c->addJoin(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$c->addJoin(CashTablePlayerBuyinPeer::PEOPLE_ID, PeoplePeer::ID);

		$c->addJoin(CashTablePlayerBuyinPeer::CLUB_CHECK_ID, ClubCheckPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePlayerBuyinPeer::getOMClass();

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
					$temp_obj2->addCashTablePlayerBuyin($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCashTablePlayerBuyinList();
				$obj2->addCashTablePlayerBuyin($obj1);
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
					$temp_obj3->addCashTablePlayerBuyin($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initCashTablePlayerBuyinList();
				$obj3->addCashTablePlayerBuyin($obj1);
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
					$temp_obj4->addCashTablePlayerBuyin($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initCashTablePlayerBuyinList();
				$obj4->addCashTablePlayerBuyin($obj1);
			}

			$omClass = ClubCheckPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getClubCheck(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addCashTablePlayerBuyin($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initCashTablePlayerBuyinList();
				$obj5->addCashTablePlayerBuyin($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptClubCheck(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CashTablePlayerBuyinPeer::addSelectColumns($c);
		$startcol2 = (CashTablePlayerBuyinPeer::NUM_COLUMNS - CashTablePlayerBuyinPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CashTablePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CashTablePeer::NUM_COLUMNS;

		CashTableSessionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CashTableSessionPeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + PeoplePeer::NUM_COLUMNS;

		VirtualTablePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + VirtualTablePeer::NUM_COLUMNS;

		$c->addJoin(CashTablePlayerBuyinPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$c->addJoin(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$c->addJoin(CashTablePlayerBuyinPeer::PEOPLE_ID, PeoplePeer::ID);

		$c->addJoin(CashTablePlayerBuyinPeer::PAY_METHOD_ID, VirtualTablePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePlayerBuyinPeer::getOMClass();

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
					$temp_obj2->addCashTablePlayerBuyin($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCashTablePlayerBuyinList();
				$obj2->addCashTablePlayerBuyin($obj1);
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
					$temp_obj3->addCashTablePlayerBuyin($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initCashTablePlayerBuyinList();
				$obj3->addCashTablePlayerBuyin($obj1);
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
					$temp_obj4->addCashTablePlayerBuyin($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initCashTablePlayerBuyinList();
				$obj4->addCashTablePlayerBuyin($obj1);
			}

			$omClass = VirtualTablePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getVirtualTable(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addCashTablePlayerBuyin($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initCashTablePlayerBuyinList();
				$obj5->addCashTablePlayerBuyin($obj1);
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
		return CashTablePlayerBuyinPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(CashTablePlayerBuyinPeer::CASH_TABLE_ID);
			$selectCriteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_ID, $criteria->remove(CashTablePlayerBuyinPeer::CASH_TABLE_ID), $comparison);

			$comparison = $criteria->getComparison(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID);
			$selectCriteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, $criteria->remove(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID), $comparison);

			$comparison = $criteria->getComparison(CashTablePlayerBuyinPeer::PEOPLE_ID);
			$selectCriteria->add(CashTablePlayerBuyinPeer::PEOPLE_ID, $criteria->remove(CashTablePlayerBuyinPeer::PEOPLE_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(CashTablePlayerBuyinPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(CashTablePlayerBuyinPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof CashTablePlayerBuyin) {

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

			$criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_ID, $vals[0], Criteria::IN);
			$criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, $vals[1], Criteria::IN);
			$criteria->add(CashTablePlayerBuyinPeer::PEOPLE_ID, $vals[2], Criteria::IN);
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

	
	public static function doValidate(CashTablePlayerBuyin $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CashTablePlayerBuyinPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CashTablePlayerBuyinPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(CashTablePlayerBuyinPeer::DATABASE_NAME, CashTablePlayerBuyinPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CashTablePlayerBuyinPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $cash_table_id, $cash_table_session_id, $people_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_ID, $cash_table_id);
		$criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, $cash_table_session_id);
		$criteria->add(CashTablePlayerBuyinPeer::PEOPLE_ID, $people_id);
		$v = CashTablePlayerBuyinPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseCashTablePlayerBuyinPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'apps/backend/lib/model/map/CashTablePlayerBuyinMapBuilder.php';
	Propel::registerMapBuilder('...apps.backend.lib.model.map.CashTablePlayerBuyinMapBuilder');
}
