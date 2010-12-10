<?php


abstract class BaseEventPlayer extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $event_id;


	
	protected $people_id;


	
	protected $buyin;


	
	protected $rebuy;


	
	protected $addon;


	
	protected $event_position;


	
	protected $prize;


	
	protected $confirm_code;


	
	protected $invite_status;


	
	protected $allow_edit;


	
	protected $enabled;


	
	protected $deleted;


	
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

	
	public function getConfirmCode()
	{

		return $this->confirm_code;
	}

	
	public function getInviteStatus()
	{

		return $this->invite_status;
	}

	
	public function getAllowEdit()
	{

		return $this->allow_edit;
	}

	
	public function getEnabled()
	{

		return $this->enabled;
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

	
	public function setEventId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->event_id !== $v) {
			$this->event_id = $v;
			$this->modifiedColumns[] = EventPlayerPeer::EVENT_ID;
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
			$this->modifiedColumns[] = EventPlayerPeer::PEOPLE_ID;
		}

		if ($this->aPeople !== null && $this->aPeople->getId() !== $v) {
			$this->aPeople = null;
		}

	} 
	
	public function setBuyin($v)
	{

		if ($this->buyin !== $v) {
			$this->buyin = $v;
			$this->modifiedColumns[] = EventPlayerPeer::BUYIN;
		}

	} 
	
	public function setRebuy($v)
	{

		if ($this->rebuy !== $v) {
			$this->rebuy = $v;
			$this->modifiedColumns[] = EventPlayerPeer::REBUY;
		}

	} 
	
	public function setAddon($v)
	{

		if ($this->addon !== $v) {
			$this->addon = $v;
			$this->modifiedColumns[] = EventPlayerPeer::ADDON;
		}

	} 
	
	public function setEventPosition($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->event_position !== $v) {
			$this->event_position = $v;
			$this->modifiedColumns[] = EventPlayerPeer::EVENT_POSITION;
		}

	} 
	
	public function setPrize($v)
	{

		if ($this->prize !== $v) {
			$this->prize = $v;
			$this->modifiedColumns[] = EventPlayerPeer::PRIZE;
		}

	} 
	
	public function setConfirmCode($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->confirm_code !== $v) {
			$this->confirm_code = $v;
			$this->modifiedColumns[] = EventPlayerPeer::CONFIRM_CODE;
		}

	} 
	
	public function setInviteStatus($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->invite_status !== $v) {
			$this->invite_status = $v;
			$this->modifiedColumns[] = EventPlayerPeer::INVITE_STATUS;
		}

	} 
	
	public function setAllowEdit($v)
	{

		if ($this->allow_edit !== $v) {
			$this->allow_edit = $v;
			$this->modifiedColumns[] = EventPlayerPeer::ALLOW_EDIT;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = EventPlayerPeer::ENABLED;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = EventPlayerPeer::DELETED;
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
			$this->modifiedColumns[] = EventPlayerPeer::CREATED_AT;
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
			$this->modifiedColumns[] = EventPlayerPeer::UPDATED_AT;
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

			$this->confirm_code = $rs->getString($startcol + 7);

			$this->invite_status = $rs->getString($startcol + 8);

			$this->allow_edit = $rs->getBoolean($startcol + 9);

			$this->enabled = $rs->getBoolean($startcol + 10);

			$this->deleted = $rs->getBoolean($startcol + 11);

			$this->created_at = $rs->getTimestamp($startcol + 12, null);

			$this->updated_at = $rs->getTimestamp($startcol + 13, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 14; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EventPlayer object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventPlayerPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EventPlayerPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(EventPlayerPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(EventPlayerPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventPlayerPeer::DATABASE_NAME);
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
					$pk = EventPlayerPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += EventPlayerPeer::doUpdate($this, $con);
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


			if (($retval = EventPlayerPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventPlayerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getConfirmCode();
				break;
			case 8:
				return $this->getInviteStatus();
				break;
			case 9:
				return $this->getAllowEdit();
				break;
			case 10:
				return $this->getEnabled();
				break;
			case 11:
				return $this->getDeleted();
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
		$keys = EventPlayerPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getEventId(),
			$keys[1]=>$this->getPeopleId(),
			$keys[2]=>$this->getBuyin(),
			$keys[3]=>$this->getRebuy(),
			$keys[4]=>$this->getAddon(),
			$keys[5]=>$this->getEventPosition(),
			$keys[6]=>$this->getPrize(),
			$keys[7]=>$this->getConfirmCode(),
			$keys[8]=>$this->getInviteStatus(),
			$keys[9]=>$this->getAllowEdit(),
			$keys[10]=>$this->getEnabled(),
			$keys[11]=>$this->getDeleted(),
			$keys[12]=>$this->getCreatedAt(),
			$keys[13]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventPlayerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setConfirmCode($value);
				break;
			case 8:
				$this->setInviteStatus($value);
				break;
			case 9:
				$this->setAllowEdit($value);
				break;
			case 10:
				$this->setEnabled($value);
				break;
			case 11:
				$this->setDeleted($value);
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
		$keys = EventPlayerPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setEventId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPeopleId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setBuyin($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRebuy($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setAddon($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setEventPosition($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPrize($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setConfirmCode($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setInviteStatus($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setAllowEdit($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setEnabled($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setDeleted($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCreatedAt($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setUpdatedAt($arr[$keys[13]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EventPlayerPeer::DATABASE_NAME);

		if ($this->isColumnModified(EventPlayerPeer::EVENT_ID)) $criteria->add(EventPlayerPeer::EVENT_ID, $this->event_id);
		if ($this->isColumnModified(EventPlayerPeer::PEOPLE_ID)) $criteria->add(EventPlayerPeer::PEOPLE_ID, $this->people_id);
		if ($this->isColumnModified(EventPlayerPeer::BUYIN)) $criteria->add(EventPlayerPeer::BUYIN, $this->buyin);
		if ($this->isColumnModified(EventPlayerPeer::REBUY)) $criteria->add(EventPlayerPeer::REBUY, $this->rebuy);
		if ($this->isColumnModified(EventPlayerPeer::ADDON)) $criteria->add(EventPlayerPeer::ADDON, $this->addon);
		if ($this->isColumnModified(EventPlayerPeer::EVENT_POSITION)) $criteria->add(EventPlayerPeer::EVENT_POSITION, $this->event_position);
		if ($this->isColumnModified(EventPlayerPeer::PRIZE)) $criteria->add(EventPlayerPeer::PRIZE, $this->prize);
		if ($this->isColumnModified(EventPlayerPeer::CONFIRM_CODE)) $criteria->add(EventPlayerPeer::CONFIRM_CODE, $this->confirm_code);
		if ($this->isColumnModified(EventPlayerPeer::INVITE_STATUS)) $criteria->add(EventPlayerPeer::INVITE_STATUS, $this->invite_status);
		if ($this->isColumnModified(EventPlayerPeer::ALLOW_EDIT)) $criteria->add(EventPlayerPeer::ALLOW_EDIT, $this->allow_edit);
		if ($this->isColumnModified(EventPlayerPeer::ENABLED)) $criteria->add(EventPlayerPeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(EventPlayerPeer::DELETED)) $criteria->add(EventPlayerPeer::DELETED, $this->deleted);
		if ($this->isColumnModified(EventPlayerPeer::CREATED_AT)) $criteria->add(EventPlayerPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(EventPlayerPeer::UPDATED_AT)) $criteria->add(EventPlayerPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EventPlayerPeer::DATABASE_NAME);

		$criteria->add(EventPlayerPeer::EVENT_ID, $this->event_id);
		$criteria->add(EventPlayerPeer::PEOPLE_ID, $this->people_id);

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

		$copyObj->setConfirmCode($this->confirm_code);

		$copyObj->setInviteStatus($this->invite_status);

		$copyObj->setAllowEdit($this->allow_edit);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setDeleted($this->deleted);

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
			self::$peer = new EventPlayerPeer();
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