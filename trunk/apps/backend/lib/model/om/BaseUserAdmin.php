<?php


abstract class BaseUserAdmin extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $people_id;


	
	protected $club_id;


	
	protected $username;


	
	protected $password;


	
	protected $active;


	
	protected $master;


	
	protected $enabled;


	
	protected $visible;


	
	protected $deleted;


	
	protected $locked;


	
	protected $last_access_date;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aPeople;

	
	protected $aClub;

	
	protected $collAccessAdminLogList;

	
	protected $lastAccessAdminLogCriteria = null;

	
	protected $collUserAdminSettingsList;

	
	protected $lastUserAdminSettingsCriteria = null;

	
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

	
	public function getClubId()
	{

		return $this->club_id;
	}

	
	public function getUsername()
	{

		return $this->username;
	}

	
	public function getPassword()
	{

		return $this->password;
	}

	
	public function getActive()
	{

		return $this->active;
	}

	
	public function getMaster()
	{

		return $this->master;
	}

	
	public function getEnabled()
	{

		return $this->enabled;
	}

	
	public function getVisible()
	{

		return $this->visible;
	}

	
	public function getDeleted()
	{

		return $this->deleted;
	}

	
	public function getLocked()
	{

		return $this->locked;
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
			$this->modifiedColumns[] = UserAdminPeer::ID;
		}

	} 
	
	public function setPeopleId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->people_id !== $v) {
			$this->people_id = $v;
			$this->modifiedColumns[] = UserAdminPeer::PEOPLE_ID;
		}

		if ($this->aPeople !== null && $this->aPeople->getId() !== $v) {
			$this->aPeople = null;
		}

	} 
	
	public function setClubId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->club_id !== $v) {
			$this->club_id = $v;
			$this->modifiedColumns[] = UserAdminPeer::CLUB_ID;
		}

		if ($this->aClub !== null && $this->aClub->getId() !== $v) {
			$this->aClub = null;
		}

	} 
	
	public function setUsername($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->username !== $v) {
			$this->username = $v;
			$this->modifiedColumns[] = UserAdminPeer::USERNAME;
		}

	} 
	
	public function setPassword($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->password !== $v) {
			$this->password = $v;
			$this->modifiedColumns[] = UserAdminPeer::PASSWORD;
		}

	} 
	
	public function setActive($v)
	{

		if ($this->active !== $v) {
			$this->active = $v;
			$this->modifiedColumns[] = UserAdminPeer::ACTIVE;
		}

	} 
	
	public function setMaster($v)
	{

		if ($this->master !== $v) {
			$this->master = $v;
			$this->modifiedColumns[] = UserAdminPeer::MASTER;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = UserAdminPeer::ENABLED;
		}

	} 
	
	public function setVisible($v)
	{

		if ($this->visible !== $v) {
			$this->visible = $v;
			$this->modifiedColumns[] = UserAdminPeer::VISIBLE;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = UserAdminPeer::DELETED;
		}

	} 
	
	public function setLocked($v)
	{

		if ($this->locked !== $v) {
			$this->locked = $v;
			$this->modifiedColumns[] = UserAdminPeer::LOCKED;
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
			$this->modifiedColumns[] = UserAdminPeer::LAST_ACCESS_DATE;
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
			$this->modifiedColumns[] = UserAdminPeer::CREATED_AT;
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
			$this->modifiedColumns[] = UserAdminPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->people_id = $rs->getInt($startcol + 1);

			$this->club_id = $rs->getInt($startcol + 2);

			$this->username = $rs->getString($startcol + 3);

			$this->password = $rs->getString($startcol + 4);

			$this->active = $rs->getBoolean($startcol + 5);

			$this->master = $rs->getBoolean($startcol + 6);

			$this->enabled = $rs->getBoolean($startcol + 7);

			$this->visible = $rs->getBoolean($startcol + 8);

			$this->deleted = $rs->getBoolean($startcol + 9);

			$this->locked = $rs->getBoolean($startcol + 10);

			$this->last_access_date = $rs->getTimestamp($startcol + 11, null);

			$this->created_at = $rs->getTimestamp($startcol + 12, null);

			$this->updated_at = $rs->getTimestamp($startcol + 13, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 14; 
		} catch (Exception $e) {
			throw new PropelException("Error populating UserAdmin object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UserAdminPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			UserAdminPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(UserAdminPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(UserAdminPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UserAdminPeer::DATABASE_NAME);
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

			if ($this->aClub !== null) {
				if ($this->aClub->isModified()) {
					$affectedRows += $this->aClub->save($con);
				}
				$this->setClub($this->aClub);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = UserAdminPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += UserAdminPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collAccessAdminLogList !== null) {
				foreach($this->collAccessAdminLogList as $referrerFK) {
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


												
			if ($this->aPeople !== null) {
				if (!$this->aPeople->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPeople->getValidationFailures());
				}
			}

			if ($this->aClub !== null) {
				if (!$this->aClub->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aClub->getValidationFailures());
				}
			}


			if (($retval = UserAdminPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collAccessAdminLogList !== null) {
					foreach($this->collAccessAdminLogList as $referrerFK) {
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
		$pos = UserAdminPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getClubId();
				break;
			case 3:
				return $this->getUsername();
				break;
			case 4:
				return $this->getPassword();
				break;
			case 5:
				return $this->getActive();
				break;
			case 6:
				return $this->getMaster();
				break;
			case 7:
				return $this->getEnabled();
				break;
			case 8:
				return $this->getVisible();
				break;
			case 9:
				return $this->getDeleted();
				break;
			case 10:
				return $this->getLocked();
				break;
			case 11:
				return $this->getLastAccessDate();
				break;
			case 12:
				return $this->getCreatedAt();
				break;
			case 13:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UserAdminPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getPeopleId(),
			$keys[2]=>$this->getClubId(),
			$keys[3]=>$this->getUsername(),
			$keys[4]=>$this->getPassword(),
			$keys[5]=>$this->getActive(),
			$keys[6]=>$this->getMaster(),
			$keys[7]=>$this->getEnabled(),
			$keys[8]=>$this->getVisible(),
			$keys[9]=>$this->getDeleted(),
			$keys[10]=>$this->getLocked(),
			$keys[11]=>$this->getLastAccessDate(),
			$keys[12]=>$this->getCreatedAt(),
			$keys[13]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UserAdminPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setClubId($value);
				break;
			case 3:
				$this->setUsername($value);
				break;
			case 4:
				$this->setPassword($value);
				break;
			case 5:
				$this->setActive($value);
				break;
			case 6:
				$this->setMaster($value);
				break;
			case 7:
				$this->setEnabled($value);
				break;
			case 8:
				$this->setVisible($value);
				break;
			case 9:
				$this->setDeleted($value);
				break;
			case 10:
				$this->setLocked($value);
				break;
			case 11:
				$this->setLastAccessDate($value);
				break;
			case 12:
				$this->setCreatedAt($value);
				break;
			case 13:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UserAdminPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPeopleId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setClubId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUsername($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPassword($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setActive($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setMaster($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setEnabled($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setVisible($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setDeleted($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setLocked($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setLastAccessDate($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCreatedAt($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setUpdatedAt($arr[$keys[13]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(UserAdminPeer::DATABASE_NAME);

		if ($this->isColumnModified(UserAdminPeer::ID)) $criteria->add(UserAdminPeer::ID, $this->id);
		if ($this->isColumnModified(UserAdminPeer::PEOPLE_ID)) $criteria->add(UserAdminPeer::PEOPLE_ID, $this->people_id);
		if ($this->isColumnModified(UserAdminPeer::CLUB_ID)) $criteria->add(UserAdminPeer::CLUB_ID, $this->club_id);
		if ($this->isColumnModified(UserAdminPeer::USERNAME)) $criteria->add(UserAdminPeer::USERNAME, $this->username);
		if ($this->isColumnModified(UserAdminPeer::PASSWORD)) $criteria->add(UserAdminPeer::PASSWORD, $this->password);
		if ($this->isColumnModified(UserAdminPeer::ACTIVE)) $criteria->add(UserAdminPeer::ACTIVE, $this->active);
		if ($this->isColumnModified(UserAdminPeer::MASTER)) $criteria->add(UserAdminPeer::MASTER, $this->master);
		if ($this->isColumnModified(UserAdminPeer::ENABLED)) $criteria->add(UserAdminPeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(UserAdminPeer::VISIBLE)) $criteria->add(UserAdminPeer::VISIBLE, $this->visible);
		if ($this->isColumnModified(UserAdminPeer::DELETED)) $criteria->add(UserAdminPeer::DELETED, $this->deleted);
		if ($this->isColumnModified(UserAdminPeer::LOCKED)) $criteria->add(UserAdminPeer::LOCKED, $this->locked);
		if ($this->isColumnModified(UserAdminPeer::LAST_ACCESS_DATE)) $criteria->add(UserAdminPeer::LAST_ACCESS_DATE, $this->last_access_date);
		if ($this->isColumnModified(UserAdminPeer::CREATED_AT)) $criteria->add(UserAdminPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(UserAdminPeer::UPDATED_AT)) $criteria->add(UserAdminPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(UserAdminPeer::DATABASE_NAME);

		$criteria->add(UserAdminPeer::ID, $this->id);

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

		$copyObj->setClubId($this->club_id);

		$copyObj->setUsername($this->username);

		$copyObj->setPassword($this->password);

		$copyObj->setActive($this->active);

		$copyObj->setMaster($this->master);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setVisible($this->visible);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setLocked($this->locked);

		$copyObj->setLastAccessDate($this->last_access_date);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getAccessAdminLogList() as $relObj) {
				$copyObj->addAccessAdminLog($relObj->copy($deepCopy));
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
			self::$peer = new UserAdminPeer();
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

	
	public function setClub($v)
	{


		if ($v === null) {
			$this->setClubId(NULL);
		} else {
			$this->setClubId($v->getId());
		}


		$this->aClub = $v;
	}


	
	public function getClub($con = null)
	{
		if ($this->aClub === null && ($this->club_id !== null)) {
						include_once 'lib/model/om/BaseClubPeer.php';

			$this->aClub = ClubPeer::retrieveByPK($this->club_id, $con);

			
		}
		return $this->aClub;
	}

	
	public function initAccessAdminLogList()
	{
		if ($this->collAccessAdminLogList === null) {
			$this->collAccessAdminLogList = array();
		}
	}

	
	public function getAccessAdminLogList($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseAccessAdminLogPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAccessAdminLogList === null) {
			if ($this->isNew()) {
			   $this->collAccessAdminLogList = array();
			} else {

				$criteria->add(AccessAdminLogPeer::USER_ADMIN_ID, $this->getId());

				AccessAdminLogPeer::addSelectColumns($criteria);
				$this->collAccessAdminLogList = AccessAdminLogPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AccessAdminLogPeer::USER_ADMIN_ID, $this->getId());

				AccessAdminLogPeer::addSelectColumns($criteria);
				if (!isset($this->lastAccessAdminLogCriteria) || !$this->lastAccessAdminLogCriteria->equals($criteria)) {
					$this->collAccessAdminLogList = AccessAdminLogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAccessAdminLogCriteria = $criteria;
		return $this->collAccessAdminLogList;
	}

	
	public function countAccessAdminLogList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseAccessAdminLogPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(AccessAdminLogPeer::USER_ADMIN_ID, $this->getId());

		return AccessAdminLogPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addAccessAdminLog(AccessAdminLog $l)
	{
		$this->collAccessAdminLogList[] = $l;
		$l->setUserAdmin($this);
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

				$criteria->add(UserAdminSettingsPeer::USER_ADMIN_ID, $this->getId());

				UserAdminSettingsPeer::addSelectColumns($criteria);
				$this->collUserAdminSettingsList = UserAdminSettingsPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UserAdminSettingsPeer::USER_ADMIN_ID, $this->getId());

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

		$criteria->add(UserAdminSettingsPeer::USER_ADMIN_ID, $this->getId());

		return UserAdminSettingsPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addUserAdminSettings(UserAdminSettings $l)
	{
		$this->collUserAdminSettingsList[] = $l;
		$l->setUserAdmin($this);
	}


	
	public function getUserAdminSettingsListJoinSettings($criteria = null, $con = null)
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

				$criteria->add(UserAdminSettingsPeer::USER_ADMIN_ID, $this->getId());

				$this->collUserAdminSettingsList = UserAdminSettingsPeer::doSelectJoinSettings($criteria, $con);
			}
		} else {
									
			$criteria->add(UserAdminSettingsPeer::USER_ADMIN_ID, $this->getId());

			if (!isset($this->lastUserAdminSettingsCriteria) || !$this->lastUserAdminSettingsCriteria->equals($criteria)) {
				$this->collUserAdminSettingsList = UserAdminSettingsPeer::doSelectJoinSettings($criteria, $con);
			}
		}
		$this->lastUserAdminSettingsCriteria = $criteria;

		return $this->collUserAdminSettingsList;
	}

} 