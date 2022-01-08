<?php


abstract class BaseHomeWall extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $people_name;


	
	protected $user_site_id;


	
	protected $message;


	
	protected $icon;


	
	protected $show_who;


	
	protected $deleted;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aUserSite;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getPeopleName()
	{

		return $this->people_name;
	}

	
	public function getUserSiteId()
	{

		return $this->user_site_id;
	}

	
	public function getMessage()
	{

		return $this->message;
	}

	
	public function getIcon()
	{

		return $this->icon;
	}

	
	public function getShowWho()
	{

		return $this->show_who;
	}

	
	public function getDeleted()
	{

		return $this->deleted;
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
			$this->modifiedColumns[] = HomeWallPeer::ID;
		}

	} 
	
	public function setPeopleName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->people_name !== $v) {
			$this->people_name = $v;
			$this->modifiedColumns[] = HomeWallPeer::PEOPLE_NAME;
		}

	} 
	
	public function setUserSiteId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_site_id !== $v) {
			$this->user_site_id = $v;
			$this->modifiedColumns[] = HomeWallPeer::USER_SITE_ID;
		}

		if ($this->aUserSite !== null && $this->aUserSite->getId() !== $v) {
			$this->aUserSite = null;
		}

	} 
	
	public function setMessage($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->message !== $v) {
			$this->message = $v;
			$this->modifiedColumns[] = HomeWallPeer::MESSAGE;
		}

	} 
	
	public function setIcon($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->icon !== $v) {
			$this->icon = $v;
			$this->modifiedColumns[] = HomeWallPeer::ICON;
		}

	} 
	
	public function setShowWho($v)
	{

		if ($this->show_who !== $v) {
			$this->show_who = $v;
			$this->modifiedColumns[] = HomeWallPeer::SHOW_WHO;
		}

	} 
	
	public function setDeleted($v)
	{

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = HomeWallPeer::DELETED;
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
			$this->modifiedColumns[] = HomeWallPeer::CREATED_AT;
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
			$this->modifiedColumns[] = HomeWallPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->people_name = $rs->getString($startcol + 1);

			$this->user_site_id = $rs->getInt($startcol + 2);

			$this->message = $rs->getString($startcol + 3);

			$this->icon = $rs->getString($startcol + 4);

			$this->show_who = $rs->getBoolean($startcol + 5);

			$this->deleted = $rs->getBoolean($startcol + 6);

			$this->created_at = $rs->getTimestamp($startcol + 7, null);

			$this->updated_at = $rs->getTimestamp($startcol + 8, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating HomeWall object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(HomeWallPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			HomeWallPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(HomeWallPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(HomeWallPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if( $this->isDeleted() )
			throw new PropelException("You cannot save an object that has been deleted.");

		if( $con === null )
			$con = Propel::getConnection(HomeWallPeer::DATABASE_NAME);

		$tableName = HomeWallPeer::TABLE_NAME;
		
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


												
			if ($this->aUserSite !== null) {
				if ($this->aUserSite->isModified()) {
					$affectedRows += $this->aUserSite->save($con);
				}
				$this->setUserSite($this->aUserSite);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = HomeWallPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += HomeWallPeer::doUpdate($this, $con);
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


												
			if ($this->aUserSite !== null) {
				if (!$this->aUserSite->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserSite->getValidationFailures());
				}
			}


			if (($retval = HomeWallPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HomeWallPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getPeopleName();
				break;
			case 2:
				return $this->getUserSiteId();
				break;
			case 3:
				return $this->getMessage();
				break;
			case 4:
				return $this->getIcon();
				break;
			case 5:
				return $this->getShowWho();
				break;
			case 6:
				return $this->getDeleted();
				break;
			case 7:
				return $this->getCreatedAt();
				break;
			case 8:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = HomeWallPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getPeopleName(),
			$keys[2]=>$this->getUserSiteId(),
			$keys[3]=>$this->getMessage(),
			$keys[4]=>$this->getIcon(),
			$keys[5]=>$this->getShowWho(),
			$keys[6]=>$this->getDeleted(),
			$keys[7]=>$this->getCreatedAt(),
			$keys[8]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HomeWallPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setPeopleName($value);
				break;
			case 2:
				$this->setUserSiteId($value);
				break;
			case 3:
				$this->setMessage($value);
				break;
			case 4:
				$this->setIcon($value);
				break;
			case 5:
				$this->setShowWho($value);
				break;
			case 6:
				$this->setDeleted($value);
				break;
			case 7:
				$this->setCreatedAt($value);
				break;
			case 8:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = HomeWallPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPeopleName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUserSiteId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setMessage($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIcon($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setShowWho($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDeleted($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUpdatedAt($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(HomeWallPeer::DATABASE_NAME);

		if ($this->isColumnModified(HomeWallPeer::ID)) $criteria->add(HomeWallPeer::ID, $this->id);
		if ($this->isColumnModified(HomeWallPeer::PEOPLE_NAME)) $criteria->add(HomeWallPeer::PEOPLE_NAME, $this->people_name);
		if ($this->isColumnModified(HomeWallPeer::USER_SITE_ID)) $criteria->add(HomeWallPeer::USER_SITE_ID, $this->user_site_id);
		if ($this->isColumnModified(HomeWallPeer::MESSAGE)) $criteria->add(HomeWallPeer::MESSAGE, $this->message);
		if ($this->isColumnModified(HomeWallPeer::ICON)) $criteria->add(HomeWallPeer::ICON, $this->icon);
		if ($this->isColumnModified(HomeWallPeer::SHOW_WHO)) $criteria->add(HomeWallPeer::SHOW_WHO, $this->show_who);
		if ($this->isColumnModified(HomeWallPeer::DELETED)) $criteria->add(HomeWallPeer::DELETED, $this->deleted);
		if ($this->isColumnModified(HomeWallPeer::CREATED_AT)) $criteria->add(HomeWallPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(HomeWallPeer::UPDATED_AT)) $criteria->add(HomeWallPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(HomeWallPeer::DATABASE_NAME);

		$criteria->add(HomeWallPeer::ID, $this->id);

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

		$copyObj->setPeopleName($this->people_name);

		$copyObj->setUserSiteId($this->user_site_id);

		$copyObj->setMessage($this->message);

		$copyObj->setIcon($this->icon);

		$copyObj->setShowWho($this->show_who);

		$copyObj->setDeleted($this->deleted);

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
			self::$peer = new HomeWallPeer();
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

} 