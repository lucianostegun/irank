<?php


abstract class BaseRankingPlace extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $ranking_id;


	
	protected $place_name;


	
	protected $maps_link;


	
	protected $state_id;


	
	protected $city_name;


	
	protected $quarter;


	
	protected $deleted;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aRanking;

	
	protected $aState;

	
	protected $collEventList;

	
	protected $lastEventCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getRankingId()
	{

		return $this->ranking_id;
	}

	
	public function getPlaceName()
	{

		return $this->place_name;
	}

	
	public function getMapsLink()
	{

		return $this->maps_link;
	}

	
	public function getStateId()
	{

		return $this->state_id;
	}

	
	public function getCityName()
	{

		return $this->city_name;
	}

	
	public function getQuarter()
	{

		return $this->quarter;
	}

	
	public function getDeleted()
	{

		return $this->deleted;
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
			$this->modifiedColumns[] = RankingPlacePeer::ID;
		}

	} 
	
	public function setRankingId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ranking_id !== $v) {
			$this->ranking_id = $v;
			$this->modifiedColumns[] = RankingPlacePeer::RANKING_ID;
		}

		if ($this->aRanking !== null && $this->aRanking->getId() !== $v) {
			$this->aRanking = null;
		}

	} 
	
	public function setPlaceName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->place_name !== $v) {
			$this->place_name = $v;
			$this->modifiedColumns[] = RankingPlacePeer::PLACE_NAME;
		}

	} 
	
	public function setMapsLink($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->maps_link !== $v) {
			$this->maps_link = $v;
			$this->modifiedColumns[] = RankingPlacePeer::MAPS_LINK;
		}

	} 
	
	public function setStateId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->state_id !== $v) {
			$this->state_id = $v;
			$this->modifiedColumns[] = RankingPlacePeer::STATE_ID;
		}

		if ($this->aState !== null && $this->aState->getId() !== $v) {
			$this->aState = null;
		}

	} 
	
	public function setCityName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->city_name !== $v) {
			$this->city_name = $v;
			$this->modifiedColumns[] = RankingPlacePeer::CITY_NAME;
		}

	} 
	
	public function setQuarter($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->quarter !== $v) {
			$this->quarter = $v;
			$this->modifiedColumns[] = RankingPlacePeer::QUARTER;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = RankingPlacePeer::DELETED;
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
			$this->modifiedColumns[] = RankingPlacePeer::CREATED_AT;
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
			$this->modifiedColumns[] = RankingPlacePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->ranking_id = $rs->getInt($startcol + 1);

			$this->place_name = $rs->getString($startcol + 2);

			$this->maps_link = $rs->getString($startcol + 3);

			$this->state_id = $rs->getInt($startcol + 4);

			$this->city_name = $rs->getString($startcol + 5);

			$this->quarter = $rs->getString($startcol + 6);

			$this->deleted = $rs->getBoolean($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->updated_at = $rs->getTimestamp($startcol + 9, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating RankingPlace object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RankingPlacePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RankingPlacePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(RankingPlacePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(RankingPlacePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RankingPlacePeer::DATABASE_NAME);
		}

		$tableName = RankingPlacePeer::TABLE_NAME;
		
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


												
			if ($this->aRanking !== null) {
				if ($this->aRanking->isModified()) {
					$affectedRows += $this->aRanking->save($con);
				}
				$this->setRanking($this->aRanking);
			}

			if ($this->aState !== null) {
				if ($this->aState->isModified()) {
					$affectedRows += $this->aState->save($con);
				}
				$this->setState($this->aState);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RankingPlacePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += RankingPlacePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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


												
			if ($this->aRanking !== null) {
				if (!$this->aRanking->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRanking->getValidationFailures());
				}
			}

			if ($this->aState !== null) {
				if (!$this->aState->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aState->getValidationFailures());
				}
			}


			if (($retval = RankingPlacePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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
		$pos = RankingPlacePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getRankingId();
				break;
			case 2:
				return $this->getPlaceName();
				break;
			case 3:
				return $this->getMapsLink();
				break;
			case 4:
				return $this->getStateId();
				break;
			case 5:
				return $this->getCityName();
				break;
			case 6:
				return $this->getQuarter();
				break;
			case 7:
				return $this->getDeleted();
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
		$keys = RankingPlacePeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getRankingId(),
			$keys[2]=>$this->getPlaceName(),
			$keys[3]=>$this->getMapsLink(),
			$keys[4]=>$this->getStateId(),
			$keys[5]=>$this->getCityName(),
			$keys[6]=>$this->getQuarter(),
			$keys[7]=>$this->getDeleted(),
			$keys[8]=>$this->getCreatedAt(),
			$keys[9]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RankingPlacePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setRankingId($value);
				break;
			case 2:
				$this->setPlaceName($value);
				break;
			case 3:
				$this->setMapsLink($value);
				break;
			case 4:
				$this->setStateId($value);
				break;
			case 5:
				$this->setCityName($value);
				break;
			case 6:
				$this->setQuarter($value);
				break;
			case 7:
				$this->setDeleted($value);
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
		$keys = RankingPlacePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setRankingId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPlaceName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setMapsLink($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setStateId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCityName($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setQuarter($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setDeleted($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RankingPlacePeer::DATABASE_NAME);

		if ($this->isColumnModified(RankingPlacePeer::ID)) $criteria->add(RankingPlacePeer::ID, $this->id);
		if ($this->isColumnModified(RankingPlacePeer::RANKING_ID)) $criteria->add(RankingPlacePeer::RANKING_ID, $this->ranking_id);
		if ($this->isColumnModified(RankingPlacePeer::PLACE_NAME)) $criteria->add(RankingPlacePeer::PLACE_NAME, $this->place_name);
		if ($this->isColumnModified(RankingPlacePeer::MAPS_LINK)) $criteria->add(RankingPlacePeer::MAPS_LINK, $this->maps_link);
		if ($this->isColumnModified(RankingPlacePeer::STATE_ID)) $criteria->add(RankingPlacePeer::STATE_ID, $this->state_id);
		if ($this->isColumnModified(RankingPlacePeer::CITY_NAME)) $criteria->add(RankingPlacePeer::CITY_NAME, $this->city_name);
		if ($this->isColumnModified(RankingPlacePeer::QUARTER)) $criteria->add(RankingPlacePeer::QUARTER, $this->quarter);
		if ($this->isColumnModified(RankingPlacePeer::DELETED)) $criteria->add(RankingPlacePeer::DELETED, $this->deleted);
		if ($this->isColumnModified(RankingPlacePeer::CREATED_AT)) $criteria->add(RankingPlacePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(RankingPlacePeer::UPDATED_AT)) $criteria->add(RankingPlacePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RankingPlacePeer::DATABASE_NAME);

		$criteria->add(RankingPlacePeer::ID, $this->id);

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

		$copyObj->setRankingId($this->ranking_id);

		$copyObj->setPlaceName($this->place_name);

		$copyObj->setMapsLink($this->maps_link);

		$copyObj->setStateId($this->state_id);

		$copyObj->setCityName($this->city_name);

		$copyObj->setQuarter($this->quarter);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

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
			self::$peer = new RankingPlacePeer();
		}
		return self::$peer;
	}

	
	public function setRanking($v)
	{


		if ($v === null) {
			$this->setRankingId(NULL);
		} else {
			$this->setRankingId($v->getId());
		}


		$this->aRanking = $v;
	}


	
	public function getRanking($con = null)
	{
		if ($this->aRanking === null && ($this->ranking_id !== null)) {
						include_once 'lib/model/om/BaseRankingPeer.php';

			$this->aRanking = RankingPeer::retrieveByPK($this->ranking_id, $con);

			
		}
		return $this->aRanking;
	}

	
	public function setState($v)
	{


		if ($v === null) {
			$this->setStateId(NULL);
		} else {
			$this->setStateId($v->getId());
		}


		$this->aState = $v;
	}


	
	public function getState($con = null)
	{
		if ($this->aState === null && ($this->state_id !== null)) {
						include_once 'lib/model/om/BaseStatePeer.php';

			$this->aState = StatePeer::retrieveByPK($this->state_id, $con);

			
		}
		return $this->aState;
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

				$criteria->add(EventPeer::RANKING_PLACE_ID, $this->getId());

				EventPeer::addSelectColumns($criteria);
				$this->collEventList = EventPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventPeer::RANKING_PLACE_ID, $this->getId());

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

		$criteria->add(EventPeer::RANKING_PLACE_ID, $this->getId());

		return EventPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEvent(Event $l)
	{
		$this->collEventList[] = $l;
		$l->setRankingPlace($this);
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

				$criteria->add(EventPeer::RANKING_PLACE_ID, $this->getId());

				$this->collEventList = EventPeer::doSelectJoinRanking($criteria, $con);
			}
		} else {
									
			$criteria->add(EventPeer::RANKING_PLACE_ID, $this->getId());

			if (!isset($this->lastEventCriteria) || !$this->lastEventCriteria->equals($criteria)) {
				$this->collEventList = EventPeer::doSelectJoinRanking($criteria, $con);
			}
		}
		$this->lastEventCriteria = $criteria;

		return $this->collEventList;
	}

} 