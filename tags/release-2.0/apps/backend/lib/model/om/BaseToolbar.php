<?php


abstract class BaseToolbar extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $module_id;


	
	protected $description;


	
	protected $tag_name;


	
	protected $tag_id;


	
	protected $image;


	
	protected $action_name;


	
	protected $execute_module;


	
	protected $execute_action;


	
	protected $is_javascript;


	
	protected $order_seq;


	
	protected $start_disabled;


	
	protected $visible_action;


	
	protected $enabled;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aModule;

	
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

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getTagName()
	{

		return $this->tag_name;
	}

	
	public function getTagId()
	{

		return $this->tag_id;
	}

	
	public function getImage()
	{

		return $this->image;
	}

	
	public function getActionName()
	{

		return $this->action_name;
	}

	
	public function getExecuteModule()
	{

		return $this->execute_module;
	}

	
	public function getExecuteAction()
	{

		return $this->execute_action;
	}

	
	public function getIsJavascript()
	{

		return $this->is_javascript;
	}

	
	public function getOrderSeq()
	{

		return $this->order_seq;
	}

	
	public function getStartDisabled()
	{

		return $this->start_disabled;
	}

	
	public function getVisibleAction()
	{

		return $this->visible_action;
	}

	
	public function getEnabled()
	{

		return $this->enabled;
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
			$this->modifiedColumns[] = ToolbarPeer::ID;
		}

	} 
	
	public function setModuleId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->module_id !== $v) {
			$this->module_id = $v;
			$this->modifiedColumns[] = ToolbarPeer::MODULE_ID;
		}

		if ($this->aModule !== null && $this->aModule->getId() !== $v) {
			$this->aModule = null;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = ToolbarPeer::DESCRIPTION;
		}

	} 
	
	public function setTagName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tag_name !== $v) {
			$this->tag_name = $v;
			$this->modifiedColumns[] = ToolbarPeer::TAG_NAME;
		}

	} 
	
	public function setTagId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tag_id !== $v) {
			$this->tag_id = $v;
			$this->modifiedColumns[] = ToolbarPeer::TAG_ID;
		}

	} 
	
	public function setImage($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->image !== $v) {
			$this->image = $v;
			$this->modifiedColumns[] = ToolbarPeer::IMAGE;
		}

	} 
	
	public function setActionName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->action_name !== $v) {
			$this->action_name = $v;
			$this->modifiedColumns[] = ToolbarPeer::ACTION_NAME;
		}

	} 
	
	public function setExecuteModule($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->execute_module !== $v) {
			$this->execute_module = $v;
			$this->modifiedColumns[] = ToolbarPeer::EXECUTE_MODULE;
		}

	} 
	
	public function setExecuteAction($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->execute_action !== $v) {
			$this->execute_action = $v;
			$this->modifiedColumns[] = ToolbarPeer::EXECUTE_ACTION;
		}

	} 
	
	public function setIsJavascript($v)
	{

		if ($this->is_javascript !== $v) {
			$this->is_javascript = $v;
			$this->modifiedColumns[] = ToolbarPeer::IS_JAVASCRIPT;
		}

	} 
	
	public function setOrderSeq($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->order_seq !== $v) {
			$this->order_seq = $v;
			$this->modifiedColumns[] = ToolbarPeer::ORDER_SEQ;
		}

	} 
	
	public function setStartDisabled($v)
	{

		if ($this->start_disabled !== $v) {
			$this->start_disabled = $v;
			$this->modifiedColumns[] = ToolbarPeer::START_DISABLED;
		}

	} 
	
	public function setVisibleAction($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->visible_action !== $v) {
			$this->visible_action = $v;
			$this->modifiedColumns[] = ToolbarPeer::VISIBLE_ACTION;
		}

	} 
	
	public function setEnabled($v)
	{

		if ($this->enabled !== $v) {
			$this->enabled = $v;
			$this->modifiedColumns[] = ToolbarPeer::ENABLED;
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
			$this->modifiedColumns[] = ToolbarPeer::CREATED_AT;
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
			$this->modifiedColumns[] = ToolbarPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->module_id = $rs->getInt($startcol + 1);

			$this->description = $rs->getString($startcol + 2);

			$this->tag_name = $rs->getString($startcol + 3);

			$this->tag_id = $rs->getString($startcol + 4);

			$this->image = $rs->getString($startcol + 5);

			$this->action_name = $rs->getString($startcol + 6);

			$this->execute_module = $rs->getString($startcol + 7);

			$this->execute_action = $rs->getString($startcol + 8);

			$this->is_javascript = $rs->getBoolean($startcol + 9);

			$this->order_seq = $rs->getInt($startcol + 10);

			$this->start_disabled = $rs->getBoolean($startcol + 11);

			$this->visible_action = $rs->getString($startcol + 12);

			$this->enabled = $rs->getBoolean($startcol + 13);

			$this->created_at = $rs->getTimestamp($startcol + 14, null);

			$this->updated_at = $rs->getTimestamp($startcol + 15, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 16; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Toolbar object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ToolbarPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ToolbarPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(ToolbarPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ToolbarPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ToolbarPeer::DATABASE_NAME);
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


												
			if ($this->aModule !== null) {
				if ($this->aModule->isModified()) {
					$affectedRows += $this->aModule->save($con);
				}
				$this->setModule($this->aModule);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ToolbarPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ToolbarPeer::doUpdate($this, $con);
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


												
			if ($this->aModule !== null) {
				if (!$this->aModule->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aModule->getValidationFailures());
				}
			}


			if (($retval = ToolbarPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ToolbarPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getDescription();
				break;
			case 3:
				return $this->getTagName();
				break;
			case 4:
				return $this->getTagId();
				break;
			case 5:
				return $this->getImage();
				break;
			case 6:
				return $this->getActionName();
				break;
			case 7:
				return $this->getExecuteModule();
				break;
			case 8:
				return $this->getExecuteAction();
				break;
			case 9:
				return $this->getIsJavascript();
				break;
			case 10:
				return $this->getOrderSeq();
				break;
			case 11:
				return $this->getStartDisabled();
				break;
			case 12:
				return $this->getVisibleAction();
				break;
			case 13:
				return $this->getEnabled();
				break;
			case 14:
				return $this->getCreatedAt();
				break;
			case 15:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ToolbarPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getModuleId(),
			$keys[2]=>$this->getDescription(),
			$keys[3]=>$this->getTagName(),
			$keys[4]=>$this->getTagId(),
			$keys[5]=>$this->getImage(),
			$keys[6]=>$this->getActionName(),
			$keys[7]=>$this->getExecuteModule(),
			$keys[8]=>$this->getExecuteAction(),
			$keys[9]=>$this->getIsJavascript(),
			$keys[10]=>$this->getOrderSeq(),
			$keys[11]=>$this->getStartDisabled(),
			$keys[12]=>$this->getVisibleAction(),
			$keys[13]=>$this->getEnabled(),
			$keys[14]=>$this->getCreatedAt(),
			$keys[15]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ToolbarPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setDescription($value);
				break;
			case 3:
				$this->setTagName($value);
				break;
			case 4:
				$this->setTagId($value);
				break;
			case 5:
				$this->setImage($value);
				break;
			case 6:
				$this->setActionName($value);
				break;
			case 7:
				$this->setExecuteModule($value);
				break;
			case 8:
				$this->setExecuteAction($value);
				break;
			case 9:
				$this->setIsJavascript($value);
				break;
			case 10:
				$this->setOrderSeq($value);
				break;
			case 11:
				$this->setStartDisabled($value);
				break;
			case 12:
				$this->setVisibleAction($value);
				break;
			case 13:
				$this->setEnabled($value);
				break;
			case 14:
				$this->setCreatedAt($value);
				break;
			case 15:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ToolbarPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setModuleId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTagName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTagId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setImage($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setActionName($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setExecuteModule($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setExecuteAction($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setIsJavascript($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setOrderSeq($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setStartDisabled($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setVisibleAction($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setEnabled($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCreatedAt($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setUpdatedAt($arr[$keys[15]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ToolbarPeer::DATABASE_NAME);

		if ($this->isColumnModified(ToolbarPeer::ID)) $criteria->add(ToolbarPeer::ID, $this->id);
		if ($this->isColumnModified(ToolbarPeer::MODULE_ID)) $criteria->add(ToolbarPeer::MODULE_ID, $this->module_id);
		if ($this->isColumnModified(ToolbarPeer::DESCRIPTION)) $criteria->add(ToolbarPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(ToolbarPeer::TAG_NAME)) $criteria->add(ToolbarPeer::TAG_NAME, $this->tag_name);
		if ($this->isColumnModified(ToolbarPeer::TAG_ID)) $criteria->add(ToolbarPeer::TAG_ID, $this->tag_id);
		if ($this->isColumnModified(ToolbarPeer::IMAGE)) $criteria->add(ToolbarPeer::IMAGE, $this->image);
		if ($this->isColumnModified(ToolbarPeer::ACTION_NAME)) $criteria->add(ToolbarPeer::ACTION_NAME, $this->action_name);
		if ($this->isColumnModified(ToolbarPeer::EXECUTE_MODULE)) $criteria->add(ToolbarPeer::EXECUTE_MODULE, $this->execute_module);
		if ($this->isColumnModified(ToolbarPeer::EXECUTE_ACTION)) $criteria->add(ToolbarPeer::EXECUTE_ACTION, $this->execute_action);
		if ($this->isColumnModified(ToolbarPeer::IS_JAVASCRIPT)) $criteria->add(ToolbarPeer::IS_JAVASCRIPT, $this->is_javascript);
		if ($this->isColumnModified(ToolbarPeer::ORDER_SEQ)) $criteria->add(ToolbarPeer::ORDER_SEQ, $this->order_seq);
		if ($this->isColumnModified(ToolbarPeer::START_DISABLED)) $criteria->add(ToolbarPeer::START_DISABLED, $this->start_disabled);
		if ($this->isColumnModified(ToolbarPeer::VISIBLE_ACTION)) $criteria->add(ToolbarPeer::VISIBLE_ACTION, $this->visible_action);
		if ($this->isColumnModified(ToolbarPeer::ENABLED)) $criteria->add(ToolbarPeer::ENABLED, $this->enabled);
		if ($this->isColumnModified(ToolbarPeer::CREATED_AT)) $criteria->add(ToolbarPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ToolbarPeer::UPDATED_AT)) $criteria->add(ToolbarPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ToolbarPeer::DATABASE_NAME);

		$criteria->add(ToolbarPeer::ID, $this->id);

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

		$copyObj->setDescription($this->description);

		$copyObj->setTagName($this->tag_name);

		$copyObj->setTagId($this->tag_id);

		$copyObj->setImage($this->image);

		$copyObj->setActionName($this->action_name);

		$copyObj->setExecuteModule($this->execute_module);

		$copyObj->setExecuteAction($this->execute_action);

		$copyObj->setIsJavascript($this->is_javascript);

		$copyObj->setOrderSeq($this->order_seq);

		$copyObj->setStartDisabled($this->start_disabled);

		$copyObj->setVisibleAction($this->visible_action);

		$copyObj->setEnabled($this->enabled);

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
			self::$peer = new ToolbarPeer();
		}
		return self::$peer;
	}

	
	public function setModule($v)
	{


		if ($v === null) {
			$this->setModuleId(NULL);
		} else {
			$this->setModuleId($v->getId());
		}


		$this->aModule = $v;
	}


	
	public function getModule($con = null)
	{
		if ($this->aModule === null && ($this->module_id !== null)) {
						include_once 'apps/backend/lib/model/om/BaseModulePeer.php';

			$this->aModule = ModulePeer::retrieveByPK($this->module_id, $con);

			
		}
		return $this->aModule;
	}

} 