<?php


abstract class BasePurchase extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $user_site_id;


	
	protected $file_id;


	
	protected $pagseguro_url;


	
	protected $order_number;


	
	protected $order_status;


	
	protected $has_new_status;


	
	protected $order_value = 0;


	
	protected $products = 0;


	
	protected $itens = 0;


	
	protected $discount_coupon_id;


	
	protected $shipping_value = 0;


	
	protected $discount_value = 0;


	
	protected $total_value = 0;


	
	protected $paymethod;


	
	protected $ip_address;


	
	protected $duration;


	
	protected $approval_date;


	
	protected $refusal_date;


	
	protected $refusal_reason;


	
	protected $shipping_date;


	
	protected $tracing_code;


	
	protected $customer_name;


	
	protected $address_name;


	
	protected $address_number;


	
	protected $address_quarter;


	
	protected $address_complement;


	
	protected $address_city;


	
	protected $address_state;


	
	protected $address_zipcode;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aUserSite;

	
	protected $aFile;

	
	protected $aDiscountCoupon;

	
	protected $collPurchaseProductItemList;

	
	protected $lastPurchaseProductItemCriteria = null;

	
	protected $collDiscountCouponList;

	
	protected $lastDiscountCouponCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getUserSiteId()
	{

		return $this->user_site_id;
	}

	
	public function getFileId()
	{

		return $this->file_id;
	}

	
	public function getPagseguroUrl()
	{

		return $this->pagseguro_url;
	}

	
	public function getOrderNumber()
	{

		return $this->order_number;
	}

	
	public function getOrderStatus()
	{

		return $this->order_status;
	}

	
	public function getHasNewStatus()
	{

		return $this->has_new_status;
	}

	
	public function getOrderValue()
	{

		return $this->order_value;
	}

	
	public function getProducts()
	{

		return $this->products;
	}

	
	public function getItens()
	{

		return $this->itens;
	}

	
	public function getDiscountCouponId()
	{

		return $this->discount_coupon_id;
	}

	
	public function getShippingValue()
	{

		return $this->shipping_value;
	}

	
	public function getDiscountValue()
	{

		return $this->discount_value;
	}

	
	public function getTotalValue()
	{

		return $this->total_value;
	}

	
	public function getPaymethod()
	{

		return $this->paymethod;
	}

	
	public function getIpAddress()
	{

		return $this->ip_address;
	}

	
	public function getDuration($format = 'H:i:s')
	{

		if ($this->duration === null || $this->duration === '') {
			return null;
		} elseif (!is_int($this->duration)) {
						$ts = strtotime($this->duration);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [duration] as date/time value: " . var_export($this->duration, true));
			}
		} else {
			$ts = $this->duration;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getApprovalDate($format = 'Y-m-d H:i:s')
	{

		if ($this->approval_date === null || $this->approval_date === '') {
			return null;
		} elseif (!is_int($this->approval_date)) {
						$ts = strtotime($this->approval_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [approval_date] as date/time value: " . var_export($this->approval_date, true));
			}
		} else {
			$ts = $this->approval_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getRefusalDate($format = 'Y-m-d H:i:s')
	{

		if ($this->refusal_date === null || $this->refusal_date === '') {
			return null;
		} elseif (!is_int($this->refusal_date)) {
						$ts = strtotime($this->refusal_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [refusal_date] as date/time value: " . var_export($this->refusal_date, true));
			}
		} else {
			$ts = $this->refusal_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getRefusalReason()
	{

		return $this->refusal_reason;
	}

	
	public function getShippingDate($format = 'Y-m-d H:i:s')
	{

		if ($this->shipping_date === null || $this->shipping_date === '') {
			return null;
		} elseif (!is_int($this->shipping_date)) {
						$ts = strtotime($this->shipping_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [shipping_date] as date/time value: " . var_export($this->shipping_date, true));
			}
		} else {
			$ts = $this->shipping_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getTracingCode()
	{

		return $this->tracing_code;
	}

	
	public function getCustomerName()
	{

		return $this->customer_name;
	}

	
	public function getAddressName()
	{

		return $this->address_name;
	}

	
	public function getAddressNumber()
	{

		return $this->address_number;
	}

	
	public function getAddressQuarter()
	{

		return $this->address_quarter;
	}

	
	public function getAddressComplement()
	{

		return $this->address_complement;
	}

	
	public function getAddressCity()
	{

		return $this->address_city;
	}

	
	public function getAddressState()
	{

		return $this->address_state;
	}

	
	public function getAddressZipcode()
	{

		return $this->address_zipcode;
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
			$this->modifiedColumns[] = PurchasePeer::ID;
		}

	} 
	
	public function setUserSiteId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_site_id !== $v) {
			$this->user_site_id = $v;
			$this->modifiedColumns[] = PurchasePeer::USER_SITE_ID;
		}

		if ($this->aUserSite !== null && $this->aUserSite->getId() !== $v) {
			$this->aUserSite = null;
		}

	} 
	
	public function setFileId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->file_id !== $v) {
			$this->file_id = $v;
			$this->modifiedColumns[] = PurchasePeer::FILE_ID;
		}

		if ($this->aFile !== null && $this->aFile->getId() !== $v) {
			$this->aFile = null;
		}

	} 
	
	public function setPagseguroUrl($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->pagseguro_url !== $v) {
			$this->pagseguro_url = $v;
			$this->modifiedColumns[] = PurchasePeer::PAGSEGURO_URL;
		}

	} 
	
	public function setOrderNumber($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->order_number !== $v) {
			$this->order_number = $v;
			$this->modifiedColumns[] = PurchasePeer::ORDER_NUMBER;
		}

	} 
	
	public function setOrderStatus($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->order_status !== $v) {
			$this->order_status = $v;
			$this->modifiedColumns[] = PurchasePeer::ORDER_STATUS;
		}

	} 
	
	public function setHasNewStatus($v)
	{

		if ($this->has_new_status !== $v) {
			$this->has_new_status = $v;
			$this->modifiedColumns[] = PurchasePeer::HAS_NEW_STATUS;
		}

	} 
	
	public function setOrderValue($v)
	{

		if ($this->order_value !== $v || $v === 0) {
			$this->order_value = $v;
			$this->modifiedColumns[] = PurchasePeer::ORDER_VALUE;
		}

	} 
	
	public function setProducts($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->products !== $v || $v === 0) {
			$this->products = $v;
			$this->modifiedColumns[] = PurchasePeer::PRODUCTS;
		}

	} 
	
	public function setItens($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->itens !== $v || $v === 0) {
			$this->itens = $v;
			$this->modifiedColumns[] = PurchasePeer::ITENS;
		}

	} 
	
	public function setDiscountCouponId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->discount_coupon_id !== $v) {
			$this->discount_coupon_id = $v;
			$this->modifiedColumns[] = PurchasePeer::DISCOUNT_COUPON_ID;
		}

		if ($this->aDiscountCoupon !== null && $this->aDiscountCoupon->getId() !== $v) {
			$this->aDiscountCoupon = null;
		}

	} 
	
	public function setShippingValue($v)
	{

		if ($this->shipping_value !== $v || $v === 0) {
			$this->shipping_value = $v;
			$this->modifiedColumns[] = PurchasePeer::SHIPPING_VALUE;
		}

	} 
	
	public function setDiscountValue($v)
	{

		if ($this->discount_value !== $v || $v === 0) {
			$this->discount_value = $v;
			$this->modifiedColumns[] = PurchasePeer::DISCOUNT_VALUE;
		}

	} 
	
	public function setTotalValue($v)
	{

		if ($this->total_value !== $v || $v === 0) {
			$this->total_value = $v;
			$this->modifiedColumns[] = PurchasePeer::TOTAL_VALUE;
		}

	} 
	
	public function setPaymethod($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->paymethod !== $v) {
			$this->paymethod = $v;
			$this->modifiedColumns[] = PurchasePeer::PAYMETHOD;
		}

	} 
	
	public function setIpAddress($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ip_address !== $v) {
			$this->ip_address = $v;
			$this->modifiedColumns[] = PurchasePeer::IP_ADDRESS;
		}

	} 
	
	public function setDuration($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [duration] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->duration !== $ts) {
			$this->duration = $ts;
			$this->modifiedColumns[] = PurchasePeer::DURATION;
		}

	} 
	
	public function setApprovalDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [approval_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->approval_date !== $ts) {
			$this->approval_date = $ts;
			$this->modifiedColumns[] = PurchasePeer::APPROVAL_DATE;
		}

	} 
	
	public function setRefusalDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [refusal_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->refusal_date !== $ts) {
			$this->refusal_date = $ts;
			$this->modifiedColumns[] = PurchasePeer::REFUSAL_DATE;
		}

	} 
	
	public function setRefusalReason($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->refusal_reason !== $v) {
			$this->refusal_reason = $v;
			$this->modifiedColumns[] = PurchasePeer::REFUSAL_REASON;
		}

	} 
	
	public function setShippingDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [shipping_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->shipping_date !== $ts) {
			$this->shipping_date = $ts;
			$this->modifiedColumns[] = PurchasePeer::SHIPPING_DATE;
		}

	} 
	
	public function setTracingCode($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tracing_code !== $v) {
			$this->tracing_code = $v;
			$this->modifiedColumns[] = PurchasePeer::TRACING_CODE;
		}

	} 
	
	public function setCustomerName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->customer_name !== $v) {
			$this->customer_name = $v;
			$this->modifiedColumns[] = PurchasePeer::CUSTOMER_NAME;
		}

	} 
	
	public function setAddressName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->address_name !== $v) {
			$this->address_name = $v;
			$this->modifiedColumns[] = PurchasePeer::ADDRESS_NAME;
		}

	} 
	
	public function setAddressNumber($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->address_number !== $v) {
			$this->address_number = $v;
			$this->modifiedColumns[] = PurchasePeer::ADDRESS_NUMBER;
		}

	} 
	
	public function setAddressQuarter($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->address_quarter !== $v) {
			$this->address_quarter = $v;
			$this->modifiedColumns[] = PurchasePeer::ADDRESS_QUARTER;
		}

	} 
	
	public function setAddressComplement($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->address_complement !== $v) {
			$this->address_complement = $v;
			$this->modifiedColumns[] = PurchasePeer::ADDRESS_COMPLEMENT;
		}

	} 
	
	public function setAddressCity($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->address_city !== $v) {
			$this->address_city = $v;
			$this->modifiedColumns[] = PurchasePeer::ADDRESS_CITY;
		}

	} 
	
	public function setAddressState($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->address_state !== $v) {
			$this->address_state = $v;
			$this->modifiedColumns[] = PurchasePeer::ADDRESS_STATE;
		}

	} 
	
	public function setAddressZipcode($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->address_zipcode !== $v) {
			$this->address_zipcode = $v;
			$this->modifiedColumns[] = PurchasePeer::ADDRESS_ZIPCODE;
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
			$this->modifiedColumns[] = PurchasePeer::CREATED_AT;
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
			$this->modifiedColumns[] = PurchasePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->user_site_id = $rs->getInt($startcol + 1);

			$this->file_id = $rs->getInt($startcol + 2);

			$this->pagseguro_url = $rs->getString($startcol + 3);

			$this->order_number = $rs->getString($startcol + 4);

			$this->order_status = $rs->getString($startcol + 5);

			$this->has_new_status = $rs->getBoolean($startcol + 6);

			$this->order_value = $rs->getFloat($startcol + 7);

			$this->products = $rs->getInt($startcol + 8);

			$this->itens = $rs->getInt($startcol + 9);

			$this->discount_coupon_id = $rs->getInt($startcol + 10);

			$this->shipping_value = $rs->getFloat($startcol + 11);

			$this->discount_value = $rs->getFloat($startcol + 12);

			$this->total_value = $rs->getFloat($startcol + 13);

			$this->paymethod = $rs->getString($startcol + 14);

			$this->ip_address = $rs->getString($startcol + 15);

			$this->duration = $rs->getTime($startcol + 16, null);

			$this->approval_date = $rs->getTimestamp($startcol + 17, null);

			$this->refusal_date = $rs->getTimestamp($startcol + 18, null);

			$this->refusal_reason = $rs->getString($startcol + 19);

			$this->shipping_date = $rs->getTimestamp($startcol + 20, null);

			$this->tracing_code = $rs->getString($startcol + 21);

			$this->customer_name = $rs->getString($startcol + 22);

			$this->address_name = $rs->getString($startcol + 23);

			$this->address_number = $rs->getString($startcol + 24);

			$this->address_quarter = $rs->getString($startcol + 25);

			$this->address_complement = $rs->getString($startcol + 26);

			$this->address_city = $rs->getString($startcol + 27);

			$this->address_state = $rs->getString($startcol + 28);

			$this->address_zipcode = $rs->getString($startcol + 29);

			$this->created_at = $rs->getTimestamp($startcol + 30, null);

			$this->updated_at = $rs->getTimestamp($startcol + 31, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 32; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Purchase object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PurchasePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PurchasePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(PurchasePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(PurchasePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PurchasePeer::DATABASE_NAME);
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


												
			if ($this->aUserSite !== null) {
				if ($this->aUserSite->isModified()) {
					$affectedRows += $this->aUserSite->save($con);
				}
				$this->setUserSite($this->aUserSite);
			}

			if ($this->aFile !== null) {
				if ($this->aFile->isModified()) {
					$affectedRows += $this->aFile->save($con);
				}
				$this->setFile($this->aFile);
			}

			if ($this->aDiscountCoupon !== null) {
				if ($this->aDiscountCoupon->isModified()) {
					$affectedRows += $this->aDiscountCoupon->save($con);
				}
				$this->setDiscountCoupon($this->aDiscountCoupon);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PurchasePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PurchasePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collPurchaseProductItemList !== null) {
				foreach($this->collPurchaseProductItemList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDiscountCouponList !== null) {
				foreach($this->collDiscountCouponList as $referrerFK) {
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


												
			if ($this->aUserSite !== null) {
				if (!$this->aUserSite->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserSite->getValidationFailures());
				}
			}

			if ($this->aFile !== null) {
				if (!$this->aFile->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFile->getValidationFailures());
				}
			}

			if ($this->aDiscountCoupon !== null) {
				if (!$this->aDiscountCoupon->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDiscountCoupon->getValidationFailures());
				}
			}


			if (($retval = PurchasePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPurchaseProductItemList !== null) {
					foreach($this->collPurchaseProductItemList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collDiscountCouponList !== null) {
					foreach($this->collDiscountCouponList as $referrerFK) {
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
		$pos = PurchasePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getUserSiteId();
				break;
			case 2:
				return $this->getFileId();
				break;
			case 3:
				return $this->getPagseguroUrl();
				break;
			case 4:
				return $this->getOrderNumber();
				break;
			case 5:
				return $this->getOrderStatus();
				break;
			case 6:
				return $this->getHasNewStatus();
				break;
			case 7:
				return $this->getOrderValue();
				break;
			case 8:
				return $this->getProducts();
				break;
			case 9:
				return $this->getItens();
				break;
			case 10:
				return $this->getDiscountCouponId();
				break;
			case 11:
				return $this->getShippingValue();
				break;
			case 12:
				return $this->getDiscountValue();
				break;
			case 13:
				return $this->getTotalValue();
				break;
			case 14:
				return $this->getPaymethod();
				break;
			case 15:
				return $this->getIpAddress();
				break;
			case 16:
				return $this->getDuration();
				break;
			case 17:
				return $this->getApprovalDate();
				break;
			case 18:
				return $this->getRefusalDate();
				break;
			case 19:
				return $this->getRefusalReason();
				break;
			case 20:
				return $this->getShippingDate();
				break;
			case 21:
				return $this->getTracingCode();
				break;
			case 22:
				return $this->getCustomerName();
				break;
			case 23:
				return $this->getAddressName();
				break;
			case 24:
				return $this->getAddressNumber();
				break;
			case 25:
				return $this->getAddressQuarter();
				break;
			case 26:
				return $this->getAddressComplement();
				break;
			case 27:
				return $this->getAddressCity();
				break;
			case 28:
				return $this->getAddressState();
				break;
			case 29:
				return $this->getAddressZipcode();
				break;
			case 30:
				return $this->getCreatedAt();
				break;
			case 31:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PurchasePeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getUserSiteId(),
			$keys[2]=>$this->getFileId(),
			$keys[3]=>$this->getPagseguroUrl(),
			$keys[4]=>$this->getOrderNumber(),
			$keys[5]=>$this->getOrderStatus(),
			$keys[6]=>$this->getHasNewStatus(),
			$keys[7]=>$this->getOrderValue(),
			$keys[8]=>$this->getProducts(),
			$keys[9]=>$this->getItens(),
			$keys[10]=>$this->getDiscountCouponId(),
			$keys[11]=>$this->getShippingValue(),
			$keys[12]=>$this->getDiscountValue(),
			$keys[13]=>$this->getTotalValue(),
			$keys[14]=>$this->getPaymethod(),
			$keys[15]=>$this->getIpAddress(),
			$keys[16]=>$this->getDuration(),
			$keys[17]=>$this->getApprovalDate(),
			$keys[18]=>$this->getRefusalDate(),
			$keys[19]=>$this->getRefusalReason(),
			$keys[20]=>$this->getShippingDate(),
			$keys[21]=>$this->getTracingCode(),
			$keys[22]=>$this->getCustomerName(),
			$keys[23]=>$this->getAddressName(),
			$keys[24]=>$this->getAddressNumber(),
			$keys[25]=>$this->getAddressQuarter(),
			$keys[26]=>$this->getAddressComplement(),
			$keys[27]=>$this->getAddressCity(),
			$keys[28]=>$this->getAddressState(),
			$keys[29]=>$this->getAddressZipcode(),
			$keys[30]=>$this->getCreatedAt(),
			$keys[31]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PurchasePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setUserSiteId($value);
				break;
			case 2:
				$this->setFileId($value);
				break;
			case 3:
				$this->setPagseguroUrl($value);
				break;
			case 4:
				$this->setOrderNumber($value);
				break;
			case 5:
				$this->setOrderStatus($value);
				break;
			case 6:
				$this->setHasNewStatus($value);
				break;
			case 7:
				$this->setOrderValue($value);
				break;
			case 8:
				$this->setProducts($value);
				break;
			case 9:
				$this->setItens($value);
				break;
			case 10:
				$this->setDiscountCouponId($value);
				break;
			case 11:
				$this->setShippingValue($value);
				break;
			case 12:
				$this->setDiscountValue($value);
				break;
			case 13:
				$this->setTotalValue($value);
				break;
			case 14:
				$this->setPaymethod($value);
				break;
			case 15:
				$this->setIpAddress($value);
				break;
			case 16:
				$this->setDuration($value);
				break;
			case 17:
				$this->setApprovalDate($value);
				break;
			case 18:
				$this->setRefusalDate($value);
				break;
			case 19:
				$this->setRefusalReason($value);
				break;
			case 20:
				$this->setShippingDate($value);
				break;
			case 21:
				$this->setTracingCode($value);
				break;
			case 22:
				$this->setCustomerName($value);
				break;
			case 23:
				$this->setAddressName($value);
				break;
			case 24:
				$this->setAddressNumber($value);
				break;
			case 25:
				$this->setAddressQuarter($value);
				break;
			case 26:
				$this->setAddressComplement($value);
				break;
			case 27:
				$this->setAddressCity($value);
				break;
			case 28:
				$this->setAddressState($value);
				break;
			case 29:
				$this->setAddressZipcode($value);
				break;
			case 30:
				$this->setCreatedAt($value);
				break;
			case 31:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PurchasePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserSiteId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFileId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPagseguroUrl($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setOrderNumber($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setOrderStatus($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setHasNewStatus($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setOrderValue($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setProducts($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setItens($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setDiscountCouponId($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setShippingValue($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setDiscountValue($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setTotalValue($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setPaymethod($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setIpAddress($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setDuration($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setApprovalDate($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setRefusalDate($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setRefusalReason($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setShippingDate($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setTracingCode($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setCustomerName($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setAddressName($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setAddressNumber($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setAddressQuarter($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setAddressComplement($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setAddressCity($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setAddressState($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setAddressZipcode($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setCreatedAt($arr[$keys[30]]);
		if (array_key_exists($keys[31], $arr)) $this->setUpdatedAt($arr[$keys[31]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PurchasePeer::DATABASE_NAME);

		if ($this->isColumnModified(PurchasePeer::ID)) $criteria->add(PurchasePeer::ID, $this->id);
		if ($this->isColumnModified(PurchasePeer::USER_SITE_ID)) $criteria->add(PurchasePeer::USER_SITE_ID, $this->user_site_id);
		if ($this->isColumnModified(PurchasePeer::FILE_ID)) $criteria->add(PurchasePeer::FILE_ID, $this->file_id);
		if ($this->isColumnModified(PurchasePeer::PAGSEGURO_URL)) $criteria->add(PurchasePeer::PAGSEGURO_URL, $this->pagseguro_url);
		if ($this->isColumnModified(PurchasePeer::ORDER_NUMBER)) $criteria->add(PurchasePeer::ORDER_NUMBER, $this->order_number);
		if ($this->isColumnModified(PurchasePeer::ORDER_STATUS)) $criteria->add(PurchasePeer::ORDER_STATUS, $this->order_status);
		if ($this->isColumnModified(PurchasePeer::HAS_NEW_STATUS)) $criteria->add(PurchasePeer::HAS_NEW_STATUS, $this->has_new_status);
		if ($this->isColumnModified(PurchasePeer::ORDER_VALUE)) $criteria->add(PurchasePeer::ORDER_VALUE, $this->order_value);
		if ($this->isColumnModified(PurchasePeer::PRODUCTS)) $criteria->add(PurchasePeer::PRODUCTS, $this->products);
		if ($this->isColumnModified(PurchasePeer::ITENS)) $criteria->add(PurchasePeer::ITENS, $this->itens);
		if ($this->isColumnModified(PurchasePeer::DISCOUNT_COUPON_ID)) $criteria->add(PurchasePeer::DISCOUNT_COUPON_ID, $this->discount_coupon_id);
		if ($this->isColumnModified(PurchasePeer::SHIPPING_VALUE)) $criteria->add(PurchasePeer::SHIPPING_VALUE, $this->shipping_value);
		if ($this->isColumnModified(PurchasePeer::DISCOUNT_VALUE)) $criteria->add(PurchasePeer::DISCOUNT_VALUE, $this->discount_value);
		if ($this->isColumnModified(PurchasePeer::TOTAL_VALUE)) $criteria->add(PurchasePeer::TOTAL_VALUE, $this->total_value);
		if ($this->isColumnModified(PurchasePeer::PAYMETHOD)) $criteria->add(PurchasePeer::PAYMETHOD, $this->paymethod);
		if ($this->isColumnModified(PurchasePeer::IP_ADDRESS)) $criteria->add(PurchasePeer::IP_ADDRESS, $this->ip_address);
		if ($this->isColumnModified(PurchasePeer::DURATION)) $criteria->add(PurchasePeer::DURATION, $this->duration);
		if ($this->isColumnModified(PurchasePeer::APPROVAL_DATE)) $criteria->add(PurchasePeer::APPROVAL_DATE, $this->approval_date);
		if ($this->isColumnModified(PurchasePeer::REFUSAL_DATE)) $criteria->add(PurchasePeer::REFUSAL_DATE, $this->refusal_date);
		if ($this->isColumnModified(PurchasePeer::REFUSAL_REASON)) $criteria->add(PurchasePeer::REFUSAL_REASON, $this->refusal_reason);
		if ($this->isColumnModified(PurchasePeer::SHIPPING_DATE)) $criteria->add(PurchasePeer::SHIPPING_DATE, $this->shipping_date);
		if ($this->isColumnModified(PurchasePeer::TRACING_CODE)) $criteria->add(PurchasePeer::TRACING_CODE, $this->tracing_code);
		if ($this->isColumnModified(PurchasePeer::CUSTOMER_NAME)) $criteria->add(PurchasePeer::CUSTOMER_NAME, $this->customer_name);
		if ($this->isColumnModified(PurchasePeer::ADDRESS_NAME)) $criteria->add(PurchasePeer::ADDRESS_NAME, $this->address_name);
		if ($this->isColumnModified(PurchasePeer::ADDRESS_NUMBER)) $criteria->add(PurchasePeer::ADDRESS_NUMBER, $this->address_number);
		if ($this->isColumnModified(PurchasePeer::ADDRESS_QUARTER)) $criteria->add(PurchasePeer::ADDRESS_QUARTER, $this->address_quarter);
		if ($this->isColumnModified(PurchasePeer::ADDRESS_COMPLEMENT)) $criteria->add(PurchasePeer::ADDRESS_COMPLEMENT, $this->address_complement);
		if ($this->isColumnModified(PurchasePeer::ADDRESS_CITY)) $criteria->add(PurchasePeer::ADDRESS_CITY, $this->address_city);
		if ($this->isColumnModified(PurchasePeer::ADDRESS_STATE)) $criteria->add(PurchasePeer::ADDRESS_STATE, $this->address_state);
		if ($this->isColumnModified(PurchasePeer::ADDRESS_ZIPCODE)) $criteria->add(PurchasePeer::ADDRESS_ZIPCODE, $this->address_zipcode);
		if ($this->isColumnModified(PurchasePeer::CREATED_AT)) $criteria->add(PurchasePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(PurchasePeer::UPDATED_AT)) $criteria->add(PurchasePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PurchasePeer::DATABASE_NAME);

		$criteria->add(PurchasePeer::ID, $this->id);

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

		$copyObj->setUserSiteId($this->user_site_id);

		$copyObj->setFileId($this->file_id);

		$copyObj->setPagseguroUrl($this->pagseguro_url);

		$copyObj->setOrderNumber($this->order_number);

		$copyObj->setOrderStatus($this->order_status);

		$copyObj->setHasNewStatus($this->has_new_status);

		$copyObj->setOrderValue($this->order_value);

		$copyObj->setProducts($this->products);

		$copyObj->setItens($this->itens);

		$copyObj->setDiscountCouponId($this->discount_coupon_id);

		$copyObj->setShippingValue($this->shipping_value);

		$copyObj->setDiscountValue($this->discount_value);

		$copyObj->setTotalValue($this->total_value);

		$copyObj->setPaymethod($this->paymethod);

		$copyObj->setIpAddress($this->ip_address);

		$copyObj->setDuration($this->duration);

		$copyObj->setApprovalDate($this->approval_date);

		$copyObj->setRefusalDate($this->refusal_date);

		$copyObj->setRefusalReason($this->refusal_reason);

		$copyObj->setShippingDate($this->shipping_date);

		$copyObj->setTracingCode($this->tracing_code);

		$copyObj->setCustomerName($this->customer_name);

		$copyObj->setAddressName($this->address_name);

		$copyObj->setAddressNumber($this->address_number);

		$copyObj->setAddressQuarter($this->address_quarter);

		$copyObj->setAddressComplement($this->address_complement);

		$copyObj->setAddressCity($this->address_city);

		$copyObj->setAddressState($this->address_state);

		$copyObj->setAddressZipcode($this->address_zipcode);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getPurchaseProductItemList() as $relObj) {
				$copyObj->addPurchaseProductItem($relObj->copy($deepCopy));
			}

			foreach($this->getDiscountCouponList() as $relObj) {
				$copyObj->addDiscountCoupon($relObj->copy($deepCopy));
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
			self::$peer = new PurchasePeer();
		}
		return self::$peer;
	}

	
	public function setUserSite($v)
	{


		if ($v === null) {
			$this->setUserSiteId(NULL);
		} else {
			$this->setUserSiteId($v->getId());
		}


		$this->aUserSite = $v;
	}


	
	public function getUserSite($con = null)
	{
		if ($this->aUserSite === null && ($this->user_site_id !== null)) {
						include_once 'lib/model/om/BaseUserSitePeer.php';

			$this->aUserSite = UserSitePeer::retrieveByPK($this->user_site_id, $con);

			
		}
		return $this->aUserSite;
	}

	
	public function setFile($v)
	{


		if ($v === null) {
			$this->setFileId(NULL);
		} else {
			$this->setFileId($v->getId());
		}


		$this->aFile = $v;
	}


	
	public function getFile($con = null)
	{
		if ($this->aFile === null && ($this->file_id !== null)) {
						include_once 'lib/model/om/BaseFilePeer.php';

			$this->aFile = FilePeer::retrieveByPK($this->file_id, $con);

			
		}
		return $this->aFile;
	}

	
	public function setDiscountCoupon($v)
	{


		if ($v === null) {
			$this->setDiscountCouponId(NULL);
		} else {
			$this->setDiscountCouponId($v->getId());
		}


		$this->aDiscountCoupon = $v;
	}


	
	public function getDiscountCoupon($con = null)
	{
		if ($this->aDiscountCoupon === null && ($this->discount_coupon_id !== null)) {
						include_once 'lib/model/om/BaseDiscountCouponPeer.php';

			$this->aDiscountCoupon = DiscountCouponPeer::retrieveByPK($this->discount_coupon_id, $con);

			
		}
		return $this->aDiscountCoupon;
	}

	
	public function initPurchaseProductItemList()
	{
		if ($this->collPurchaseProductItemList === null) {
			$this->collPurchaseProductItemList = array();
		}
	}

	
	public function getPurchaseProductItemList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePurchaseProductItemPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPurchaseProductItemList === null) {
			if ($this->isNew()) {
			   $this->collPurchaseProductItemList = array();
			} else {

				$criteria->add(PurchaseProductItemPeer::PURCHASE_ID, $this->getId());

				PurchaseProductItemPeer::addSelectColumns($criteria);
				$this->collPurchaseProductItemList = PurchaseProductItemPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PurchaseProductItemPeer::PURCHASE_ID, $this->getId());

				PurchaseProductItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastPurchaseProductItemCriteria) || !$this->lastPurchaseProductItemCriteria->equals($criteria)) {
					$this->collPurchaseProductItemList = PurchaseProductItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPurchaseProductItemCriteria = $criteria;
		return $this->collPurchaseProductItemList;
	}

	
	public function countPurchaseProductItemList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePurchaseProductItemPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PurchaseProductItemPeer::PURCHASE_ID, $this->getId());

		return PurchaseProductItemPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPurchaseProductItem(PurchaseProductItem $l)
	{
		$this->collPurchaseProductItemList[] = $l;
		$l->setPurchase($this);
	}


	
	public function getPurchaseProductItemListJoinProductItem($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePurchaseProductItemPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPurchaseProductItemList === null) {
			if ($this->isNew()) {
				$this->collPurchaseProductItemList = array();
			} else {

				$criteria->add(PurchaseProductItemPeer::PURCHASE_ID, $this->getId());

				$this->collPurchaseProductItemList = PurchaseProductItemPeer::doSelectJoinProductItem($criteria, $con);
			}
		} else {
									
			$criteria->add(PurchaseProductItemPeer::PURCHASE_ID, $this->getId());

			if (!isset($this->lastPurchaseProductItemCriteria) || !$this->lastPurchaseProductItemCriteria->equals($criteria)) {
				$this->collPurchaseProductItemList = PurchaseProductItemPeer::doSelectJoinProductItem($criteria, $con);
			}
		}
		$this->lastPurchaseProductItemCriteria = $criteria;

		return $this->collPurchaseProductItemList;
	}

	
	public function initDiscountCouponList()
	{
		if ($this->collDiscountCouponList === null) {
			$this->collDiscountCouponList = array();
		}
	}

	
	public function getDiscountCouponList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDiscountCouponPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDiscountCouponList === null) {
			if ($this->isNew()) {
			   $this->collDiscountCouponList = array();
			} else {

				$criteria->add(DiscountCouponPeer::PURCHASE_ID, $this->getId());

				DiscountCouponPeer::addSelectColumns($criteria);
				$this->collDiscountCouponList = DiscountCouponPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DiscountCouponPeer::PURCHASE_ID, $this->getId());

				DiscountCouponPeer::addSelectColumns($criteria);
				if (!isset($this->lastDiscountCouponCriteria) || !$this->lastDiscountCouponCriteria->equals($criteria)) {
					$this->collDiscountCouponList = DiscountCouponPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDiscountCouponCriteria = $criteria;
		return $this->collDiscountCouponList;
	}

	
	public function countDiscountCouponList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDiscountCouponPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DiscountCouponPeer::PURCHASE_ID, $this->getId());

		return DiscountCouponPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDiscountCoupon(DiscountCoupon $l)
	{
		$this->collDiscountCouponList[] = $l;
		$l->setPurchase($this);
	}

} 