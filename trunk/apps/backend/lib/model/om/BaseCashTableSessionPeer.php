<?php


abstract class BaseCashTableSessionPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'cash_table_session';

	
	const CLASS_DEFAULT = '...apps.backend.lib.model.CashTableSession';

	
	const NUM_COLUMNS = 13;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'cash_table_session.ID';

	
	const CASH_TABLE_ID = 'cash_table_session.CASH_TABLE_ID';

	
	const OPENED_AT = 'cash_table_session.OPENED_AT';

	
	const CLOSED_AT = 'cash_table_session.CLOSED_AT';

	
	const USER_ADMIN_ID_OPEN = 'cash_table_session.USER_ADMIN_ID_OPEN';

	
	const USER_ADMIN_ID_CLOSE = 'cash_table_session.USER_ADMIN_ID_CLOSE';

	
	const TOTAL_PLAYERS = 'cash_table_session.TOTAL_PLAYERS';

	
	const TOTAL_DEALERS = 'cash_table_session.TOTAL_DEALERS';

	
	const ENABLED = 'cash_table_session.ENABLED';

	
	const VISIBLE = 'cash_table_session.VISIBLE';

	
	const DELETED = 'cash_table_session.DELETED';

	
	const CREATED_AT = 'cash_table_session.CREATED_AT';

	
	const UPDATED_AT = 'cash_table_session.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'CashTableId', 'OpenedAt', 'ClosedAt', 'UserAdminIdOpen', 'UserAdminIdClose', 'TotalPlayers', 'TotalDealers', 'Enabled', 'Visible', 'Deleted', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (CashTableSessionPeer::ID, CashTableSessionPeer::CASH_TABLE_ID, CashTableSessionPeer::OPENED_AT, CashTableSessionPeer::CLOSED_AT, CashTableSessionPeer::USER_ADMIN_ID_OPEN, CashTableSessionPeer::USER_ADMIN_ID_CLOSE, CashTableSessionPeer::TOTAL_PLAYERS, CashTableSessionPeer::TOTAL_DEALERS, CashTableSessionPeer::ENABLED, CashTableSessionPeer::VISIBLE, CashTableSessionPeer::DELETED, CashTableSessionPeer::CREATED_AT, CashTableSessionPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'cash_table_id', 'opened_at', 'closed_at', 'user_admin_id_open', 'user_admin_id_close', 'total_players', 'total_dealers', 'enabled', 'visible', 'deleted', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'CASH_TABLE_ID'=>'', 'OPENED_AT'=>'', 'CLOSED_AT'=>'', 'USER_ADMIN_ID_OPEN'=>'', 'USER_ADMIN_ID_CLOSE'=>'', 'TOTAL_PLAYERS'=>'', 'TOTAL_DEALERS'=>'', 'ENABLED'=>'', 'VISIBLE'=>'', 'DELETED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'CashTableId'=>1, 'OpenedAt'=>2, 'ClosedAt'=>3, 'UserAdminIdOpen'=>4, 'UserAdminIdClose'=>5, 'TotalPlayers'=>6, 'TotalDealers'=>7, 'Enabled'=>8, 'Visible'=>9, 'Deleted'=>10, 'CreatedAt'=>11, 'UpdatedAt'=>12, ),
		BasePeer::TYPE_COLNAME=>array (CashTableSessionPeer::ID=>0, CashTableSessionPeer::CASH_TABLE_ID=>1, CashTableSessionPeer::OPENED_AT=>2, CashTableSessionPeer::CLOSED_AT=>3, CashTableSessionPeer::USER_ADMIN_ID_OPEN=>4, CashTableSessionPeer::USER_ADMIN_ID_CLOSE=>5, CashTableSessionPeer::TOTAL_PLAYERS=>6, CashTableSessionPeer::TOTAL_DEALERS=>7, CashTableSessionPeer::ENABLED=>8, CashTableSessionPeer::VISIBLE=>9, CashTableSessionPeer::DELETED=>10, CashTableSessionPeer::CREATED_AT=>11, CashTableSessionPeer::UPDATED_AT=>12, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'cash_table_id'=>1, 'opened_at'=>2, 'closed_at'=>3, 'user_admin_id_open'=>4, 'user_admin_id_close'=>5, 'total_players'=>6, 'total_dealers'=>7, 'enabled'=>8, 'visible'=>9, 'deleted'=>10, 'created_at'=>11, 'updated_at'=>12, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'apps/backend/lib/model/map/CashTableSessionMapBuilder.php';
		return BasePeer::getMapBuilder('...apps.backend.lib.model.map.CashTableSessionMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = CashTableSessionPeer::getTableMap();
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
		return str_replace(CashTableSessionPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(CashTableSessionPeer::ID);

		$criteria->addSelectColumn(CashTableSessionPeer::CASH_TABLE_ID);

		$criteria->addSelectColumn(CashTableSessionPeer::OPENED_AT);

		$criteria->addSelectColumn(CashTableSessionPeer::CLOSED_AT);

		$criteria->addSelectColumn(CashTableSessionPeer::USER_ADMIN_ID_OPEN);

		$criteria->addSelectColumn(CashTableSessionPeer::USER_ADMIN_ID_CLOSE);

		$criteria->addSelectColumn(CashTableSessionPeer::TOTAL_PLAYERS);

		$criteria->addSelectColumn(CashTableSessionPeer::TOTAL_DEALERS);

		$criteria->addSelectColumn(CashTableSessionPeer::ENABLED);

		$criteria->addSelectColumn(CashTableSessionPeer::VISIBLE);

		$criteria->addSelectColumn(CashTableSessionPeer::DELETED);

		$criteria->addSelectColumn(CashTableSessionPeer::CREATED_AT);

		$criteria->addSelectColumn(CashTableSessionPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(cash_table_session.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT cash_table_session.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CashTableSessionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTableSessionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = CashTableSessionPeer::doSelectRS($criteria, $con);
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
		$objects = CashTableSessionPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return CashTableSessionPeer::populateObjects(CashTableSessionPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			CashTableSessionPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = CashTableSessionPeer::getOMClass();
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
			$criteria->addSelectColumn(CashTableSessionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTableSessionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTableSessionPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$rs = CashTableSessionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinUserAdminRelatedByUserAdminIdOpen(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CashTableSessionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTableSessionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTableSessionPeer::USER_ADMIN_ID_OPEN, UserAdminPeer::ID);

		$rs = CashTableSessionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinUserAdminRelatedByUserAdminIdClose(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CashTableSessionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTableSessionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTableSessionPeer::USER_ADMIN_ID_CLOSE, UserAdminPeer::ID);

		$rs = CashTableSessionPeer::doSelectRS($criteria, $con);
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

		CashTableSessionPeer::addSelectColumns($c);
		$startcol = (CashTableSessionPeer::NUM_COLUMNS - CashTableSessionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CashTablePeer::addSelectColumns($c);

		$c->addJoin(CashTableSessionPeer::CASH_TABLE_ID, CashTablePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTableSessionPeer::getOMClass();

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
										$temp_obj2->addCashTableSession($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCashTableSessionList();
				$obj2->addCashTableSession($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinUserAdminRelatedByUserAdminIdOpen(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CashTableSessionPeer::addSelectColumns($c);
		$startcol = (CashTableSessionPeer::NUM_COLUMNS - CashTableSessionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserAdminPeer::addSelectColumns($c);

		$c->addJoin(CashTableSessionPeer::USER_ADMIN_ID_OPEN, UserAdminPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTableSessionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserAdminPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUserAdminRelatedByUserAdminIdOpen(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addCashTableSessionRelatedByUserAdminIdOpen($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCashTableSessionListRelatedByUserAdminIdOpen();
				$obj2->addCashTableSessionRelatedByUserAdminIdOpen($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinUserAdminRelatedByUserAdminIdClose(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CashTableSessionPeer::addSelectColumns($c);
		$startcol = (CashTableSessionPeer::NUM_COLUMNS - CashTableSessionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserAdminPeer::addSelectColumns($c);

		$c->addJoin(CashTableSessionPeer::USER_ADMIN_ID_CLOSE, UserAdminPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTableSessionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserAdminPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUserAdminRelatedByUserAdminIdClose(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addCashTableSessionRelatedByUserAdminIdClose($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initCashTableSessionListRelatedByUserAdminIdClose();
				$obj2->addCashTableSessionRelatedByUserAdminIdClose($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CashTableSessionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTableSessionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTableSessionPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$criteria->addJoin(CashTableSessionPeer::USER_ADMIN_ID_OPEN, UserAdminPeer::ID);

		$criteria->addJoin(CashTableSessionPeer::USER_ADMIN_ID_CLOSE, UserAdminPeer::ID);

		$rs = CashTableSessionPeer::doSelectRS($criteria, $con);
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

		CashTableSessionPeer::addSelectColumns($c);
		$startcol2 = (CashTableSessionPeer::NUM_COLUMNS - CashTableSessionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CashTablePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CashTablePeer::NUM_COLUMNS;

		UserAdminPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UserAdminPeer::NUM_COLUMNS;

		UserAdminPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + UserAdminPeer::NUM_COLUMNS;

		$c->addJoin(CashTableSessionPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$c->addJoin(CashTableSessionPeer::USER_ADMIN_ID_OPEN, UserAdminPeer::ID);

		$c->addJoin(CashTableSessionPeer::USER_ADMIN_ID_CLOSE, UserAdminPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTableSessionPeer::getOMClass();


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
					$temp_obj2->addCashTableSession($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initCashTableSessionList();
				$obj2->addCashTableSession($obj1);
			}


					
			$omClass = UserAdminPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUserAdminRelatedByUserAdminIdOpen(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addCashTableSessionRelatedByUserAdminIdOpen($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initCashTableSessionListRelatedByUserAdminIdOpen();
				$obj3->addCashTableSessionRelatedByUserAdminIdOpen($obj1);
			}


					
			$omClass = UserAdminPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getUserAdminRelatedByUserAdminIdClose(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addCashTableSessionRelatedByUserAdminIdClose($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initCashTableSessionListRelatedByUserAdminIdClose();
				$obj4->addCashTableSessionRelatedByUserAdminIdClose($obj1);
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
			$criteria->addSelectColumn(CashTableSessionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTableSessionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTableSessionPeer::USER_ADMIN_ID_OPEN, UserAdminPeer::ID);

		$criteria->addJoin(CashTableSessionPeer::USER_ADMIN_ID_CLOSE, UserAdminPeer::ID);

		$rs = CashTableSessionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptUserAdminRelatedByUserAdminIdOpen(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CashTableSessionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTableSessionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTableSessionPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$rs = CashTableSessionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptUserAdminRelatedByUserAdminIdClose(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CashTableSessionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CashTableSessionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CashTableSessionPeer::CASH_TABLE_ID, CashTablePeer::ID);

		$rs = CashTableSessionPeer::doSelectRS($criteria, $con);
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

		CashTableSessionPeer::addSelectColumns($c);
		$startcol2 = (CashTableSessionPeer::NUM_COLUMNS - CashTableSessionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserAdminPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserAdminPeer::NUM_COLUMNS;

		UserAdminPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UserAdminPeer::NUM_COLUMNS;

		$c->addJoin(CashTableSessionPeer::USER_ADMIN_ID_OPEN, UserAdminPeer::ID);

		$c->addJoin(CashTableSessionPeer::USER_ADMIN_ID_CLOSE, UserAdminPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTableSessionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserAdminPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUserAdminRelatedByUserAdminIdOpen(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCashTableSessionRelatedByUserAdminIdOpen($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCashTableSessionListRelatedByUserAdminIdOpen();
				$obj2->addCashTableSessionRelatedByUserAdminIdOpen($obj1);
			}

			$omClass = UserAdminPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUserAdminRelatedByUserAdminIdClose(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addCashTableSessionRelatedByUserAdminIdClose($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initCashTableSessionListRelatedByUserAdminIdClose();
				$obj3->addCashTableSessionRelatedByUserAdminIdClose($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptUserAdminRelatedByUserAdminIdOpen(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CashTableSessionPeer::addSelectColumns($c);
		$startcol2 = (CashTableSessionPeer::NUM_COLUMNS - CashTableSessionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CashTablePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CashTablePeer::NUM_COLUMNS;

		$c->addJoin(CashTableSessionPeer::CASH_TABLE_ID, CashTablePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTableSessionPeer::getOMClass();

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
					$temp_obj2->addCashTableSession($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCashTableSessionList();
				$obj2->addCashTableSession($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptUserAdminRelatedByUserAdminIdClose(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CashTableSessionPeer::addSelectColumns($c);
		$startcol2 = (CashTableSessionPeer::NUM_COLUMNS - CashTableSessionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CashTablePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CashTablePeer::NUM_COLUMNS;

		$c->addJoin(CashTableSessionPeer::CASH_TABLE_ID, CashTablePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CashTableSessionPeer::getOMClass();

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
					$temp_obj2->addCashTableSession($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCashTableSessionList();
				$obj2->addCashTableSession($obj1);
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
		return CashTableSessionPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(CashTableSessionPeer::ID); 

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
			$comparison = $criteria->getComparison(CashTableSessionPeer::ID);
			$selectCriteria->add(CashTableSessionPeer::ID, $criteria->remove(CashTableSessionPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(CashTableSessionPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(CashTableSessionPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof CashTableSession) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(CashTableSessionPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(CashTableSession $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CashTableSessionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CashTableSessionPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(CashTableSessionPeer::DATABASE_NAME, CashTableSessionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CashTableSessionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(CashTableSessionPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(CashTableSessionPeer::ID, $pk);


		$v = CashTableSessionPeer::doSelect($criteria, $con);

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
			$criteria->add(CashTableSessionPeer::ID, $pks, Criteria::IN);
			$objs = CashTableSessionPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseCashTableSessionPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'apps/backend/lib/model/map/CashTableSessionMapBuilder.php';
	Propel::registerMapBuilder('...apps.backend.lib.model.map.CashTableSessionMapBuilder');
}
