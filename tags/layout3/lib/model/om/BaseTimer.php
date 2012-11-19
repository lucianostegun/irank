<?php


abstract class BaseTimer extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $user_site_id;


	
	protected $timer_name;


	
	protected $default_duration;


	
	protected $levels;


	
	protected $play_sound;


	
	protected $minute_alert;


	
	protected $confirm_level;


	
	protected $has_ante;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aUserSite;

	
	protected $collTimerLevelList;

	
	protected $lastTimerLevelCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getUserSiteId()
	{

		return $this->user_site_id;
	}

	
	public function getTimerName()
	{

		return $this->timer_name;
	}

	
	public function getDefaultDuration()
	{

		return $this->default_duration;
	}

	
	public function getLevels()
	{

		return $this->levels;
	}

	
	public function getPlaySound()
	{

		return $this->play_sound;
	}

	
	public function getMinuteAlert()
	{

		return $this->minute_alert;
	}

	
	public function getConfirmLevel()
	{

		return $this->confirm_level;
	}

	
	public function getHasAnte()
	{

		return $this->has_ante;
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
			$this->modifiedColumns[] = TimerPeer::ID;
		}

	} 
	
	public function setUserSiteId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_site_id !== $v) {
			$this->user_site_id = $v;
			$this->modifiedColumns[] = TimerPeer::USER_SITE_ID;
		}

		if ($this->aUserSite !== null && $this->aUserSite->getId() !== $v) {
			$this->aUserSite = null;
		}

	} 
	
	public function setTimerName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->timer_name !== $v) {
			$this->timer_name = $v;
			$this->modifiedColumns[] = TimerPeer::TIMER_NAME;
		}

	} 
	
	public function setDefaultDuration($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->default_duration !== $v) {
			$this->default_duration = $v;
			$this->modifiedColumns[] = TimerPeer::DEFAULT_DURATION;
		}

	} 
	
	public function setLevels($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->levels !== $v) {
			$this->levels = $v;
			$this->modifiedColumns[] = TimerPeer::LEVELS;
		}

	} 
	
	public function setPlaySound($v)
	{

		if ($this->play_sound !== $v) {
			$this->play_sound = $v;
			$this->modifiedColumns[] = TimerPeer::PLAY_SOUND;
		}

	} 
	
	public function setMinuteAlert($v)
	{

		if ($this->minute_alert !== $v) {
			$this->minute_alert = $v;
			$this->modifiedColumns[] = TimerPeer::MINUTE_ALERT;
		}

	} 
	
	public function setConfirmLevel($v)
	{

		if ($this->confirm_level !== $v) {
			$this->confirm_level = $v;
			$this->modifiedColumns[] = TimerPeer::CONFIRM_LEVEL;
		}

	} 
	
	public function setHasAnte($v)
	{

		if ($this->has_ante !== $v) {
			$this->has_ante = $v;
			$this->modifiedColumns[] = TimerPeer::HAS_ANTE;
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
			$this->modifiedColumns[] = TimerPeer::CREATED_AT;
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
			$this->modifiedColumns[] = TimerPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->user_site_id = $rs->getInt($startcol + 1);

			$this->timer_name = $rs->getString($startcol + 2);

			$this->default_duration = $rs->getInt($startcol + 3);

			$this->levels = $rs->getInt($startcol + 4);

			$this->play_sound = $rs->getBoolean($startcol + 5);

			$this->minute_alert = $rs->getBoolean($startcol + 6);

			$this->confirm_level = $rs->getBoolean($startcol + 7);

			$this->has_ante = $rs->getBoolean($startcol + 8);

			$this->created_at = $rs->getTimestamp($startcol + 9, null);

			$this->updated_at = $rs->getTimestamp($startcol + 10, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Timer object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TimerPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TimerPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(TimerPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(TimerPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TimerPeer::DATABASE_NAME);
		}

		$tableName = TimerPeer::TABLE_NAME;
		
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


												
			if ($this->aUserSite !== null) {
				if ($this->aUserSite->isModified()) {
					$affectedRows += $this->aUserSite->save($con);
				}
				$this->setUserSite($this->aUserSite);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TimerPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TimerPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collTimerLevelList !== null) {
				foreach($this->collTimerLevelList as $referrerFK) {
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


												
			if ($this->aUserSite !== null) {
				if (!$this->aUserSite->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserSite->getValidationFailures());
				}
			}


			if (($retval = TimerPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collTimerLevelList !== null) {
					foreach($this->collTimerLevelList as $referrerFK) {
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
		$pos = TimerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getUserSiteId();
				break;
			case 2:
				return $this->getTimerName();
				break;
			case 3:
				return $this->getDefaultDuration();
				break;
			case 4:
				return $this->getLevels();
				break;
			case 5:
				return $this->getPlaySound();
				break;
			case 6:
				return $this->getMinuteAlert();
				break;
			case 7:
				return $this->getConfirmLevel();
				break;
			case 8:
				return $this->getHasAnte();
				break;
			case 9:
				return $this->getCreatedAt();
				break;
			case 10:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TimerPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getUserSiteId(),
			$keys[2]=>$this->getTimerName(),
			$keys[3]=>$this->getDefaultDuration(),
			$keys[4]=>$this->getLevels(),
			$keys[5]=>$this->getPlaySound(),
			$keys[6]=>$this->getMinuteAlert(),
			$keys[7]=>$this->getConfirmLevel(),
			$keys[8]=>$this->getHasAnte(),
			$keys[9]=>$this->getCreatedAt(),
			$keys[10]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TimerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setUserSiteId($value);
				break;
			case 2:
				$this->setTimerName($value);
				break;
			case 3:
				$this->setDefaultDuration($value);
				break;
			case 4:
				$this->setLevels($value);
				break;
			case 5:
				$this->setPlaySound($value);
				break;
			case 6:
				$this->setMinuteAlert($value);
				break;
			case 7:
				$this->setConfirmLevel($value);
				break;
			case 8:
				$this->setHasAnte($value);
				break;
			case 9:
				$this->setCreatedAt($value);
				break;
			case 10:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TimerPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserSiteId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTimerName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDefaultDuration($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setLevels($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPlaySound($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setMinuteAlert($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setConfirmLevel($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setHasAnte($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCreatedAt($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setUpdatedAt($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TimerPeer::DATABASE_NAME);

		if ($this->isColumnModified(TimerPeer::ID)) $criteria->add(TimerPeer::ID, $this->id);
		if ($this->isColumnModified(TimerPeer::USER_SITE_ID)) $criteria->add(TimerPeer::USER_SITE_ID, $this->user_site_id);
		if ($this->isColumnModified(TimerPeer::TIMER_NAME)) $criteria->add(TimerPeer::TIMER_NAME, $this->timer_name);
		if ($this->isColumnModified(TimerPeer::DEFAULT_DURATION)) $criteria->add(TimerPeer::DEFAULT_DURATION, $this->default_duration);
		if ($this->isColumnModified(TimerPeer::LEVELS)) $criteria->add(TimerPeer::LEVELS, $this->levels);
		if ($this->isColumnModified(TimerPeer::PLAY_SOUND)) $criteria->add(TimerPeer::PLAY_SOUND, $this->play_sound);
		if ($this->isColumnModified(TimerPeer::MINUTE_ALERT)) $criteria->add(TimerPeer::MINUTE_ALERT, $this->minute_alert);
		if ($this->isColumnModified(TimerPeer::CONFIRM_LEVEL)) $criteria->add(TimerPeer::CONFIRM_LEVEL, $this->confirm_level);
		if ($this->isColumnModified(TimerPeer::HAS_ANTE)) $criteria->add(TimerPeer::HAS_ANTE, $this->has_ante);
		if ($this->isColumnModified(TimerPeer::CREATED_AT)) $criteria->add(TimerPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(TimerPeer::UPDATED_AT)) $criteria->add(TimerPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TimerPeer::DATABASE_NAME);

		$criteria->add(TimerPeer::ID, $this->id);

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

		$copyObj->setUserSiteId($this->user_site_id);

		$copyObj->setTimerName($this->timer_name);

		$copyObj->setDefaultDuration($this->default_duration);

		$copyObj->setLevels($this->levels);

		$copyObj->setPlaySound($this->play_sound);

		$copyObj->setMinuteAlert($this->minute_alert);

		$copyObj->setConfirmLevel($this->confirm_level);

		$copyObj->setHasAnte($this->has_ante);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getTimerLevelList() as $relObj) {
				$copyObj->addTimerLevel($relObj->copy($deepCopy));
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
			self::$peer = new TimerPeer();
		}
		return self::$peer;
	}

	
	public function setUserSite($v)
	{


		if ($v === null) {
			$this->setUserSiteId(NULL);
		} else {
			$this->setUserSiteId($v->getId());
		}


		$this->aUserSite = $v;
	}


	
	public function getUserSite($con = null)
	{
		if ($this->aUserSite === null && ($this->user_site_id !== null)) {
						include_once 'lib/model/om/BaseUserSitePeer.php';

			$this->aUserSite = UserSitePeer::retrieveByPK($this->user_site_id, $con);

			
		}
		return $this->aUserSite;
	}

	
	public function initTimerLevelList()
	{
		if ($this->collTimerLevelList === null) {
			$this->collTimerLevelList = array();
		}
	}

	
	public function getTimerLevelList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseTimerLevelPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTimerLevelList === null) {
			if ($this->isNew()) {
			   $this->collTimerLevelList = array();
			} else {

				$criteria->add(TimerLevelPeer::TIMER_ID, $this->getId());

				TimerLevelPeer::addSelectColumns($criteria);
				$this->collTimerLevelList = TimerLevelPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TimerLevelPeer::TIMER_ID, $this->getId());

				TimerLevelPeer::addSelectColumns($criteria);
				if (!isset($this->lastTimerLevelCriteria) || !$this->lastTimerLevelCriteria->equals($criteria)) {
					$this->collTimerLevelList = TimerLevelPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTimerLevelCriteria = $criteria;
		return $this->collTimerLevelList;
	}

	
	public function countTimerLevelList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseTimerLevelPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(TimerLevelPeer::TIMER_ID, $this->getId());

		return TimerLevelPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addTimerLevel(TimerLevel $l)
	{
		$this->collTimerLevelList[] = $l;
		$l->setTimer($this);
	}

} 