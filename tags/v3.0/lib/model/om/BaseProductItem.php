<?php


abstract class BaseProductItem extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $product_id;


	
	protected $product_option_id_color;


	
	protected $product_option_id_size;


	
	protected $price;


	
	protected $weight;


	
	protected $stock;


	
	protected $locked_stock;


	
	protected $image_1;


	
	protected $image_2;


	
	protected $image_3;


	
	protected $image_4;


	
	protected $image_5;


	
	protected $unavailable;


	
	protected $enabled;


	
	protected $visible;


	
	protected $deleted;


	
	protected $locked;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aProduct;

	
	protected $aProductOptionRelatedByProductOptionIdColor;

	
	protected $aProductOptionRelatedByProductOptionIdSize;

	
	protected $collPurchaseProductItemList;

	
	protected $lastPurchaseProductItemCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getProductId()
	{

		return $this->product_id;
	}

	
	public function getProductOptionIdColor()
	{

		return $this->product_option_id_color;
	}

	
	public function getProductOptionIdSize()
	{

		return $this->product_option_id_size;
	}

	
	public function getPrice()
	{

		return $this->price;
	}

	
	public function getWeight()
	{

		return $this->weight;
	}

	
	public function getStock()
	{

		return $this->stock;
	}

	
	public function getLockedStock()
	{

		return $this->locked_stock;
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

	
	public function getUnavailable()
	{

		return $this->unavailable;
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
			$this->modifiedColumns[] = ProductItemPeer::ID;
		}

	} 
	
	public function setProductId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->product_id !== $v) {
			$this->product_id = $v;
			$this->modifiedColumns[] = ProductItemPeer::PRODUCT_ID;
		}

		if ($this->aProduct !== null && $this->aProduct->getId() !== $v) {
			$this->aProduct = null;
		}

	} 
	
	public function setProductOptionIdColor($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->product_option_id_color !== $v) {
			$this->product_option_id_color = $v;
			$this->modifiedColumns[] = ProductItemPeer::PRODUCT_OPTION_ID_COLOR;
		}

		if ($this->aProductOptionRelatedByProductOptionIdColor !== null && $this->aProductOptionRelatedByProductOptionIdColor->getId() !== $v) {
			$this->aProductOptionRelatedByProductOptionIdColor = null;
		}

	} 
	
	public function setProductOptionIdSize($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->product_option_id_size !== $v) {
			$this->product_option_id_size = $v;
			$this->modifiedColumns[] = ProductItemPeer::PRODUCT_OPTION_ID_SIZE;
		}

		if ($this->aProductOptionRelatedByProductOptionIdSize !== null && $this->aProductOptionRelatedByProductOptionIdSize->getId() !== $v) {
			$this->aProductOptionRelatedByProductOptionIdSize = null;
		}

	} 
	
	public function setPrice($v)
	{

		if ($this->price !== $v) {
			$this->price = $v;
			$this->modifiedColumns[] = ProductItemPeer::PRICE;
		}

	} 
	
	public function setWeight($v)
	{

		if ($this->weight !== $v) {
			$this->weight = $v;
			$this->modifiedColumns[] = ProductItemPeer::WEIGHT;
		}

	} 
	
	public function setStock($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->stock !== $v) {
			$this->stock = $v;
			$this->modifiedColumns[] = ProductItemPeer::STOCK;
		}

	} 
	
	public function setLockedStock($v)
	{

		if ($this->locked_stock !== $v) {
			$this->locked_stock = $v;
			$this->modifiedColumns[] = ProductItemPeer::LOCKED_STOCK;
		}

	} 
	
	public function setImage1($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->image_1 !== $v) {
			$this->image_1 = $v;
			$this->modifiedColumns[] = ProductItemPeer::IMAGE_1;
		}

	} 
	
	public function setImage2($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->image_2 !== $v) {
			$this->image_2 = $v;
			$this->modifiedColumns[] = ProductItemPeer::IMAGE_2;
		}

	} 
	
	public function setImage3($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->image_3 !== $v) {
			$this->image_3 = $v;
			$this->modifiedColumns[] = ProductItemPeer::IMAGE_3;
		}

	} 
	
	public function setImage4($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->image_4 !== $v) {
			$this->image_4 = $v;
			$this->modifiedColumns[] = ProductItemPeer::IMAGE_4;
		}

	} 
	
	public function setImage5($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->image_5 !== $v) {
			$this->image_5 = $v;
			$this->modifiedColumns[] = ProductItemPeer::IMAGE_5;
		}

	} 
	
	public function setUnavailable($v)
	{

		if ($this->unavailable !== $v) {
			$this->unavailable = $v;
			$this->modifiedColumns[] = ProductItemPeer::UNAVAILABLE;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = ProductItemPeer::ENABLED;
		}

	} 
	
	public function setVisible($v)
	{

		if ($this->visible !== $v) {
			$this->visible = $v;
			$this->modifiedColumns[] = ProductItemPeer::VISIBLE;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = ProductItemPeer::DELETED;
		}

	} 
	
	public function setLocked($v)
	{

		if ($this->locked !== $v) {
			$this->locked = $v;
			$this->modifiedColumns[] = ProductItemPeer::LOCKED;
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
			$this->modifiedColumns[] = ProductItemPeer::CREATED_AT;
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
			$this->modifiedColumns[] = ProductItemPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->product_id = $rs->getInt($startcol + 1);

			$this->product_option_id_color = $rs->getInt($startcol + 2);

			$this->product_option_id_size = $rs->getInt($startcol + 3);

			$this->price = $rs->getFloat($startcol + 4);

			$this->weight = $rs->getFloat($startcol + 5);

			$this->stock = $rs->getInt($startcol + 6);

			$this->locked_stock = $rs->getBoolean($startcol + 7);

			$this->image_1 = $rs->getString($startcol + 8);

			$this->image_2 = $rs->getString($startcol + 9);

			$this->image_3 = $rs->getString($startcol + 10);

			$this->image_4 = $rs->getString($startcol + 11);

			$this->image_5 = $rs->getString($startcol + 12);

			$this->unavailable = $rs->getBoolean($startcol + 13);

			$this->enabled = $rs->getBoolean($startcol + 14);

			$this->visible = $rs->getBoolean($startcol + 15);

			$this->deleted = $rs->getBoolean($startcol + 16);

			$this->locked = $rs->getBoolean($startcol + 17);

			$this->created_at = $rs->getTimestamp($startcol + 18, null);

			$this->updated_at = $rs->getTimestamp($startcol + 19, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 20; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ProductItem object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ProductItemPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ProductItemPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(ProductItemPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ProductItemPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if( $this->isDeleted() )
			throw new PropelException("You cannot save an object that has been deleted.");

		if( $con === null )
			$con = Propel::getConnection(ProductItemPeer::DATABASE_NAME);

		$tableName = ProductItemPeer::TABLE_NAME;
		
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


												
			if ($this->aProduct !== null) {
				if ($this->aProduct->isModified()) {
					$affectedRows += $this->aProduct->save($con);
				}
				$this->setProduct($this->aProduct);
			}

			if ($this->aProductOptionRelatedByProductOptionIdColor !== null) {
				if ($this->aProductOptionRelatedByProductOptionIdColor->isModified()) {
					$affectedRows += $this->aProductOptionRelatedByProductOptionIdColor->save($con);
				}
				$this->setProductOptionRelatedByProductOptionIdColor($this->aProductOptionRelatedByProductOptionIdColor);
			}

			if ($this->aProductOptionRelatedByProductOptionIdSize !== null) {
				if ($this->aProductOptionRelatedByProductOptionIdSize->isModified()) {
					$affectedRows += $this->aProductOptionRelatedByProductOptionIdSize->save($con);
				}
				$this->setProductOptionRelatedByProductOptionIdSize($this->aProductOptionRelatedByProductOptionIdSize);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ProductItemPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ProductItemPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collPurchaseProductItemList !== null) {
				foreach($this->collPurchaseProductItemList as $referrerFK) {
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


												
			if ($this->aProduct !== null) {
				if (!$this->aProduct->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aProduct->getValidationFailures());
				}
			}

			if ($this->aProductOptionRelatedByProductOptionIdColor !== null) {
				if (!$this->aProductOptionRelatedByProductOptionIdColor->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aProductOptionRelatedByProductOptionIdColor->getValidationFailures());
				}
			}

			if ($this->aProductOptionRelatedByProductOptionIdSize !== null) {
				if (!$this->aProductOptionRelatedByProductOptionIdSize->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aProductOptionRelatedByProductOptionIdSize->getValidationFailures());
				}
			}


			if (($retval = ProductItemPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPurchaseProductItemList !== null) {
					foreach($this->collPurchaseProductItemList as $referrerFK) {
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
		$pos = ProductItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getProductId();
				break;
			case 2:
				return $this->getProductOptionIdColor();
				break;
			case 3:
				return $this->getProductOptionIdSize();
				break;
			case 4:
				return $this->getPrice();
				break;
			case 5:
				return $this->getWeight();
				break;
			case 6:
				return $this->getStock();
				break;
			case 7:
				return $this->getLockedStock();
				break;
			case 8:
				return $this->getImage1();
				break;
			case 9:
				return $this->getImage2();
				break;
			case 10:
				return $this->getImage3();
				break;
			case 11:
				return $this->getImage4();
				break;
			case 12:
				return $this->getImage5();
				break;
			case 13:
				return $this->getUnavailable();
				break;
			case 14:
				return $this->getEnabled();
				break;
			case 15:
				return $this->getVisible();
				break;
			case 16:
				return $this->getDeleted();
				break;
			case 17:
				return $this->getLocked();
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
		$keys = ProductItemPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getProductId(),
			$keys[2]=>$this->getProductOptionIdColor(),
			$keys[3]=>$this->getProductOptionIdSize(),
			$keys[4]=>$this->getPrice(),
			$keys[5]=>$this->getWeight(),
			$keys[6]=>$this->getStock(),
			$keys[7]=>$this->getLockedStock(),
			$keys[8]=>$this->getImage1(),
			$keys[9]=>$this->getImage2(),
			$keys[10]=>$this->getImage3(),
			$keys[11]=>$this->getImage4(),
			$keys[12]=>$this->getImage5(),
			$keys[13]=>$this->getUnavailable(),
			$keys[14]=>$this->getEnabled(),
			$keys[15]=>$this->getVisible(),
			$keys[16]=>$this->getDeleted(),
			$keys[17]=>$this->getLocked(),
			$keys[18]=>$this->getCreatedAt(),
			$keys[19]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ProductItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setProductId($value);
				break;
			case 2:
				$this->setProductOptionIdColor($value);
				break;
			case 3:
				$this->setProductOptionIdSize($value);
				break;
			case 4:
				$this->setPrice($value);
				break;
			case 5:
				$this->setWeight($value);
				break;
			case 6:
				$this->setStock($value);
				break;
			case 7:
				$this->setLockedStock($value);
				break;
			case 8:
				$this->setImage1($value);
				break;
			case 9:
				$this->setImage2($value);
				break;
			case 10:
				$this->setImage3($value);
				break;
			case 11:
				$this->setImage4($value);
				break;
			case 12:
				$this->setImage5($value);
				break;
			case 13:
				$this->setUnavailable($value);
				break;
			case 14:
				$this->setEnabled($value);
				break;
			case 15:
				$this->setVisible($value);
				break;
			case 16:
				$this->setDeleted($value);
				break;
			case 17:
				$this->setLocked($value);
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
		$keys = ProductItemPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setProductId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setProductOptionIdColor($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setProductOptionIdSize($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPrice($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setWeight($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setStock($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setLockedStock($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setImage1($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setImage2($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setImage3($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setImage4($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setImage5($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setUnavailable($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setEnabled($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setVisible($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setDeleted($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setLocked($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCreatedAt($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setUpdatedAt($arr[$keys[19]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ProductItemPeer::DATABASE_NAME);

		if ($this->isColumnModified(ProductItemPeer::ID)) $criteria->add(ProductItemPeer::ID, $this->id);
		if ($this->isColumnModified(ProductItemPeer::PRODUCT_ID)) $criteria->add(ProductItemPeer::PRODUCT_ID, $this->product_id);
		if ($this->isColumnModified(ProductItemPeer::PRODUCT_OPTION_ID_COLOR)) $criteria->add(ProductItemPeer::PRODUCT_OPTION_ID_COLOR, $this->product_option_id_color);
		if ($this->isColumnModified(ProductItemPeer::PRODUCT_OPTION_ID_SIZE)) $criteria->add(ProductItemPeer::PRODUCT_OPTION_ID_SIZE, $this->product_option_id_size);
		if ($this->isColumnModified(ProductItemPeer::PRICE)) $criteria->add(ProductItemPeer::PRICE, $this->price);
		if ($this->isColumnModified(ProductItemPeer::WEIGHT)) $criteria->add(ProductItemPeer::WEIGHT, $this->weight);
		if ($this->isColumnModified(ProductItemPeer::STOCK)) $criteria->add(ProductItemPeer::STOCK, $this->stock);
		if ($this->isColumnModified(ProductItemPeer::LOCKED_STOCK)) $criteria->add(ProductItemPeer::LOCKED_STOCK, $this->locked_stock);
		if ($this->isColumnModified(ProductItemPeer::IMAGE_1)) $criteria->add(ProductItemPeer::IMAGE_1, $this->image_1);
		if ($this->isColumnModified(ProductItemPeer::IMAGE_2)) $criteria->add(ProductItemPeer::IMAGE_2, $this->image_2);
		if ($this->isColumnModified(ProductItemPeer::IMAGE_3)) $criteria->add(ProductItemPeer::IMAGE_3, $this->image_3);
		if ($this->isColumnModified(ProductItemPeer::IMAGE_4)) $criteria->add(ProductItemPeer::IMAGE_4, $this->image_4);
		if ($this->isColumnModified(ProductItemPeer::IMAGE_5)) $criteria->add(ProductItemPeer::IMAGE_5, $this->image_5);
		if ($this->isColumnModified(ProductItemPeer::UNAVAILABLE)) $criteria->add(ProductItemPeer::UNAVAILABLE, $this->unavailable);
		if ($this->isColumnModified(ProductItemPeer::ENABLED)) $criteria->add(ProductItemPeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(ProductItemPeer::VISIBLE)) $criteria->add(ProductItemPeer::VISIBLE, $this->visible);
		if ($this->isColumnModified(ProductItemPeer::DELETED)) $criteria->add(ProductItemPeer::DELETED, $this->deleted);
		if ($this->isColumnModified(ProductItemPeer::LOCKED)) $criteria->add(ProductItemPeer::LOCKED, $this->locked);
		if ($this->isColumnModified(ProductItemPeer::CREATED_AT)) $criteria->add(ProductItemPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ProductItemPeer::UPDATED_AT)) $criteria->add(ProductItemPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ProductItemPeer::DATABASE_NAME);

		$criteria->add(ProductItemPeer::ID, $this->id);

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

		$copyObj->setProductId($this->product_id);

		$copyObj->setProductOptionIdColor($this->product_option_id_color);

		$copyObj->setProductOptionIdSize($this->product_option_id_size);

		$copyObj->setPrice($this->price);

		$copyObj->setWeight($this->weight);

		$copyObj->setStock($this->stock);

		$copyObj->setLockedStock($this->locked_stock);

		$copyObj->setImage1($this->image_1);

		$copyObj->setImage2($this->image_2);

		$copyObj->setImage3($this->image_3);

		$copyObj->setImage4($this->image_4);

		$copyObj->setImage5($this->image_5);

		$copyObj->setUnavailable($this->unavailable);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setVisible($this->visible);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setLocked($this->locked);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getPurchaseProductItemList() as $relObj) {
				$copyObj->addPurchaseProductItem($relObj->copy($deepCopy));
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
			self::$peer = new ProductItemPeer();
		}
		return self::$peer;
	}

	
	public function setProduct($v)
	{


		if ($v === null) {
			$this->setProductId(NULL);
		} else {
			$this->setProductId($v->getId());
		}


		$this->aProduct = $v;
	}


	
	public function getProduct($con = null)
	{
		if ($this->aProduct === null && ($this->product_id !== null)) {
						include_once 'lib/model/om/BaseProductPeer.php';

			$this->aProduct = ProductPeer::retrieveByPK($this->product_id, $con);

			
		}
		return $this->aProduct;
	}

	
	public function setProductOptionRelatedByProductOptionIdColor($v)
	{


		if ($v === null) {
			$this->setProductOptionIdColor(NULL);
		} else {
			$this->setProductOptionIdColor($v->getId());
		}


		$this->aProductOptionRelatedByProductOptionIdColor = $v;
	}


	
	public function getProductOptionRelatedByProductOptionIdColor($con = null)
	{
		if ($this->aProductOptionRelatedByProductOptionIdColor === null && ($this->product_option_id_color !== null)) {
						include_once 'lib/model/om/BaseProductOptionPeer.php';

			$this->aProductOptionRelatedByProductOptionIdColor = ProductOptionPeer::retrieveByPK($this->product_option_id_color, $con);

			
		}
		return $this->aProductOptionRelatedByProductOptionIdColor;
	}

	
	public function setProductOptionRelatedByProductOptionIdSize($v)
	{


		if ($v === null) {
			$this->setProductOptionIdSize(NULL);
		} else {
			$this->setProductOptionIdSize($v->getId());
		}


		$this->aProductOptionRelatedByProductOptionIdSize = $v;
	}


	
	public function getProductOptionRelatedByProductOptionIdSize($con = null)
	{
		if ($this->aProductOptionRelatedByProductOptionIdSize === null && ($this->product_option_id_size !== null)) {
						include_once 'lib/model/om/BaseProductOptionPeer.php';

			$this->aProductOptionRelatedByProductOptionIdSize = ProductOptionPeer::retrieveByPK($this->product_option_id_size, $con);

			
		}
		return $this->aProductOptionRelatedByProductOptionIdSize;
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

				$criteria->add(PurchaseProductItemPeer::PRODUCT_ITEM_ID, $this->getId());

				PurchaseProductItemPeer::addSelectColumns($criteria);
				$this->collPurchaseProductItemList = PurchaseProductItemPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PurchaseProductItemPeer::PRODUCT_ITEM_ID, $this->getId());

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

		$criteria->add(PurchaseProductItemPeer::PRODUCT_ITEM_ID, $this->getId());

		return PurchaseProductItemPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPurchaseProductItem(PurchaseProductItem $l)
	{
		$this->collPurchaseProductItemList[] = $l;
		$l->setProductItem($this);
	}


	
	public function getPurchaseProductItemListJoinPurchase($criteria = null, $con = null)
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

				$criteria->add(PurchaseProductItemPeer::PRODUCT_ITEM_ID, $this->getId());

				$this->collPurchaseProductItemList = PurchaseProductItemPeer::doSelectJoinPurchase($criteria, $con);
			}
		} else {
									
			$criteria->add(PurchaseProductItemPeer::PRODUCT_ITEM_ID, $this->getId());

			if (!isset($this->lastPurchaseProductItemCriteria) || !$this->lastPurchaseProductItemCriteria->equals($criteria)) {
				$this->collPurchaseProductItemList = PurchaseProductItemPeer::doSelectJoinPurchase($criteria, $con);
			}
		}
		$this->lastPurchaseProductItemCriteria = $criteria;

		return $this->collPurchaseProductItemList;
	}

} 