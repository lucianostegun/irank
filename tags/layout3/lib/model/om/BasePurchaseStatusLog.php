<?php


abstract class BasePurchaseStatusLog extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $purchase_id;


	
	protected $transaction_date;


	
	protected $transaction_code;


	
	protected $transaction_status;


	
	protected $order_status;


	
	protected $paymethod_type;


	
	protected $extra_amount;


	
	protected $installment_count;


	
	protected $change_source;


	
	protected $created_at;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getPurchaseId()
	{

		return $this->purchase_id;
	}

	
	public function getTransactionDate($format = 'Y-m-d H:i:s')
	{

		if ($this->transaction_date === null || $this->transaction_date === '') {
			return null;
		} elseif (!is_int($this->transaction_date)) {
						$ts = strtotime($this->transaction_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [transaction_date] as date/time value: " . var_export($this->transaction_date, true));
			}
		} else {
			$ts = $this->transaction_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getTransactionCode()
	{

		return $this->transaction_code;
	}

	
	public function getTransactionStatus()
	{

		return $this->transaction_status;
	}

	
	public function getOrderStatus()
	{

		return $this->order_status;
	}

	
	public function getPaymethodType()
	{

		return $this->paymethod_type;
	}

	
	public function getExtraAmount()
	{

		return $this->extra_amount;
	}

	
	public function getInstallmentCount()
	{

		return $this->installment_count;
	}

	
	public function getChangeSource()
	{

		return $this->change_source;
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
			$this->modifiedColumns[] = PurchaseStatusLogPeer::ID;
		}

	} 
	
	public function setPurchaseId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->purchase_id !== $v) {
			$this->purchase_id = $v;
			$this->modifiedColumns[] = PurchaseStatusLogPeer::PURCHASE_ID;
		}

	} 
	
	public function setTransactionDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [transaction_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->transaction_date !== $ts) {
			$this->transaction_date = $ts;
			$this->modifiedColumns[] = PurchaseStatusLogPeer::TRANSACTION_DATE;
		}

	} 
	
	public function setTransactionCode($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->transaction_code !== $v) {
			$this->transaction_code = $v;
			$this->modifiedColumns[] = PurchaseStatusLogPeer::TRANSACTION_CODE;
		}

	} 
	
	public function setTransactionStatus($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->transaction_status !== $v) {
			$this->transaction_status = $v;
			$this->modifiedColumns[] = PurchaseStatusLogPeer::TRANSACTION_STATUS;
		}

	} 
	
	public function setOrderStatus($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->order_status !== $v) {
			$this->order_status = $v;
			$this->modifiedColumns[] = PurchaseStatusLogPeer::ORDER_STATUS;
		}

	} 
	
	public function setPaymethodType($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->paymethod_type !== $v) {
			$this->paymethod_type = $v;
			$this->modifiedColumns[] = PurchaseStatusLogPeer::PAYMETHOD_TYPE;
		}

	} 
	
	public function setExtraAmount($v)
	{

		if ($this->extra_amount !== $v) {
			$this->extra_amount = $v;
			$this->modifiedColumns[] = PurchaseStatusLogPeer::EXTRA_AMOUNT;
		}

	} 
	
	public function setInstallmentCount($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->installment_count !== $v) {
			$this->installment_count = $v;
			$this->modifiedColumns[] = PurchaseStatusLogPeer::INSTALLMENT_COUNT;
		}

	} 
	
	public function setChangeSource($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->change_source !== $v) {
			$this->change_source = $v;
			$this->modifiedColumns[] = PurchaseStatusLogPeer::CHANGE_SOURCE;
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
			$this->modifiedColumns[] = PurchaseStatusLogPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->purchase_id = $rs->getInt($startcol + 1);

			$this->transaction_date = $rs->getTimestamp($startcol + 2, null);

			$this->transaction_code = $rs->getString($startcol + 3);

			$this->transaction_status = $rs->getString($startcol + 4);

			$this->order_status = $rs->getString($startcol + 5);

			$this->paymethod_type = $rs->getString($startcol + 6);

			$this->extra_amount = $rs->getFloat($startcol + 7);

			$this->installment_count = $rs->getInt($startcol + 8);

			$this->change_source = $rs->getString($startcol + 9);

			$this->created_at = $rs->getTimestamp($startcol + 10, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PurchaseStatusLog object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PurchaseStatusLogPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PurchaseStatusLogPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(PurchaseStatusLogPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if( $this->isDeleted() )
			throw new PropelException("You cannot save an object that has been deleted.");

		if( $con === null )
			$con = Propel::getConnection(PurchaseStatusLogPeer::DATABASE_NAME);

		$tableName = PurchaseStatusLogPeer::TABLE_NAME;
		
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PurchaseStatusLogPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PurchaseStatusLogPeer::doUpdate($this, $con);
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


			if (($retval = PurchaseStatusLogPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PurchaseStatusLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getPurchaseId();
				break;
			case 2:
				return $this->getTransactionDate();
				break;
			case 3:
				return $this->getTransactionCode();
				break;
			case 4:
				return $this->getTransactionStatus();
				break;
			case 5:
				return $this->getOrderStatus();
				break;
			case 6:
				return $this->getPaymethodType();
				break;
			case 7:
				return $this->getExtraAmount();
				break;
			case 8:
				return $this->getInstallmentCount();
				break;
			case 9:
				return $this->getChangeSource();
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
		$keys = PurchaseStatusLogPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getPurchaseId(),
			$keys[2]=>$this->getTransactionDate(),
			$keys[3]=>$this->getTransactionCode(),
			$keys[4]=>$this->getTransactionStatus(),
			$keys[5]=>$this->getOrderStatus(),
			$keys[6]=>$this->getPaymethodType(),
			$keys[7]=>$this->getExtraAmount(),
			$keys[8]=>$this->getInstallmentCount(),
			$keys[9]=>$this->getChangeSource(),
			$keys[10]=>$this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PurchaseStatusLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setPurchaseId($value);
				break;
			case 2:
				$this->setTransactionDate($value);
				break;
			case 3:
				$this->setTransactionCode($value);
				break;
			case 4:
				$this->setTransactionStatus($value);
				break;
			case 5:
				$this->setOrderStatus($value);
				break;
			case 6:
				$this->setPaymethodType($value);
				break;
			case 7:
				$this->setExtraAmount($value);
				break;
			case 8:
				$this->setInstallmentCount($value);
				break;
			case 9:
				$this->setChangeSource($value);
				break;
			case 10:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PurchaseStatusLogPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPurchaseId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTransactionDate($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTransactionCode($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTransactionStatus($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setOrderStatus($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPaymethodType($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setExtraAmount($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setInstallmentCount($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setChangeSource($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PurchaseStatusLogPeer::DATABASE_NAME);

		if ($this->isColumnModified(PurchaseStatusLogPeer::ID)) $criteria->add(PurchaseStatusLogPeer::ID, $this->id);
		if ($this->isColumnModified(PurchaseStatusLogPeer::PURCHASE_ID)) $criteria->add(PurchaseStatusLogPeer::PURCHASE_ID, $this->purchase_id);
		if ($this->isColumnModified(PurchaseStatusLogPeer::TRANSACTION_DATE)) $criteria->add(PurchaseStatusLogPeer::TRANSACTION_DATE, $this->transaction_date);
		if ($this->isColumnModified(PurchaseStatusLogPeer::TRANSACTION_CODE)) $criteria->add(PurchaseStatusLogPeer::TRANSACTION_CODE, $this->transaction_code);
		if ($this->isColumnModified(PurchaseStatusLogPeer::TRANSACTION_STATUS)) $criteria->add(PurchaseStatusLogPeer::TRANSACTION_STATUS, $this->transaction_status);
		if ($this->isColumnModified(PurchaseStatusLogPeer::ORDER_STATUS)) $criteria->add(PurchaseStatusLogPeer::ORDER_STATUS, $this->order_status);
		if ($this->isColumnModified(PurchaseStatusLogPeer::PAYMETHOD_TYPE)) $criteria->add(PurchaseStatusLogPeer::PAYMETHOD_TYPE, $this->paymethod_type);
		if ($this->isColumnModified(PurchaseStatusLogPeer::EXTRA_AMOUNT)) $criteria->add(PurchaseStatusLogPeer::EXTRA_AMOUNT, $this->extra_amount);
		if ($this->isColumnModified(PurchaseStatusLogPeer::INSTALLMENT_COUNT)) $criteria->add(PurchaseStatusLogPeer::INSTALLMENT_COUNT, $this->installment_count);
		if ($this->isColumnModified(PurchaseStatusLogPeer::CHANGE_SOURCE)) $criteria->add(PurchaseStatusLogPeer::CHANGE_SOURCE, $this->change_source);
		if ($this->isColumnModified(PurchaseStatusLogPeer::CREATED_AT)) $criteria->add(PurchaseStatusLogPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PurchaseStatusLogPeer::DATABASE_NAME);

		$criteria->add(PurchaseStatusLogPeer::ID, $this->id);

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

		$copyObj->setPurchaseId($this->purchase_id);

		$copyObj->setTransactionDate($this->transaction_date);

		$copyObj->setTransactionCode($this->transaction_code);

		$copyObj->setTransactionStatus($this->transaction_status);

		$copyObj->setOrderStatus($this->order_status);

		$copyObj->setPaymethodType($this->paymethod_type);

		$copyObj->setExtraAmount($this->extra_amount);

		$copyObj->setInstallmentCount($this->installment_count);

		$copyObj->setChangeSource($this->change_source);

		$copyObj->setCreatedAt($this->created_at);


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
			self::$peer = new PurchaseStatusLogPeer();
		}
		return self::$peer;
	}

} 