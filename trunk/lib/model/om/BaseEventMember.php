<?php


abstract class BaseEventMember extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $event_id;


	
	protected $people_id;


	
	protected $buyin;


	
	protected $rebuy;


	
	protected $addon;


	
	protected $event_position;


	
	protected $prize;


	
	protected $enabled;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aEvent;

	
	protected $aPeople;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getEventId()
	{

		return $this->event_id;
	}

	
	public function getPeopleId()
	{

		return $this->people_id;
	}

	
	public function getBuyin()
	{

		return $this->buyin;
	}

	
	public function getRebuy()
	{

		return $this->rebuy;
	}

	
	public function getAddon()
	{

		return $this->addon;
	}

	
	public function getEventPosition()
	{

		return $this->event_position;
	}

	
	public function getPrize()
	{

		return $this->prize;
	}

	
	public function getEnabled()
	{

		return $this->enabled;
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

	
	public function setEventId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->event_id !== $v) {
			$this->event_id = $v;
			$this->modifiedColumns[] = EventMemberPeer::EVENT_ID;
		}

		if ($this->aEvent !== null && $this->aEvent->getId() !== $v) {
			$this->aEvent = null;
		}

	} 
	
	public function setPeopleId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->people_id !== $v) {
			$this->people_id = $v;
			$this->modifiedColumns[] = EventMemberPeer::PEOPLE_ID;
		}

		if ($this->aPeople !== null && $this->aPeople->getId() !== $v) {
			$this->aPeople = null;
		}

	} 
	
	public function setBuyin($v)
	{

		if ($this->buyin !== $v) {
			$this->buyin = $v;
			$this->modifiedColumns[] = EventMemberPeer::BUYIN;
		}

	} 
	
	public function setRebuy($v)
	{

		if ($this->rebuy !== $v) {
			$this->rebuy = $v;
			$this->modifiedColumns[] = EventMemberPeer::REBUY;
		}

	} 
	
	public function setAddon($v)
	{

		if ($this->addon !== $v) {
			$this->addon = $v;
			$this->modifiedColumns[] = EventMemberPeer::ADDON;
		}

	} 
	
	public function setEventPosition($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->event_position !== $v) {
			$this->event_position = $v;
			$this->modifiedColumns[] = EventMemberPeer::EVENT_POSITION;
		}

	} 
	
	public function setPrize($v)
	{

		if ($this->prize !== $v) {
			$this->prize = $v;
			$this->modifiedColumns[] = EventMemberPeer::PRIZE;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = EventMemberPeer::ENABLED;
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
			$this->modifiedColumns[] = EventMemberPeer::CREATED_AT;
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
			$this->modifiedColumns[] = EventMemberPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->event_id = $rs->getInt($startcol + 0);

			$this->people_id = $rs->getInt($startcol + 1);

			$this->buyin = $rs->getFloat($startcol + 2);

			$this->rebuy = $rs->getFloat($startcol + 3);

			$this->addon = $rs->getFloat($startcol + 4);

			$this->event_position = $rs->getInt($startcol + 5);

			$this->prize = $rs->getFloat($startcol + 6);

			$this->enabled = $rs->getBoolean($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->updated_at = $rs->getTimestamp($startcol + 9, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EventMember object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventMemberPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EventMemberPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(EventMemberPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(EventMemberPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventMemberPeer::DATABASE_NAME);
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


												
			if ($this->aEvent !== null) {
				if ($this->aEvent->isModified()) {
					$affectedRows += $this->aEvent->save($con);
				}
				$this->setEvent($this->aEvent);
			}

			if ($this->aPeople !== null) {
				if ($this->aPeople->isModified()) {
					$affectedRows += $this->aPeople->save($con);
				}
				$this->setPeople($this->aPeople);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EventMemberPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += EventMemberPeer::doUpdate($this, $con);
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


												
			if ($this->aEvent !== null) {
				if (!$this->aEvent->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEvent->getValidationFailures());
				}
			}

			if ($this->aPeople !== null) {
				if (!$this->aPeople->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPeople->getValidationFailures());
				}
			}


			if (($retval = EventMemberPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventMemberPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getEventId();
				break;
			case 1:
				return $this->getPeopleId();
				break;
			case 2:
				return $this->getBuyin();
				break;
			case 3:
				return $this->getRebuy();
				break;
			case 4:
				return $this->getAddon();
				break;
			case 5:
				return $this->getEventPosition();
				break;
			case 6:
				return $this->getPrize();
				break;
			case 7:
				return $this->getEnabled();
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
		$keys = EventMemberPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getEventId(),
			$keys[1]=>$this->getPeopleId(),
			$keys[2]=>$this->getBuyin(),
			$keys[3]=>$this->getRebuy(),
			$keys[4]=>$this->getAddon(),
			$keys[5]=>$this->getEventPosition(),
			$keys[6]=>$this->getPrize(),
			$keys[7]=>$this->getEnabled(),
			$keys[8]=>$this->getCreatedAt(),
			$keys[9]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventMemberPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setEventId($value);
				break;
			case 1:
				$this->setPeopleId($value);
				break;
			case 2:
				$this->setBuyin($value);
				break;
			case 3:
				$this->setRebuy($value);
				break;
			case 4:
				$this->setAddon($value);
				break;
			case 5:
				$this->setEventPosition($value);
				break;
			case 6:
				$this->setPrize($value);
				break;
			case 7:
				$this->setEnabled($value);
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
		$keys = EventMemberPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setEventId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPeopleId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setBuyin($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRebuy($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setAddon($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setEventPosition($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPrize($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setEnabled($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EventMemberPeer::DATABASE_NAME);

		if ($this->isColumnModified(EventMemberPeer::EVENT_ID)) $criteria->add(EventMemberPeer::EVENT_ID, $this->event_id);
		if ($this->isColumnModified(EventMemberPeer::PEOPLE_ID)) $criteria->add(EventMemberPeer::PEOPLE_ID, $this->people_id);
		if ($this->isColumnModified(EventMemberPeer::BUYIN)) $criteria->add(EventMemberPeer::BUYIN, $this->buyin);
		if ($this->isColumnModified(EventMemberPeer::REBUY)) $criteria->add(EventMemberPeer::REBUY, $this->rebuy);
		if ($this->isColumnModified(EventMemberPeer::ADDON)) $criteria->add(EventMemberPeer::ADDON, $this->addon);
		if ($this->isColumnModified(EventMemberPeer::EVENT_POSITION)) $criteria->add(EventMemberPeer::EVENT_POSITION, $this->event_position);
		if ($this->isColumnModified(EventMemberPeer::PRIZE)) $criteria->add(EventMemberPeer::PRIZE, $this->prize);
		if ($this->isColumnModified(EventMemberPeer::ENABLED)) $criteria->add(EventMemberPeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(EventMemberPeer::CREATED_AT)) $criteria->add(EventMemberPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(EventMemberPeer::UPDATED_AT)) $criteria->add(EventMemberPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EventMemberPeer::DATABASE_NAME);

		$criteria->add(EventMemberPeer::EVENT_ID, $this->event_id);
		$criteria->add(EventMemberPeer::PEOPLE_ID, $this->people_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getEventId();

		$pks[1] = $this->getPeopleId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setEventId($keys[0]);

		$this->setPeopleId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setBuyin($this->buyin);

		$copyObj->setRebuy($this->rebuy);

		$copyObj->setAddon($this->addon);

		$copyObj->setEventPosition($this->event_position);

		$copyObj->setPrize($this->prize);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setEventId(NULL); 
		$copyObj->setPeopleId(NULL); 
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
			self::$peer = new EventMemberPeer();
		}
		return self::$peer;
	}

	
	public function setEvent($v)
	{


		if ($v === null) {
			$this->setEventId(NULL);
		} else {
			$this->setEventId($v->getId());
		}


		$this->aEvent = $v;
	}


	
	public function getEvent($con = null)
	{
		if ($this->aEvent === null && ($this->event_id !== null)) {
						include_once 'lib/model/om/BaseEventPeer.php';

			$this->aEvent = EventPeer::retrieveByPK($this->event_id, $con);

			
		}
		return $this->aEvent;
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