<?php


abstract class BasePurchaseTransaction extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $purchase_id;


	
	protected $transaction_code;


	
	protected $transaction_type;


	
	protected $transaction_status;


	
	protected $paymethod_type;


	
	protected $paymethod_code;


	
	protected $gross_amount;


	
	protected $fee_amount;


	
	protected $net_amount;


	
	protected $escrow_end_date;


	
	protected $extra_amount;


	
	protected $installment_count;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aPurchase;

	
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

	
	public function getTransactionCode()
	{

		return $this->transaction_code;
	}

	
	public function getTransactionType()
	{

		return $this->transaction_type;
	}

	
	public function getTransactionStatus()
	{

		return $this->transaction_status;
	}

	
	public function getPaymethodType()
	{

		return $this->paymethod_type;
	}

	
	public function getPaymethodCode()
	{

		return $this->paymethod_code;
	}

	
	public function getGrossAmount()
	{

		return $this->gross_amount;
	}

	
	public function getFeeAmount()
	{

		return $this->fee_amount;
	}

	
	public function getNetAmount()
	{

		return $this->net_amount;
	}

	
	public function getEscrowEndDate($format = 'Y-m-d')
	{

		if ($this->escrow_end_date === null || $this->escrow_end_date === '') {
			return null;
		} elseif (!is_int($this->escrow_end_date)) {
						$ts = strtotime($this->escrow_end_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [escrow_end_date] as date/time value: " . var_export($this->escrow_end_date, true));
			}
		} else {
			$ts = $this->escrow_end_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getExtraAmount()
	{

		return $this->extra_amount;
	}

	
	public function getInstallmentCount()
	{

		return $this->installment_count;
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
			$this->modifiedColumns[] = PurchaseTransactionPeer::ID;
		}

	} 
	
	public function setPurchaseId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->purchase_id !== $v) {
			$this->purchase_id = $v;
			$this->modifiedColumns[] = PurchaseTransactionPeer::PURCHASE_ID;
		}

		if ($this->aPurchase !== null && $this->aPurchase->getId() !== $v) {
			$this->aPurchase = null;
		}

	} 
	
	public function setTransactionCode($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->transaction_code !== $v) {
			$this->transaction_code = $v;
			$this->modifiedColumns[] = PurchaseTransactionPeer::TRANSACTION_CODE;
		}

	} 
	
	public function setTransactionType($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->transaction_type !== $v) {
			$this->transaction_type = $v;
			$this->modifiedColumns[] = PurchaseTransactionPeer::TRANSACTION_TYPE;
		}

	} 
	
	public function setTransactionStatus($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->transaction_status !== $v) {
			$this->transaction_status = $v;
			$this->modifiedColumns[] = PurchaseTransactionPeer::TRANSACTION_STATUS;
		}

	} 
	
	public function setPaymethodType($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->paymethod_type !== $v) {
			$this->paymethod_type = $v;
			$this->modifiedColumns[] = PurchaseTransactionPeer::PAYMETHOD_TYPE;
		}

	} 
	
	public function setPaymethodCode($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->paymethod_code !== $v) {
			$this->paymethod_code = $v;
			$this->modifiedColumns[] = PurchaseTransactionPeer::PAYMETHOD_CODE;
		}

	} 
	
	public function setGrossAmount($v)
	{

		if ($this->gross_amount !== $v) {
			$this->gross_amount = $v;
			$this->modifiedColumns[] = PurchaseTransactionPeer::GROSS_AMOUNT;
		}

	} 
	
	public function setFeeAmount($v)
	{

		if ($this->fee_amount !== $v) {
			$this->fee_amount = $v;
			$this->modifiedColumns[] = PurchaseTransactionPeer::FEE_AMOUNT;
		}

	} 
	
	public function setNetAmount($v)
	{

		if ($this->net_amount !== $v) {
			$this->net_amount = $v;
			$this->modifiedColumns[] = PurchaseTransactionPeer::NET_AMOUNT;
		}

	} 
	
	public function setEscrowEndDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [escrow_end_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->escrow_end_date !== $ts) {
			$this->escrow_end_date = $ts;
			$this->modifiedColumns[] = PurchaseTransactionPeer::ESCROW_END_DATE;
		}

	} 
	
	public function setExtraAmount($v)
	{

		if ($this->extra_amount !== $v) {
			$this->extra_amount = $v;
			$this->modifiedColumns[] = PurchaseTransactionPeer::EXTRA_AMOUNT;
		}

	} 
	
	public function setInstallmentCount($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->installment_count !== $v) {
			$this->installment_count = $v;
			$this->modifiedColumns[] = PurchaseTransactionPeer::INSTALLMENT_COUNT;
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
			$this->modifiedColumns[] = PurchaseTransactionPeer::CREATED_AT;
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
			$this->modifiedColumns[] = PurchaseTransactionPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->purchase_id = $rs->getInt($startcol + 1);

			$this->transaction_code = $rs->getString($startcol + 2);

			$this->transaction_type = $rs->getInt($startcol + 3);

			$this->transaction_status = $rs->getInt($startcol + 4);

			$this->paymethod_type = $rs->getInt($startcol + 5);

			$this->paymethod_code = $rs->getInt($startcol + 6);

			$this->gross_amount = $rs->getFloat($startcol + 7);

			$this->fee_amount = $rs->getFloat($startcol + 8);

			$this->net_amount = $rs->getFloat($startcol + 9);

			$this->escrow_end_date = $rs->getDate($startcol + 10, null);

			$this->extra_amount = $rs->getFloat($startcol + 11);

			$this->installment_count = $rs->getInt($startcol + 12);

			$this->created_at = $rs->getTimestamp($startcol + 13, null);

			$this->updated_at = $rs->getTimestamp($startcol + 14, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 15; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PurchaseTransaction object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PurchaseTransactionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PurchaseTransactionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(PurchaseTransactionPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(PurchaseTransactionPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PurchaseTransactionPeer::DATABASE_NAME);
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


												
			if ($this->aPurchase !== null) {
				if ($this->aPurchase->isModified()) {
					$affectedRows += $this->aPurchase->save($con);
				}
				$this->setPurchase($this->aPurchase);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PurchaseTransactionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PurchaseTransactionPeer::doUpdate($this, $con);
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


												
			if ($this->aPurchase !== null) {
				if (!$this->aPurchase->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPurchase->getValidationFailures());
				}
			}


			if (($retval = PurchaseTransactionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PurchaseTransactionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getTransactionCode();
				break;
			case 3:
				return $this->getTransactionType();
				break;
			case 4:
				return $this->getTransactionStatus();
				break;
			case 5:
				return $this->getPaymethodType();
				break;
			case 6:
				return $this->getPaymethodCode();
				break;
			case 7:
				return $this->getGrossAmount();
				break;
			case 8:
				return $this->getFeeAmount();
				break;
			case 9:
				return $this->getNetAmount();
				break;
			case 10:
				return $this->getEscrowEndDate();
				break;
			case 11:
				return $this->getExtraAmount();
				break;
			case 12:
				return $this->getInstallmentCount();
				break;
			case 13:
				return $this->getCreatedAt();
				break;
			case 14:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PurchaseTransactionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getPurchaseId(),
			$keys[2]=>$this->getTransactionCode(),
			$keys[3]=>$this->getTransactionType(),
			$keys[4]=>$this->getTransactionStatus(),
			$keys[5]=>$this->getPaymethodType(),
			$keys[6]=>$this->getPaymethodCode(),
			$keys[7]=>$this->getGrossAmount(),
			$keys[8]=>$this->getFeeAmount(),
			$keys[9]=>$this->getNetAmount(),
			$keys[10]=>$this->getEscrowEndDate(),
			$keys[11]=>$this->getExtraAmount(),
			$keys[12]=>$this->getInstallmentCount(),
			$keys[13]=>$this->getCreatedAt(),
			$keys[14]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PurchaseTransactionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setTransactionCode($value);
				break;
			case 3:
				$this->setTransactionType($value);
				break;
			case 4:
				$this->setTransactionStatus($value);
				break;
			case 5:
				$this->setPaymethodType($value);
				break;
			case 6:
				$this->setPaymethodCode($value);
				break;
			case 7:
				$this->setGrossAmount($value);
				break;
			case 8:
				$this->setFeeAmount($value);
				break;
			case 9:
				$this->setNetAmount($value);
				break;
			case 10:
				$this->setEscrowEndDate($value);
				break;
			case 11:
				$this->setExtraAmount($value);
				break;
			case 12:
				$this->setInstallmentCount($value);
				break;
			case 13:
				$this->setCreatedAt($value);
				break;
			case 14:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PurchaseTransactionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPurchaseId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTransactionCode($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTransactionType($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTransactionStatus($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPaymethodType($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPaymethodCode($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setGrossAmount($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setFeeAmount($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setNetAmount($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setEscrowEndDate($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setExtraAmount($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setInstallmentCount($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCreatedAt($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setUpdatedAt($arr[$keys[14]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PurchaseTransactionPeer::DATABASE_NAME);

		if ($this->isColumnModified(PurchaseTransactionPeer::ID)) $criteria->add(PurchaseTransactionPeer::ID, $this->id);
		if ($this->isColumnModified(PurchaseTransactionPeer::PURCHASE_ID)) $criteria->add(PurchaseTransactionPeer::PURCHASE_ID, $this->purchase_id);
		if ($this->isColumnModified(PurchaseTransactionPeer::TRANSACTION_CODE)) $criteria->add(PurchaseTransactionPeer::TRANSACTION_CODE, $this->transaction_code);
		if ($this->isColumnModified(PurchaseTransactionPeer::TRANSACTION_TYPE)) $criteria->add(PurchaseTransactionPeer::TRANSACTION_TYPE, $this->transaction_type);
		if ($this->isColumnModified(PurchaseTransactionPeer::TRANSACTION_STATUS)) $criteria->add(PurchaseTransactionPeer::TRANSACTION_STATUS, $this->transaction_status);
		if ($this->isColumnModified(PurchaseTransactionPeer::PAYMETHOD_TYPE)) $criteria->add(PurchaseTransactionPeer::PAYMETHOD_TYPE, $this->paymethod_type);
		if ($this->isColumnModified(PurchaseTransactionPeer::PAYMETHOD_CODE)) $criteria->add(PurchaseTransactionPeer::PAYMETHOD_CODE, $this->paymethod_code);
		if ($this->isColumnModified(PurchaseTransactionPeer::GROSS_AMOUNT)) $criteria->add(PurchaseTransactionPeer::GROSS_AMOUNT, $this->gross_amount);
		if ($this->isColumnModified(PurchaseTransactionPeer::FEE_AMOUNT)) $criteria->add(PurchaseTransactionPeer::FEE_AMOUNT, $this->fee_amount);
		if ($this->isColumnModified(PurchaseTransactionPeer::NET_AMOUNT)) $criteria->add(PurchaseTransactionPeer::NET_AMOUNT, $this->net_amount);
		if ($this->isColumnModified(PurchaseTransactionPeer::ESCROW_END_DATE)) $criteria->add(PurchaseTransactionPeer::ESCROW_END_DATE, $this->escrow_end_date);
		if ($this->isColumnModified(PurchaseTransactionPeer::EXTRA_AMOUNT)) $criteria->add(PurchaseTransactionPeer::EXTRA_AMOUNT, $this->extra_amount);
		if ($this->isColumnModified(PurchaseTransactionPeer::INSTALLMENT_COUNT)) $criteria->add(PurchaseTransactionPeer::INSTALLMENT_COUNT, $this->installment_count);
		if ($this->isColumnModified(PurchaseTransactionPeer::CREATED_AT)) $criteria->add(PurchaseTransactionPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(PurchaseTransactionPeer::UPDATED_AT)) $criteria->add(PurchaseTransactionPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PurchaseTransactionPeer::DATABASE_NAME);

		$criteria->add(PurchaseTransactionPeer::ID, $this->id);

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

		$copyObj->setTransactionCode($this->transaction_code);

		$copyObj->setTransactionType($this->transaction_type);

		$copyObj->setTransactionStatus($this->transaction_status);

		$copyObj->setPaymethodType($this->paymethod_type);

		$copyObj->setPaymethodCode($this->paymethod_code);

		$copyObj->setGrossAmount($this->gross_amount);

		$copyObj->setFeeAmount($this->fee_amount);

		$copyObj->setNetAmount($this->net_amount);

		$copyObj->setEscrowEndDate($this->escrow_end_date);

		$copyObj->setExtraAmount($this->extra_amount);

		$copyObj->setInstallmentCount($this->installment_count);

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
			self::$peer = new PurchaseTransactionPeer();
		}
		return self::$peer;
	}

	
	public function setPurchase($v)
	{


		if ($v === null) {
			$this->setPurchaseId(NULL);
		} else {
			$this->setPurchaseId($v->getId());
		}


		$this->aPurchase = $v;
	}


	
	public function getPurchase($con = null)
	{
		if ($this->aPurchase === null && ($this->purchase_id !== null)) {
						include_once 'lib/model/om/BasePurchasePeer.php';

			$this->aPurchase = PurchasePeer::retrieveByPK($this->purchase_id, $con);

			
		}
		return $this->aPurchase;
	}

} 