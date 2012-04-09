<?php


abstract class BaseLog extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $user_site_id;


	
	protected $app;


	
	protected $module_name;


	
	protected $action_name;


	
	protected $class_name;


	
	protected $severity;


	
	protected $message;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collLogFieldList;

	
	protected $lastLogFieldCriteria = null;

	
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

	
	public function getApp()
	{

		return $this->app;
	}

	
	public function getModuleName()
	{

		return $this->module_name;
	}

	
	public function getActionName()
	{

		return $this->action_name;
	}

	
	public function getClassName()
	{

		return $this->class_name;
	}

	
	public function getSeverity()
	{

		return $this->severity;
	}

	
	public function getMessage()
	{

		return $this->message;
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
			$this->modifiedColumns[] = LogPeer::ID;
		}

	} 
	
	public function setUserSiteId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_site_id !== $v) {
			$this->user_site_id = $v;
			$this->modifiedColumns[] = LogPeer::USER_SITE_ID;
		}

	} 
	
	public function setApp($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->app !== $v) {
			$this->app = $v;
			$this->modifiedColumns[] = LogPeer::APP;
		}

	} 
	
	public function setModuleName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->module_name !== $v) {
			$this->module_name = $v;
			$this->modifiedColumns[] = LogPeer::MODULE_NAME;
		}

	} 
	
	public function setActionName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->action_name !== $v) {
			$this->action_name = $v;
			$this->modifiedColumns[] = LogPeer::ACTION_NAME;
		}

	} 
	
	public function setClassName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->class_name !== $v) {
			$this->class_name = $v;
			$this->modifiedColumns[] = LogPeer::CLASS_NAME;
		}

	} 
	
	public function setSeverity($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->severity !== $v) {
			$this->severity = $v;
			$this->modifiedColumns[] = LogPeer::SEVERITY;
		}

	} 
	
	public function setMessage($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->message !== $v) {
			$this->message = $v;
			$this->modifiedColumns[] = LogPeer::MESSAGE;
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
			$this->modifiedColumns[] = LogPeer::CREATED_AT;
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
			$this->modifiedColumns[] = LogPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->user_site_id = $rs->getInt($startcol + 1);

			$this->app = $rs->getString($startcol + 2);

			$this->module_name = $rs->getString($startcol + 3);

			$this->action_name = $rs->getString($startcol + 4);

			$this->class_name = $rs->getString($startcol + 5);

			$this->severity = $rs->getInt($startcol + 6);

			$this->message = $rs->getString($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->updated_at = $rs->getTimestamp($startcol + 9, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Log object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(LogPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			LogPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(LogPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(LogPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(LogPeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = LogPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += LogPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collLogFieldList !== null) {
				foreach($this->collLogFieldList as $referrerFK) {
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


			if (($retval = LogPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collLogFieldList !== null) {
					foreach($this->collLogFieldList as $referrerFK) {
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
		$pos = LogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getApp();
				break;
			case 3:
				return $this->getModuleName();
				break;
			case 4:
				return $this->getActionName();
				break;
			case 5:
				return $this->getClassName();
				break;
			case 6:
				return $this->getSeverity();
				break;
			case 7:
				return $this->getMessage();
				break;
			case 8:
				return $this->getCreatedAt();
				break;
			case 9:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = LogPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getUserSiteId(),
			$keys[2]=>$this->getApp(),
			$keys[3]=>$this->getModuleName(),
			$keys[4]=>$this->getActionName(),
			$keys[5]=>$this->getClassName(),
			$keys[6]=>$this->getSeverity(),
			$keys[7]=>$this->getMessage(),
			$keys[8]=>$this->getCreatedAt(),
			$keys[9]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = LogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setApp($value);
				break;
			case 3:
				$this->setModuleName($value);
				break;
			case 4:
				$this->setActionName($value);
				break;
			case 5:
				$this->setClassName($value);
				break;
			case 6:
				$this->setSeverity($value);
				break;
			case 7:
				$this->setMessage($value);
				break;
			case 8:
				$this->setCreatedAt($value);
				break;
			case 9:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = LogPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserSiteId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setApp($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setModuleName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setActionName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setClassName($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setSeverity($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setMessage($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(LogPeer::DATABASE_NAME);

		if ($this->isColumnModified(LogPeer::ID)) $criteria->add(LogPeer::ID, $this->id);
		if ($this->isColumnModified(LogPeer::USER_SITE_ID)) $criteria->add(LogPeer::USER_SITE_ID, $this->user_site_id);
		if ($this->isColumnModified(LogPeer::APP)) $criteria->add(LogPeer::APP, $this->app);
		if ($this->isColumnModified(LogPeer::MODULE_NAME)) $criteria->add(LogPeer::MODULE_NAME, $this->module_name);
		if ($this->isColumnModified(LogPeer::ACTION_NAME)) $criteria->add(LogPeer::ACTION_NAME, $this->action_name);
		if ($this->isColumnModified(LogPeer::CLASS_NAME)) $criteria->add(LogPeer::CLASS_NAME, $this->class_name);
		if ($this->isColumnModified(LogPeer::SEVERITY)) $criteria->add(LogPeer::SEVERITY, $this->severity);
		if ($this->isColumnModified(LogPeer::MESSAGE)) $criteria->add(LogPeer::MESSAGE, $this->message);
		if ($this->isColumnModified(LogPeer::CREATED_AT)) $criteria->add(LogPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(LogPeer::UPDATED_AT)) $criteria->add(LogPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(LogPeer::DATABASE_NAME);

		$criteria->add(LogPeer::ID, $this->id);

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

		$copyObj->setApp($this->app);

		$copyObj->setModuleName($this->module_name);

		$copyObj->setActionName($this->action_name);

		$copyObj->setClassName($this->class_name);

		$copyObj->setSeverity($this->severity);

		$copyObj->setMessage($this->message);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getLogFieldList() as $relObj) {
				$copyObj->addLogField($relObj->copy($deepCopy));
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
			self::$peer = new LogPeer();
		}
		return self::$peer;
	}

	
	public function initLogFieldList()
	{
		if ($this->collLogFieldList === null) {
			$this->collLogFieldList = array();
		}
	}

	
	public function getLogFieldList($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseLogFieldPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLogFieldList === null) {
			if ($this->isNew()) {
			   $this->collLogFieldList = array();
			} else {

				$criteria->add(LogFieldPeer::LOG_ID, $this->getId());

				LogFieldPeer::addSelectColumns($criteria);
				$this->collLogFieldList = LogFieldPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(LogFieldPeer::LOG_ID, $this->getId());

				LogFieldPeer::addSelectColumns($criteria);
				if (!isset($this->lastLogFieldCriteria) || !$this->lastLogFieldCriteria->equals($criteria)) {
					$this->collLogFieldList = LogFieldPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastLogFieldCriteria = $criteria;
		return $this->collLogFieldList;
	}

	
	public function countLogFieldList($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseLogFieldPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(LogFieldPeer::LOG_ID, $this->getId());

		return LogFieldPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addLogField(LogField $l)
	{
		$this->collLogFieldList[] = $l;
		$l->setLog($this);
	}

} 