<?php


abstract class BaseProduct extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $product_name;


	
	protected $product_type_id;


	
	protected $is_new;


	
	protected $default_price;


	
	protected $enabled;


	
	protected $visible;


	
	protected $deleted;


	
	protected $locked;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aVirtualTable;

	
	protected $collProductFileList;

	
	protected $lastProductFileCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getProductName()
	{

		return $this->product_name;
	}

	
	public function getProductTypeId()
	{

		return $this->product_type_id;
	}

	
	public function getIsNew()
	{

		return $this->is_new;
	}

	
	public function getDefaultPrice()
	{

		return $this->default_price;
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
	
	public function setProductTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->product_type_id !== $v) {
			$this->product_type_id = $v;
			$this->modifiedColumns[] = ProductPeer::PRODUCT_TYPE_ID;
		}

		if ($this->aVirtualTable !== null && $this->aVirtualTable->getId() !== $v) {
			$this->aVirtualTable = null;
		}

	} 
	
	public function setIsNew($v)
	{

		if ($this->is_new !== $v) {
			$this->is_new = $v;
			$this->modifiedColumns[] = ProductPeer::IS_NEW;
		}

	} 
	
	public function setDefaultPrice($v)
	{

		if ($this->default_price !== $v) {
			$this->default_price = $v;
			$this->modifiedColumns[] = ProductPeer::DEFAULT_PRICE;
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

			$this->product_name = $rs->getString($startcol + 1);

			$this->product_type_id = $rs->getInt($startcol + 2);

			$this->is_new = $rs->getBoolean($startcol + 3);

			$this->default_price = $rs->getFloat($startcol + 4);

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


												
			if ($this->aVirtualTable !== null) {
				if ($this->aVirtualTable->isModified() || $this->aVirtualTable->getCurrentVirtualTableI18n()->isModified()) {
					$affectedRows += $this->aVirtualTable->save($con);
				}
				$this->setVirtualTable($this->aVirtualTable);
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

			if ($this->collProductFileList !== null) {
				foreach($this->collProductFileList as $referrerFK) {
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


												
			if ($this->aVirtualTable !== null) {
				if (!$this->aVirtualTable->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aVirtualTable->getValidationFailures());
				}
			}


			if (($retval = ProductPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collProductFileList !== null) {
					foreach($this->collProductFileList as $referrerFK) {
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
				return $this->getProductName();
				break;
			case 2:
				return $this->getProductTypeId();
				break;
			case 3:
				return $this->getIsNew();
				break;
			case 4:
				return $this->getDefaultPrice();
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
		$keys = ProductPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getProductName(),
			$keys[2]=>$this->getProductTypeId(),
			$keys[3]=>$this->getIsNew(),
			$keys[4]=>$this->getDefaultPrice(),
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
				$this->setProductName($value);
				break;
			case 2:
				$this->setProductTypeId($value);
				break;
			case 3:
				$this->setIsNew($value);
				break;
			case 4:
				$this->setDefaultPrice($value);
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
		$keys = ProductPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setProductName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setProductTypeId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIsNew($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDefaultPrice($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setEnabled($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setVisible($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setDeleted($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setLocked($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCreatedAt($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setUpdatedAt($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ProductPeer::DATABASE_NAME);

		if ($this->isColumnModified(ProductPeer::ID)) $criteria->add(ProductPeer::ID, $this->id);
		if ($this->isColumnModified(ProductPeer::PRODUCT_NAME)) $criteria->add(ProductPeer::PRODUCT_NAME, $this->product_name);
		if ($this->isColumnModified(ProductPeer::PRODUCT_TYPE_ID)) $criteria->add(ProductPeer::PRODUCT_TYPE_ID, $this->product_type_id);
		if ($this->isColumnModified(ProductPeer::IS_NEW)) $criteria->add(ProductPeer::IS_NEW, $this->is_new);
		if ($this->isColumnModified(ProductPeer::DEFAULT_PRICE)) $criteria->add(ProductPeer::DEFAULT_PRICE, $this->default_price);
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

		$copyObj->setProductName($this->product_name);

		$copyObj->setProductTypeId($this->product_type_id);

		$copyObj->setIsNew($this->is_new);

		$copyObj->setDefaultPrice($this->default_price);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setVisible($this->visible);

		$copyObj->setDeleted($this->deleted);

		$copyObj->setLocked($this->locked);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getProductFileList() as $relObj) {
				$copyObj->addProductFile($relObj->copy($deepCopy));
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

	
	public function setVirtualTable($v)
	{


		if ($v === null) {
			$this->setProductTypeId(NULL);
		} else {
			$this->setProductTypeId($v->getId());
		}


		$this->aVirtualTable = $v;
	}


	
	public function getVirtualTable($con = null)
	{
		if ($this->aVirtualTable === null && ($this->product_type_id !== null)) {
						include_once 'lib/model/om/BaseVirtualTablePeer.php';

			$this->aVirtualTable = VirtualTablePeer::retrieveByPK($this->product_type_id, $con);

			
		}
		return $this->aVirtualTable;
	}

	
	public function initProductFileList()
	{
		if ($this->collProductFileList === null) {
			$this->collProductFileList = array();
		}
	}

	
	public function getProductFileList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseProductFilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProductFileList === null) {
			if ($this->isNew()) {
			   $this->collProductFileList = array();
			} else {

				$criteria->add(ProductFilePeer::PRODUCT_ID, $this->getId());

				ProductFilePeer::addSelectColumns($criteria);
				$this->collProductFileList = ProductFilePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ProductFilePeer::PRODUCT_ID, $this->getId());

				ProductFilePeer::addSelectColumns($criteria);
				if (!isset($this->lastProductFileCriteria) || !$this->lastProductFileCriteria->equals($criteria)) {
					$this->collProductFileList = ProductFilePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProductFileCriteria = $criteria;
		return $this->collProductFileList;
	}

	
	public function countProductFileList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseProductFilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProductFilePeer::PRODUCT_ID, $this->getId());

		return ProductFilePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addProductFile(ProductFile $l)
	{
		$this->collProductFileList[] = $l;
		$l->setProduct($this);
	}


	
	public function getProductFileListJoinFile($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseProductFilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProductFileList === null) {
			if ($this->isNew()) {
				$this->collProductFileList = array();
			} else {

				$criteria->add(ProductFilePeer::PRODUCT_ID, $this->getId());

				$this->collProductFileList = ProductFilePeer::doSelectJoinFile($criteria, $con);
			}
		} else {
									
			$criteria->add(ProductFilePeer::PRODUCT_ID, $this->getId());

			if (!isset($this->lastProductFileCriteria) || !$this->lastProductFileCriteria->equals($criteria)) {
				$this->collProductFileList = ProductFilePeer::doSelectJoinFile($criteria, $con);
			}
		}
		$this->lastProductFileCriteria = $criteria;

		return $this->collProductFileList;
	}

} 