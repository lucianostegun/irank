<?php


abstract class BaseRankingLiveHistory extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $ranking_live_id;


	
	protected $people_id;


	
	protected $ranking_date;


	
	protected $ranking_position;


	
	protected $events;


	
	protected $score;


	
	protected $average;


	
	protected $paid_value;


	
	protected $prize_value;


	
	protected $balance_value;


	
	protected $total_ranking_position;


	
	protected $total_events;


	
	protected $total_score;


	
	protected $total_paid;


	
	protected $total_prize;


	
	protected $total_balance;


	
	protected $total_average;


	
	protected $enabled;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aRankingLive;

	
	protected $aPeople;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getRankingLiveId()
	{

		return $this->ranking_live_id;
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

	
	public function getAverage()
	{

		return $this->average;
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

	
	public function getTotalRankingPosition()
	{

		return $this->total_ranking_position;
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

	
	public function setRankingLiveId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ranking_live_id !== $v) {
			$this->ranking_live_id = $v;
			$this->modifiedColumns[] = RankingLiveHistoryPeer::RANKING_LIVE_ID;
		}

		if ($this->aRankingLive !== null && $this->aRankingLive->getId() !== $v) {
			$this->aRankingLive = null;
		}

	} 
	
	public function setPeopleId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->people_id !== $v) {
			$this->people_id = $v;
			$this->modifiedColumns[] = RankingLiveHistoryPeer::PEOPLE_ID;
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
			$this->modifiedColumns[] = RankingLiveHistoryPeer::RANKING_DATE;
		}

	} 
	
	public function setRankingPosition($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ranking_position !== $v) {
			$this->ranking_position = $v;
			$this->modifiedColumns[] = RankingLiveHistoryPeer::RANKING_POSITION;
		}

	} 
	
	public function setEvents($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->events !== $v) {
			$this->events = $v;
			$this->modifiedColumns[] = RankingLiveHistoryPeer::EVENTS;
		}

	} 
	
	public function setScore($v)
	{

		if ($this->score !== $v) {
			$this->score = $v;
			$this->modifiedColumns[] = RankingLiveHistoryPeer::SCORE;
		}

	} 
	
	public function setAverage($v)
	{

		if ($this->average !== $v) {
			$this->average = $v;
			$this->modifiedColumns[] = RankingLiveHistoryPeer::AVERAGE;
		}

	} 
	
	public function setPaidValue($v)
	{

		if ($this->paid_value !== $v) {
			$this->paid_value = $v;
			$this->modifiedColumns[] = RankingLiveHistoryPeer::PAID_VALUE;
		}

	} 
	
	public function setPrizeValue($v)
	{

		if ($this->prize_value !== $v) {
			$this->prize_value = $v;
			$this->modifiedColumns[] = RankingLiveHistoryPeer::PRIZE_VALUE;
		}

	} 
	
	public function setBalanceValue($v)
	{

		if ($this->balance_value !== $v) {
			$this->balance_value = $v;
			$this->modifiedColumns[] = RankingLiveHistoryPeer::BALANCE_VALUE;
		}

	} 
	
	public function setTotalRankingPosition($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->total_ranking_position !== $v) {
			$this->total_ranking_position = $v;
			$this->modifiedColumns[] = RankingLiveHistoryPeer::TOTAL_RANKING_POSITION;
		}

	} 
	
	public function setTotalEvents($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->total_events !== $v) {
			$this->total_events = $v;
			$this->modifiedColumns[] = RankingLiveHistoryPeer::TOTAL_EVENTS;
		}

	} 
	
	public function setTotalScore($v)
	{

		if ($this->total_score !== $v) {
			$this->total_score = $v;
			$this->modifiedColumns[] = RankingLiveHistoryPeer::TOTAL_SCORE;
		}

	} 
	
	public function setTotalPaid($v)
	{

		if ($this->total_paid !== $v) {
			$this->total_paid = $v;
			$this->modifiedColumns[] = RankingLiveHistoryPeer::TOTAL_PAID;
		}

	} 
	
	public function setTotalPrize($v)
	{

		if ($this->total_prize !== $v) {
			$this->total_prize = $v;
			$this->modifiedColumns[] = RankingLiveHistoryPeer::TOTAL_PRIZE;
		}

	} 
	
	public function setTotalBalance($v)
	{

		if ($this->total_balance !== $v) {
			$this->total_balance = $v;
			$this->modifiedColumns[] = RankingLiveHistoryPeer::TOTAL_BALANCE;
		}

	} 
	
	public function setTotalAverage($v)
	{

		if ($this->total_average !== $v) {
			$this->total_average = $v;
			$this->modifiedColumns[] = RankingLiveHistoryPeer::TOTAL_AVERAGE;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = RankingLiveHistoryPeer::ENABLED;
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
			$this->modifiedColumns[] = RankingLiveHistoryPeer::CREATED_AT;
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
			$this->modifiedColumns[] = RankingLiveHistoryPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->ranking_live_id = $rs->getInt($startcol + 0);

			$this->people_id = $rs->getInt($startcol + 1);

			$this->ranking_date = $rs->getDate($startcol + 2, null);

			$this->ranking_position = $rs->getInt($startcol + 3);

			$this->events = $rs->getInt($startcol + 4);

			$this->score = $rs->getFloat($startcol + 5);

			$this->average = $rs->getFloat($startcol + 6);

			$this->paid_value = $rs->getFloat($startcol + 7);

			$this->prize_value = $rs->getFloat($startcol + 8);

			$this->balance_value = $rs->getFloat($startcol + 9);

			$this->total_ranking_position = $rs->getInt($startcol + 10);

			$this->total_events = $rs->getInt($startcol + 11);

			$this->total_score = $rs->getFloat($startcol + 12);

			$this->total_paid = $rs->getFloat($startcol + 13);

			$this->total_prize = $rs->getFloat($startcol + 14);

			$this->total_balance = $rs->getFloat($startcol + 15);

			$this->total_average = $rs->getFloat($startcol + 16);

			$this->enabled = $rs->getBoolean($startcol + 17);

			$this->created_at = $rs->getTimestamp($startcol + 18, null);

			$this->updated_at = $rs->getTimestamp($startcol + 19, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 20; 
		} catch (Exception $e) {
			throw new PropelException("Error populating RankingLiveHistory object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RankingLiveHistoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RankingLiveHistoryPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(RankingLiveHistoryPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(RankingLiveHistoryPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if( $this->isDeleted() )
			throw new PropelException("You cannot save an object that has been deleted.");

		if( $con === null )
			$con = Propel::getConnection(RankingLiveHistoryPeer::DATABASE_NAME);

		$tableName = RankingLiveHistoryPeer::TABLE_NAME;
		
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


												
			if ($this->aRankingLive !== null) {
				if ($this->aRankingLive->isModified()) {
					$affectedRows += $this->aRankingLive->save($con);
				}
				$this->setRankingLive($this->aRankingLive);
			}

			if ($this->aPeople !== null) {
				if ($this->aPeople->isModified()) {
					$affectedRows += $this->aPeople->save($con);
				}
				$this->setPeople($this->aPeople);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RankingLiveHistoryPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += RankingLiveHistoryPeer::doUpdate($this, $con);
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

			if ($this->aPeople !== null) {
				if (!$this->aPeople->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPeople->getValidationFailures());
				}
			}


			if (($retval = RankingLiveHistoryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RankingLiveHistoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getRankingLiveId();
				break;
			case 1:
				return $this->getPeopleId();
				break;
			case 2:
				return $this->getRankingDate();
				break;
			case 3:
				return $this->getRankingPosition();
				break;
			case 4:
				return $this->getEvents();
				break;
			case 5:
				return $this->getScore();
				break;
			case 6:
				return $this->getAverage();
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
				return $this->getTotalRankingPosition();
				break;
			case 11:
				return $this->getTotalEvents();
				break;
			case 12:
				return $this->getTotalScore();
				break;
			case 13:
				return $this->getTotalPaid();
				break;
			case 14:
				return $this->getTotalPrize();
				break;
			case 15:
				return $this->getTotalBalance();
				break;
			case 16:
				return $this->getTotalAverage();
				break;
			case 17:
				return $this->getEnabled();
				break;
			case 18:
				return $this->getCreatedAt();
				break;
			case 19:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RankingLiveHistoryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getRankingLiveId(),
			$keys[1]=>$this->getPeopleId(),
			$keys[2]=>$this->getRankingDate(),
			$keys[3]=>$this->getRankingPosition(),
			$keys[4]=>$this->getEvents(),
			$keys[5]=>$this->getScore(),
			$keys[6]=>$this->getAverage(),
			$keys[7]=>$this->getPaidValue(),
			$keys[8]=>$this->getPrizeValue(),
			$keys[9]=>$this->getBalanceValue(),
			$keys[10]=>$this->getTotalRankingPosition(),
			$keys[11]=>$this->getTotalEvents(),
			$keys[12]=>$this->getTotalScore(),
			$keys[13]=>$this->getTotalPaid(),
			$keys[14]=>$this->getTotalPrize(),
			$keys[15]=>$this->getTotalBalance(),
			$keys[16]=>$this->getTotalAverage(),
			$keys[17]=>$this->getEnabled(),
			$keys[18]=>$this->getCreatedAt(),
			$keys[19]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RankingLiveHistoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setRankingLiveId($value);
				break;
			case 1:
				$this->setPeopleId($value);
				break;
			case 2:
				$this->setRankingDate($value);
				break;
			case 3:
				$this->setRankingPosition($value);
				break;
			case 4:
				$this->setEvents($value);
				break;
			case 5:
				$this->setScore($value);
				break;
			case 6:
				$this->setAverage($value);
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
				$this->setTotalRankingPosition($value);
				break;
			case 11:
				$this->setTotalEvents($value);
				break;
			case 12:
				$this->setTotalScore($value);
				break;
			case 13:
				$this->setTotalPaid($value);
				break;
			case 14:
				$this->setTotalPrize($value);
				break;
			case 15:
				$this->setTotalBalance($value);
				break;
			case 16:
				$this->setTotalAverage($value);
				break;
			case 17:
				$this->setEnabled($value);
				break;
			case 18:
				$this->setCreatedAt($value);
				break;
			case 19:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RankingLiveHistoryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setRankingLiveId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPeopleId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRankingDate($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRankingPosition($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEvents($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setScore($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setAverage($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setPaidValue($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setPrizeValue($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setBalanceValue($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setTotalRankingPosition($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setTotalEvents($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setTotalScore($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setTotalPaid($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setTotalPrize($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setTotalBalance($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setTotalAverage($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setEnabled($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCreatedAt($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setUpdatedAt($arr[$keys[19]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RankingLiveHistoryPeer::DATABASE_NAME);

		if ($this->isColumnModified(RankingLiveHistoryPeer::RANKING_LIVE_ID)) $criteria->add(RankingLiveHistoryPeer::RANKING_LIVE_ID, $this->ranking_live_id);
		if ($this->isColumnModified(RankingLiveHistoryPeer::PEOPLE_ID)) $criteria->add(RankingLiveHistoryPeer::PEOPLE_ID, $this->people_id);
		if ($this->isColumnModified(RankingLiveHistoryPeer::RANKING_DATE)) $criteria->add(RankingLiveHistoryPeer::RANKING_DATE, $this->ranking_date);
		if ($this->isColumnModified(RankingLiveHistoryPeer::RANKING_POSITION)) $criteria->add(RankingLiveHistoryPeer::RANKING_POSITION, $this->ranking_position);
		if ($this->isColumnModified(RankingLiveHistoryPeer::EVENTS)) $criteria->add(RankingLiveHistoryPeer::EVENTS, $this->events);
		if ($this->isColumnModified(RankingLiveHistoryPeer::SCORE)) $criteria->add(RankingLiveHistoryPeer::SCORE, $this->score);
		if ($this->isColumnModified(RankingLiveHistoryPeer::AVERAGE)) $criteria->add(RankingLiveHistoryPeer::AVERAGE, $this->average);
		if ($this->isColumnModified(RankingLiveHistoryPeer::PAID_VALUE)) $criteria->add(RankingLiveHistoryPeer::PAID_VALUE, $this->paid_value);
		if ($this->isColumnModified(RankingLiveHistoryPeer::PRIZE_VALUE)) $criteria->add(RankingLiveHistoryPeer::PRIZE_VALUE, $this->prize_value);
		if ($this->isColumnModified(RankingLiveHistoryPeer::BALANCE_VALUE)) $criteria->add(RankingLiveHistoryPeer::BALANCE_VALUE, $this->balance_value);
		if ($this->isColumnModified(RankingLiveHistoryPeer::TOTAL_RANKING_POSITION)) $criteria->add(RankingLiveHistoryPeer::TOTAL_RANKING_POSITION, $this->total_ranking_position);
		if ($this->isColumnModified(RankingLiveHistoryPeer::TOTAL_EVENTS)) $criteria->add(RankingLiveHistoryPeer::TOTAL_EVENTS, $this->total_events);
		if ($this->isColumnModified(RankingLiveHistoryPeer::TOTAL_SCORE)) $criteria->add(RankingLiveHistoryPeer::TOTAL_SCORE, $this->total_score);
		if ($this->isColumnModified(RankingLiveHistoryPeer::TOTAL_PAID)) $criteria->add(RankingLiveHistoryPeer::TOTAL_PAID, $this->total_paid);
		if ($this->isColumnModified(RankingLiveHistoryPeer::TOTAL_PRIZE)) $criteria->add(RankingLiveHistoryPeer::TOTAL_PRIZE, $this->total_prize);
		if ($this->isColumnModified(RankingLiveHistoryPeer::TOTAL_BALANCE)) $criteria->add(RankingLiveHistoryPeer::TOTAL_BALANCE, $this->total_balance);
		if ($this->isColumnModified(RankingLiveHistoryPeer::TOTAL_AVERAGE)) $criteria->add(RankingLiveHistoryPeer::TOTAL_AVERAGE, $this->total_average);
		if ($this->isColumnModified(RankingLiveHistoryPeer::ENABLED)) $criteria->add(RankingLiveHistoryPeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(RankingLiveHistoryPeer::CREATED_AT)) $criteria->add(RankingLiveHistoryPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(RankingLiveHistoryPeer::UPDATED_AT)) $criteria->add(RankingLiveHistoryPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RankingLiveHistoryPeer::DATABASE_NAME);

		$criteria->add(RankingLiveHistoryPeer::RANKING_LIVE_ID, $this->ranking_live_id);
		$criteria->add(RankingLiveHistoryPeer::PEOPLE_ID, $this->people_id);
		$criteria->add(RankingLiveHistoryPeer::RANKING_DATE, $this->ranking_date);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getRankingLiveId();

		$pks[1] = $this->getPeopleId();

		$pks[2] = $this->getRankingDate();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setRankingLiveId($keys[0]);

		$this->setPeopleId($keys[1]);

		$this->setRankingDate($keys[2]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setRankingPosition($this->ranking_position);

		$copyObj->setEvents($this->events);

		$copyObj->setScore($this->score);

		$copyObj->setAverage($this->average);

		$copyObj->setPaidValue($this->paid_value);

		$copyObj->setPrizeValue($this->prize_value);

		$copyObj->setBalanceValue($this->balance_value);

		$copyObj->setTotalRankingPosition($this->total_ranking_position);

		$copyObj->setTotalEvents($this->total_events);

		$copyObj->setTotalScore($this->total_score);

		$copyObj->setTotalPaid($this->total_paid);

		$copyObj->setTotalPrize($this->total_prize);

		$copyObj->setTotalBalance($this->total_balance);

		$copyObj->setTotalAverage($this->total_average);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setRankingLiveId(NULL); 
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
			self::$peer = new RankingLiveHistoryPeer();
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