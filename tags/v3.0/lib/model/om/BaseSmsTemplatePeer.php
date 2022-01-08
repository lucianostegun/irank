<?php


abstract class BaseSmsTemplatePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'sms_template';

	
	const CLASS_DEFAULT = 'lib.model.SmsTemplate';

	
	const NUM_COLUMNS = 12;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'sms_template.ID';

	
	const TEMPLATE_NAME = 'sms_template.TEMPLATE_NAME';

	
	const DESCRIPTION = 'sms_template.DESCRIPTION';

	
	const CONTENT = 'sms_template.CONTENT';

	
	const TAG_NAME = 'sms_template.TAG_NAME';

	
	const ORDER_SEQ = 'sms_template.ORDER_SEQ';

	
	const ENABLED = 'sms_template.ENABLED';

	
	const VISIBLE = 'sms_template.VISIBLE';

	
	const DELETED = 'sms_template.DELETED';

	
	const LOCKED = 'sms_template.LOCKED';

	
	const CREATED_AT = 'sms_template.CREATED_AT';

	
	const UPDATED_AT = 'sms_template.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'TemplateName', 'Description', 'Content', 'TagName', 'OrderSeq', 'Enabled', 'Visible', 'Deleted', 'Locked', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (SmsTemplatePeer::ID, SmsTemplatePeer::TEMPLATE_NAME, SmsTemplatePeer::DESCRIPTION, SmsTemplatePeer::CONTENT, SmsTemplatePeer::TAG_NAME, SmsTemplatePeer::ORDER_SEQ, SmsTemplatePeer::ENABLED, SmsTemplatePeer::VISIBLE, SmsTemplatePeer::DELETED, SmsTemplatePeer::LOCKED, SmsTemplatePeer::CREATED_AT, SmsTemplatePeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'template_name', 'description', 'content', 'tag_name', 'order_seq', 'enabled', 'visible', 'deleted', 'locked', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'TEMPLATE_NAME'=>'', 'DESCRIPTION'=>'', 'CONTENT'=>'', 'TAG_NAME'=>'', 'ORDER_SEQ'=>'', 'ENABLED'=>'', 'VISIBLE'=>'', 'DELETED'=>'', 'LOCKED'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'TemplateName'=>1, 'Description'=>2, 'Content'=>3, 'TagName'=>4, 'OrderSeq'=>5, 'Enabled'=>6, 'Visible'=>7, 'Deleted'=>8, 'Locked'=>9, 'CreatedAt'=>10, 'UpdatedAt'=>11, ),
		BasePeer::TYPE_COLNAME=>array (SmsTemplatePeer::ID=>0, SmsTemplatePeer::TEMPLATE_NAME=>1, SmsTemplatePeer::DESCRIPTION=>2, SmsTemplatePeer::CONTENT=>3, SmsTemplatePeer::TAG_NAME=>4, SmsTemplatePeer::ORDER_SEQ=>5, SmsTemplatePeer::ENABLED=>6, SmsTemplatePeer::VISIBLE=>7, SmsTemplatePeer::DELETED=>8, SmsTemplatePeer::LOCKED=>9, SmsTemplatePeer::CREATED_AT=>10, SmsTemplatePeer::UPDATED_AT=>11, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'template_name'=>1, 'description'=>2, 'content'=>3, 'tag_name'=>4, 'order_seq'=>5, 'enabled'=>6, 'visible'=>7, 'deleted'=>8, 'locked'=>9, 'created_at'=>10, 'updated_at'=>11, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/SmsTemplateMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.SmsTemplateMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = SmsTemplatePeer::getTableMap();
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
		return str_replace(SmsTemplatePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(SmsTemplatePeer::ID);

		$criteria->addSelectColumn(SmsTemplatePeer::TEMPLATE_NAME);

		$criteria->addSelectColumn(SmsTemplatePeer::DESCRIPTION);

		$criteria->addSelectColumn(SmsTemplatePeer::CONTENT);

		$criteria->addSelectColumn(SmsTemplatePeer::TAG_NAME);

		$criteria->addSelectColumn(SmsTemplatePeer::ORDER_SEQ);

		$criteria->addSelectColumn(SmsTemplatePeer::ENABLED);

		$criteria->addSelectColumn(SmsTemplatePeer::VISIBLE);

		$criteria->addSelectColumn(SmsTemplatePeer::DELETED);

		$criteria->addSelectColumn(SmsTemplatePeer::LOCKED);

		$criteria->addSelectColumn(SmsTemplatePeer::CREATED_AT);

		$criteria->addSelectColumn(SmsTemplatePeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(sms_template.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT sms_template.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SmsTemplatePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SmsTemplatePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SmsTemplatePeer::doSelectRS($criteria, $con);
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
		$objects = SmsTemplatePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return SmsTemplatePeer::populateObjects(SmsTemplatePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			SmsTemplatePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = SmsTemplatePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return SmsTemplatePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(SmsTemplatePeer::ID); 

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
			$comparison = $criteria->getComparison(SmsTemplatePeer::ID);
			$selectCriteria->add(SmsTemplatePeer::ID, $criteria->remove(SmsTemplatePeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(SmsTemplatePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(SmsTemplatePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof SmsTemplate) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SmsTemplatePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(SmsTemplate $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SmsTemplatePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SmsTemplatePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(SmsTemplatePeer::DATABASE_NAME, SmsTemplatePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SmsTemplatePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(SmsTemplatePeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(SmsTemplatePeer::ID, $pk);


		$v = SmsTemplatePeer::doSelect($criteria, $con);

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
			$criteria->add(SmsTemplatePeer::ID, $pks, Criteria::IN);
			$objs = SmsTemplatePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseSmsTemplatePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/SmsTemplateMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.SmsTemplateMapBuilder');
}
