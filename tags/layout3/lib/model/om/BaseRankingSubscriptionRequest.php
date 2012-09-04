<?php


abstract class BaseRankingSubscriptionRequest extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $user_site_id;


	
	protected $user_site_id_owner;


	
	protected $ranking_id;


	
	protected $request_status;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aUserSiteRelatedByUserSiteId;

	
	protected $aUserSiteRelatedByUserSiteIdOwner;

	
	protected $aRanking;

	
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

	
	public function getUserSiteIdOwner()
	{

		return $this->user_site_id_owner;
	}

	
	public function getRankingId()
	{

		return $this->ranking_id;
	}

	
	public function getRequestStatus()
	{

		return $this->request_status;
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
			$this->modifiedColumns[] = RankingSubscriptionRequestPeer::ID;
		}

	} 
	
	public function setUserSiteId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_site_id !== $v) {
			$this->user_site_id = $v;
			$this->modifiedColumns[] = RankingSubscriptionRequestPeer::USER_SITE_ID;
		}

		if ($this->aUserSiteRelatedByUserSiteId !== null && $this->aUserSiteRelatedByUserSiteId->getId() !== $v) {
			$this->aUserSiteRelatedByUserSiteId = null;
		}

	} 
	
	public function setUserSiteIdOwner($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_site_id_owner !== $v) {
			$this->user_site_id_owner = $v;
			$this->modifiedColumns[] = RankingSubscriptionRequestPeer::USER_SITE_ID_OWNER;
		}

		if ($this->aUserSiteRelatedByUserSiteIdOwner !== null && $this->aUserSiteRelatedByUserSiteIdOwner->getId() !== $v) {
			$this->aUserSiteRelatedByUserSiteIdOwner = null;
		}

	} 
	
	public function setRankingId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ranking_id !== $v) {
			$this->ranking_id = $v;
			$this->modifiedColumns[] = RankingSubscriptionRequestPeer::RANKING_ID;
		}

		if ($this->aRanking !== null && $this->aRanking->getId() !== $v) {
			$this->aRanking = null;
		}

	} 
	
	public function setRequestStatus($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->request_status !== $v) {
			$this->request_status = $v;
			$this->modifiedColumns[] = RankingSubscriptionRequestPeer::REQUEST_STATUS;
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
			$this->modifiedColumns[] = RankingSubscriptionRequestPeer::CREATED_AT;
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
			$this->modifiedColumns[] = RankingSubscriptionRequestPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->user_site_id = $rs->getInt($startcol + 1);

			$this->user_site_id_owner = $rs->getInt($startcol + 2);

			$this->ranking_id = $rs->getInt($startcol + 3);

			$this->request_status = $rs->getString($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->updated_at = $rs->getTimestamp($startcol + 6, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating RankingSubscriptionRequest object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RankingSubscriptionRequestPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RankingSubscriptionRequestPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(RankingSubscriptionRequestPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(RankingSubscriptionRequestPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RankingSubscriptionRequestPeer::DATABASE_NAME);
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


												
			if ($this->aUserSiteRelatedByUserSiteId !== null) {
				if ($this->aUserSiteRelatedByUserSiteId->isModified()) {
					$affectedRows += $this->aUserSiteRelatedByUserSiteId->save($con);
				}
				$this->setUserSiteRelatedByUserSiteId($this->aUserSiteRelatedByUserSiteId);
			}

			if ($this->aUserSiteRelatedByUserSiteIdOwner !== null) {
				if ($this->aUserSiteRelatedByUserSiteIdOwner->isModified()) {
					$affectedRows += $this->aUserSiteRelatedByUserSiteIdOwner->save($con);
				}
				$this->setUserSiteRelatedByUserSiteIdOwner($this->aUserSiteRelatedByUserSiteIdOwner);
			}

			if ($this->aRanking !== null) {
				if ($this->aRanking->isModified()) {
					$affectedRows += $this->aRanking->save($con);
				}
				$this->setRanking($this->aRanking);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RankingSubscriptionRequestPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += RankingSubscriptionRequestPeer::doUpdate($this, $con);
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


												
			if ($this->aUserSiteRelatedByUserSiteId !== null) {
				if (!$this->aUserSiteRelatedByUserSiteId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserSiteRelatedByUserSiteId->getValidationFailures());
				}
			}

			if ($this->aUserSiteRelatedByUserSiteIdOwner !== null) {
				if (!$this->aUserSiteRelatedByUserSiteIdOwner->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserSiteRelatedByUserSiteIdOwner->getValidationFailures());
				}
			}

			if ($this->aRanking !== null) {
				if (!$this->aRanking->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRanking->getValidationFailures());
				}
			}


			if (($retval = RankingSubscriptionRequestPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RankingSubscriptionRequestPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getUserSiteIdOwner();
				break;
			case 3:
				return $this->getRankingId();
				break;
			case 4:
				return $this->getRequestStatus();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RankingSubscriptionRequestPeer::getFieldNames($keyType);
		$result = array(
			$keys[0]=>$this->getId(),
			$keys[1]=>$this->getUserSiteId(),
			$keys[2]=>$this->getUserSiteIdOwner(),
			$keys[3]=>$this->getRankingId(),
			$keys[4]=>$this->getRequestStatus(),
			$keys[5]=>$this->getCreatedAt(),
			$keys[6]=>$this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RankingSubscriptionRequestPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setUserSiteIdOwner($value);
				break;
			case 3:
				$this->setRankingId($value);
				break;
			case 4:
				$this->setRequestStatus($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RankingSubscriptionRequestPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserSiteId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUserSiteIdOwner($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRankingId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setRequestStatus($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RankingSubscriptionRequestPeer::DATABASE_NAME);

		if ($this->isColumnModified(RankingSubscriptionRequestPeer::ID)) $criteria->add(RankingSubscriptionRequestPeer::ID, $this->id);
		if ($this->isColumnModified(RankingSubscriptionRequestPeer::USER_SITE_ID)) $criteria->add(RankingSubscriptionRequestPeer::USER_SITE_ID, $this->user_site_id);
		if ($this->isColumnModified(RankingSubscriptionRequestPeer::USER_SITE_ID_OWNER)) $criteria->add(RankingSubscriptionRequestPeer::USER_SITE_ID_OWNER, $this->user_site_id_owner);
		if ($this->isColumnModified(RankingSubscriptionRequestPeer::RANKING_ID)) $criteria->add(RankingSubscriptionRequestPeer::RANKING_ID, $this->ranking_id);
		if ($this->isColumnModified(RankingSubscriptionRequestPeer::REQUEST_STATUS)) $criteria->add(RankingSubscriptionRequestPeer::REQUEST_STATUS, $this->request_status);
		if ($this->isColumnModified(RankingSubscriptionRequestPeer::CREATED_AT)) $criteria->add(RankingSubscriptionRequestPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(RankingSubscriptionRequestPeer::UPDATED_AT)) $criteria->add(RankingSubscriptionRequestPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RankingSubscriptionRequestPeer::DATABASE_NAME);

		$criteria->add(RankingSubscriptionRequestPeer::ID, $this->id);

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

		$copyObj->setUserSiteIdOwner($this->user_site_id_owner);

		$copyObj->setRankingId($this->ranking_id);

		$copyObj->setRequestStatus($this->request_status);

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
			self::$peer = new RankingSubscriptionRequestPeer();
		}
		return self::$peer;
	}

	
	public function setUserSiteRelatedByUserSiteId($v)
	{


		if ($v === null) {
			$this->setUserSiteId(NULL);
		} else {
			$this->setUserSiteId($v->getId());
		}


		$this->aUserSiteRelatedByUserSiteId = $v;
	}


	
	public function getUserSiteRelatedByUserSiteId($con = null)
	{
		if ($this->aUserSiteRelatedByUserSiteId === null && ($this->user_site_id !== null)) {
						include_once 'lib/model/om/BaseUserSitePeer.php';

			$this->aUserSiteRelatedByUserSiteId = UserSitePeer::retrieveByPK($this->user_site_id, $con);

			
		}
		return $this->aUserSiteRelatedByUserSiteId;
	}

	
	public function setUserSiteRelatedByUserSiteIdOwner($v)
	{


		if ($v === null) {
			$this->setUserSiteIdOwner(NULL);
		} else {
			$this->setUserSiteIdOwner($v->getId());
		}


		$this->aUserSiteRelatedByUserSiteIdOwner = $v;
	}


	
	public function getUserSiteRelatedByUserSiteIdOwner($con = null)
	{
		if ($this->aUserSiteRelatedByUserSiteIdOwner === null && ($this->user_site_id_owner !== null)) {
						include_once 'lib/model/om/BaseUserSitePeer.php';

			$this->aUserSiteRelatedByUserSiteIdOwner = UserSitePeer::retrieveByPK($this->user_site_id_owner, $con);

			
		}
		return $this->aUserSiteRelatedByUserSiteIdOwner;
	}

	
	public function setRanking($v)
	{


		if ($v === null) {
			$this->setRankingId(NULL);
		} else {
			$this->setRankingId($v->getId());
		}


		$this->aRanking = $v;
	}


	
	public function getRanking($con = null)
	{
		if ($this->aRanking === null && ($this->ranking_id !== null)) {
						include_once 'lib/model/om/BaseRankingPeer.php';

			$this->aRanking = RankingPeer::retrieveByPK($this->ranking_id, $con);

			
		}
		return $this->aRanking;
	}

} 