<?php


abstract class BaseRankingHistory extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $ranking_id;


	
	protected $people_id;


	
	protected $ranking_date;


	
	protected $total_ranking_position;


	
	protected $ranking_position;


	
	protected $events;


	
	protected $score;


	
	protected $paid_value;


	
	protected $prize_value;


	
	protected $balance_value;


	
	protected $total_events;


	
	protected $total_score;


	
	protected $total_paid;


	
	protected $total_prize;


	
	protected $total_balance;


	
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

	
	public function getRankingDate($format = 'Y-m-d')
	{

		if ($this->ranking_date === null || $this->ranking_date === '') {
			return null;
		} elseif (!is_int($this->ranking_date)) {
						$ts = strtotime($this->ranking_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [ranking_date] as date/time value: " . var_export($this->ranking_date, true));
			}
		} else {
			$ts = $this->ranking_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getTotalRankingPosition()
	{

		return $this->total_ranking_position;
	}

	
	public function getRankingPosition()
	{

		return $this->ranking_position;
	}

	
	public function getEvents()
	{

		return $this->events;
	}

	
	public function getScore()
	{

		return $this->score;
	}

	
	public function getPaidValue()
	{

		return $this->paid_value;
	}

	
	public function getPrizeValue()
	{

		return $this->prize_value;
	}

	
	public function getBalanceValue()
	{

		return $this->balance_value;
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
			$this->modifiedColumns[] = RankingHistoryPeer::RANKING_ID;
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
			$this->modifiedColumns[] = RankingHistoryPeer::PEOPLE_ID;
		}

		if ($this->aPeople !== null && $this->aPeople->getId() !== $v) {
			$this->aPeople = null;
		}

	} 
	
	public function setRankingDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [ranking_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ranking_date !== $ts) {
			$this->ranking_date = $ts;
			$this->modifiedColumns[] = RankingHistoryPeer::RANKING_DATE;
		}

	} 
	
	public function setTotalRankingPosition($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->total_ranking_position !== $v) {
			$this->total_ranking_position = $v;
			$this->modifiedColumns[] = RankingHistoryPeer::TOTAL_RANKING_POSITION;
		}

	} 
	
	public function setRankingPosition($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ranking_position !== $v) {
			$this->ranking_position = $v;
			$this->modifiedColumns[] = RankingHistoryPeer::RANKING_POSITION;
		}

	} 
	
	public function setEvents($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->events !== $v) {
			$this->events = $v;
			$this->modifiedColumns[] = RankingHistoryPeer::EVENTS;
		}

	} 
	
	public function setScore($v)
	{

		if ($this->score !== $v) {
			$this->score = $v;
			$this->modifiedColumns[] = RankingHistoryPeer::SCORE;
		}

	} 
	
	public function setPaidValue($v)
	{

		if ($this->paid_value !== $v) {
			$this->paid_value = $v;
			$this->modifiedColumns[] = RankingHistoryPeer::PAID_VALUE;
		}

	} 
	
	public function setPrizeValue($v)
	{

		if ($this->prize_value !== $v) {
			$this->prize_value = $v;
			$this->modifiedColumns[] = RankingHistoryPeer::PRIZE_VALUE;
		}

	} 
	
	public function setBalanceValue($v)
	{

		if ($this->balance_value !== $v) {
			$this->balance_value = $v;
			$this->modifiedColumns[] = RankingHistoryPeer::BALANCE_VALUE;
		}

	} 
	
	public function setTotalEvents($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->total_events !== $v) {
			$this->total_events = $v;
			$this->modifiedColumns[] = RankingHistoryPeer::TOTAL_EVENTS;
		}

	} 
	
	public function setTotalScore($v)
	{

		if ($this->total_score !== $v) {
			$this->total_score = $v;
			$this->modifiedColumns[] = RankingHistoryPeer::TOTAL_SCORE;
		}

	} 
	
	public function setTotalPaid($v)
	{

		if ($this->total_paid !== $v) {
			$this->total_paid = $v;
			$this->modifiedColumns[] = RankingHistoryPeer::TOTAL_PAID;
		}

	} 
	
	public function setTotalPrize($v)
	{

		if ($this->total_prize !== $v) {
			$this->total_prize = $v;
			$this->modifiedColumns[] = RankingHistoryPeer::TOTAL_PRIZE;
		}

	} 
	
	public function setTotalBalance($v)
	{

		if ($this->total_balance !== $v) {
			$this->total_balance = $v;
			$this->modifiedColumns[] = RankingHistoryPeer::TOTAL_BALANCE;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = RankingHistoryPeer::ENABLED;
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
			$this->modifiedColumns[] = RankingHistoryPeer::CREATED_AT;
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
			$this->modifiedColumns[] = RankingHistoryPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->ranking_id = $rs->getInt($startcol + 0);

			$this->people_id = $rs->getInt($startcol + 1);

			$this->ranking_date = $rs->getDate($startcol + 2, null);

			$this->total_ranking_position = $rs->getInt($startcol + 3);

			$this->ranking_position = $rs->getInt($startcol + 4);

			$this->events = $rs->getInt($startcol + 5);

			$this->score = $rs->getFloat($startcol + 6);

			$this->paid_value = $rs->getFloat($startcol + 7);

			$this->prize_value = $rs->getFloat($startcol + 8);

			$this->balance_value = $rs->getFloat($startcol + 9);

			$this->total_events = $rs->getInt($startcol + 10);

			$this->total_score = $rs->getFloat($startcol + 11);

			$this->total_paid = $rs->getFloat($startcol + 12);

			$this->total_prize = $rs->getFloat($startcol + 13);

			$this->total_balance = $rs->getFloat($startcol + 14);

			$this->enabled = $rs->getBoolean($startcol + 15);

			$this->created_at = $rs->getTimestamp($startcol + 16, null);

			$this->updated_at = $rs->getTimestamp($startcol + 17, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 18; 
		} catch (Exception $e) {
			throw new PropelException("Error populating RankingHistory object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RankingHistoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RankingHistoryPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(RankingHistoryPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(RankingHistoryPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RankingHistoryPeer::DATABASE_NAME);
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
					$pk = RankingHistoryPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += RankingHistoryPeer::doUpdate($this, $con);
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


			if (($retval = RankingHistoryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RankingHistoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getRankingDate();
				break;
			case 3:
				return $this->getTotalRankingPosition();
				break;
			case 4:
				return $this->getRankingPosition();
				break;
			case 5:
				return $this->getEvents();
				break;
			case 6:
				return $this->getScore();
				break;
			case 7:
				return $this->getPaidValue();
				break;
			case 8:
				return $this->getPrizeValue();
				break;
			case 9:
				return $this->getBalanceValue();
				break;
			case 10:
				return $this->getTotalEvents();
				break;
			case 11:
				return $this->getTotalScore();
				break;
			case 12:
				return $this->getTotalPaid();
				break;
			case 13:
				return $this->getTotalPrize();
				break;
			case 14:
				return $this->getTotalBalance();
				break;
			case 15:
				return $this->getEnabled();
				break;
			case 16:
				return $this->getCreatedAt();
				break;
			case 17:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RankingHistoryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getRankingId(),
			$keys[1]=>$this->getPeopleId(),
			$keys[2]=>$this->getRankingDate(),
			$keys[3]=>$this->getTotalRankingPosition(),
			$keys[4]=>$this->getRankingPosition(),
			$keys[5]=>$this->getEvents(),
			$keys[6]=>$this->getScore(),
			$keys[7]=>$this->getPaidValue(),
			$keys[8]=>$this->getPrizeValue(),
			$keys[9]=>$this->getBalanceValue(),
			$keys[10]=>$this->getTotalEvents(),
			$keys[11]=>$this->getTotalScore(),
			$keys[12]=>$this->getTotalPaid(),
			$keys[13]=>$this->getTotalPrize(),
			$keys[14]=>$this->getTotalBalance(),
			$keys[15]=>$this->getEnabled(),
			$keys[16]=>$this->getCreatedAt(),
			$keys[17]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RankingHistoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setRankingDate($value);
				break;
			case 3:
				$this->setTotalRankingPosition($value);
				break;
			case 4:
				$this->setRankingPosition($value);
				break;
			case 5:
				$this->setEvents($value);
				break;
			case 6:
				$this->setScore($value);
				break;
			case 7:
				$this->setPaidValue($value);
				break;
			case 8:
				$this->setPrizeValue($value);
				break;
			case 9:
				$this->setBalanceValue($value);
				break;
			case 10:
				$this->setTotalEvents($value);
				break;
			case 11:
				$this->setTotalScore($value);
				break;
			case 12:
				$this->setTotalPaid($value);
				break;
			case 13:
				$this->setTotalPrize($value);
				break;
			case 14:
				$this->setTotalBalance($value);
				break;
			case 15:
				$this->setEnabled($value);
				break;
			case 16:
				$this->setCreatedAt($value);
				break;
			case 17:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RankingHistoryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setRankingId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPeopleId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRankingDate($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTotalRankingPosition($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setRankingPosition($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setEvents($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setScore($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setPaidValue($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setPrizeValue($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setBalanceValue($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setTotalEvents($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setTotalScore($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setTotalPaid($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setTotalPrize($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setTotalBalance($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setEnabled($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCreatedAt($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setUpdatedAt($arr[$keys[17]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RankingHistoryPeer::DATABASE_NAME);

		if ($this->isColumnModified(RankingHistoryPeer::RANKING_ID)) $criteria->add(RankingHistoryPeer::RANKING_ID, $this->ranking_id);
		if ($this->isColumnModified(RankingHistoryPeer::PEOPLE_ID)) $criteria->add(RankingHistoryPeer::PEOPLE_ID, $this->people_id);
		if ($this->isColumnModified(RankingHistoryPeer::RANKING_DATE)) $criteria->add(RankingHistoryPeer::RANKING_DATE, $this->ranking_date);
		if ($this->isColumnModified(RankingHistoryPeer::TOTAL_RANKING_POSITION)) $criteria->add(RankingHistoryPeer::TOTAL_RANKING_POSITION, $this->total_ranking_position);
		if ($this->isColumnModified(RankingHistoryPeer::RANKING_POSITION)) $criteria->add(RankingHistoryPeer::RANKING_POSITION, $this->ranking_position);
		if ($this->isColumnModified(RankingHistoryPeer::EVENTS)) $criteria->add(RankingHistoryPeer::EVENTS, $this->events);
		if ($this->isColumnModified(RankingHistoryPeer::SCORE)) $criteria->add(RankingHistoryPeer::SCORE, $this->score);
		if ($this->isColumnModified(RankingHistoryPeer::PAID_VALUE)) $criteria->add(RankingHistoryPeer::PAID_VALUE, $this->paid_value);
		if ($this->isColumnModified(RankingHistoryPeer::PRIZE_VALUE)) $criteria->add(RankingHistoryPeer::PRIZE_VALUE, $this->prize_value);
		if ($this->isColumnModified(RankingHistoryPeer::BALANCE_VALUE)) $criteria->add(RankingHistoryPeer::BALANCE_VALUE, $this->balance_value);
		if ($this->isColumnModified(RankingHistoryPeer::TOTAL_EVENTS)) $criteria->add(RankingHistoryPeer::TOTAL_EVENTS, $this->total_events);
		if ($this->isColumnModified(RankingHistoryPeer::TOTAL_SCORE)) $criteria->add(RankingHistoryPeer::TOTAL_SCORE, $this->total_score);
		if ($this->isColumnModified(RankingHistoryPeer::TOTAL_PAID)) $criteria->add(RankingHistoryPeer::TOTAL_PAID, $this->total_paid);
		if ($this->isColumnModified(RankingHistoryPeer::TOTAL_PRIZE)) $criteria->add(RankingHistoryPeer::TOTAL_PRIZE, $this->total_prize);
		if ($this->isColumnModified(RankingHistoryPeer::TOTAL_BALANCE)) $criteria->add(RankingHistoryPeer::TOTAL_BALANCE, $this->total_balance);
		if ($this->isColumnModified(RankingHistoryPeer::ENABLED)) $criteria->add(RankingHistoryPeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(RankingHistoryPeer::CREATED_AT)) $criteria->add(RankingHistoryPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(RankingHistoryPeer::UPDATED_AT)) $criteria->add(RankingHistoryPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RankingHistoryPeer::DATABASE_NAME);

		$criteria->add(RankingHistoryPeer::RANKING_ID, $this->ranking_id);
		$criteria->add(RankingHistoryPeer::PEOPLE_ID, $this->people_id);
		$criteria->add(RankingHistoryPeer::RANKING_DATE, $this->ranking_date);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getRankingId();

		$pks[1] = $this->getPeopleId();

		$pks[2] = $this->getRankingDate();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setRankingId($keys[0]);

		$this->setPeopleId($keys[1]);

		$this->setRankingDate($keys[2]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setTotalRankingPosition($this->total_ranking_position);

		$copyObj->setRankingPosition($this->ranking_position);

		$copyObj->setEvents($this->events);

		$copyObj->setScore($this->score);

		$copyObj->setPaidValue($this->paid_value);

		$copyObj->setPrizeValue($this->prize_value);

		$copyObj->setBalanceValue($this->balance_value);

		$copyObj->setTotalEvents($this->total_events);

		$copyObj->setTotalScore($this->total_score);

		$copyObj->setTotalPaid($this->total_paid);

		$copyObj->setTotalPrize($this->total_prize);

		$copyObj->setTotalBalance($this->total_balance);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setRankingId(NULL); 
		$copyObj->setPeopleId(NULL); 
		$copyObj->setRankingDate(NULL); 
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
			self::$peer = new RankingHistoryPeer();
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