<?php


abstract class BaseProductOption extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $product_category_id;


	
	protected $option_type;


	
	protected $option_name;


	
	protected $description;


	
	protected $tag_name;


	
	protected $is_default;


	
	protected $order_seq;


	
	protected $enabled;


	
	protected $visible;


	
	protected $deleted;


	
	protected $locked;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aProductCategory;

	
	protected $collProductItemListRelatedByProductOptionIdColor;

	
	protected $lastProductItemRelatedByProductOptionIdColorCriteria = null;

	
	protected $collProductItemListRelatedByProductOptionIdSize;

	
	protected $lastProductItemRelatedByProductOptionIdSizeCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getProductCategoryId()
	{

		return $this->product_category_id;
	}

	
	public function getOptionType()
	{

		return $this->option_type;
	}

	
	public function getOptionName()
	{

		return $this->option_name;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getTagName()
	{

		return $this->tag_name;
	}

	
	public function getIsDefault()
	{

		return $this->is_default;
	}

	
	public function getOrderSeq()
	{

		return $this->order_seq;
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
			$this->modifiedColumns[] = ProductOptionPeer::ID;
		}

	} 
	
	public function setProductCategoryId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->product_category_id !== $v) {
			$this->product_category_id = $v;
			$this->modifiedColumns[] = ProductOptionPeer::PRODUCT_CATEGORY_ID;
		}

		if ($this->aProductCategory !== null && $this->aProductCategory->getId() !== $v) {
			$this->aProductCategory = null;
		}

	} 
	
	public function setOptionType($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->option_type !== $v) {
			$this->option_type = $v;
			$this->modifiedColumns[] = ProductOptionPeer::OPTION_TYPE;
		}

	} 
	
	public function setOptionName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->option_name !== $v) {
			$this->option_name = $v;
			$this->modifiedColumns[] = ProductOptionPeer::OPTION_NAME;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = ProductOptionPeer::DESCRIPTION;
		}

	} 
	
	public function setTagName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tag_name !== $v) {
			$this->tag_name = $v;
			$this->modifiedColumns[] = ProductOptionPeer::TAG_NAME;
		}

	} 
	
	public function setIsDefault($v)
	{

		if ($this->is_default !== $v) {
			$this->is_default = $v;
			$this->modifiedColumns[] = ProductOptionPeer::IS_DEFAULT;
		}

	} 
	
	public function setOrderSeq($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->order_seq !== $v) {
			$this->order_seq = $v;
			$this->modifiedColumns[] = ProductOptionPeer::ORDER_SEQ;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = ProductOptionPeer::ENABLED;
		}

	} 
	
	public function setVisible($v)
	{

		if ($this->visible !== $v) {
			$this->visible = $v;
			$this->modifiedColumns[] = ProductOptionPeer::VISIBLE;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = ProductOptionPeer::DELETED;
		}

	} 
	
	public function setLocked($v)
	{

		if ($this->locked !== $v) {
			$this->locked = $v;
			$this->modifiedColumns[] = ProductOptionPeer::LOCKED;
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
			$this->modifiedColumns[] = ProductOptionPeer::CREATED_AT;
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
			$this->modifiedColumns[] = ProductOptionPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->product_category_id = $rs->getInt($startcol + 1);

			$this->option_type = $rs->getString($startcol + 2);

			$this->option_name = $rs->getString($startcol + 3);

			$this->description = $rs->getString($startcol + 4);

			$this->tag_name = $rs->getString($startcol + 5);

			$this->is_default = $rs->getBoolean($startcol + 6);

			$this->order_seq = $rs->getInt($startcol + 7);

			$this->enabled = $rs->getBoolean($startcol + 8);

			$this->visible = $rs->getBoolean($startcol + 9);

			$this->deleted = $rs->getBoolean($startcol + 10);

			$this->locked = $rs->getBoolean($startcol + 11);

			$this->created_at = $rs->getTimestamp($startcol + 12, null);

			$this->updated_at = $rs->getTimestamp($startcol + 13, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 14; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ProductOption object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ProductOptionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ProductOptionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(ProductOptionPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ProductOptionPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if( $this->isDeleted() )
			throw new PropelException("You cannot save an object that has been deleted.");

		if( $con === null )
			$con = Propel::getConnection(ProductOptionPeer::DATABASE_NAME);

		$tableName = ProductOptionPeer::TABLE_NAME;
		
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


												
			if ($this->aProductCategory !== null) {
				if ($this->aProductCategory->isModified()) {
					$affectedRows += $this->aProductCategory->save($con);
				}
				$this->setProductCategory($this->aProductCategory);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ProductOptionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ProductOptionPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collProductItemListRelatedByProductOptionIdColor !== null) {
				foreach($this->collProductItemListRelatedByProductOptionIdColor as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProductItemListRelatedByProductOptionIdSize !== null) {
				foreach($this->collProductItemListRelatedByProductOptionIdSize as $referrerFK) {
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


			if (($retval = ProductOptionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collProductItemListRelatedByProductOptionIdColor !== null) {
					foreach($this->collProductItemListRelatedByProductOptionIdColor as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProductItemListRelatedByProductOptionIdSize !== null) {
					foreach($this->collProductItemListRelatedByProductOptionIdSize as $referrerFK) {
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
		$pos = ProductOptionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getProductCategoryId();
				break;
			case 2:
				return $this->getOptionType();
				break;
			case 3:
				return $this->getOptionName();
				break;
			case 4:
				return $this->getDescription();
				break;
			case 5:
				return $this->getTagName();
				break;
			case 6:
				return $this->getIsDefault();
				break;
			case 7:
				return $this->getOrderSeq();
				break;
			case 8:
				return $this->getEnabled();
				break;
			case 9:
				return $this->getVisible();
				break;
			case 10:
				return $this->getDeleted();
				break;
			case 11:
				return $this->getLocked();
				break;
			case 12:
				return $this->getCreatedAt();
				break;
			case 13:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ProductOptionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getProductCategoryId(),
			$keys[2]=>$this->getOptionType(),
			$keys[3]=>$this->getOptionName(),
			$keys[4]=>$this->getDescription(),
			$keys[5]=>$this->getTagName(),
			$keys[6]=>$this->getIsDefault(),
			$keys[7]=>$this->getOrderSeq(),
			$keys[8]=>$this->getEnabled(),
			$keys[9]=>$this->getVisible(),
			$keys[10]=>$this->getDeleted(),
			$keys[11]=>$this->getLocked(),
			$keys[12]=>$this->getCreatedAt(),
			$keys[13]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ProductOptionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setProductCategoryId($value);
				break;
			case 2:
				$this->setOptionType($value);
				break;
			case 3:
				$this->setOptionName($value);
				break;
			case 4:
				$this->setDescription($value);
				break;
			case 5:
				$this->setTagName($value);
				break;
			case 6:
				$this->setIsDefault($value);
				break;
			case 7:
				$this->setOrderSeq($value);
				break;
			case 8:
				$this->setEnabled($value);
				break;
			case 9:
				$this->setVisible($value);
				break;
			case 10:
				$this->setDeleted($value);
				break;
			case 11:
				$this->setLocked($value);
				break;
			case 12:
				$this->setCreatedAt($value);
				break;
			case 13:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ProductOptionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setProductCategoryId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setOptionType($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setOptionName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDescription($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setTagName($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsDefault($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setOrderSeq($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setEnabled($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setVisible($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setDeleted($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setLocked($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCreatedAt($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setUpdatedAt($arr[$keys[13]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ProductOptionPeer::DATABASE_NAME);

		if ($this->isColumnModified(ProductOptionPeer::ID)) $criteria->add(ProductOptionPeer::ID, $this->id);
		if ($this->isColumnModified(ProductOptionPeer::PRODUCT_CATEGORY_ID)) $criteria->add(ProductOptionPeer::PRODUCT_CATEGORY_ID, $this->product_category_id);
		if ($this->isColumnModified(ProductOptionPeer::OPTION_TYPE)) $criteria->add(ProductOptionPeer::OPTION_TYPE, $this->option_type);
		if ($this->isColumnModified(ProductOptionPeer::OPTION_NAME)) $criteria->add(ProductOptionPeer::OPTION_NAME, $this->option_name);
		if ($this->isColumnModified(ProductOptionPeer::DESCRIPTION)) $criteria->add(ProductOptionPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(ProductOptionPeer::TAG_NAME)) $criteria->add(ProductOptionPeer::TAG_NAME, $this->tag_name);
		if ($this->isColumnModified(ProductOptionPeer::IS_DEFAULT)) $criteria->add(ProductOptionPeer::IS_DEFAULT, $this->is_default);
		if ($this->isColumnModified(ProductOptionPeer::ORDER_SEQ)) $criteria->add(ProductOptionPeer::ORDER_SEQ, $this->order_seq);
		if ($this->isColumnModified(ProductOptionPeer::ENABLED)) $criteria->add(ProductOptionPeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(ProductOptionPeer::VISIBLE)) $criteria->add(ProductOptionPeer::VISIBLE, $this->visible);
		if ($this->isColumnModified(ProductOptionPeer::DELETED)) $criteria->add(ProductOptionPeer::DELETED, $this->deleted);
		if ($this->isColumnModified(ProductOptionPeer::LOCKED)) $criteria->add(ProductOptionPeer::LOCKED, $this->locked);
		if ($this->isColumnModified(ProductOptionPeer::CREATED_AT)) $criteria->add(ProductOptionPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ProductOptionPeer::UPDATED_AT)) $criteria->add(ProductOptionPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ProductOptionPeer::DATABASE_NAME);

		$criteria->add(ProductOptionPeer::ID, $this->id);

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

		$copyObj->setProductCategoryId($this->product_category_id);

		$copyObj->setOptionType($this->option_type);

		$copyObj->setOptionName($this->option_name);

		$copyObj->setDescription($this->description);

		$copyObj->setTagName($this->tag_name);

		$copyObj->setIsDefault($this->is_default);

		$copyObj->setOrderSeq($this->order_seq);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setVisible($this->visible);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setLocked($this->locked);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getProductItemListRelatedByProductOptionIdColor() as $relObj) {
				$copyObj->addProductItemRelatedByProductOptionIdColor($relObj->copy($deepCopy));
			}

			foreach($this->getProductItemListRelatedByProductOptionIdSize() as $relObj) {
				$copyObj->addProductItemRelatedByProductOptionIdSize($relObj->copy($deepCopy));
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
			self::$peer = new ProductOptionPeer();
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

	
	public function initProductItemListRelatedByProductOptionIdColor()
	{
		if ($this->collProductItemListRelatedByProductOptionIdColor === null) {
			$this->collProductItemListRelatedByProductOptionIdColor = array();
		}
	}

	
	public function getProductItemListRelatedByProductOptionIdColor($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseProductItemPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProductItemListRelatedByProductOptionIdColor === null) {
			if ($this->isNew()) {
			   $this->collProductItemListRelatedByProductOptionIdColor = array();
			} else {

				$criteria->add(ProductItemPeer::PRODUCT_OPTION_ID_COLOR, $this->getId());

				ProductItemPeer::addSelectColumns($criteria);
				$this->collProductItemListRelatedByProductOptionIdColor = ProductItemPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ProductItemPeer::PRODUCT_OPTION_ID_COLOR, $this->getId());

				ProductItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastProductItemRelatedByProductOptionIdColorCriteria) || !$this->lastProductItemRelatedByProductOptionIdColorCriteria->equals($criteria)) {
					$this->collProductItemListRelatedByProductOptionIdColor = ProductItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProductItemRelatedByProductOptionIdColorCriteria = $criteria;
		return $this->collProductItemListRelatedByProductOptionIdColor;
	}

	
	public function countProductItemListRelatedByProductOptionIdColor($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseProductItemPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProductItemPeer::PRODUCT_OPTION_ID_COLOR, $this->getId());

		return ProductItemPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addProductItemRelatedByProductOptionIdColor(ProductItem $l)
	{
		$this->collProductItemListRelatedByProductOptionIdColor[] = $l;
		$l->setProductOptionRelatedByProductOptionIdColor($this);
	}


	
	public function getProductItemListRelatedByProductOptionIdColorJoinProduct($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseProductItemPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProductItemListRelatedByProductOptionIdColor === null) {
			if ($this->isNew()) {
				$this->collProductItemListRelatedByProductOptionIdColor = array();
			} else {

				$criteria->add(ProductItemPeer::PRODUCT_OPTION_ID_COLOR, $this->getId());

				$this->collProductItemListRelatedByProductOptionIdColor = ProductItemPeer::doSelectJoinProduct($criteria, $con);
			}
		} else {
									
			$criteria->add(ProductItemPeer::PRODUCT_OPTION_ID_COLOR, $this->getId());

			if (!isset($this->lastProductItemRelatedByProductOptionIdColorCriteria) || !$this->lastProductItemRelatedByProductOptionIdColorCriteria->equals($criteria)) {
				$this->collProductItemListRelatedByProductOptionIdColor = ProductItemPeer::doSelectJoinProduct($criteria, $con);
			}
		}
		$this->lastProductItemRelatedByProductOptionIdColorCriteria = $criteria;

		return $this->collProductItemListRelatedByProductOptionIdColor;
	}

	
	public function initProductItemListRelatedByProductOptionIdSize()
	{
		if ($this->collProductItemListRelatedByProductOptionIdSize === null) {
			$this->collProductItemListRelatedByProductOptionIdSize = array();
		}
	}

	
	public function getProductItemListRelatedByProductOptionIdSize($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseProductItemPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProductItemListRelatedByProductOptionIdSize === null) {
			if ($this->isNew()) {
			   $this->collProductItemListRelatedByProductOptionIdSize = array();
			} else {

				$criteria->add(ProductItemPeer::PRODUCT_OPTION_ID_SIZE, $this->getId());

				ProductItemPeer::addSelectColumns($criteria);
				$this->collProductItemListRelatedByProductOptionIdSize = ProductItemPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ProductItemPeer::PRODUCT_OPTION_ID_SIZE, $this->getId());

				ProductItemPeer::addSelectColumns($criteria);
				if (!isset($this->lastProductItemRelatedByProductOptionIdSizeCriteria) || !$this->lastProductItemRelatedByProductOptionIdSizeCriteria->equals($criteria)) {
					$this->collProductItemListRelatedByProductOptionIdSize = ProductItemPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProductItemRelatedByProductOptionIdSizeCriteria = $criteria;
		return $this->collProductItemListRelatedByProductOptionIdSize;
	}

	
	public function countProductItemListRelatedByProductOptionIdSize($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseProductItemPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProductItemPeer::PRODUCT_OPTION_ID_SIZE, $this->getId());

		return ProductItemPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addProductItemRelatedByProductOptionIdSize(ProductItem $l)
	{
		$this->collProductItemListRelatedByProductOptionIdSize[] = $l;
		$l->setProductOptionRelatedByProductOptionIdSize($this);
	}


	
	public function getProductItemListRelatedByProductOptionIdSizeJoinProduct($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseProductItemPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProductItemListRelatedByProductOptionIdSize === null) {
			if ($this->isNew()) {
				$this->collProductItemListRelatedByProductOptionIdSize = array();
			} else {

				$criteria->add(ProductItemPeer::PRODUCT_OPTION_ID_SIZE, $this->getId());

				$this->collProductItemListRelatedByProductOptionIdSize = ProductItemPeer::doSelectJoinProduct($criteria, $con);
			}
		} else {
									
			$criteria->add(ProductItemPeer::PRODUCT_OPTION_ID_SIZE, $this->getId());

			if (!isset($this->lastProductItemRelatedByProductOptionIdSizeCriteria) || !$this->lastProductItemRelatedByProductOptionIdSizeCriteria->equals($criteria)) {
				$this->collProductItemListRelatedByProductOptionIdSize = ProductItemPeer::doSelectJoinProduct($criteria, $con);
			}
		}
		$this->lastProductItemRelatedByProductOptionIdSizeCriteria = $criteria;

		return $this->collProductItemListRelatedByProductOptionIdSize;
	}

} 