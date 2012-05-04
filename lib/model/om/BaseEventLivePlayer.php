<?php


abstract class BaseEventLivePlayer extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $event_live_id;


	
	protected $people_id;


	
	protected $enabled;


	
	protected $event_position;


	
	protected $prize;


	
	protected $score;


	
	protected $entrance_fee;


	
	protected $buyin;


	
	protected $rebuy;


	
	protected $addon;


	
	protected $deleted;


	
	protected $created_at;


	
	protected $email_sent_date;


	
	protected $email_read_date;


	
	protected $updated_at;

	
	protected $aEventLive;

	
	protected $aPeople;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getEventLiveId()
	{

		return $this->event_live_id;
	}

	
	public function getPeopleId()
	{

		return $this->people_id;
	}

	
	public function getEnabled()
	{

		return $this->enabled;
	}

	
	public function getEventPosition()
	{

		return $this->event_position;
	}

	
	public function getPrize()
	{

		return $this->prize;
	}

	
	public function getScore()
	{

		return $this->score;
	}

	
	public function getEntranceFee()
	{

		return $this->entrance_fee;
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

	
	public function getEmailSentDate($format = 'Y-m-d H:i:s')
	{

		if ($this->email_sent_date === null || $this->email_sent_date === '') {
			return null;
		} elseif (!is_int($this->email_sent_date)) {
						$ts = strtotime($this->email_sent_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [email_sent_date] as date/time value: " . var_export($this->email_sent_date, true));
			}
		} else {
			$ts = $this->email_sent_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getEmailReadDate($format = 'Y-m-d H:i:s')
	{

		if ($this->email_read_date === null || $this->email_read_date === '') {
			return null;
		} elseif (!is_int($this->email_read_date)) {
						$ts = strtotime($this->email_read_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [email_read_date] as date/time value: " . var_export($this->email_read_date, true));
			}
		} else {
			$ts = $this->email_read_date;
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

	
	public function setEventLiveId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->event_live_id !== $v) {
			$this->event_live_id = $v;
			$this->modifiedColumns[] = EventLivePlayerPeer::EVENT_LIVE_ID;
		}

		if ($this->aEventLive !== null && $this->aEventLive->getId() !== $v) {
			$this->aEventLive = null;
		}

	} 
	
	public function setPeopleId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->people_id !== $v) {
			$this->people_id = $v;
			$this->modifiedColumns[] = EventLivePlayerPeer::PEOPLE_ID;
		}

		if ($this->aPeople !== null && $this->aPeople->getId() !== $v) {
			$this->aPeople = null;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = EventLivePlayerPeer::ENABLED;
		}

	} 
	
	public function setEventPosition($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->event_position !== $v) {
			$this->event_position = $v;
			$this->modifiedColumns[] = EventLivePlayerPeer::EVENT_POSITION;
		}

	} 
	
	public function setPrize($v)
	{

		if ($this->prize !== $v) {
			$this->prize = $v;
			$this->modifiedColumns[] = EventLivePlayerPeer::PRIZE;
		}

	} 
	
	public function setScore($v)
	{

		if ($this->score !== $v) {
			$this->score = $v;
			$this->modifiedColumns[] = EventLivePlayerPeer::SCORE;
		}

	} 
	
	public function setEntranceFee($v)
	{

		if ($this->entrance_fee !== $v) {
			$this->entrance_fee = $v;
			$this->modifiedColumns[] = EventLivePlayerPeer::ENTRANCE_FEE;
		}

	} 
	
	public function setBuyin($v)
	{

		if ($this->buyin !== $v) {
			$this->buyin = $v;
			$this->modifiedColumns[] = EventLivePlayerPeer::BUYIN;
		}

	} 
	
	public function setRebuy($v)
	{

		if ($this->rebuy !== $v) {
			$this->rebuy = $v;
			$this->modifiedColumns[] = EventLivePlayerPeer::REBUY;
		}

	} 
	
	public function setAddon($v)
	{

		if ($this->addon !== $v) {
			$this->addon = $v;
			$this->modifiedColumns[] = EventLivePlayerPeer::ADDON;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = EventLivePlayerPeer::DELETED;
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
			$this->modifiedColumns[] = EventLivePlayerPeer::CREATED_AT;
		}

	} 
	
	public function setEmailSentDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [email_sent_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->email_sent_date !== $ts) {
			$this->email_sent_date = $ts;
			$this->modifiedColumns[] = EventLivePlayerPeer::EMAIL_SENT_DATE;
		}

	} 
	
	public function setEmailReadDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [email_read_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->email_read_date !== $ts) {
			$this->email_read_date = $ts;
			$this->modifiedColumns[] = EventLivePlayerPeer::EMAIL_READ_DATE;
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
			$this->modifiedColumns[] = EventLivePlayerPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->event_live_id = $rs->getInt($startcol + 0);

			$this->people_id = $rs->getInt($startcol + 1);

			$this->enabled = $rs->getBoolean($startcol + 2);

			$this->event_position = $rs->getInt($startcol + 3);

			$this->prize = $rs->getFloat($startcol + 4);

			$this->score = $rs->getFloat($startcol + 5);

			$this->entrance_fee = $rs->getFloat($startcol + 6);

			$this->buyin = $rs->getFloat($startcol + 7);

			$this->rebuy = $rs->getFloat($startcol + 8);

			$this->addon = $rs->getFloat($startcol + 9);

			$this->deleted = $rs->getBoolean($startcol + 10);

			$this->created_at = $rs->getTimestamp($startcol + 11, null);

			$this->email_sent_date = $rs->getTimestamp($startcol + 12, null);

			$this->email_read_date = $rs->getTimestamp($startcol + 13, null);

			$this->updated_at = $rs->getTimestamp($startcol + 14, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 15; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EventLivePlayer object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventLivePlayerPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EventLivePlayerPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(EventLivePlayerPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(EventLivePlayerPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventLivePlayerPeer::DATABASE_NAME);
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


												
			if ($this->aEventLive !== null) {
				if ($this->aEventLive->isModified()) {
					$affectedRows += $this->aEventLive->save($con);
				}
				$this->setEventLive($this->aEventLive);
			}

			if ($this->aPeople !== null) {
				if ($this->aPeople->isModified()) {
					$affectedRows += $this->aPeople->save($con);
				}
				$this->setPeople($this->aPeople);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EventLivePlayerPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += EventLivePlayerPeer::doUpdate($this, $con);
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


												
			if ($this->aEventLive !== null) {
				if (!$this->aEventLive->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEventLive->getValidationFailures());
				}
			}

			if ($this->aPeople !== null) {
				if (!$this->aPeople->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPeople->getValidationFailures());
				}
			}


			if (($retval = EventLivePlayerPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventLivePlayerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getEventLiveId();
				break;
			case 1:
				return $this->getPeopleId();
				break;
			case 2:
				return $this->getEnabled();
				break;
			case 3:
				return $this->getEventPosition();
				break;
			case 4:
				return $this->getPrize();
				break;
			case 5:
				return $this->getScore();
				break;
			case 6:
				return $this->getEntranceFee();
				break;
			case 7:
				return $this->getBuyin();
				break;
			case 8:
				return $this->getRebuy();
				break;
			case 9:
				return $this->getAddon();
				break;
			case 10:
				return $this->getDeleted();
				break;
			case 11:
				return $this->getCreatedAt();
				break;
			case 12:
				return $this->getEmailSentDate();
				break;
			case 13:
				return $this->getEmailReadDate();
				break;
			case 14:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EventLivePlayerPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getEventLiveId(),
			$keys[1]=>$this->getPeopleId(),
			$keys[2]=>$this->getEnabled(),
			$keys[3]=>$this->getEventPosition(),
			$keys[4]=>$this->getPrize(),
			$keys[5]=>$this->getScore(),
			$keys[6]=>$this->getEntranceFee(),
			$keys[7]=>$this->getBuyin(),
			$keys[8]=>$this->getRebuy(),
			$keys[9]=>$this->getAddon(),
			$keys[10]=>$this->getDeleted(),
			$keys[11]=>$this->getCreatedAt(),
			$keys[12]=>$this->getEmailSentDate(),
			$keys[13]=>$this->getEmailReadDate(),
			$keys[14]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventLivePlayerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setEventLiveId($value);
				break;
			case 1:
				$this->setPeopleId($value);
				break;
			case 2:
				$this->setEnabled($value);
				break;
			case 3:
				$this->setEventPosition($value);
				break;
			case 4:
				$this->setPrize($value);
				break;
			case 5:
				$this->setScore($value);
				break;
			case 6:
				$this->setEntranceFee($value);
				break;
			case 7:
				$this->setBuyin($value);
				break;
			case 8:
				$this->setRebuy($value);
				break;
			case 9:
				$this->setAddon($value);
				break;
			case 10:
				$this->setDeleted($value);
				break;
			case 11:
				$this->setCreatedAt($value);
				break;
			case 12:
				$this->setEmailSentDate($value);
				break;
			case 13:
				$this->setEmailReadDate($value);
				break;
			case 14:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EventLivePlayerPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setEventLiveId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPeopleId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEnabled($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEventPosition($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPrize($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setScore($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setEntranceFee($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setBuyin($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setRebuy($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setAddon($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setDeleted($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCreatedAt($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setEmailSentDate($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setEmailReadDate($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setUpdatedAt($arr[$keys[14]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EventLivePlayerPeer::DATABASE_NAME);

		if ($this->isColumnModified(EventLivePlayerPeer::EVENT_LIVE_ID)) $criteria->add(EventLivePlayerPeer::EVENT_LIVE_ID, $this->event_live_id);
		if ($this->isColumnModified(EventLivePlayerPeer::PEOPLE_ID)) $criteria->add(EventLivePlayerPeer::PEOPLE_ID, $this->people_id);
		if ($this->isColumnModified(EventLivePlayerPeer::ENABLED)) $criteria->add(EventLivePlayerPeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(EventLivePlayerPeer::EVENT_POSITION)) $criteria->add(EventLivePlayerPeer::EVENT_POSITION, $this->event_position);
		if ($this->isColumnModified(EventLivePlayerPeer::PRIZE)) $criteria->add(EventLivePlayerPeer::PRIZE, $this->prize);
		if ($this->isColumnModified(EventLivePlayerPeer::SCORE)) $criteria->add(EventLivePlayerPeer::SCORE, $this->score);
		if ($this->isColumnModified(EventLivePlayerPeer::ENTRANCE_FEE)) $criteria->add(EventLivePlayerPeer::ENTRANCE_FEE, $this->entrance_fee);
		if ($this->isColumnModified(EventLivePlayerPeer::BUYIN)) $criteria->add(EventLivePlayerPeer::BUYIN, $this->buyin);
		if ($this->isColumnModified(EventLivePlayerPeer::REBUY)) $criteria->add(EventLivePlayerPeer::REBUY, $this->rebuy);
		if ($this->isColumnModified(EventLivePlayerPeer::ADDON)) $criteria->add(EventLivePlayerPeer::ADDON, $this->addon);
		if ($this->isColumnModified(EventLivePlayerPeer::DELETED)) $criteria->add(EventLivePlayerPeer::DELETED, $this->deleted);
		if ($this->isColumnModified(EventLivePlayerPeer::CREATED_AT)) $criteria->add(EventLivePlayerPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(EventLivePlayerPeer::EMAIL_SENT_DATE)) $criteria->add(EventLivePlayerPeer::EMAIL_SENT_DATE, $this->email_sent_date);
		if ($this->isColumnModified(EventLivePlayerPeer::EMAIL_READ_DATE)) $criteria->add(EventLivePlayerPeer::EMAIL_READ_DATE, $this->email_read_date);
		if ($this->isColumnModified(EventLivePlayerPeer::UPDATED_AT)) $criteria->add(EventLivePlayerPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EventLivePlayerPeer::DATABASE_NAME);

		$criteria->add(EventLivePlayerPeer::EVENT_LIVE_ID, $this->event_live_id);
		$criteria->add(EventLivePlayerPeer::PEOPLE_ID, $this->people_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getEventLiveId();

		$pks[1] = $this->getPeopleId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setEventLiveId($keys[0]);

		$this->setPeopleId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setEnabled($this->enabled);

		$copyObj->setEventPosition($this->event_position);

		$copyObj->setPrize($this->prize);

		$copyObj->setScore($this->score);

		$copyObj->setEntranceFee($this->entrance_fee);

		$copyObj->setBuyin($this->buyin);

		$copyObj->setRebuy($this->rebuy);

		$copyObj->setAddon($this->addon);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setEmailSentDate($this->email_sent_date);

		$copyObj->setEmailReadDate($this->email_read_date);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setEventLiveId(NULL); 
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
			self::$peer = new EventLivePlayerPeer();
		}
		return self::$peer;
	}

	
	public function setEventLive($v)
	{


		if ($v === null) {
			$this->setEventLiveId(NULL);
		} else {
			$this->setEventLiveId($v->getId());
		}


		$this->aEventLive = $v;
	}


	
	public function getEventLive($con = null)
	{
		if ($this->aEventLive === null && ($this->event_live_id !== null)) {
						include_once 'lib/model/om/BaseEventLivePeer.php';

			$this->aEventLive = EventLivePeer::retrieveByPK($this->event_live_id, $con);

			
		}
		return $this->aEventLive;
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