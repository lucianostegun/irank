<?php


abstract class BaseUserSiteOption extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $people_id;


	
	protected $user_site_option_id;


	
	protected $option_value;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aPeople;

	
	protected $aVirtualTable;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getPeopleId()
	{

		return $this->people_id;
	}

	
	public function getUserSiteOptionId()
	{

		return $this->user_site_option_id;
	}

	
	public function getOptionValue()
	{

		return $this->option_value;
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

	
	public function setPeopleId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->people_id !== $v) {
			$this->people_id = $v;
			$this->modifiedColumns[] = UserSiteOptionPeer::PEOPLE_ID;
		}

		if ($this->aPeople !== null && $this->aPeople->getId() !== $v) {
			$this->aPeople = null;
		}

	} 
	
	public function setUserSiteOptionId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_site_option_id !== $v) {
			$this->user_site_option_id = $v;
			$this->modifiedColumns[] = UserSiteOptionPeer::USER_SITE_OPTION_ID;
		}

		if ($this->aVirtualTable !== null && $this->aVirtualTable->getId() !== $v) {
			$this->aVirtualTable = null;
		}

	} 
	
	public function setOptionValue($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->option_value !== $v) {
			$this->option_value = $v;
			$this->modifiedColumns[] = UserSiteOptionPeer::OPTION_VALUE;
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
			$this->modifiedColumns[] = UserSiteOptionPeer::CREATED_AT;
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
			$this->modifiedColumns[] = UserSiteOptionPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->people_id = $rs->getInt($startcol + 0);

			$this->user_site_option_id = $rs->getInt($startcol + 1);

			$this->option_value = $rs->getString($startcol + 2);

			$this->created_at = $rs->getTimestamp($startcol + 3, null);

			$this->updated_at = $rs->getTimestamp($startcol + 4, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating UserSiteOption object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UserSiteOptionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			UserSiteOptionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(UserSiteOptionPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(UserSiteOptionPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UserSiteOptionPeer::DATABASE_NAME);
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

			if ($this->aVirtualTable !== null) {
				if ($this->aVirtualTable->isModified() || $this->aVirtualTable->getCurrentVirtualTableI18n()->isModified()) {
					$affectedRows += $this->aVirtualTable->save($con);
				}
				$this->setVirtualTable($this->aVirtualTable);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = UserSiteOptionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += UserSiteOptionPeer::doUpdate($this, $con);
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

			if ($this->aVirtualTable !== null) {
				if (!$this->aVirtualTable->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aVirtualTable->getValidationFailures());
				}
			}


			if (($retval = UserSiteOptionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UserSiteOptionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getPeopleId();
				break;
			case 1:
				return $this->getUserSiteOptionId();
				break;
			case 2:
				return $this->getOptionValue();
				break;
			case 3:
				return $this->getCreatedAt();
				break;
			case 4:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UserSiteOptionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getPeopleId(),
			$keys[1]=>$this->getUserSiteOptionId(),
			$keys[2]=>$this->getOptionValue(),
			$keys[3]=>$this->getCreatedAt(),
			$keys[4]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UserSiteOptionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setPeopleId($value);
				break;
			case 1:
				$this->setUserSiteOptionId($value);
				break;
			case 2:
				$this->setOptionValue($value);
				break;
			case 3:
				$this->setCreatedAt($value);
				break;
			case 4:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UserSiteOptionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setPeopleId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserSiteOptionId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setOptionValue($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCreatedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUpdatedAt($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(UserSiteOptionPeer::DATABASE_NAME);

		if ($this->isColumnModified(UserSiteOptionPeer::PEOPLE_ID)) $criteria->add(UserSiteOptionPeer::PEOPLE_ID, $this->people_id);
		if ($this->isColumnModified(UserSiteOptionPeer::USER_SITE_OPTION_ID)) $criteria->add(UserSiteOptionPeer::USER_SITE_OPTION_ID, $this->user_site_option_id);
		if ($this->isColumnModified(UserSiteOptionPeer::OPTION_VALUE)) $criteria->add(UserSiteOptionPeer::OPTION_VALUE, $this->option_value);
		if ($this->isColumnModified(UserSiteOptionPeer::CREATED_AT)) $criteria->add(UserSiteOptionPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(UserSiteOptionPeer::UPDATED_AT)) $criteria->add(UserSiteOptionPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(UserSiteOptionPeer::DATABASE_NAME);

		$criteria->add(UserSiteOptionPeer::PEOPLE_ID, $this->people_id);
		$criteria->add(UserSiteOptionPeer::USER_SITE_OPTION_ID, $this->user_site_option_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getPeopleId();

		$pks[1] = $this->getUserSiteOptionId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setPeopleId($keys[0]);

		$this->setUserSiteOptionId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setOptionValue($this->option_value);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setPeopleId(NULL); 
		$copyObj->setUserSiteOptionId(NULL); 
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
			self::$peer = new UserSiteOptionPeer();
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

	
	public function setVirtualTable($v)
	{


		if ($v === null) {
			$this->setUserSiteOptionId(NULL);
		} else {
			$this->setUserSiteOptionId($v->getId());
		}


		$this->aVirtualTable = $v;
	}


	
	public function getVirtualTable($con = null)
	{
		if ($this->aVirtualTable === null && ($this->user_site_option_id !== null)) {
						include_once 'lib/model/om/BaseVirtualTablePeer.php';

			$this->aVirtualTable = VirtualTablePeer::retrieveByPK($this->user_site_option_id, $con);

			
		}
		return $this->aVirtualTable;
	}

} 