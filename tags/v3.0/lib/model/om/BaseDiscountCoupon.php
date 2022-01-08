<?php


abstract class BaseDiscountCoupon extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $coupon_code;


	
	protected $discount_rule = '{}';


	
	protected $purchase_id;


	
	protected $is_active;


	
	protected $has_used;


	
	protected $enabled;


	
	protected $visible;


	
	protected $deleted;


	
	protected $locked;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aPurchase;

	
	protected $collPurchaseList;

	
	protected $lastPurchaseCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getCouponCode()
	{

		return $this->coupon_code;
	}

	
	public function getDiscountRule()
	{

		return $this->discount_rule;
	}

	
	public function getPurchaseId()
	{

		return $this->purchase_id;
	}

	
	public function getIsActive()
	{

		return $this->is_active;
	}

	
	public function getHasUsed()
	{

		return $this->has_used;
	}

	
	public function getEnabled()
	{

		return $this->enabled;
	}

	
	public function getVisible()
	{

		return $this->visible;
	}

	
	public function getDeleted()
	{

		return $this->deleted;
	}

	
	public function getLocked()
	{

		return $this->locked;
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
			$this->modifiedColumns[] = DiscountCouponPeer::ID;
		}

	} 
	
	public function setCouponCode($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->coupon_code !== $v) {
			$this->coupon_code = $v;
			$this->modifiedColumns[] = DiscountCouponPeer::COUPON_CODE;
		}

	} 
	
	public function setDiscountRule($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->discount_rule !== $v || $v === '{}') {
			$this->discount_rule = $v;
			$this->modifiedColumns[] = DiscountCouponPeer::DISCOUNT_RULE;
		}

	} 
	
	public function setPurchaseId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->purchase_id !== $v) {
			$this->purchase_id = $v;
			$this->modifiedColumns[] = DiscountCouponPeer::PURCHASE_ID;
		}

		if ($this->aPurchase !== null && $this->aPurchase->getId() !== $v) {
			$this->aPurchase = null;
		}

	} 
	
	public function setIsActive($v)
	{

		if ($this->is_active !== $v) {
			$this->is_active = $v;
			$this->modifiedColumns[] = DiscountCouponPeer::IS_ACTIVE;
		}

	} 
	
	public function setHasUsed($v)
	{

		if ($this->has_used !== $v) {
			$this->has_used = $v;
			$this->modifiedColumns[] = DiscountCouponPeer::HAS_USED;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = DiscountCouponPeer::ENABLED;
		}

	} 
	
	public function setVisible($v)
	{

		if ($this->visible !== $v) {
			$this->visible = $v;
			$this->modifiedColumns[] = DiscountCouponPeer::VISIBLE;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = DiscountCouponPeer::DELETED;
		}

	} 
	
	public function setLocked($v)
	{

		if ($this->locked !== $v) {
			$this->locked = $v;
			$this->modifiedColumns[] = DiscountCouponPeer::LOCKED;
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
			$this->modifiedColumns[] = DiscountCouponPeer::CREATED_AT;
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
			$this->modifiedColumns[] = DiscountCouponPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->coupon_code = $rs->getString($startcol + 1);

			$this->discount_rule = $rs->getString($startcol + 2);

			$this->purchase_id = $rs->getInt($startcol + 3);

			$this->is_active = $rs->getBoolean($startcol + 4);

			$this->has_used = $rs->getBoolean($startcol + 5);

			$this->enabled = $rs->getBoolean($startcol + 6);

			$this->visible = $rs->getBoolean($startcol + 7);

			$this->deleted = $rs->getBoolean($startcol + 8);

			$this->locked = $rs->getBoolean($startcol + 9);

			$this->created_at = $rs->getTimestamp($startcol + 10, null);

			$this->updated_at = $rs->getTimestamp($startcol + 11, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating DiscountCoupon object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DiscountCouponPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DiscountCouponPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(DiscountCouponPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(DiscountCouponPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if( $this->isDeleted() )
			throw new PropelException("You cannot save an object that has been deleted.");

		if( $con === null )
			$con = Propel::getConnection(DiscountCouponPeer::DATABASE_NAME);

		$tableName = DiscountCouponPeer::TABLE_NAME;
		
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


												
			if ($this->aPurchase !== null) {
				if ($this->aPurchase->isModified()) {
					$affectedRows += $this->aPurchase->save($con);
				}
				$this->setPurchase($this->aPurchase);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DiscountCouponPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DiscountCouponPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collPurchaseList !== null) {
				foreach($this->collPurchaseList as $referrerFK) {
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


												
			if ($this->aPurchase !== null) {
				if (!$this->aPurchase->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPurchase->getValidationFailures());
				}
			}


			if (($retval = DiscountCouponPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPurchaseList !== null) {
					foreach($this->collPurchaseList as $referrerFK) {
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
		$pos = DiscountCouponPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getCouponCode();
				break;
			case 2:
				return $this->getDiscountRule();
				break;
			case 3:
				return $this->getPurchaseId();
				break;
			case 4:
				return $this->getIsActive();
				break;
			case 5:
				return $this->getHasUsed();
				break;
			case 6:
				return $this->getEnabled();
				break;
			case 7:
				return $this->getVisible();
				break;
			case 8:
				return $this->getDeleted();
				break;
			case 9:
				return $this->getLocked();
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
		$keys = DiscountCouponPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getCouponCode(),
			$keys[2]=>$this->getDiscountRule(),
			$keys[3]=>$this->getPurchaseId(),
			$keys[4]=>$this->getIsActive(),
			$keys[5]=>$this->getHasUsed(),
			$keys[6]=>$this->getEnabled(),
			$keys[7]=>$this->getVisible(),
			$keys[8]=>$this->getDeleted(),
			$keys[9]=>$this->getLocked(),
			$keys[10]=>$this->getCreatedAt(),
			$keys[11]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DiscountCouponPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setCouponCode($value);
				break;
			case 2:
				$this->setDiscountRule($value);
				break;
			case 3:
				$this->setPurchaseId($value);
				break;
			case 4:
				$this->setIsActive($value);
				break;
			case 5:
				$this->setHasUsed($value);
				break;
			case 6:
				$this->setEnabled($value);
				break;
			case 7:
				$this->setVisible($value);
				break;
			case 8:
				$this->setDeleted($value);
				break;
			case 9:
				$this->setLocked($value);
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
		$keys = DiscountCouponPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCouponCode($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDiscountRule($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPurchaseId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIsActive($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setHasUsed($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setEnabled($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setVisible($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setDeleted($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setLocked($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUpdatedAt($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DiscountCouponPeer::DATABASE_NAME);

		if ($this->isColumnModified(DiscountCouponPeer::ID)) $criteria->add(DiscountCouponPeer::ID, $this->id);
		if ($this->isColumnModified(DiscountCouponPeer::COUPON_CODE)) $criteria->add(DiscountCouponPeer::COUPON_CODE, $this->coupon_code);
		if ($this->isColumnModified(DiscountCouponPeer::DISCOUNT_RULE)) $criteria->add(DiscountCouponPeer::DISCOUNT_RULE, $this->discount_rule);
		if ($this->isColumnModified(DiscountCouponPeer::PURCHASE_ID)) $criteria->add(DiscountCouponPeer::PURCHASE_ID, $this->purchase_id);
		if ($this->isColumnModified(DiscountCouponPeer::IS_ACTIVE)) $criteria->add(DiscountCouponPeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(DiscountCouponPeer::HAS_USED)) $criteria->add(DiscountCouponPeer::HAS_USED, $this->has_used);
		if ($this->isColumnModified(DiscountCouponPeer::ENABLED)) $criteria->add(DiscountCouponPeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(DiscountCouponPeer::VISIBLE)) $criteria->add(DiscountCouponPeer::VISIBLE, $this->visible);
		if ($this->isColumnModified(DiscountCouponPeer::DELETED)) $criteria->add(DiscountCouponPeer::DELETED, $this->deleted);
		if ($this->isColumnModified(DiscountCouponPeer::LOCKED)) $criteria->add(DiscountCouponPeer::LOCKED, $this->locked);
		if ($this->isColumnModified(DiscountCouponPeer::CREATED_AT)) $criteria->add(DiscountCouponPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(DiscountCouponPeer::UPDATED_AT)) $criteria->add(DiscountCouponPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DiscountCouponPeer::DATABASE_NAME);

		$criteria->add(DiscountCouponPeer::ID, $this->id);

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

		$copyObj->setCouponCode($this->coupon_code);

		$copyObj->setDiscountRule($this->discount_rule);

		$copyObj->setPurchaseId($this->purchase_id);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setHasUsed($this->has_used);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setVisible($this->visible);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setLocked($this->locked);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getPurchaseList() as $relObj) {
				$copyObj->addPurchase($relObj->copy($deepCopy));
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
			self::$peer = new DiscountCouponPeer();
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

	
	public function initPurchaseList()
	{
		if ($this->collPurchaseList === null) {
			$this->collPurchaseList = array();
		}
	}

	
	public function getPurchaseList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePurchasePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPurchaseList === null) {
			if ($this->isNew()) {
			   $this->collPurchaseList = array();
			} else {

				$criteria->add(PurchasePeer::DISCOUNT_COUPON_ID, $this->getId());

				PurchasePeer::addSelectColumns($criteria);
				$this->collPurchaseList = PurchasePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PurchasePeer::DISCOUNT_COUPON_ID, $this->getId());

				PurchasePeer::addSelectColumns($criteria);
				if (!isset($this->lastPurchaseCriteria) || !$this->lastPurchaseCriteria->equals($criteria)) {
					$this->collPurchaseList = PurchasePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPurchaseCriteria = $criteria;
		return $this->collPurchaseList;
	}

	
	public function countPurchaseList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePurchasePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PurchasePeer::DISCOUNT_COUPON_ID, $this->getId());

		return PurchasePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPurchase(Purchase $l)
	{
		$this->collPurchaseList[] = $l;
		$l->setDiscountCoupon($this);
	}


	
	public function getPurchaseListJoinUserSite($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePurchasePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPurchaseList === null) {
			if ($this->isNew()) {
				$this->collPurchaseList = array();
			} else {

				$criteria->add(PurchasePeer::DISCOUNT_COUPON_ID, $this->getId());

				$this->collPurchaseList = PurchasePeer::doSelectJoinUserSite($criteria, $con);
			}
		} else {
									
			$criteria->add(PurchasePeer::DISCOUNT_COUPON_ID, $this->getId());

			if (!isset($this->lastPurchaseCriteria) || !$this->lastPurchaseCriteria->equals($criteria)) {
				$this->collPurchaseList = PurchasePeer::doSelectJoinUserSite($criteria, $con);
			}
		}
		$this->lastPurchaseCriteria = $criteria;

		return $this->collPurchaseList;
	}


	
	public function getPurchaseListJoinFile($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePurchasePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPurchaseList === null) {
			if ($this->isNew()) {
				$this->collPurchaseList = array();
			} else {

				$criteria->add(PurchasePeer::DISCOUNT_COUPON_ID, $this->getId());

				$this->collPurchaseList = PurchasePeer::doSelectJoinFile($criteria, $con);
			}
		} else {
									
			$criteria->add(PurchasePeer::DISCOUNT_COUPON_ID, $this->getId());

			if (!isset($this->lastPurchaseCriteria) || !$this->lastPurchaseCriteria->equals($criteria)) {
				$this->collPurchaseList = PurchasePeer::doSelectJoinFile($criteria, $con);
			}
		}
		$this->lastPurchaseCriteria = $criteria;

		return $this->collPurchaseList;
	}

} 