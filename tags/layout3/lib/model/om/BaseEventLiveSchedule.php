<?php


abstract class BaseEventLiveSchedule extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $event_live_id;


	
	protected $event_date;


	
	protected $start_time;


	
	protected $event_date_time;


	
	protected $days_after;


	
	protected $step_day;


	
	protected $is_satellite;


	
	protected $created_at;

	
	protected $aEventLive;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getEventLiveId()
	{

		return $this->event_live_id;
	}

	
	public function getEventDate($format = 'Y-m-d')
	{

		if ($this->event_date === null || $this->event_date === '') {
			return null;
		} elseif (!is_int($this->event_date)) {
						$ts = strtotime($this->event_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [event_date] as date/time value: " . var_export($this->event_date, true));
			}
		} else {
			$ts = $this->event_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getStartTime($format = 'H:i:s')
	{

		if ($this->start_time === null || $this->start_time === '') {
			return null;
		} elseif (!is_int($this->start_time)) {
						$ts = strtotime($this->start_time);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [start_time] as date/time value: " . var_export($this->start_time, true));
			}
		} else {
			$ts = $this->start_time;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getEventDateTime($format = 'Y-m-d H:i:s')
	{

		if ($this->event_date_time === null || $this->event_date_time === '') {
			return null;
		} elseif (!is_int($this->event_date_time)) {
						$ts = strtotime($this->event_date_time);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [event_date_time] as date/time value: " . var_export($this->event_date_time, true));
			}
		} else {
			$ts = $this->event_date_time;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getDaysAfter()
	{

		return $this->days_after;
	}

	
	public function getStepDay()
	{

		return $this->step_day;
	}

	
	public function getIsSatellite()
	{

		return $this->is_satellite;
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

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = EventLiveSchedulePeer::ID;
		}

	} 
	
	public function setEventLiveId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->event_live_id !== $v) {
			$this->event_live_id = $v;
			$this->modifiedColumns[] = EventLiveSchedulePeer::EVENT_LIVE_ID;
		}

		if ($this->aEventLive !== null && $this->aEventLive->getId() !== $v) {
			$this->aEventLive = null;
		}

	} 
	
	public function setEventDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [event_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->event_date !== $ts) {
			$this->event_date = $ts;
			$this->modifiedColumns[] = EventLiveSchedulePeer::EVENT_DATE;
		}

	} 
	
	public function setStartTime($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [start_time] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->start_time !== $ts) {
			$this->start_time = $ts;
			$this->modifiedColumns[] = EventLiveSchedulePeer::START_TIME;
		}

	} 
	
	public function setEventDateTime($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [event_date_time] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->event_date_time !== $ts) {
			$this->event_date_time = $ts;
			$this->modifiedColumns[] = EventLiveSchedulePeer::EVENT_DATE_TIME;
		}

	} 
	
	public function setDaysAfter($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->days_after !== $v) {
			$this->days_after = $v;
			$this->modifiedColumns[] = EventLiveSchedulePeer::DAYS_AFTER;
		}

	} 
	
	public function setStepDay($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->step_day !== $v) {
			$this->step_day = $v;
			$this->modifiedColumns[] = EventLiveSchedulePeer::STEP_DAY;
		}

	} 
	
	public function setIsSatellite($v)
	{

		if ($this->is_satellite !== $v) {
			$this->is_satellite = $v;
			$this->modifiedColumns[] = EventLiveSchedulePeer::IS_SATELLITE;
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
			$this->modifiedColumns[] = EventLiveSchedulePeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->event_live_id = $rs->getInt($startcol + 1);

			$this->event_date = $rs->getDate($startcol + 2, null);

			$this->start_time = $rs->getTime($startcol + 3, null);

			$this->event_date_time = $rs->getTimestamp($startcol + 4, null);

			$this->days_after = $rs->getInt($startcol + 5);

			$this->step_day = $rs->getString($startcol + 6);

			$this->is_satellite = $rs->getBoolean($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EventLiveSchedule object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventLiveSchedulePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EventLiveSchedulePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(EventLiveSchedulePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventLiveSchedulePeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EventLiveSchedulePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += EventLiveSchedulePeer::doUpdate($this, $con);
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


			if (($retval = EventLiveSchedulePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventLiveSchedulePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getEventLiveId();
				break;
			case 2:
				return $this->getEventDate();
				break;
			case 3:
				return $this->getStartTime();
				break;
			case 4:
				return $this->getEventDateTime();
				break;
			case 5:
				return $this->getDaysAfter();
				break;
			case 6:
				return $this->getStepDay();
				break;
			case 7:
				return $this->getIsSatellite();
				break;
			case 8:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EventLiveSchedulePeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getEventLiveId(),
			$keys[2]=>$this->getEventDate(),
			$keys[3]=>$this->getStartTime(),
			$keys[4]=>$this->getEventDateTime(),
			$keys[5]=>$this->getDaysAfter(),
			$keys[6]=>$this->getStepDay(),
			$keys[7]=>$this->getIsSatellite(),
			$keys[8]=>$this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventLiveSchedulePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setEventLiveId($value);
				break;
			case 2:
				$this->setEventDate($value);
				break;
			case 3:
				$this->setStartTime($value);
				break;
			case 4:
				$this->setEventDateTime($value);
				break;
			case 5:
				$this->setDaysAfter($value);
				break;
			case 6:
				$this->setStepDay($value);
				break;
			case 7:
				$this->setIsSatellite($value);
				break;
			case 8:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EventLiveSchedulePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setEventLiveId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEventDate($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setStartTime($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEventDateTime($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDaysAfter($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setStepDay($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIsSatellite($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EventLiveSchedulePeer::DATABASE_NAME);

		if ($this->isColumnModified(EventLiveSchedulePeer::ID)) $criteria->add(EventLiveSchedulePeer::ID, $this->id);
		if ($this->isColumnModified(EventLiveSchedulePeer::EVENT_LIVE_ID)) $criteria->add(EventLiveSchedulePeer::EVENT_LIVE_ID, $this->event_live_id);
		if ($this->isColumnModified(EventLiveSchedulePeer::EVENT_DATE)) $criteria->add(EventLiveSchedulePeer::EVENT_DATE, $this->event_date);
		if ($this->isColumnModified(EventLiveSchedulePeer::START_TIME)) $criteria->add(EventLiveSchedulePeer::START_TIME, $this->start_time);
		if ($this->isColumnModified(EventLiveSchedulePeer::EVENT_DATE_TIME)) $criteria->add(EventLiveSchedulePeer::EVENT_DATE_TIME, $this->event_date_time);
		if ($this->isColumnModified(EventLiveSchedulePeer::DAYS_AFTER)) $criteria->add(EventLiveSchedulePeer::DAYS_AFTER, $this->days_after);
		if ($this->isColumnModified(EventLiveSchedulePeer::STEP_DAY)) $criteria->add(EventLiveSchedulePeer::STEP_DAY, $this->step_day);
		if ($this->isColumnModified(EventLiveSchedulePeer::IS_SATELLITE)) $criteria->add(EventLiveSchedulePeer::IS_SATELLITE, $this->is_satellite);
		if ($this->isColumnModified(EventLiveSchedulePeer::CREATED_AT)) $criteria->add(EventLiveSchedulePeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EventLiveSchedulePeer::DATABASE_NAME);

		$criteria->add(EventLiveSchedulePeer::EVENT_LIVE_ID, $this->event_live_id);
		$criteria->add(EventLiveSchedulePeer::EVENT_DATE, $this->event_date);
		$criteria->add(EventLiveSchedulePeer::START_TIME, $this->start_time);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getEventLiveId();

		$pks[1] = $this->getEventDate();

		$pks[2] = $this->getStartTime();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setEventLiveId($keys[0]);

		$this->setEventDate($keys[1]);

		$this->setStartTime($keys[2]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setId($this->id);

		$copyObj->setEventDateTime($this->event_date_time);

		$copyObj->setDaysAfter($this->days_after);

		$copyObj->setStepDay($this->step_day);

		$copyObj->setIsSatellite($this->is_satellite);

		$copyObj->setCreatedAt($this->created_at);


		$copyObj->setNew(true);

		$copyObj->setEventLiveId(NULL); 
		$copyObj->setEventDate(NULL); 
		$copyObj->setStartTime(NULL); 
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
			self::$peer = new EventLiveSchedulePeer();
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

} 