<?php


abstract class BaseCashTablePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'cash_table';

	
	const CLASS_DEFAULT = '...apps.backend.lib.model.CashTable';

	
	const NUM_COLUMNS = 19;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'cash_table.ID';

	
	const CLUB_ID = 'cash_table.CLUB_ID';

	
	const PEOPLE_ID_DEALER = 'cash_table.PEOPLE_ID_DEALER';

	
	const GAME_TYPE_ID = 'cash_table.GAME_TYPE_ID';

	
	const CASH_TABLE_NAME = 'cash_table.CASH_TABLE_NAME';

	
	const TABLE_STATUS = 'cash_table.TABLE_STATUS';

	
	const PLAYERS = 'cash_table.PLAYERS';

	
	const SEATS = 'cash_table.SEATS';

	
	const ENTRANCE_FEE = 'cash_table.ENTRANCE_FEE';

	
	const BUYIN = 'cash_table.BUYIN';

	
	const COMMENTS = 'cash_table.COMMENTS';

	
	const LAST_OPENED_AT = 'cash_table.LAST_OPENED_AT';

	
	const CASH_TABLE_SESSION_ID = 'cash_table.CASH_TABLE_SESSION_ID';

	
	const ENABLED = 'cash_table.ENABLED';

	
	const VISIBLE = 'cash_table.VISIBLE';

	
	const DELETED = 'cash_table.DELETED';

	
	const LOCKED = 'cash_table.LOCKED';

	
	const CREATED_AT = 'cash_table.CREATED_AT';

	
	const UPDATED_AT = 'cash_table.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'ClubId', 'PeopleIdDealer', 'GameTypeId', 'CashTableName', 'TableStatus', 'Players', 'Seats', 'EntranceFee', 'Buyin', 'Comments', 'LastOpenedAt', 'CashTableSessionId', 'Enabled', 'Visible', 'Deleted', 'Locked', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (CashTablePeer::ID, CashTablePeer::CLUB_ID, CashTablePeer::PEOPLE_ID_DEALER, CashTablePeer::GAME_TYPE_ID, CashTablePeer::CASH_TABLE_NAME, CashTablePeer::TABLE_STATUS, CashTablePeer::PLAYERS, CashTablePeer::SEATS, CashTablePeer::ENTRANCE_FEE, CashTablePeer::BUYIN, CashTablePeer::COMMENTS, CashTablePeer::LAST_OPENED_AT, CashTablePeer::CASH_TABLE_SESSION_ID, CashTablePeer::ENABLED, CashTablePeer::VISIBLE, CashTablePeer::DELETED, CashTablePeer::LOCKED, CashTablePeer::CREATED_AT, CashTablePeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'club_id', 'people_id_dealer', 'game_type_id', 'cash_table_name', 'table_status', 'players', 'seats', 'entrance_fee', 'buyin', 'comments', 'last_opened_at', 'cash_table_session_id', 'enabled', 'visible', 'deleted', 'locked', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'CLUB_ID'=>'', 'PEOPLE_ID_DEALER'=>'', 'GAME_TYPE_ID'=>'', 'CASH_TABLE_NAME'=>'', 'TABLE_STATUS'=>'', 'PLAYERS'=>'', 'SEATS'=>'', 'ENTRANCE_FEE'=>'', 'BUYIN'=>'', 'COMMENTS'=>'', 'LAST_OPENED_AT'=>'', 'CASH_TABLE_SESSION_ID'=>'', 'ENABLED'=>'', 'VISIBLE'=>'', 'DELETED'=>'', 'LOCKED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'ClubId'=>1, 'PeopleIdDealer'=>2, 'GameTypeId'=>3, 'CashTableName'=>4, 'TableStatus'=>5, 'Players'=>6, 'Seats'=>7, 'EntranceFee'=>8, 'Buyin'=>9, 'Comments'=>10, 'LastOpenedAt'=>11, 'CashTableSessionId'=>12, 'Enabled'=>13, 'Visible'=>14, 'Deleted'=>15, 'Locked'=>16, 'CreatedAt'=>17, 'UpdatedAt'=>18, ),
		BasePeer::TYPE_COLNAME=>array (CashTablePeer::ID=>0, CashTablePeer::CLUB_ID=>1, CashTablePeer::PEOPLE_ID_DEALER=>2, CashTablePeer::GAME_TYPE_ID=>3, CashTablePeer::CASH_TABLE_NAME=>4, CashTablePeer::TABLE_STATUS=>5, CashTablePeer::PLAYERS=>6, CashTablePeer::SEATS=>7, CashTablePeer::ENTRANCE_FEE=>8, CashTablePeer::BUYIN=>9, CashTablePeer::COMMENTS=>10, CashTablePeer::LAST_OPENED_AT=>11, CashTablePeer::CASH_TABLE_SESSION_ID=>12, CashTablePeer::ENABLED=>13, CashTablePeer::VISIBLE=>14, CashTablePeer::DELETED=>15, CashTablePeer::LOCKED=>16, CashTablePeer::CREATED_AT=>17, CashTablePeer::UPDATED_AT=>18, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'club_id'=>1, 'people_id_dealer'=>2, 'game_type_id'=>3, 'cash_table_name'=>4, 'table_status'=>5, 'players'=>6, 'seats'=>7, 'entrance_fee'=>8, 'buyin'=>9, 'comments'=>10, 'last_opened_at'=>11, 'cash_table_session_id'=>12, 'enabled'=>13, 'visible'=>14, 'deleted'=>15, 'locked'=>16, 'created_at'=>17, 'updated_at'=>18, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'apps/backend/lib/model/map/CashTableMapBuilder.php';
		return BasePeer::getMapBuilder('...apps.backend.lib.model.map.CashTableMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = CashTablePeer::getTableMap();
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
		return str_replace(CashTablePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(CashTablePeer::ID);

		$criteria->addSelectColumn(CashTablePeer::CLUB_ID);

		$criteria->addSelectColumn(CashTablePeer::PEOPLE_ID_DEALER);

		$criteria->addSelectColumn(CashTablePeer::GAME_TYPE_ID);

		$criteria->addSelectColumn(CashTablePeer::CASH_TABLE_NAME);

		$criteria->addSelectColumn(CashTablePeer::TABLE_STATUS);

		$criteria->addSelectColumn(CashTablePeer::PLAYERS);

		$criteria->addSelectColumn(CashTablePeer::SEATS);

		$criteria->addSelectColumn(CashTablePeer::ENTRANCE_FEE);

		$criteria->addSelectColumn(CashTablePeer::BUYIN);

		$criteria->addSelectColumn(CashTablePeer::COMMENTS);

		$criteria->addSelectColumn(CashTablePeer::LAST_OPENED_AT);

		$criteria->addSelectColumn(CashTablePeer::CASH_TABLE_SESSION_ID);

		$criteria->addSelectColumn(CashTablePeer::ENABLED);

		$criteria->addSelectColumn(CashTablePeer::VISIBLE);

		$criteria->addSelectColumn(CashTablePeer::DELETED);

		$criteria->addSelectColumn(CashTablePeer::LOCKED);

		$criteria->addSelectColumn(CashTablePeer::CREATED_AT);

		$criteria->addSelectColumn(CashTablePeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(cash_table.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT cash_table.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CashTablePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = CashTablePeer::doSelectRS($criteria, $con);
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
		$objects = CashTablePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return CashTablePeer::populateObjects(CashTablePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			CashTablePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = CashTablePeer::getOMClass();
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
			$criteria->addSelectColumn(CashTablePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePeer::CLUB_ID, ClubPeer::ID);

		$rs = CashTablePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(CashTablePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$rs = CashTablePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(CashTablePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePeer::PEOPLE_ID_DEALER, PeoplePeer::ID);

		$rs = CashTablePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(CashTablePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePeer::GAME_TYPE_ID, VirtualTablePeer::ID);

		$rs = CashTablePeer::doSelectRS($criteria, $con);
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

		CashTablePeer::addSelectColumns($c);
		$startcol = (CashTablePeer::NUM_COLUMNS - CashTablePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ClubPeer::addSelectColumns($c);

		$c->addJoin(CashTablePeer::CLUB_ID, ClubPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePeer::getOMClass();

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
										$temp_obj2->addCashTable($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCashTableList();
				$obj2->addCashTable($obj1); 			}
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

		CashTablePeer::addSelectColumns($c);
		$startcol = (CashTablePeer::NUM_COLUMNS - CashTablePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CashTableSessionPeer::addSelectColumns($c);

		$c->addJoin(CashTablePeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePeer::getOMClass();

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
										$temp_obj2->addCashTable($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCashTableList();
				$obj2->addCashTable($obj1); 			}
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

		CashTablePeer::addSelectColumns($c);
		$startcol = (CashTablePeer::NUM_COLUMNS - CashTablePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PeoplePeer::addSelectColumns($c);

		$c->addJoin(CashTablePeer::PEOPLE_ID_DEALER, PeoplePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePeer::getOMClass();

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
										$temp_obj2->addCashTable($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCashTableList();
				$obj2->addCashTable($obj1); 			}
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

		CashTablePeer::addSelectColumns($c);
		$startcol = (CashTablePeer::NUM_COLUMNS - CashTablePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		VirtualTablePeer::addSelectColumns($c);

		$c->addJoin(CashTablePeer::GAME_TYPE_ID, VirtualTablePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePeer::getOMClass();

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
										$temp_obj2->addCashTable($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCashTableList();
				$obj2->addCashTable($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CashTablePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePeer::CLUB_ID, ClubPeer::ID);

		$criteria->addJoin(CashTablePeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$criteria->addJoin(CashTablePeer::PEOPLE_ID_DEALER, PeoplePeer::ID);

		$criteria->addJoin(CashTablePeer::GAME_TYPE_ID, VirtualTablePeer::ID);

		$rs = CashTablePeer::doSelectRS($criteria, $con);
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

		CashTablePeer::addSelectColumns($c);
		$startcol2 = (CashTablePeer::NUM_COLUMNS - CashTablePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ClubPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ClubPeer::NUM_COLUMNS;

		CashTableSessionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CashTableSessionPeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + PeoplePeer::NUM_COLUMNS;

		VirtualTablePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + VirtualTablePeer::NUM_COLUMNS;

		$c->addJoin(CashTablePeer::CLUB_ID, ClubPeer::ID);

		$c->addJoin(CashTablePeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$c->addJoin(CashTablePeer::PEOPLE_ID_DEALER, PeoplePeer::ID);

		$c->addJoin(CashTablePeer::GAME_TYPE_ID, VirtualTablePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePeer::getOMClass();


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
					$temp_obj2->addCashTable($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initCashTableList();
				$obj2->addCashTable($obj1);
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
					$temp_obj3->addCashTable($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initCashTableList();
				$obj3->addCashTable($obj1);
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
					$temp_obj4->addCashTable($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initCashTableList();
				$obj4->addCashTable($obj1);
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
					$temp_obj5->addCashTable($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initCashTableList();
				$obj5->addCashTable($obj1);
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
			$criteria->addSelectColumn(CashTablePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$criteria->addJoin(CashTablePeer::PEOPLE_ID_DEALER, PeoplePeer::ID);

		$criteria->addJoin(CashTablePeer::GAME_TYPE_ID, VirtualTablePeer::ID);

		$rs = CashTablePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(CashTablePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePeer::CLUB_ID, ClubPeer::ID);

		$criteria->addJoin(CashTablePeer::PEOPLE_ID_DEALER, PeoplePeer::ID);

		$criteria->addJoin(CashTablePeer::GAME_TYPE_ID, VirtualTablePeer::ID);

		$rs = CashTablePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(CashTablePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePeer::CLUB_ID, ClubPeer::ID);

		$criteria->addJoin(CashTablePeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$criteria->addJoin(CashTablePeer::GAME_TYPE_ID, VirtualTablePeer::ID);

		$rs = CashTablePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(CashTablePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePeer::CLUB_ID, ClubPeer::ID);

		$criteria->addJoin(CashTablePeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$criteria->addJoin(CashTablePeer::PEOPLE_ID_DEALER, PeoplePeer::ID);

		$rs = CashTablePeer::doSelectRS($criteria, $con);
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

		CashTablePeer::addSelectColumns($c);
		$startcol2 = (CashTablePeer::NUM_COLUMNS - CashTablePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CashTableSessionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CashTableSessionPeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PeoplePeer::NUM_COLUMNS;

		VirtualTablePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + VirtualTablePeer::NUM_COLUMNS;

		$c->addJoin(CashTablePeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$c->addJoin(CashTablePeer::PEOPLE_ID_DEALER, PeoplePeer::ID);

		$c->addJoin(CashTablePeer::GAME_TYPE_ID, VirtualTablePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePeer::getOMClass();

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
					$temp_obj2->addCashTable($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCashTableList();
				$obj2->addCashTable($obj1);
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
					$temp_obj3->addCashTable($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initCashTableList();
				$obj3->addCashTable($obj1);
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
					$temp_obj4->addCashTable($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initCashTableList();
				$obj4->addCashTable($obj1);
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

		CashTablePeer::addSelectColumns($c);
		$startcol2 = (CashTablePeer::NUM_COLUMNS - CashTablePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ClubPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ClubPeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PeoplePeer::NUM_COLUMNS;

		VirtualTablePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + VirtualTablePeer::NUM_COLUMNS;

		$c->addJoin(CashTablePeer::CLUB_ID, ClubPeer::ID);

		$c->addJoin(CashTablePeer::PEOPLE_ID_DEALER, PeoplePeer::ID);

		$c->addJoin(CashTablePeer::GAME_TYPE_ID, VirtualTablePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePeer::getOMClass();

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
					$temp_obj2->addCashTable($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCashTableList();
				$obj2->addCashTable($obj1);
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
					$temp_obj3->addCashTable($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initCashTableList();
				$obj3->addCashTable($obj1);
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
					$temp_obj4->addCashTable($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initCashTableList();
				$obj4->addCashTable($obj1);
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

		CashTablePeer::addSelectColumns($c);
		$startcol2 = (CashTablePeer::NUM_COLUMNS - CashTablePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ClubPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ClubPeer::NUM_COLUMNS;

		CashTableSessionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CashTableSessionPeer::NUM_COLUMNS;

		VirtualTablePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + VirtualTablePeer::NUM_COLUMNS;

		$c->addJoin(CashTablePeer::CLUB_ID, ClubPeer::ID);

		$c->addJoin(CashTablePeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$c->addJoin(CashTablePeer::GAME_TYPE_ID, VirtualTablePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePeer::getOMClass();

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
					$temp_obj2->addCashTable($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCashTableList();
				$obj2->addCashTable($obj1);
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
					$temp_obj3->addCashTable($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initCashTableList();
				$obj3->addCashTable($obj1);
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
					$temp_obj4->addCashTable($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initCashTableList();
				$obj4->addCashTable($obj1);
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

		CashTablePeer::addSelectColumns($c);
		$startcol2 = (CashTablePeer::NUM_COLUMNS - CashTablePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ClubPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ClubPeer::NUM_COLUMNS;

		CashTableSessionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CashTableSessionPeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(CashTablePeer::CLUB_ID, ClubPeer::ID);

		$c->addJoin(CashTablePeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$c->addJoin(CashTablePeer::PEOPLE_ID_DEALER, PeoplePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePeer::getOMClass();

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
					$temp_obj2->addCashTable($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCashTableList();
				$obj2->addCashTable($obj1);
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
					$temp_obj3->addCashTable($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initCashTableList();
				$obj3->addCashTable($obj1);
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
					$temp_obj4->addCashTable($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initCashTableList();
				$obj4->addCashTable($obj1);
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
		return CashTablePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(CashTablePeer::ID); 

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
			$comparison = $criteria->getComparison(CashTablePeer::ID);
			$selectCriteria->add(CashTablePeer::ID, $criteria->remove(CashTablePeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(CashTablePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(CashTablePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof CashTable) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(CashTablePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(CashTable $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CashTablePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CashTablePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(CashTablePeer::DATABASE_NAME, CashTablePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CashTablePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(CashTablePeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(CashTablePeer::ID, $pk);


		$v = CashTablePeer::doSelect($criteria, $con);

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
			$criteria->add(CashTablePeer::ID, $pks, Criteria::IN);
			$objs = CashTablePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseCashTablePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'apps/backend/lib/model/map/CashTableMapBuilder.php';
	Propel::registerMapBuilder('...apps.backend.lib.model.map.CashTableMapBuilder');
}
