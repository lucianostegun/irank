<?php


abstract class BaseProductCategory extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $category_name;


	
	protected $short_name;


	
	protected $description;


	
	protected $tag_name;


	
	protected $enabled;


	
	protected $visible;


	
	protected $deleted;


	
	protected $locked;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collProductList;

	
	protected $lastProductCriteria = null;

	
	protected $collProductOptionList;

	
	protected $lastProductOptionCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getCategoryName()
	{

		return $this->category_name;
	}

	
	public function getShortName()
	{

		return $this->short_name;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getTagName()
	{

		return $this->tag_name;
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
			$this->modifiedColumns[] = ProductCategoryPeer::ID;
		}

	} 
	
	public function setCategoryName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->category_name !== $v) {
			$this->category_name = $v;
			$this->modifiedColumns[] = ProductCategoryPeer::CATEGORY_NAME;
		}

	} 
	
	public function setShortName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->short_name !== $v) {
			$this->short_name = $v;
			$this->modifiedColumns[] = ProductCategoryPeer::SHORT_NAME;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = ProductCategoryPeer::DESCRIPTION;
		}

	} 
	
	public function setTagName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tag_name !== $v) {
			$this->tag_name = $v;
			$this->modifiedColumns[] = ProductCategoryPeer::TAG_NAME;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = ProductCategoryPeer::ENABLED;
		}

	} 
	
	public function setVisible($v)
	{

		if ($this->visible !== $v) {
			$this->visible = $v;
			$this->modifiedColumns[] = ProductCategoryPeer::VISIBLE;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = ProductCategoryPeer::DELETED;
		}

	} 
	
	public function setLocked($v)
	{

		if ($this->locked !== $v) {
			$this->locked = $v;
			$this->modifiedColumns[] = ProductCategoryPeer::LOCKED;
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
			$this->modifiedColumns[] = ProductCategoryPeer::CREATED_AT;
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
			$this->modifiedColumns[] = ProductCategoryPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->category_name = $rs->getString($startcol + 1);

			$this->short_name = $rs->getString($startcol + 2);

			$this->description = $rs->getString($startcol + 3);

			$this->tag_name = $rs->getString($startcol + 4);

			$this->enabled = $rs->getBoolean($startcol + 5);

			$this->visible = $rs->getBoolean($startcol + 6);

			$this->deleted = $rs->getBoolean($startcol + 7);

			$this->locked = $rs->getBoolean($startcol + 8);

			$this->created_at = $rs->getTimestamp($startcol + 9, null);

			$this->updated_at = $rs->getTimestamp($startcol + 10, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ProductCategory object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ProductCategoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ProductCategoryPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(ProductCategoryPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ProductCategoryPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if( $this->isDeleted() )
			throw new PropelException("You cannot save an object that has been deleted.");

		if( $con === null )
			$con = Propel::getConnection(ProductCategoryPeer::DATABASE_NAME);

		$tableName = ProductCategoryPeer::TABLE_NAME;
		
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
					$pk = ProductCategoryPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ProductCategoryPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collProductList !== null) {
				foreach($this->collProductList as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProductOptionList !== null) {
				foreach($this->collProductOptionList as $referrerFK) {
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


			if (($retval = ProductCategoryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collProductList !== null) {
					foreach($this->collProductList as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProductOptionList !== null) {
					foreach($this->collProductOptionList as $referrerFK) {
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
		$pos = ProductCategoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getCategoryName();
				break;
			case 2:
				return $this->getShortName();
				break;
			case 3:
				return $this->getDescription();
				break;
			case 4:
				return $this->getTagName();
				break;
			case 5:
				return $this->getEnabled();
				break;
			case 6:
				return $this->getVisible();
				break;
			case 7:
				return $this->getDeleted();
				break;
			case 8:
				return $this->getLocked();
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
		$keys = ProductCategoryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getCategoryName(),
			$keys[2]=>$this->getShortName(),
			$keys[3]=>$this->getDescription(),
			$keys[4]=>$this->getTagName(),
			$keys[5]=>$this->getEnabled(),
			$keys[6]=>$this->getVisible(),
			$keys[7]=>$this->getDeleted(),
			$keys[8]=>$this->getLocked(),
			$keys[9]=>$this->getCreatedAt(),
			$keys[10]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ProductCategoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setCategoryName($value);
				break;
			case 2:
				$this->setShortName($value);
				break;
			case 3:
				$this->setDescription($value);
				break;
			case 4:
				$this->setTagName($value);
				break;
			case 5:
				$this->setEnabled($value);
				break;
			case 6:
				$this->setVisible($value);
				break;
			case 7:
				$this->setDeleted($value);
				break;
			case 8:
				$this->setLocked($value);
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
		$keys = ProductCategoryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCategoryName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setShortName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDescription($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTagName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setEnabled($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setVisible($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setDeleted($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setLocked($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCreatedAt($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setUpdatedAt($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ProductCategoryPeer::DATABASE_NAME);

		if ($this->isColumnModified(ProductCategoryPeer::ID)) $criteria->add(ProductCategoryPeer::ID, $this->id);
		if ($this->isColumnModified(ProductCategoryPeer::CATEGORY_NAME)) $criteria->add(ProductCategoryPeer::CATEGORY_NAME, $this->category_name);
		if ($this->isColumnModified(ProductCategoryPeer::SHORT_NAME)) $criteria->add(ProductCategoryPeer::SHORT_NAME, $this->short_name);
		if ($this->isColumnModified(ProductCategoryPeer::DESCRIPTION)) $criteria->add(ProductCategoryPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(ProductCategoryPeer::TAG_NAME)) $criteria->add(ProductCategoryPeer::TAG_NAME, $this->tag_name);
		if ($this->isColumnModified(ProductCategoryPeer::ENABLED)) $criteria->add(ProductCategoryPeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(ProductCategoryPeer::VISIBLE)) $criteria->add(ProductCategoryPeer::VISIBLE, $this->visible);
		if ($this->isColumnModified(ProductCategoryPeer::DELETED)) $criteria->add(ProductCategoryPeer::DELETED, $this->deleted);
		if ($this->isColumnModified(ProductCategoryPeer::LOCKED)) $criteria->add(ProductCategoryPeer::LOCKED, $this->locked);
		if ($this->isColumnModified(ProductCategoryPeer::CREATED_AT)) $criteria->add(ProductCategoryPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ProductCategoryPeer::UPDATED_AT)) $criteria->add(ProductCategoryPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ProductCategoryPeer::DATABASE_NAME);

		$criteria->add(ProductCategoryPeer::ID, $this->id);

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

		$copyObj->setCategoryName($this->category_name);

		$copyObj->setShortName($this->short_name);

		$copyObj->setDescription($this->description);

		$copyObj->setTagName($this->tag_name);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setVisible($this->visible);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setLocked($this->locked);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getProductList() as $relObj) {
				$copyObj->addProduct($relObj->copy($deepCopy));
			}

			foreach($this->getProductOptionList() as $relObj) {
				$copyObj->addProductOption($relObj->copy($deepCopy));
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
			self::$peer = new ProductCategoryPeer();
		}
		return self::$peer;
	}

	
	public function initProductList()
	{
		if ($this->collProductList === null) {
			$this->collProductList = array();
		}
	}

	
	public function getProductList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseProductPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProductList === null) {
			if ($this->isNew()) {
			   $this->collProductList = array();
			} else {

				$criteria->add(ProductPeer::PRODUCT_CATEGORY_ID, $this->getId());

				ProductPeer::addSelectColumns($criteria);
				$this->collProductList = ProductPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ProductPeer::PRODUCT_CATEGORY_ID, $this->getId());

				ProductPeer::addSelectColumns($criteria);
				if (!isset($this->lastProductCriteria) || !$this->lastProductCriteria->equals($criteria)) {
					$this->collProductList = ProductPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProductCriteria = $criteria;
		return $this->collProductList;
	}

	
	public function countProductList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseProductPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProductPeer::PRODUCT_CATEGORY_ID, $this->getId());

		return ProductPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addProduct(Product $l)
	{
		$this->collProductList[] = $l;
		$l->setProductCategory($this);
	}

	
	public function initProductOptionList()
	{
		if ($this->collProductOptionList === null) {
			$this->collProductOptionList = array();
		}
	}

	
	public function getProductOptionList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseProductOptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProductOptionList === null) {
			if ($this->isNew()) {
			   $this->collProductOptionList = array();
			} else {

				$criteria->add(ProductOptionPeer::PRODUCT_CATEGORY_ID, $this->getId());

				ProductOptionPeer::addSelectColumns($criteria);
				$this->collProductOptionList = ProductOptionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ProductOptionPeer::PRODUCT_CATEGORY_ID, $this->getId());

				ProductOptionPeer::addSelectColumns($criteria);
				if (!isset($this->lastProductOptionCriteria) || !$this->lastProductOptionCriteria->equals($criteria)) {
					$this->collProductOptionList = ProductOptionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProductOptionCriteria = $criteria;
		return $this->collProductOptionList;
	}

	
	public function countProductOptionList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseProductOptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProductOptionPeer::PRODUCT_CATEGORY_ID, $this->getId());

		return ProductOptionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addProductOption(ProductOption $l)
	{
		$this->collProductOptionList[] = $l;
		$l->setProductCategory($this);
	}

} 