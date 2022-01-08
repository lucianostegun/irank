<?php


abstract class BaseCashTableDealerPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'cash_table_dealer';

	
	const CLASS_DEFAULT = '...apps.backend.lib.model.CashTableDealer';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'cash_table_dealer.ID';

	
	const CASH_TABLE_ID = 'cash_table_dealer.CASH_TABLE_ID';

	
	const CASH_TABLE_SESSION_ID = 'cash_table_dealer.CASH_TABLE_SESSION_ID';

	
	const PEOPLE_ID = 'cash_table_dealer.PEOPLE_ID';

	
	const CASHOUT_VALUE = 'cash_table_dealer.CASHOUT_VALUE';

	
	const CHECKIN_AT = 'cash_table_dealer.CHECKIN_AT';

	
	const CHECKOUT_AT = 'cash_table_dealer.CHECKOUT_AT';

	
	const CREATED_AT = 'cash_table_dealer.CREATED_AT';

	
	const UPDATED_AT = 'cash_table_dealer.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'CashTableId', 'CashTableSessionId', 'PeopleId', 'CashoutValue', 'CheckinAt', 'CheckoutAt', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (CashTableDealerPeer::ID, CashTableDealerPeer::CASH_TABLE_ID, CashTableDealerPeer::CASH_TABLE_SESSION_ID, CashTableDealerPeer::PEOPLE_ID, CashTableDealerPeer::CASHOUT_VALUE, CashTableDealerPeer::CHECKIN_AT, CashTableDealerPeer::CHECKOUT_AT, CashTableDealerPeer::CREATED_AT, CashTableDealerPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'cash_table_id', 'cash_table_session_id', 'people_id', 'cashout_value', 'checkin_at', 'checkout_at', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'CASH_TABLE_ID'=>'', 'CASH_TABLE_SESSION_ID'=>'', 'PEOPLE_ID'=>'', 'CASHOUT_VALUE'=>'', 'CHECKIN_AT'=>'', 'CHECKOUT_AT'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'CashTableId'=>1, 'CashTableSessionId'=>2, 'PeopleId'=>3, 'CashoutValue'=>4, 'CheckinAt'=>5, 'CheckoutAt'=>6, 'CreatedAt'=>7, 'UpdatedAt'=>8, ),
		BasePeer::TYPE_COLNAME=>array (CashTableDealerPeer::ID=>0, CashTableDealerPeer::CASH_TABLE_ID=>1, CashTableDealerPeer::CASH_TABLE_SESSION_ID=>2, CashTableDealerPeer::PEOPLE_ID=>3, CashTableDealerPeer::CASHOUT_VALUE=>4, CashTableDealerPeer::CHECKIN_AT=>5, CashTableDealerPeer::CHECKOUT_AT=>6, CashTableDealerPeer::CREATED_AT=>7, CashTableDealerPeer::UPDATED_AT=>8, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'cash_table_id'=>1, 'cash_table_session_id'=>2, 'people_id'=>3, 'cashout_value'=>4, 'checkin_at'=>5, 'checkout_at'=>6, 'created_at'=>7, 'updated_at'=>8, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'apps/backend/lib/model/map/CashTableDealerMapBuilder.php';
		return BasePeer::getMapBuilder('...apps.backend.lib.model.map.CashTableDealerMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = CashTableDealerPeer::getTableMap();
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
		return str_replace(CashTableDealerPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(CashTableDealerPeer::ID);

		$criteria->addSelectColumn(CashTableDealerPeer::CASH_TABLE_ID);

		$criteria->addSelectColumn(CashTableDealerPeer::CASH_TABLE_SESSION_ID);

		$criteria->addSelectColumn(CashTableDealerPeer::PEOPLE_ID);

		$criteria->addSelectColumn(CashTableDealerPeer::CASHOUT_VALUE);

		$criteria->addSelectColumn(CashTableDealerPeer::CHECKIN_AT);

		$criteria->addSelectColumn(CashTableDealerPeer::CHECKOUT_AT);

		$criteria->addSelectColumn(CashTableDealerPeer::CREATED_AT);

		$criteria->addSelectColumn(CashTableDealerPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(cash_table_dealer.CASH_TABLE_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT cash_table_dealer.CASH_TABLE_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CashTableDealerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTableDealerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = CashTableDealerPeer::doSelectRS($criteria, $con);
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
		$objects = CashTableDealerPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return CashTableDealerPeer::populateObjects(CashTableDealerPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			CashTableDealerPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = CashTableDealerPeer::getOMClass();
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
			$criteria->addSelectColumn(CashTableDealerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTableDealerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTableDealerPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$rs = CashTableDealerPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(CashTableDealerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTableDealerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTableDealerPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$rs = CashTableDealerPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(CashTableDealerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTableDealerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTableDealerPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = CashTableDealerPeer::doSelectRS($criteria, $con);
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

		CashTableDealerPeer::addSelectColumns($c);
		$startcol = (CashTableDealerPeer::NUM_COLUMNS - CashTableDealerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CashTablePeer::addSelectColumns($c);

		$c->addJoin(CashTableDealerPeer::CASH_TABLE_ID, CashTablePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTableDealerPeer::getOMClass();

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
										$temp_obj2->addCashTableDealer($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCashTableDealerList();
				$obj2->addCashTableDealer($obj1); 			}
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

		CashTableDealerPeer::addSelectColumns($c);
		$startcol = (CashTableDealerPeer::NUM_COLUMNS - CashTableDealerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CashTableSessionPeer::addSelectColumns($c);

		$c->addJoin(CashTableDealerPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTableDealerPeer::getOMClass();

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
										$temp_obj2->addCashTableDealer($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCashTableDealerList();
				$obj2->addCashTableDealer($obj1); 			}
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

		CashTableDealerPeer::addSelectColumns($c);
		$startcol = (CashTableDealerPeer::NUM_COLUMNS - CashTableDealerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PeoplePeer::addSelectColumns($c);

		$c->addJoin(CashTableDealerPeer::PEOPLE_ID, PeoplePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTableDealerPeer::getOMClass();

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
										$temp_obj2->addCashTableDealer($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCashTableDealerList();
				$obj2->addCashTableDealer($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CashTableDealerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTableDealerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTableDealerPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$criteria->addJoin(CashTableDealerPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$criteria->addJoin(CashTableDealerPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = CashTableDealerPeer::doSelectRS($criteria, $con);
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

		CashTableDealerPeer::addSelectColumns($c);
		$startcol2 = (CashTableDealerPeer::NUM_COLUMNS - CashTableDealerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CashTablePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CashTablePeer::NUM_COLUMNS;

		CashTableSessionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CashTableSessionPeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(CashTableDealerPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$c->addJoin(CashTableDealerPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$c->addJoin(CashTableDealerPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTableDealerPeer::getOMClass();


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
					$temp_obj2->addCashTableDealer($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initCashTableDealerList();
				$obj2->addCashTableDealer($obj1);
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
					$temp_obj3->addCashTableDealer($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initCashTableDealerList();
				$obj3->addCashTableDealer($obj1);
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
					$temp_obj4->addCashTableDealer($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initCashTableDealerList();
				$obj4->addCashTableDealer($obj1);
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
			$criteria->addSelectColumn(CashTableDealerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTableDealerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTableDealerPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$criteria->addJoin(CashTableDealerPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = CashTableDealerPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(CashTableDealerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTableDealerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTableDealerPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$criteria->addJoin(CashTableDealerPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = CashTableDealerPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(CashTableDealerPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTableDealerPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTableDealerPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$criteria->addJoin(CashTableDealerPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$rs = CashTableDealerPeer::doSelectRS($criteria, $con);
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

		CashTableDealerPeer::addSelectColumns($c);
		$startcol2 = (CashTableDealerPeer::NUM_COLUMNS - CashTableDealerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CashTableSessionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CashTableSessionPeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(CashTableDealerPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);

		$c->addJoin(CashTableDealerPeer::PEOPLE_ID, PeoplePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTableDealerPeer::getOMClass();

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
					$temp_obj2->addCashTableDealer($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCashTableDealerList();
				$obj2->addCashTableDealer($obj1);
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
					$temp_obj3->addCashTableDealer($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initCashTableDealerList();
				$obj3->addCashTableDealer($obj1);
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

		CashTableDealerPeer::addSelectColumns($c);
		$startcol2 = (CashTableDealerPeer::NUM_COLUMNS - CashTableDealerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CashTablePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CashTablePeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(CashTableDealerPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$c->addJoin(CashTableDealerPeer::PEOPLE_ID, PeoplePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTableDealerPeer::getOMClass();

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
					$temp_obj2->addCashTableDealer($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCashTableDealerList();
				$obj2->addCashTableDealer($obj1);
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
					$temp_obj3->addCashTableDealer($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initCashTableDealerList();
				$obj3->addCashTableDealer($obj1);
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

		CashTableDealerPeer::addSelectColumns($c);
		$startcol2 = (CashTableDealerPeer::NUM_COLUMNS - CashTableDealerPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CashTablePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CashTablePeer::NUM_COLUMNS;

		CashTableSessionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + CashTableSessionPeer::NUM_COLUMNS;

		$c->addJoin(CashTableDealerPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$c->addJoin(CashTableDealerPeer::CASH_TABLE_SESSION_ID, CashTableSessionPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTableDealerPeer::getOMClass();

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
					$temp_obj2->addCashTableDealer($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCashTableDealerList();
				$obj2->addCashTableDealer($obj1);
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
					$temp_obj3->addCashTableDealer($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initCashTableDealerList();
				$obj3->addCashTableDealer($obj1);
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
		return CashTableDealerPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(CashTableDealerPeer::CASH_TABLE_ID);
			$selectCriteria->add(CashTableDealerPeer::CASH_TABLE_ID, $criteria->remove(CashTableDealerPeer::CASH_TABLE_ID), $comparison);

			$comparison = $criteria->getComparison(CashTableDealerPeer::CASH_TABLE_SESSION_ID);
			$selectCriteria->add(CashTableDealerPeer::CASH_TABLE_SESSION_ID, $criteria->remove(CashTableDealerPeer::CASH_TABLE_SESSION_ID), $comparison);

			$comparison = $criteria->getComparison(CashTableDealerPeer::PEOPLE_ID);
			$selectCriteria->add(CashTableDealerPeer::PEOPLE_ID, $criteria->remove(CashTableDealerPeer::PEOPLE_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(CashTableDealerPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(CashTableDealerPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof CashTableDealer) {

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

			$criteria->add(CashTableDealerPeer::CASH_TABLE_ID, $vals[0], Criteria::IN);
			$criteria->add(CashTableDealerPeer::CASH_TABLE_SESSION_ID, $vals[1], Criteria::IN);
			$criteria->add(CashTableDealerPeer::PEOPLE_ID, $vals[2], Criteria::IN);
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

	
	public static function doValidate(CashTableDealer $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CashTableDealerPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CashTableDealerPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(CashTableDealerPeer::DATABASE_NAME, CashTableDealerPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CashTableDealerPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
		$criteria->add(CashTableDealerPeer::CASH_TABLE_ID, $cash_table_id);
		$criteria->add(CashTableDealerPeer::CASH_TABLE_SESSION_ID, $cash_table_session_id);
		$criteria->add(CashTableDealerPeer::PEOPLE_ID, $people_id);
		$v = CashTableDealerPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseCashTableDealerPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'apps/backend/lib/model/map/CashTableDealerMapBuilder.php';
	Propel::registerMapBuilder('...apps.backend.lib.model.map.CashTableDealerMapBuilder');
}
