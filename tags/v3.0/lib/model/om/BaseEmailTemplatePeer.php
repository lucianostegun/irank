<?php


abstract class BaseEmailTemplatePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'email_template';

	
	const CLASS_DEFAULT = 'lib.model.EmailTemplate';

	
	const NUM_COLUMNS = 17;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'email_template.ID';

	
	const TEMPLATE_NAME = 'email_template.TEMPLATE_NAME';

	
	const DESCRIPTION = 'email_template.DESCRIPTION';

	
	const FILE_ID = 'email_template.FILE_ID';

	
	const CLUB_ID = 'email_template.CLUB_ID';

	
	const EMAIL_TEMPLATE_ID = 'email_template.EMAIL_TEMPLATE_ID';

	
	const IS_AVAILABLE_FOR_USE = 'email_template.IS_AVAILABLE_FOR_USE';

	
	const IS_AVAILABLE_FOR_SALE = 'email_template.IS_AVAILABLE_FOR_SALE';

	
	const TAG_NAME = 'email_template.TAG_NAME';

	
	const TAG_NAME_PARENT = 'email_template.TAG_NAME_PARENT';

	
	const IS_OPTION = 'email_template.IS_OPTION';

	
	const ENABLED = 'email_template.ENABLED';

	
	const VISIBLE = 'email_template.VISIBLE';

	
	const DELETED = 'email_template.DELETED';

	
	const LOCKED = 'email_template.LOCKED';

	
	const CREATED_AT = 'email_template.CREATED_AT';

	
	const UPDATED_AT = 'email_template.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'TemplateName', 'Description', 'FileId', 'ClubId', 'EmailTemplateId', 'IsAvailableForUse', 'IsAvailableForSale', 'TagName', 'TagNameParent', 'IsOption', 'Enabled', 'Visible', 'Deleted', 'Locked', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (EmailTemplatePeer::ID, EmailTemplatePeer::TEMPLATE_NAME, EmailTemplatePeer::DESCRIPTION, EmailTemplatePeer::FILE_ID, EmailTemplatePeer::CLUB_ID, EmailTemplatePeer::EMAIL_TEMPLATE_ID, EmailTemplatePeer::IS_AVAILABLE_FOR_USE, EmailTemplatePeer::IS_AVAILABLE_FOR_SALE, EmailTemplatePeer::TAG_NAME, EmailTemplatePeer::TAG_NAME_PARENT, EmailTemplatePeer::IS_OPTION, EmailTemplatePeer::ENABLED, EmailTemplatePeer::VISIBLE, EmailTemplatePeer::DELETED, EmailTemplatePeer::LOCKED, EmailTemplatePeer::CREATED_AT, EmailTemplatePeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'template_name', 'description', 'file_id', 'club_id', 'email_template_id', 'is_available_for_use', 'is_available_for_sale', 'tag_name', 'tag_name_parent', 'is_option', 'enabled', 'visible', 'deleted', 'locked', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'TEMPLATE_NAME'=>'', 'DESCRIPTION'=>'', 'FILE_ID'=>'', 'CLUB_ID'=>'', 'EMAIL_TEMPLATE_ID'=>'', 'IS_AVAILABLE_FOR_USE'=>'', 'IS_AVAILABLE_FOR_SALE'=>'', 'TAG_NAME'=>'', 'TAG_NAME_PARENT'=>'', 'IS_OPTION'=>'', 'ENABLED'=>'', 'VISIBLE'=>'', 'DELETED'=>'', 'LOCKED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'TemplateName'=>1, 'Description'=>2, 'FileId'=>3, 'ClubId'=>4, 'EmailTemplateId'=>5, 'IsAvailableForUse'=>6, 'IsAvailableForSale'=>7, 'TagName'=>8, 'TagNameParent'=>9, 'IsOption'=>10, 'Enabled'=>11, 'Visible'=>12, 'Deleted'=>13, 'Locked'=>14, 'CreatedAt'=>15, 'UpdatedAt'=>16, ),
		BasePeer::TYPE_COLNAME=>array (EmailTemplatePeer::ID=>0, EmailTemplatePeer::TEMPLATE_NAME=>1, EmailTemplatePeer::DESCRIPTION=>2, EmailTemplatePeer::FILE_ID=>3, EmailTemplatePeer::CLUB_ID=>4, EmailTemplatePeer::EMAIL_TEMPLATE_ID=>5, EmailTemplatePeer::IS_AVAILABLE_FOR_USE=>6, EmailTemplatePeer::IS_AVAILABLE_FOR_SALE=>7, EmailTemplatePeer::TAG_NAME=>8, EmailTemplatePeer::TAG_NAME_PARENT=>9, EmailTemplatePeer::IS_OPTION=>10, EmailTemplatePeer::ENABLED=>11, EmailTemplatePeer::VISIBLE=>12, EmailTemplatePeer::DELETED=>13, EmailTemplatePeer::LOCKED=>14, EmailTemplatePeer::CREATED_AT=>15, EmailTemplatePeer::UPDATED_AT=>16, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'template_name'=>1, 'description'=>2, 'file_id'=>3, 'club_id'=>4, 'email_template_id'=>5, 'is_available_for_use'=>6, 'is_available_for_sale'=>7, 'tag_name'=>8, 'tag_name_parent'=>9, 'is_option'=>10, 'enabled'=>11, 'visible'=>12, 'deleted'=>13, 'locked'=>14, 'created_at'=>15, 'updated_at'=>16, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/EmailTemplateMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.EmailTemplateMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EmailTemplatePeer::getTableMap();
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
		return str_replace(EmailTemplatePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EmailTemplatePeer::ID);

		$criteria->addSelectColumn(EmailTemplatePeer::TEMPLATE_NAME);

		$criteria->addSelectColumn(EmailTemplatePeer::DESCRIPTION);

		$criteria->addSelectColumn(EmailTemplatePeer::FILE_ID);

		$criteria->addSelectColumn(EmailTemplatePeer::CLUB_ID);

		$criteria->addSelectColumn(EmailTemplatePeer::EMAIL_TEMPLATE_ID);

		$criteria->addSelectColumn(EmailTemplatePeer::IS_AVAILABLE_FOR_USE);

		$criteria->addSelectColumn(EmailTemplatePeer::IS_AVAILABLE_FOR_SALE);

		$criteria->addSelectColumn(EmailTemplatePeer::TAG_NAME);

		$criteria->addSelectColumn(EmailTemplatePeer::TAG_NAME_PARENT);

		$criteria->addSelectColumn(EmailTemplatePeer::IS_OPTION);

		$criteria->addSelectColumn(EmailTemplatePeer::ENABLED);

		$criteria->addSelectColumn(EmailTemplatePeer::VISIBLE);

		$criteria->addSelectColumn(EmailTemplatePeer::DELETED);

		$criteria->addSelectColumn(EmailTemplatePeer::LOCKED);

		$criteria->addSelectColumn(EmailTemplatePeer::CREATED_AT);

		$criteria->addSelectColumn(EmailTemplatePeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(email_template.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT email_template.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EmailTemplatePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EmailTemplatePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EmailTemplatePeer::doSelectRS($criteria, $con);
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
		$objects = EmailTemplatePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EmailTemplatePeer::populateObjects(EmailTemplatePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EmailTemplatePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EmailTemplatePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinFile(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EmailTemplatePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EmailTemplatePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EmailTemplatePeer::FILE_ID, FilePeer::ID);

		$rs = EmailTemplatePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinClub(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EmailTemplatePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EmailTemplatePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EmailTemplatePeer::CLUB_ID, ClubPeer::ID);

		$rs = EmailTemplatePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinFile(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EmailTemplatePeer::addSelectColumns($c);
		$startcol = (EmailTemplatePeer::NUM_COLUMNS - EmailTemplatePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		FilePeer::addSelectColumns($c);

		$c->addJoin(EmailTemplatePeer::FILE_ID, FilePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EmailTemplatePeer::getOMClass();

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
										$temp_obj2->addEmailTemplate($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEmailTemplateList();
				$obj2->addEmailTemplate($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinClub(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EmailTemplatePeer::addSelectColumns($c);
		$startcol = (EmailTemplatePeer::NUM_COLUMNS - EmailTemplatePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ClubPeer::addSelectColumns($c);

		$c->addJoin(EmailTemplatePeer::CLUB_ID, ClubPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EmailTemplatePeer::getOMClass();

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
										$temp_obj2->addEmailTemplate($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEmailTemplateList();
				$obj2->addEmailTemplate($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EmailTemplatePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EmailTemplatePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EmailTemplatePeer::FILE_ID, FilePeer::ID);

		$criteria->addJoin(EmailTemplatePeer::CLUB_ID, ClubPeer::ID);

		$rs = EmailTemplatePeer::doSelectRS($criteria, $con);
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

		EmailTemplatePeer::addSelectColumns($c);
		$startcol2 = (EmailTemplatePeer::NUM_COLUMNS - EmailTemplatePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		FilePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + FilePeer::NUM_COLUMNS;

		ClubPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ClubPeer::NUM_COLUMNS;

		$c->addJoin(EmailTemplatePeer::FILE_ID, FilePeer::ID);

		$c->addJoin(EmailTemplatePeer::CLUB_ID, ClubPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EmailTemplatePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = FilePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getFile(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEmailTemplate($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEmailTemplateList();
				$obj2->addEmailTemplate($obj1);
			}


					
			$omClass = ClubPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getClub(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEmailTemplate($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initEmailTemplateList();
				$obj3->addEmailTemplate($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptFile(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EmailTemplatePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EmailTemplatePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EmailTemplatePeer::CLUB_ID, ClubPeer::ID);

		$rs = EmailTemplatePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptClub(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EmailTemplatePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EmailTemplatePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EmailTemplatePeer::FILE_ID, FilePeer::ID);

		$rs = EmailTemplatePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptEmailTemplateRelatedByEmailTemplateId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EmailTemplatePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EmailTemplatePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EmailTemplatePeer::FILE_ID, FilePeer::ID);

		$criteria->addJoin(EmailTemplatePeer::CLUB_ID, ClubPeer::ID);

		$rs = EmailTemplatePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptFile(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EmailTemplatePeer::addSelectColumns($c);
		$startcol2 = (EmailTemplatePeer::NUM_COLUMNS - EmailTemplatePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ClubPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ClubPeer::NUM_COLUMNS;

		$c->addJoin(EmailTemplatePeer::CLUB_ID, ClubPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EmailTemplatePeer::getOMClass();

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
					$temp_obj2->addEmailTemplate($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEmailTemplateList();
				$obj2->addEmailTemplate($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptClub(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EmailTemplatePeer::addSelectColumns($c);
		$startcol2 = (EmailTemplatePeer::NUM_COLUMNS - EmailTemplatePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		FilePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + FilePeer::NUM_COLUMNS;

		$c->addJoin(EmailTemplatePeer::FILE_ID, FilePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EmailTemplatePeer::getOMClass();

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
					$temp_obj2->addEmailTemplate($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEmailTemplateList();
				$obj2->addEmailTemplate($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptEmailTemplateRelatedByEmailTemplateId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EmailTemplatePeer::addSelectColumns($c);
		$startcol2 = (EmailTemplatePeer::NUM_COLUMNS - EmailTemplatePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		FilePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + FilePeer::NUM_COLUMNS;

		ClubPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ClubPeer::NUM_COLUMNS;

		$c->addJoin(EmailTemplatePeer::FILE_ID, FilePeer::ID);

		$c->addJoin(EmailTemplatePeer::CLUB_ID, ClubPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EmailTemplatePeer::getOMClass();

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
					$temp_obj2->addEmailTemplate($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEmailTemplateList();
				$obj2->addEmailTemplate($obj1);
			}

			$omClass = ClubPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getClub(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEmailTemplate($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initEmailTemplateList();
				$obj3->addEmailTemplate($obj1);
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
		return EmailTemplatePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(EmailTemplatePeer::ID); 

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
			$comparison = $criteria->getComparison(EmailTemplatePeer::ID);
			$selectCriteria->add(EmailTemplatePeer::ID, $criteria->remove(EmailTemplatePeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(EmailTemplatePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EmailTemplatePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof EmailTemplate) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(EmailTemplatePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(EmailTemplate $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EmailTemplatePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EmailTemplatePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EmailTemplatePeer::DATABASE_NAME, EmailTemplatePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EmailTemplatePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(EmailTemplatePeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(EmailTemplatePeer::ID, $pk);


		$v = EmailTemplatePeer::doSelect($criteria, $con);

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
			$criteria->add(EmailTemplatePeer::ID, $pks, Criteria::IN);
			$objs = EmailTemplatePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseEmailTemplatePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/EmailTemplateMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.EmailTemplateMapBuilder');
}
