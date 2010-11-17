<?php


abstract class BaseRankingMember extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $ranking_id;


	
	protected $people_id;


	
	protected $events;


	
	protected $score;


	
	protected $total_paid;


	
	protected $total_prize;


	
	protected $balance;


	
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

	
	public function getEvents()
	{

		return $this->events;
	}

	
	public function getScore()
	{

		return $this->score;
	}

	
	public function getTotalPaid()
	{

		return $this->total_paid;
	}

	
	public function getTotalPrize()
	{

		return $this->total_prize;
	}

	
	public function getBalance()
	{

		return $this->balance;
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
			$this->modifiedColumns[] = RankingMemberPeer::RANKING_ID;
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
			$this->modifiedColumns[] = RankingMemberPeer::PEOPLE_ID;
		}

		if ($this->aPeople !== null && $this->aPeople->getId() !== $v) {
			$this->aPeople = null;
		}

	} 
	
	public function setEvents($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->events !== $v) {
			$this->events = $v;
			$this->modifiedColumns[] = RankingMemberPeer::EVENTS;
		}

	} 
	
	public function setScore($v)
	{

		if ($this->score !== $v) {
			$this->score = $v;
			$this->modifiedColumns[] = RankingMemberPeer::SCORE;
		}

	} 
	
	public function setTotalPaid($v)
	{

		if ($this->total_paid !== $v) {
			$this->total_paid = $v;
			$this->modifiedColumns[] = RankingMemberPeer::TOTAL_PAID;
		}

	} 
	
	public function setTotalPrize($v)
	{

		if ($this->total_prize !== $v) {
			$this->total_prize = $v;
			$this->modifiedColumns[] = RankingMemberPeer::TOTAL_PRIZE;
		}

	} 
	
	public function setBalance($v)
	{

		if ($this->balance !== $v) {
			$this->balance = $v;
			$this->modifiedColumns[] = RankingMemberPeer::BALANCE;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = RankingMemberPeer::ENABLED;
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
			$this->modifiedColumns[] = RankingMemberPeer::CREATED_AT;
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
			$this->modifiedColumns[] = RankingMemberPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->ranking_id = $rs->getInt($startcol + 0);

			$this->people_id = $rs->getInt($startcol + 1);

			$this->events = $rs->getInt($startcol + 2);

			$this->score = $rs->getFloat($startcol + 3);

			$this->total_paid = $rs->getFloat($startcol + 4);

			$this->total_prize = $rs->getFloat($startcol + 5);

			$this->balance = $rs->getFloat($startcol + 6);

			$this->enabled = $rs->getBoolean($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->updated_at = $rs->getTimestamp($startcol + 9, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating RankingMember object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RankingMemberPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RankingMemberPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(RankingMemberPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(RankingMemberPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RankingMemberPeer::DATABASE_NAME);
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
					$pk = RankingMemberPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += RankingMemberPeer::doUpdate($this, $con);
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


			if (($retval = RankingMemberPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RankingMemberPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getEvents();
				break;
			case 3:
				return $this->getScore();
				break;
			case 4:
				return $this->getTotalPaid();
				break;
			case 5:
				return $this->getTotalPrize();
				break;
			case 6:
				return $this->getBalance();
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
		$keys = RankingMemberPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getRankingId(),
			$keys[1]=>$this->getPeopleId(),
			$keys[2]=>$this->getEvents(),
			$keys[3]=>$this->getScore(),
			$keys[4]=>$this->getTotalPaid(),
			$keys[5]=>$this->getTotalPrize(),
			$keys[6]=>$this->getBalance(),
			$keys[7]=>$this->getEnabled(),
			$keys[8]=>$this->getCreatedAt(),
			$keys[9]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RankingMemberPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setEvents($value);
				break;
			case 3:
				$this->setScore($value);
				break;
			case 4:
				$this->setTotalPaid($value);
				break;
			case 5:
				$this->setTotalPrize($value);
				break;
			case 6:
				$this->setBalance($value);
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
		$keys = RankingMemberPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setRankingId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPeopleId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEvents($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setScore($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTotalPaid($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setTotalPrize($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setBalance($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setEnabled($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RankingMemberPeer::DATABASE_NAME);

		if ($this->isColumnModified(RankingMemberPeer::RANKING_ID)) $criteria->add(RankingMemberPeer::RANKING_ID, $this->ranking_id);
		if ($this->isColumnModified(RankingMemberPeer::PEOPLE_ID)) $criteria->add(RankingMemberPeer::PEOPLE_ID, $this->people_id);
		if ($this->isColumnModified(RankingMemberPeer::EVENTS)) $criteria->add(RankingMemberPeer::EVENTS, $this->events);
		if ($this->isColumnModified(RankingMemberPeer::SCORE)) $criteria->add(RankingMemberPeer::SCORE, $this->score);
		if ($this->isColumnModified(RankingMemberPeer::TOTAL_PAID)) $criteria->add(RankingMemberPeer::TOTAL_PAID, $this->total_paid);
		if ($this->isColumnModified(RankingMemberPeer::TOTAL_PRIZE)) $criteria->add(RankingMemberPeer::TOTAL_PRIZE, $this->total_prize);
		if ($this->isColumnModified(RankingMemberPeer::BALANCE)) $criteria->add(RankingMemberPeer::BALANCE, $this->balance);
		if ($this->isColumnModified(RankingMemberPeer::ENABLED)) $criteria->add(RankingMemberPeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(RankingMemberPeer::CREATED_AT)) $criteria->add(RankingMemberPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(RankingMemberPeer::UPDATED_AT)) $criteria->add(RankingMemberPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RankingMemberPeer::DATABASE_NAME);

		$criteria->add(RankingMemberPeer::RANKING_ID, $this->ranking_id);
		$criteria->add(RankingMemberPeer::PEOPLE_ID, $this->people_id);

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

		$copyObj->setEvents($this->events);

		$copyObj->setScore($this->score);

		$copyObj->setTotalPaid($this->total_paid);

		$copyObj->setTotalPrize($this->total_prize);

		$copyObj->setBalance($this->balance);

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
			self::$peer = new RankingMemberPeer();
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