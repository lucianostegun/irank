<?php


abstract class BaseBlogPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'blog';

	
	const CLASS_DEFAULT = 'lib.model.Blog';

	
	const NUM_COLUMNS = 16;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'blog.ID';

	
	const TITLE = 'blog.TITLE';

	
	const SHORT_TITLE = 'blog.SHORT_TITLE';

	
	const CAPTION = 'blog.CAPTION';

	
	const BLOG_CATEGORY_ID = 'blog.BLOG_CATEGORY_ID';

	
	const PERMALINK = 'blog.PERMALINK';

	
	const TAGS = 'blog.TAGS';

	
	const PEOPLE_ID = 'blog.PEOPLE_ID';

	
	const CONTENT = 'blog.CONTENT';

	
	const IS_DRAFT = 'blog.IS_DRAFT';

	
	const ENABLED = 'blog.ENABLED';

	
	const VISIBLE = 'blog.VISIBLE';

	
	const DELETED = 'blog.DELETED';

	
	const LOCKED = 'blog.LOCKED';

	
	const CREATED_AT = 'blog.CREATED_AT';

	
	const UPDATED_AT = 'blog.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'Title', 'ShortTitle', 'Caption', 'BlogCategoryId', 'Permalink', 'Tags', 'PeopleId', 'Content', 'IsDraft', 'Enabled', 'Visible', 'Deleted', 'Locked', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (BlogPeer::ID, BlogPeer::TITLE, BlogPeer::SHORT_TITLE, BlogPeer::CAPTION, BlogPeer::BLOG_CATEGORY_ID, BlogPeer::PERMALINK, BlogPeer::TAGS, BlogPeer::PEOPLE_ID, BlogPeer::CONTENT, BlogPeer::IS_DRAFT, BlogPeer::ENABLED, BlogPeer::VISIBLE, BlogPeer::DELETED, BlogPeer::LOCKED, BlogPeer::CREATED_AT, BlogPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'title', 'short_title', 'caption', 'blog_category_id', 'permalink', 'tags', 'people_id', 'content', 'is_draft', 'enabled', 'visible', 'deleted', 'locked', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'TITLE'=>'', 'SHORT_TITLE'=>'', 'CAPTION'=>'', 'BLOG_CATEGORY_ID'=>'', 'PERMALINK'=>'', 'TAGS'=>'', 'PEOPLE_ID'=>'', 'CONTENT'=>'', 'IS_DRAFT'=>'', 'ENABLED'=>'', 'VISIBLE'=>'', 'DELETED'=>'', 'LOCKED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'Title'=>1, 'ShortTitle'=>2, 'Caption'=>3, 'BlogCategoryId'=>4, 'Permalink'=>5, 'Tags'=>6, 'PeopleId'=>7, 'Content'=>8, 'IsDraft'=>9, 'Enabled'=>10, 'Visible'=>11, 'Deleted'=>12, 'Locked'=>13, 'CreatedAt'=>14, 'UpdatedAt'=>15, ),
		BasePeer::TYPE_COLNAME=>array (BlogPeer::ID=>0, BlogPeer::TITLE=>1, BlogPeer::SHORT_TITLE=>2, BlogPeer::CAPTION=>3, BlogPeer::BLOG_CATEGORY_ID=>4, BlogPeer::PERMALINK=>5, BlogPeer::TAGS=>6, BlogPeer::PEOPLE_ID=>7, BlogPeer::CONTENT=>8, BlogPeer::IS_DRAFT=>9, BlogPeer::ENABLED=>10, BlogPeer::VISIBLE=>11, BlogPeer::DELETED=>12, BlogPeer::LOCKED=>13, BlogPeer::CREATED_AT=>14, BlogPeer::UPDATED_AT=>15, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'title'=>1, 'short_title'=>2, 'caption'=>3, 'blog_category_id'=>4, 'permalink'=>5, 'tags'=>6, 'people_id'=>7, 'content'=>8, 'is_draft'=>9, 'enabled'=>10, 'visible'=>11, 'deleted'=>12, 'locked'=>13, 'created_at'=>14, 'updated_at'=>15, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/BlogMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.BlogMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = BlogPeer::getTableMap();
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
		return str_replace(BlogPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(BlogPeer::ID);

		$criteria->addSelectColumn(BlogPeer::TITLE);

		$criteria->addSelectColumn(BlogPeer::SHORT_TITLE);

		$criteria->addSelectColumn(BlogPeer::CAPTION);

		$criteria->addSelectColumn(BlogPeer::BLOG_CATEGORY_ID);

		$criteria->addSelectColumn(BlogPeer::PERMALINK);

		$criteria->addSelectColumn(BlogPeer::TAGS);

		$criteria->addSelectColumn(BlogPeer::PEOPLE_ID);

		$criteria->addSelectColumn(BlogPeer::CONTENT);

		$criteria->addSelectColumn(BlogPeer::IS_DRAFT);

		$criteria->addSelectColumn(BlogPeer::ENABLED);

		$criteria->addSelectColumn(BlogPeer::VISIBLE);

		$criteria->addSelectColumn(BlogPeer::DELETED);

		$criteria->addSelectColumn(BlogPeer::LOCKED);

		$criteria->addSelectColumn(BlogPeer::CREATED_AT);

		$criteria->addSelectColumn(BlogPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(blog.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT blog.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(BlogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(BlogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = BlogPeer::doSelectRS($criteria, $con);
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
		$objects = BlogPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return BlogPeer::populateObjects(BlogPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			BlogPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = BlogPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinVirtualTable(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(BlogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(BlogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(BlogPeer::BLOG_CATEGORY_ID, VirtualTablePeer::ID);

		$rs = BlogPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(BlogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(BlogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(BlogPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = BlogPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinVirtualTable(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		BlogPeer::addSelectColumns($c);
		$startcol = (BlogPeer::NUM_COLUMNS - BlogPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		VirtualTablePeer::addSelectColumns($c);

		$c->addJoin(BlogPeer::BLOG_CATEGORY_ID, VirtualTablePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = BlogPeer::getOMClass();

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
										$temp_obj2->addBlog($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initBlogList();
				$obj2->addBlog($obj1); 			}
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

		BlogPeer::addSelectColumns($c);
		$startcol = (BlogPeer::NUM_COLUMNS - BlogPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PeoplePeer::addSelectColumns($c);

		$c->addJoin(BlogPeer::PEOPLE_ID, PeoplePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = BlogPeer::getOMClass();

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
										$temp_obj2->addBlog($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initBlogList();
				$obj2->addBlog($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(BlogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(BlogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(BlogPeer::BLOG_CATEGORY_ID, VirtualTablePeer::ID);

		$criteria->addJoin(BlogPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = BlogPeer::doSelectRS($criteria, $con);
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

		BlogPeer::addSelectColumns($c);
		$startcol2 = (BlogPeer::NUM_COLUMNS - BlogPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		VirtualTablePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + VirtualTablePeer::NUM_COLUMNS;

		PeoplePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(BlogPeer::BLOG_CATEGORY_ID, VirtualTablePeer::ID);

		$c->addJoin(BlogPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = BlogPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = VirtualTablePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getVirtualTable(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addBlog($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initBlogList();
				$obj2->addBlog($obj1);
			}


					
			$omClass = PeoplePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getPeople(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addBlog($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initBlogList();
				$obj3->addBlog($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptVirtualTable(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(BlogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(BlogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(BlogPeer::PEOPLE_ID, PeoplePeer::ID);

		$rs = BlogPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(BlogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(BlogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(BlogPeer::BLOG_CATEGORY_ID, VirtualTablePeer::ID);

		$rs = BlogPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptVirtualTable(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		BlogPeer::addSelectColumns($c);
		$startcol2 = (BlogPeer::NUM_COLUMNS - BlogPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PeoplePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PeoplePeer::NUM_COLUMNS;

		$c->addJoin(BlogPeer::PEOPLE_ID, PeoplePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = BlogPeer::getOMClass();

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
					$temp_obj2->addBlog($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initBlogList();
				$obj2->addBlog($obj1);
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

		BlogPeer::addSelectColumns($c);
		$startcol2 = (BlogPeer::NUM_COLUMNS - BlogPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		VirtualTablePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + VirtualTablePeer::NUM_COLUMNS;

		$c->addJoin(BlogPeer::BLOG_CATEGORY_ID, VirtualTablePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = BlogPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = VirtualTablePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getVirtualTable(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addBlog($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initBlogList();
				$obj2->addBlog($obj1);
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
		return BlogPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(BlogPeer::ID); 

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
			$comparison = $criteria->getComparison(BlogPeer::ID);
			$selectCriteria->add(BlogPeer::ID, $criteria->remove(BlogPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(BlogPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(BlogPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Blog) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(BlogPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Blog $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(BlogPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(BlogPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(BlogPeer::DATABASE_NAME, BlogPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = BlogPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(BlogPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(BlogPeer::ID, $pk);


		$v = BlogPeer::doSelect($criteria, $con);

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
			$criteria->add(BlogPeer::ID, $pks, Criteria::IN);
			$objs = BlogPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseBlogPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/BlogMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.BlogMapBuilder');
}
