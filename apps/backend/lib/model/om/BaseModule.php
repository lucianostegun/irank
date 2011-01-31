<?php


abstract class BaseModule extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $module_id;


	
	protected $is_menu;


	
	protected $description;


	
	protected $toolbar_description;


	
	protected $image_menu;


	
	protected $image_module;


	
	protected $execute_module;


	
	protected $execute_action;


	
	protected $enabled;


	
	protected $master_only;


	
	protected $has_child;


	
	protected $order_seq;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aModuleRelatedByModuleId;

	
	protected $collModuleListRelatedByModuleId;

	
	protected $lastModuleRelatedByModuleIdCriteria = null;

	
	protected $collToolbarList;

	
	protected $lastToolbarCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getModuleId()
	{

		return $this->module_id;
	}

	
	public function getIsMenu()
	{

		return $this->is_menu;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getToolbarDescription()
	{

		return $this->toolbar_description;
	}

	
	public function getImageMenu()
	{

		return $this->image_menu;
	}

	
	public function getImageModule()
	{

		return $this->image_module;
	}

	
	public function getExecuteModule()
	{

		return $this->execute_module;
	}

	
	public function getExecuteAction()
	{

		return $this->execute_action;
	}

	
	public function getEnabled()
	{

		return $this->enabled;
	}

	
	public function getMasterOnly()
	{

		return $this->master_only;
	}

	
	public function getHasChild()
	{

		return $this->has_child;
	}

	
	public function getOrderSeq()
	{

		return $this->order_seq;
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
			$this->modifiedColumns[] = ModulePeer::ID;
		}

	} 
	
	public function setModuleId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->module_id !== $v) {
			$this->module_id = $v;
			$this->modifiedColumns[] = ModulePeer::MODULE_ID;
		}

		if ($this->aModuleRelatedByModuleId !== null && $this->aModuleRelatedByModuleId->getId() !== $v) {
			$this->aModuleRelatedByModuleId = null;
		}

	} 
	
	public function setIsMenu($v)
	{

		if ($this->is_menu !== $v) {
			$this->is_menu = $v;
			$this->modifiedColumns[] = ModulePeer::IS_MENU;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = ModulePeer::DESCRIPTION;
		}

	} 
	
	public function setToolbarDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->toolbar_description !== $v) {
			$this->toolbar_description = $v;
			$this->modifiedColumns[] = ModulePeer::TOOLBAR_DESCRIPTION;
		}

	} 
	
	public function setImageMenu($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->image_menu !== $v) {
			$this->image_menu = $v;
			$this->modifiedColumns[] = ModulePeer::IMAGE_MENU;
		}

	} 
	
	public function setImageModule($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->image_module !== $v) {
			$this->image_module = $v;
			$this->modifiedColumns[] = ModulePeer::IMAGE_MODULE;
		}

	} 
	
	public function setExecuteModule($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->execute_module !== $v) {
			$this->execute_module = $v;
			$this->modifiedColumns[] = ModulePeer::EXECUTE_MODULE;
		}

	} 
	
	public function setExecuteAction($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->execute_action !== $v) {
			$this->execute_action = $v;
			$this->modifiedColumns[] = ModulePeer::EXECUTE_ACTION;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = ModulePeer::ENABLED;
		}

	} 
	
	public function setMasterOnly($v)
	{

		if ($this->master_only !== $v) {
			$this->master_only = $v;
			$this->modifiedColumns[] = ModulePeer::MASTER_ONLY;
		}

	} 
	
	public function setHasChild($v)
	{

		if ($this->has_child !== $v) {
			$this->has_child = $v;
			$this->modifiedColumns[] = ModulePeer::HAS_CHILD;
		}

	} 
	
	public function setOrderSeq($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->order_seq !== $v) {
			$this->order_seq = $v;
			$this->modifiedColumns[] = ModulePeer::ORDER_SEQ;
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
			$this->modifiedColumns[] = ModulePeer::CREATED_AT;
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
			$this->modifiedColumns[] = ModulePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->module_id = $rs->getInt($startcol + 1);

			$this->is_menu = $rs->getBoolean($startcol + 2);

			$this->description = $rs->getString($startcol + 3);

			$this->toolbar_description = $rs->getString($startcol + 4);

			$this->image_menu = $rs->getString($startcol + 5);

			$this->image_module = $rs->getString($startcol + 6);

			$this->execute_module = $rs->getString($startcol + 7);

			$this->execute_action = $rs->getString($startcol + 8);

			$this->enabled = $rs->getBoolean($startcol + 9);

			$this->master_only = $rs->getBoolean($startcol + 10);

			$this->has_child = $rs->getBoolean($startcol + 11);

			$this->order_seq = $rs->getInt($startcol + 12);

			$this->created_at = $rs->getTimestamp($startcol + 13, null);

			$this->updated_at = $rs->getTimestamp($startcol + 14, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 15; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Module object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ModulePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ModulePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(ModulePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ModulePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ModulePeer::DATABASE_NAME);
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


												
			if ($this->aModuleRelatedByModuleId !== null) {
				if ($this->aModuleRelatedByModuleId->isModified()) {
					$affectedRows += $this->aModuleRelatedByModuleId->save($con);
				}
				$this->setModuleRelatedByModuleId($this->aModuleRelatedByModuleId);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ModulePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ModulePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collModuleListRelatedByModuleId !== null) {
				foreach($this->collModuleListRelatedByModuleId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collToolbarList !== null) {
				foreach($this->collToolbarList as $referrerFK) {
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


												
			if ($this->aModuleRelatedByModuleId !== null) {
				if (!$this->aModuleRelatedByModuleId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aModuleRelatedByModuleId->getValidationFailures());
				}
			}


			if (($retval = ModulePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collToolbarList !== null) {
					foreach($this->collToolbarList as $referrerFK) {
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
		$pos = ModulePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getModuleId();
				break;
			case 2:
				return $this->getIsMenu();
				break;
			case 3:
				return $this->getDescription();
				break;
			case 4:
				return $this->getToolbarDescription();
				break;
			case 5:
				return $this->getImageMenu();
				break;
			case 6:
				return $this->getImageModule();
				break;
			case 7:
				return $this->getExecuteModule();
				break;
			case 8:
				return $this->getExecuteAction();
				break;
			case 9:
				return $this->getEnabled();
				break;
			case 10:
				return $this->getMasterOnly();
				break;
			case 11:
				return $this->getHasChild();
				break;
			case 12:
				return $this->getOrderSeq();
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
		$keys = ModulePeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getModuleId(),
			$keys[2]=>$this->getIsMenu(),
			$keys[3]=>$this->getDescription(),
			$keys[4]=>$this->getToolbarDescription(),
			$keys[5]=>$this->getImageMenu(),
			$keys[6]=>$this->getImageModule(),
			$keys[7]=>$this->getExecuteModule(),
			$keys[8]=>$this->getExecuteAction(),
			$keys[9]=>$this->getEnabled(),
			$keys[10]=>$this->getMasterOnly(),
			$keys[11]=>$this->getHasChild(),
			$keys[12]=>$this->getOrderSeq(),
			$keys[13]=>$this->getCreatedAt(),
			$keys[14]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ModulePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setModuleId($value);
				break;
			case 2:
				$this->setIsMenu($value);
				break;
			case 3:
				$this->setDescription($value);
				break;
			case 4:
				$this->setToolbarDescription($value);
				break;
			case 5:
				$this->setImageMenu($value);
				break;
			case 6:
				$this->setImageModule($value);
				break;
			case 7:
				$this->setExecuteModule($value);
				break;
			case 8:
				$this->setExecuteAction($value);
				break;
			case 9:
				$this->setEnabled($value);
				break;
			case 10:
				$this->setMasterOnly($value);
				break;
			case 11:
				$this->setHasChild($value);
				break;
			case 12:
				$this->setOrderSeq($value);
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
		$keys = ModulePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setModuleId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIsMenu($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDescription($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setToolbarDescription($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setImageMenu($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setImageModule($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setExecuteModule($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setExecuteAction($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setEnabled($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setMasterOnly($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setHasChild($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setOrderSeq($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCreatedAt($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setUpdatedAt($arr[$keys[14]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ModulePeer::DATABASE_NAME);

		if ($this->isColumnModified(ModulePeer::ID)) $criteria->add(ModulePeer::ID, $this->id);
		if ($this->isColumnModified(ModulePeer::MODULE_ID)) $criteria->add(ModulePeer::MODULE_ID, $this->module_id);
		if ($this->isColumnModified(ModulePeer::IS_MENU)) $criteria->add(ModulePeer::IS_MENU, $this->is_menu);
		if ($this->isColumnModified(ModulePeer::DESCRIPTION)) $criteria->add(ModulePeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(ModulePeer::TOOLBAR_DESCRIPTION)) $criteria->add(ModulePeer::TOOLBAR_DESCRIPTION, $this->toolbar_description);
		if ($this->isColumnModified(ModulePeer::IMAGE_MENU)) $criteria->add(ModulePeer::IMAGE_MENU, $this->image_menu);
		if ($this->isColumnModified(ModulePeer::IMAGE_MODULE)) $criteria->add(ModulePeer::IMAGE_MODULE, $this->image_module);
		if ($this->isColumnModified(ModulePeer::EXECUTE_MODULE)) $criteria->add(ModulePeer::EXECUTE_MODULE, $this->execute_module);
		if ($this->isColumnModified(ModulePeer::EXECUTE_ACTION)) $criteria->add(ModulePeer::EXECUTE_ACTION, $this->execute_action);
		if ($this->isColumnModified(ModulePeer::ENABLED)) $criteria->add(ModulePeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(ModulePeer::MASTER_ONLY)) $criteria->add(ModulePeer::MASTER_ONLY, $this->master_only);
		if ($this->isColumnModified(ModulePeer::HAS_CHILD)) $criteria->add(ModulePeer::HAS_CHILD, $this->has_child);
		if ($this->isColumnModified(ModulePeer::ORDER_SEQ)) $criteria->add(ModulePeer::ORDER_SEQ, $this->order_seq);
		if ($this->isColumnModified(ModulePeer::CREATED_AT)) $criteria->add(ModulePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ModulePeer::UPDATED_AT)) $criteria->add(ModulePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ModulePeer::DATABASE_NAME);

		$criteria->add(ModulePeer::ID, $this->id);

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

		$copyObj->setModuleId($this->module_id);

		$copyObj->setIsMenu($this->is_menu);

		$copyObj->setDescription($this->description);

		$copyObj->setToolbarDescription($this->toolbar_description);

		$copyObj->setImageMenu($this->image_menu);

		$copyObj->setImageModule($this->image_module);

		$copyObj->setExecuteModule($this->execute_module);

		$copyObj->setExecuteAction($this->execute_action);

		$copyObj->setEnabled($this->enabled);

		$copyObj->setMasterOnly($this->master_only);

		$copyObj->setHasChild($this->has_child);

		$copyObj->setOrderSeq($this->order_seq);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getModuleListRelatedByModuleId() as $relObj) {
				if($this->getPrimaryKey() === $relObj->getPrimaryKey()) {
						continue;
				}

				$copyObj->addModuleRelatedByModuleId($relObj->copy($deepCopy));
			}

			foreach($this->getToolbarList() as $relObj) {
				$copyObj->addToolbar($relObj->copy($deepCopy));
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
			self::$peer = new ModulePeer();
		}
		return self::$peer;
	}

	
	public function setModuleRelatedByModuleId($v)
	{


		if ($v === null) {
			$this->setModuleId(NULL);
		} else {
			$this->setModuleId($v->getId());
		}


		$this->aModuleRelatedByModuleId = $v;
	}


	
	public function getModuleRelatedByModuleId($con = null)
	{
		if ($this->aModuleRelatedByModuleId === null && ($this->module_id !== null)) {
						include_once 'apps/backend/lib/model/om/BaseModulePeer.php';

			$this->aModuleRelatedByModuleId = ModulePeer::retrieveByPK($this->module_id, $con);

			
		}
		return $this->aModuleRelatedByModuleId;
	}

	
	public function initModuleListRelatedByModuleId()
	{
		if ($this->collModuleListRelatedByModuleId === null) {
			$this->collModuleListRelatedByModuleId = array();
		}
	}

	
	public function getModuleListRelatedByModuleId($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseModulePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collModuleListRelatedByModuleId === null) {
			if ($this->isNew()) {
			   $this->collModuleListRelatedByModuleId = array();
			} else {

				$criteria->add(ModulePeer::MODULE_ID, $this->getId());

				ModulePeer::addSelectColumns($criteria);
				$this->collModuleListRelatedByModuleId = ModulePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ModulePeer::MODULE_ID, $this->getId());

				ModulePeer::addSelectColumns($criteria);
				if (!isset($this->lastModuleRelatedByModuleIdCriteria) || !$this->lastModuleRelatedByModuleIdCriteria->equals($criteria)) {
					$this->collModuleListRelatedByModuleId = ModulePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastModuleRelatedByModuleIdCriteria = $criteria;
		return $this->collModuleListRelatedByModuleId;
	}

	
	public function countModuleListRelatedByModuleId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseModulePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ModulePeer::MODULE_ID, $this->getId());

		return ModulePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addModuleRelatedByModuleId(Module $l)
	{
		$this->collModuleListRelatedByModuleId[] = $l;
		$l->setModuleRelatedByModuleId($this);
	}

	
	public function initToolbarList()
	{
		if ($this->collToolbarList === null) {
			$this->collToolbarList = array();
		}
	}

	
	public function getToolbarList($criteria = null, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseToolbarPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collToolbarList === null) {
			if ($this->isNew()) {
			   $this->collToolbarList = array();
			} else {

				$criteria->add(ToolbarPeer::MODULE_ID, $this->getId());

				ToolbarPeer::addSelectColumns($criteria);
				$this->collToolbarList = ToolbarPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ToolbarPeer::MODULE_ID, $this->getId());

				ToolbarPeer::addSelectColumns($criteria);
				if (!isset($this->lastToolbarCriteria) || !$this->lastToolbarCriteria->equals($criteria)) {
					$this->collToolbarList = ToolbarPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastToolbarCriteria = $criteria;
		return $this->collToolbarList;
	}

	
	public function countToolbarList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'apps/backend/lib/model/om/BaseToolbarPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ToolbarPeer::MODULE_ID, $this->getId());

		return ToolbarPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addToolbar(Toolbar $l)
	{
		$this->collToolbarList[] = $l;
		$l->setModule($this);
	}

} 