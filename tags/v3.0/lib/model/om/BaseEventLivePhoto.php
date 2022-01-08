<?php


abstract class BaseEventLivePhoto extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $event_live_id;


	
	protected $file_id;


	
	protected $width;


	
	protected $height;


	
	protected $orientation;


	
	protected $deleted;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aEventLive;

	
	protected $aFile;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getEventLiveId()
	{

		return $this->event_live_id;
	}

	
	public function getFileId()
	{

		return $this->file_id;
	}

	
	public function getWidth()
	{

		return $this->width;
	}

	
	public function getHeight()
	{

		return $this->height;
	}

	
	public function getOrientation()
	{

		return $this->orientation;
	}

	
	public function getDeleted()
	{

		return $this->deleted;
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
			$this->modifiedColumns[] = EventLivePhotoPeer::ID;
		}

	} 
	
	public function setEventLiveId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->event_live_id !== $v) {
			$this->event_live_id = $v;
			$this->modifiedColumns[] = EventLivePhotoPeer::EVENT_LIVE_ID;
		}

		if ($this->aEventLive !== null && $this->aEventLive->getId() !== $v) {
			$this->aEventLive = null;
		}

	} 
	
	public function setFileId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->file_id !== $v) {
			$this->file_id = $v;
			$this->modifiedColumns[] = EventLivePhotoPeer::FILE_ID;
		}

		if ($this->aFile !== null && $this->aFile->getId() !== $v) {
			$this->aFile = null;
		}

	} 
	
	public function setWidth($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->width !== $v) {
			$this->width = $v;
			$this->modifiedColumns[] = EventLivePhotoPeer::WIDTH;
		}

	} 
	
	public function setHeight($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->height !== $v) {
			$this->height = $v;
			$this->modifiedColumns[] = EventLivePhotoPeer::HEIGHT;
		}

	} 
	
	public function setOrientation($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->orientation !== $v) {
			$this->orientation = $v;
			$this->modifiedColumns[] = EventLivePhotoPeer::ORIENTATION;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = EventLivePhotoPeer::DELETED;
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
			$this->modifiedColumns[] = EventLivePhotoPeer::CREATED_AT;
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
			$this->modifiedColumns[] = EventLivePhotoPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->event_live_id = $rs->getInt($startcol + 1);

			$this->file_id = $rs->getInt($startcol + 2);

			$this->width = $rs->getInt($startcol + 3);

			$this->height = $rs->getInt($startcol + 4);

			$this->orientation = $rs->getString($startcol + 5);

			$this->deleted = $rs->getBoolean($startcol + 6);

			$this->created_at = $rs->getTimestamp($startcol + 7, null);

			$this->updated_at = $rs->getTimestamp($startcol + 8, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EventLivePhoto object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventLivePhotoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EventLivePhotoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(EventLivePhotoPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(EventLivePhotoPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if( $this->isDeleted() )
			throw new PropelException("You cannot save an object that has been deleted.");

		if( $con === null )
			$con = Propel::getConnection(EventLivePhotoPeer::DATABASE_NAME);

		$tableName = EventLivePhotoPeer::TABLE_NAME;
		
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


												
			if ($this->aEventLive !== null) {
				if ($this->aEventLive->isModified()) {
					$affectedRows += $this->aEventLive->save($con);
				}
				$this->setEventLive($this->aEventLive);
			}

			if ($this->aFile !== null) {
				if ($this->aFile->isModified()) {
					$affectedRows += $this->aFile->save($con);
				}
				$this->setFile($this->aFile);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EventLivePhotoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += EventLivePhotoPeer::doUpdate($this, $con);
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


												
			if ($this->aEventLive !== null) {
				if (!$this->aEventLive->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEventLive->getValidationFailures());
				}
			}

			if ($this->aFile !== null) {
				if (!$this->aFile->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFile->getValidationFailures());
				}
			}


			if (($retval = EventLivePhotoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventLivePhotoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getEventLiveId();
				break;
			case 2:
				return $this->getFileId();
				break;
			case 3:
				return $this->getWidth();
				break;
			case 4:
				return $this->getHeight();
				break;
			case 5:
				return $this->getOrientation();
				break;
			case 6:
				return $this->getDeleted();
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
		$keys = EventLivePhotoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getEventLiveId(),
			$keys[2]=>$this->getFileId(),
			$keys[3]=>$this->getWidth(),
			$keys[4]=>$this->getHeight(),
			$keys[5]=>$this->getOrientation(),
			$keys[6]=>$this->getDeleted(),
			$keys[7]=>$this->getCreatedAt(),
			$keys[8]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventLivePhotoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setEventLiveId($value);
				break;
			case 2:
				$this->setFileId($value);
				break;
			case 3:
				$this->setWidth($value);
				break;
			case 4:
				$this->setHeight($value);
				break;
			case 5:
				$this->setOrientation($value);
				break;
			case 6:
				$this->setDeleted($value);
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
		$keys = EventLivePhotoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setEventLiveId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFileId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setWidth($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setHeight($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setOrientation($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDeleted($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUpdatedAt($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EventLivePhotoPeer::DATABASE_NAME);

		if ($this->isColumnModified(EventLivePhotoPeer::ID)) $criteria->add(EventLivePhotoPeer::ID, $this->id);
		if ($this->isColumnModified(EventLivePhotoPeer::EVENT_LIVE_ID)) $criteria->add(EventLivePhotoPeer::EVENT_LIVE_ID, $this->event_live_id);
		if ($this->isColumnModified(EventLivePhotoPeer::FILE_ID)) $criteria->add(EventLivePhotoPeer::FILE_ID, $this->file_id);
		if ($this->isColumnModified(EventLivePhotoPeer::WIDTH)) $criteria->add(EventLivePhotoPeer::WIDTH, $this->width);
		if ($this->isColumnModified(EventLivePhotoPeer::HEIGHT)) $criteria->add(EventLivePhotoPeer::HEIGHT, $this->height);
		if ($this->isColumnModified(EventLivePhotoPeer::ORIENTATION)) $criteria->add(EventLivePhotoPeer::ORIENTATION, $this->orientation);
		if ($this->isColumnModified(EventLivePhotoPeer::DELETED)) $criteria->add(EventLivePhotoPeer::DELETED, $this->deleted);
		if ($this->isColumnModified(EventLivePhotoPeer::CREATED_AT)) $criteria->add(EventLivePhotoPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(EventLivePhotoPeer::UPDATED_AT)) $criteria->add(EventLivePhotoPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EventLivePhotoPeer::DATABASE_NAME);

		$criteria->add(EventLivePhotoPeer::ID, $this->id);

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

		$copyObj->setEventLiveId($this->event_live_id);

		$copyObj->setFileId($this->file_id);

		$copyObj->setWidth($this->width);

		$copyObj->setHeight($this->height);

		$copyObj->setOrientation($this->orientation);

		$copyObj->setDeleted($this->deleted);

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
			self::$peer = new EventLivePhotoPeer();
		}
		return self::$peer;
	}

	
	public function setEventLive($v)
	{


		if ($v === null) {
			$this->setEventLiveId(NULL);
		} else {
			$this->setEventLiveId($v->getId());
		}


		$this->aEventLive = $v;
	}


	
	public function getEventLive($con = null)
	{
		if ($this->aEventLive === null && ($this->event_live_id !== null)) {
						include_once 'lib/model/om/BaseEventLivePeer.php';

			$this->aEventLive = EventLivePeer::retrieveByPK($this->event_live_id, $con);

			
		}
		return $this->aEventLive;
	}

	
	public function setFile($v)
	{


		if ($v === null) {
			$this->setFileId(NULL);
		} else {
			$this->setFileId($v->getId());
		}


		$this->aFile = $v;
	}


	
	public function getFile($con = null)
	{
		if ($this->aFile === null && ($this->file_id !== null)) {
						include_once 'lib/model/om/BaseFilePeer.php';

			$this->aFile = FilePeer::retrieveByPK($this->file_id, $con);

			
		}
		return $this->aFile;
	}

} 