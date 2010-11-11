<?php


abstract class BaseUserSite extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $people_id;


	
	protected $username;


	
	protected $password;


	
	protected $email_address;


	
	protected $active;


	
	protected $last_access_date;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aPeople;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getPeopleId()
	{

		return $this->people_id;
	}

	
	public function getUsername()
	{

		return $this->username;
	}

	
	public function getPassword()
	{

		return $this->password;
	}

	
	public function getEmailAddress()
	{

		return $this->email_address;
	}

	
	public function getActive()
	{

		return $this->active;
	}

	
	public function getLastAccessDate($format = 'Y-m-d H:i:s')
	{

		if ($this->last_access_date === null || $this->last_access_date === '') {
			return null;
		} elseif (!is_int($this->last_access_date)) {
						$ts = strtotime($this->last_access_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [last_access_date] as date/time value: " . var_export($this->last_access_date, true));
			}
		} else {
			$ts = $this->last_access_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
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
			$this->modifiedColumns[] = UserSitePeer::ID;
		}

	} 
	
	public function setPeopleId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->people_id !== $v) {
			$this->people_id = $v;
			$this->modifiedColumns[] = UserSitePeer::PEOPLE_ID;
		}

		if ($this->aPeople !== null && $this->aPeople->getId() !== $v) {
			$this->aPeople = null;
		}

	} 
	
	public function setUsername($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->username !== $v) {
			$this->username = $v;
			$this->modifiedColumns[] = UserSitePeer::USERNAME;
		}

	} 
	
	public function setPassword($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->password !== $v) {
			$this->password = $v;
			$this->modifiedColumns[] = UserSitePeer::PASSWORD;
		}

	} 
	
	public function setEmailAddress($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email_address !== $v) {
			$this->email_address = $v;
			$this->modifiedColumns[] = UserSitePeer::EMAIL_ADDRESS;
		}

	} 
	
	public function setActive($v)
	{

		if ($this->active !== $v) {
			$this->active = $v;
			$this->modifiedColumns[] = UserSitePeer::ACTIVE;
		}

	} 
	
	public function setLastAccessDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [last_access_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->last_access_date !== $ts) {
			$this->last_access_date = $ts;
			$this->modifiedColumns[] = UserSitePeer::LAST_ACCESS_DATE;
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
			$this->modifiedColumns[] = UserSitePeer::CREATED_AT;
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
			$this->modifiedColumns[] = UserSitePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->people_id = $rs->getInt($startcol + 1);

			$this->username = $rs->getString($startcol + 2);

			$this->password = $rs->getString($startcol + 3);

			$this->email_address = $rs->getString($startcol + 4);

			$this->active = $rs->getBoolean($startcol + 5);

			$this->last_access_date = $rs->getTimestamp($startcol + 6, null);

			$this->created_at = $rs->getTimestamp($startcol + 7, null);

			$this->updated_at = $rs->getTimestamp($startcol + 8, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating UserSite object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UserSitePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			UserSitePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(UserSitePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(UserSitePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UserSitePeer::DATABASE_NAME);
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


												
			if ($this->aPeople !== null) {
				if ($this->aPeople->isModified()) {
					$affectedRows += $this->aPeople->save($con);
				}
				$this->setPeople($this->aPeople);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = UserSitePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += UserSitePeer::doUpdate($this, $con);
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


												
			if ($this->aPeople !== null) {
				if (!$this->aPeople->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPeople->getValidationFailures());
				}
			}


			if (($retval = UserSitePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UserSitePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getPeopleId();
				break;
			case 2:
				return $this->getUsername();
				break;
			case 3:
				return $this->getPassword();
				break;
			case 4:
				return $this->getEmailAddress();
				break;
			case 5:
				return $this->getActive();
				break;
			case 6:
				return $this->getLastAccessDate();
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
		$keys = UserSitePeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getPeopleId(),
			$keys[2]=>$this->getUsername(),
			$keys[3]=>$this->getPassword(),
			$keys[4]=>$this->getEmailAddress(),
			$keys[5]=>$this->getActive(),
			$keys[6]=>$this->getLastAccessDate(),
			$keys[7]=>$this->getCreatedAt(),
			$keys[8]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UserSitePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setPeopleId($value);
				break;
			case 2:
				$this->setUsername($value);
				break;
			case 3:
				$this->setPassword($value);
				break;
			case 4:
				$this->setEmailAddress($value);
				break;
			case 5:
				$this->setActive($value);
				break;
			case 6:
				$this->setLastAccessDate($value);
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
		$keys = UserSitePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPeopleId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUsername($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPassword($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEmailAddress($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setActive($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setLastAccessDate($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUpdatedAt($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(UserSitePeer::DATABASE_NAME);

		if ($this->isColumnModified(UserSitePeer::ID)) $criteria->add(UserSitePeer::ID, $this->id);
		if ($this->isColumnModified(UserSitePeer::PEOPLE_ID)) $criteria->add(UserSitePeer::PEOPLE_ID, $this->people_id);
		if ($this->isColumnModified(UserSitePeer::USERNAME)) $criteria->add(UserSitePeer::USERNAME, $this->username);
		if ($this->isColumnModified(UserSitePeer::PASSWORD)) $criteria->add(UserSitePeer::PASSWORD, $this->password);
		if ($this->isColumnModified(UserSitePeer::EMAIL_ADDRESS)) $criteria->add(UserSitePeer::EMAIL_ADDRESS, $this->email_address);
		if ($this->isColumnModified(UserSitePeer::ACTIVE)) $criteria->add(UserSitePeer::ACTIVE, $this->active);
		if ($this->isColumnModified(UserSitePeer::LAST_ACCESS_DATE)) $criteria->add(UserSitePeer::LAST_ACCESS_DATE, $this->last_access_date);
		if ($this->isColumnModified(UserSitePeer::CREATED_AT)) $criteria->add(UserSitePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(UserSitePeer::UPDATED_AT)) $criteria->add(UserSitePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(UserSitePeer::DATABASE_NAME);

		$criteria->add(UserSitePeer::ID, $this->id);

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

		$copyObj->setPeopleId($this->people_id);

		$copyObj->setUsername($this->username);

		$copyObj->setPassword($this->password);

		$copyObj->setEmailAddress($this->email_address);

		$copyObj->setActive($this->active);

		$copyObj->setLastAccessDate($this->last_access_date);

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
			self::$peer = new UserSitePeer();
		}
		return self::$peer;
	}

	
	public function setPeople($v)
	{


		if ($v === null) {
			$this->setPeopleId(NULL);
		} else {
			$this->setPeopleId($v->getId());
		}


		$this->aPeople = $v;
	}


	
	public function getPeople($con = null)
	{
		if ($this->aPeople === null && ($this->people_id !== null)) {
						include_once 'lib/model/om/BasePeoplePeer.php';

			$this->aPeople = PeoplePeer::retrieveByPK($this->people_id, $con);

			
		}
		return $this->aPeople;
	}

} 