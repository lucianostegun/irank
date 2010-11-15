<?php


abstract class BasePeople extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $people_type_id;


	
	protected $first_name;


	
	protected $last_name;


	
	protected $full_name;


	
	protected $email_address;


	
	protected $birthday;


	
	protected $enabled;


	
	protected $visible;


	
	protected $deleted;


	
	protected $locked;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aVirtualTable;

	
	protected $collUserSiteList;

	
	protected $lastUserSiteCriteria = null;

	
	protected $collRankingMemberList;

	
	protected $lastRankingMemberCriteria = null;

	
	protected $collEventMemberList;

	
	protected $lastEventMemberCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getPeopleTypeId()
	{

		return $this->people_type_id;
	}

	
	public function getFirstName()
	{

		return $this->first_name;
	}

	
	public function getLastName()
	{

		return $this->last_name;
	}

	
	public function getFullName()
	{

		return $this->full_name;
	}

	
	public function getEmailAddress()
	{

		return $this->email_address;
	}

	
	public function getBirthday($format = 'Y-m-d')
	{

		if ($this->birthday === null || $this->birthday === '') {
			return null;
		} elseif (!is_int($this->birthday)) {
						$ts = strtotime($this->birthday);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [birthday] as date/time value: " . var_export($this->birthday, true));
			}
		} else {
			$ts = $this->birthday;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
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
			$this->modifiedColumns[] = PeoplePeer::ID;
		}

	} 
	
	public function setPeopleTypeId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->people_type_id !== $v) {
			$this->people_type_id = $v;
			$this->modifiedColumns[] = PeoplePeer::PEOPLE_TYPE_ID;
		}

		if ($this->aVirtualTable !== null && $this->aVirtualTable->getId() !== $v) {
			$this->aVirtualTable = null;
		}

	} 
	
	public function setFirstName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->first_name !== $v) {
			$this->first_name = $v;
			$this->modifiedColumns[] = PeoplePeer::FIRST_NAME;
		}

	} 
	
	public function setLastName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->last_name !== $v) {
			$this->last_name = $v;
			$this->modifiedColumns[] = PeoplePeer::LAST_NAME;
		}

	} 
	
	public function setFullName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->full_name !== $v) {
			$this->full_name = $v;
			$this->modifiedColumns[] = PeoplePeer::FULL_NAME;
		}

	} 
	
	public function setEmailAddress($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email_address !== $v) {
			$this->email_address = $v;
			$this->modifiedColumns[] = PeoplePeer::EMAIL_ADDRESS;
		}

	} 
	
	public function setBirthday($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [birthday] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->birthday !== $ts) {
			$this->birthday = $ts;
			$this->modifiedColumns[] = PeoplePeer::BIRTHDAY;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = PeoplePeer::ENABLED;
		}

	} 
	
	public function setVisible($v)
	{

		if ($this->visible !== $v) {
			$this->visible = $v;
			$this->modifiedColumns[] = PeoplePeer::VISIBLE;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = PeoplePeer::DELETED;
		}

	} 
	
	public function setLocked($v)
	{

		if ($this->locked !== $v) {
			$this->locked = $v;
			$this->modifiedColumns[] = PeoplePeer::LOCKED;
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
			$this->modifiedColumns[] = PeoplePeer::CREATED_AT;
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
			$this->modifiedColumns[] = PeoplePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->people_type_id = $rs->getInt($startcol + 1);

			$this->first_name = $rs->getString($startcol + 2);

			$this->last_name = $rs->getString($startcol + 3);

			$this->full_name = $rs->getString($startcol + 4);

			$this->email_address = $rs->getString($startcol + 5);

			$this->birthday = $rs->getDate($startcol + 6, null);

			$this->enabled = $rs->getBoolean($startcol + 7);

			$this->visible = $rs->getBoolean($startcol + 8);

			$this->deleted = $rs->getBoolean($startcol + 9);

			$this->locked = $rs->getBoolean($startcol + 10);

			$this->created_at = $rs->getTimestamp($startcol + 11, null);

			$this->updated_at = $rs->getTimestamp($startcol + 12, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 13; 
		} catch (Exception $e) {
			throw new PropelException("Error populating People object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PeoplePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PeoplePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(PeoplePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(PeoplePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PeoplePeer::DATABASE_NAME);
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


												
			if ($this->aVirtualTable !== null) {
				if ($this->aVirtualTable->isModified()) {
					$affectedRows += $this->aVirtualTable->save($con);
				}
				$this->setVirtualTable($this->aVirtualTable);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PeoplePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PeoplePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collUserSiteList !== null) {
				foreach($this->collUserSiteList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRankingMemberList !== null) {
				foreach($this->collRankingMemberList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEventMemberList !== null) {
				foreach($this->collEventMemberList as $referrerFK) {
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


												
			if ($this->aVirtualTable !== null) {
				if (!$this->aVirtualTable->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aVirtualTable->getValidationFailures());
				}
			}


			if (($retval = PeoplePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collUserSiteList !== null) {
					foreach($this->collUserSiteList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRankingMemberList !== null) {
					foreach($this->collRankingMemberList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEventMemberList !== null) {
					foreach($this->collEventMemberList as $referrerFK) {
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
		$pos = PeoplePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getPeopleTypeId();
				break;
			case 2:
				return $this->getFirstName();
				break;
			case 3:
				return $this->getLastName();
				break;
			case 4:
				return $this->getFullName();
				break;
			case 5:
				return $this->getEmailAddress();
				break;
			case 6:
				return $this->getBirthday();
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
				return $this->getCreatedAt();
				break;
			case 12:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PeoplePeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getPeopleTypeId(),
			$keys[2]=>$this->getFirstName(),
			$keys[3]=>$this->getLastName(),
			$keys[4]=>$this->getFullName(),
			$keys[5]=>$this->getEmailAddress(),
			$keys[6]=>$this->getBirthday(),
			$keys[7]=>$this->getEnabled(),
			$keys[8]=>$this->getVisible(),
			$keys[9]=>$this->getDeleted(),
			$keys[10]=>$this->getLocked(),
			$keys[11]=>$this->getCreatedAt(),
			$keys[12]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PeoplePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setPeopleTypeId($value);
				break;
			case 2:
				$this->setFirstName($value);
				break;
			case 3:
				$this->setLastName($value);
				break;
			case 4:
				$this->setFullName($value);
				break;
			case 5:
				$this->setEmailAddress($value);
				break;
			case 6:
				$this->setBirthday($value);
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
				$this->setCreatedAt($value);
				break;
			case 12:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PeoplePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPeopleTypeId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFirstName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setLastName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFullName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setEmailAddress($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setBirthday($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setEnabled($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setVisible($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setDeleted($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setLocked($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCreatedAt($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setUpdatedAt($arr[$keys[12]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PeoplePeer::DATABASE_NAME);

		if ($this->isColumnModified(PeoplePeer::ID)) $criteria->add(PeoplePeer::ID, $this->id);
		if ($this->isColumnModified(PeoplePeer::PEOPLE_TYPE_ID)) $criteria->add(PeoplePeer::PEOPLE_TYPE_ID, $this->people_type_id);
		if ($this->isColumnModified(PeoplePeer::FIRST_NAME)) $criteria->add(PeoplePeer::FIRST_NAME, $this->first_name);
		if ($this->isColumnModified(PeoplePeer::LAST_NAME)) $criteria->add(PeoplePeer::LAST_NAME, $this->last_name);
		if ($this->isColumnModified(PeoplePeer::FULL_NAME)) $criteria->add(PeoplePeer::FULL_NAME, $this->full_name);
		if ($this->isColumnModified(PeoplePeer::EMAIL_ADDRESS)) $criteria->add(PeoplePeer::EMAIL_ADDRESS, $this->email_address);
		if ($this->isColumnModified(PeoplePeer::BIRTHDAY)) $criteria->add(PeoplePeer::BIRTHDAY, $this->birthday);
		if ($this->isColumnModified(PeoplePeer::ENABLED)) $criteria->add(PeoplePeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(PeoplePeer::VISIBLE)) $criteria->add(PeoplePeer::VISIBLE, $this->visible);
		if ($this->isColumnModified(PeoplePeer::DELETED)) $criteria->add(PeoplePeer::DELETED, $this->deleted);
		if ($this->isColumnModified(PeoplePeer::LOCKED)) $criteria->add(PeoplePeer::LOCKED, $this->locked);
		if ($this->isColumnModified(PeoplePeer::CREATED_AT)) $criteria->add(PeoplePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(PeoplePeer::UPDATED_AT)) $criteria->add(PeoplePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PeoplePeer::DATABASE_NAME);

		$criteria->add(PeoplePeer::ID, $this->id);

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

		$copyObj->setPeopleTypeId($this->people_type_id);

		$copyObj->setFirstName($this->first_name);

		$copyObj->setLastName($this->last_name);

		$copyObj->setFullName($this->full_name);

		$copyObj->setEmailAddress($this->email_address);

		$copyObj->setBirthday($this->birthday);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setVisible($this->visible);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setLocked($this->locked);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getUserSiteList() as $relObj) {
				$copyObj->addUserSite($relObj->copy($deepCopy));
			}

			foreach($this->getRankingMemberList() as $relObj) {
				$copyObj->addRankingMember($relObj->copy($deepCopy));
			}

			foreach($this->getEventMemberList() as $relObj) {
				$copyObj->addEventMember($relObj->copy($deepCopy));
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
			self::$peer = new PeoplePeer();
		}
		return self::$peer;
	}

	
	public function setVirtualTable($v)
	{


		if ($v === null) {
			$this->setPeopleTypeId(NULL);
		} else {
			$this->setPeopleTypeId($v->getId());
		}


		$this->aVirtualTable = $v;
	}


	
	public function getVirtualTable($con = null)
	{
		if ($this->aVirtualTable === null && ($this->people_type_id !== null)) {
						include_once 'lib/model/om/BaseVirtualTablePeer.php';

			$this->aVirtualTable = VirtualTablePeer::retrieveByPK($this->people_type_id, $con);

			
		}
		return $this->aVirtualTable;
	}

	
	public function initUserSiteList()
	{
		if ($this->collUserSiteList === null) {
			$this->collUserSiteList = array();
		}
	}

	
	public function getUserSiteList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUserSitePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserSiteList === null) {
			if ($this->isNew()) {
			   $this->collUserSiteList = array();
			} else {

				$criteria->add(UserSitePeer::PEOPLE_ID, $this->getId());

				UserSitePeer::addSelectColumns($criteria);
				$this->collUserSiteList = UserSitePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UserSitePeer::PEOPLE_ID, $this->getId());

				UserSitePeer::addSelectColumns($criteria);
				if (!isset($this->lastUserSiteCriteria) || !$this->lastUserSiteCriteria->equals($criteria)) {
					$this->collUserSiteList = UserSitePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUserSiteCriteria = $criteria;
		return $this->collUserSiteList;
	}

	
	public function countUserSiteList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseUserSitePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(UserSitePeer::PEOPLE_ID, $this->getId());

		return UserSitePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addUserSite(UserSite $l)
	{
		$this->collUserSiteList[] = $l;
		$l->setPeople($this);
	}

	
	public function initRankingMemberList()
	{
		if ($this->collRankingMemberList === null) {
			$this->collRankingMemberList = array();
		}
	}

	
	public function getRankingMemberList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRankingMemberPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRankingMemberList === null) {
			if ($this->isNew()) {
			   $this->collRankingMemberList = array();
			} else {

				$criteria->add(RankingMemberPeer::PEOPLE_ID, $this->getId());

				RankingMemberPeer::addSelectColumns($criteria);
				$this->collRankingMemberList = RankingMemberPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RankingMemberPeer::PEOPLE_ID, $this->getId());

				RankingMemberPeer::addSelectColumns($criteria);
				if (!isset($this->lastRankingMemberCriteria) || !$this->lastRankingMemberCriteria->equals($criteria)) {
					$this->collRankingMemberList = RankingMemberPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRankingMemberCriteria = $criteria;
		return $this->collRankingMemberList;
	}

	
	public function countRankingMemberList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRankingMemberPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RankingMemberPeer::PEOPLE_ID, $this->getId());

		return RankingMemberPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRankingMember(RankingMember $l)
	{
		$this->collRankingMemberList[] = $l;
		$l->setPeople($this);
	}


	
	public function getRankingMemberListJoinRanking($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRankingMemberPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRankingMemberList === null) {
			if ($this->isNew()) {
				$this->collRankingMemberList = array();
			} else {

				$criteria->add(RankingMemberPeer::PEOPLE_ID, $this->getId());

				$this->collRankingMemberList = RankingMemberPeer::doSelectJoinRanking($criteria, $con);
			}
		} else {
									
			$criteria->add(RankingMemberPeer::PEOPLE_ID, $this->getId());

			if (!isset($this->lastRankingMemberCriteria) || !$this->lastRankingMemberCriteria->equals($criteria)) {
				$this->collRankingMemberList = RankingMemberPeer::doSelectJoinRanking($criteria, $con);
			}
		}
		$this->lastRankingMemberCriteria = $criteria;

		return $this->collRankingMemberList;
	}

	
	public function initEventMemberList()
	{
		if ($this->collEventMemberList === null) {
			$this->collEventMemberList = array();
		}
	}

	
	public function getEventMemberList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventMemberPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventMemberList === null) {
			if ($this->isNew()) {
			   $this->collEventMemberList = array();
			} else {

				$criteria->add(EventMemberPeer::PEOPLE_ID, $this->getId());

				EventMemberPeer::addSelectColumns($criteria);
				$this->collEventMemberList = EventMemberPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventMemberPeer::PEOPLE_ID, $this->getId());

				EventMemberPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventMemberCriteria) || !$this->lastEventMemberCriteria->equals($criteria)) {
					$this->collEventMemberList = EventMemberPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventMemberCriteria = $criteria;
		return $this->collEventMemberList;
	}

	
	public function countEventMemberList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventMemberPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventMemberPeer::PEOPLE_ID, $this->getId());

		return EventMemberPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventMember(EventMember $l)
	{
		$this->collEventMemberList[] = $l;
		$l->setPeople($this);
	}


	
	public function getEventMemberListJoinEvent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventMemberPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventMemberList === null) {
			if ($this->isNew()) {
				$this->collEventMemberList = array();
			} else {

				$criteria->add(EventMemberPeer::PEOPLE_ID, $this->getId());

				$this->collEventMemberList = EventMemberPeer::doSelectJoinEvent($criteria, $con);
			}
		} else {
									
			$criteria->add(EventMemberPeer::PEOPLE_ID, $this->getId());

			if (!isset($this->lastEventMemberCriteria) || !$this->lastEventMemberCriteria->equals($criteria)) {
				$this->collEventMemberList = EventMemberPeer::doSelectJoinEvent($criteria, $con);
			}
		}
		$this->lastEventMemberCriteria = $criteria;

		return $this->collEventMemberList;
	}

} 