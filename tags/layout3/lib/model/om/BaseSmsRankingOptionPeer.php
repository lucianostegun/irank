<?php


abstract class BaseSmsRankingOptionPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'sms_ranking_option';

	
	const CLASS_DEFAULT = 'lib.model.SmsRankingOption';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const PEOPLE_ID = 'sms_ranking_option.PEOPLE_ID';

	
	const RANKING_ID = 'sms_ranking_option.RANKING_ID';

	
	const SMS_TEMPLATE_ID = 'sms_ranking_option.SMS_TEMPLATE_ID';

	
	const LOCK_SEND = 'sms_ranking_option.LOCK_SEND';

	
	const CREATED_AT = 'sms_ranking_option.CREATED_AT';

	
	const UPDATED_AT = 'sms_ranking_option.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('PeopleId', 'RankingId', 'SmsTemplateId', 'LockSend', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (SmsRankingOptionPeer::PEOPLE_ID, SmsRankingOptionPeer::RANKING_ID, SmsRankingOptionPeer::SMS_TEMPLATE_ID, SmsRankingOptionPeer::LOCK_SEND, SmsRankingOptionPeer::CREATED_AT, SmsRankingOptionPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('people_id', 'ranking_id', 'sms_template_id', 'lock_send', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('PEOPLE_ID'=>'', 'RANKING_ID'=>'', 'SMS_TEMPLATE_ID'=>'', 'LOCK_SEND'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('PeopleId'=>0, 'RankingId'=>1, 'SmsTemplateId'=>2, 'LockSend'=>3, 'CreatedAt'=>4, 'UpdatedAt'=>5, ),
		BasePeer::TYPE_COLNAME=>array (SmsRankingOptionPeer::PEOPLE_ID=>0, SmsRankingOptionPeer::RANKING_ID=>1, SmsRankingOptionPeer::SMS_TEMPLATE_ID=>2, SmsRankingOptionPeer::LOCK_SEND=>3, SmsRankingOptionPeer::CREATED_AT=>4, SmsRankingOptionPeer::UPDATED_AT=>5, ),
		BasePeer::TYPE_FIELDNAME=>array ('people_id'=>0, 'ranking_id'=>1, 'sms_template_id'=>2, 'lock_send'=>3, 'created_at'=>4, 'updated_at'=>5, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/SmsRankingOptionMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.SmsRankingOptionMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = SmsRankingOptionPeer::getTableMap();
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
		return str_replace(SmsRankingOptionPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(SmsRankingOptionPeer::PEOPLE_ID);

		$criteria->addSelectColumn(SmsRankingOptionPeer::RANKING_ID);

		$criteria->addSelectColumn(SmsRankingOptionPeer::SMS_TEMPLATE_ID);

		$criteria->addSelectColumn(SmsRankingOptionPeer::LOCK_SEND);

		$criteria->addSelectColumn(SmsRankingOptionPeer::CREATED_AT);

		$criteria->addSelectColumn(SmsRankingOptionPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(sms_ranking_option.PEOPLE_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT sms_ranking_option.PEOPLE_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SmsRankingOptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SmsRankingOptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SmsRankingOptionPeer::doSelectRS($criteria, $con);
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
		$objects = SmsRankingOptionPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return SmsRankingOptionPeer::populateObjects(SmsRankingOptionPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			SmsRankingOptionPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = SmsRankingOptionPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinPeople(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SmsRankingOptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SmsRankingOptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SmsRankingOptionPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = SmsRankingOptionPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(SmsRankingOptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SmsRankingOptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SmsRankingOptionPeer::RANKING_ID, RankingPeer::ID);

		$rs = SmsRankingOptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinSmsTemplate(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SmsRankingOptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SmsRankingOptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SmsRankingOptionPeer::SMS_TEMPLATE_ID, SmsTemplatePeer::ID);

		$rs = SmsRankingOptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinPeople(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SmsRankingOptionPeer::addSelectColumns($c);
		$startcol = (SmsRankingOptionPeer::NUM_COLUMNS - SmsRankingOptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PeoplePeer::addSelectColumns($c);

		$c->addJoin(SmsRankingOptionPeer::PEOPLE_ID, PeoplePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SmsRankingOptionPeer::getOMClass();

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
										$temp_obj2->addSmsRankingOption($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initSmsRankingOptionList();
				$obj2->addSmsRankingOption($obj1); 			}
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

		SmsRankingOptionPeer::addSelectColumns($c);
		$startcol = (SmsRankingOptionPeer::NUM_COLUMNS - SmsRankingOptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		RankingPeer::addSelectColumns($c);

		$c->addJoin(SmsRankingOptionPeer::RANKING_ID, RankingPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SmsRankingOptionPeer::getOMClass();

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
										$temp_obj2->addSmsRankingOption($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initSmsRankingOptionList();
				$obj2->addSmsRankingOption($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinSmsTemplate(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SmsRankingOptionPeer::addSelectColumns($c);
		$startcol = (SmsRankingOptionPeer::NUM_COLUMNS - SmsRankingOptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SmsTemplatePeer::addSelectColumns($c);

		$c->addJoin(SmsRankingOptionPeer::SMS_TEMPLATE_ID, SmsTemplatePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SmsRankingOptionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SmsTemplatePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getSmsTemplate(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addSmsRankingOption($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initSmsRankingOptionList();
				$obj2->addSmsRankingOption($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SmsRankingOptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SmsRankingOptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SmsRankingOptionPeer::PEOPLE_ID, PeoplePeer::ID);

		$criteria->addJoin(SmsRankingOptionPeer::RANKING_ID, RankingPeer::ID);

		$criteria->addJoin(SmsRankingOptionPeer::SMS_TEMPLATE_ID, SmsTemplatePeer::ID);

		$rs = SmsRankingOptionPeer::doSelectRS($criteria, $con);
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

		SmsRankingOptionPeer::addSelectColumns($c);
		$startcol2 = (SmsRankingOptionPeer::NUM_COLUMNS - SmsRankingOptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PeoplePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PeoplePeer::NUM_COLUMNS;

		RankingPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + RankingPeer::NUM_COLUMNS;

		SmsTemplatePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + SmsTemplatePeer::NUM_COLUMNS;

		$c->addJoin(SmsRankingOptionPeer::PEOPLE_ID, PeoplePeer::ID);

		$c->addJoin(SmsRankingOptionPeer::RANKING_ID, RankingPeer::ID);

		$c->addJoin(SmsRankingOptionPeer::SMS_TEMPLATE_ID, SmsTemplatePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SmsRankingOptionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = PeoplePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPeople(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSmsRankingOption($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initSmsRankingOptionList();
				$obj2->addSmsRankingOption($obj1);
			}


					
			$omClass = RankingPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getRanking(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addSmsRankingOption($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initSmsRankingOptionList();
				$obj3->addSmsRankingOption($obj1);
			}


					
			$omClass = SmsTemplatePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getSmsTemplate(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addSmsRankingOption($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initSmsRankingOptionList();
				$obj4->addSmsRankingOption($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptPeople(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SmsRankingOptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SmsRankingOptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SmsRankingOptionPeer::RANKING_ID, RankingPeer::ID);

		$criteria->addJoin(SmsRankingOptionPeer::SMS_TEMPLATE_ID, SmsTemplatePeer::ID);

		$rs = SmsRankingOptionPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(SmsRankingOptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SmsRankingOptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SmsRankingOptionPeer::PEOPLE_ID, PeoplePeer::ID);

		$criteria->addJoin(SmsRankingOptionPeer::SMS_TEMPLATE_ID, SmsTemplatePeer::ID);

		$rs = SmsRankingOptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptSmsTemplate(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SmsRankingOptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SmsRankingOptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SmsRankingOptionPeer::PEOPLE_ID, PeoplePeer::ID);

		$criteria->addJoin(SmsRankingOptionPeer::RANKING_ID, RankingPeer::ID);

		$rs = SmsRankingOptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptPeople(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SmsRankingOptionPeer::addSelectColumns($c);
		$startcol2 = (SmsRankingOptionPeer::NUM_COLUMNS - SmsRankingOptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RankingPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RankingPeer::NUM_COLUMNS;

		SmsTemplatePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SmsTemplatePeer::NUM_COLUMNS;

		$c->addJoin(SmsRankingOptionPeer::RANKING_ID, RankingPeer::ID);

		$c->addJoin(SmsRankingOptionPeer::SMS_TEMPLATE_ID, SmsTemplatePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SmsRankingOptionPeer::getOMClass();

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
					$temp_obj2->addSmsRankingOption($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSmsRankingOptionList();
				$obj2->addSmsRankingOption($obj1);
			}

			$omClass = SmsTemplatePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getSmsTemplate(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addSmsRankingOption($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initSmsRankingOptionList();
				$obj3->addSmsRankingOption($obj1);
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

		SmsRankingOptionPeer::addSelectColumns($c);
		$startcol2 = (SmsRankingOptionPeer::NUM_COLUMNS - SmsRankingOptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PeoplePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PeoplePeer::NUM_COLUMNS;

		SmsTemplatePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + SmsTemplatePeer::NUM_COLUMNS;

		$c->addJoin(SmsRankingOptionPeer::PEOPLE_ID, PeoplePeer::ID);

		$c->addJoin(SmsRankingOptionPeer::SMS_TEMPLATE_ID, SmsTemplatePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SmsRankingOptionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PeoplePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPeople(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSmsRankingOption($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSmsRankingOptionList();
				$obj2->addSmsRankingOption($obj1);
			}

			$omClass = SmsTemplatePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getSmsTemplate(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addSmsRankingOption($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initSmsRankingOptionList();
				$obj3->addSmsRankingOption($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptSmsTemplate(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SmsRankingOptionPeer::addSelectColumns($c);
		$startcol2 = (SmsRankingOptionPeer::NUM_COLUMNS - SmsRankingOptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PeoplePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PeoplePeer::NUM_COLUMNS;

		RankingPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + RankingPeer::NUM_COLUMNS;

		$c->addJoin(SmsRankingOptionPeer::PEOPLE_ID, PeoplePeer::ID);

		$c->addJoin(SmsRankingOptionPeer::RANKING_ID, RankingPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SmsRankingOptionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PeoplePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPeople(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSmsRankingOption($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSmsRankingOptionList();
				$obj2->addSmsRankingOption($obj1);
			}

			$omClass = RankingPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getRanking(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addSmsRankingOption($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initSmsRankingOptionList();
				$obj3->addSmsRankingOption($obj1);
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
		return SmsRankingOptionPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(SmsRankingOptionPeer::PEOPLE_ID);
			$selectCriteria->add(SmsRankingOptionPeer::PEOPLE_ID, $criteria->remove(SmsRankingOptionPeer::PEOPLE_ID), $comparison);

			$comparison = $criteria->getComparison(SmsRankingOptionPeer::RANKING_ID);
			$selectCriteria->add(SmsRankingOptionPeer::RANKING_ID, $criteria->remove(SmsRankingOptionPeer::RANKING_ID), $comparison);

			$comparison = $criteria->getComparison(SmsRankingOptionPeer::SMS_TEMPLATE_ID);
			$selectCriteria->add(SmsRankingOptionPeer::SMS_TEMPLATE_ID, $criteria->remove(SmsRankingOptionPeer::SMS_TEMPLATE_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(SmsRankingOptionPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(SmsRankingOptionPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof SmsRankingOption) {

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

			$criteria->add(SmsRankingOptionPeer::PEOPLE_ID, $vals[0], Criteria::IN);
			$criteria->add(SmsRankingOptionPeer::RANKING_ID, $vals[1], Criteria::IN);
			$criteria->add(SmsRankingOptionPeer::SMS_TEMPLATE_ID, $vals[2], Criteria::IN);
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

	
	public static function doValidate(SmsRankingOption $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SmsRankingOptionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SmsRankingOptionPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(SmsRankingOptionPeer::DATABASE_NAME, SmsRankingOptionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SmsRankingOptionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $people_id, $ranking_id, $sms_template_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(SmsRankingOptionPeer::PEOPLE_ID, $people_id);
		$criteria->add(SmsRankingOptionPeer::RANKING_ID, $ranking_id);
		$criteria->add(SmsRankingOptionPeer::SMS_TEMPLATE_ID, $sms_template_id);
		$v = SmsRankingOptionPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseSmsRankingOptionPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/SmsRankingOptionMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.SmsRankingOptionMapBuilder');
}
