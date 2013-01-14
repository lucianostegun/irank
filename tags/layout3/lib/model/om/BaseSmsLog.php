<?php


abstract class BaseSmsLog extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $sms_id;


	
	protected $message_id;


	
	protected $phone_number;


	
	protected $sending_status;


	
	protected $created_at;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getSmsId()
	{

		return $this->sms_id;
	}

	
	public function getMessageId()
	{

		return $this->message_id;
	}

	
	public function getPhoneNumber()
	{

		return $this->phone_number;
	}

	
	public function getSendingStatus()
	{

		return $this->sending_status;
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

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SmsLogPeer::ID;
		}

	} 
	
	public function setSmsId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sms_id !== $v) {
			$this->sms_id = $v;
			$this->modifiedColumns[] = SmsLogPeer::SMS_ID;
		}

	} 
	
	public function setMessageId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->message_id !== $v) {
			$this->message_id = $v;
			$this->modifiedColumns[] = SmsLogPeer::MESSAGE_ID;
		}

	} 
	
	public function setPhoneNumber($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->phone_number !== $v) {
			$this->phone_number = $v;
			$this->modifiedColumns[] = SmsLogPeer::PHONE_NUMBER;
		}

	} 
	
	public function setSendingStatus($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sending_status !== $v) {
			$this->sending_status = $v;
			$this->modifiedColumns[] = SmsLogPeer::SENDING_STATUS;
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
			$this->modifiedColumns[] = SmsLogPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->sms_id = $rs->getInt($startcol + 1);

			$this->message_id = $rs->getString($startcol + 2);

			$this->phone_number = $rs->getString($startcol + 3);

			$this->sending_status = $rs->getString($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SmsLog object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SmsLogPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SmsLogPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(SmsLogPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if( $this->isDeleted() )
			throw new PropelException("You cannot save an object that has been deleted.");

		if( $con === null )
			$con = Propel::getConnection(SmsLogPeer::DATABASE_NAME);

		$tableName = SmsLogPeer::TABLE_NAME;
		
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SmsLogPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SmsLogPeer::doUpdate($this, $con);
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


			if (($retval = SmsLogPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SmsLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getSmsId();
				break;
			case 2:
				return $this->getMessageId();
				break;
			case 3:
				return $this->getPhoneNumber();
				break;
			case 4:
				return $this->getSendingStatus();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SmsLogPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getSmsId(),
			$keys[2]=>$this->getMessageId(),
			$keys[3]=>$this->getPhoneNumber(),
			$keys[4]=>$this->getSendingStatus(),
			$keys[5]=>$this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SmsLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setSmsId($value);
				break;
			case 2:
				$this->setMessageId($value);
				break;
			case 3:
				$this->setPhoneNumber($value);
				break;
			case 4:
				$this->setSendingStatus($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SmsLogPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setSmsId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setMessageId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPhoneNumber($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSendingStatus($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SmsLogPeer::DATABASE_NAME);

		if ($this->isColumnModified(SmsLogPeer::ID)) $criteria->add(SmsLogPeer::ID, $this->id);
		if ($this->isColumnModified(SmsLogPeer::SMS_ID)) $criteria->add(SmsLogPeer::SMS_ID, $this->sms_id);
		if ($this->isColumnModified(SmsLogPeer::MESSAGE_ID)) $criteria->add(SmsLogPeer::MESSAGE_ID, $this->message_id);
		if ($this->isColumnModified(SmsLogPeer::PHONE_NUMBER)) $criteria->add(SmsLogPeer::PHONE_NUMBER, $this->phone_number);
		if ($this->isColumnModified(SmsLogPeer::SENDING_STATUS)) $criteria->add(SmsLogPeer::SENDING_STATUS, $this->sending_status);
		if ($this->isColumnModified(SmsLogPeer::CREATED_AT)) $criteria->add(SmsLogPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SmsLogPeer::DATABASE_NAME);

		$criteria->add(SmsLogPeer::ID, $this->id);

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

		$copyObj->setSmsId($this->sms_id);

		$copyObj->setMessageId($this->message_id);

		$copyObj->setPhoneNumber($this->phone_number);

		$copyObj->setSendingStatus($this->sending_status);

		$copyObj->setCreatedAt($this->created_at);


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
			self::$peer = new SmsLogPeer();
		}
		return self::$peer;
	}

} 