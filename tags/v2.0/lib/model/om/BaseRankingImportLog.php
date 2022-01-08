<?php


abstract class BaseRankingImportLog extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $ranking_id;


	
	protected $ranking_id_from;


	
	protected $import_table;


	
	protected $object_id;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aRankingRelatedByRankingId;

	
	protected $aRankingRelatedByRankingIdFrom;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getRankingId()
	{

		return $this->ranking_id;
	}

	
	public function getRankingIdFrom()
	{

		return $this->ranking_id_from;
	}

	
	public function getImportTable()
	{

		return $this->import_table;
	}

	
	public function getObjectId()
	{

		return $this->object_id;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setRankingId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ranking_id !== $v) {
			$this->ranking_id = $v;
			$this->modifiedColumns[] = RankingImportLogPeer::RANKING_ID;
		}

		if ($this->aRankingRelatedByRankingId !== null && $this->aRankingRelatedByRankingId->getId() !== $v) {
			$this->aRankingRelatedByRankingId = null;
		}

	} 
	
	public function setRankingIdFrom($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ranking_id_from !== $v) {
			$this->ranking_id_from = $v;
			$this->modifiedColumns[] = RankingImportLogPeer::RANKING_ID_FROM;
		}

		if ($this->aRankingRelatedByRankingIdFrom !== null && $this->aRankingRelatedByRankingIdFrom->getId() !== $v) {
			$this->aRankingRelatedByRankingIdFrom = null;
		}

	} 
	
	public function setImportTable($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->import_table !== $v) {
			$this->import_table = $v;
			$this->modifiedColumns[] = RankingImportLogPeer::IMPORT_TABLE;
		}

	} 
	
	public function setObjectId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->object_id !== $v) {
			$this->object_id = $v;
			$this->modifiedColumns[] = RankingImportLogPeer::OBJECT_ID;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = RankingImportLogPeer::CREATED_AT;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = RankingImportLogPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->ranking_id = $rs->getInt($startcol + 0);

			$this->ranking_id_from = $rs->getInt($startcol + 1);

			$this->import_table = $rs->getString($startcol + 2);

			$this->object_id = $rs->getInt($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->updated_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating RankingImportLog object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RankingImportLogPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RankingImportLogPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(RankingImportLogPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(RankingImportLogPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RankingImportLogPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aRankingRelatedByRankingId !== null) {
				if ($this->aRankingRelatedByRankingId->isModified()) {
					$affectedRows += $this->aRankingRelatedByRankingId->save($con);
				}
				$this->setRankingRelatedByRankingId($this->aRankingRelatedByRankingId);
			}

			if ($this->aRankingRelatedByRankingIdFrom !== null) {
				if ($this->aRankingRelatedByRankingIdFrom->isModified()) {
					$affectedRows += $this->aRankingRelatedByRankingIdFrom->save($con);
				}
				$this->setRankingRelatedByRankingIdFrom($this->aRankingRelatedByRankingIdFrom);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RankingImportLogPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += RankingImportLogPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aRankingRelatedByRankingId !== null) {
				if (!$this->aRankingRelatedByRankingId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRankingRelatedByRankingId->getValidationFailures());
				}
			}

			if ($this->aRankingRelatedByRankingIdFrom !== null) {
				if (!$this->aRankingRelatedByRankingIdFrom->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRankingRelatedByRankingIdFrom->getValidationFailures());
				}
			}


			if (($retval = RankingImportLogPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RankingImportLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getRankingId();
				break;
			case 1:
				return $this->getRankingIdFrom();
				break;
			case 2:
				return $this->getImportTable();
				break;
			case 3:
				return $this->getObjectId();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			case 5:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RankingImportLogPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getRankingId(),
			$keys[1]=>$this->getRankingIdFrom(),
			$keys[2]=>$this->getImportTable(),
			$keys[3]=>$this->getObjectId(),
			$keys[4]=>$this->getCreatedAt(),
			$keys[5]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RankingImportLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setRankingId($value);
				break;
			case 1:
				$this->setRankingIdFrom($value);
				break;
			case 2:
				$this->setImportTable($value);
				break;
			case 3:
				$this->setObjectId($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
			case 5:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RankingImportLogPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setRankingId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setRankingIdFrom($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setImportTable($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setObjectId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RankingImportLogPeer::DATABASE_NAME);

		if ($this->isColumnModified(RankingImportLogPeer::RANKING_ID)) $criteria->add(RankingImportLogPeer::RANKING_ID, $this->ranking_id);
		if ($this->isColumnModified(RankingImportLogPeer::RANKING_ID_FROM)) $criteria->add(RankingImportLogPeer::RANKING_ID_FROM, $this->ranking_id_from);
		if ($this->isColumnModified(RankingImportLogPeer::IMPORT_TABLE)) $criteria->add(RankingImportLogPeer::IMPORT_TABLE, $this->import_table);
		if ($this->isColumnModified(RankingImportLogPeer::OBJECT_ID)) $criteria->add(RankingImportLogPeer::OBJECT_ID, $this->object_id);
		if ($this->isColumnModified(RankingImportLogPeer::CREATED_AT)) $criteria->add(RankingImportLogPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(RankingImportLogPeer::UPDATED_AT)) $criteria->add(RankingImportLogPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RankingImportLogPeer::DATABASE_NAME);

		$criteria->add(RankingImportLogPeer::RANKING_ID, $this->ranking_id);
		$criteria->add(RankingImportLogPeer::RANKING_ID_FROM, $this->ranking_id_from);
		$criteria->add(RankingImportLogPeer::IMPORT_TABLE, $this->import_table);
		$criteria->add(RankingImportLogPeer::OBJECT_ID, $this->object_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getRankingId();

		$pks[1] = $this->getRankingIdFrom();

		$pks[2] = $this->getImportTable();

		$pks[3] = $this->getObjectId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setRankingId($keys[0]);

		$this->setRankingIdFrom($keys[1]);

		$this->setImportTable($keys[2]);

		$this->setObjectId($keys[3]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setRankingId(NULL); 
		$copyObj->setRankingIdFrom(NULL); 
		$copyObj->setImportTable(NULL); 
		$copyObj->setObjectId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RankingImportLogPeer();
		}
		return self::$peer;
	}

	
	public function setRankingRelatedByRankingId($v)
	{


		if ($v === null) {
			$this->setRankingId(NULL);
		} else {
			$this->setRankingId($v->getId());
		}


		$this->aRankingRelatedByRankingId = $v;
	}


	
	public function getRankingRelatedByRankingId($con = null)
	{
		if ($this->aRankingRelatedByRankingId === null && ($this->ranking_id !== null)) {
						include_once 'lib/model/om/BaseRankingPeer.php';

			$this->aRankingRelatedByRankingId = RankingPeer::retrieveByPK($this->ranking_id, $con);

			
		}
		return $this->aRankingRelatedByRankingId;
	}

	
	public function setRankingRelatedByRankingIdFrom($v)
	{


		if ($v === null) {
			$this->setRankingIdFrom(NULL);
		} else {
			$this->setRankingIdFrom($v->getId());
		}


		$this->aRankingRelatedByRankingIdFrom = $v;
	}


	
	public function getRankingRelatedByRankingIdFrom($con = null)
	{
		if ($this->aRankingRelatedByRankingIdFrom === null && ($this->ranking_id_from !== null)) {
						include_once 'lib/model/om/BaseRankingPeer.php';

			$this->aRankingRelatedByRankingIdFrom = RankingPeer::retrieveByPK($this->ranking_id_from, $con);

			
		}
		return $this->aRankingRelatedByRankingIdFrom;
	}

} 