<?php


abstract class BaseClubCheck extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $club_id;


	
	protected $cash_table_id;


	
	protected $cash_table_session_id;


	
	protected $people_id;


	
	protected $check_number;


	
	protected $check_nominal;


	
	protected $check_bank;


	
	protected $check_date;


	
	protected $is_pending = true;


	
	protected $created_at;

	
	protected $aClub;

	
	protected $aCashTable;

	
	protected $aCashTableSession;

	
	protected $aPeople;

	
	protected $collCashTablePlayerBuyinList;

	
	protected $lastCashTablePlayerBuyinCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getClubId()
	{

		return $this->club_id;
	}

	
	public function getCashTableId()
	{

		return $this->cash_table_id;
	}

	
	public function getCashTableSessionId()
	{

		return $this->cash_table_session_id;
	}

	
	public function getPeopleId()
	{

		return $this->people_id;
	}

	
	public function getCheckNumber()
	{

		return $this->check_number;
	}

	
	public function getCheckNominal()
	{

		return $this->check_nominal;
	}

	
	public function getCheckBank()
	{

		return $this->check_bank;
	}

	
	public function getCheckDate($format = 'Y-m-d')
	{

		if ($this->check_date === null || $this->check_date === '') {
			return null;
		} elseif (!is_int($this->check_date)) {
						$ts = strtotime($this->check_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [check_date] as date/time value: " . var_export($this->check_date, true));
			}
		} else {
			$ts = $this->check_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getIsPending()
	{

		return $this->is_pending;
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
			$this->modifiedColumns[] = ClubCheckPeer::ID;
		}

	} 
	
	public function setClubId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->club_id !== $v) {
			$this->club_id = $v;
			$this->modifiedColumns[] = ClubCheckPeer::CLUB_ID;
		}

		if ($this->aClub !== null && $this->aClub->getId() !== $v) {
			$this->aClub = null;
		}

	} 
	
	public function setCashTableId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->cash_table_id !== $v) {
			$this->cash_table_id = $v;
			$this->modifiedColumns[] = ClubCheckPeer::CASH_TABLE_ID;
		}

		if ($this->aCashTable !== null && $this->aCashTable->getId() !== $v) {
			$this->aCashTable = null;
		}

	} 
	
	public function setCashTableSessionId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->cash_table_session_id !== $v) {
			$this->cash_table_session_id = $v;
			$this->modifiedColumns[] = ClubCheckPeer::CASH_TABLE_SESSION_ID;
		}

		if ($this->aCashTableSession !== null && $this->aCashTableSession->getId() !== $v) {
			$this->aCashTableSession = null;
		}

	} 
	
	public function setPeopleId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->people_id !== $v) {
			$this->people_id = $v;
			$this->modifiedColumns[] = ClubCheckPeer::PEOPLE_ID;
		}

		if ($this->aPeople !== null && $this->aPeople->getId() !== $v) {
			$this->aPeople = null;
		}

	} 
	
	public function setCheckNumber($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->check_number !== $v) {
			$this->check_number = $v;
			$this->modifiedColumns[] = ClubCheckPeer::CHECK_NUMBER;
		}

	} 
	
	public function setCheckNominal($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->check_nominal !== $v) {
			$this->check_nominal = $v;
			$this->modifiedColumns[] = ClubCheckPeer::CHECK_NOMINAL;
		}

	} 
	
	public function setCheckBank($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->check_bank !== $v) {
			$this->check_bank = $v;
			$this->modifiedColumns[] = ClubCheckPeer::CHECK_BANK;
		}

	} 
	
	public function setCheckDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [check_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->check_date !== $ts) {
			$this->check_date = $ts;
			$this->modifiedColumns[] = ClubCheckPeer::CHECK_DATE;
		}

	} 
	
	public function setIsPending($v)
	{

		if ($this->is_pending !== $v || $v === true) {
			$this->is_pending = $v;
			$this->modifiedColumns[] = ClubCheckPeer::IS_PENDING;
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
			$this->modifiedColumns[] = ClubCheckPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->club_id = $rs->getInt($startcol + 1);

			$this->cash_table_id = $rs->getInt($startcol + 2);

			$this->cash_table_session_id = $rs->getInt($startcol + 3);

			$this->people_id = $rs->getInt($startcol + 4);

			$this->check_number = $rs->getString($startcol + 5);

			$this->check_nominal = $rs->getString($startcol + 6);

			$this->check_bank = $rs->getString($startcol + 7);

			$this->check_date = $rs->getDate($startcol + 8, null);

			$this->is_pending = $rs->getBoolean($startcol + 9);

			$this->created_at = $rs->getTimestamp($startcol + 10, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ClubCheck object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ClubCheckPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ClubCheckPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(ClubCheckPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ClubCheckPeer::DATABASE_NAME);
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


												
			if ($this->aClub !== null) {
				if ($this->aClub->isModified()) {
					$affectedRows += $this->aClub->save($con);
				}
				$this->setClub($this->aClub);
			}

			if ($this->aCashTable !== null) {
				if ($this->aCashTable->isModified()) {
					$affectedRows += $this->aCashTable->save($con);
				}
				$this->setCashTable($this->aCashTable);
			}

			if ($this->aCashTableSession !== null) {
				if ($this->aCashTableSession->isModified()) {
					$affectedRows += $this->aCashTableSession->save($con);
				}
				$this->setCashTableSession($this->aCashTableSession);
			}

			if ($this->aPeople !== null) {
				if ($this->aPeople->isModified()) {
					$affectedRows += $this->aPeople->save($con);
				}
				$this->setPeople($this->aPeople);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ClubCheckPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ClubCheckPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collCashTablePlayerBuyinList !== null) {
				foreach($this->collCashTablePlayerBuyinList as $referrerFK) {
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


												
			if ($this->aClub !== null) {
				if (!$this->aClub->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aClub->getValidationFailures());
				}
			}

			if ($this->aCashTable !== null) {
				if (!$this->aCashTable->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCashTable->getValidationFailures());
				}
			}

			if ($this->aCashTableSession !== null) {
				if (!$this->aCashTableSession->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCashTableSession->getValidationFailures());
				}
			}

			if ($this->aPeople !== null) {
				if (!$this->aPeople->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPeople->getValidationFailures());
				}
			}


			if (($retval = ClubCheckPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCashTablePlayerBuyinList !== null) {
					foreach($this->collCashTablePlayerBuyinList as $referrerFK) {
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
		$pos = ClubCheckPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getClubId();
				break;
			case 2:
				return $this->getCashTableId();
				break;
			case 3:
				return $this->getCashTableSessionId();
				break;
			case 4:
				return $this->getPeopleId();
				break;
			case 5:
				return $this->getCheckNumber();
				break;
			case 6:
				return $this->getCheckNominal();
				break;
			case 7:
				return $this->getCheckBank();
				break;
			case 8:
				return $this->getCheckDate();
				break;
			case 9:
				return $this->getIsPending();
				break;
			case 10:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ClubCheckPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getClubId(),
			$keys[2]=>$this->getCashTableId(),
			$keys[3]=>$this->getCashTableSessionId(),
			$keys[4]=>$this->getPeopleId(),
			$keys[5]=>$this->getCheckNumber(),
			$keys[6]=>$this->getCheckNominal(),
			$keys[7]=>$this->getCheckBank(),
			$keys[8]=>$this->getCheckDate(),
			$keys[9]=>$this->getIsPending(),
			$keys[10]=>$this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ClubCheckPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setClubId($value);
				break;
			case 2:
				$this->setCashTableId($value);
				break;
			case 3:
				$this->setCashTableSessionId($value);
				break;
			case 4:
				$this->setPeopleId($value);
				break;
			case 5:
				$this->setCheckNumber($value);
				break;
			case 6:
				$this->setCheckNominal($value);
				break;
			case 7:
				$this->setCheckBank($value);
				break;
			case 8:
				$this->setCheckDate($value);
				break;
			case 9:
				$this->setIsPending($value);
				break;
			case 10:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ClubCheckPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setClubId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCashTableId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCashTableSessionId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPeopleId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCheckNumber($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCheckNominal($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCheckBank($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCheckDate($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setIsPending($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ClubCheckPeer::DATABASE_NAME);

		if ($this->isColumnModified(ClubCheckPeer::ID)) $criteria->add(ClubCheckPeer::ID, $this->id);
		if ($this->isColumnModified(ClubCheckPeer::CLUB_ID)) $criteria->add(ClubCheckPeer::CLUB_ID, $this->club_id);
		if ($this->isColumnModified(ClubCheckPeer::CASH_TABLE_ID)) $criteria->add(ClubCheckPeer::CASH_TABLE_ID, $this->cash_table_id);
		if ($this->isColumnModified(ClubCheckPeer::CASH_TABLE_SESSION_ID)) $criteria->add(ClubCheckPeer::CASH_TABLE_SESSION_ID, $this->cash_table_session_id);
		if ($this->isColumnModified(ClubCheckPeer::PEOPLE_ID)) $criteria->add(ClubCheckPeer::PEOPLE_ID, $this->people_id);
		if ($this->isColumnModified(ClubCheckPeer::CHECK_NUMBER)) $criteria->add(ClubCheckPeer::CHECK_NUMBER, $this->check_number);
		if ($this->isColumnModified(ClubCheckPeer::CHECK_NOMINAL)) $criteria->add(ClubCheckPeer::CHECK_NOMINAL, $this->check_nominal);
		if ($this->isColumnModified(ClubCheckPeer::CHECK_BANK)) $criteria->add(ClubCheckPeer::CHECK_BANK, $this->check_bank);
		if ($this->isColumnModified(ClubCheckPeer::CHECK_DATE)) $criteria->add(ClubCheckPeer::CHECK_DATE, $this->check_date);
		if ($this->isColumnModified(ClubCheckPeer::IS_PENDING)) $criteria->add(ClubCheckPeer::IS_PENDING, $this->is_pending);
		if ($this->isColumnModified(ClubCheckPeer::CREATED_AT)) $criteria->add(ClubCheckPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ClubCheckPeer::DATABASE_NAME);

		$criteria->add(ClubCheckPeer::ID, $this->id);

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

		$copyObj->setClubId($this->club_id);

		$copyObj->setCashTableId($this->cash_table_id);

		$copyObj->setCashTableSessionId($this->cash_table_session_id);

		$copyObj->setPeopleId($this->people_id);

		$copyObj->setCheckNumber($this->check_number);

		$copyObj->setCheckNominal($this->check_nominal);

		$copyObj->setCheckBank($this->check_bank);

		$copyObj->setCheckDate($this->check_date);

		$copyObj->setIsPending($this->is_pending);

		$copyObj->setCreatedAt($this->created_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getCashTablePlayerBuyinList() as $relObj) {
				$copyObj->addCashTablePlayerBuyin($relObj->copy($deepCopy));
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
			self::$peer = new ClubCheckPeer();
		}
		return self::$peer;
	}

	
	public function setClub($v)
	{


		if ($v === null) {
			$this->setClubId(NULL);
		} else {
			$this->setClubId($v->getId());
		}


		$this->aClub = $v;
	}


	
	public function getClub($con = null)
	{
		if ($this->aClub === null && ($this->club_id !== null)) {
						include_once 'lib/model/om/BaseClubPeer.php';

			$this->aClub = ClubPeer::retrieveByPK($this->club_id, $con);

			
		}
		return $this->aClub;
	}

	
	public function setCashTable($v)
	{


		if ($v === null) {
			$this->setCashTableId(NULL);
		} else {
			$this->setCashTableId($v->getId());
		}


		$this->aCashTable = $v;
	}


	
	public function getCashTable($con = null)
	{
		if ($this->aCashTable === null && ($this->cash_table_id !== null)) {
						include_once 'apps/backend/lib/model/om/BaseCashTablePeer.php';

			$this->aCashTable = CashTablePeer::retrieveByPK($this->cash_table_id, $con);

			
		}
		return $this->aCashTable;
	}

	
	public function setCashTableSession($v)
	{


		if ($v === null) {
			$this->setCashTableSessionId(NULL);
		} else {
			$this->setCashTableSessionId($v->getId());
		}


		$this->aCashTableSession = $v;
	}


	
	public function getCashTableSession($con = null)
	{
		if ($this->aCashTableSession === null && ($this->cash_table_session_id !== null)) {
						include_once 'apps/backend/lib/model/om/BaseCashTableSessionPeer.php';

			$this->aCashTableSession = CashTableSessionPeer::retrieveByPK($this->cash_table_session_id, $con);

			
		}
		return $this->aCashTableSession;
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

	
	public function initCashTablePlayerBuyinList()
	{
		if ($this->collCashTablePlayerBuyinList === null) {
			$this->collCashTablePlayerBuyinList = array();
		}
	}

	
	public function getCashTablePlayerBuyinList($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePlayerBuyinPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTablePlayerBuyinList === null) {
			if ($this->isNew()) {
			   $this->collCashTablePlayerBuyinList = array();
			} else {

				$criteria->add(CashTablePlayerBuyinPeer::CLUB_CHECK_ID, $this->getId());

				CashTablePlayerBuyinPeer::addSelectColumns($criteria);
				$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CashTablePlayerBuyinPeer::CLUB_CHECK_ID, $this->getId());

				CashTablePlayerBuyinPeer::addSelectColumns($criteria);
				if (!isset($this->lastCashTablePlayerBuyinCriteria) || !$this->lastCashTablePlayerBuyinCriteria->equals($criteria)) {
					$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCashTablePlayerBuyinCriteria = $criteria;
		return $this->collCashTablePlayerBuyinList;
	}

	
	public function countCashTablePlayerBuyinList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePlayerBuyinPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CashTablePlayerBuyinPeer::CLUB_CHECK_ID, $this->getId());

		return CashTablePlayerBuyinPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCashTablePlayerBuyin(CashTablePlayerBuyin $l)
	{
		$this->collCashTablePlayerBuyinList[] = $l;
		$l->setClubCheck($this);
	}


	
	public function getCashTablePlayerBuyinListJoinCashTable($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePlayerBuyinPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTablePlayerBuyinList === null) {
			if ($this->isNew()) {
				$this->collCashTablePlayerBuyinList = array();
			} else {

				$criteria->add(CashTablePlayerBuyinPeer::CLUB_CHECK_ID, $this->getId());

				$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelectJoinCashTable($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTablePlayerBuyinPeer::CLUB_CHECK_ID, $this->getId());

			if (!isset($this->lastCashTablePlayerBuyinCriteria) || !$this->lastCashTablePlayerBuyinCriteria->equals($criteria)) {
				$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelectJoinCashTable($criteria, $con);
			}
		}
		$this->lastCashTablePlayerBuyinCriteria = $criteria;

		return $this->collCashTablePlayerBuyinList;
	}


	
	public function getCashTablePlayerBuyinListJoinCashTableSession($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePlayerBuyinPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTablePlayerBuyinList === null) {
			if ($this->isNew()) {
				$this->collCashTablePlayerBuyinList = array();
			} else {

				$criteria->add(CashTablePlayerBuyinPeer::CLUB_CHECK_ID, $this->getId());

				$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelectJoinCashTableSession($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTablePlayerBuyinPeer::CLUB_CHECK_ID, $this->getId());

			if (!isset($this->lastCashTablePlayerBuyinCriteria) || !$this->lastCashTablePlayerBuyinCriteria->equals($criteria)) {
				$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelectJoinCashTableSession($criteria, $con);
			}
		}
		$this->lastCashTablePlayerBuyinCriteria = $criteria;

		return $this->collCashTablePlayerBuyinList;
	}


	
	public function getCashTablePlayerBuyinListJoinPeople($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePlayerBuyinPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTablePlayerBuyinList === null) {
			if ($this->isNew()) {
				$this->collCashTablePlayerBuyinList = array();
			} else {

				$criteria->add(CashTablePlayerBuyinPeer::CLUB_CHECK_ID, $this->getId());

				$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelectJoinPeople($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTablePlayerBuyinPeer::CLUB_CHECK_ID, $this->getId());

			if (!isset($this->lastCashTablePlayerBuyinCriteria) || !$this->lastCashTablePlayerBuyinCriteria->equals($criteria)) {
				$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelectJoinPeople($criteria, $con);
			}
		}
		$this->lastCashTablePlayerBuyinCriteria = $criteria;

		return $this->collCashTablePlayerBuyinList;
	}


	
	public function getCashTablePlayerBuyinListJoinVirtualTable($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseCashTablePlayerBuyinPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCashTablePlayerBuyinList === null) {
			if ($this->isNew()) {
				$this->collCashTablePlayerBuyinList = array();
			} else {

				$criteria->add(CashTablePlayerBuyinPeer::CLUB_CHECK_ID, $this->getId());

				$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelectJoinVirtualTable($criteria, $con);
			}
		} else {
									
			$criteria->add(CashTablePlayerBuyinPeer::CLUB_CHECK_ID, $this->getId());

			if (!isset($this->lastCashTablePlayerBuyinCriteria) || !$this->lastCashTablePlayerBuyinCriteria->equals($criteria)) {
				$this->collCashTablePlayerBuyinList = CashTablePlayerBuyinPeer::doSelectJoinVirtualTable($criteria, $con);
			}
		}
		$this->lastCashTablePlayerBuyinCriteria = $criteria;

		return $this->collCashTablePlayerBuyinList;
	}

} 