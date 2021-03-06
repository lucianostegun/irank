<?php


abstract class BaseEmailLog extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $email_address;


	
	protected $error_message;


	
	protected $email_subject;


	
	protected $sending_status;


	
	protected $created_at;


	
	protected $read_at;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getEmailAddress()
	{

		return $this->email_address;
	}

	
	public function getErrorMessage()
	{

		return $this->error_message;
	}

	
	public function getEmailSubject()
	{

		return $this->email_subject;
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

	
	public function getReadAt($format = 'Y-m-d H:i:s')
	{

		if ($this->read_at === null || $this->read_at === '') {
			return null;
		} elseif (!is_int($this->read_at)) {
						$ts = strtotime($this->read_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [read_at] as date/time value: " . var_export($this->read_at, true));
			}
		} else {
			$ts = $this->read_at;
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
			$this->modifiedColumns[] = EmailLogPeer::ID;
		}

	} 
	
	public function setEmailAddress($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email_address !== $v) {
			$this->email_address = $v;
			$this->modifiedColumns[] = EmailLogPeer::EMAIL_ADDRESS;
		}

	} 
	
	public function setErrorMessage($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->error_message !== $v) {
			$this->error_message = $v;
			$this->modifiedColumns[] = EmailLogPeer::ERROR_MESSAGE;
		}

	} 
	
	public function setEmailSubject($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email_subject !== $v) {
			$this->email_subject = $v;
			$this->modifiedColumns[] = EmailLogPeer::EMAIL_SUBJECT;
		}

	} 
	
	public function setSendingStatus($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sending_status !== $v) {
			$this->sending_status = $v;
			$this->modifiedColumns[] = EmailLogPeer::SENDING_STATUS;
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
			$this->modifiedColumns[] = EmailLogPeer::CREATED_AT;
		}

	} 
	
	public function setReadAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [read_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->read_at !== $ts) {
			$this->read_at = $ts;
			$this->modifiedColumns[] = EmailLogPeer::READ_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->email_address = $rs->getString($startcol + 1);

			$this->error_message = $rs->getString($startcol + 2);

			$this->email_subject = $rs->getString($startcol + 3);

			$this->sending_status = $rs->getString($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->read_at = $rs->getTimestamp($startcol + 6, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EmailLog object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EmailLogPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EmailLogPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(EmailLogPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EmailLogPeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EmailLogPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += EmailLogPeer::doUpdate($this, $con);
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


			if (($retval = EmailLogPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EmailLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getEmailAddress();
				break;
			case 2:
				return $this->getErrorMessage();
				break;
			case 3:
				return $this->getEmailSubject();
				break;
			case 4:
				return $this->getSendingStatus();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getReadAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EmailLogPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getEmailAddress(),
			$keys[2]=>$this->getErrorMessage(),
			$keys[3]=>$this->getEmailSubject(),
			$keys[4]=>$this->getSendingStatus(),
			$keys[5]=>$this->getCreatedAt(),
			$keys[6]=>$this->getReadAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EmailLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setEmailAddress($value);
				break;
			case 2:
				$this->setErrorMessage($value);
				break;
			case 3:
				$this->setEmailSubject($value);
				break;
			case 4:
				$this->setSendingStatus($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setReadAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EmailLogPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setEmailAddress($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setErrorMessage($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEmailSubject($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSendingStatus($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setReadAt($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EmailLogPeer::DATABASE_NAME);

		if ($this->isColumnModified(EmailLogPeer::ID)) $criteria->add(EmailLogPeer::ID, $this->id);
		if ($this->isColumnModified(EmailLogPeer::EMAIL_ADDRESS)) $criteria->add(EmailLogPeer::EMAIL_ADDRESS, $this->email_address);
		if ($this->isColumnModified(EmailLogPeer::ERROR_MESSAGE)) $criteria->add(EmailLogPeer::ERROR_MESSAGE, $this->error_message);
		if ($this->isColumnModified(EmailLogPeer::EMAIL_SUBJECT)) $criteria->add(EmailLogPeer::EMAIL_SUBJECT, $this->email_subject);
		if ($this->isColumnModified(EmailLogPeer::SENDING_STATUS)) $criteria->add(EmailLogPeer::SENDING_STATUS, $this->sending_status);
		if ($this->isColumnModified(EmailLogPeer::CREATED_AT)) $criteria->add(EmailLogPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(EmailLogPeer::READ_AT)) $criteria->add(EmailLogPeer::READ_AT, $this->read_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EmailLogPeer::DATABASE_NAME);

		$criteria->add(EmailLogPeer::ID, $this->id);

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

		$copyObj->setEmailAddress($this->email_address);

		$copyObj->setErrorMessage($this->error_message);

		$copyObj->setEmailSubject($this->email_subject);

		$copyObj->setSendingStatus($this->sending_status);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setReadAt($this->read_at);


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
			self::$peer = new EmailLogPeer();
		}
		return self::$peer;
	}

} 