<?php


abstract class BasePurchasePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'purchase';

	
	const CLASS_DEFAULT = 'lib.model.Purchase';

	
	const NUM_COLUMNS = 29;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'purchase.ID';

	
	const USER_SITE_ID = 'purchase.USER_SITE_ID';

	
	const FILE_ID = 'purchase.FILE_ID';

	
	const PAGSEGURO_URL = 'purchase.PAGSEGURO_URL';

	
	const ORDER_NUMBER = 'purchase.ORDER_NUMBER';

	
	const ORDER_STATUS = 'purchase.ORDER_STATUS';

	
	const ORDER_VALUE = 'purchase.ORDER_VALUE';

	
	const PRODUCTS = 'purchase.PRODUCTS';

	
	const ITENS = 'purchase.ITENS';

	
	const SHIPPING_VALUE = 'purchase.SHIPPING_VALUE';

	
	const TOTAL_VALUE = 'purchase.TOTAL_VALUE';

	
	const PAYMETHOD = 'purchase.PAYMETHOD';

	
	const IP_ADDRESS = 'purchase.IP_ADDRESS';

	
	const DURATION = 'purchase.DURATION';

	
	const APPROVAL_DATE = 'purchase.APPROVAL_DATE';

	
	const REFUSAL_DATE = 'purchase.REFUSAL_DATE';

	
	const REFUSAL_REASON = 'purchase.REFUSAL_REASON';

	
	const SHIPPING_DATE = 'purchase.SHIPPING_DATE';

	
	const TRACING_CODE = 'purchase.TRACING_CODE';

	
	const CUSTOMER_NAME = 'purchase.CUSTOMER_NAME';

	
	const ADDRESS_NAME = 'purchase.ADDRESS_NAME';

	
	const ADDRESS_NUMBER = 'purchase.ADDRESS_NUMBER';

	
	const ADDRESS_QUARTER = 'purchase.ADDRESS_QUARTER';

	
	const ADDRESS_COMPLEMENT = 'purchase.ADDRESS_COMPLEMENT';

	
	const ADDRESS_CITY = 'purchase.ADDRESS_CITY';

	
	const ADDRESS_STATE = 'purchase.ADDRESS_STATE';

	
	const ADDRESS_ZIPCODE = 'purchase.ADDRESS_ZIPCODE';

	
	const CREATED_AT = 'purchase.CREATED_AT';

	
	const UPDATED_AT = 'purchase.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'UserSiteId', 'FileId', 'PagseguroUrl', 'OrderNumber', 'OrderStatus', 'OrderValue', 'Products', 'Itens', 'ShippingValue', 'TotalValue', 'Paymethod', 'IpAddress', 'Duration', 'ApprovalDate', 'RefusalDate', 'RefusalReason', 'ShippingDate', 'TracingCode', 'CustomerName', 'AddressName', 'AddressNumber', 'AddressQuarter', 'AddressComplement', 'AddressCity', 'AddressState', 'AddressZipcode', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (PurchasePeer::ID, PurchasePeer::USER_SITE_ID, PurchasePeer::FILE_ID, PurchasePeer::PAGSEGURO_URL, PurchasePeer::ORDER_NUMBER, PurchasePeer::ORDER_STATUS, PurchasePeer::ORDER_VALUE, PurchasePeer::PRODUCTS, PurchasePeer::ITENS, PurchasePeer::SHIPPING_VALUE, PurchasePeer::TOTAL_VALUE, PurchasePeer::PAYMETHOD, PurchasePeer::IP_ADDRESS, PurchasePeer::DURATION, PurchasePeer::APPROVAL_DATE, PurchasePeer::REFUSAL_DATE, PurchasePeer::REFUSAL_REASON, PurchasePeer::SHIPPING_DATE, PurchasePeer::TRACING_CODE, PurchasePeer::CUSTOMER_NAME, PurchasePeer::ADDRESS_NAME, PurchasePeer::ADDRESS_NUMBER, PurchasePeer::ADDRESS_QUARTER, PurchasePeer::ADDRESS_COMPLEMENT, PurchasePeer::ADDRESS_CITY, PurchasePeer::ADDRESS_STATE, PurchasePeer::ADDRESS_ZIPCODE, PurchasePeer::CREATED_AT, PurchasePeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'user_site_id', 'file_id', 'pagseguro_url', 'order_number', 'order_status', 'order_value', 'products', 'itens', 'shipping_value', 'total_value', 'paymethod', 'ip_address', 'duration', 'approval_date', 'refusal_date', 'refusal_reason', 'shipping_date', 'tracing_code', 'customer_name', 'address_name', 'address_number', 'address_quarter', 'address_complement', 'address_city', 'address_state', 'address_zipcode', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'USER_SITE_ID'=>'', 'FILE_ID'=>'', 'PAGSEGURO_URL'=>'', 'ORDER_NUMBER'=>'', 'ORDER_STATUS'=>'', 'ORDER_VALUE'=>'', 'PRODUCTS'=>'', 'ITENS'=>'', 'SHIPPING_VALUE'=>'', 'TOTAL_VALUE'=>'', 'PAYMETHOD'=>'', 'IP_ADDRESS'=>'', 'DURATION'=>'', 'APPROVAL_DATE'=>'', 'REFUSAL_DATE'=>'', 'REFUSAL_REASON'=>'', 'SHIPPING_DATE'=>'', 'TRACING_CODE'=>'', 'CUSTOMER_NAME'=>'', 'ADDRESS_NAME'=>'', 'ADDRESS_NUMBER'=>'', 'ADDRESS_QUARTER'=>'', 'ADDRESS_COMPLEMENT'=>'', 'ADDRESS_CITY'=>'', 'ADDRESS_STATE'=>'', 'ADDRESS_ZIPCODE'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'UserSiteId'=>1, 'FileId'=>2, 'PagseguroUrl'=>3, 'OrderNumber'=>4, 'OrderStatus'=>5, 'OrderValue'=>6, 'Products'=>7, 'Itens'=>8, 'ShippingValue'=>9, 'TotalValue'=>10, 'Paymethod'=>11, 'IpAddress'=>12, 'Duration'=>13, 'ApprovalDate'=>14, 'RefusalDate'=>15, 'RefusalReason'=>16, 'ShippingDate'=>17, 'TracingCode'=>18, 'CustomerName'=>19, 'AddressName'=>20, 'AddressNumber'=>21, 'AddressQuarter'=>22, 'AddressComplement'=>23, 'AddressCity'=>24, 'AddressState'=>25, 'AddressZipcode'=>26, 'CreatedAt'=>27, 'UpdatedAt'=>28, ),
		BasePeer::TYPE_COLNAME=>array (PurchasePeer::ID=>0, PurchasePeer::USER_SITE_ID=>1, PurchasePeer::FILE_ID=>2, PurchasePeer::PAGSEGURO_URL=>3, PurchasePeer::ORDER_NUMBER=>4, PurchasePeer::ORDER_STATUS=>5, PurchasePeer::ORDER_VALUE=>6, PurchasePeer::PRODUCTS=>7, PurchasePeer::ITENS=>8, PurchasePeer::SHIPPING_VALUE=>9, PurchasePeer::TOTAL_VALUE=>10, PurchasePeer::PAYMETHOD=>11, PurchasePeer::IP_ADDRESS=>12, PurchasePeer::DURATION=>13, PurchasePeer::APPROVAL_DATE=>14, PurchasePeer::REFUSAL_DATE=>15, PurchasePeer::REFUSAL_REASON=>16, PurchasePeer::SHIPPING_DATE=>17, PurchasePeer::TRACING_CODE=>18, PurchasePeer::CUSTOMER_NAME=>19, PurchasePeer::ADDRESS_NAME=>20, PurchasePeer::ADDRESS_NUMBER=>21, PurchasePeer::ADDRESS_QUARTER=>22, PurchasePeer::ADDRESS_COMPLEMENT=>23, PurchasePeer::ADDRESS_CITY=>24, PurchasePeer::ADDRESS_STATE=>25, PurchasePeer::ADDRESS_ZIPCODE=>26, PurchasePeer::CREATED_AT=>27, PurchasePeer::UPDATED_AT=>28, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'user_site_id'=>1, 'file_id'=>2, 'pagseguro_url'=>3, 'order_number'=>4, 'order_status'=>5, 'order_value'=>6, 'products'=>7, 'itens'=>8, 'shipping_value'=>9, 'total_value'=>10, 'paymethod'=>11, 'ip_address'=>12, 'duration'=>13, 'approval_date'=>14, 'refusal_date'=>15, 'refusal_reason'=>16, 'shipping_date'=>17, 'tracing_code'=>18, 'customer_name'=>19, 'address_name'=>20, 'address_number'=>21, 'address_quarter'=>22, 'address_complement'=>23, 'address_city'=>24, 'address_state'=>25, 'address_zipcode'=>26, 'created_at'=>27, 'updated_at'=>28, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/PurchaseMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.PurchaseMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = PurchasePeer::getTableMap();
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
		return str_replace(PurchasePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PurchasePeer::ID);

		$criteria->addSelectColumn(PurchasePeer::USER_SITE_ID);

		$criteria->addSelectColumn(PurchasePeer::FILE_ID);

		$criteria->addSelectColumn(PurchasePeer::PAGSEGURO_URL);

		$criteria->addSelectColumn(PurchasePeer::ORDER_NUMBER);

		$criteria->addSelectColumn(PurchasePeer::ORDER_STATUS);

		$criteria->addSelectColumn(PurchasePeer::ORDER_VALUE);

		$criteria->addSelectColumn(PurchasePeer::PRODUCTS);

		$criteria->addSelectColumn(PurchasePeer::ITENS);

		$criteria->addSelectColumn(PurchasePeer::SHIPPING_VALUE);

		$criteria->addSelectColumn(PurchasePeer::TOTAL_VALUE);

		$criteria->addSelectColumn(PurchasePeer::PAYMETHOD);

		$criteria->addSelectColumn(PurchasePeer::IP_ADDRESS);

		$criteria->addSelectColumn(PurchasePeer::DURATION);

		$criteria->addSelectColumn(PurchasePeer::APPROVAL_DATE);

		$criteria->addSelectColumn(PurchasePeer::REFUSAL_DATE);

		$criteria->addSelectColumn(PurchasePeer::REFUSAL_REASON);

		$criteria->addSelectColumn(PurchasePeer::SHIPPING_DATE);

		$criteria->addSelectColumn(PurchasePeer::TRACING_CODE);

		$criteria->addSelectColumn(PurchasePeer::CUSTOMER_NAME);

		$criteria->addSelectColumn(PurchasePeer::ADDRESS_NAME);

		$criteria->addSelectColumn(PurchasePeer::ADDRESS_NUMBER);

		$criteria->addSelectColumn(PurchasePeer::ADDRESS_QUARTER);

		$criteria->addSelectColumn(PurchasePeer::ADDRESS_COMPLEMENT);

		$criteria->addSelectColumn(PurchasePeer::ADDRESS_CITY);

		$criteria->addSelectColumn(PurchasePeer::ADDRESS_STATE);

		$criteria->addSelectColumn(PurchasePeer::ADDRESS_ZIPCODE);

		$criteria->addSelectColumn(PurchasePeer::CREATED_AT);

		$criteria->addSelectColumn(PurchasePeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(purchase.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT purchase.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PurchasePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PurchasePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PurchasePeer::doSelectRS($criteria, $con);
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
		$objects = PurchasePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return PurchasePeer::populateObjects(PurchasePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PurchasePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = PurchasePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinUserSite(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PurchasePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PurchasePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PurchasePeer::USER_SITE_ID, UserSitePeer::ID);

		$rs = PurchasePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinFile(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PurchasePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PurchasePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PurchasePeer::FILE_ID, FilePeer::ID);

		$rs = PurchasePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinUserSite(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PurchasePeer::addSelectColumns($c);
		$startcol = (PurchasePeer::NUM_COLUMNS - PurchasePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserSitePeer::addSelectColumns($c);

		$c->addJoin(PurchasePeer::USER_SITE_ID, UserSitePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PurchasePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserSitePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUserSite(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addPurchase($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPurchaseList();
				$obj2->addPurchase($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinFile(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PurchasePeer::addSelectColumns($c);
		$startcol = (PurchasePeer::NUM_COLUMNS - PurchasePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		FilePeer::addSelectColumns($c);

		$c->addJoin(PurchasePeer::FILE_ID, FilePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PurchasePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = FilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getFile(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addPurchase($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPurchaseList();
				$obj2->addPurchase($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PurchasePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PurchasePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PurchasePeer::USER_SITE_ID, UserSitePeer::ID);

		$criteria->addJoin(PurchasePeer::FILE_ID, FilePeer::ID);

		$rs = PurchasePeer::doSelectRS($criteria, $con);
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

		PurchasePeer::addSelectColumns($c);
		$startcol2 = (PurchasePeer::NUM_COLUMNS - PurchasePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserSitePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserSitePeer::NUM_COLUMNS;

		FilePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + FilePeer::NUM_COLUMNS;

		$c->addJoin(PurchasePeer::USER_SITE_ID, UserSitePeer::ID);

		$c->addJoin(PurchasePeer::FILE_ID, FilePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PurchasePeer::getOMClass();


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
				$temp_obj2 = $temp_obj1->getUserSite(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPurchase($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initPurchaseList();
				$obj2->addPurchase($obj1);
			}


					
			$omClass = FilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getFile(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addPurchase($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initPurchaseList();
				$obj3->addPurchase($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptUserSite(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PurchasePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PurchasePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PurchasePeer::FILE_ID, FilePeer::ID);

		$rs = PurchasePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptFile(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PurchasePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PurchasePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PurchasePeer::USER_SITE_ID, UserSitePeer::ID);

		$rs = PurchasePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptUserSite(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PurchasePeer::addSelectColumns($c);
		$startcol2 = (PurchasePeer::NUM_COLUMNS - PurchasePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		FilePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + FilePeer::NUM_COLUMNS;

		$c->addJoin(PurchasePeer::FILE_ID, FilePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PurchasePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = FilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getFile(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPurchase($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPurchaseList();
				$obj2->addPurchase($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptFile(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PurchasePeer::addSelectColumns($c);
		$startcol2 = (PurchasePeer::NUM_COLUMNS - PurchasePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserSitePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserSitePeer::NUM_COLUMNS;

		$c->addJoin(PurchasePeer::USER_SITE_ID, UserSitePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PurchasePeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getUserSite(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPurchase($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPurchaseList();
				$obj2->addPurchase($obj1);
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
		return PurchasePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(PurchasePeer::ID); 

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
			$comparison = $criteria->getComparison(PurchasePeer::ID);
			$selectCriteria->add(PurchasePeer::ID, $criteria->remove(PurchasePeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(PurchasePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PurchasePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Purchase) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PurchasePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Purchase $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PurchasePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PurchasePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PurchasePeer::DATABASE_NAME, PurchasePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PurchasePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(PurchasePeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(PurchasePeer::ID, $pk);


		$v = PurchasePeer::doSelect($criteria, $con);

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
			$criteria->add(PurchasePeer::ID, $pks, Criteria::IN);
			$objs = PurchasePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasePurchasePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/PurchaseMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.PurchaseMapBuilder');
}
