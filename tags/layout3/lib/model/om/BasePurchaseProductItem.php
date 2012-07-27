<?php


abstract class BasePurchaseProductItem extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $purchase_id;


	
	protected $product_item_id;


	
	protected $price = 0;


	
	protected $weight;


	
	protected $quantity;


	
	protected $total_value = 0;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aPurchase;

	
	protected $aProductItem;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getPurchaseId()
	{

		return $this->purchase_id;
	}

	
	public function getProductItemId()
	{

		return $this->product_item_id;
	}

	
	public function getPrice()
	{

		return $this->price;
	}

	
	public function getWeight()
	{

		return $this->weight;
	}

	
	public function getQuantity()
	{

		return $this->quantity;
	}

	
	public function getTotalValue()
	{

		return $this->total_value;
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

	
	public function setPurchaseId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->purchase_id !== $v) {
			$this->purchase_id = $v;
			$this->modifiedColumns[] = PurchaseProductItemPeer::PURCHASE_ID;
		}

		if ($this->aPurchase !== null && $this->aPurchase->getId() !== $v) {
			$this->aPurchase = null;
		}

	} 
	
	public function setProductItemId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->product_item_id !== $v) {
			$this->product_item_id = $v;
			$this->modifiedColumns[] = PurchaseProductItemPeer::PRODUCT_ITEM_ID;
		}

		if ($this->aProductItem !== null && $this->aProductItem->getId() !== $v) {
			$this->aProductItem = null;
		}

	} 
	
	public function setPrice($v)
	{

		if ($this->price !== $v || $v === 0) {
			$this->price = $v;
			$this->modifiedColumns[] = PurchaseProductItemPeer::PRICE;
		}

	} 
	
	public function setWeight($v)
	{

		if ($this->weight !== $v) {
			$this->weight = $v;
			$this->modifiedColumns[] = PurchaseProductItemPeer::WEIGHT;
		}

	} 
	
	public function setQuantity($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->quantity !== $v) {
			$this->quantity = $v;
			$this->modifiedColumns[] = PurchaseProductItemPeer::QUANTITY;
		}

	} 
	
	public function setTotalValue($v)
	{

		if ($this->total_value !== $v || $v === 0) {
			$this->total_value = $v;
			$this->modifiedColumns[] = PurchaseProductItemPeer::TOTAL_VALUE;
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
			$this->modifiedColumns[] = PurchaseProductItemPeer::CREATED_AT;
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
			$this->modifiedColumns[] = PurchaseProductItemPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->purchase_id = $rs->getInt($startcol + 0);

			$this->product_item_id = $rs->getInt($startcol + 1);

			$this->price = $rs->getFloat($startcol + 2);

			$this->weight = $rs->getFloat($startcol + 3);

			$this->quantity = $rs->getInt($startcol + 4);

			$this->total_value = $rs->getFloat($startcol + 5);

			$this->created_at = $rs->getTimestamp($startcol + 6, null);

			$this->updated_at = $rs->getTimestamp($startcol + 7, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PurchaseProductItem object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PurchaseProductItemPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PurchaseProductItemPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(PurchaseProductItemPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(PurchaseProductItemPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PurchaseProductItemPeer::DATABASE_NAME);
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

			if ($this->aProductItem !== null) {
				if ($this->aProductItem->isModified()) {
					$affectedRows += $this->aProductItem->save($con);
				}
				$this->setProductItem($this->aProductItem);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PurchaseProductItemPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += PurchaseProductItemPeer::doUpdate($this, $con);
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

			if ($this->aProductItem !== null) {
				if (!$this->aProductItem->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aProductItem->getValidationFailures());
				}
			}


			if (($retval = PurchaseProductItemPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PurchaseProductItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getPurchaseId();
				break;
			case 1:
				return $this->getProductItemId();
				break;
			case 2:
				return $this->getPrice();
				break;
			case 3:
				return $this->getWeight();
				break;
			case 4:
				return $this->getQuantity();
				break;
			case 5:
				return $this->getTotalValue();
				break;
			case 6:
				return $this->getCreatedAt();
				break;
			case 7:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PurchaseProductItemPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getPurchaseId(),
			$keys[1]=>$this->getProductItemId(),
			$keys[2]=>$this->getPrice(),
			$keys[3]=>$this->getWeight(),
			$keys[4]=>$this->getQuantity(),
			$keys[5]=>$this->getTotalValue(),
			$keys[6]=>$this->getCreatedAt(),
			$keys[7]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PurchaseProductItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setPurchaseId($value);
				break;
			case 1:
				$this->setProductItemId($value);
				break;
			case 2:
				$this->setPrice($value);
				break;
			case 3:
				$this->setWeight($value);
				break;
			case 4:
				$this->setQuantity($value);
				break;
			case 5:
				$this->setTotalValue($value);
				break;
			case 6:
				$this->setCreatedAt($value);
				break;
			case 7:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PurchaseProductItemPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setPurchaseId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setProductItemId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPrice($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setWeight($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setQuantity($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setTotalValue($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCreatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUpdatedAt($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PurchaseProductItemPeer::DATABASE_NAME);

		if ($this->isColumnModified(PurchaseProductItemPeer::PURCHASE_ID)) $criteria->add(PurchaseProductItemPeer::PURCHASE_ID, $this->purchase_id);
		if ($this->isColumnModified(PurchaseProductItemPeer::PRODUCT_ITEM_ID)) $criteria->add(PurchaseProductItemPeer::PRODUCT_ITEM_ID, $this->product_item_id);
		if ($this->isColumnModified(PurchaseProductItemPeer::PRICE)) $criteria->add(PurchaseProductItemPeer::PRICE, $this->price);
		if ($this->isColumnModified(PurchaseProductItemPeer::WEIGHT)) $criteria->add(PurchaseProductItemPeer::WEIGHT, $this->weight);
		if ($this->isColumnModified(PurchaseProductItemPeer::QUANTITY)) $criteria->add(PurchaseProductItemPeer::QUANTITY, $this->quantity);
		if ($this->isColumnModified(PurchaseProductItemPeer::TOTAL_VALUE)) $criteria->add(PurchaseProductItemPeer::TOTAL_VALUE, $this->total_value);
		if ($this->isColumnModified(PurchaseProductItemPeer::CREATED_AT)) $criteria->add(PurchaseProductItemPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(PurchaseProductItemPeer::UPDATED_AT)) $criteria->add(PurchaseProductItemPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PurchaseProductItemPeer::DATABASE_NAME);

		$criteria->add(PurchaseProductItemPeer::PURCHASE_ID, $this->purchase_id);
		$criteria->add(PurchaseProductItemPeer::PRODUCT_ITEM_ID, $this->product_item_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getPurchaseId();

		$pks[1] = $this->getProductItemId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setPurchaseId($keys[0]);

		$this->setProductItemId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setPrice($this->price);

		$copyObj->setWeight($this->weight);

		$copyObj->setQuantity($this->quantity);

		$copyObj->setTotalValue($this->total_value);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setPurchaseId(NULL); 
		$copyObj->setProductItemId(NULL); 
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
			self::$peer = new PurchaseProductItemPeer();
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

	
	public function setProductItem($v)
	{


		if ($v === null) {
			$this->setProductItemId(NULL);
		} else {
			$this->setProductItemId($v->getId());
		}


		$this->aProductItem = $v;
	}


	
	public function getProductItem($con = null)
	{
		if ($this->aProductItem === null && ($this->product_item_id !== null)) {
						include_once 'lib/model/om/BaseProductItemPeer.php';

			$this->aProductItem = ProductItemPeer::retrieveByPK($this->product_item_id, $con);

			
		}
		return $this->aProductItem;
	}

} 