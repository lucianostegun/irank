<?php


abstract class BaseProductItemPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'product_item';

	
	const CLASS_DEFAULT = 'lib.model.ProductItem';

	
	const NUM_COLUMNS = 18;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'product_item.ID';

	
	const PRODUCT_ID = 'product_item.PRODUCT_ID';

	
	const PRODUCT_OPTION_ID_COLOR = 'product_item.PRODUCT_OPTION_ID_COLOR';

	
	const PRODUCT_OPTION_ID_SIZE = 'product_item.PRODUCT_OPTION_ID_SIZE';

	
	const PRICE = 'product_item.PRICE';

	
	const WEIGHT = 'product_item.WEIGHT';

	
	const STOCK = 'product_item.STOCK';

	
	const IMAGE_1 = 'product_item.IMAGE_1';

	
	const IMAGE_2 = 'product_item.IMAGE_2';

	
	const IMAGE_3 = 'product_item.IMAGE_3';

	
	const IMAGE_4 = 'product_item.IMAGE_4';

	
	const IMAGE_5 = 'product_item.IMAGE_5';

	
	const ENABLED = 'product_item.ENABLED';

	
	const VISIBLE = 'product_item.VISIBLE';

	
	const DELETED = 'product_item.DELETED';

	
	const LOCKED = 'product_item.LOCKED';

	
	const CREATED_AT = 'product_item.CREATED_AT';

	
	const UPDATED_AT = 'product_item.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'ProductId', 'ProductOptionIdColor', 'ProductOptionIdSize', 'Price', 'Weight', 'Stock', 'Image1', 'Image2', 'Image3', 'Image4', 'Image5', 'Enabled', 'Visible', 'Deleted', 'Locked', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (ProductItemPeer::ID, ProductItemPeer::PRODUCT_ID, ProductItemPeer::PRODUCT_OPTION_ID_COLOR, ProductItemPeer::PRODUCT_OPTION_ID_SIZE, ProductItemPeer::PRICE, ProductItemPeer::WEIGHT, ProductItemPeer::STOCK, ProductItemPeer::IMAGE_1, ProductItemPeer::IMAGE_2, ProductItemPeer::IMAGE_3, ProductItemPeer::IMAGE_4, ProductItemPeer::IMAGE_5, ProductItemPeer::ENABLED, ProductItemPeer::VISIBLE, ProductItemPeer::DELETED, ProductItemPeer::LOCKED, ProductItemPeer::CREATED_AT, ProductItemPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'product_id', 'product_option_id_color', 'product_option_id_size', 'price', 'weight', 'stock', 'image_1', 'image_2', 'image_3', 'image_4', 'image_5', 'enabled', 'visible', 'deleted', 'locked', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'PRODUCT_ID'=>'', 'PRODUCT_OPTION_ID_COLOR'=>'', 'PRODUCT_OPTION_ID_SIZE'=>'', 'PRICE'=>'', 'WEIGHT'=>'', 'STOCK'=>'', 'IMAGE_1'=>'', 'IMAGE_2'=>'', 'IMAGE_3'=>'', 'IMAGE_4'=>'', 'IMAGE_5'=>'', 'ENABLED'=>'', 'VISIBLE'=>'', 'DELETED'=>'', 'LOCKED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'ProductId'=>1, 'ProductOptionIdColor'=>2, 'ProductOptionIdSize'=>3, 'Price'=>4, 'Weight'=>5, 'Stock'=>6, 'Image1'=>7, 'Image2'=>8, 'Image3'=>9, 'Image4'=>10, 'Image5'=>11, 'Enabled'=>12, 'Visible'=>13, 'Deleted'=>14, 'Locked'=>15, 'CreatedAt'=>16, 'UpdatedAt'=>17, ),
		BasePeer::TYPE_COLNAME=>array (ProductItemPeer::ID=>0, ProductItemPeer::PRODUCT_ID=>1, ProductItemPeer::PRODUCT_OPTION_ID_COLOR=>2, ProductItemPeer::PRODUCT_OPTION_ID_SIZE=>3, ProductItemPeer::PRICE=>4, ProductItemPeer::WEIGHT=>5, ProductItemPeer::STOCK=>6, ProductItemPeer::IMAGE_1=>7, ProductItemPeer::IMAGE_2=>8, ProductItemPeer::IMAGE_3=>9, ProductItemPeer::IMAGE_4=>10, ProductItemPeer::IMAGE_5=>11, ProductItemPeer::ENABLED=>12, ProductItemPeer::VISIBLE=>13, ProductItemPeer::DELETED=>14, ProductItemPeer::LOCKED=>15, ProductItemPeer::CREATED_AT=>16, ProductItemPeer::UPDATED_AT=>17, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'product_id'=>1, 'product_option_id_color'=>2, 'product_option_id_size'=>3, 'price'=>4, 'weight'=>5, 'stock'=>6, 'image_1'=>7, 'image_2'=>8, 'image_3'=>9, 'image_4'=>10, 'image_5'=>11, 'enabled'=>12, 'visible'=>13, 'deleted'=>14, 'locked'=>15, 'created_at'=>16, 'updated_at'=>17, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ProductItemMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ProductItemMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ProductItemPeer::getTableMap();
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
		return str_replace(ProductItemPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ProductItemPeer::ID);

		$criteria->addSelectColumn(ProductItemPeer::PRODUCT_ID);

		$criteria->addSelectColumn(ProductItemPeer::PRODUCT_OPTION_ID_COLOR);

		$criteria->addSelectColumn(ProductItemPeer::PRODUCT_OPTION_ID_SIZE);

		$criteria->addSelectColumn(ProductItemPeer::PRICE);

		$criteria->addSelectColumn(ProductItemPeer::WEIGHT);

		$criteria->addSelectColumn(ProductItemPeer::STOCK);

		$criteria->addSelectColumn(ProductItemPeer::IMAGE_1);

		$criteria->addSelectColumn(ProductItemPeer::IMAGE_2);

		$criteria->addSelectColumn(ProductItemPeer::IMAGE_3);

		$criteria->addSelectColumn(ProductItemPeer::IMAGE_4);

		$criteria->addSelectColumn(ProductItemPeer::IMAGE_5);

		$criteria->addSelectColumn(ProductItemPeer::ENABLED);

		$criteria->addSelectColumn(ProductItemPeer::VISIBLE);

		$criteria->addSelectColumn(ProductItemPeer::DELETED);

		$criteria->addSelectColumn(ProductItemPeer::LOCKED);

		$criteria->addSelectColumn(ProductItemPeer::CREATED_AT);

		$criteria->addSelectColumn(ProductItemPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(product_item.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT product_item.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProductItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProductItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ProductItemPeer::doSelectRS($criteria, $con);
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
		$objects = ProductItemPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ProductItemPeer::populateObjects(ProductItemPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ProductItemPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ProductItemPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinProduct(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProductItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProductItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProductItemPeer::PRODUCT_ID, ProductPeer::ID);

		$rs = ProductItemPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinProductOptionRelatedByProductOptionIdColor(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProductItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProductItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProductItemPeer::PRODUCT_OPTION_ID_COLOR, ProductOptionPeer::ID);

		$rs = ProductItemPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinProductOptionRelatedByProductOptionIdSize(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProductItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProductItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProductItemPeer::PRODUCT_OPTION_ID_SIZE, ProductOptionPeer::ID);

		$rs = ProductItemPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinProduct(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProductItemPeer::addSelectColumns($c);
		$startcol = (ProductItemPeer::NUM_COLUMNS - ProductItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProductPeer::addSelectColumns($c);

		$c->addJoin(ProductItemPeer::PRODUCT_ID, ProductPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProductItemPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProductPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getProduct(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addProductItem($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initProductItemList();
				$obj2->addProductItem($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinProductOptionRelatedByProductOptionIdColor(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProductItemPeer::addSelectColumns($c);
		$startcol = (ProductItemPeer::NUM_COLUMNS - ProductItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProductOptionPeer::addSelectColumns($c);

		$c->addJoin(ProductItemPeer::PRODUCT_OPTION_ID_COLOR, ProductOptionPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProductItemPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProductOptionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getProductOptionRelatedByProductOptionIdColor(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addProductItemRelatedByProductOptionIdColor($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initProductItemListRelatedByProductOptionIdColor();
				$obj2->addProductItemRelatedByProductOptionIdColor($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinProductOptionRelatedByProductOptionIdSize(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProductItemPeer::addSelectColumns($c);
		$startcol = (ProductItemPeer::NUM_COLUMNS - ProductItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ProductOptionPeer::addSelectColumns($c);

		$c->addJoin(ProductItemPeer::PRODUCT_OPTION_ID_SIZE, ProductOptionPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProductItemPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProductOptionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getProductOptionRelatedByProductOptionIdSize(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addProductItemRelatedByProductOptionIdSize($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initProductItemListRelatedByProductOptionIdSize();
				$obj2->addProductItemRelatedByProductOptionIdSize($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProductItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProductItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProductItemPeer::PRODUCT_ID, ProductPeer::ID);

		$criteria->addJoin(ProductItemPeer::PRODUCT_OPTION_ID_COLOR, ProductOptionPeer::ID);

		$criteria->addJoin(ProductItemPeer::PRODUCT_OPTION_ID_SIZE, ProductOptionPeer::ID);

		$rs = ProductItemPeer::doSelectRS($criteria, $con);
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

		ProductItemPeer::addSelectColumns($c);
		$startcol2 = (ProductItemPeer::NUM_COLUMNS - ProductItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProductPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProductPeer::NUM_COLUMNS;

		ProductOptionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProductOptionPeer::NUM_COLUMNS;

		ProductOptionPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ProductOptionPeer::NUM_COLUMNS;

		$c->addJoin(ProductItemPeer::PRODUCT_ID, ProductPeer::ID);

		$c->addJoin(ProductItemPeer::PRODUCT_OPTION_ID_COLOR, ProductOptionPeer::ID);

		$c->addJoin(ProductItemPeer::PRODUCT_OPTION_ID_SIZE, ProductOptionPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProductItemPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = ProductPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProduct(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addProductItem($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initProductItemList();
				$obj2->addProductItem($obj1);
			}


					
			$omClass = ProductOptionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProductOptionRelatedByProductOptionIdColor(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addProductItemRelatedByProductOptionIdColor($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initProductItemListRelatedByProductOptionIdColor();
				$obj3->addProductItemRelatedByProductOptionIdColor($obj1);
			}


					
			$omClass = ProductOptionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getProductOptionRelatedByProductOptionIdSize(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addProductItemRelatedByProductOptionIdSize($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initProductItemListRelatedByProductOptionIdSize();
				$obj4->addProductItemRelatedByProductOptionIdSize($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptProduct(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProductItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProductItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProductItemPeer::PRODUCT_OPTION_ID_COLOR, ProductOptionPeer::ID);

		$criteria->addJoin(ProductItemPeer::PRODUCT_OPTION_ID_SIZE, ProductOptionPeer::ID);

		$rs = ProductItemPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptProductOptionRelatedByProductOptionIdColor(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProductItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProductItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProductItemPeer::PRODUCT_ID, ProductPeer::ID);

		$rs = ProductItemPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptProductOptionRelatedByProductOptionIdSize(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ProductItemPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ProductItemPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ProductItemPeer::PRODUCT_ID, ProductPeer::ID);

		$rs = ProductItemPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptProduct(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProductItemPeer::addSelectColumns($c);
		$startcol2 = (ProductItemPeer::NUM_COLUMNS - ProductItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProductOptionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProductOptionPeer::NUM_COLUMNS;

		ProductOptionPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ProductOptionPeer::NUM_COLUMNS;

		$c->addJoin(ProductItemPeer::PRODUCT_OPTION_ID_COLOR, ProductOptionPeer::ID);

		$c->addJoin(ProductItemPeer::PRODUCT_OPTION_ID_SIZE, ProductOptionPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProductItemPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProductOptionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProductOptionRelatedByProductOptionIdColor(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addProductItemRelatedByProductOptionIdColor($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initProductItemListRelatedByProductOptionIdColor();
				$obj2->addProductItemRelatedByProductOptionIdColor($obj1);
			}

			$omClass = ProductOptionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getProductOptionRelatedByProductOptionIdSize(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addProductItemRelatedByProductOptionIdSize($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initProductItemListRelatedByProductOptionIdSize();
				$obj3->addProductItemRelatedByProductOptionIdSize($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptProductOptionRelatedByProductOptionIdColor(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProductItemPeer::addSelectColumns($c);
		$startcol2 = (ProductItemPeer::NUM_COLUMNS - ProductItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProductPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProductPeer::NUM_COLUMNS;

		$c->addJoin(ProductItemPeer::PRODUCT_ID, ProductPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProductItemPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProductPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProduct(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addProductItem($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initProductItemList();
				$obj2->addProductItem($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptProductOptionRelatedByProductOptionIdSize(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ProductItemPeer::addSelectColumns($c);
		$startcol2 = (ProductItemPeer::NUM_COLUMNS - ProductItemPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ProductPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ProductPeer::NUM_COLUMNS;

		$c->addJoin(ProductItemPeer::PRODUCT_ID, ProductPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ProductItemPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ProductPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getProduct(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addProductItem($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initProductItemList();
				$obj2->addProductItem($obj1);
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
		return ProductItemPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(ProductItemPeer::ID); 

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
			$comparison = $criteria->getComparison(ProductItemPeer::ID);
			$selectCriteria->add(ProductItemPeer::ID, $criteria->remove(ProductItemPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(ProductItemPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ProductItemPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof ProductItem) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ProductItemPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(ProductItem $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ProductItemPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ProductItemPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ProductItemPeer::DATABASE_NAME, ProductItemPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ProductItemPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ProductItemPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(ProductItemPeer::ID, $pk);


		$v = ProductItemPeer::doSelect($criteria, $con);

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
			$criteria->add(ProductItemPeer::ID, $pks, Criteria::IN);
			$objs = ProductItemPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseProductItemPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ProductItemMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ProductItemMapBuilder');
}
