<?php


abstract class BaseRankingLiveTemplate extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $ranking_live_id;


	
	protected $days_after;


	
	protected $start_time;


	
	protected $step_day;


	
	protected $created_at;

	
	protected $aRankingLive;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getRankingLiveId()
	{

		return $this->ranking_live_id;
	}

	
	public function getDaysAfter()
	{

		return $this->days_after;
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

	
	public function getStepDay()
	{

		return $this->step_day;
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

	
	public function setRankingLiveId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ranking_live_id !== $v) {
			$this->ranking_live_id = $v;
			$this->modifiedColumns[] = RankingLiveTemplatePeer::RANKING_LIVE_ID;
		}

		if ($this->aRankingLive !== null && $this->aRankingLive->getId() !== $v) {
			$this->aRankingLive = null;
		}

	} 
	
	public function setDaysAfter($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->days_after !== $v) {
			$this->days_after = $v;
			$this->modifiedColumns[] = RankingLiveTemplatePeer::DAYS_AFTER;
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
			$this->modifiedColumns[] = RankingLiveTemplatePeer::START_TIME;
		}

	} 
	
	public function setStepDay($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->step_day !== $v) {
			$this->step_day = $v;
			$this->modifiedColumns[] = RankingLiveTemplatePeer::STEP_DAY;
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
			$this->modifiedColumns[] = RankingLiveTemplatePeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->ranking_live_id = $rs->getInt($startcol + 0);

			$this->days_after = $rs->getInt($startcol + 1);

			$this->start_time = $rs->getTime($startcol + 2, null);

			$this->step_day = $rs->getString($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating RankingLiveTemplate object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RankingLiveTemplatePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RankingLiveTemplatePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(RankingLiveTemplatePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RankingLiveTemplatePeer::DATABASE_NAME);
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


												
			if ($this->aRankingLive !== null) {
				if ($this->aRankingLive->isModified()) {
					$affectedRows += $this->aRankingLive->save($con);
				}
				$this->setRankingLive($this->aRankingLive);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RankingLiveTemplatePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += RankingLiveTemplatePeer::doUpdate($this, $con);
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


												
			if ($this->aRankingLive !== null) {
				if (!$this->aRankingLive->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRankingLive->getValidationFailures());
				}
			}


			if (($retval = RankingLiveTemplatePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RankingLiveTemplatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getRankingLiveId();
				break;
			case 1:
				return $this->getDaysAfter();
				break;
			case 2:
				return $this->getStartTime();
				break;
			case 3:
				return $this->getStepDay();
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
		$keys = RankingLiveTemplatePeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getRankingLiveId(),
			$keys[1]=>$this->getDaysAfter(),
			$keys[2]=>$this->getStartTime(),
			$keys[3]=>$this->getStepDay(),
			$keys[4]=>$this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RankingLiveTemplatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setRankingLiveId($value);
				break;
			case 1:
				$this->setDaysAfter($value);
				break;
			case 2:
				$this->setStartTime($value);
				break;
			case 3:
				$this->setStepDay($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RankingLiveTemplatePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setRankingLiveId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDaysAfter($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setStartTime($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setStepDay($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RankingLiveTemplatePeer::DATABASE_NAME);

		if ($this->isColumnModified(RankingLiveTemplatePeer::RANKING_LIVE_ID)) $criteria->add(RankingLiveTemplatePeer::RANKING_LIVE_ID, $this->ranking_live_id);
		if ($this->isColumnModified(RankingLiveTemplatePeer::DAYS_AFTER)) $criteria->add(RankingLiveTemplatePeer::DAYS_AFTER, $this->days_after);
		if ($this->isColumnModified(RankingLiveTemplatePeer::START_TIME)) $criteria->add(RankingLiveTemplatePeer::START_TIME, $this->start_time);
		if ($this->isColumnModified(RankingLiveTemplatePeer::STEP_DAY)) $criteria->add(RankingLiveTemplatePeer::STEP_DAY, $this->step_day);
		if ($this->isColumnModified(RankingLiveTemplatePeer::CREATED_AT)) $criteria->add(RankingLiveTemplatePeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RankingLiveTemplatePeer::DATABASE_NAME);

		$criteria->add(RankingLiveTemplatePeer::RANKING_LIVE_ID, $this->ranking_live_id);
		$criteria->add(RankingLiveTemplatePeer::DAYS_AFTER, $this->days_after);
		$criteria->add(RankingLiveTemplatePeer::START_TIME, $this->start_time);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getRankingLiveId();

		$pks[1] = $this->getDaysAfter();

		$pks[2] = $this->getStartTime();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setRankingLiveId($keys[0]);

		$this->setDaysAfter($keys[1]);

		$this->setStartTime($keys[2]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setStepDay($this->step_day);

		$copyObj->setCreatedAt($this->created_at);


		$copyObj->setNew(true);

		$copyObj->setRankingLiveId(NULL); 
		$copyObj->setDaysAfter(NULL); 
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
			self::$peer = new RankingLiveTemplatePeer();
		}
		return self::$peer;
	}

	
	public function setRankingLive($v)
	{


		if ($v === null) {
			$this->setRankingLiveId(NULL);
		} else {
			$this->setRankingLiveId($v->getId());
		}


		$this->aRankingLive = $v;
	}


	
	public function getRankingLive($con = null)
	{
		if ($this->aRankingLive === null && ($this->ranking_live_id !== null)) {
						include_once 'lib/model/om/BaseRankingLivePeer.php';

			$this->aRankingLive = RankingLivePeer::retrieveByPK($this->ranking_live_id, $con);

			
		}
		return $this->aRankingLive;
	}

} 