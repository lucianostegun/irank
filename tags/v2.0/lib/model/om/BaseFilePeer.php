<?php


abstract class BaseFilePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'file';

	
	const CLASS_DEFAULT = 'lib.model.File';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'file.ID';

	
	const FILE_NAME = 'file.FILE_NAME';

	
	const FILE_PATH = 'file.FILE_PATH';

	
	const FILE_SIZE = 'file.FILE_SIZE';

	
	const IS_IMAGE = 'file.IS_IMAGE';

	
	const DELETED = 'file.DELETED';

	
	const DESCRIPTION = 'file.DESCRIPTION';

	
	const CREATED_AT = 'file.CREATED_AT';

	
	const UPDATED_AT = 'file.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME=>array ('Id', 'FileName', 'FilePath', 'FileSize', 'IsImage', 'Deleted', 'Description', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME=>array (FilePeer::ID, FilePeer::FILE_NAME, FilePeer::FILE_PATH, FilePeer::FILE_SIZE, FilePeer::IS_IMAGE, FilePeer::DELETED, FilePeer::DESCRIPTION, FilePeer::CREATED_AT, FilePeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME=>array ('id', 'file_name', 'file_path', 'file_size', 'is_image', 'deleted', 'description', 'created_at', 'updated_at', ),
		BasePeer::TYPE_ALIAS=>array ('ID'=>'', 'FILE_NAME'=>'', 'FILE_PATH'=>'', 'FILE_SIZE'=>'', 'IS_IMAGE'=>'', 'DELETED'=>'', 'DESCRIPTION'=>'', 'CREATED_AT'=>'', 'UPDATED_AT'=>'', ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME=>array ('Id'=>0, 'FileName'=>1, 'FilePath'=>2, 'FileSize'=>3, 'IsImage'=>4, 'Deleted'=>5, 'Description'=>6, 'CreatedAt'=>7, 'UpdatedAt'=>8, ),
		BasePeer::TYPE_COLNAME=>array (FilePeer::ID=>0, FilePeer::FILE_NAME=>1, FilePeer::FILE_PATH=>2, FilePeer::FILE_SIZE=>3, FilePeer::IS_IMAGE=>4, FilePeer::DELETED=>5, FilePeer::DESCRIPTION=>6, FilePeer::CREATED_AT=>7, FilePeer::UPDATED_AT=>8, ),
		BasePeer::TYPE_FIELDNAME=>array ('id'=>0, 'file_name'=>1, 'file_path'=>2, 'file_size'=>3, 'is_image'=>4, 'deleted'=>5, 'description'=>6, 'created_at'=>7, 'updated_at'=>8, ),
		BasePeer::TYPE_NUM=>array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/FileMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.FileMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = FilePeer::getTableMap();
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
		return str_replace(FilePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(FilePeer::ID);

		$criteria->addSelectColumn(FilePeer::FILE_NAME);

		$criteria->addSelectColumn(FilePeer::FILE_PATH);

		$criteria->addSelectColumn(FilePeer::FILE_SIZE);

		$criteria->addSelectColumn(FilePeer::IS_IMAGE);

		$criteria->addSelectColumn(FilePeer::DELETED);

		$criteria->addSelectColumn(FilePeer::DESCRIPTION);

		$criteria->addSelectColumn(FilePeer::CREATED_AT);

		$criteria->addSelectColumn(FilePeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(file.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT file.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FilePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = FilePeer::doSelectRS($criteria, $con);
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
		$objects = FilePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return FilePeer::populateObjects(FilePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			FilePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = FilePeer::getOMClass();
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
		return FilePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(FilePeer::ID); 

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
			$comparison = $criteria->getComparison(FilePeer::ID);
			$selectCriteria->add(FilePeer::ID, $criteria->remove(FilePeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(FilePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(FilePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof File) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(FilePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(File $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(FilePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(FilePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(FilePeer::DATABASE_NAME, FilePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = FilePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(FilePeer::DATABASE_NAME);
		$criteria->setNoFilter(true);

		$criteria->add(FilePeer::ID, $pk);


		$v = FilePeer::doSelect($criteria, $con);

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
			$criteria->add(FilePeer::ID, $pks, Criteria::IN);
			$objs = FilePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseFilePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/FileMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.FileMapBuilder');
}
