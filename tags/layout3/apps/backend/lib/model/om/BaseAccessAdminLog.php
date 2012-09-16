<?php


abstract class BaseAccessAdminLog extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $user_admin_id;


	
	protected $created_at;


	
	protected $ip_address;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getUserAdminId()
	{

		return $this->user_admin_id;
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

	
	public function getIpAddress()
	{

		return $this->ip_address;
	}

	
	public function setUserAdminId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_admin_id !== $v) {
			$this->user_admin_id = $v;
			$this->modifiedColumns[] = AccessAdminLogPeer::USER_ADMIN_ID;
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
			$this->modifiedColumns[] = AccessAdminLogPeer::CREATED_AT;
		}

	} 
	
	public function setIpAddress($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ip_address !== $v) {
			$this->ip_address = $v;
			$this->modifiedColumns[] = AccessAdminLogPeer::IP_ADDRESS;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->user_admin_id = $rs->getInt($startcol + 0);

			$this->created_at = $rs->getTimestamp($startcol + 1, null);

			$this->ip_address = $rs->getString($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating AccessAdminLog object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AccessAdminLogPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			AccessAdminLogPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(AccessAdminLogPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AccessAdminLogPeer::DATABASE_NAME);
		}

		$tableName = AccessAdminLogPeer::TABLE_NAME;
		
		try {
			
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
		} catch (PropelException $e) {
			
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
					$pk = AccessAdminLogPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += AccessAdminLogPeer::doUpdate($this, $con);
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


			if (($retval = AccessAdminLogPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AccessAdminLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getUserAdminId();
				break;
			case 1:
				return $this->getCreatedAt();
				break;
			case 2:
				return $this->getIpAddress();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AccessAdminLogPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getUserAdminId(),
			$keys[1]=>$this->getCreatedAt(),
			$keys[2]=>$this->getIpAddress(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AccessAdminLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setUserAdminId($value);
				break;
			case 1:
				$this->setCreatedAt($value);
				break;
			case 2:
				$this->setIpAddress($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AccessAdminLogPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setUserAdminId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIpAddress($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AccessAdminLogPeer::DATABASE_NAME);

		if ($this->isColumnModified(AccessAdminLogPeer::USER_ADMIN_ID)) $criteria->add(AccessAdminLogPeer::USER_ADMIN_ID, $this->user_admin_id);
		if ($this->isColumnModified(AccessAdminLogPeer::CREATED_AT)) $criteria->add(AccessAdminLogPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(AccessAdminLogPeer::IP_ADDRESS)) $criteria->add(AccessAdminLogPeer::IP_ADDRESS, $this->ip_address);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AccessAdminLogPeer::DATABASE_NAME);

		$criteria->add(AccessAdminLogPeer::USER_ADMIN_ID, $this->user_admin_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getUserAdminId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setUserAdminId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setIpAddress($this->ip_address);


		$copyObj->setNew(true);

		$copyObj->setUserAdminId(NULL); 
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
			self::$peer = new AccessAdminLogPeer();
		}
		return self::$peer;
	}

} 