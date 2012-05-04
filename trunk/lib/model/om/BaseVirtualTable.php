<?php


abstract class BaseVirtualTable extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $virtual_table_name;


	
	protected $description;


	
	protected $tag_name;


	
	protected $enabled;


	
	protected $visible;


	
	protected $deleted;


	
	protected $locked;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collVirtualTableI18nList;

	
	protected $lastVirtualTableI18nCriteria = null;

	
	protected $collPeopleList;

	
	protected $lastPeopleCriteria = null;

	
	protected $collRankingListRelatedByRankingTypeId;

	
	protected $lastRankingRelatedByRankingTypeIdCriteria = null;

	
	protected $collRankingListRelatedByGameStyleId;

	
	protected $lastRankingRelatedByGameStyleIdCriteria = null;

	
	protected $collUserSiteOptionList;

	
	protected $lastUserSiteOptionCriteria = null;

	
	protected $collEventPersonalList;

	
	protected $lastEventPersonalCriteria = null;

	
	protected $collRankingLiveListRelatedByRankingTypeId;

	
	protected $lastRankingLiveRelatedByRankingTypeIdCriteria = null;

	
	protected $collRankingLiveListRelatedByGameStyleId;

	
	protected $lastRankingLiveRelatedByGameStyleIdCriteria = null;

	
	protected $collRankingLiveListRelatedByGameTypeId;

	
	protected $lastRankingLiveRelatedByGameTypeIdCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

  
  protected $culture;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getVirtualTableName()
	{

		return $this->virtual_table_name;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getTagName()
	{

		return $this->tag_name;
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
			$this->modifiedColumns[] = VirtualTablePeer::ID;
		}

	} 
	
	public function setVirtualTableName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->virtual_table_name !== $v) {
			$this->virtual_table_name = $v;
			$this->modifiedColumns[] = VirtualTablePeer::VIRTUAL_TABLE_NAME;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = VirtualTablePeer::DESCRIPTION;
		}

	} 
	
	public function setTagName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tag_name !== $v) {
			$this->tag_name = $v;
			$this->modifiedColumns[] = VirtualTablePeer::TAG_NAME;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = VirtualTablePeer::ENABLED;
		}

	} 
	
	public function setVisible($v)
	{

		if ($this->visible !== $v) {
			$this->visible = $v;
			$this->modifiedColumns[] = VirtualTablePeer::VISIBLE;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = VirtualTablePeer::DELETED;
		}

	} 
	
	public function setLocked($v)
	{

		if ($this->locked !== $v) {
			$this->locked = $v;
			$this->modifiedColumns[] = VirtualTablePeer::LOCKED;
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
			$this->modifiedColumns[] = VirtualTablePeer::CREATED_AT;
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
			$this->modifiedColumns[] = VirtualTablePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->virtual_table_name = $rs->getString($startcol + 1);

			$this->description = $rs->getString($startcol + 2);

			$this->tag_name = $rs->getString($startcol + 3);

			$this->enabled = $rs->getBoolean($startcol + 4);

			$this->visible = $rs->getBoolean($startcol + 5);

			$this->deleted = $rs->getBoolean($startcol + 6);

			$this->locked = $rs->getBoolean($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->updated_at = $rs->getTimestamp($startcol + 9, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating VirtualTable object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(VirtualTablePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			VirtualTablePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(VirtualTablePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(VirtualTablePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(VirtualTablePeer::DATABASE_NAME);
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
					$pk = VirtualTablePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += VirtualTablePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collVirtualTableI18nList !== null) {
				foreach($this->collVirtualTableI18nList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPeopleList !== null) {
				foreach($this->collPeopleList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRankingListRelatedByRankingTypeId !== null) {
				foreach($this->collRankingListRelatedByRankingTypeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRankingListRelatedByGameStyleId !== null) {
				foreach($this->collRankingListRelatedByGameStyleId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collUserSiteOptionList !== null) {
				foreach($this->collUserSiteOptionList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEventPersonalList !== null) {
				foreach($this->collEventPersonalList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRankingLiveListRelatedByRankingTypeId !== null) {
				foreach($this->collRankingLiveListRelatedByRankingTypeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRankingLiveListRelatedByGameStyleId !== null) {
				foreach($this->collRankingLiveListRelatedByGameStyleId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRankingLiveListRelatedByGameTypeId !== null) {
				foreach($this->collRankingLiveListRelatedByGameTypeId as $referrerFK) {
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


			if (($retval = VirtualTablePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collVirtualTableI18nList !== null) {
					foreach($this->collVirtualTableI18nList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPeopleList !== null) {
					foreach($this->collPeopleList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRankingListRelatedByRankingTypeId !== null) {
					foreach($this->collRankingListRelatedByRankingTypeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRankingListRelatedByGameStyleId !== null) {
					foreach($this->collRankingListRelatedByGameStyleId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUserSiteOptionList !== null) {
					foreach($this->collUserSiteOptionList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEventPersonalList !== null) {
					foreach($this->collEventPersonalList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRankingLiveListRelatedByRankingTypeId !== null) {
					foreach($this->collRankingLiveListRelatedByRankingTypeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRankingLiveListRelatedByGameStyleId !== null) {
					foreach($this->collRankingLiveListRelatedByGameStyleId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRankingLiveListRelatedByGameTypeId !== null) {
					foreach($this->collRankingLiveListRelatedByGameTypeId as $referrerFK) {
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
		$pos = VirtualTablePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getVirtualTableName();
				break;
			case 2:
				return $this->getDescription();
				break;
			case 3:
				return $this->getTagName();
				break;
			case 4:
				return $this->getEnabled();
				break;
			case 5:
				return $this->getVisible();
				break;
			case 6:
				return $this->getDeleted();
				break;
			case 7:
				return $this->getLocked();
				break;
			case 8:
				return $this->getCreatedAt();
				break;
			case 9:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = VirtualTablePeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getVirtualTableName(),
			$keys[2]=>$this->getDescription(),
			$keys[3]=>$this->getTagName(),
			$keys[4]=>$this->getEnabled(),
			$keys[5]=>$this->getVisible(),
			$keys[6]=>$this->getDeleted(),
			$keys[7]=>$this->getLocked(),
			$keys[8]=>$this->getCreatedAt(),
			$keys[9]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = VirtualTablePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setVirtualTableName($value);
				break;
			case 2:
				$this->setDescription($value);
				break;
			case 3:
				$this->setTagName($value);
				break;
			case 4:
				$this->setEnabled($value);
				break;
			case 5:
				$this->setVisible($value);
				break;
			case 6:
				$this->setDeleted($value);
				break;
			case 7:
				$this->setLocked($value);
				break;
			case 8:
				$this->setCreatedAt($value);
				break;
			case 9:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = VirtualTablePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setVirtualTableName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTagName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEnabled($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setVisible($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDeleted($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setLocked($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(VirtualTablePeer::DATABASE_NAME);

		if ($this->isColumnModified(VirtualTablePeer::ID)) $criteria->add(VirtualTablePeer::ID, $this->id);
		if ($this->isColumnModified(VirtualTablePeer::VIRTUAL_TABLE_NAME)) $criteria->add(VirtualTablePeer::VIRTUAL_TABLE_NAME, $this->virtual_table_name);
		if ($this->isColumnModified(VirtualTablePeer::DESCRIPTION)) $criteria->add(VirtualTablePeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(VirtualTablePeer::TAG_NAME)) $criteria->add(VirtualTablePeer::TAG_NAME, $this->tag_name);
		if ($this->isColumnModified(VirtualTablePeer::ENABLED)) $criteria->add(VirtualTablePeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(VirtualTablePeer::VISIBLE)) $criteria->add(VirtualTablePeer::VISIBLE, $this->visible);
		if ($this->isColumnModified(VirtualTablePeer::DELETED)) $criteria->add(VirtualTablePeer::DELETED, $this->deleted);
		if ($this->isColumnModified(VirtualTablePeer::LOCKED)) $criteria->add(VirtualTablePeer::LOCKED, $this->locked);
		if ($this->isColumnModified(VirtualTablePeer::CREATED_AT)) $criteria->add(VirtualTablePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(VirtualTablePeer::UPDATED_AT)) $criteria->add(VirtualTablePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(VirtualTablePeer::DATABASE_NAME);

		$criteria->add(VirtualTablePeer::ID, $this->id);

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

		$copyObj->setVirtualTableName($this->virtual_table_name);

		$copyObj->setDescription($this->description);

		$copyObj->setTagName($this->tag_name);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setVisible($this->visible);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setLocked($this->locked);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getVirtualTableI18nList() as $relObj) {
				$copyObj->addVirtualTableI18n($relObj->copy($deepCopy));
			}

			foreach($this->getPeopleList() as $relObj) {
				$copyObj->addPeople($relObj->copy($deepCopy));
			}

			foreach($this->getRankingListRelatedByRankingTypeId() as $relObj) {
				$copyObj->addRankingRelatedByRankingTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getRankingListRelatedByGameStyleId() as $relObj) {
				$copyObj->addRankingRelatedByGameStyleId($relObj->copy($deepCopy));
			}

			foreach($this->getUserSiteOptionList() as $relObj) {
				$copyObj->addUserSiteOption($relObj->copy($deepCopy));
			}

			foreach($this->getEventPersonalList() as $relObj) {
				$copyObj->addEventPersonal($relObj->copy($deepCopy));
			}

			foreach($this->getRankingLiveListRelatedByRankingTypeId() as $relObj) {
				$copyObj->addRankingLiveRelatedByRankingTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getRankingLiveListRelatedByGameStyleId() as $relObj) {
				$copyObj->addRankingLiveRelatedByGameStyleId($relObj->copy($deepCopy));
			}

			foreach($this->getRankingLiveListRelatedByGameTypeId() as $relObj) {
				$copyObj->addRankingLiveRelatedByGameTypeId($relObj->copy($deepCopy));
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
			self::$peer = new VirtualTablePeer();
		}
		return self::$peer;
	}

	
	public function initVirtualTableI18nList()
	{
		if ($this->collVirtualTableI18nList === null) {
			$this->collVirtualTableI18nList = array();
		}
	}

	
	public function getVirtualTableI18nList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseVirtualTableI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVirtualTableI18nList === null) {
			if ($this->isNew()) {
			   $this->collVirtualTableI18nList = array();
			} else {

				$criteria->add(VirtualTableI18nPeer::VIRTUAL_TABLE_ID, $this->getId());

				VirtualTableI18nPeer::addSelectColumns($criteria);
				$this->collVirtualTableI18nList = VirtualTableI18nPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(VirtualTableI18nPeer::VIRTUAL_TABLE_ID, $this->getId());

				VirtualTableI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastVirtualTableI18nCriteria) || !$this->lastVirtualTableI18nCriteria->equals($criteria)) {
					$this->collVirtualTableI18nList = VirtualTableI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVirtualTableI18nCriteria = $criteria;
		return $this->collVirtualTableI18nList;
	}

	
	public function countVirtualTableI18nList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseVirtualTableI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(VirtualTableI18nPeer::VIRTUAL_TABLE_ID, $this->getId());

		return VirtualTableI18nPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addVirtualTableI18n(VirtualTableI18n $l)
	{
		$this->collVirtualTableI18nList[] = $l;
		$l->setVirtualTable($this);
	}

	
	public function initPeopleList()
	{
		if ($this->collPeopleList === null) {
			$this->collPeopleList = array();
		}
	}

	
	public function getPeopleList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePeoplePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPeopleList === null) {
			if ($this->isNew()) {
			   $this->collPeopleList = array();
			} else {

				$criteria->add(PeoplePeer::PEOPLE_TYPE_ID, $this->getId());

				PeoplePeer::addSelectColumns($criteria);
				$this->collPeopleList = PeoplePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PeoplePeer::PEOPLE_TYPE_ID, $this->getId());

				PeoplePeer::addSelectColumns($criteria);
				if (!isset($this->lastPeopleCriteria) || !$this->lastPeopleCriteria->equals($criteria)) {
					$this->collPeopleList = PeoplePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPeopleCriteria = $criteria;
		return $this->collPeopleList;
	}

	
	public function countPeopleList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePeoplePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PeoplePeer::PEOPLE_TYPE_ID, $this->getId());

		return PeoplePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPeople(People $l)
	{
		$this->collPeopleList[] = $l;
		$l->setVirtualTable($this);
	}

	
	public function initRankingListRelatedByRankingTypeId()
	{
		if ($this->collRankingListRelatedByRankingTypeId === null) {
			$this->collRankingListRelatedByRankingTypeId = array();
		}
	}

	
	public function getRankingListRelatedByRankingTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRankingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRankingListRelatedByRankingTypeId === null) {
			if ($this->isNew()) {
			   $this->collRankingListRelatedByRankingTypeId = array();
			} else {

				$criteria->add(RankingPeer::RANKING_TYPE_ID, $this->getId());

				RankingPeer::addSelectColumns($criteria);
				$this->collRankingListRelatedByRankingTypeId = RankingPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RankingPeer::RANKING_TYPE_ID, $this->getId());

				RankingPeer::addSelectColumns($criteria);
				if (!isset($this->lastRankingRelatedByRankingTypeIdCriteria) || !$this->lastRankingRelatedByRankingTypeIdCriteria->equals($criteria)) {
					$this->collRankingListRelatedByRankingTypeId = RankingPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRankingRelatedByRankingTypeIdCriteria = $criteria;
		return $this->collRankingListRelatedByRankingTypeId;
	}

	
	public function countRankingListRelatedByRankingTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRankingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RankingPeer::RANKING_TYPE_ID, $this->getId());

		return RankingPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRankingRelatedByRankingTypeId(Ranking $l)
	{
		$this->collRankingListRelatedByRankingTypeId[] = $l;
		$l->setVirtualTableRelatedByRankingTypeId($this);
	}


	
	public function getRankingListRelatedByRankingTypeIdJoinUserSite($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRankingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRankingListRelatedByRankingTypeId === null) {
			if ($this->isNew()) {
				$this->collRankingListRelatedByRankingTypeId = array();
			} else {

				$criteria->add(RankingPeer::RANKING_TYPE_ID, $this->getId());

				$this->collRankingListRelatedByRankingTypeId = RankingPeer::doSelectJoinUserSite($criteria, $con);
			}
		} else {
									
			$criteria->add(RankingPeer::RANKING_TYPE_ID, $this->getId());

			if (!isset($this->lastRankingRelatedByRankingTypeIdCriteria) || !$this->lastRankingRelatedByRankingTypeIdCriteria->equals($criteria)) {
				$this->collRankingListRelatedByRankingTypeId = RankingPeer::doSelectJoinUserSite($criteria, $con);
			}
		}
		$this->lastRankingRelatedByRankingTypeIdCriteria = $criteria;

		return $this->collRankingListRelatedByRankingTypeId;
	}

	
	public function initRankingListRelatedByGameStyleId()
	{
		if ($this->collRankingListRelatedByGameStyleId === null) {
			$this->collRankingListRelatedByGameStyleId = array();
		}
	}

	
	public function getRankingListRelatedByGameStyleId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRankingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRankingListRelatedByGameStyleId === null) {
			if ($this->isNew()) {
			   $this->collRankingListRelatedByGameStyleId = array();
			} else {

				$criteria->add(RankingPeer::GAME_STYLE_ID, $this->getId());

				RankingPeer::addSelectColumns($criteria);
				$this->collRankingListRelatedByGameStyleId = RankingPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RankingPeer::GAME_STYLE_ID, $this->getId());

				RankingPeer::addSelectColumns($criteria);
				if (!isset($this->lastRankingRelatedByGameStyleIdCriteria) || !$this->lastRankingRelatedByGameStyleIdCriteria->equals($criteria)) {
					$this->collRankingListRelatedByGameStyleId = RankingPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRankingRelatedByGameStyleIdCriteria = $criteria;
		return $this->collRankingListRelatedByGameStyleId;
	}

	
	public function countRankingListRelatedByGameStyleId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRankingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RankingPeer::GAME_STYLE_ID, $this->getId());

		return RankingPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRankingRelatedByGameStyleId(Ranking $l)
	{
		$this->collRankingListRelatedByGameStyleId[] = $l;
		$l->setVirtualTableRelatedByGameStyleId($this);
	}


	
	public function getRankingListRelatedByGameStyleIdJoinUserSite($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRankingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRankingListRelatedByGameStyleId === null) {
			if ($this->isNew()) {
				$this->collRankingListRelatedByGameStyleId = array();
			} else {

				$criteria->add(RankingPeer::GAME_STYLE_ID, $this->getId());

				$this->collRankingListRelatedByGameStyleId = RankingPeer::doSelectJoinUserSite($criteria, $con);
			}
		} else {
									
			$criteria->add(RankingPeer::GAME_STYLE_ID, $this->getId());

			if (!isset($this->lastRankingRelatedByGameStyleIdCriteria) || !$this->lastRankingRelatedByGameStyleIdCriteria->equals($criteria)) {
				$this->collRankingListRelatedByGameStyleId = RankingPeer::doSelectJoinUserSite($criteria, $con);
			}
		}
		$this->lastRankingRelatedByGameStyleIdCriteria = $criteria;

		return $this->collRankingListRelatedByGameStyleId;
	}

	
	public function initUserSiteOptionList()
	{
		if ($this->collUserSiteOptionList === null) {
			$this->collUserSiteOptionList = array();
		}
	}

	
	public function getUserSiteOptionList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUserSiteOptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserSiteOptionList === null) {
			if ($this->isNew()) {
			   $this->collUserSiteOptionList = array();
			} else {

				$criteria->add(UserSiteOptionPeer::USER_SITE_OPTION_ID, $this->getId());

				UserSiteOptionPeer::addSelectColumns($criteria);
				$this->collUserSiteOptionList = UserSiteOptionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UserSiteOptionPeer::USER_SITE_OPTION_ID, $this->getId());

				UserSiteOptionPeer::addSelectColumns($criteria);
				if (!isset($this->lastUserSiteOptionCriteria) || !$this->lastUserSiteOptionCriteria->equals($criteria)) {
					$this->collUserSiteOptionList = UserSiteOptionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUserSiteOptionCriteria = $criteria;
		return $this->collUserSiteOptionList;
	}

	
	public function countUserSiteOptionList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseUserSiteOptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(UserSiteOptionPeer::USER_SITE_OPTION_ID, $this->getId());

		return UserSiteOptionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addUserSiteOption(UserSiteOption $l)
	{
		$this->collUserSiteOptionList[] = $l;
		$l->setVirtualTable($this);
	}


	
	public function getUserSiteOptionListJoinPeople($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUserSiteOptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserSiteOptionList === null) {
			if ($this->isNew()) {
				$this->collUserSiteOptionList = array();
			} else {

				$criteria->add(UserSiteOptionPeer::USER_SITE_OPTION_ID, $this->getId());

				$this->collUserSiteOptionList = UserSiteOptionPeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(UserSiteOptionPeer::USER_SITE_OPTION_ID, $this->getId());

			if (!isset($this->lastUserSiteOptionCriteria) || !$this->lastUserSiteOptionCriteria->equals($criteria)) {
				$this->collUserSiteOptionList = UserSiteOptionPeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastUserSiteOptionCriteria = $criteria;

		return $this->collUserSiteOptionList;
	}

	
	public function initEventPersonalList()
	{
		if ($this->collEventPersonalList === null) {
			$this->collEventPersonalList = array();
		}
	}

	
	public function getEventPersonalList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPersonalPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventPersonalList === null) {
			if ($this->isNew()) {
			   $this->collEventPersonalList = array();
			} else {

				$criteria->add(EventPersonalPeer::GAME_STYLE_ID, $this->getId());

				EventPersonalPeer::addSelectColumns($criteria);
				$this->collEventPersonalList = EventPersonalPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventPersonalPeer::GAME_STYLE_ID, $this->getId());

				EventPersonalPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventPersonalCriteria) || !$this->lastEventPersonalCriteria->equals($criteria)) {
					$this->collEventPersonalList = EventPersonalPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventPersonalCriteria = $criteria;
		return $this->collEventPersonalList;
	}

	
	public function countEventPersonalList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventPersonalPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventPersonalPeer::GAME_STYLE_ID, $this->getId());

		return EventPersonalPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventPersonal(EventPersonal $l)
	{
		$this->collEventPersonalList[] = $l;
		$l->setVirtualTable($this);
	}


	
	public function getEventPersonalListJoinUserSite($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPersonalPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventPersonalList === null) {
			if ($this->isNew()) {
				$this->collEventPersonalList = array();
			} else {

				$criteria->add(EventPersonalPeer::GAME_STYLE_ID, $this->getId());

				$this->collEventPersonalList = EventPersonalPeer::doSelectJoinUserSite($criteria, $con);
			}
		} else {
									
			$criteria->add(EventPersonalPeer::GAME_STYLE_ID, $this->getId());

			if (!isset($this->lastEventPersonalCriteria) || !$this->lastEventPersonalCriteria->equals($criteria)) {
				$this->collEventPersonalList = EventPersonalPeer::doSelectJoinUserSite($criteria, $con);
			}
		}
		$this->lastEventPersonalCriteria = $criteria;

		return $this->collEventPersonalList;
	}

	
	public function initRankingLiveListRelatedByRankingTypeId()
	{
		if ($this->collRankingLiveListRelatedByRankingTypeId === null) {
			$this->collRankingLiveListRelatedByRankingTypeId = array();
		}
	}

	
	public function getRankingLiveListRelatedByRankingTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRankingLivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRankingLiveListRelatedByRankingTypeId === null) {
			if ($this->isNew()) {
			   $this->collRankingLiveListRelatedByRankingTypeId = array();
			} else {

				$criteria->add(RankingLivePeer::RANKING_TYPE_ID, $this->getId());

				RankingLivePeer::addSelectColumns($criteria);
				$this->collRankingLiveListRelatedByRankingTypeId = RankingLivePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RankingLivePeer::RANKING_TYPE_ID, $this->getId());

				RankingLivePeer::addSelectColumns($criteria);
				if (!isset($this->lastRankingLiveRelatedByRankingTypeIdCriteria) || !$this->lastRankingLiveRelatedByRankingTypeIdCriteria->equals($criteria)) {
					$this->collRankingLiveListRelatedByRankingTypeId = RankingLivePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRankingLiveRelatedByRankingTypeIdCriteria = $criteria;
		return $this->collRankingLiveListRelatedByRankingTypeId;
	}

	
	public function countRankingLiveListRelatedByRankingTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRankingLivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RankingLivePeer::RANKING_TYPE_ID, $this->getId());

		return RankingLivePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRankingLiveRelatedByRankingTypeId(RankingLive $l)
	{
		$this->collRankingLiveListRelatedByRankingTypeId[] = $l;
		$l->setVirtualTableRelatedByRankingTypeId($this);
	}

	
	public function initRankingLiveListRelatedByGameStyleId()
	{
		if ($this->collRankingLiveListRelatedByGameStyleId === null) {
			$this->collRankingLiveListRelatedByGameStyleId = array();
		}
	}

	
	public function getRankingLiveListRelatedByGameStyleId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRankingLivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRankingLiveListRelatedByGameStyleId === null) {
			if ($this->isNew()) {
			   $this->collRankingLiveListRelatedByGameStyleId = array();
			} else {

				$criteria->add(RankingLivePeer::GAME_STYLE_ID, $this->getId());

				RankingLivePeer::addSelectColumns($criteria);
				$this->collRankingLiveListRelatedByGameStyleId = RankingLivePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RankingLivePeer::GAME_STYLE_ID, $this->getId());

				RankingLivePeer::addSelectColumns($criteria);
				if (!isset($this->lastRankingLiveRelatedByGameStyleIdCriteria) || !$this->lastRankingLiveRelatedByGameStyleIdCriteria->equals($criteria)) {
					$this->collRankingLiveListRelatedByGameStyleId = RankingLivePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRankingLiveRelatedByGameStyleIdCriteria = $criteria;
		return $this->collRankingLiveListRelatedByGameStyleId;
	}

	
	public function countRankingLiveListRelatedByGameStyleId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRankingLivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RankingLivePeer::GAME_STYLE_ID, $this->getId());

		return RankingLivePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRankingLiveRelatedByGameStyleId(RankingLive $l)
	{
		$this->collRankingLiveListRelatedByGameStyleId[] = $l;
		$l->setVirtualTableRelatedByGameStyleId($this);
	}

	
	public function initRankingLiveListRelatedByGameTypeId()
	{
		if ($this->collRankingLiveListRelatedByGameTypeId === null) {
			$this->collRankingLiveListRelatedByGameTypeId = array();
		}
	}

	
	public function getRankingLiveListRelatedByGameTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRankingLivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRankingLiveListRelatedByGameTypeId === null) {
			if ($this->isNew()) {
			   $this->collRankingLiveListRelatedByGameTypeId = array();
			} else {

				$criteria->add(RankingLivePeer::GAME_TYPE_ID, $this->getId());

				RankingLivePeer::addSelectColumns($criteria);
				$this->collRankingLiveListRelatedByGameTypeId = RankingLivePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RankingLivePeer::GAME_TYPE_ID, $this->getId());

				RankingLivePeer::addSelectColumns($criteria);
				if (!isset($this->lastRankingLiveRelatedByGameTypeIdCriteria) || !$this->lastRankingLiveRelatedByGameTypeIdCriteria->equals($criteria)) {
					$this->collRankingLiveListRelatedByGameTypeId = RankingLivePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRankingLiveRelatedByGameTypeIdCriteria = $criteria;
		return $this->collRankingLiveListRelatedByGameTypeId;
	}

	
	public function countRankingLiveListRelatedByGameTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRankingLivePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RankingLivePeer::GAME_TYPE_ID, $this->getId());

		return RankingLivePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRankingLiveRelatedByGameTypeId(RankingLive $l)
	{
		$this->collRankingLiveListRelatedByGameTypeId[] = $l;
		$l->setVirtualTableRelatedByGameTypeId($this);
	}

  public function getCulture()
  {
    return $this->culture;
  }

  public function setCulture($culture)
  {
    $this->culture = $culture;
  }

  public function getDescriptionI18n()
  {
    $obj = $this->getCurrentVirtualTableI18n();

    return ($obj ? $obj->getDescriptionI18n() : null);
  }

  public function setDescriptionI18n($value)
  {
    $this->getCurrentVirtualTableI18n()->setDescriptionI18n($value);
  }

  protected $current_i18n = array();

  public function getCurrentVirtualTableI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = VirtualTableI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setVirtualTableI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setVirtualTableI18nForCulture(new VirtualTableI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setVirtualTableI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addVirtualTableI18n($object);
  }

} 