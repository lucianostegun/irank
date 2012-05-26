<?php


abstract class BaseCashTablePlayer extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $cash_table_id;


	
	protected $cash_table_session_id;


	
	protected $people_id;


	
	protected $table_position;


	
	protected $buyin;


	
	protected $entrance_fee;


	
	protected $cash_out;


	
	protected $checkin_at;


	
	protected $checkout_at;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aCashTable;

	
	protected $aCashTableSession;

	
	protected $aPeople;

	
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

	
	public function getPeopleId()
	{

		return $this->people_id;
	}

	
	public function getTablePosition()
	{

		return $this->table_position;
	}

	
	public function getBuyin()
	{

		return $this->buyin;
	}

	
	public function getEntranceFee()
	{

		return $this->entrance_fee;
	}

	
	public function getCashOut()
	{

		return $this->cash_out;
	}

	
	public function getCheckinAt($format = 'Y-m-d H:i:s')
	{

		if ($this->checkin_at === null || $this->checkin_at === '') {
			return null;
		} elseif (!is_int($this->checkin_at)) {
						$ts = strtotime($this->checkin_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [checkin_at] as date/time value: " . var_export($this->checkin_at, true));
			}
		} else {
			$ts = $this->checkin_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getCheckoutAt($format = 'Y-m-d H:i:s')
	{

		if ($this->checkout_at === null || $this->checkout_at === '') {
			return null;
		} elseif (!is_int($this->checkout_at)) {
						$ts = strtotime($this->checkout_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [checkout_at] as date/time value: " . var_export($this->checkout_at, true));
			}
		} else {
			$ts = $this->checkout_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
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
			$this->modifiedColumns[] = CashTablePlayerPeer::ID;
		}

	} 
	
	public function setCashTableId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->cash_table_id !== $v) {
			$this->cash_table_id = $v;
			$this->modifiedColumns[] = CashTablePlayerPeer::CASH_TABLE_ID;
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
			$this->modifiedColumns[] = CashTablePlayerPeer::CASH_TABLE_SESSION_ID;
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
			$this->modifiedColumns[] = CashTablePlayerPeer::PEOPLE_ID;
		}

		if ($this->aPeople !== null && $this->aPeople->getId() !== $v) {
			$this->aPeople = null;
		}

	} 
	
	public function setTablePosition($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->table_position !== $v) {
			$this->table_position = $v;
			$this->modifiedColumns[] = CashTablePlayerPeer::TABLE_POSITION;
		}

	} 
	
	public function setBuyin($v)
	{

		if ($this->buyin !== $v) {
			$this->buyin = $v;
			$this->modifiedColumns[] = CashTablePlayerPeer::BUYIN;
		}

	} 
	
	public function setEntranceFee($v)
	{

		if ($this->entrance_fee !== $v) {
			$this->entrance_fee = $v;
			$this->modifiedColumns[] = CashTablePlayerPeer::ENTRANCE_FEE;
		}

	} 
	
	public function setCashOut($v)
	{

		if ($this->cash_out !== $v) {
			$this->cash_out = $v;
			$this->modifiedColumns[] = CashTablePlayerPeer::CASH_OUT;
		}

	} 
	
	public function setCheckinAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [checkin_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->checkin_at !== $ts) {
			$this->checkin_at = $ts;
			$this->modifiedColumns[] = CashTablePlayerPeer::CHECKIN_AT;
		}

	} 
	
	public function setCheckoutAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [checkout_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->checkout_at !== $ts) {
			$this->checkout_at = $ts;
			$this->modifiedColumns[] = CashTablePlayerPeer::CHECKOUT_AT;
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
			$this->modifiedColumns[] = CashTablePlayerPeer::CREATED_AT;
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
			$this->modifiedColumns[] = CashTablePlayerPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->cash_table_id = $rs->getInt($startcol + 1);

			$this->cash_table_session_id = $rs->getInt($startcol + 2);

			$this->people_id = $rs->getInt($startcol + 3);

			$this->table_position = $rs->getInt($startcol + 4);

			$this->buyin = $rs->getFloat($startcol + 5);

			$this->entrance_fee = $rs->getFloat($startcol + 6);

			$this->cash_out = $rs->getFloat($startcol + 7);

			$this->checkin_at = $rs->getTimestamp($startcol + 8, null);

			$this->checkout_at = $rs->getTimestamp($startcol + 9, null);

			$this->created_at = $rs->getTimestamp($startcol + 10, null);

			$this->updated_at = $rs->getTimestamp($startcol + 11, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating CashTablePlayer object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CashTablePlayerPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			CashTablePlayerPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(CashTablePlayerPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(CashTablePlayerPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CashTablePlayerPeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CashTablePlayerPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += CashTablePlayerPeer::doUpdate($this, $con);
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


			if (($retval = CashTablePlayerPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CashTablePlayerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getPeopleId();
				break;
			case 4:
				return $this->getTablePosition();
				break;
			case 5:
				return $this->getBuyin();
				break;
			case 6:
				return $this->getEntranceFee();
				break;
			case 7:
				return $this->getCashOut();
				break;
			case 8:
				return $this->getCheckinAt();
				break;
			case 9:
				return $this->getCheckoutAt();
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
		$keys = CashTablePlayerPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getCashTableId(),
			$keys[2]=>$this->getCashTableSessionId(),
			$keys[3]=>$this->getPeopleId(),
			$keys[4]=>$this->getTablePosition(),
			$keys[5]=>$this->getBuyin(),
			$keys[6]=>$this->getEntranceFee(),
			$keys[7]=>$this->getCashOut(),
			$keys[8]=>$this->getCheckinAt(),
			$keys[9]=>$this->getCheckoutAt(),
			$keys[10]=>$this->getCreatedAt(),
			$keys[11]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CashTablePlayerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setPeopleId($value);
				break;
			case 4:
				$this->setTablePosition($value);
				break;
			case 5:
				$this->setBuyin($value);
				break;
			case 6:
				$this->setEntranceFee($value);
				break;
			case 7:
				$this->setCashOut($value);
				break;
			case 8:
				$this->setCheckinAt($value);
				break;
			case 9:
				$this->setCheckoutAt($value);
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
		$keys = CashTablePlayerPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCashTableId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCashTableSessionId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPeopleId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTablePosition($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setBuyin($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setEntranceFee($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCashOut($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCheckinAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCheckoutAt($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUpdatedAt($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CashTablePlayerPeer::DATABASE_NAME);

		if ($this->isColumnModified(CashTablePlayerPeer::ID)) $criteria->add(CashTablePlayerPeer::ID, $this->id);
		if ($this->isColumnModified(CashTablePlayerPeer::CASH_TABLE_ID)) $criteria->add(CashTablePlayerPeer::CASH_TABLE_ID, $this->cash_table_id);
		if ($this->isColumnModified(CashTablePlayerPeer::CASH_TABLE_SESSION_ID)) $criteria->add(CashTablePlayerPeer::CASH_TABLE_SESSION_ID, $this->cash_table_session_id);
		if ($this->isColumnModified(CashTablePlayerPeer::PEOPLE_ID)) $criteria->add(CashTablePlayerPeer::PEOPLE_ID, $this->people_id);
		if ($this->isColumnModified(CashTablePlayerPeer::TABLE_POSITION)) $criteria->add(CashTablePlayerPeer::TABLE_POSITION, $this->table_position);
		if ($this->isColumnModified(CashTablePlayerPeer::BUYIN)) $criteria->add(CashTablePlayerPeer::BUYIN, $this->buyin);
		if ($this->isColumnModified(CashTablePlayerPeer::ENTRANCE_FEE)) $criteria->add(CashTablePlayerPeer::ENTRANCE_FEE, $this->entrance_fee);
		if ($this->isColumnModified(CashTablePlayerPeer::CASH_OUT)) $criteria->add(CashTablePlayerPeer::CASH_OUT, $this->cash_out);
		if ($this->isColumnModified(CashTablePlayerPeer::CHECKIN_AT)) $criteria->add(CashTablePlayerPeer::CHECKIN_AT, $this->checkin_at);
		if ($this->isColumnModified(CashTablePlayerPeer::CHECKOUT_AT)) $criteria->add(CashTablePlayerPeer::CHECKOUT_AT, $this->checkout_at);
		if ($this->isColumnModified(CashTablePlayerPeer::CREATED_AT)) $criteria->add(CashTablePlayerPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(CashTablePlayerPeer::UPDATED_AT)) $criteria->add(CashTablePlayerPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CashTablePlayerPeer::DATABASE_NAME);

		$criteria->add(CashTablePlayerPeer::ID, $this->id);

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

		$copyObj->setCashTableId($this->cash_table_id);

		$copyObj->setCashTableSessionId($this->cash_table_session_id);

		$copyObj->setPeopleId($this->people_id);

		$copyObj->setTablePosition($this->table_position);

		$copyObj->setBuyin($this->buyin);

		$copyObj->setEntranceFee($this->entrance_fee);

		$copyObj->setCashOut($this->cash_out);

		$copyObj->setCheckinAt($this->checkin_at);

		$copyObj->setCheckoutAt($this->checkout_at);

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
			self::$peer = new CashTablePlayerPeer();
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

} 