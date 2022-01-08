<?php


abstract class BaseRankingSubscriptionRequestPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'ranking_subscription_request';

	
	const CLASS_DEFAULT = 'lib.model.RankingSubscriptionRequest';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'ranking_subscription_request.ID';

	
	const USER_SITE_ID = 'ranking_subscription_request.USER_SITE_ID';

	
	const USER_SITE_ID_OWNER = 'ranking_subscription_request.USER_SITE_ID_OWNER';

	
	const RANKING_ID = 'ranking_subscription_request.RANKING_ID';

	
	const REQUEST_STATUS = 'ranking_subscription_request.REQUEST_STATUS';

	
	const CREATED_AT = 'ranking_subscription_request.CREATED_AT';

	
	const UPDATED_AT = 'ranking_subscription_request.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'UserSiteId', 'UserSiteIdOwner', 'RankingId', 'RequestStatus', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (RankingSubscriptionRequestPeer::ID, RankingSubscriptionRequestPeer::USER_SITE_ID, RankingSubscriptionRequestPeer::USER_SITE_ID_OWNER, RankingSubscriptionRequestPeer::RANKING_ID, RankingSubscriptionRequestPeer::REQUEST_STATUS, RankingSubscriptionRequestPeer::CREATED_AT, RankingSubscriptionRequestPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'user_site_id', 'user_site_id_owner', 'ranking_id', 'request_status', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'USER_SITE_ID'=>'', 'USER_SITE_ID_OWNER'=>'', 'RANKING_ID'=>'', 'REQUEST_STATUS'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'UserSiteId'=>1, 'UserSiteIdOwner'=>2, 'RankingId'=>3, 'RequestStatus'=>4, 'CreatedAt'=>5, 'UpdatedAt'=>6, ),
		BasePeer::TYPE_COLNAME=>array (RankingSubscriptionRequestPeer::ID=>0, RankingSubscriptionRequestPeer::USER_SITE_ID=>1, RankingSubscriptionRequestPeer::USER_SITE_ID_OWNER=>2, RankingSubscriptionRequestPeer::RANKING_ID=>3, RankingSubscriptionRequestPeer::REQUEST_STATUS=>4, RankingSubscriptionRequestPeer::CREATED_AT=>5, RankingSubscriptionRequestPeer::UPDATED_AT=>6, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'user_site_id'=>1, 'user_site_id_owner'=>2, 'ranking_id'=>3, 'request_status'=>4, 'created_at'=>5, 'updated_at'=>6, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/RankingSubscriptionRequestMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.RankingSubscriptionRequestMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = RankingSubscriptionRequestPeer::getTableMap();
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
		return str_replace(RankingSubscriptionRequestPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(RankingSubscriptionRequestPeer::ID);

		$criteria->addSelectColumn(RankingSubscriptionRequestPeer::USER_SITE_ID);

		$criteria->addSelectColumn(RankingSubscriptionRequestPeer::USER_SITE_ID_OWNER);

		$criteria->addSelectColumn(RankingSubscriptionRequestPeer::RANKING_ID);

		$criteria->addSelectColumn(RankingSubscriptionRequestPeer::REQUEST_STATUS);

		$criteria->addSelectColumn(RankingSubscriptionRequestPeer::CREATED_AT);

		$criteria->addSelectColumn(RankingSubscriptionRequestPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(ranking_subscription_request.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT ranking_subscription_request.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingSubscriptionRequestPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingSubscriptionRequestPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = RankingSubscriptionRequestPeer::doSelectRS($criteria, $con);
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
		$objects = RankingSubscriptionRequestPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return RankingSubscriptionRequestPeer::populateObjects(RankingSubscriptionRequestPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			RankingSubscriptionRequestPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = RankingSubscriptionRequestPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinUserSiteRelatedByUserSiteId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingSubscriptionRequestPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingSubscriptionRequestPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingSubscriptionRequestPeer::USER_SITE_ID, UserSitePeer::ID);

		$rs = RankingSubscriptionRequestPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinUserSiteRelatedByUserSiteIdOwner(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingSubscriptionRequestPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingSubscriptionRequestPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingSubscriptionRequestPeer::USER_SITE_ID_OWNER, UserSitePeer::ID);

		$rs = RankingSubscriptionRequestPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinRanking(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingSubscriptionRequestPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingSubscriptionRequestPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingSubscriptionRequestPeer::RANKING_ID, RankingPeer::ID);

		$rs = RankingSubscriptionRequestPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinUserSiteRelatedByUserSiteId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RankingSubscriptionRequestPeer::addSelectColumns($c);
		$startcol = (RankingSubscriptionRequestPeer::NUM_COLUMNS - RankingSubscriptionRequestPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserSitePeer::addSelectColumns($c);

		$c->addJoin(RankingSubscriptionRequestPeer::USER_SITE_ID, UserSitePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingSubscriptionRequestPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserSitePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUserSiteRelatedByUserSiteId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addRankingSubscriptionRequestRelatedByUserSiteId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRankingSubscriptionRequestListRelatedByUserSiteId();
				$obj2->addRankingSubscriptionRequestRelatedByUserSiteId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinUserSiteRelatedByUserSiteIdOwner(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RankingSubscriptionRequestPeer::addSelectColumns($c);
		$startcol = (RankingSubscriptionRequestPeer::NUM_COLUMNS - RankingSubscriptionRequestPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserSitePeer::addSelectColumns($c);

		$c->addJoin(RankingSubscriptionRequestPeer::USER_SITE_ID_OWNER, UserSitePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingSubscriptionRequestPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserSitePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUserSiteRelatedByUserSiteIdOwner(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addRankingSubscriptionRequestRelatedByUserSiteIdOwner($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRankingSubscriptionRequestListRelatedByUserSiteIdOwner();
				$obj2->addRankingSubscriptionRequestRelatedByUserSiteIdOwner($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinRanking(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RankingSubscriptionRequestPeer::addSelectColumns($c);
		$startcol = (RankingSubscriptionRequestPeer::NUM_COLUMNS - RankingSubscriptionRequestPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		RankingPeer::addSelectColumns($c);

		$c->addJoin(RankingSubscriptionRequestPeer::RANKING_ID, RankingPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingSubscriptionRequestPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = RankingPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getRanking(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addRankingSubscriptionRequest($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRankingSubscriptionRequestList();
				$obj2->addRankingSubscriptionRequest($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingSubscriptionRequestPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingSubscriptionRequestPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingSubscriptionRequestPeer::USER_SITE_ID, UserSitePeer::ID);

		$criteria->addJoin(RankingSubscriptionRequestPeer::USER_SITE_ID_OWNER, UserSitePeer::ID);

		$criteria->addJoin(RankingSubscriptionRequestPeer::RANKING_ID, RankingPeer::ID);

		$rs = RankingSubscriptionRequestPeer::doSelectRS($criteria, $con);
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

		RankingSubscriptionRequestPeer::addSelectColumns($c);
		$startcol2 = (RankingSubscriptionRequestPeer::NUM_COLUMNS - RankingSubscriptionRequestPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserSitePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserSitePeer::NUM_COLUMNS;

		UserSitePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UserSitePeer::NUM_COLUMNS;

		RankingPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + RankingPeer::NUM_COLUMNS;

		$c->addJoin(RankingSubscriptionRequestPeer::USER_SITE_ID, UserSitePeer::ID);

		$c->addJoin(RankingSubscriptionRequestPeer::USER_SITE_ID_OWNER, UserSitePeer::ID);

		$c->addJoin(RankingSubscriptionRequestPeer::RANKING_ID, RankingPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingSubscriptionRequestPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = UserSitePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUserSiteRelatedByUserSiteId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRankingSubscriptionRequestRelatedByUserSiteId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initRankingSubscriptionRequestListRelatedByUserSiteId();
				$obj2->addRankingSubscriptionRequestRelatedByUserSiteId($obj1);
			}


					
			$omClass = UserSitePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUserSiteRelatedByUserSiteIdOwner(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addRankingSubscriptionRequestRelatedByUserSiteIdOwner($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initRankingSubscriptionRequestListRelatedByUserSiteIdOwner();
				$obj3->addRankingSubscriptionRequestRelatedByUserSiteIdOwner($obj1);
			}


					
			$omClass = RankingPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getRanking(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addRankingSubscriptionRequest($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initRankingSubscriptionRequestList();
				$obj4->addRankingSubscriptionRequest($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptUserSiteRelatedByUserSiteId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingSubscriptionRequestPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingSubscriptionRequestPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingSubscriptionRequestPeer::RANKING_ID, RankingPeer::ID);

		$rs = RankingSubscriptionRequestPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptUserSiteRelatedByUserSiteIdOwner(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingSubscriptionRequestPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingSubscriptionRequestPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingSubscriptionRequestPeer::RANKING_ID, RankingPeer::ID);

		$rs = RankingSubscriptionRequestPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptRanking(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RankingSubscriptionRequestPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RankingSubscriptionRequestPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RankingSubscriptionRequestPeer::USER_SITE_ID, UserSitePeer::ID);

		$criteria->addJoin(RankingSubscriptionRequestPeer::USER_SITE_ID_OWNER, UserSitePeer::ID);

		$rs = RankingSubscriptionRequestPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptUserSiteRelatedByUserSiteId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RankingSubscriptionRequestPeer::addSelectColumns($c);
		$startcol2 = (RankingSubscriptionRequestPeer::NUM_COLUMNS - RankingSubscriptionRequestPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RankingPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RankingPeer::NUM_COLUMNS;

		$c->addJoin(RankingSubscriptionRequestPeer::RANKING_ID, RankingPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingSubscriptionRequestPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = RankingPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getRanking(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRankingSubscriptionRequest($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRankingSubscriptionRequestList();
				$obj2->addRankingSubscriptionRequest($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptUserSiteRelatedByUserSiteIdOwner(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RankingSubscriptionRequestPeer::addSelectColumns($c);
		$startcol2 = (RankingSubscriptionRequestPeer::NUM_COLUMNS - RankingSubscriptionRequestPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RankingPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RankingPeer::NUM_COLUMNS;

		$c->addJoin(RankingSubscriptionRequestPeer::RANKING_ID, RankingPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingSubscriptionRequestPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = RankingPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getRanking(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRankingSubscriptionRequest($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRankingSubscriptionRequestList();
				$obj2->addRankingSubscriptionRequest($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptRanking(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RankingSubscriptionRequestPeer::addSelectColumns($c);
		$startcol2 = (RankingSubscriptionRequestPeer::NUM_COLUMNS - RankingSubscriptionRequestPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserSitePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserSitePeer::NUM_COLUMNS;

		UserSitePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UserSitePeer::NUM_COLUMNS;

		$c->addJoin(RankingSubscriptionRequestPeer::USER_SITE_ID, UserSitePeer::ID);

		$c->addJoin(RankingSubscriptionRequestPeer::USER_SITE_ID_OWNER, UserSitePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RankingSubscriptionRequestPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserSitePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUserSiteRelatedByUserSiteId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRankingSubscriptionRequestRelatedByUserSiteId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRankingSubscriptionRequestListRelatedByUserSiteId();
				$obj2->addRankingSubscriptionRequestRelatedByUserSiteId($obj1);
			}

			$omClass = UserSitePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUserSiteRelatedByUserSiteIdOwner(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addRankingSubscriptionRequestRelatedByUserSiteIdOwner($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initRankingSubscriptionRequestListRelatedByUserSiteIdOwner();
				$obj3->addRankingSubscriptionRequestRelatedByUserSiteIdOwner($obj1);
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
		return RankingSubscriptionRequestPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(RankingSubscriptionRequestPeer::ID); 

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
			$comparison = $criteria->getComparison(RankingSubscriptionRequestPeer::ID);
			$selectCriteria->add(RankingSubscriptionRequestPeer::ID, $criteria->remove(RankingSubscriptionRequestPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(RankingSubscriptionRequestPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(RankingSubscriptionRequestPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof RankingSubscriptionRequest) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(RankingSubscriptionRequestPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(RankingSubscriptionRequest $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RankingSubscriptionRequestPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RankingSubscriptionRequestPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(RankingSubscriptionRequestPeer::DATABASE_NAME, RankingSubscriptionRequestPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RankingSubscriptionRequestPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(RankingSubscriptionRequestPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(RankingSubscriptionRequestPeer::ID, $pk);


		$v = RankingSubscriptionRequestPeer::doSelect($criteria, $con);

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
			$criteria->add(RankingSubscriptionRequestPeer::ID, $pks, Criteria::IN);
			$objs = RankingSubscriptionRequestPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseRankingSubscriptionRequestPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/RankingSubscriptionRequestMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.RankingSubscriptionRequestMapBuilder');
}
