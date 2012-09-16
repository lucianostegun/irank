<?php


abstract class BaseEventLivePlayerDisclosureSms extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $event_live_id;


	
	protected $people_id;


	
	protected $sms_log_id;


	
	protected $sms_id;


	
	protected $created_at;

	
	protected $aEventLive;

	
	protected $aPeople;

	
	protected $aSms;

	
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

	
	public function getSmsLogId()
	{

		return $this->sms_log_id;
	}

	
	public function getSmsId()
	{

		return $this->sms_id;
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

	
	public function setEventLiveId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->event_live_id !== $v) {
			$this->event_live_id = $v;
			$this->modifiedColumns[] = EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID;
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
			$this->modifiedColumns[] = EventLivePlayerDisclosureSmsPeer::PEOPLE_ID;
		}

		if ($this->aPeople !== null && $this->aPeople->getId() !== $v) {
			$this->aPeople = null;
		}

	} 
	
	public function setSmsLogId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sms_log_id !== $v) {
			$this->sms_log_id = $v;
			$this->modifiedColumns[] = EventLivePlayerDisclosureSmsPeer::SMS_LOG_ID;
		}

	} 
	
	public function setSmsId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sms_id !== $v) {
			$this->sms_id = $v;
			$this->modifiedColumns[] = EventLivePlayerDisclosureSmsPeer::SMS_ID;
		}

		if ($this->aSms !== null && $this->aSms->getId() !== $v) {
			$this->aSms = null;
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
			$this->modifiedColumns[] = EventLivePlayerDisclosureSmsPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->event_live_id = $rs->getInt($startcol + 0);

			$this->people_id = $rs->getInt($startcol + 1);

			$this->sms_log_id = $rs->getInt($startcol + 2);

			$this->sms_id = $rs->getInt($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EventLivePlayerDisclosureSms object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventLivePlayerDisclosureSmsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EventLivePlayerDisclosureSmsPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(EventLivePlayerDisclosureSmsPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventLivePlayerDisclosureSmsPeer::DATABASE_NAME);
		}

		$tableName = EventLivePlayerDisclosureSmsPeer::TABLE_NAME;
		
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

			if ($this->aSms !== null) {
				if ($this->aSms->isModified()) {
					$affectedRows += $this->aSms->save($con);
				}
				$this->setSms($this->aSms);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EventLivePlayerDisclosureSmsPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += EventLivePlayerDisclosureSmsPeer::doUpdate($this, $con);
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

			if ($this->aSms !== null) {
				if (!$this->aSms->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSms->getValidationFailures());
				}
			}


			if (($retval = EventLivePlayerDisclosureSmsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventLivePlayerDisclosureSmsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getSmsLogId();
				break;
			case 3:
				return $this->getSmsId();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EventLivePlayerDisclosureSmsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getEventLiveId(),
			$keys[1]=>$this->getPeopleId(),
			$keys[2]=>$this->getSmsLogId(),
			$keys[3]=>$this->getSmsId(),
			$keys[4]=>$this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventLivePlayerDisclosureSmsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setSmsLogId($value);
				break;
			case 3:
				$this->setSmsId($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EventLivePlayerDisclosureSmsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setEventLiveId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPeopleId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSmsLogId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSmsId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EventLivePlayerDisclosureSmsPeer::DATABASE_NAME);

		if ($this->isColumnModified(EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID)) $criteria->add(EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID, $this->event_live_id);
		if ($this->isColumnModified(EventLivePlayerDisclosureSmsPeer::PEOPLE_ID)) $criteria->add(EventLivePlayerDisclosureSmsPeer::PEOPLE_ID, $this->people_id);
		if ($this->isColumnModified(EventLivePlayerDisclosureSmsPeer::SMS_LOG_ID)) $criteria->add(EventLivePlayerDisclosureSmsPeer::SMS_LOG_ID, $this->sms_log_id);
		if ($this->isColumnModified(EventLivePlayerDisclosureSmsPeer::SMS_ID)) $criteria->add(EventLivePlayerDisclosureSmsPeer::SMS_ID, $this->sms_id);
		if ($this->isColumnModified(EventLivePlayerDisclosureSmsPeer::CREATED_AT)) $criteria->add(EventLivePlayerDisclosureSmsPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EventLivePlayerDisclosureSmsPeer::DATABASE_NAME);

		$criteria->add(EventLivePlayerDisclosureSmsPeer::EVENT_LIVE_ID, $this->event_live_id);
		$criteria->add(EventLivePlayerDisclosureSmsPeer::PEOPLE_ID, $this->people_id);

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

		$copyObj->setSmsLogId($this->sms_log_id);

		$copyObj->setSmsId($this->sms_id);

		$copyObj->setCreatedAt($this->created_at);


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
			self::$peer = new EventLivePlayerDisclosureSmsPeer();
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

	
	public function setSms($v)
	{


		if ($v === null) {
			$this->setSmsId(NULL);
		} else {
			$this->setSmsId($v->getId());
		}


		$this->aSms = $v;
	}


	
	public function getSms($con = null)
	{
		if ($this->aSms === null && ($this->sms_id !== null)) {
						include_once 'lib/model/om/BaseSmsPeer.php';

			$this->aSms = SmsPeer::retrieveByPK($this->sms_id, $con);

			
		}
		return $this->aSms;
	}

} 