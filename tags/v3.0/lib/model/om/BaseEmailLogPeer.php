<?php


abstract class BaseEmailLogPeer {

	
	const DATABASE_NAME = 'log';

	
	const TABLE_NAME = 'email_log';

	
	const CLASS_DEFAULT = 'lib.model.EmailLog';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'email_log.ID';

	
	const EMAIL_ADDRESS = 'email_log.EMAIL_ADDRESS';

	
	const ERROR_MESSAGE = 'email_log.ERROR_MESSAGE';

	
	const EMAIL_SUBJECT = 'email_log.EMAIL_SUBJECT';

	
	const SENDING_STATUS = 'email_log.SENDING_STATUS';

	
	const CLASS_NAME = 'email_log.CLASS_NAME';

	
	const OBJECT_ID = 'email_log.OBJECT_ID';

	
	const CREATED_AT = 'email_log.CREATED_AT';

	
	const READ_AT = 'email_log.READ_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'EmailAddress', 'ErrorMessage', 'EmailSubject', 'SendingStatus', 'ClassName', 'ObjectId', 'CreatedAt', 'ReadAt', ),
		BasePeer::TYPE_COLNAME=>array (EmailLogPeer::ID, EmailLogPeer::EMAIL_ADDRESS, EmailLogPeer::ERROR_MESSAGE, EmailLogPeer::EMAIL_SUBJECT, EmailLogPeer::SENDING_STATUS, EmailLogPeer::CLASS_NAME, EmailLogPeer::OBJECT_ID, EmailLogPeer::CREATED_AT, EmailLogPeer::READ_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'email_address', 'error_message', 'email_subject', 'sending_status', 'class_name', 'object_id', 'created_at', 'read_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'EMAIL_ADDRESS'=>'', 'ERROR_MESSAGE'=>'', 'EMAIL_SUBJECT'=>'', 'SENDING_STATUS'=>'', 'CLASS_NAME'=>'', 'OBJECT_ID'=>'', 'CREATED_AT'=>'', 'READ_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'EmailAddress'=>1, 'ErrorMessage'=>2, 'EmailSubject'=>3, 'SendingStatus'=>4, 'ClassName'=>5, 'ObjectId'=>6, 'CreatedAt'=>7, 'ReadAt'=>8, ),
		BasePeer::TYPE_COLNAME=>array (EmailLogPeer::ID=>0, EmailLogPeer::EMAIL_ADDRESS=>1, EmailLogPeer::ERROR_MESSAGE=>2, EmailLogPeer::EMAIL_SUBJECT=>3, EmailLogPeer::SENDING_STATUS=>4, EmailLogPeer::CLASS_NAME=>5, EmailLogPeer::OBJECT_ID=>6, EmailLogPeer::CREATED_AT=>7, EmailLogPeer::READ_AT=>8, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'email_address'=>1, 'error_message'=>2, 'email_subject'=>3, 'sending_status'=>4, 'class_name'=>5, 'object_id'=>6, 'created_at'=>7, 'read_at'=>8, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/EmailLogMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.EmailLogMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EmailLogPeer::getTableMap();
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
		return str_replace(EmailLogPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EmailLogPeer::ID);

		$criteria->addSelectColumn(EmailLogPeer::EMAIL_ADDRESS);

		$criteria->addSelectColumn(EmailLogPeer::ERROR_MESSAGE);

		$criteria->addSelectColumn(EmailLogPeer::EMAIL_SUBJECT);

		$criteria->addSelectColumn(EmailLogPeer::SENDING_STATUS);

		$criteria->addSelectColumn(EmailLogPeer::CLASS_NAME);

		$criteria->addSelectColumn(EmailLogPeer::OBJECT_ID);

		$criteria->addSelectColumn(EmailLogPeer::CREATED_AT);

		$criteria->addSelectColumn(EmailLogPeer::READ_AT);

	}

	const COUNT = 'COUNT(email_log.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT email_log.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EmailLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EmailLogPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EmailLogPeer::doSelectRS($criteria, $con);
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
		$objects = EmailLogPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EmailLogPeer::populateObjects(EmailLogPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EmailLogPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EmailLogPeer::getOMClass();
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
		return EmailLogPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(EmailLogPeer::ID); 

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
			$comparison = $criteria->getComparison(EmailLogPeer::ID);
			$selectCriteria->add(EmailLogPeer::ID, $criteria->remove(EmailLogPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(EmailLogPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EmailLogPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof EmailLog) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(EmailLogPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(EmailLog $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EmailLogPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EmailLogPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EmailLogPeer::DATABASE_NAME, EmailLogPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EmailLogPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(EmailLogPeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(EmailLogPeer::ID, $pk);


		$v = EmailLogPeer::doSelect($criteria, $con);

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
			$criteria->add(EmailLogPeer::ID, $pks, Criteria::IN);
			$objs = EmailLogPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseEmailLogPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/EmailLogMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.EmailLogMapBuilder');
}
