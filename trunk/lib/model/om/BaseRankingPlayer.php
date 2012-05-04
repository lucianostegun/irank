<?php


abstract class BaseRankingPlayer extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $ranking_id;


	
	protected $people_id;


	
	protected $total_events;


	
	protected $total_score;


	
	protected $total_paid;


	
	protected $total_prize;


	
	protected $total_balance;


	
	protected $total_average;


	
	protected $allow_edit;


	
	protected $enabled;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aRanking;

	
	protected $aPeople;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getRankingId()
	{

		return $this->ranking_id;
	}

	
	public function getPeopleId()
	{

		return $this->people_id;
	}

	
	public function getTotalEvents()
	{

		return $this->total_events;
	}

	
	public function getTotalScore()
	{

		return $this->total_score;
	}

	
	public function getTotalPaid()
	{

		return $this->total_paid;
	}

	
	public function getTotalPrize()
	{

		return $this->total_prize;
	}

	
	public function getTotalBalance()
	{

		return $this->total_balance;
	}

	
	public function getTotalAverage()
	{

		return $this->total_average;
	}

	
	public function getAllowEdit()
	{

		return $this->allow_edit;
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

	
	public function setRankingId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ranking_id !== $v) {
			$this->ranking_id = $v;
			$this->modifiedColumns[] = RankingPlayerPeer::RANKING_ID;
		}

		if ($this->aRanking !== null && $this->aRanking->getId() !== $v) {
			$this->aRanking = null;
		}

	} 
	
	public function setPeopleId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->people_id !== $v) {
			$this->people_id = $v;
			$this->modifiedColumns[] = RankingPlayerPeer::PEOPLE_ID;
		}

		if ($this->aPeople !== null && $this->aPeople->getId() !== $v) {
			$this->aPeople = null;
		}

	} 
	
	public function setTotalEvents($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->total_events !== $v) {
			$this->total_events = $v;
			$this->modifiedColumns[] = RankingPlayerPeer::TOTAL_EVENTS;
		}

	} 
	
	public function setTotalScore($v)
	{

		if ($this->total_score !== $v) {
			$this->total_score = $v;
			$this->modifiedColumns[] = RankingPlayerPeer::TOTAL_SCORE;
		}

	} 
	
	public function setTotalPaid($v)
	{

		if ($this->total_paid !== $v) {
			$this->total_paid = $v;
			$this->modifiedColumns[] = RankingPlayerPeer::TOTAL_PAID;
		}

	} 
	
	public function setTotalPrize($v)
	{

		if ($this->total_prize !== $v) {
			$this->total_prize = $v;
			$this->modifiedColumns[] = RankingPlayerPeer::TOTAL_PRIZE;
		}

	} 
	
	public function setTotalBalance($v)
	{

		if ($this->total_balance !== $v) {
			$this->total_balance = $v;
			$this->modifiedColumns[] = RankingPlayerPeer::TOTAL_BALANCE;
		}

	} 
	
	public function setTotalAverage($v)
	{

		if ($this->total_average !== $v) {
			$this->total_average = $v;
			$this->modifiedColumns[] = RankingPlayerPeer::TOTAL_AVERAGE;
		}

	} 
	
	public function setAllowEdit($v)
	{

		if ($this->allow_edit !== $v) {
			$this->allow_edit = $v;
			$this->modifiedColumns[] = RankingPlayerPeer::ALLOW_EDIT;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = RankingPlayerPeer::ENABLED;
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
			$this->modifiedColumns[] = RankingPlayerPeer::CREATED_AT;
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
			$this->modifiedColumns[] = RankingPlayerPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->ranking_id = $rs->getInt($startcol + 0);

			$this->people_id = $rs->getInt($startcol + 1);

			$this->total_events = $rs->getInt($startcol + 2);

			$this->total_score = $rs->getFloat($startcol + 3);

			$this->total_paid = $rs->getFloat($startcol + 4);

			$this->total_prize = $rs->getFloat($startcol + 5);

			$this->total_balance = $rs->getFloat($startcol + 6);

			$this->total_average = $rs->getFloat($startcol + 7);

			$this->allow_edit = $rs->getBoolean($startcol + 8);

			$this->enabled = $rs->getBoolean($startcol + 9);

			$this->created_at = $rs->getTimestamp($startcol + 10, null);

			$this->updated_at = $rs->getTimestamp($startcol + 11, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating RankingPlayer object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RankingPlayerPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RankingPlayerPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(RankingPlayerPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(RankingPlayerPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RankingPlayerPeer::DATABASE_NAME);
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


												
			if ($this->aRanking !== null) {
				if ($this->aRanking->isModified()) {
					$affectedRows += $this->aRanking->save($con);
				}
				$this->setRanking($this->aRanking);
			}

			if ($this->aPeople !== null) {
				if ($this->aPeople->isModified()) {
					$affectedRows += $this->aPeople->save($con);
				}
				$this->setPeople($this->aPeople);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RankingPlayerPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += RankingPlayerPeer::doUpdate($this, $con);
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


												
			if ($this->aRanking !== null) {
				if (!$this->aRanking->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRanking->getValidationFailures());
				}
			}

			if ($this->aPeople !== null) {
				if (!$this->aPeople->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPeople->getValidationFailures());
				}
			}


			if (($retval = RankingPlayerPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RankingPlayerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getRankingId();
				break;
			case 1:
				return $this->getPeopleId();
				break;
			case 2:
				return $this->getTotalEvents();
				break;
			case 3:
				return $this->getTotalScore();
				break;
			case 4:
				return $this->getTotalPaid();
				break;
			case 5:
				return $this->getTotalPrize();
				break;
			case 6:
				return $this->getTotalBalance();
				break;
			case 7:
				return $this->getTotalAverage();
				break;
			case 8:
				return $this->getAllowEdit();
				break;
			case 9:
				return $this->getEnabled();
				break;
			case 10:
				return $this->getCreatedAt();
				break;
			case 11:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RankingPlayerPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getRankingId(),
			$keys[1]=>$this->getPeopleId(),
			$keys[2]=>$this->getTotalEvents(),
			$keys[3]=>$this->getTotalScore(),
			$keys[4]=>$this->getTotalPaid(),
			$keys[5]=>$this->getTotalPrize(),
			$keys[6]=>$this->getTotalBalance(),
			$keys[7]=>$this->getTotalAverage(),
			$keys[8]=>$this->getAllowEdit(),
			$keys[9]=>$this->getEnabled(),
			$keys[10]=>$this->getCreatedAt(),
			$keys[11]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RankingPlayerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setRankingId($value);
				break;
			case 1:
				$this->setPeopleId($value);
				break;
			case 2:
				$this->setTotalEvents($value);
				break;
			case 3:
				$this->setTotalScore($value);
				break;
			case 4:
				$this->setTotalPaid($value);
				break;
			case 5:
				$this->setTotalPrize($value);
				break;
			case 6:
				$this->setTotalBalance($value);
				break;
			case 7:
				$this->setTotalAverage($value);
				break;
			case 8:
				$this->setAllowEdit($value);
				break;
			case 9:
				$this->setEnabled($value);
				break;
			case 10:
				$this->setCreatedAt($value);
				break;
			case 11:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RankingPlayerPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setRankingId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPeopleId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTotalEvents($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTotalScore($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTotalPaid($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setTotalPrize($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setTotalBalance($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setTotalAverage($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setAllowEdit($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setEnabled($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUpdatedAt($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RankingPlayerPeer::DATABASE_NAME);

		if ($this->isColumnModified(RankingPlayerPeer::RANKING_ID)) $criteria->add(RankingPlayerPeer::RANKING_ID, $this->ranking_id);
		if ($this->isColumnModified(RankingPlayerPeer::PEOPLE_ID)) $criteria->add(RankingPlayerPeer::PEOPLE_ID, $this->people_id);
		if ($this->isColumnModified(RankingPlayerPeer::TOTAL_EVENTS)) $criteria->add(RankingPlayerPeer::TOTAL_EVENTS, $this->total_events);
		if ($this->isColumnModified(RankingPlayerPeer::TOTAL_SCORE)) $criteria->add(RankingPlayerPeer::TOTAL_SCORE, $this->total_score);
		if ($this->isColumnModified(RankingPlayerPeer::TOTAL_PAID)) $criteria->add(RankingPlayerPeer::TOTAL_PAID, $this->total_paid);
		if ($this->isColumnModified(RankingPlayerPeer::TOTAL_PRIZE)) $criteria->add(RankingPlayerPeer::TOTAL_PRIZE, $this->total_prize);
		if ($this->isColumnModified(RankingPlayerPeer::TOTAL_BALANCE)) $criteria->add(RankingPlayerPeer::TOTAL_BALANCE, $this->total_balance);
		if ($this->isColumnModified(RankingPlayerPeer::TOTAL_AVERAGE)) $criteria->add(RankingPlayerPeer::TOTAL_AVERAGE, $this->total_average);
		if ($this->isColumnModified(RankingPlayerPeer::ALLOW_EDIT)) $criteria->add(RankingPlayerPeer::ALLOW_EDIT, $this->allow_edit);
		if ($this->isColumnModified(RankingPlayerPeer::ENABLED)) $criteria->add(RankingPlayerPeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(RankingPlayerPeer::CREATED_AT)) $criteria->add(RankingPlayerPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(RankingPlayerPeer::UPDATED_AT)) $criteria->add(RankingPlayerPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RankingPlayerPeer::DATABASE_NAME);

		$criteria->add(RankingPlayerPeer::RANKING_ID, $this->ranking_id);
		$criteria->add(RankingPlayerPeer::PEOPLE_ID, $this->people_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getRankingId();

		$pks[1] = $this->getPeopleId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setRankingId($keys[0]);

		$this->setPeopleId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setTotalEvents($this->total_events);

		$copyObj->setTotalScore($this->total_score);

		$copyObj->setTotalPaid($this->total_paid);

		$copyObj->setTotalPrize($this->total_prize);

		$copyObj->setTotalBalance($this->total_balance);

		$copyObj->setTotalAverage($this->total_average);

		$copyObj->setAllowEdit($this->allow_edit);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setRankingId(NULL); 
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
			self::$peer = new RankingPlayerPeer();
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