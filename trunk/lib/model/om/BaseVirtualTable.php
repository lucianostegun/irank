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

	
	protected $collPeopleList;

	
	protected $lastPeopleCriteria = null;

	
	protected $collRankingList;

	
	protected $lastRankingCriteria = null;

	
	protected $collEventList;

	
	protected $lastEventCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
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

			if ($this->collPeopleList !== null) {
				foreach($this->collPeopleList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRankingList !== null) {
				foreach($this->collRankingList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEventList !== null) {
				foreach($this->collEventList as $referrerFK) {
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


				if ($this->collPeopleList !== null) {
					foreach($this->collPeopleList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRankingList !== null) {
					foreach($this->collRankingList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEventList !== null) {
					foreach($this->collEventList as $referrerFK) {
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

			foreach($this->getPeopleList() as $relObj) {
				$copyObj->addPeople($relObj->copy($deepCopy));
			}

			foreach($this->getRankingList() as $relObj) {
				$copyObj->addRanking($relObj->copy($deepCopy));
			}

			foreach($this->getEventList() as $relObj) {
				$copyObj->addEvent($relObj->copy($deepCopy));
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

	
	public function initRankingList()
	{
		if ($this->collRankingList === null) {
			$this->collRankingList = array();
		}
	}

	
	public function getRankingList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRankingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRankingList === null) {
			if ($this->isNew()) {
			   $this->collRankingList = array();
			} else {

				$criteria->add(RankingPeer::RANKING_TYPE_ID, $this->getId());

				RankingPeer::addSelectColumns($criteria);
				$this->collRankingList = RankingPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RankingPeer::RANKING_TYPE_ID, $this->getId());

				RankingPeer::addSelectColumns($criteria);
				if (!isset($this->lastRankingCriteria) || !$this->lastRankingCriteria->equals($criteria)) {
					$this->collRankingList = RankingPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRankingCriteria = $criteria;
		return $this->collRankingList;
	}

	
	public function countRankingList($criteria = null, $distinct = false, $con = null)
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

	
	public function addRanking(Ranking $l)
	{
		$this->collRankingList[] = $l;
		$l->setVirtualTable($this);
	}


	
	public function getRankingListJoinUserSite($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRankingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRankingList === null) {
			if ($this->isNew()) {
				$this->collRankingList = array();
			} else {

				$criteria->add(RankingPeer::RANKING_TYPE_ID, $this->getId());

				$this->collRankingList = RankingPeer::doSelectJoinUserSite($criteria, $con);
			}
		} else {
									
			$criteria->add(RankingPeer::RANKING_TYPE_ID, $this->getId());

			if (!isset($this->lastRankingCriteria) || !$this->lastRankingCriteria->equals($criteria)) {
				$this->collRankingList = RankingPeer::doSelectJoinUserSite($criteria, $con);
			}
		}
		$this->lastRankingCriteria = $criteria;

		return $this->collRankingList;
	}

	
	public function initEventList()
	{
		if ($this->collEventList === null) {
			$this->collEventList = array();
		}
	}

	
	public function getEventList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventList === null) {
			if ($this->isNew()) {
			   $this->collEventList = array();
			} else {

				$criteria->add(EventPeer::GAME_STYLE_ID, $this->getId());

				EventPeer::addSelectColumns($criteria);
				$this->collEventList = EventPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventPeer::GAME_STYLE_ID, $this->getId());

				EventPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventCriteria) || !$this->lastEventCriteria->equals($criteria)) {
					$this->collEventList = EventPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventCriteria = $criteria;
		return $this->collEventList;
	}

	
	public function countEventList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventPeer::GAME_STYLE_ID, $this->getId());

		return EventPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEvent(Event $l)
	{
		$this->collEventList[] = $l;
		$l->setVirtualTable($this);
	}


	
	public function getEventListJoinRanking($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventList === null) {
			if ($this->isNew()) {
				$this->collEventList = array();
			} else {

				$criteria->add(EventPeer::GAME_STYLE_ID, $this->getId());

				$this->collEventList = EventPeer::doSelectJoinRanking($criteria, $con);
			}
		} else {
									
			$criteria->add(EventPeer::GAME_STYLE_ID, $this->getId());

			if (!isset($this->lastEventCriteria) || !$this->lastEventCriteria->equals($criteria)) {
				$this->collEventList = EventPeer::doSelectJoinRanking($criteria, $con);
			}
		}
		$this->lastEventCriteria = $criteria;

		return $this->collEventList;
	}

} 