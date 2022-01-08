<?php


abstract class BaseEventPhotoContest extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $event_photo_id_left;


	
	protected $event_photo_id_right;


	
	protected $event_photo_id_winner;


	
	protected $lock_key;


	
	protected $ip_address;


	
	protected $is_reported;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aEventPhotoRelatedByEventPhotoIdLeft;

	
	protected $aEventPhotoRelatedByEventPhotoIdRight;

	
	protected $aEventPhotoRelatedByEventPhotoIdWinner;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getEventPhotoIdLeft()
	{

		return $this->event_photo_id_left;
	}

	
	public function getEventPhotoIdRight()
	{

		return $this->event_photo_id_right;
	}

	
	public function getEventPhotoIdWinner()
	{

		return $this->event_photo_id_winner;
	}

	
	public function getLockKey()
	{

		return $this->lock_key;
	}

	
	public function getIpAddress()
	{

		return $this->ip_address;
	}

	
	public function getIsReported()
	{

		return $this->is_reported;
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

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = EventPhotoContestPeer::ID;
		}

	} 
	
	public function setEventPhotoIdLeft($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->event_photo_id_left !== $v) {
			$this->event_photo_id_left = $v;
			$this->modifiedColumns[] = EventPhotoContestPeer::EVENT_PHOTO_ID_LEFT;
		}

		if ($this->aEventPhotoRelatedByEventPhotoIdLeft !== null && $this->aEventPhotoRelatedByEventPhotoIdLeft->getId() !== $v) {
			$this->aEventPhotoRelatedByEventPhotoIdLeft = null;
		}

	} 
	
	public function setEventPhotoIdRight($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->event_photo_id_right !== $v) {
			$this->event_photo_id_right = $v;
			$this->modifiedColumns[] = EventPhotoContestPeer::EVENT_PHOTO_ID_RIGHT;
		}

		if ($this->aEventPhotoRelatedByEventPhotoIdRight !== null && $this->aEventPhotoRelatedByEventPhotoIdRight->getId() !== $v) {
			$this->aEventPhotoRelatedByEventPhotoIdRight = null;
		}

	} 
	
	public function setEventPhotoIdWinner($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->event_photo_id_winner !== $v) {
			$this->event_photo_id_winner = $v;
			$this->modifiedColumns[] = EventPhotoContestPeer::EVENT_PHOTO_ID_WINNER;
		}

		if ($this->aEventPhotoRelatedByEventPhotoIdWinner !== null && $this->aEventPhotoRelatedByEventPhotoIdWinner->getId() !== $v) {
			$this->aEventPhotoRelatedByEventPhotoIdWinner = null;
		}

	} 
	
	public function setLockKey($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->lock_key !== $v) {
			$this->lock_key = $v;
			$this->modifiedColumns[] = EventPhotoContestPeer::LOCK_KEY;
		}

	} 
	
	public function setIpAddress($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ip_address !== $v) {
			$this->ip_address = $v;
			$this->modifiedColumns[] = EventPhotoContestPeer::IP_ADDRESS;
		}

	} 
	
	public function setIsReported($v)
	{

		if ($this->is_reported !== $v) {
			$this->is_reported = $v;
			$this->modifiedColumns[] = EventPhotoContestPeer::IS_REPORTED;
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
			$this->modifiedColumns[] = EventPhotoContestPeer::CREATED_AT;
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
			$this->modifiedColumns[] = EventPhotoContestPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->event_photo_id_left = $rs->getInt($startcol + 1);

			$this->event_photo_id_right = $rs->getInt($startcol + 2);

			$this->event_photo_id_winner = $rs->getInt($startcol + 3);

			$this->lock_key = $rs->getString($startcol + 4);

			$this->ip_address = $rs->getString($startcol + 5);

			$this->is_reported = $rs->getBoolean($startcol + 6);

			$this->created_at = $rs->getTimestamp($startcol + 7, null);

			$this->updated_at = $rs->getTimestamp($startcol + 8, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EventPhotoContest object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventPhotoContestPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EventPhotoContestPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(EventPhotoContestPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(EventPhotoContestPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if( $this->isDeleted() )
			throw new PropelException("You cannot save an object that has been deleted.");

		if( $con === null )
			$con = Propel::getConnection(EventPhotoContestPeer::DATABASE_NAME);

		$tableName = EventPhotoContestPeer::TABLE_NAME;
		
		try{
			
			if( !preg_match('/log$/', $tableName) )
				$columnModifiedList = Log::getModifiedColumnList($this);
			
			$isNew = $this->isNew();
			
			$con->begin();
			$affectedRows = $this->doSave($con);
			
			if( !preg_match('/log$/', $tableName) ){
			
				if( method_exists($this, 'getDeleted') && $this->getDeleted() )
	        		Log::quickLogDelete($tableName, $this->getPrimaryKey(), get_class($this));
	        	else
	        		Log::quickLog($tableName, $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
		   }
	   
			$con->commit();
			
			return $affectedRows;
		}catch(PropelException $e) {
			
			$con->rollback();
			if( !preg_match('/log$/', $tableName) )
				Log::quickLogError($tableName, $this->getPrimaryKey(), $e);
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aEventPhotoRelatedByEventPhotoIdLeft !== null) {
				if ($this->aEventPhotoRelatedByEventPhotoIdLeft->isModified()) {
					$affectedRows += $this->aEventPhotoRelatedByEventPhotoIdLeft->save($con);
				}
				$this->setEventPhotoRelatedByEventPhotoIdLeft($this->aEventPhotoRelatedByEventPhotoIdLeft);
			}

			if ($this->aEventPhotoRelatedByEventPhotoIdRight !== null) {
				if ($this->aEventPhotoRelatedByEventPhotoIdRight->isModified()) {
					$affectedRows += $this->aEventPhotoRelatedByEventPhotoIdRight->save($con);
				}
				$this->setEventPhotoRelatedByEventPhotoIdRight($this->aEventPhotoRelatedByEventPhotoIdRight);
			}

			if ($this->aEventPhotoRelatedByEventPhotoIdWinner !== null) {
				if ($this->aEventPhotoRelatedByEventPhotoIdWinner->isModified()) {
					$affectedRows += $this->aEventPhotoRelatedByEventPhotoIdWinner->save($con);
				}
				$this->setEventPhotoRelatedByEventPhotoIdWinner($this->aEventPhotoRelatedByEventPhotoIdWinner);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EventPhotoContestPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += EventPhotoContestPeer::doUpdate($this, $con);
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


												
			if ($this->aEventPhotoRelatedByEventPhotoIdLeft !== null) {
				if (!$this->aEventPhotoRelatedByEventPhotoIdLeft->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEventPhotoRelatedByEventPhotoIdLeft->getValidationFailures());
				}
			}

			if ($this->aEventPhotoRelatedByEventPhotoIdRight !== null) {
				if (!$this->aEventPhotoRelatedByEventPhotoIdRight->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEventPhotoRelatedByEventPhotoIdRight->getValidationFailures());
				}
			}

			if ($this->aEventPhotoRelatedByEventPhotoIdWinner !== null) {
				if (!$this->aEventPhotoRelatedByEventPhotoIdWinner->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEventPhotoRelatedByEventPhotoIdWinner->getValidationFailures());
				}
			}


			if (($retval = EventPhotoContestPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventPhotoContestPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getEventPhotoIdLeft();
				break;
			case 2:
				return $this->getEventPhotoIdRight();
				break;
			case 3:
				return $this->getEventPhotoIdWinner();
				break;
			case 4:
				return $this->getLockKey();
				break;
			case 5:
				return $this->getIpAddress();
				break;
			case 6:
				return $this->getIsReported();
				break;
			case 7:
				return $this->getCreatedAt();
				break;
			case 8:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EventPhotoContestPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getEventPhotoIdLeft(),
			$keys[2]=>$this->getEventPhotoIdRight(),
			$keys[3]=>$this->getEventPhotoIdWinner(),
			$keys[4]=>$this->getLockKey(),
			$keys[5]=>$this->getIpAddress(),
			$keys[6]=>$this->getIsReported(),
			$keys[7]=>$this->getCreatedAt(),
			$keys[8]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventPhotoContestPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setEventPhotoIdLeft($value);
				break;
			case 2:
				$this->setEventPhotoIdRight($value);
				break;
			case 3:
				$this->setEventPhotoIdWinner($value);
				break;
			case 4:
				$this->setLockKey($value);
				break;
			case 5:
				$this->setIpAddress($value);
				break;
			case 6:
				$this->setIsReported($value);
				break;
			case 7:
				$this->setCreatedAt($value);
				break;
			case 8:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EventPhotoContestPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setEventPhotoIdLeft($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEventPhotoIdRight($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEventPhotoIdWinner($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setLockKey($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIpAddress($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsReported($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUpdatedAt($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EventPhotoContestPeer::DATABASE_NAME);

		if ($this->isColumnModified(EventPhotoContestPeer::ID)) $criteria->add(EventPhotoContestPeer::ID, $this->id);
		if ($this->isColumnModified(EventPhotoContestPeer::EVENT_PHOTO_ID_LEFT)) $criteria->add(EventPhotoContestPeer::EVENT_PHOTO_ID_LEFT, $this->event_photo_id_left);
		if ($this->isColumnModified(EventPhotoContestPeer::EVENT_PHOTO_ID_RIGHT)) $criteria->add(EventPhotoContestPeer::EVENT_PHOTO_ID_RIGHT, $this->event_photo_id_right);
		if ($this->isColumnModified(EventPhotoContestPeer::EVENT_PHOTO_ID_WINNER)) $criteria->add(EventPhotoContestPeer::EVENT_PHOTO_ID_WINNER, $this->event_photo_id_winner);
		if ($this->isColumnModified(EventPhotoContestPeer::LOCK_KEY)) $criteria->add(EventPhotoContestPeer::LOCK_KEY, $this->lock_key);
		if ($this->isColumnModified(EventPhotoContestPeer::IP_ADDRESS)) $criteria->add(EventPhotoContestPeer::IP_ADDRESS, $this->ip_address);
		if ($this->isColumnModified(EventPhotoContestPeer::IS_REPORTED)) $criteria->add(EventPhotoContestPeer::IS_REPORTED, $this->is_reported);
		if ($this->isColumnModified(EventPhotoContestPeer::CREATED_AT)) $criteria->add(EventPhotoContestPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(EventPhotoContestPeer::UPDATED_AT)) $criteria->add(EventPhotoContestPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EventPhotoContestPeer::DATABASE_NAME);

		$criteria->add(EventPhotoContestPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setEventPhotoIdLeft($this->event_photo_id_left);

		$copyObj->setEventPhotoIdRight($this->event_photo_id_right);

		$copyObj->setEventPhotoIdWinner($this->event_photo_id_winner);

		$copyObj->setLockKey($this->lock_key);

		$copyObj->setIpAddress($this->ip_address);

		$copyObj->setIsReported($this->is_reported);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
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
			self::$peer = new EventPhotoContestPeer();
		}
		return self::$peer;
	}

	
	public function setEventPhotoRelatedByEventPhotoIdLeft($v)
	{


		if ($v === null) {
			$this->setEventPhotoIdLeft(NULL);
		} else {
			$this->setEventPhotoIdLeft($v->getId());
		}


		$this->aEventPhotoRelatedByEventPhotoIdLeft = $v;
	}


	
	public function getEventPhotoRelatedByEventPhotoIdLeft($con = null)
	{
		if ($this->aEventPhotoRelatedByEventPhotoIdLeft === null && ($this->event_photo_id_left !== null)) {
						include_once 'lib/model/om/BaseEventPhotoPeer.php';

			$this->aEventPhotoRelatedByEventPhotoIdLeft = EventPhotoPeer::retrieveByPK($this->event_photo_id_left, $con);

			
		}
		return $this->aEventPhotoRelatedByEventPhotoIdLeft;
	}

	
	public function setEventPhotoRelatedByEventPhotoIdRight($v)
	{


		if ($v === null) {
			$this->setEventPhotoIdRight(NULL);
		} else {
			$this->setEventPhotoIdRight($v->getId());
		}


		$this->aEventPhotoRelatedByEventPhotoIdRight = $v;
	}


	
	public function getEventPhotoRelatedByEventPhotoIdRight($con = null)
	{
		if ($this->aEventPhotoRelatedByEventPhotoIdRight === null && ($this->event_photo_id_right !== null)) {
						include_once 'lib/model/om/BaseEventPhotoPeer.php';

			$this->aEventPhotoRelatedByEventPhotoIdRight = EventPhotoPeer::retrieveByPK($this->event_photo_id_right, $con);

			
		}
		return $this->aEventPhotoRelatedByEventPhotoIdRight;
	}

	
	public function setEventPhotoRelatedByEventPhotoIdWinner($v)
	{


		if ($v === null) {
			$this->setEventPhotoIdWinner(NULL);
		} else {
			$this->setEventPhotoIdWinner($v->getId());
		}


		$this->aEventPhotoRelatedByEventPhotoIdWinner = $v;
	}


	
	public function getEventPhotoRelatedByEventPhotoIdWinner($con = null)
	{
		if ($this->aEventPhotoRelatedByEventPhotoIdWinner === null && ($this->event_photo_id_winner !== null)) {
						include_once 'lib/model/om/BaseEventPhotoPeer.php';

			$this->aEventPhotoRelatedByEventPhotoIdWinner = EventPhotoPeer::retrieveByPK($this->event_photo_id_winner, $con);

			
		}
		return $this->aEventPhotoRelatedByEventPhotoIdWinner;
	}

} 