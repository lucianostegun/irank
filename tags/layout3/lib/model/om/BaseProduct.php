<?php


abstract class BaseProduct extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $product_code;


	
	protected $product_category_id;


	
	protected $product_name;


	
	protected $short_name;


	
	protected $description;


	
	protected $default_price;


	
	protected $default_weight;


	
	protected $is_new;


	
	protected $stock;


	
	protected $image_1;


	
	protected $image_2;


	
	protected $image_3;


	
	protected $image_4;


	
	protected $image_5;


	
	protected $enabled;


	
	protected $visible;


	
	protected $deleted;


	
	protected $locked;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aProductCategory;

	
	protected $collProductItemList;

	
	protected $lastProductItemCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getProductCode()
	{

		return $this->product_code;
	}

	
	public function getProductCategoryId()
	{

		return $this->product_category_id;
	}

	
	public function getProductName()
	{

		return $this->product_name;
	}

	
	public function getShortName()
	{

		return $this->short_name;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getDefaultPrice()
	{

		return $this->default_price;
	}

	
	public function getDefaultWeight()
	{

		return $this->default_weight;
	}

	
	public function getIsNew()
	{

		return $this->is_new;
	}

	
	public function getStock()
	{

		return $this->stock;
	}

	
	public function getImage1()
	{

		return $this->image_1;
	}

	
	public function getImage2()
	{

		return $this->image_2;
	}

	
	public function getImage3()
	{

		return $this->image_3;
	}

	
	public function getImage4()
	{

		return $this->image_4;
	}

	
	public function getImage5()
	{

		return $this->image_5;
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
			$this->modifiedColumns[] = ProductPeer::ID;
		}

	} 
	
	public function setProductCode($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->product_code !== $v) {
			$this->product_code = $v;
			$this->modifiedColumns[] = ProductPeer::PRODUCT_CODE;
		}

	} 
	
	public function setProductCategoryId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->product_category_id !== $v) {
			$this->product_category_id = $v;
			$this->modifiedColumns[] = ProductPeer::PRODUCT_CATEGORY_ID;
		}

		if ($this->aProductCategory !== null && $this->aProductCategory->getId() !== $v) {
			$this->aProductCategory = null;
		}

	} 
	
	public function setProductName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->product_name !== $v) {
			$this->product_name = $v;
			$this->modifiedColumns[] = ProductPeer::PRODUCT_NAME;
		}

	} 
	
	public function setShortName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->short_name !== $v) {
			$this->short_name = $v;
			$this->modifiedColumns[] = ProductPeer::SHORT_NAME;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = ProductPeer::DESCRIPTION;
		}

	} 
	
	public function setDefaultPrice($v)
	{

		if ($this->default_price !== $v) {
			$this->default_price = $v;
			$this->modifiedColumns[] = ProductPeer::DEFAULT_PRICE;
		}

	} 
	
	public function setDefaultWeight($v)
	{

		if ($this->default_weight !== $v) {
			$this->default_weight = $v;
			$this->modifiedColumns[] = ProductPeer::DEFAULT_WEIGHT;
		}

	} 
	
	public function setIsNew($v)
	{

		if ($this->is_new !== $v) {
			$this->is_new = $v;
			$this->modifiedColumns[] = ProductPeer::IS_NEW;
		}

	} 
	
	public function setStock($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->stock !== $v) {
			$this->stock = $v;
			$this->modifiedColumns[] = ProductPeer::STOCK;
		}

	} 
	
	public function setImage1($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->image_1 !== $v) {
			$this->image_1 = $v;
			$this->modifiedColumns[] = ProductPeer::IMAGE_1;
		}

	} 
	
	public function setImage2($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->image_2 !== $v) {
			$this->image_2 = $v;
			$this->modifiedColumns[] = ProductPeer::IMAGE_2;
		}

	} 
	
	public function setImage3($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->image_3 !== $v) {
			$this->image_3 = $v;
			$this->modifiedColumns[] = ProductPeer::IMAGE_3;
		}

	} 
	
	public function setImage4($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->image_4 !== $v) {
			$this->image_4 = $v;
			$this->modifiedColumns[] = ProductPeer::IMAGE_4;
		}

	} 
	
	public function setImage5($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->image_5 !== $v) {
			$this->image_5 = $v;
			$this->modifiedColumns[] = ProductPeer::IMAGE_5;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = ProductPeer::ENABLED;
		}

	} 
	
	public function setVisible($v)
	{

		if ($this->visible !== $v) {
			$this->visible = $v;
			$this->modifiedColumns[] = ProductPeer::VISIBLE;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = ProductPeer::DELETED;
		}

	} 
	
	public function setLocked($v)
	{

		if ($this->locked !== $v) {
			$this->locked = $v;
			$this->modifiedColumns[] = ProductPeer::LOCKED;
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
			$this->modifiedColumns[] = ProductPeer::CREATED_AT;
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
			$this->modifiedColumns[] = ProductPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->product_code = $rs->getString($startcol + 1);

			$this->product_category_id = $rs->getInt($startcol + 2);

			$this->product_name = $rs->getString($startcol + 3);

			$this->short_name = $rs->getString($startcol + 4);

			$this->description = $rs->getString($startcol + 5);

			$this->default_price = $rs->getFloat($startcol + 6);

			$this->default_weight = $rs->getFloat($startcol + 7);

			$this->is_new = $rs->getBoolean($startcol + 8);

			$this->stock = $rs->getInt($startcol + 9);

			$this->image_1 = $rs->getString($startcol + 10);

			$this->image_2 = $rs->getString($startcol + 11);

			$this->image_3 = $rs->getString($startcol + 12);

			$this->image_4 = $rs->getString($startcol + 13);

			$this->image_5 = $rs->getString($startcol + 14);

			$this->enabled = $rs->getBoolean($startcol + 15);

			$this->visible = $rs->getBoolean($startcol + 16);

			$this->deleted = $rs->getBoolean($startcol + 17);

			$this->locked = $rs->getBoolean($startcol + 18);

			$this->created_at = $rs->getTimestamp($startcol + 19, null);

			$this->updated_at = $rs->getTimestamp($startcol + 20, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 21; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Product object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ProductPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ProductPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(ProductPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ProductPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ProductPeer::DATABASE_NAME);
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


												
			if ($this->aProductCategory !== null) {
				if ($this->aProductCategory->isModified()) {
					$affectedRows += $this->aProductCategory->save($con);
				}
				$this->setProductCategory($this->aProductCategory);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ProductPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ProductPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collProductItemList !== null) {
				foreach($this->collProductItemList as $referrerFK) {
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


												
			if ($this->aProductCategory !== null) {
				if (!$this->aProductCategory->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aProductCategory->getValidationFailures());
				}
			}


			if (($retval = ProductPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collProductItemList !== null) {
					foreach($this->collProductItemList as $referrerFK) {
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
		$pos = ProductPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getProductCode();
				break;
			case 2:
				return $this->getProductCategoryId();
				break;
			case 3:
				return $this->getProductName();
				break;
			case 4:
				return $this->getShortName();
				break;
			case 5:
				return $this->getDescription();
				break;
			case 6:
				return $this->getDefaultPrice();
				break;
			case 7:
				return $this->getDefaultWeight();
				break;
			case 8:
				return $this->getIsNew();
				break;
			case 9:
				return $this->getStock();
				break;
			case 10:
				return $this->getImage1();
				break;
			case 11:
				return $this->getImage2();
				break;
			case 12:
				return $this->getImage3();
				break;
			case 13:
				return $this->getImage4();
				break;
			case 14:
				return $this->getImage5();
				break;
			case 15:
				return $this->getEnabled();
				break;
			case 16:
				return $this->getVisible();
				break;
			case 17:
				return $this->getDeleted();
				break;
			case 18:
				return $this->getLocked();
				break;
			case 19:
				return $this->getCreatedAt();
				break;
			case 20:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ProductPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getProductCode(),
			$keys[2]=>$this->getProductCategoryId(),
			$keys[3]=>$this->getProductName(),
			$keys[4]=>$this->getShortName(),
			$keys[5]=>$this->getDescription(),
			$keys[6]=>$this->getDefaultPrice(),
			$keys[7]=>$this->getDefaultWeight(),
			$keys[8]=>$this->getIsNew(),
			$keys[9]=>$this->getStock(),
			$keys[10]=>$this->getImage1(),
			$keys[11]=>$this->getImage2(),
			$keys[12]=>$this->getImage3(),
			$keys[13]=>$this->getImage4(),
			$keys[14]=>$this->getImage5(),
			$keys[15]=>$this->getEnabled(),
			$keys[16]=>$this->getVisible(),
			$keys[17]=>$this->getDeleted(),
			$keys[18]=>$this->getLocked(),
			$keys[19]=>$this->getCreatedAt(),
			$keys[20]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ProductPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setProductCode($value);
				break;
			case 2:
				$this->setProductCategoryId($value);
				break;
			case 3:
				$this->setProductName($value);
				break;
			case 4:
				$this->setShortName($value);
				break;
			case 5:
				$this->setDescription($value);
				break;
			case 6:
				$this->setDefaultPrice($value);
				break;
			case 7:
				$this->setDefaultWeight($value);
				break;
			case 8:
				$this->setIsNew($value);
				break;
			case 9:
				$this->setStock($value);
				break;
			case 10:
				$this->setImage1($value);
				break;
			case 11:
				$this->setImage2($value);
				break;
			case 12:
				$this->setImage3($value);
				break;
			case 13:
				$this->setImage4($value);
				break;
			case 14:
				$this->setImage5($value);
				break;
			case 15:
				$this->setEnabled($value);
				break;
			case 16:
				$this->setVisible($value);
				break;
			case 17:
				$this->setDeleted($value);
				break;
			case 18:
				$this->setLocked($value);
				break;
			case 19:
				$this->setCreatedAt($value);
				break;
			case 20:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ProductPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setProductCode($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setProductCategoryId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setProductName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setShortName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDescription($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDefaultPrice($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setDefaultWeight($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIsNew($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setStock($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setImage1($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setImage2($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setImage3($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setImage4($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setImage5($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setEnabled($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setVisible($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setDeleted($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setLocked($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCreatedAt($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setUpdatedAt($arr[$keys[20]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ProductPeer::DATABASE_NAME);

		if ($this->isColumnModified(ProductPeer::ID)) $criteria->add(ProductPeer::ID, $this->id);
		if ($this->isColumnModified(ProductPeer::PRODUCT_CODE)) $criteria->add(ProductPeer::PRODUCT_CODE, $this->product_code);
		if ($this->isColumnModified(ProductPeer::PRODUCT_CATEGORY_ID)) $criteria->add(ProductPeer::PRODUCT_CATEGORY_ID, $this->product_category_id);
		if ($this->isColumnModified(ProductPeer::PRODUCT_NAME)) $criteria->add(ProductPeer::PRODUCT_NAME, $this->product_name);
		if ($this->isColumnModified(ProductPeer::SHORT_NAME)) $criteria->add(ProductPeer::SHORT_NAME, $this->short_name);
		if ($this->isColumnModified(ProductPeer::DESCRIPTION)) $criteria->add(ProductPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(ProductPeer::DEFAULT_PRICE)) $criteria->add(ProductPeer::DEFAULT_PRICE, $this->default_price);
		if ($this->isColumnModified(ProductPeer::DEFAULT_WEIGHT)) $criteria->add(ProductPeer::DEFAULT_WEIGHT, $this->default_weight);
		if ($this->isColumnModified(ProductPeer::IS_NEW)) $criteria->add(ProductPeer::IS_NEW, $this->is_new);
		if ($this->isColumnModified(ProductPeer::STOCK)) $criteria->add(ProductPeer::STOCK, $this->stock);
		if ($this->isColumnModified(ProductPeer::IMAGE_1)) $criteria->add(ProductPeer::IMAGE_1, $this->image_1);
		if ($this->isColumnModified(ProductPeer::IMAGE_2)) $criteria->add(ProductPeer::IMAGE_2, $this->image_2);
		if ($this->isColumnModified(ProductPeer::IMAGE_3)) $criteria->add(ProductPeer::IMAGE_3, $this->image_3);
		if ($this->isColumnModified(ProductPeer::IMAGE_4)) $criteria->add(ProductPeer::IMAGE_4, $this->image_4);
		if ($this->isColumnModified(ProductPeer::IMAGE_5)) $criteria->add(ProductPeer::IMAGE_5, $this->image_5);
		if ($this->isColumnModified(ProductPeer::ENABLED)) $criteria->add(ProductPeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(ProductPeer::VISIBLE)) $criteria->add(ProductPeer::VISIBLE, $this->visible);
		if ($this->isColumnModified(ProductPeer::DELETED)) $criteria->add(ProductPeer::DELETED, $this->deleted);
		if ($this->isColumnModified(ProductPeer::LOCKED)) $criteria->add(ProductPeer::LOCKED, $this->locked);
		if ($this->isColumnModified(ProductPeer::CREATED_AT)) $criteria->add(ProductPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ProductPeer::UPDATED_AT)) $criteria->add(ProductPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ProductPeer::DATABASE_NAME);

		$criteria->add(ProductPeer::ID, $this->id);

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

		$copyObj->setProductCode($this->product_code);

		$copyObj->setProductCategoryId($this->product_category_id);

		$copyObj->setProductName($this->product_name);

		$copyObj->setShortName($this->short_name);

		$copyObj->setDescription($this->description);

		$copyObj->setDefaultPrice($this->default_price);

		$copyObj->setDefaultWeight($this->default_weight);

		$copyObj->setIsNew($this->is_new);

		$copyObj->setStock($this->stock);

		$copyObj->setImage1($this->image_1);

		$copyObj->setImage2($this->image_2);

		$copyObj->setImage3($this->image_3);

		$copyObj->setImage4($this->image_4);

		$copyObj->setImage5($this->image_5);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setVisible($this->visible);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setLocked($this->locked);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getProductItemList() as $relObj) {
				$copyObj->addProductItem($relObj->copy($deepCopy));
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
			self::$peer = new ProductPeer();
		}
		return self::$peer;
	}

	
	public function setProductCategory($v)
	{


		if ($v === null) {
			$this->setProductCategoryId(NULL);
		} else {
			$this->setProductCategoryId($v->getId());
		}


		$this->aProductCategory = $v;
	}


	
	public function getProductCategory($con = null)
	{
		if ($this->aProductCategory === null && ($this->product_category_id !== null)) {
						include_once 'lib/model/om/BaseProductCategoryPeer.php';

			$this->aProductCategory = ProductCategoryPeer::retrieveByPK($this->product_category_id, $con);

			
		}
		return $this->aProductCategory;
	}

	
	public function initProductItemList()
	{
		if ($this->collProductItemList === null) {
			$this->collProductItemList = array();
		}
	}

	
	public function getProductItemList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseProductItemPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProductItemList === null) {
			if ($this->isNew()) {
			   $this->collProductItemList = array();
			} else {

				$criteria->add(ProductItemPeer::PRODUCT_ID, $this->getId());

				ProductItemPeer::addSelectColumns($criteria);
				$this->collProductItemList = ProductItemPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ProductItemPeer::PRODUCT_ID, $this->getId());

				ProductItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastProductItemCriteria) || !$this->lastProductItemCriteria->equals($criteria)) {
					$this->collProductItemList = ProductItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProductItemCriteria = $criteria;
		return $this->collProductItemList;
	}

	
	public function countProductItemList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseProductItemPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProductItemPeer::PRODUCT_ID, $this->getId());

		return ProductItemPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addProductItem(ProductItem $l)
	{
		$this->collProductItemList[] = $l;
		$l->setProduct($this);
	}


	
	public function getProductItemListJoinProductOptionRelatedByProductOptionIdColor($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseProductItemPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProductItemList === null) {
			if ($this->isNew()) {
				$this->collProductItemList = array();
			} else {

				$criteria->add(ProductItemPeer::PRODUCT_ID, $this->getId());

				$this->collProductItemList = ProductItemPeer::doSelectJoinProductOptionRelatedByProductOptionIdColor($criteria, $con);
			}
		} else {
									
			$criteria->add(ProductItemPeer::PRODUCT_ID, $this->getId());

			if (!isset($this->lastProductItemCriteria) || !$this->lastProductItemCriteria->equals($criteria)) {
				$this->collProductItemList = ProductItemPeer::doSelectJoinProductOptionRelatedByProductOptionIdColor($criteria, $con);
			}
		}
		$this->lastProductItemCriteria = $criteria;

		return $this->collProductItemList;
	}


	
	public function getProductItemListJoinProductOptionRelatedByProductOptionIdSize($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseProductItemPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProductItemList === null) {
			if ($this->isNew()) {
				$this->collProductItemList = array();
			} else {

				$criteria->add(ProductItemPeer::PRODUCT_ID, $this->getId());

				$this->collProductItemList = ProductItemPeer::doSelectJoinProductOptionRelatedByProductOptionIdSize($criteria, $con);
			}
		} else {
									
			$criteria->add(ProductItemPeer::PRODUCT_ID, $this->getId());

			if (!isset($this->lastProductItemCriteria) || !$this->lastProductItemCriteria->equals($criteria)) {
				$this->collProductItemList = ProductItemPeer::doSelectJoinProductOptionRelatedByProductOptionIdSize($criteria, $con);
			}
		}
		$this->lastProductItemCriteria = $criteria;

		return $this->collProductItemList;
	}

} 