<?php


abstract class BaseCashTablePlayerPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'cash_table_player';

	
	const CLASS_DEFAULT = '...apps.backend.lib.model.CashTablePlayer';

	
	const NUM_COLUMNS = 12;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'cash_table_player.ID';

	
	const CASH_TABLE_ID = 'cash_table_player.CASH_TABLE_ID';

	
	const CASH_TABLE_SESSION_ID = 'cash_table_player.CASH_TABLE_SESSION_ID';

	
	const PEOPLE_ID = 'cash_table_player.PEOPLE_ID';

	
	const TABLE_POSITION = 'cash_table_player.TABLE_POSITION';

	
	const BUYIN = 'cash_table_player.BUYIN';

	
	const ENTRANCE_FEE = 'cash_table_player.ENTRANCE_FEE';

	
	const CASH_OUT = 'cash_table_player.CASH_OUT';

	
	const CHECKIN_AT = 'cash_table_player.CHECKIN_AT';

	
	const CHECKOUT_AT = 'cash_table_player.CHECKOUT_AT';

	
	const CREATED_AT = 'cash_table_player.CREATED_AT';

	
	const UPDATED_AT = 'cash_table_player.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'CashTableId', 'CashTableSessionId', 'PeopleId', 'TablePosition', 'Buyin', 'EntranceFee', 'CashOut', 'CheckinAt', 'CheckoutAt', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (CashTablePlayerPeer::ID, CashTablePlayerPeer::CASH_TABLE_ID, CashTablePlayerPeer::CASH_TABLE_SESSION_ID, CashTablePlayerPeer::PEOPLE_ID, CashTablePlayerPeer::TABLE_POSITION, CashTablePlayerPeer::BUYIN, CashTablePlayerPeer::ENTRANCE_FEE, CashTablePlayerPeer::CASH_OUT, CashTablePlayerPeer::CHECKIN_AT, CashTablePlayerPeer::CHECKOUT_AT, CashTablePlayerPeer::CREATED_AT, CashTablePlayerPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'cash_table_id', 'cash_table_session_id', 'people_id', 'table_position', 'buyin', 'entrance_fee', 'cash_out', 'checkin_at', 'checkout_at', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'CASH_TABLE_ID'=>'', 'CASH_TABLE_SESSION_ID'=>'', 'PEOPLE_ID'=>'', 'TABLE_POSITION'=>'', 'BUYIN'=>'', 'ENTRANCE_FEE'=>'', 'CASH_OUT'=>'', 'CHECKIN_AT'=>'', 'CHECKOUT_AT'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'CashTableId'=>1, 'CashTableSessionId'=>2, 'PeopleId'=>3, 'TablePosition'=>4, 'Buyin'=>5, 'EntranceFee'=>6, 'CashOut'=>7, 'CheckinAt'=>8, 'CheckoutAt'=>9, 'CreatedAt'=>10, 'UpdatedAt'=>11, ),
		BasePeer::TYPE_COLNAME=>array (CashTablePlayerPeer::ID=>0, CashTablePlayerPeer::CASH_TABLE_ID=>1, CashTablePlayerPeer::CASH_TABLE_SESSION_ID=>2, CashTablePlayerPeer::PEOPLE_ID=>3, CashTablePlayerPeer::TABLE_POSITION=>4, CashTablePlayerPeer::BUYIN=>5, CashTablePlayerPeer::ENTRANCE_FEE=>6, CashTablePlayerPeer::CASH_OUT=>7, CashTablePlayerPeer::CHECKIN_AT=>8, CashTablePlayerPeer::CHECKOUT_AT=>9, CashTablePlayerPeer::CREATED_AT=>10, CashTablePlayerPeer::UPDATED_AT=>11, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'cash_table_id'=>1, 'cash_table_session_id'=>2, 'people_id'=>3, 'table_position'=>4, 'buyin'=>5, 'entrance_fee'=>6, 'cash_out'=>7, 'checkin_at'=>8, 'checkout_at'=>9, 'created_at'=>10, 'updated_at'=>11, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'apps/backend/lib/model/map/CashTablePlayerMapBuilder.php';
		return BasePeer::getMapBuilder('...apps.backend.lib.model.map.CashTablePlayerMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = CashTablePlayerPeer::getTableMap();
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
		return str_replace(CashTablePlayerPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(CashTablePlayerPeer::ID);

		$criteria->addSelectColumn(CashTablePlayerPeer::CASH_TABLE_ID);

		$criteria->addSelectColumn(CashTablePlayerPeer::CASH_TABLE_SESSION_ID);

		$criteria->addSelectColumn(CashTablePlayerPeer::PEOPLE_ID);

		$criteria->addSelectColumn(CashTablePlayerPeer::TABLE_POSITION);

		$criteria->addSelectColumn(CashTablePlayerPeer::BUYIN);

		$criteria->addSelectColumn(CashTablePlayerPeer::ENTRANCE_FEE);

		$criteria->addSelectColumn(CashTablePlayerPeer::CASH_OUT);

		$criteria->addSelectColumn(CashTablePlayerPeer::CHECKIN_AT);

		$criteria->addSelectColumn(CashTablePlayerPeer::CHECKOUT_AT);

		$criteria->addSelectColumn(CashTablePlayerPeer::CREATED_AT);

		$criteria->addSelectColumn(CashTablePlayerPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(cash_table_player.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT cash_table_player.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CashTablePlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = CashTablePlayerPeer::doSelectRS($criteria, $con);
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
		$objects = CashTablePlayerPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return CashTablePlayerPeer::populateObjects(CashTablePlayerPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			CashTablePlayerPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = CashTablePlayerPeer::getOMClass();
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
			$criteria->addSelectColumn(CashTablePlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePlayerPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$rs = CashTablePlayerPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(CashTablePlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePlayerPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$rs = CashTablePlayerPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(CashTablePlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePlayerPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = CashTablePlayerPeer::doSelectRS($criteria, $con);
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

		CashTablePlayerPeer::addSelectColumns($c);
		$startcol = (CashTablePlayerPeer::NUM_COLUMNS - CashTablePlayerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CashTablePeer::addSelectColumns($c);

		$c->addJoin(CashTablePlayerPeer::CASH_TABLE_ID, CashTablePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePlayerPeer::getOMClass();

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
										$temp_obj2->addCashTablePlayer($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCashTablePlayerList();
				$obj2->addCashTablePlayer($obj1); 			}
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

		CashTablePlayerPeer::addSelectColumns($c);
		$startcol = (CashTablePlayerPeer::NUM_COLUMNS - CashTablePlayerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CashTableSessionPeer::addSelectColumns($c);

		$c->addJoin(CashTablePlayerPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePlayerPeer::getOMClass();

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
										$temp_obj2->addCashTablePlayer($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCashTablePlayerList();
				$obj2->addCashTablePlayer($obj1); 			}
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

		CashTablePlayerPeer::addSelectColumns($c);
		$startcol = (CashTablePlayerPeer::NUM_COLUMNS - CashTablePlayerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PeoplePeer::addSelectColumns($c);

		$c->addJoin(CashTablePlayerPeer::PEOPLE_ID, PeoplePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePlayerPeer::getOMClass();

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
										$temp_obj2->addCashTablePlayer($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCashTablePlayerList();
				$obj2->addCashTablePlayer($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CashTablePlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePlayerPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$criteria->addJoin(CashTablePlayerPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$criteria->addJoin(CashTablePlayerPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = CashTablePlayerPeer::doSelectRS($criteria, $con);
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

		CashTablePlayerPeer::addSelectColumns($c);
		$startcol2 = (CashTablePlayerPeer::NUM_COLUMNS - CashTablePlayerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CashTablePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CashTablePeer::NUM_COLUMNS;

		CashTableSessionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CashTableSessionPeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(CashTablePlayerPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$c->addJoin(CashTablePlayerPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$c->addJoin(CashTablePlayerPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePlayerPeer::getOMClass();


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
					$temp_obj2->addCashTablePlayer($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initCashTablePlayerList();
				$obj2->addCashTablePlayer($obj1);
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
					$temp_obj3->addCashTablePlayer($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initCashTablePlayerList();
				$obj3->addCashTablePlayer($obj1);
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
					$temp_obj4->addCashTablePlayer($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initCashTablePlayerList();
				$obj4->addCashTablePlayer($obj1);
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
			$criteria->addSelectColumn(CashTablePlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePlayerPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$criteria->addJoin(CashTablePlayerPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = CashTablePlayerPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(CashTablePlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePlayerPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$criteria->addJoin(CashTablePlayerPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = CashTablePlayerPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(CashTablePlayerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTablePlayerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTablePlayerPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$criteria->addJoin(CashTablePlayerPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$rs = CashTablePlayerPeer::doSelectRS($criteria, $con);
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

		CashTablePlayerPeer::addSelectColumns($c);
		$startcol2 = (CashTablePlayerPeer::NUM_COLUMNS - CashTablePlayerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CashTableSessionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CashTableSessionPeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(CashTablePlayerPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$c->addJoin(CashTablePlayerPeer::PEOPLE_ID, PeoplePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePlayerPeer::getOMClass();

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
					$temp_obj2->addCashTablePlayer($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCashTablePlayerList();
				$obj2->addCashTablePlayer($obj1);
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
					$temp_obj3->addCashTablePlayer($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initCashTablePlayerList();
				$obj3->addCashTablePlayer($obj1);
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

		CashTablePlayerPeer::addSelectColumns($c);
		$startcol2 = (CashTablePlayerPeer::NUM_COLUMNS - CashTablePlayerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CashTablePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CashTablePeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(CashTablePlayerPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$c->addJoin(CashTablePlayerPeer::PEOPLE_ID, PeoplePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePlayerPeer::getOMClass();

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
					$temp_obj2->addCashTablePlayer($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCashTablePlayerList();
				$obj2->addCashTablePlayer($obj1);
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
					$temp_obj3->addCashTablePlayer($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initCashTablePlayerList();
				$obj3->addCashTablePlayer($obj1);
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

		CashTablePlayerPeer::addSelectColumns($c);
		$startcol2 = (CashTablePlayerPeer::NUM_COLUMNS - CashTablePlayerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CashTablePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CashTablePeer::NUM_COLUMNS;

		CashTableSessionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CashTableSessionPeer::NUM_COLUMNS;

		$c->addJoin(CashTablePlayerPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$c->addJoin(CashTablePlayerPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTablePlayerPeer::getOMClass();

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
					$temp_obj2->addCashTablePlayer($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCashTablePlayerList();
				$obj2->addCashTablePlayer($obj1);
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
					$temp_obj3->addCashTablePlayer($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initCashTablePlayerList();
				$obj3->addCashTablePlayer($obj1);
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
		return CashTablePlayerPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(CashTablePlayerPeer::ID); 

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
			$comparison = $criteria->getComparison(CashTablePlayerPeer::ID);
			$selectCriteria->add(CashTablePlayerPeer::ID, $criteria->remove(CashTablePlayerPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(CashTablePlayerPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(CashTablePlayerPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof CashTablePlayer) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(CashTablePlayerPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(CashTablePlayer $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CashTablePlayerPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CashTablePlayerPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(CashTablePlayerPeer::DATABASE_NAME, CashTablePlayerPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CashTablePlayerPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(CashTablePlayerPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(CashTablePlayerPeer::ID, $pk);


		$v = CashTablePlayerPeer::doSelect($criteria, $con);

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
			$criteria->add(CashTablePlayerPeer::ID, $pks, Criteria::IN);
			$objs = CashTablePlayerPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseCashTablePlayerPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'apps/backend/lib/model/map/CashTablePlayerMapBuilder.php';
	Propel::registerMapBuilder('...apps.backend.lib.model.map.CashTablePlayerMapBuilder');
}
