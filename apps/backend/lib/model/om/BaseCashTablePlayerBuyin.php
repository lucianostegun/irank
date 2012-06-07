<?php


abstract class BaseCashTablePlayerBuyin extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $cash_table_id;


	
	protected $cash_table_session_id;


	
	protected $cash_table_player_id;


	
	protected $people_id;


	
	protected $pay_method_id;


	
	protected $club_check_id;


	
	protected $buyin;


	
	protected $entrance_fee;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aCashTable;

	
	protected $aCashTableSession;

	
	protected $aPeople;

	
	protected $aVirtualTable;

	
	protected $aClubCheck;

	
	protected $aCashTablePlayer;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getCashTableId()
	{

		return $this->cash_table_id;
	}

	
	public function getCashTableSessionId()
	{

		return $this->cash_table_session_id;
	}

	
	public function getCashTablePlayerId()
	{

		return $this->cash_table_player_id;
	}

	
	public function getPeopleId()
	{

		return $this->people_id;
	}

	
	public function getPayMethodId()
	{

		return $this->pay_method_id;
	}

	
	public function getClubCheckId()
	{

		return $this->club_check_id;
	}

	
	public function getBuyin()
	{

		return $this->buyin;
	}

	
	public function getEntranceFee()
	{

		return $this->entrance_fee;
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
			$this->modifiedColumns[] = CashTablePlayerBuyinPeer::ID;
		}

	} 
	
	public function setCashTableId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->cash_table_id !== $v) {
			$this->cash_table_id = $v;
			$this->modifiedColumns[] = CashTablePlayerBuyinPeer::CASH_TABLE_ID;
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
			$this->modifiedColumns[] = CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID;
		}

		if ($this->aCashTableSession !== null && $this->aCashTableSession->getId() !== $v) {
			$this->aCashTableSession = null;
		}

	} 
	
	public function setCashTablePlayerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->cash_table_player_id !== $v) {
			$this->cash_table_player_id = $v;
			$this->modifiedColumns[] = CashTablePlayerBuyinPeer::CASH_TABLE_PLAYER_ID;
		}

		if ($this->aCashTablePlayer !== null && $this->aCashTablePlayer->getId() !== $v) {
			$this->aCashTablePlayer = null;
		}

	} 
	
	public function setPeopleId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->people_id !== $v) {
			$this->people_id = $v;
			$this->modifiedColumns[] = CashTablePlayerBuyinPeer::PEOPLE_ID;
		}

		if ($this->aPeople !== null && $this->aPeople->getId() !== $v) {
			$this->aPeople = null;
		}

	} 
	
	public function setPayMethodId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->pay_method_id !== $v) {
			$this->pay_method_id = $v;
			$this->modifiedColumns[] = CashTablePlayerBuyinPeer::PAY_METHOD_ID;
		}

		if ($this->aVirtualTable !== null && $this->aVirtualTable->getId() !== $v) {
			$this->aVirtualTable = null;
		}

	} 
	
	public function setClubCheckId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->club_check_id !== $v) {
			$this->club_check_id = $v;
			$this->modifiedColumns[] = CashTablePlayerBuyinPeer::CLUB_CHECK_ID;
		}

		if ($this->aClubCheck !== null && $this->aClubCheck->getId() !== $v) {
			$this->aClubCheck = null;
		}

	} 
	
	public function setBuyin($v)
	{

		if ($this->buyin !== $v) {
			$this->buyin = $v;
			$this->modifiedColumns[] = CashTablePlayerBuyinPeer::BUYIN;
		}

	} 
	
	public function setEntranceFee($v)
	{

		if ($this->entrance_fee !== $v) {
			$this->entrance_fee = $v;
			$this->modifiedColumns[] = CashTablePlayerBuyinPeer::ENTRANCE_FEE;
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
			$this->modifiedColumns[] = CashTablePlayerBuyinPeer::CREATED_AT;
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
			$this->modifiedColumns[] = CashTablePlayerBuyinPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->cash_table_id = $rs->getInt($startcol + 1);

			$this->cash_table_session_id = $rs->getInt($startcol + 2);

			$this->cash_table_player_id = $rs->getInt($startcol + 3);

			$this->people_id = $rs->getInt($startcol + 4);

			$this->pay_method_id = $rs->getInt($startcol + 5);

			$this->club_check_id = $rs->getInt($startcol + 6);

			$this->buyin = $rs->getFloat($startcol + 7);

			$this->entrance_fee = $rs->getFloat($startcol + 8);

			$this->created_at = $rs->getTimestamp($startcol + 9, null);

			$this->updated_at = $rs->getTimestamp($startcol + 10, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating CashTablePlayerBuyin object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CashTablePlayerBuyinPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			CashTablePlayerBuyinPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(CashTablePlayerBuyinPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(CashTablePlayerBuyinPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CashTablePlayerBuyinPeer::DATABASE_NAME);
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

			if ($this->aVirtualTable !== null) {
				if ($this->aVirtualTable->isModified() || $this->aVirtualTable->getCurrentVirtualTableI18n()->isModified()) {
					$affectedRows += $this->aVirtualTable->save($con);
				}
				$this->setVirtualTable($this->aVirtualTable);
			}

			if ($this->aClubCheck !== null) {
				if ($this->aClubCheck->isModified()) {
					$affectedRows += $this->aClubCheck->save($con);
				}
				$this->setClubCheck($this->aClubCheck);
			}

			if ($this->aCashTablePlayer !== null) {
				if ($this->aCashTablePlayer->isModified()) {
					$affectedRows += $this->aCashTablePlayer->save($con);
				}
				$this->setCashTablePlayer($this->aCashTablePlayer);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CashTablePlayerBuyinPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += CashTablePlayerBuyinPeer::doUpdate($this, $con);
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

			if ($this->aVirtualTable !== null) {
				if (!$this->aVirtualTable->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aVirtualTable->getValidationFailures());
				}
			}

			if ($this->aClubCheck !== null) {
				if (!$this->aClubCheck->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aClubCheck->getValidationFailures());
				}
			}

			if ($this->aCashTablePlayer !== null) {
				if (!$this->aCashTablePlayer->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCashTablePlayer->getValidationFailures());
				}
			}


			if (($retval = CashTablePlayerBuyinPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CashTablePlayerBuyinPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getCashTableId();
				break;
			case 2:
				return $this->getCashTableSessionId();
				break;
			case 3:
				return $this->getCashTablePlayerId();
				break;
			case 4:
				return $this->getPeopleId();
				break;
			case 5:
				return $this->getPayMethodId();
				break;
			case 6:
				return $this->getClubCheckId();
				break;
			case 7:
				return $this->getBuyin();
				break;
			case 8:
				return $this->getEntranceFee();
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
		$keys = CashTablePlayerBuyinPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getCashTableId(),
			$keys[2]=>$this->getCashTableSessionId(),
			$keys[3]=>$this->getCashTablePlayerId(),
			$keys[4]=>$this->getPeopleId(),
			$keys[5]=>$this->getPayMethodId(),
			$keys[6]=>$this->getClubCheckId(),
			$keys[7]=>$this->getBuyin(),
			$keys[8]=>$this->getEntranceFee(),
			$keys[9]=>$this->getCreatedAt(),
			$keys[10]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CashTablePlayerBuyinPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setCashTableId($value);
				break;
			case 2:
				$this->setCashTableSessionId($value);
				break;
			case 3:
				$this->setCashTablePlayerId($value);
				break;
			case 4:
				$this->setPeopleId($value);
				break;
			case 5:
				$this->setPayMethodId($value);
				break;
			case 6:
				$this->setClubCheckId($value);
				break;
			case 7:
				$this->setBuyin($value);
				break;
			case 8:
				$this->setEntranceFee($value);
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
		$keys = CashTablePlayerBuyinPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCashTableId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCashTableSessionId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCashTablePlayerId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPeopleId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPayMethodId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setClubCheckId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setBuyin($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setEntranceFee($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCreatedAt($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setUpdatedAt($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CashTablePlayerBuyinPeer::DATABASE_NAME);

		if ($this->isColumnModified(CashTablePlayerBuyinPeer::ID)) $criteria->add(CashTablePlayerBuyinPeer::ID, $this->id);
		if ($this->isColumnModified(CashTablePlayerBuyinPeer::CASH_TABLE_ID)) $criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_ID, $this->cash_table_id);
		if ($this->isColumnModified(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID)) $criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, $this->cash_table_session_id);
		if ($this->isColumnModified(CashTablePlayerBuyinPeer::CASH_TABLE_PLAYER_ID)) $criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_PLAYER_ID, $this->cash_table_player_id);
		if ($this->isColumnModified(CashTablePlayerBuyinPeer::PEOPLE_ID)) $criteria->add(CashTablePlayerBuyinPeer::PEOPLE_ID, $this->people_id);
		if ($this->isColumnModified(CashTablePlayerBuyinPeer::PAY_METHOD_ID)) $criteria->add(CashTablePlayerBuyinPeer::PAY_METHOD_ID, $this->pay_method_id);
		if ($this->isColumnModified(CashTablePlayerBuyinPeer::CLUB_CHECK_ID)) $criteria->add(CashTablePlayerBuyinPeer::CLUB_CHECK_ID, $this->club_check_id);
		if ($this->isColumnModified(CashTablePlayerBuyinPeer::BUYIN)) $criteria->add(CashTablePlayerBuyinPeer::BUYIN, $this->buyin);
		if ($this->isColumnModified(CashTablePlayerBuyinPeer::ENTRANCE_FEE)) $criteria->add(CashTablePlayerBuyinPeer::ENTRANCE_FEE, $this->entrance_fee);
		if ($this->isColumnModified(CashTablePlayerBuyinPeer::CREATED_AT)) $criteria->add(CashTablePlayerBuyinPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(CashTablePlayerBuyinPeer::UPDATED_AT)) $criteria->add(CashTablePlayerBuyinPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CashTablePlayerBuyinPeer::DATABASE_NAME);

		$criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_ID, $this->cash_table_id);
		$criteria->add(CashTablePlayerBuyinPeer::CASH_TABLE_SESSION_ID, $this->cash_table_session_id);
		$criteria->add(CashTablePlayerBuyinPeer::PEOPLE_ID, $this->people_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCashTableId();

		$pks[1] = $this->getCashTableSessionId();

		$pks[2] = $this->getPeopleId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCashTableId($keys[0]);

		$this->setCashTableSessionId($keys[1]);

		$this->setPeopleId($keys[2]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setId($this->id);

		$copyObj->setCashTablePlayerId($this->cash_table_player_id);

		$copyObj->setPayMethodId($this->pay_method_id);

		$copyObj->setClubCheckId($this->club_check_id);

		$copyObj->setBuyin($this->buyin);

		$copyObj->setEntranceFee($this->entrance_fee);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setCashTableId(NULL); 
		$copyObj->setCashTableSessionId(NULL); 
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
			self::$peer = new CashTablePlayerBuyinPeer();
		}
		return self::$peer;
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

	
	public function setVirtualTable($v)
	{


		if ($v === null) {
			$this->setPayMethodId(NULL);
		} else {
			$this->setPayMethodId($v->getId());
		}


		$this->aVirtualTable = $v;
	}


	
	public function getVirtualTable($con = null)
	{
		if ($this->aVirtualTable === null && ($this->pay_method_id !== null)) {
						include_once 'lib/model/om/BaseVirtualTablePeer.php';

			$this->aVirtualTable = VirtualTablePeer::retrieveByPK($this->pay_method_id, $con);

			
		}
		return $this->aVirtualTable;
	}

	
	public function setClubCheck($v)
	{


		if ($v === null) {
			$this->setClubCheckId(NULL);
		} else {
			$this->setClubCheckId($v->getId());
		}


		$this->aClubCheck = $v;
	}


	
	public function getClubCheck($con = null)
	{
		if ($this->aClubCheck === null && ($this->club_check_id !== null)) {
						include_once 'apps/backend/lib/model/om/BaseClubCheckPeer.php';

			$this->aClubCheck = ClubCheckPeer::retrieveByPK($this->club_check_id, $con);

			
		}
		return $this->aClubCheck;
	}

	
	public function setCashTablePlayer($v)
	{


		if ($v === null) {
			$this->setCashTablePlayerId(NULL);
		} else {
			$this->setCashTablePlayerId($v->getId());
		}


		$this->aCashTablePlayer = $v;
	}


	
	public function getCashTablePlayer($con = null)
	{
		if ($this->aCashTablePlayer === null && ($this->cash_table_player_id !== null)) {
						include_once 'apps/backend/lib/model/om/BaseCashTablePlayerPeer.php';

			$this->aCashTablePlayer = CashTablePlayerPeer::retrieveByPK($this->cash_table_player_id, $con);

			
		}
		return $this->aCashTablePlayer;
	}

} 