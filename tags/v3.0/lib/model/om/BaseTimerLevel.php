<?php


abstract class BaseTimerLevel extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $timer_id;


	
	protected $small_blind;


	
	protected $big_blind;


	
	protected $ante;


	
	protected $duration;


	
	protected $is_pause;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aTimer;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getTimerId()
	{

		return $this->timer_id;
	}

	
	public function getSmallBlind()
	{

		return $this->small_blind;
	}

	
	public function getBigBlind()
	{

		return $this->big_blind;
	}

	
	public function getAnte()
	{

		return $this->ante;
	}

	
	public function getDuration()
	{

		return $this->duration;
	}

	
	public function getIsPause()
	{

		return $this->is_pause;
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
			$this->modifiedColumns[] = TimerLevelPeer::ID;
		}

	} 
	
	public function setTimerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->timer_id !== $v) {
			$this->timer_id = $v;
			$this->modifiedColumns[] = TimerLevelPeer::TIMER_ID;
		}

		if ($this->aTimer !== null && $this->aTimer->getId() !== $v) {
			$this->aTimer = null;
		}

	} 
	
	public function setSmallBlind($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->small_blind !== $v) {
			$this->small_blind = $v;
			$this->modifiedColumns[] = TimerLevelPeer::SMALL_BLIND;
		}

	} 
	
	public function setBigBlind($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->big_blind !== $v) {
			$this->big_blind = $v;
			$this->modifiedColumns[] = TimerLevelPeer::BIG_BLIND;
		}

	} 
	
	public function setAnte($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ante !== $v) {
			$this->ante = $v;
			$this->modifiedColumns[] = TimerLevelPeer::ANTE;
		}

	} 
	
	public function setDuration($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->duration !== $v) {
			$this->duration = $v;
			$this->modifiedColumns[] = TimerLevelPeer::DURATION;
		}

	} 
	
	public function setIsPause($v)
	{

		if ($this->is_pause !== $v) {
			$this->is_pause = $v;
			$this->modifiedColumns[] = TimerLevelPeer::IS_PAUSE;
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
			$this->modifiedColumns[] = TimerLevelPeer::CREATED_AT;
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
			$this->modifiedColumns[] = TimerLevelPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->timer_id = $rs->getInt($startcol + 1);

			$this->small_blind = $rs->getInt($startcol + 2);

			$this->big_blind = $rs->getInt($startcol + 3);

			$this->ante = $rs->getInt($startcol + 4);

			$this->duration = $rs->getInt($startcol + 5);

			$this->is_pause = $rs->getBoolean($startcol + 6);

			$this->created_at = $rs->getTimestamp($startcol + 7, null);

			$this->updated_at = $rs->getTimestamp($startcol + 8, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating TimerLevel object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TimerLevelPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TimerLevelPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(TimerLevelPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(TimerLevelPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if( $this->isDeleted() )
			throw new PropelException("You cannot save an object that has been deleted.");

		if( $con === null )
			$con = Propel::getConnection(TimerLevelPeer::DATABASE_NAME);

		$tableName = TimerLevelPeer::TABLE_NAME;
		
		try{
			
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
		}catch(PropelException $e) {
			
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


												
			if ($this->aTimer !== null) {
				if ($this->aTimer->isModified()) {
					$affectedRows += $this->aTimer->save($con);
				}
				$this->setTimer($this->aTimer);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TimerLevelPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TimerLevelPeer::doUpdate($this, $con);
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


												
			if ($this->aTimer !== null) {
				if (!$this->aTimer->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTimer->getValidationFailures());
				}
			}


			if (($retval = TimerLevelPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TimerLevelPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTimerId();
				break;
			case 2:
				return $this->getSmallBlind();
				break;
			case 3:
				return $this->getBigBlind();
				break;
			case 4:
				return $this->getAnte();
				break;
			case 5:
				return $this->getDuration();
				break;
			case 6:
				return $this->getIsPause();
				break;
			case 7:
				return $this->getCreatedAt();
				break;
			case 8:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TimerLevelPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getTimerId(),
			$keys[2]=>$this->getSmallBlind(),
			$keys[3]=>$this->getBigBlind(),
			$keys[4]=>$this->getAnte(),
			$keys[5]=>$this->getDuration(),
			$keys[6]=>$this->getIsPause(),
			$keys[7]=>$this->getCreatedAt(),
			$keys[8]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TimerLevelPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTimerId($value);
				break;
			case 2:
				$this->setSmallBlind($value);
				break;
			case 3:
				$this->setBigBlind($value);
				break;
			case 4:
				$this->setAnte($value);
				break;
			case 5:
				$this->setDuration($value);
				break;
			case 6:
				$this->setIsPause($value);
				break;
			case 7:
				$this->setCreatedAt($value);
				break;
			case 8:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TimerLevelPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTimerId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSmallBlind($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setBigBlind($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setAnte($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDuration($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsPause($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUpdatedAt($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TimerLevelPeer::DATABASE_NAME);

		if ($this->isColumnModified(TimerLevelPeer::ID)) $criteria->add(TimerLevelPeer::ID, $this->id);
		if ($this->isColumnModified(TimerLevelPeer::TIMER_ID)) $criteria->add(TimerLevelPeer::TIMER_ID, $this->timer_id);
		if ($this->isColumnModified(TimerLevelPeer::SMALL_BLIND)) $criteria->add(TimerLevelPeer::SMALL_BLIND, $this->small_blind);
		if ($this->isColumnModified(TimerLevelPeer::BIG_BLIND)) $criteria->add(TimerLevelPeer::BIG_BLIND, $this->big_blind);
		if ($this->isColumnModified(TimerLevelPeer::ANTE)) $criteria->add(TimerLevelPeer::ANTE, $this->ante);
		if ($this->isColumnModified(TimerLevelPeer::DURATION)) $criteria->add(TimerLevelPeer::DURATION, $this->duration);
		if ($this->isColumnModified(TimerLevelPeer::IS_PAUSE)) $criteria->add(TimerLevelPeer::IS_PAUSE, $this->is_pause);
		if ($this->isColumnModified(TimerLevelPeer::CREATED_AT)) $criteria->add(TimerLevelPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(TimerLevelPeer::UPDATED_AT)) $criteria->add(TimerLevelPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TimerLevelPeer::DATABASE_NAME);

		$criteria->add(TimerLevelPeer::ID, $this->id);

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

		$copyObj->setTimerId($this->timer_id);

		$copyObj->setSmallBlind($this->small_blind);

		$copyObj->setBigBlind($this->big_blind);

		$copyObj->setAnte($this->ante);

		$copyObj->setDuration($this->duration);

		$copyObj->setIsPause($this->is_pause);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


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
			self::$peer = new TimerLevelPeer();
		}
		return self::$peer;
	}

	
	public function setTimer($v)
	{


		if ($v === null) {
			$this->setTimerId(NULL);
		} else {
			$this->setTimerId($v->getId());
		}


		$this->aTimer = $v;
	}


	
	public function getTimer($con = null)
	{
		if ($this->aTimer === null && ($this->timer_id !== null)) {
						include_once 'lib/model/om/BaseTimerPeer.php';

			$this->aTimer = TimerPeer::retrieveByPK($this->timer_id, $con);

			
		}
		return $this->aTimer;
	}

} 