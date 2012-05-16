<?php


abstract class BaseSettings extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $tag_name;


	
	protected $settings_name;


	
	protected $description;


	
	protected $default_value;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collClubSettingsList;

	
	protected $lastClubSettingsCriteria = null;

	
	protected $collUserAdminSettingsList;

	
	protected $lastUserAdminSettingsCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getTagName()
	{

		return $this->tag_name;
	}

	
	public function getSettingsName()
	{

		return $this->settings_name;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getDefaultValue()
	{

		return $this->default_value;
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
			$this->modifiedColumns[] = SettingsPeer::ID;
		}

	} 
	
	public function setTagName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tag_name !== $v) {
			$this->tag_name = $v;
			$this->modifiedColumns[] = SettingsPeer::TAG_NAME;
		}

	} 
	
	public function setSettingsName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->settings_name !== $v) {
			$this->settings_name = $v;
			$this->modifiedColumns[] = SettingsPeer::SETTINGS_NAME;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = SettingsPeer::DESCRIPTION;
		}

	} 
	
	public function setDefaultValue($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->default_value !== $v) {
			$this->default_value = $v;
			$this->modifiedColumns[] = SettingsPeer::DEFAULT_VALUE;
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
			$this->modifiedColumns[] = SettingsPeer::CREATED_AT;
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
			$this->modifiedColumns[] = SettingsPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->tag_name = $rs->getString($startcol + 1);

			$this->settings_name = $rs->getString($startcol + 2);

			$this->description = $rs->getString($startcol + 3);

			$this->default_value = $rs->getString($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->updated_at = $rs->getTimestamp($startcol + 6, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Settings object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SettingsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SettingsPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(SettingsPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(SettingsPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SettingsPeer::DATABASE_NAME);
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
					$pk = SettingsPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SettingsPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collClubSettingsList !== null) {
				foreach($this->collClubSettingsList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collUserAdminSettingsList !== null) {
				foreach($this->collUserAdminSettingsList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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


			if (($retval = SettingsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collClubSettingsList !== null) {
					foreach($this->collClubSettingsList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUserAdminSettingsList !== null) {
					foreach($this->collUserAdminSettingsList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SettingsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTagName();
				break;
			case 2:
				return $this->getSettingsName();
				break;
			case 3:
				return $this->getDescription();
				break;
			case 4:
				return $this->getDefaultValue();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SettingsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getTagName(),
			$keys[2]=>$this->getSettingsName(),
			$keys[3]=>$this->getDescription(),
			$keys[4]=>$this->getDefaultValue(),
			$keys[5]=>$this->getCreatedAt(),
			$keys[6]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SettingsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTagName($value);
				break;
			case 2:
				$this->setSettingsName($value);
				break;
			case 3:
				$this->setDescription($value);
				break;
			case 4:
				$this->setDefaultValue($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SettingsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTagName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSettingsName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDescription($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDefaultValue($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SettingsPeer::DATABASE_NAME);

		if ($this->isColumnModified(SettingsPeer::ID)) $criteria->add(SettingsPeer::ID, $this->id);
		if ($this->isColumnModified(SettingsPeer::TAG_NAME)) $criteria->add(SettingsPeer::TAG_NAME, $this->tag_name);
		if ($this->isColumnModified(SettingsPeer::SETTINGS_NAME)) $criteria->add(SettingsPeer::SETTINGS_NAME, $this->settings_name);
		if ($this->isColumnModified(SettingsPeer::DESCRIPTION)) $criteria->add(SettingsPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(SettingsPeer::DEFAULT_VALUE)) $criteria->add(SettingsPeer::DEFAULT_VALUE, $this->default_value);
		if ($this->isColumnModified(SettingsPeer::CREATED_AT)) $criteria->add(SettingsPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(SettingsPeer::UPDATED_AT)) $criteria->add(SettingsPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SettingsPeer::DATABASE_NAME);

		$criteria->add(SettingsPeer::ID, $this->id);

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

		$copyObj->setTagName($this->tag_name);

		$copyObj->setSettingsName($this->settings_name);

		$copyObj->setDescription($this->description);

		$copyObj->setDefaultValue($this->default_value);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getClubSettingsList() as $relObj) {
				$copyObj->addClubSettings($relObj->copy($deepCopy));
			}

			foreach($this->getUserAdminSettingsList() as $relObj) {
				$copyObj->addUserAdminSettings($relObj->copy($deepCopy));
			}

		} 

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
			self::$peer = new SettingsPeer();
		}
		return self::$peer;
	}

	
	public function initClubSettingsList()
	{
		if ($this->collClubSettingsList === null) {
			$this->collClubSettingsList = array();
		}
	}

	
	public function getClubSettingsList($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseClubSettingsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClubSettingsList === null) {
			if ($this->isNew()) {
			   $this->collClubSettingsList = array();
			} else {

				$criteria->add(ClubSettingsPeer::SETTINGS_ID, $this->getId());

				ClubSettingsPeer::addSelectColumns($criteria);
				$this->collClubSettingsList = ClubSettingsPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ClubSettingsPeer::SETTINGS_ID, $this->getId());

				ClubSettingsPeer::addSelectColumns($criteria);
				if (!isset($this->lastClubSettingsCriteria) || !$this->lastClubSettingsCriteria->equals($criteria)) {
					$this->collClubSettingsList = ClubSettingsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastClubSettingsCriteria = $criteria;
		return $this->collClubSettingsList;
	}

	
	public function countClubSettingsList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseClubSettingsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ClubSettingsPeer::SETTINGS_ID, $this->getId());

		return ClubSettingsPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addClubSettings(ClubSettings $l)
	{
		$this->collClubSettingsList[] = $l;
		$l->setSettings($this);
	}


	
	public function getClubSettingsListJoinClub($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseClubSettingsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClubSettingsList === null) {
			if ($this->isNew()) {
				$this->collClubSettingsList = array();
			} else {

				$criteria->add(ClubSettingsPeer::SETTINGS_ID, $this->getId());

				$this->collClubSettingsList = ClubSettingsPeer::doSelectJoinClub($criteria, $con);
			}
		} else {
									
			$criteria->add(ClubSettingsPeer::SETTINGS_ID, $this->getId());

			if (!isset($this->lastClubSettingsCriteria) || !$this->lastClubSettingsCriteria->equals($criteria)) {
				$this->collClubSettingsList = ClubSettingsPeer::doSelectJoinClub($criteria, $con);
			}
		}
		$this->lastClubSettingsCriteria = $criteria;

		return $this->collClubSettingsList;
	}

	
	public function initUserAdminSettingsList()
	{
		if ($this->collUserAdminSettingsList === null) {
			$this->collUserAdminSettingsList = array();
		}
	}

	
	public function getUserAdminSettingsList($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseUserAdminSettingsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserAdminSettingsList === null) {
			if ($this->isNew()) {
			   $this->collUserAdminSettingsList = array();
			} else {

				$criteria->add(UserAdminSettingsPeer::SETTINGS_ID, $this->getId());

				UserAdminSettingsPeer::addSelectColumns($criteria);
				$this->collUserAdminSettingsList = UserAdminSettingsPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UserAdminSettingsPeer::SETTINGS_ID, $this->getId());

				UserAdminSettingsPeer::addSelectColumns($criteria);
				if (!isset($this->lastUserAdminSettingsCriteria) || !$this->lastUserAdminSettingsCriteria->equals($criteria)) {
					$this->collUserAdminSettingsList = UserAdminSettingsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUserAdminSettingsCriteria = $criteria;
		return $this->collUserAdminSettingsList;
	}

	
	public function countUserAdminSettingsList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseUserAdminSettingsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(UserAdminSettingsPeer::SETTINGS_ID, $this->getId());

		return UserAdminSettingsPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addUserAdminSettings(UserAdminSettings $l)
	{
		$this->collUserAdminSettingsList[] = $l;
		$l->setSettings($this);
	}


	
	public function getUserAdminSettingsListJoinUserAdmin($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseUserAdminSettingsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserAdminSettingsList === null) {
			if ($this->isNew()) {
				$this->collUserAdminSettingsList = array();
			} else {

				$criteria->add(UserAdminSettingsPeer::SETTINGS_ID, $this->getId());

				$this->collUserAdminSettingsList = UserAdminSettingsPeer::doSelectJoinUserAdmin($criteria, $con);
			}
		} else {
									
			$criteria->add(UserAdminSettingsPeer::SETTINGS_ID, $this->getId());

			if (!isset($this->lastUserAdminSettingsCriteria) || !$this->lastUserAdminSettingsCriteria->equals($criteria)) {
				$this->collUserAdminSettingsList = UserAdminSettingsPeer::doSelectJoinUserAdmin($criteria, $con);
			}
		}
		$this->lastUserAdminSettingsCriteria = $criteria;

		return $this->collUserAdminSettingsList;
	}

} 